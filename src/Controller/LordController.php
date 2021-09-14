<?php
declare(strict_types=1);

namespace App\Controller;
use App\Model\Entity\Lord;

class LordController extends AppController
{
    public function stats()
    {
        $lord = new Lord();
        $user_count = $lord->countAll('Users');
        $rattery_count = $lord->countAll('Ratteries');
        $litter_count = $lord->countAll('Litters');
        $rat_count = $lord->countAll('Rats');
        $rat_birth = json_encode($lord->countRatsByYear());
        $user_creation = json_encode($lord->countAllByCreationYear('Users'));
        $rattery_creation = json_encode($lord->countAllByCreationYear('Ratteries'));
        //$rat_creation = json_encode($lord->countAllByCreationYear('Rats'));
        $this->set(compact('user_count', 'rattery_count', 'litter_count', 'rat_count',
            'user_creation', 'rattery_creation', 'rat_birth'));
    }
}
