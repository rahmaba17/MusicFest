<?php
require_once ('C:\xampp\htdocs\gestion produit metiers\config.php');
include('C:\xampp\htdocs\gestion produit metiers\model\Produit.php');

class ProduitC{
public function afficherProduit()
{
    $sql="SELECT * FROM produits";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
       $e->getMessage();
    }
}
public function supprimerProduit($id){
    $sql="DELETE FROM produits WHERE id=:id";
    $db = config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id' , $id);
    try{
        $req->execute();
    }
    catch(Exception $e){
        $e->getMessage();
    }
}
public function ajouterProduit($produit){
    $sql = "INSERT INTO produits (nom,id_cat,prix,image,description,id_panier)
    VALUES (:nom, :id_cat, :prix, :image, :description, :id_panier)";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute([
        'nom'=> $produit->getNom(),
        'id_cat'=> $produit->getIdCat(),
        'prix'=> $produit->getPrix(),
        'image'=> $produit->getImage(),
        'description'=> $produit->getDescription(),
        'id_panier'=> $produit->getIdPanier()
        ]);
    } catch (Exception $e){
        $e->getMessage();
    }
}
public function recupererProduit($id){
    $sql="SELECT * from produits where id=:id";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->bindValue(':id' , $id);
        $query->execute();
        $produit=$query->fetch();
        return $produit;
    }catch (Exception $e){
        $e->getMessage();
    }
}
public function modifierProduit($id,$produit){
    try{
        $db = config::getConnexion();
        $query = $db->prepare('UPDATE produits SET nom = :nom, id_cat = :id_cat, prix = :prix, image = :image, description = :description, id_panier = :id_panier WHERE id = :id');
        $query->execute([
            'nom'=> $produit->getNom(),
            'id_cat'=> $produit->getIdCat(),
            'prix'=> $produit->getPrix(),
            'image'=> $produit->getImage(),
            'description'=> $produit->getDescription(),
            'id_panier'=> $produit->getIdPanier(),
            'id'=> $id
        ]);
    } catch (Exception $e){
        $e->getMessage();
}
}
public function paginationLIMIT($sql)
{
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
}  

public function paginationCOUNTER($sql)
{
    $db = config::getConnexion();
    try {
        $liste = $db->query($sql);
        $row=$liste->fetch(PDO::FETCH_NUM);
        $total=$row[0];
        return $total;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
} 
}
?>