<?php

namespace App\Mailer\Preview;

use DebugKit\Mailer\MailPreview;
//use Cake\Routing\Router;

class UserMailPreview extends MailPreview
{
    public function sendResetEmail()
    {
        $this->loadModel("Users");
        $user = $this->Users->find()->first();
        $url = '/lost-password/';
        return $this->getMailer("User")
                    ->sendResetEmail($url,$user);
    }
}
