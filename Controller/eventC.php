<?PHP
	
	include_once ("C:/xampp/htdocs/GestionEvent/dbConfig/config.php");
	include ("C:/xampp/htdocs/GestionEvent/Model/event.php");

	class eventC {
		function ajouterEvent($event){
			 $sql="INSERT INTO event (date, organisateur, chanteur,lien) 
			 VALUES (:date ,:organisateur, :chanteur, :lien)";
			 $db = new config();
             $conn=$db->getConnexion();
			 try{
			 	$query = $conn->prepare($sql);
			 	$query->execute([
					'date' => $event->getDate(),
				'organisateur' => $event->getOrganisateur(),
				'chanteur' => $event->getChanteur(),
				'lien' => $event->getLien()

			]);			
			}
			catch (Exception $e){
			echo 'Erreur: '.$e->getMessage();
			}
		}
		
		function afficherEvent(){
			$sql="SELECT * FROM event";
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


        function supprimerEvent($idd){
			$sql="DELETE FROM event WHERE id= :id";
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

		function modifierEvent($event, $idToUpdate){
			try {
				$conn = new config();
				$db = $conn->getConnexion();
				$query = $db->prepare(
					"UPDATE event SET 
						date = :date,
						organisateur = :organisateur,
						chanteur = :chanteur,
						lien = :lien

						WHERE id = :id"
				);
		
				// Debugging: Output the SQL query
				echo $query->queryString;
		
				$query->execute([
					'id' => $idToUpdate, // Assuming you have a method like getId() in your commande class
					'date' => $event->getDate(),
					'organisateur' => $event->getOrganisateur(),
					'chanteur' => $event->getChanteur(),
					'lien' => $event->getLien()
				]);
		
				// Check the number of affected rows to see if the update was successful
				echo $query->rowCount() . " records updated successfully <br>";
			} catch (PDOException $e) {
				echo 'Error: ' . $e->getMessage(); // Output or log the error message
			}
		}
		
		function recupererEvent($idd){
			$sql = "SELECT * FROM event WHERE id = :id";
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