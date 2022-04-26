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
        'maxWidth' => 600,
        'maxHeight' => 400
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
            if ($picture === '') {
                unset($picture);
                return;
            } else {
                $tmpName = $this->resizePic($picture);
                $data['picture'] = $tmpName;
            }
        }
        return;
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
        if ($data->offsetExists('picture_file')) {
            $entity->setDirty('picture', true);
        } else {
            $entity->setDirty('picture', false);
        }
    }

    /**
     * beforeSave method
     *
     * Rewrite picture name if a new one has been uploaded.
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return boolean
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if ($entity->has('picture') && in_array('picture', $entity->getDirty())) {
            $finalName = 'Rattery_' . $entity->prefix . '_' . $entity->picture;
            $entity->set('picture', $finalName);
        }
        return true;
    }

    /**
     * afterSave method
     *
     * Renames and moves picture from temporary directory to uploads directory
     *
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if (in_array('picture', $entity->getDirty()) && $entity->picture != '') {
            $finalName = $entity->picture;
            $tmpName = substr($finalName, strrpos($finalName, "_") + 1);
            rename(TMP . $tmpName, WWW_UPLOADS . $finalName);
        }
        return;
    }

    /**
     * resizePic method
     *
     * Resizes picture to a predefined maximum bounding box.
     *
     * @param \Laminas\Diactoros\UploadedFile $picture
     * @return void
     */
    public function resizePic(\Laminas\Diactoros\UploadedFile $picture)
    {
        /* Check media type */
        $type = $picture->getClientMediaType();
        if($type != 'image/jpeg' && $type != 'image/png' && 'image/gif'){
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
        if($sizes[0]>$maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int)round($newWidth/$aspectRatio);
        }
        if($sizes[1]>$maxHeight) {
            $newHeight = $maxHeight;
            $newWidth = (int)round($newHeight*$aspectRatio);
        }
        $new_img = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($new_img, $img, 0, 0, 0, 0, $newWidth, $newHeight, $sizes[0], $sizes[1]);

        /* Write in temporary place and free up memory */
        $tmpName = \Cake\Utility\Security::hash($picture->getClientFilename(), 'md5') . '.jpg';
        $tmpDest = TMP . $tmpName;
        imagejpeg($new_img, $tmpDest, 90);
        imagedestroy($new_img);
        return $tmpName;
    }
}
