<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\StatisticsTrait;

class Lord extends Entity
{
    use StatisticsTrait;
}
