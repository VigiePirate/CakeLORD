<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\Core\Configure;

class UserMailer extends Mailer
{
  public function sendResetEmail($url, $user)
  {
    $this
    ->setTransport('srfa')
    ->setFrom(['lord@srfa.info' => 'Livre des Origines du Rat Domestique'])
    ->setSender('lord@srfa.info', 'Livre des Origines du Rat Domestique')
    ->setTo($user->email)
    ->setSubject(__('Reset your Password'))
    ->setViewVars(['url' => $url, 'username' => $user->username])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('reset_password');
    return $this;
  }

  public function sendActivationEmail($url, $user)
  {
    $this
    ->setTransport('srfa')
    ->setFrom(['lord@srfa.info' => 'Livre des Origines du Rat Domestique'])
    ->setSender('lord@srfa.info', 'Livre des Origines du Rat Domestique')
    ->setTo($user->email)
    ->setSubject(__('Activate your Account'))
    ->setViewVars(['url' => $url, 'username' => $user->username])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('activate');
    return $this;
  }

  public function sendConfirmationEmail($url, $user)
  {
    $options = Configure::read('EmailSettings');
    $this
    ->setTransport('srfa')
    ->setFrom($options['from'])
    ->setSender($options['sender_mail'], $options['sender_name'])
    ->setTo($user->email)
    ->setSubject(__('Confirm your New Email'))
    ->setViewVars(['url' => $url, 'username' => $user->username])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('confirm_email');
    return $this;
  }

  public function sendStaffEmail($message, $user)
  {
    $options = Configure::read('EmailSettings');
    $this
    ->setTransport('srfa')
    ->setFrom($options['from'])
    ->setSender($options['sender_mail'], $options['sender_name'])
    ->setTo($user->email)
    ->setBcc('lord@srfa.info')
    ->setSubject(__('A Staff Member Sent You a Message'))
    ->setViewVars(['message' => $message, 'username' => $user->username])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('staff_email');
    return $this;
  }

  public function sendContactEmail($initiator, $message)
  {
    $options = Configure::read('EmailSettings');
    $this
    ->setTransport('srfa')
    ->setFrom($options['from'])
    ->setSender($options['sender_mail'], $options['sender_name'])
    ->setTo($options['sender_mail'])
    ->setReplyTo($initiator)
    ->setCc($initiator)
    ->setSubject(__('Message Sent Through the LORD Contact Form'))
    ->setViewVars(['initiator' => $initiator, 'message' => $message])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('contact_email');
    return $this;
  }
}
