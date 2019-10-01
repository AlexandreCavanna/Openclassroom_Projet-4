<?php
session_start();

require_once('views/View.php');

class ControllerSignalcomment {

    private $_commentManager;
    private $_view;

    protected $id;
    protected $id_post;

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
        else if(isset($_GET['url']) == 'signalcomment' AND isset($_GET['id_post']) AND !empty($_SESSION))
        {
            $this->id = $_GET['id'];
            $this->id_post = $_GET['id_post'];
            $this->signalComment($this->id, $this->id_post);
        }
        else
        {
            throw New Exception('Page introuvable !');
        }
    }

    /**
     * Fonction pour signaler un commentaire
     *
     * @param [type] $id
     * @param [type] $id_post
     */
    public function signalComment($id, $id_post)
    {
        if(!empty($_SESSION))
        {
            $this->_commentManager = new CommentManager;
            $this->_commentManager->signalComment($id_post);
            header('Location: chapter&id=' . $id);
        }
        else
        {
            throw New Exception('Impossible de signaler le commentaire !');
        }
    }
}