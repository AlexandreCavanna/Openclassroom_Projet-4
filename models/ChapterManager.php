<?php

class ChapterManager extends Manager {

    /**
     * Fonction qui retourne tous les chapitres
     *
     * @return $var;
     */
    public function getChapters()
    {
        $var = [];
        $req = $this->getDb()->prepare('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY creation_date');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Chapter($data);
        }
        return $var;
        $req->closeCursor();
    }

    /**
     * Fonction qui récupère les derniers chapitres à affichier sur la page d'accueil
     *
     * @return $var;
     */
    public function getChaptersHome()
    {
        $var = [];
        $req = $this->getDb()->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'le %d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 3');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Chapter($data);
        }
        return $var;
        $req->closeCursor();
    }

    /**
     * Fonction qui récupère un chapitre en fonction de son ID
     *
     * @param [type] $id
     * @return new Chapter($data);
     */
    public function getChapter($id)
    {
        $req = $this->getDb()->prepare('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(modification_date, \'%d/%m/%Y à %Hh%imin%ss\') AS modification_date_fr FROM posts WHERE id = ?');
        $req->execute(array($id));
        $data = $req->fetch();
        return new Chapter($data);
        $req->closeCursor();
    }

    /**
     * Fonction pour insérer un nouveau chapitre dans la base de données
     *
     * @param [type] $title
     * @param [type] $author
     * @param [type] $content
     * @return $insertChapter;
     */
    public function insertChapter($title, $author, $content)
    {
        $req = $this->getDb()->prepare('INSERT INTO posts(title, author, content, creation_date) VALUES (:title, :author, :content, NOW())');
        $insertChapter = $req->execute(array(
            'title' => $title,
            'author' => $author,
            'content' => $content
        ));
        return $insertChapter;
    }

    /**
     * Fonction pour supprimer un chapitre de la base de données
     *
     * @param [type] $id
     * @return $deleteChapter;
     */
    public function deleteChapter($id)
    {
        $req = $this->getDb()->prepare('DELETE FROM posts WHERE id = ?');
        $deleteChapter = $req->execute(array($id));
        return $deleteChapter;
    }

    /**
     * Fonction pour mettre à jour un chapitre
     *
     * @param [type] $id
     * @param [type] $title
     * @param [type] $author
     * @param [type] $content
     * @return $updateChapter;
     */
    public function updateChapter($id, $title, $author, $content)
    {
        $req = $this->getDb()->prepare('UPDATE posts SET title = :newtitle, author = :newauthor, content = :newcontent, modification_date = NOW() WHERE id =' . $id);
        $updateChapter = $req->execute(array(
            'newtitle' => $title,
            'newauthor' => $author,
            'newcontent' => $content
        ));
        return $updateChapter;
    }

    /**
     * Fonction pour vérifier qu'un id corresponde bien à un chapitre
     *
     * @param [type] $id
     * @return $checkChapterId;
     */
    public function checkChapterId($id)
    {
        $req = $this->getDb()->prepare('SELECT * FROM posts WHERE id = ?');
        $req->execute(array($id));
        $checkChapterId = $req->rowCount();
        return $checkChapterId;
        $req->closeCursor();
    }

}