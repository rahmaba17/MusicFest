<?PHP
	class comment{
		private $id;
		private $nom;
		private $prenom;
		private $react;
		private $commentair;	
			private $idEvent;


		
		function __construct( $nom,$prenom ,$react,$commentair,$idEvent)
        {
            $this->nom = $nom;
			$this->prenom = $prenom;
			$this->react = $react;
            $this->commentair = $commentair;
			$this->idEvent = $idEvent;



		}
		
		function getID(){
			return $this->id;
		}
		function getIdEvent(){
			return $this->idEvent;
		}
		function getNom(){
			return $this->nom;
		}
		function getPrenom(){
			return $this->prenom;
		}
		
        function getReact(){
			return $this->react;
		}
        function getCommentair(){
			return $this->commentair;
		}
     
		
       
		function setIdEvent($idEvent): voidEvent{
			$this->idEvent=$idEvent;
		}
		function setID($id): void{
			$this->id=$id;
		}
		function setNom($nom): void{
			$this->nom=$nom;
		}
		
        function setPrenom($prenom): void{
			$this->prenom=$prenom;
		}
		function setReact($react): void{
			$this->react=$react;
		}
		function setCommentair($commentair): void{
			$this->commentair=$commentair;
		}
		
		
       
	}

?>