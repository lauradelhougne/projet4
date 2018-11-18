<?php session_start();
	require_once("dbModel.php");
	class Connection extends DbModel{
		private $isConnect = 0;

		public function getIsConnect(){
			return $this->isConnect;
		}

		public function setIsConnect($isConnect){
			$this->isConnect = $isConnect;
		}
		public function formConnectIsValid($pseudo, $pass){
			$alert ="";
			if(isset($_POST['pseudo']) && isset($_POST['pass']) && ($_POST['pseudo'] !="") && ($_POST['pass'] !="")){
				$db = $this->dbConnect();
				$q = $db->query('SELECT id, pseudo, pass FROM membres WHERE pseudo ="' . $pseudo.'"');
				
				if($datas = $q->fetch()){
					$passCorrect = password_verify($_POST['pass'], $datas['pass']); 

					if( !$passCorrect){
						$alert = "Mot de passe invalide";

					} else{
						$isConnect = $this->setIsConnect(1);

						
						$_SESSION['isConnect'] = "connected";
						setcookie("id",$datas['id']);
						setcookie("pseudo",$datas['pseudo']);
					}

				} else{
					$alert = "Ce pseudo n'existe pas, veuillez vous inscrire avant de vous connecter";
				}

				$q->closeCursor();
				return $alert;
			}else{
					return "Veuillez remplir tous les champs!";
				}

		}

		public function deconnect(){
			session_destroy();
			foreach($_COOKIE as $cookie_nom=>$cookie_valeur){
				setcookie($cookie_nom);
				unset($_COOKIE[$cookie_nom]);
			}

		}
	}
?>