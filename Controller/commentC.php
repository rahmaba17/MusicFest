<?PHP
	include_once ("C:/xampp/htdocs/GestionEvent/dbConfig/config.php");
	include ("C:/xampp/htdocs/GestionEvent/Model/comment.php");

	class commentC {
		function ajouterComment($comment){
			 $sql="INSERT INTO comment (nom, prenom, react, commentair, idEvent) 
			 VALUES (:nom , :prenom, :react, :commentair, :idEvent)";
			 $db = new config();
             $conn=$db->getConnexion();
			 try{
				 $query = $conn->prepare($sql);
			 	$query->execute([
				'nom' => $comment->getNom(),
				'prenom' => $comment->getPrenom(),
				'react' => $comment->getReact(),
				'commentair' => $comment->getCommentair(),
				'idEvent' => $comment->getIdEvent()
			]);			
			}
			catch (PDOException $e){
			echo 'Erreur: '.$e->getMessage();
			}
		}
		
		function afficherComment(){
			$sql="SELECT * FROM comment";
			$conn = new config();
            $db=$conn->getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}	
			
		}
		function afficherCommentClient($id){
			$sql = "SELECT * FROM comment WHERE idEvent = :idEvent";
			$conn = new config();
			$db = $conn->getConnexion();
			$req = $db->prepare($sql);
			$req->bindValue(':idEvent', $id);
		
			try {
				$req->execute();
				$liste = $req->fetchAll(PDO::FETCH_ASSOC); // Fetch the data
		
				return $liste;
			} catch (Exception $e) {
				die('Erreur: ' . $e->getMessage());
			}
		}
		


        function supprimerComment($idd){
			$sql="DELETE FROM comment WHERE id= :id";
			$conn = new config();
            $db=$conn->getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id',$idd);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

		function modifierComment($comment, $idToUpdate){
			try {
				$conn = new config();
				$db = $conn->getConnexion();
				$query = $db->prepare(
					"UPDATE comment SET 
						nom = :nom,
						prenom = :prenom,
						react = :react,
						commentair = :commentair
						WHERE id = :id"
				);
		
				// Debugging: Output the SQL query
				echo $query->queryString;
		
				$query->execute([
					'id' => $idToUpdate, // Assuming you have a method like getId() in your commande class
					'nom' => $comment->getNom(),
					'prenom' => $comment->getPrenom(),
					'react' => $comment->getReact(),
					'commentair' => $comment->getCommentair(),
				]);
		
				// Check the priceber of affected rows to see if the update was successful
				echo $query->rowCount() . " records updated successfully <br>";
			} catch (PDOException $e) {
				echo 'Error: ' . $e->getMessage(); // Output or log the error message
			}
		}
		
		function recupererComment($idd){
			$sql = "SELECT * FROM comment WHERE id = :id";
			$conn = new config();
			$db = $conn->getConnexion();
			try {
				$query = $db->prepare($sql);
				$query->bindParam(':id', $idd);
				$query->execute();
		
				$commande = $query->fetch(PDO::FETCH_ASSOC);
				
				return $commande;
			} catch (PDOException $e) {
				die('Error: ' . $e->getMessage());
			}
		}
		

	}

?>