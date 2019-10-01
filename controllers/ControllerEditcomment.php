<?php
session_start();

require_once('views/View.php');

class ControllerEditcomment {

    private $_view;
    private $_chapterManager;
    private $_commentManager;

    protected $id;
    protected $id_post;
    protected $newComment;

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
        else if(isset($_GET['url']) == 'editcomment' AND !empty($_SESSION))
        {
            $this->id = $_GET['id'];
            $this->id_post = $_GET['id_post'];
            $this->checkId($this->id);
            $this->checkCommentId($this->id_post);

            if(isset($_POST['submit']))
            {
                $this->updateComment($this->id, $this->id_post);
                $this->editComment($this->id, $this->id_post);
            }
            else
            {
                $this->editComment($this->id, $this->id_post);
            }
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
    }

    /**
     * Fonction ou l'on vérifie que le commentaire existe via son Id
     *
     * @param [type] $id_post
     */
    private function checkCommentId($id_post)
    {
        $this->_commentManager = new CommentManager;
        $checkCommentId = $this->_commentManager->checkCommentId($id_post);

        if($checkCommentId == 0)
        {
            throw New Exception('Commentaire introuvable !');
        }
    }

    /**
     * Fonction pour afficher la page d'édition d'un commentaire
     *
     * @param [type] $id
     * @param [type] $id_post
     */
    private function editComment($id, $id_post)
    {
        $this->_commentManager = new CommentManager;
        $comment = $this->_commentManager->getComment($id_post);
        
        if($_SESSION['pseudo'] == $comment->author())
        {
            $this->_chapterManager = new ChapterManager;
            $chapter = $this->_chapterManager->getChapter($id);

            $this->_view = new View('Editcomment');
            $this->_view->generate(array(
                'comment' => $comment,
                'chapter' => $chapter,
                'error' => $this->error,
                'msg' => $this->msg
            ));
        }
        else
        {
            throw New Exception('Page introuvable !');
        }
        
    }

    /**
     * Fonction pour update un commentaire
     *
     * @param [type] $id
     * @param [type] $id_post
     */
    private function updateComment($id, $id_post)
    {
        if(!empty($_POST['newcomment']) AND isset($_POST['newcomment']))
        {
            $this->newComment = htmlspecialchars($_POST['newcomment']);
            $this->_commentManager = new CommentManager;
            $updateComment = $this->_commentManager->updateComment($id_post, $this->newComment);
            $this->msg = "Votre commentaire a été mis à jour !";
        }
        else
        {
            $this->error = "Veuillez remplir le champ !";
        }
    }
}