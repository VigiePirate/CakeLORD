<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\Core\Configure;

class LordMailer extends Mailer
{
  public function sendContactEmail($initiator, $message)
  {
    $options = Configure::read('EmailSettings');
    $this
    ->setTransport('gandi')
    ->setFrom($initiator)
    ->setSender($options['sender_mail'], $options['sender_name'])
    ->setTo($options['sender_mail'])
    ->setReplyTo($initiator)
    ->setSubject(__('Message Sent Through the LORD Contact Form'))
    ->setViewVars(['initiator' => $initiator, 'message' => $message])
    ->setEmailFormat('both')
    ->viewBuilder()
    ->setTemplate('contact_email');
    return $this;
  }
}
