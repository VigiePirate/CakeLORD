<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\FactoryLocator;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Filesystem\File;

class PictureBehavior extends Behavior
{
    protected $_defaultConfig = [
        'maxWidth' => 900,
        'maxHeight' => 600,
        'thumbnail' => false,
        'field_name' => 'picture'
    ];

    /**
     * Initialize method
     *
     * Initializes the behavior with configuration values. The array of
     * configuration values passed in the Table->addBehavior() method will
     * overwrite the default values.
     *
     * @param array $config array of configuration values.
     * @return void
     */
    public function initialize(array $config): void
    {
        if (empty($config)) {
            $config = $this->_defaultConfig;
        }
        $this->config = $this->getConfig();
    }

    /**
     * beforeMarshal method
     *
     * Prevents the submitted file from being over-written as blank
     * Resizes picture if a new one has been provided
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        if ($data->offsetExists('picture_file')) {
            $picture = $data['picture_file'];
            if ($picture->getClientFilename() === '') {
                unset($data['picture_file']);
                return;
            } else {
                $tmpName = $this->resizePic($picture);
                $data['resized'] = $tmpName;
                $data[$this->config['field_name']] = $tmpName;
                if ($this->config['thumbnail']) {
                    $data['picture_thumbnail'] = 'thumb.' . $tmpName;
                }
            }
        }
    }

    /**
     * afterMarshal method
     *
     * Sets picture field as dirty if a picture file was provided
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $data
     * @param ArrayObject $options
     * @return void
     */
    public function afterMarshal(EventInterface $event, EntityInterface $entity, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['resized']) && ! $data['resized']) {
            $entity->setError('picture_file', ['upload' => __('This image format is not supported. Please choose a jpeg, png or gif file.')]);
            $event->stopPropagation();
            $event->setResult(false);
            return;
        } else {
            $entity->setDirty($this->config['field_name'], $data->offsetExists('picture_file'));
            if (array_key_exists('thumbnail', $this->config)) {
                $entity->setDirty('picture_thumbnail', $data->offsetExists('picture_file') && $this->config['thumbnail']);
            }
        }
    }

    /**
     * afterSave method
     *
     * Moves picture from temporary directory to uploads directory
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if (in_array($this->config['field_name'], $entity->getDirty())) {
            rename(TMP . $entity[$this->config['field_name']], WWW_UPLOADS . $entity[$this->config['field_name']]);
        }

        if (in_array('picture_thumbnail', $entity->getDirty())) {
            rename(TMP . $entity->picture_thumbnail, WWW_UPLOADS . $entity->picture_thumbnail);
        }

        return;
    }

    /**
     * resizePic method
     *
     * Resizes picture to a predefined maximum bounding box.
     * Generates a thumbnail with predefined dimensions if option selected.
     *
     * @param \Laminas\Diactoros\UploadedFile $picture
     * @param ArrayObject $options
     * @return void
     */
    public function resizePic(\Laminas\Diactoros\UploadedFile $picture)
    {
        /* Check media type */
        $type = $picture->getClientMediaType();
        if($type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif'){
            return false;
        }

        /* Read and process */
        $name = $picture->getClientFilename();
        $size = $picture->getSize();
        $tmpName = $picture->getStream()->getMetadata('uri');

        switch ($type) {
            case 'image/jpeg':
                $img = imagecreatefromjpeg($tmpName);
                break;
            case 'image/png':
                $img = imagecreatefrompng($tmpName);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($tmpName);
                break;
        }

        /* Determine final size to respect aspect ratio and maximal dimensions */
        $sizes = getimagesize($tmpName);
        $maxWidth = $this->config['maxWidth'];
        $maxHeight = $this->config['maxHeight'];
        $newWidth = (int)$sizes[0];
        $newHeight = (int)$sizes[1];
        $aspectRatio = $sizes[0]/$sizes[1];
        if ($sizes[0] > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int)round($newWidth/$aspectRatio);
        }
        if ($sizes[1] > $maxHeight) {
            $newHeight = $maxHeight;
            $newWidth = (int)round($newHeight*$aspectRatio);
        }
        $new_img = imagecreatetruecolor($newWidth, $newHeight);
        imagefill($new_img, 0, 0, imagecolorallocate($new_img, 255, 255, 255));
        imagecopyresampled($new_img, $img, 0, 0, 0, 0, $newWidth, $newHeight, $sizes[0], $sizes[1]);

        /* Write in temporary place and free up memory */
        $hashable = \Cake\I18n\FrozenTime::now() . '.' . $picture->getClientFilename();
        $tmpName = \Cake\Utility\Security::hash($hashable, 'md5') . '.jpg';
        $tmpDest = TMP . $tmpName;
        imagejpeg($new_img, $tmpDest, 90);
        imagedestroy($new_img);

        /* Write thumbnail if required */
        if ($this->config['thumbnail']) {
            $thumb_img = imagecreatetruecolor($this->config['thumbWidth'], $this->config['thumbHeight']);
            $targetRatio = (int)$this->config['thumbWidth']/$this->config['thumbHeight'];
            if ($aspectRatio >= $targetRatio) {
                $src_width = (int) $sizes[1] * $targetRatio;
                $src_height = $sizes[1];
                $src_x = (int) ($sizes[0] - $src_width)/2;
                $src_y = 0;
            } else {
                $src_width = $sizes[0];
                $src_height = (int) $sizes[0] / $targetRatio;
                $src_x = 0;
                $src_y = (int) ($sizes[1] - $src_height)/2;
            }

            imagecopyresampled(
                $thumb_img, $img,
                0, 0,
                $src_x, $src_y,
                $this->config['thumbWidth'], $this->config['thumbHeight'],
                $src_width, $src_height
            );

            $tmpDest = TMP . 'thumb.' . $tmpName;
            imagejpeg($thumb_img, $tmpDest, 90);
            imagedestroy($thumb_img);
        }

        return $tmpName;
    }
}
