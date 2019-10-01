<?php

class RegisterManager extends Manager {

    /**
     * Fonction pour vérifier à l'inscription que le pseudo n'est pas déjà utilisé dans la bdd
     *
     * @param [type] $pseudo
     * @return $checkPseudo
     */
    
    public function checkPseudo($pseudo)
    {
        $req = $this->getDb()->prepare('SELECT * FROM members WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $checkPseudo = $req->rowCount();
        return $checkPseudo;
        $req->closeCursor();
    }

    /**
     * Fonction pour vérifier à l'inscription que l'email n'est pas déjà utilisé dans la bdd
     *
     * @param [type] $email
     * @return $checkEmail
     */
    public function checkEmail($email)
    {
        $req = $this->getDb()->prepare('SELECT * FROM members WHERE email = ?');
        $req->execute(array($email));
        $checkEmail = $req->rowCount();
        return $checkEmail;
        $req->closeCursor();
    }

    /**
     * Fonction pour insérer les données d'un nouveau compte dans la base de données
     *
     * @param [type] $pseudo, $pass_hache, $email
     * @return $insertMembers
     */
    public function newRegister($pseudo, $pass_hache, $email)
    {
        $req = $this->getDb()->prepare('INSERT INTO members(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
        $newRegister = $req->execute(array(
            'pseudo' => $pseudo,
            'pass' => $pass_hache,
            'email' => $email
        ));
        return $newRegister;
        $newRegister->closeCursor();
    }

}