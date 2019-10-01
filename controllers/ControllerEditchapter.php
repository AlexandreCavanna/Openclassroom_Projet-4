<?php
session_start();

require_once('views/View.php');

class ControllerEditchapter {

    private $_view;
    private $_chapterManager;

    protected $id;
    protected $newTitle;
    protected $newAuthor;
    protected $newContent;

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
        else if(isset($_GET['url']) == 'editchapter' AND empty($_SESSION))
        {
            throw new Exception('Page introuvable');
        }
        else if(isset($_GET['url']) == 'editchapter' AND isset($_GET['id']) AND $_SESSION['slug'] == 'admin' AND $_SESSION['level'] = '2') 
        {
            $this->id = $_GET['id'];
            $this->checkId($this->id);

            if(isset($_POST['submit']))
            {
                $this->id = $_GET['id'];
                $this->updateChapter($this->id);
                $this->editChapter($this->id);
            }
            else
            {
                $this->editChapter($_GET['id']);
            }
        }
        else
        {
            throw new Exception('Accès refusé !'); 
        }
    }

    /**
     * Fonction qui affiche le chapitre a modifié
     *
     * @param [type] $id
     */
    private function editChapter($id)
    {
        $this->_chapterManager = new ChapterManager;
        $chapter = $this->_chapterManager->getChapter($id);

        $this->_view = new View('Editchapter');
        $this->_view->generate(array(
            'chapter' => $chapter,
            'error' => $this->error,
            'msg' => $this->msg
        ));
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
     * Fonction qui met à jour le chapitre
     *
     * @param [type] $id
     */
    private function updateChapter($id)
    {
        if(isset($_POST['new_chapter_title']) AND !empty($_POST['new_chapter_title']) AND isset($_POST['new_chapter_content']) AND !empty($_POST['new_chapter_content']))
        {
            $this->newTitle = htmlspecialchars($_POST['new_chapter_title']);
            $this->newAuthor = $_SESSION['pseudo'];
            $this->newContent = htmlspecialchars($_POST['new_chapter_content']);

            $this->_chapterManager = new ChapterManager;
            $updateChapter = $this->_chapterManager->updateChapter($this->id, $this->newTitle, $this->newAuthor, $this->newContent);
            $this->msg = "Votre chapitre a été mis à jour !";
        }
        else
        {
            $this->error = "Veuillez remplir tous les champs !";
        }
    }

}