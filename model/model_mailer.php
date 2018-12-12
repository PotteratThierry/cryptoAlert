<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class mailer
{
    private $mail;
    private $smtpHost;
    private $smtpPort;
    private $smtpUser;
    private $smtpPassword;
    private $smtpSecure;
    private $smtpAuth;

    private $sender;
    private $senderName;
    private $recipient;
    private $recipientName;
    private $subject;
    private $htmlMsg;
    private $noHtmlMsg = 'HTML messaging not supported';


    private $result;

    public function __construct()
    {
        $this->mail = new PHPMailer;

        $this->smtpHost =  param::searchParam(INI_PATH, 'smtpHost');
        $this->smtpPort =  param::searchParam(INI_PATH, 'smtpPort');
        $this->smtpUser =  param::searchParam(INI_PATH, 'smtpUser');
        $this->smtpPassword =  param::searchParam(INI_PATH, 'smtpPassword');
        $this->smtpSecure =  param::searchParam(INI_PATH, 'smtpSecure');
        $this->smtpAuth =  param::searchParam(INI_PATH, 'smtpAuth');


        $this->sender =  param::searchParam(INI_PATH, 'mailSender');
        $this->senderName =  param::searchParam(INI_PATH, 'mailSenderName');

    }
    public function mail()
    {
        $this->result = 0;
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $this->mail->Host = $this->smtpHost; // use $this->mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $this->mail->Port = $this->smtpPort; // TLS only
        $this->mail->SMTPSecure = $this->smtpSecure; // ssl is depracated
        $this->mail->SMTPAuth = FALSE;
        $this->mail->Username = $this->smtpUser;
        $this->mail->Password = $this->smtpPassword;
        $this->mail->setFrom($this->sender, $this->senderName);
        $this->mail->addAddress($this->recipient, $this->recipientName);
        $this->mail->Subject = $this->subject;
        $this->mail->msgHTML($this->htmlMsg);
        //$this->mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
        $this->mail->AltBody = $this->noHtmlMsg;
        // $this->mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

        if(!$this->mail->send())
        {
            $this->result =  $this->mail->ErrorInfo;
        }
        else
        {
            $this->result =  1;
        }
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return string
     */
    public function getSenderName()
    {
        return $this->senderName;
    }

    /**
     * @param string $senderName
     */
    public function setSenderName($senderName)
    {
        $this->senderName = $senderName;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param mixed $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return mixed
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * @param mixed $recipientName
     */
    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;
    }

    /**
     * @return int
     */
    public function getSmtpUser()
    {
        return $this->smtpUser;
    }

    /**
     * @param int $smtpUser
     */
    public function setSmtpUser($smtpUser)
    {
        $this->smtpUser = $smtpUser;
    }

    /**
     * @return int
     */
    public function getSmtpPassword()
    {
        return $this->smtpPassword;
    }

    /**
     * @param int $smtpPassword
     */
    public function setSmtpPassword($smtpPassword)
    {
        $this->smtpPassword = $smtpPassword;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getHtmlMsg()
    {
        return $this->htmlMsg;
    }

    /**
     * @param mixed $htmlMsg
     */
    public function setHtmlMsg($htmlMsg)
    {
        $this->htmlMsg = $htmlMsg;
    }

    /**
     * @return mixed
     */
    public function getNoHtmlMsg()
    {
        return $this->noHtmlMsg;
    }

    /**
     * @param mixed $noHtmlMsg
     */
    public function setNoHtmlMsg($noHtmlMsg)
    {
        $this->noHtmlMsg = $noHtmlMsg;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

}
