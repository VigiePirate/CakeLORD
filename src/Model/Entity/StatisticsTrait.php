<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Datasource\FactoryLocator;

trait StatisticsTrait
{

    public function countMyRats($options)
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $rats = $model->find()->where([$options['field'] => $this->id]);
        return $rats->count();
    }

    public function frequencyOfMyRats($options)
    {
        $model = FactoryLocator::get('Table')->get('Rats');
        $rats = $model->find()->where([$options['field'] => $this->id]);
        $allrats = $model->find();
        return round (100 * $rats->count() / $allrats->count(),1);
    }
}
