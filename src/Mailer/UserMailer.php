<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

class UserMailer extends Mailer
{
    /* from tutorial
    public function welcome($user)
    {
        $this
            ->setTo($user->email)
            ->setSubject(sprintf('Welcome %s', $user->name))
            ->viewBuilder()
                ->setTemplate('welcome_mail'); // By default template with same name as method name is used.
    }
    */
    public function sendResetEmail($url, $user) {
            return $this
              //->setTransport(new \Cake\Mailer\Transport\DebugTransport())
              ->setTransport('default')
              ->setHeaders(['X-Mailer' => 'PHP/' . phpversion()])
              ->setFrom(['lord@example.com' => 'Livre des Origines du Rat Domestique'])
              ->setSender('lord@example.com', 'Livre des Origines du Rat Domestique')
              ->setTo($user->email)
              ->setSubject('Reset your Password')
              ->setViewVars(['url' => $url, 'username' => $user->username])
              ->setEmailFormat('both')
              ->viewBuilder()
                ->setTemplate('reset_password');
              // ->setDomain('www.example.org');
        }
}
