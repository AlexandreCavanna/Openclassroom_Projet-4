<?php

class ProfileManager extends Manager {

    /**
     * Fonction qui récupère un profile en fonction de son id
     *
     * @param [type] $id
     * @return return new Profile($data);
     */
    public function getProfile($id)
    {
        $req = $this->getDb()->prepare('SELECT id, pseudo, email, DATE_FORMAT(date_inscription, \'%d/%m/%Y\') AS creation_date_fr  FROM members WHERE id = ?');
        $req->execute(array($id));
        $data = $req->fetch();
        return new Profile($data);
        $req->closeCursor();
    }

    /**
     * Fonction qui met à jour le pseudo
     *
     * @param [type] $newPseudo
     * @param [type] $id
     */
    public function updatePseudo($newPseudo, $id)
    {
        $req = $this->getDb()->prepare('UPDATE members SET pseudo = ? WHERE id = ?');
        $req->execute(array($newPseudo, $id));
        $req->closeCursor();
    }

    /**
     * Fonction qui met à jour l'email
     *
     * @param [type] $newEmail
     * @param [type] $id
     */
    public function updateEmail($newEmail, $id)
    {
        $req = $this->getDb()->prepare('UPDATE members SET email = ? WHERE id = ?');
        $req->execute(array($newEmail, $id));
        $req->closeCursor();
    }

    /**
     * Fonction qui met à jour le mot de passe
     *
     * @param [type] $newPassword
     * @param [type] $id
     */
    public function updatePassword($newPassword, $id)
    {
        $req = $this->getDb()->prepare('UPDATE members SET pass = ? WHERE id = ?');
        $req->execute(array($newPassword, $id));
        $req->closeCursor();
    }

    /**
     * Fonction qui récupère les membres et leurs rôles
     *
     * @param [type] $id
     * @return $data;
     */
    public function getProfileAndRole($id)
    {
        $req = $this->getDb()->prepare('SELECT * FROM members INNER JOIN roles ON members.role_id = roles.id');
        $req->execute(array($id));
        $data = $req->fetch();
        return $data;
        $req->closeCursor();
    }

}