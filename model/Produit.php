<?php
class Produit{
    private  $id;
    private  $nom;
    private  $description;
    private  $id_cat;
    private  $id_panier;
    private  $prix;
    private  $image;

    public function __construct($nom,$description, $id_cat, $id_panier, $prix, $image){
        $this->nom=$nom;
        $this->description=$description;
        $this->id_cat=$id_cat;
        $this->id_panier=$id_panier;
        $this->prix=$prix;
        $this->image=$image;
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
    public function getIdCat(){
        return $this->id_cat;
    }
    public function getIdPanier(){
        return $this->id_panier;
    }
    public function getPrix(){
        return $this->prix;
    }
    public function getImage(){
        return $this->image;
    }
}

?>