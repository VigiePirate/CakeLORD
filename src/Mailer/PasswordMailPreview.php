// in src/Mailer/MailPreview/PasswordMailPreview.php
<?php

namespace App\Mailer\Preview;

use DebugKit\Mailer\MailPreview;

class PasswordMailPreview extends MailPreview
{
    public function sendResetEmail()
    {
        $mailer = $this->getMailer('sendResetEmail');
        // set any template variables receipients for the mailer.
        $this->loadModel("Users");
                        $user = $this->Users->find()->first();
                        return $this->getMailer("User")
                            ->sendResetEmail($user)
        return $mailer;
    }
}
