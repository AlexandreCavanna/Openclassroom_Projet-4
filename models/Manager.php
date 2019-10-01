<?php

class Manager
{
    private static $_db;

    /**
     * Fonction qui instancie la connexion à la bdd
     *
     */
    private static function setDb()
    {
        self::$_db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    /**
     * Fonction qui récupère la connexion à la bdd
     *
     */ 
    protected function getDb()
    {
        self::setDb();
        return self::$_db;
    }

    /**
     * Fonction qui récupère toutes les données d'une table
     *
     * @param [type] $table
     * @param [type] $obj
     * @return $var;
     */
    protected function getAll($table, $obj)
    {
        $var = [];
        $req = $this->getDb()->prepare('SELECT * FROM ' . $table . ' ORDER BY id DESC');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }
}