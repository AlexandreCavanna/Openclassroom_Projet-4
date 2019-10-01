
<?php
session_start();

require_once('views/View.php');

class ControllerRegister {

    private $_view;
    private $_register;

    protected $pseudo;
    protected $password;
    protected $cPassword;
    protected $email;

    public $error;
    public $msg;

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
            $this->_register = new RegisterManager;
            $this->checkFields();
        }
        else
        {
            $this->register();
        }
    }

    /**
     * Fonction qui génère la vue de la page d'inscription
     *
     */
    private function register()
    {
        $this->_view = new View('Register');
        $this->_view->generate(array(
            'error' => $this->error,
            'msg' => $this->msg,
            'pseudo' => $this->pseudo,
            'email' => $this->email
        ));
    }

    /**
     * Fonction qui récupère les variables POST et affiche la vue de la page d'inscription
     *
     */
    private function checkFields()
    {
        if (!empty($_POST['pseudo']) AND !empty($_POST['password']) AND !empty($_POST['cpassword']) AND !empty($_POST['email'])) 
        {
            $this->pseudo = htmlspecialchars($_POST['pseudo']);
            $this->password = htmlspecialchars($_POST['password']);
            $this->cPassword = htmlspecialchars($_POST['cpassword']);
            $this->email = htmlspecialchars($_POST['email']);

            $this->checkPseudoLength();
        }    
        else 
        {
            $this->error = "Tous les champs doivent être complétés !";
        }

        $this->register();
    }

    /**
     * Fonction qui vérifie que la taille du pseudo ne dépasse pas les 255 caractères
     *
     */
    private function checkPseudoLength()
    {
        $pseudoLength = strlen($this->pseudo);

        if($pseudoLength <= 255)
        {
            $this->checkPseudoExist();
        }
        else
        {
            $this->error = "Votre pseudo ne doit pas dépasser 255 caractères !";
        }
    }

    /**
     * Fonction qui vérifie que le pseudo n'est pas déjà existant dans la base de données
     *
     */
    private function checkPseudoExist()
    {
        $checkPseudo = $this->_register->checkPseudo($this->pseudo);

        if($checkPseudo == 0)
        {
            $this->checkEmailExist();
        }
        else
        {
            $this->error = "Pseudo déjà utilisé !";
        }
    }

    /**
     * Fonction qui vérifie que l'adresse mail n'est pas déjà existante dans la base de données
     *
     */
    private function checkEmailExist()
    {
        $checkEmail = $this->_register->checkEmail($this->email);

        if(filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            if($checkEmail == 0)
            {
                $this->checkPassword();
            }
            else
            {
                $this->error = "Adresse email déjà utilisée !";
            }
        }
        else
        {
            $this->error = "Votre adresse mail n'est pas valide !";
        }               
    }

    /**
     * Fonction qui vérifie que les 2 mots de passes sont valides,
     * puis le mot de passe est haché et les informations du compte sont envoyées
     * à la base de données
     *
     */
    private function checkPassword()
    {
        if($this->password == $this->cPassword)
        {
            $pass_hache = password_hash($this->password, PASSWORD_DEFAULT);
            $newRegister = $this->_register->newRegister($this->pseudo, $pass_hache, $this->email);
            $this->msg = "Votre compte a bien été créé ! <a href=\"authentication\">Me connecter</a>";
        }
        else
        {
            $this->error = "Vos mots de passes ne correspondent pas !";
        }
    }

}
