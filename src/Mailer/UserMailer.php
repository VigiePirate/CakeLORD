<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\Core\Configure;

class UserMailer extends Mailer
{
  public function sendResetEmail($url, $user) {
    $this
    ->setTransport('gandi')
    ->setFrom(['contact@srfa.info' => 'Livre des Origines du Rat Domestique'])
    ->setSender('contact@srfa.info', 'Livre des Origines du Rat Domestique')
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
    ->setTransport('gandi')
    ->setFrom(['contact@srfa.info' => 'Livre des Origines du Rat Domestique'])
    ->setSender('contact@srfa.info', 'Livre des Origines du Rat Domestique')
    ->setTo($user->email)
    ->setSubject('Activate your Account')
    ->setViewVars(['url' => $url, 'username' => $user->username])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('activate');
    return $this;
  }

  public function sendConfirmationEmail($url, $user) {

    $options = Configure::read('EmailSettings');
    $this
    ->setTransport('gandi')
    ->setFrom($options['from'])
    ->setSender($options['sender_mail'], $options['sender_name'])
    ->setTo($user->email)
    ->setSubject('Confirm your New Email')
    ->setViewVars(['url' => $url, 'username' => $user->username])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('confirm_email');
    return $this;
  }
}
