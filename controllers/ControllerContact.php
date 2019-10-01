<?php
session_start();

require_once('views/View.php');

class ControllerContact {

    private $_contactManager;
    private $_view;

    protected $name;
    protected $emailFrom;
    protected $subject;
    protected $message;
    protected $emailTo;
    protected $headers;
    protected $txt;

    public $msg;
    public $error;

    /**
     * Constructeur ou l'on récupère l'url
     * et ou on lance les actions
     *
     * @param [type] $url
     */
    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
        {
            echo "Error 404";
        }
        else if(isset($_POST['submit']))
        {
            $this->checkFields();  
        }
        else
        {
            $this->contact();
        }
    }

    /**
     * Fonction qui affiche la vue de la page contact
     *
     */
    private function contact()
    {
        $this->_view = new View('Contact');
        $this->_view->generate(array(
            'error' => $this->error,
            'msg' => $this->msg
        ));
    }

    private function checkFields()
    {
        if(!empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['subject']) AND !empty($_POST['message']))
        {
            $this->name = htmlspecialchars($_POST['name']);
            $this->emailFrom = htmlspecialchars($_POST['email']);
            $this->subject = htmlspecialchars($_POST['subject']);
            $this->message = htmlspecialchars($_POST['message']);

            $this->checkEmail();
        }
        else
        {
            $this->error = "Veuillez remplir tous les champs !";
        }

        $this->contact();

    }

    private function checkEmail()
    {
        if(filter_var($this->emailFrom, FILTER_VALIDATE_EMAIL))
        {
            $this->sendEmail();
        }
        else
        {
            $this->error = "Votre adresse mail n'est pas valide !";
        }
    }

    private function sendEmail()
    {
        $this->emailTo = "alexandre.cavanna.pro@gmail.com";
        $this->headers = "From: " . $this->emailFrom;
        $this->txt = "Vous avez reçu un email de " . $this->name . ".\n\n" . $this->message;

        mail($this->emailTo, $this->subject, $this->txt, $this->headers);
        $this->msg = "Votre email vient d'être envoyé !";
    }

}