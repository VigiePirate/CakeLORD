<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

class UserMailer extends Mailer
{
  public function sendResetEmail($url, $user) {
    $this
    ->setTransport('default')
    ->setFrom(['lord@example.com' => 'Livre des Origines du Rat Domestique'])
    ->setSender('lord@example.com', 'Livre des Origines du Rat Domestique')
    ->setTo($user->email)
    ->setSubject('Reset your Password')
    ->setViewVars(['url' => $url, 'username' => $user->username])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('reset_password');
    return $this;
  }

  public function sendActivationEmail($url, $user) {
    $this
    ->setTransport('default')
    ->setFrom(['lord@example.com' => 'Livre des Origines du Rat Domestique'])
    ->setSender('lord@example.com', 'Livre des Origines du Rat Domestique')
    ->setTo($user->email)
    ->setSubject('Activate your Account')
    ->setViewVars(['url' => $url, 'username' => $user->username])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('activate');
    return $this;
  }

  public function sendConfirmationEmail($url, $user) {
    $this
    ->setTransport('default')
    ->setFrom(['lord@example.com' => 'Livre des Origines du Rat Domestique'])
    ->setSender('lord@example.com', 'Livre des Origines du Rat Domestique')
    ->setTo($user->email)
    ->setSubject('Confirm your New Email')
    ->setViewVars(['url' => $url, 'username' => $user->username])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('confirm_email');
    return $this;
  }
}
