<?php

class AuthenticationManager extends Manager {

    /**
     * Fonction qui fait une jointure avec la table des rôles et récupère les informations d'un utilisateur
     *
     * @param [type] $emailConnect
     * @return $checkUser
     */
    public function checkUser($emailConnect)
    {
        $req = $this->getDb()->prepare(
            'SELECT *
            FROM members 
            INNER JOIN roles 
            ON members.role_id = roles.id_role 
            WHERE email = :email'
        );
        $req->execute(array(
            'email' => $emailConnect
        ));
        $checkUser = $req->fetch(PDO::FETCH_ASSOC);
        return $checkUser;
    }

}