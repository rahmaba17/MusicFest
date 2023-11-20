<?php
class Categorie{
    private  $id;
    private  $nom;
    private  $description;

    public function __construct($nom,$description){
        $this->nom=$nom;
        $this->description=$description;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getDescription(){
        return $this->description;
    }
}

?>