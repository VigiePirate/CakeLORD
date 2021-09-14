<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Datasource\FactoryLocator;

trait StatisticsTrait
{

    public function countAll($name)
    {
        $model = FactoryLocator::get('Table')->get($name);
        return $model->find()->count();
    }

    public function countAllByCreationYear($name)
    {
        $model = FactoryLocator::get('Table')->get($name);
        $histogram = $model->find()
            ->where(['created IS NOT' => '1981-08-01'])
            ->select(['year' => 'YEAR(created)', 'count' => 'COUNT(id)'])
            ->group('year')
            ->order(['year' => 'ASC']);
        return $histogram;
    }

    public function countMyRats($options)
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $rats = $model->find()->where([$options['field'] => $this->id]);
        return $rats->count();

        /* replace $options by $this->toString().'_id' ?
        works and would avoid writing the option everytime in controller
        less flexible however if other options needed later... */
    }

    public function frequencyOfMyRats($options)
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $rats = $model->find()->where([$options['field'] => $this->id]);
        $allrats = $model->find();
        return round (100 * $rats->count() / $allrats->count(),1);
    }

    public function countRatsByYear()
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $histogram = $model->find()
            ->where(['birth_date IS NOT' => '1981-08-01'])
            ->select(['year' => 'YEAR(birth_date)', 'count' => 'COUNT(id)'])
            ->group('year')
            ->order(['year' => 'ASC']);
        return $histogram;
    }
}
