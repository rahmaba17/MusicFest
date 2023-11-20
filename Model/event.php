<?PHP
	class event{
		private $id;
		private $date;
		private $organisateur;
		private $chanteur;
		private $lien;



		
		function __construct(  $date , $organisateur ,$chanteur,$lien)
        {
            $this->date = $date;
            $this->organisateur = $organisateur;
            $this->chanteur = $chanteur;
			$this->lien = $lien;


		}
		
		function getID(){
			return $this->id;
		}
		function getDate(){
			return $this->date;
		}
		function getOrganisateur(){
			return $this->organisateur;
		}
		
        function getChanteur(){
			return $this->chanteur;
		}
		function getLien(){
			return $this->lien;
		}
       
		
		function setID($id): void{
			$this->id=$id;
		}
		function setDate($date): void{
			$this->date=$date;
		}
		
        function setOrganisateur($organisateur): void{
			$this->organisateur=$organisateur;
		}
		function setChanteur($chanteur): void{
			$this->chanteur=$chanteur;
		}
		function setLien($lien): void{
			$this->lien=$lien;
		}
		
       
	}

?>