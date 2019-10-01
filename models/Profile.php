<?php

class Profile {

    private $_id;
    private $_pseudo;
    private $_pass;
    private $_email;
    private $_creation_date_fr;

    /**
     * Constructeur qui hydrate nos instances
     *
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * Hydratation des setters
     *
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    /**
     * Setter Id
     *
     * @param [type] $id
     */
    public function setId($id)
    {
        $id = (int) $id;

        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    /**
     * Setter Pseudo
     *
     * @param [type] $pseudo
     */
    public function setPseudo($pseudo)
    {
        if(is_string($pseudo))
        {
            $this->_pseudo = $pseudo;
        }
    }

    /**
     * Setter Password
     *
     * @param [type] $pass
     */
    public function setPass($pass)
    {
        if(is_string($pass))
        {
            $this->_pass = $pass;
        }
    }

    /**
     * Setter Email
     *
     * @param [type] $email
     */
    public function setEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->_email = $email;
        }
    }

    /**
     * Setter Date d'inscription
     *
     * @param [type] $date
     */
    public function setCreation_date_fr($date)
    {
       
        $this->_creation_date_fr = $date;
       
    }

    /**
     * Getter Id
     *
     * @return $this->_id;
     */
    public function id()
    {
        return $this->_id;
    }

    /**
     * Getter Pseudo
     *
     * @return $this->_pseudo;
     */
    public function pseudo()
    {
        return $this->_pseudo;
    }

    /**
     * Getter Password
     *
     * @return $this->_pass;
     */
    public function pass()
    {
        return $this->_pass;
    }

    /**
     * Getter Email
     *
     * @return $this->_email;
     */
    public function email()
    {
        return $this->_email;
    }

    /**
     * Getter Date d'inscription
     *
     * @return $this->_date_inscription;
     */
    public function dateInscription()
    {
        return $this->_creation_date_fr;
    }




}