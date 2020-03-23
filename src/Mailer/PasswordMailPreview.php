// in src/Mailer/MailPreview/WelcomePreview.php
namespace App\Mailer\Preview;

use DebugKit\Mailer\MailPreview;

class WelcomePreview extends MailPreview
{
    public function welcome()
    {
        $mailer = $this->getMailer('Welcome');
        // set any template variables receipients for the mailer.

        return $mailer;
    }
}
