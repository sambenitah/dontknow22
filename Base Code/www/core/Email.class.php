<?php

namespace DontKnow\Core;
use DontKnow\Dao\Users as UserDao;
use DontKnow\VO\MailHost;
use DontKnow\VO\MailPassword;
use DontKnow\VO\MailPort;
use DontKnow\VO\MailUsername;
use DontKnow\VO\WebsiteName;
use PHPMailer\PHPMailer\PHPMailer;

class Email extends PHPMailer
{
    private $websiteName;


    public function __construct(MailHost $host,MailPort $port,MailUsername $username,
                                MailPassword $password,?bool $exceptions = null)
    {
        parent::__construct($exceptions);
            $this->Host = $host->getHost();
            $this->Username = $username->getUsername();
            $this->Password = $password->getPassword();
            $this->Port = $port->getPort();
            $this->SMTPAuth = TRUE;
            $this->SMTPSecure ='tls';
            $this->isSMTP();
            $this->websiteName = resolve(WebsiteName::class);
            $this->setFrom('spacecowboy@dontknow.fr');
    }


    public function sendRegisterMail(String $email){

        $name = explode("@",$email);

        $this->addAddress($email);

        $this->Subject = 'Weclome To '.$this->websiteName->getName();

        $this->Body= 'Hi '.$name[0].' welcome to '.$this->websiteName->getName();

        $this->send();
    }



    public function sendForgotPasswordMail(String $email,int $token){

        $name = explode("@",$email);

        $this->addAddress($email);

        $this->Subject = 'Password Request From '.$this->websiteName->getName();

        $this->Body= 'Hi '.$name[0].' please click here to change you password: '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/setPassword/?email=sambenitah@gmail.com&hash='.$token;

        $this->send();
    }









}