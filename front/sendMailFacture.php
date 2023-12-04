<?php
require('../../controller/AchatC.php');
require('../../controller/mail.php');

$achatC = new AchatC();
if(isset($_GET['idProd']) && isset($_GET['lastId'])){
    $lastId = $_GET['lastId'];
    $achat = new Achat($_GET['idProd'],1);
    $achatC->ajouterAchat($achat);
    $email = "eyanefzi2514@gmail.com";
    $email_content['Subject'] = "Product Invoice";
    $email_content['body'] = "Ceci est un mail automatique contenant votre facture.";
    $invoicePath = 'C:\Users\eya\Downloads\Invoice'.$lastId.'.pdf';
    sendemail($email,$email_content,$invoicePath);
    header('Location: products.php');
}

?>