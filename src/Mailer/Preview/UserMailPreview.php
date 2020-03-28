<?php

namespace App\Mailer\Preview;

use DebugKit\Mailer\MailPreview;

class UserMailPreview extends MailPreview
{
  public function sendResetEmail()
  {
    $this->loadModel("Users");
    $user = $this->Users->find()->first();
    $url = '/users/lost-password/';
    return $this->getMailer("User")
    ->sendResetEmail($url,$user);
  }

  public function sendActivationEmail()
  {
    $this->loadModel("Users");
    $user = $this->Users->find()->first();
    $url = '/users/register/';
    return $this->getMailer("User")
    ->sendActivationEmail($url,$user);
  }
}
