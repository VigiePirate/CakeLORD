<?php

namespace App\Mailer\Preview;

use DebugKit\Mailer\MailPreview;

class PasswordMailPreview extends MailPreview
{
    public function sendResetEmail()
    {
        $this->getMailer('sendResetEmail');
        $this->viewBuilder()
          ->setTransport('default')
          ->setFrom(['lord@example.com' => 'Livre des Origines du Rat Domestique'])
          // ->setSender('lord@example.com', 'MyApp emailer') // fixme
          ->setTo($user->email)
          ->setSubject('Reset your Password')
          ->setViewVars(['url' => $url, 'username' => $user->username])
            ->setTemplate('reset-password');
        $this->loadModel("Users");
        $user = $this->Users->find()->first();
        $url = $this->Html->link(['controller' => 'users', 'action' => 'resetPassword', $passkey]);
        return $this->getMailer("User")
                    ->sendResetEmail($url,$user);
    }
}
