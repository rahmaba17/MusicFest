<?php
require_once ('C:\xampp\htdocs\gestion produit\config.php');
include('C:\xampp\htdocs\gestion produit\model\Categorie.php');

class CategorieC{
public function afficherCategorie()
{
    $sql="SELECT * FROM categories";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
       $e->getMessage();
    }
}
public function supprimerCategorie($id){
    $sql="DELETE FROM categories WHERE id_cat=:id";
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
public function ajouterCategorie($categorie){
    $sql = "INSERT INTO categories (nom_cat,description)
    VALUES (:nom, :description)";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute([
        'nom'=> $categorie->getNom(),
        'description'=> $categorie->getDescription()
        ]);
    } catch (Exception $e){
        $e->getMessage();
    }
}
public function recupererCategorie($id){
    $sql="SELECT * from categories where id_cat=:id";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->bindValue(':id' , $id);
        $query->execute();
        $categ=$query->fetch();
        return $categ;
    }catch (Exception $e){
        $e->getMessage();
    }
}
public function modifierCategorie($id,$categorie){
    try{
        $db = config::getConnexion();
        $query = $db->prepare('UPDATE categories SET nom_cat = :nom, description = :description WHERE id_cat = :id');
        $query->execute([
            'nom'=> $categorie->getNom(),
            'description'=> $categorie->getDescription(),
            'id'=> $id
        ]);
    } catch (Exception $e){
        $e->getMessage();
}
}
public function joinProduit($id){
    $sql="SELECT * FROM produits INNER JOIN categories on produits.id_cat = categories.id_cat WHERE categories.id_cat = $id";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
        die('Erreur:' . $e->getMessage());
    }
}
}
?>