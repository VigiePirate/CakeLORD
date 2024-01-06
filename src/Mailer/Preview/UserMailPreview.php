<?php

namespace App\Mailer\Preview;

use DebugKit\Mailer\MailPreview;

class UserMailPreview extends MailPreview
{
  public function sendResetEmail()
  {
    $user = $this->fetchModel("Users")->find()->first();
    $url = '/users/lost-password/';
    return $this->getMailer("User")
    ->sendResetEmail($url, $user);
  }

  public function sendActivationEmail()
  {
    $user = $this->fetchModel("Users")->find()->first();
    $url = '/users/register/';
    return $this->getMailer("User")
    ->sendActivationEmail($url, $user);
  }
}
