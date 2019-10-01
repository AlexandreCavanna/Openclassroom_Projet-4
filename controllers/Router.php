<?php

require_once('views/View.php');

class Router
{
    private $_ctrl;
    private $_view;

    /**
     * Fonction qui gère les différentes routes en fonction des actions de l'utilisateur
     *
     */
    public function routeReq()
    {
        try
        {
            // Chargement automatique des classes
            spl_autoload_register(function($class) {
                require_once('models/' . $class . '.php');
            });

            $url = '';

            // Si un paramètre URL est présent dans l'adresse
            if(isset($_GET['url']))
            {
                // Récupération et séparation des paramètres de l'URL
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                // Controller sera égal au premier paramètre de l'URL
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller". $controller;
                $controllerFile = "controllers/". $controllerClass .".php";

                // Vérification de l'existance du controller
                if(file_exists($controllerFile))
                {
                    // S'il existe on le require
                    require_once($controllerFile);
                    // Et on instancie la classe en récupérant les paramètres de l'URL
                    $this->_ctrl = new $controllerClass($url);
                }
                else
                {
                    // Sinon la page est introuvable
                    throw new Exception('Page introuvable');
                }
            }
            // Si pas d'URL on charge la page d'accueil
            else
            {
                require_once('controllers/ControllerHome.php');
                $this->_ctrl = new ControllerHome($url);
            }
        }
        // Gestion des erreurs
        catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            // Instance de la classe View error
            $this->_view = new View('Error');
            // On envoit les données dont a besoin dans la vue
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
    }
}