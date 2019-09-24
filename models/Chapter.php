<?php

class Chapter {

    private $_id;
    private $_title;
    private $_author;
    private $_content;
    private $_creation_date_fr;
    private $_modification_date_fr;

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
     * Setter Title
     *
     * @param [type] $title
     */
    public function setTitle($title)
    {
        if(is_string($title))
        {
            $this->_title = $title;
        }
    }

    /**
     * Setter Author
     *
     * @param [type] $author
     */
    public function setAuthor($author)
    {
        if(is_string($author))
        {
            $this->_author = $author;
        }
    }

    /**
     * Setter Content
     *
     * @param [type] $content
     */
    public function setContent($content)
    {
        if(is_string($content))
        {
            $this->_content = $content;
        }
    }

    /**
     * Setter Date création
     *
     * @param [type] $dateCreation
     */
    public function setCreation_Date_Fr($dateCreation)
    {
        $this->_creation_date_fr = $dateCreation;
    }

    /**
     * Setter Date modification
     *
     * @param [type] $dateModification
     */
    public function setModification_Date_Fr($dateModification)
    {
        $this->_modification_date_fr = $dateModification;
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
     * Getter Title
     *
     * @return $this->_title;
     */
    public function title()
    {
        return $this->_title;
    }

    /**
     * Getter Author
     *
     * @return $this->_author;
     */
    public function author()
    {
        return $this->_author;
    }

    /**
     * Getter Content
     *
     * @return $this->_content;
     */
    public function content()
    {
        return $this->_content;
    }

    /**
     * Getter Date création
     *
     * @return $this->_creation_date_fr;
     */
    public function date()
    {
        return $this->_creation_date_fr;
    }

    /**
     * Getter Date modification
     *
     * @return $this->_modification_date_fr;
     */
    public function dateModification()
    {
        return $this->_modification_date_fr;
    }

}