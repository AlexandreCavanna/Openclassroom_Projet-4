<?php
session_start();

class ControllerDisconnection {

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
        else if(isset($_GET['url']) == 'disconnection')
        {
            $this->disconnection();
        }
    }

    /**
     * Fonction qui sert à un utilisateur pour se déconnecter
     *
     */
    private function disconnection()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: home");
    }

}