<?php
session_start();

require_once('views/View.php');

class ControllerDeletecomment {

    private $_chapterManager;
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
        else if(isset($_GET['url']) == 'deletecomment' AND isset($_GET['id_post']) AND !empty($_SESSION) AND $_SESSION['slug'] == 'admin' AND $_SESSION['level'] == '2')
        {
            $this->id = $_GET['id'];
            $this->id_post = $_GET['id_post'];
            $this->deleteComment($this->id, $this->id_post);
        }
        else
        {
            throw New Exception('Page introuvable !');
        }
    }

    /**
     * Fonction pour supprimer un commentaire
     *
     * @param [type] $id
     * @param [type] $id_post
     */
    private function deleteComment($id, $id_post)
    {
        if(!empty($_SESSION) AND $_SESSION['slug'] == 'admin' AND $_SESSION['level'] == '2')
        {
            $this->_commentManager = new CommentManager;
            $deleteComment = $this->_commentManager->deleteComment($id_post);
            header('Location: comment&id=' . $id);
        }
        else
        {
            throw New Exception('Suppression du commentaire impossible !');
        }
    }

}