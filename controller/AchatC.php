<?php
require_once ('C:\xampp\htdocs\gestion produit metiers\config.php');
include('C:\xampp\htdocs\gestion produit metiers\model\Achat.php');

class AchatC{
public function ajouterAchat($achat){
    $sql = "INSERT INTO achats (id_produit,id_user)
    VALUES (:id_produit, :id_user)";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute([
        'id_produit'=> $achat->getIdProduit(),
        'id_user'=> $achat->getIdUser()
        ]);
    } catch (Exception $e){
        $e->getMessage();
    }
}
public function getLastId(){
    $sql="SELECT * from achats";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute();
        $list=$query->fetchAll();
        return end($list);
    }catch (Exception $e){
        $e->getMessage();
    }
}
public function bestSellingProduct(){
    try {
        $db = config::getConnexion();
        $sql = "SELECT * , COUNT(a.id_produit) AS total FROM achats a
                INNER JOIN produits p ON a.id_produit = p.id
                GROUP BY p.id
                ORDER BY total DESC LIMIT 3";

        $query = $db->prepare($sql);
        $query->execute();
        $list = $query->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
}
?>