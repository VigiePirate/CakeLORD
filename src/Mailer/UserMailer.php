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

    public function resetPassword($user)
    {
        $this
            ->setTo($user->email)
            ->setSubject('Reset password')
            ->setViewVars(['token' => $user->token]);
    }
    */

    public function sendResetEmail($url, $user) {
            return $this
              //->setTransport(new \Cake\Mailer\Transport\DebugTransport())
              ->setTransport('default')
              // ->setHeaders(['X-Mailer' => 'PHP/' . phpversion()])
              ->setFrom(['lord@example.com' => 'Livre des Origines du Rat Domestique'])
              // ->setSender('lord@example.com', 'MyApp emailer') // fixme
              ->setTo($user->email)
              ->setSubject('Reset your Password')
              ->setViewVars(['url' => $url, 'username' => $user->username])
              ->setEmailFormat('both')
              ->viewBuilder()
              ->setTemplate('reset_password')
              ->send();

              // ->setDomain('www.example.org');

            /* from UsersController, should become useless here
            if ($mailer->deliver()) {
                $this->Flash->success(__('Check your email for your reset password link'));
            } else {
                $this->Flash->error(__('Error sending email: ')); // . $email->smtpError);
            }
            return $mailer;
            */

/* doc
$this
            ->setTo($user->email)
            ->setSubject('Reset password')
            ->setViewVars(['token' => $user->token]);
            */


        }
}
