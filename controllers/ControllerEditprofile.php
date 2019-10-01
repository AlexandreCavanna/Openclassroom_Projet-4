<?php
session_start();

require_once('views/View.php');

class ControllerEditprofile {

    private $_view;
    private $_profileManager;
    private $_register;

    protected $newPseudo;
    protected $newPassword;
    protected $newcPassword;
    protected $newEmail;

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
            $this->_profileManager = new ProfileManager;
            $this->_register = new RegisterManager;

            if(isset($_POST['newPseudo']))
            {
                $this->checkFieldNewPseudo();
            }

            if(isset($_POST['newEmail']))
            {
                $this->checkFieldNewEmail();
            }

            if(isset($_POST['newPassword']))
            {
                $this->checkFieldNewPassword();
            }
            
            $this->editProfile();
        }
        else if(isset($_SESSION['id']))
        {
            $this->editProfile();
        }
        else
        {
            throw new Exception('Page introuvable !');
        }
    }

    /**
     * Fonction qui génère la vue de la page
     *
     */
    private function editProfile()
    {
        $this->_view = new View('Editprofile');
        $this->_view->generate(array('error' => $this->error));
    }

    /**
     * Fonction qui vérifie le champ pseudo
     *
     */
    private function checkFieldNewPseudo()
    {
        // Vérification du pseudo
        if(isset($_POST['newPseudo']) AND !empty($_POST['newPseudo']) AND $_POST['newPseudo'] != $_SESSION['pseudo'])
        {
            $this->newPseudo = htmlspecialchars($_POST['newPseudo']);
            $this->checkLengthNewPseudo();
        }
        else
        {
            $this->error = "Le pseudo est identique ou vide !";
        }
    }

    /**
     * Fonction qui vérifie la longueur du pseudo 
     *
     */
    private function checkLengthNewPseudo()
    {
        $pseudoLength = strlen($this->newPseudo);

        if($pseudoLength <= 255)
        {
            $this->checkNewPseudoExist();
        }
        else
        {
            $this->error = "Votre pseudo ne doit pas dépasser 255 caractères !";
        } 
    }

    /**
     * Fonction qui vérifie que le pseudo n'est pas déjà présent dans la base de données
     * si c'est le cas le nouveau pseudo remplace l'ancien
     *
     */
    private function checkNewPseudoExist()
    {
        $checkNewPseudo = $this->_register->checkPseudo($this->newPseudo);

        if($checkNewPseudo == 0)
        {
            $this->_profileManager->updatePseudo($this->newPseudo, $_SESSION['id']);
            $_SESSION['pseudo'] = $_POST['newPseudo'];
            header('Location: profile&id=' . $_SESSION['id']);
        }
        else
        {
            $this->error = "Pseudo déjà utilisé !";
        }
    }

    /**
     * Fonction qui vérifie le champ email
     *
     */
    private function checkFieldNewEmail()
    {
        // Vérification de l'email
        if(isset($_POST['newEmail']) AND !empty($_POST['newEmail']) AND $_POST['newEmail'] != $_SESSION['email'])
        {
            $this->newEmail = htmlspecialchars($_POST['newEmail']);
            $this->checkNewEmailExist();
        }
        else
        {
            $this->error = "L'adresse email est identique ou vide !";
        }
    }

    /**
     * Fonction qui vérifie que l'email n'est pas déjà présent dans la base données
     * si c'est le cas le nouvel email remplace l'ancien
     *
     */
    private function checkNewEmailExist()
    {
        $checkNewEmail = $this->_register->checkEmail($this->newEmail);

        if(filter_var($this->newEmail, FILTER_VALIDATE_EMAIL))
        {
            if($checkNewEmail == 0)
            {
                $this->_profileManager->updateEmail($this->newEmail, $_SESSION['id']);
                $_SESSION['email'] = $_POST['newEmail'];
                header('Location: profile&id=' . $_SESSION['id']);
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
     * Fonction qui vérifie les champs des mots de passe
     *
     */
    private function checkFieldNewPassword()
    {
        if(isset($_POST['newPassword']) AND !empty($_POST['newPassword']) AND isset($_POST['newcPassword']) AND !empty($_POST['newcPassword']))
        {
            $this->newPassword = htmlspecialchars($_POST['newPassword']);
            $this->newcPassword = htmlspecialchars($_POST['newcPassword']);
            $this->checkNewPassword();
        }
        else
        {
            $this->error = "Veuillez remplir les champs des mots de passe !";
        }
    }

    /**
     * Fonction qui vérifie que les 2 champs de mots de passe sont égaux
     * si c'est le cas on hache le mot de passe et on remplace l'ancien mdp par le nouveau dans la base de données
     *
     */
    private function checkNewPassword()
    {
        if($this->newPassword == $this->newcPassword)
        {
            $pass_hache = password_hash($this->newPassword, PASSWORD_DEFAULT);
            $this->_profileManager->updatePassword($pass_hache, $_SESSION['id']);
            header('Location: profile&id=' . $_SESSION['id']);
        }
        else
        {
            $this->error = "Vos deux mot de passe ne correspondent pas !";
        }
    }

}
