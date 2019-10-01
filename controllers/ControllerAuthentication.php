<?php
session_start();

require_once('views/View.php');

class ControllerAuthentication {

    private $_view;
    private $_authentication;

    protected $email;
    protected $password;

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
            $this->_authentication = new AuthenticationManager;
            $this->checkFields();
        }
        else
        {
            $this->authentication();
        }
    }

    /**
     * Fonction qui génère la vue de la page de connexion
     *
     */
    private function authentication()
    {
        $this->_view = new View('Authentication');
        $this->_view->generate(array(
            'error' => $this->error
        ));
    }

    /**
     * Fonction qui récupère les variables POST et affiche la vue de la page d'inscription
     *
     */
    private function checkFields()
    {
        if(!empty($_POST['emailconnect']) AND !empty($_POST['passwordconnect']))
        {
            $this->email = htmlspecialchars($_POST['emailconnect']);
            $this->password = htmlspecialchars($_POST['passwordconnect']);

            $this->checkEmail();
        }
        else
        {
            $this->error = "Tous les champs doivent être complétés !";
        }

        $this->authentication();
    }

    /**
     * Fonction qui vérifie que l'adresse mail est valide et qu'elle est bien présente
     * dans la base de données
     *
     */
    private function checkEmail()
    {
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $checkUser = $this->_authentication->checkUser($this->email);
            $checkPass = password_verify($this->password, $checkUser['pass']);

            $this->checkPassword($checkPass, $checkUser);
        }
        else
        {
            $this->error = "Votre adresse mail n'est pas valide !";
        }
    }

    /**
     * Fonction qui vérifie le mot de passe associé à l'adresse mail entrée dans le champ
     * et récupération des informations de l'utilisateur dans des variables de sessions
     *
     * @param [type] $checkPass
     * @param [type] $checkUser
     */
    private function checkPassword($checkPass, $checkUser)
    {
        if($checkPass)
        {
            $_SESSION['id'] = $checkUser['id'];
            $_SESSION['pseudo'] = $checkUser['pseudo'];
            $_SESSION['email'] = $checkUser['email'];
            $_SESSION['name'] = $checkUser['name'];
            $_SESSION['slug'] = $checkUser['slug'];
            $_SESSION['level'] = $checkUser['level'];

            header("Location: home");
        }
        else
        {
            $this->error = "Mauvais identifiant ou mot de passe !";
        }
    }
  
}