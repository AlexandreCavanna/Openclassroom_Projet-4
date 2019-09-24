<?php

class PostManager extends Manager {

    /**
     * Fonction qui retourne tous les chapitres
     *
     * @return $var;
     */
    public function getPosts()
    {
        $var = [];
        $req = $this->getDb()->prepare('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY creation_date');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Post($data);
        }
        return $var;
        $req->closeCursor();
    }

    /**
     * Fonction qui récupère les derniers chapitres à affichier sur la page d'accueil
     *
     * @return $var;
     */
    public function getPostHome()
    {
        $var = [];
        $req = $this->getDb()->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'le %d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 3');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Post($data);
        }
        return $var;
        $req->closeCursor();
    }

    /**
     * Fonction qui récupère un chapitre en fonction de son ID
     *
     * @param [type] $id
     * @return new Post($data);
     */
    public function getPost($id)
    {
        $req = $this->getDb()->prepare('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(modification_date, \'%d/%m/%Y à %Hh%imin%ss\') AS modification_date_fr FROM posts WHERE id = ?');
        $req->execute(array($id));
        $data = $req->fetch();
        return new Post($data);
        $req->closeCursor();
    }

    /**
     * Fonction pour insérer un nouveau chapitre dans la base de données
     *
     * @param [type] $title
     * @param [type] $author
     * @param [type] $content
     * @return $insertPost;
     */
    public function insertPost($title, $author, $content)
    {
        $req = $this->getDb()->prepare('INSERT INTO posts(title, author, content, creation_date) VALUES (:title, :author, :content, NOW())');
        $insertPost = $req->execute(array(
            'title' => $title,
            'author' => $author,
            'content' => $content
        ));
        return $insertPost;
    }

    /**
     * Fonction pour supprimer un chapitre de la base de données
     *
     * @param [type] $id
     * @return $deletePost;
     */
    public function deletePost($id)
    {
        $req = $this->getDb()->prepare('DELETE FROM posts WHERE id = ?');
        $deletePost = $req->execute(array($id));
        return $deletePost;
    }

    /**
     * Fonction pour mettre à jour un chapitre
     *
     * @param [type] $id
     * @param [type] $title
     * @param [type] $author
     * @param [type] $content
     * @return $updatePost;
     */
    public function updatePost($id, $title, $author, $content)
    {
        $req = $this->getDb()->prepare('UPDATE posts SET title = :newtitle, author = :newauthor, content = :newcontent, modification_date = NOW() WHERE id =' . $id);
        $updatePost = $req->execute(array(
            'newtitle' => $title,
            'newauthor' => $author,
            'newcontent' => $content
        ));
        return $updatePost;
    }

    /**
     * Fonction pour vérifier qu'un id corresponde bien à un chapitre
     *
     * @param [type] $id
     * @return $checkPostId;
     */
    public function checkPostId($id)
    {
        $req = $this->getDb()->prepare('SELECT * FROM posts WHERE id = ?');
        $req->execute(array($id));
        $checkPostId = $req->rowCount();
        return $checkPostId;
        $req->closeCursor();
    }

}