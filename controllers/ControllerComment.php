<?php
session_start();

require_once('views/View.php');

class ControllerComment {

    private $_chapterManager;
    private $_commentManager;
    private $_view;

    protected $id;

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
        else if(isset($_GET['url']) == 'comment' AND isset($_GET['id']) AND !empty($_SESSION) AND $_SESSION['slug'] == 'admin' AND $_SESSION['level'] == '2')
        {
            $this->id = $_GET['id'];
            $this->checkId($this->id);
        }
        else
        {
            throw New Exception('Page introuvable !');
        }
    }

    /**
     * Fonction ou l'on vérifie que le chapitre existe via son Id
     *
     * @param [type] $id
     */
    private function checkId($id)
    {
        $this->_chapterManager = new ChapterManager;
        $checkChapterId = $this->_chapterManager->checkChapterId($id);

        if($checkChapterId == 0)
        {
            throw New Exception('Chapitre introuvable !');
        }
        else
        {
            $this->comment($id);
        }
    }
   
    /**
     * Fonction qui affiche les commentaires d'un chapitre via l'id
     *
     * @param [type] $id
     */
    public function comment($id)
    {
        $this->_chapterManager = new ChapterManager;
        $chapter = $this->_chapterManager->getChapter($id);

        $this->_commentManager = new CommentManager;
        $comments = $this->_commentManager->getComments($id);

        $this->_view = new View('Comment');
        $this->_view->generate(array(
            'chapter' => $chapter,
            'comments' => $comments
        ));
    }

}