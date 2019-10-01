<?php
session_start();

require_once('views/View.php');

class ControllerNewchapter {

    private $_view;
    private $_chapterManager;

    protected $title;
    protected $content;
    protected $author;

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
        else if(isset($_GET['url']) == 'newchapter' AND empty($_SESSION))
        {
            throw new Exception('Page introuvable');
        }
        else if(isset($_GET['url']) == 'newchapter' AND $_SESSION['slug'] == 'admin' AND $_SESSION['level'] == '2')
        {
            if(isset($_POST['submit']))
            {
                $this->_chapterManager = new ChapterManager;
                $this->checkChapter();
                $this->newChapter();
            }
            else
            {
                $this->newChapter();
            }
        }
        else
        {
            throw new Exception('Accès refusé !');
        }
    }

    /**
     * Fonction qui génère la vue de la page de publication d'un article
     *
     */
    private function newChapter()
    {
        $this->_view = new View('Newchapter');
        $this->_view->generate(array(
            'error' => $this->error,
            'msg' => $this->msg
        ));
    }

    /**
     * Fonction qui controle les champs et insert le chapitre dans la base de données
     *
     */
    private function checkChapter()
    {
        if(isset($_POST['chapter_title']) AND !empty($_POST['chapter_title']) AND isset($_POST['chapter_content']) AND !empty($_POST['chapter_title']))
        {
            $this->title = htmlspecialchars($_POST['chapter_title']);
            $this->author = $_SESSION['pseudo'];
            $this->content = htmlspecialchars($_POST['chapter_content']);

            $this->_chapterManager->insertChapter($this->title, $this->author, $this->content);
            $this->msg = "Votre chapitre a été publié !";
        }
        else
        {
            $this->error = "Veuillez remplir tous les champs !";
        } 
    }

}