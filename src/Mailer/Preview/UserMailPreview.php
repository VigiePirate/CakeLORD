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
        //$url = $this->Html->link(['controller' => 'users', 'action' => 'resetPassword', $user->$passkey]);
        //$url = Router::Url(['controller' => 'users', 'action' => 'resetPassword'], true) . '/' . 'somepasskey';
        $url = '/gloubiboulga/';
        return $this->getMailer("User")
                    ->sendResetEmail($url,$user);
    }
}
