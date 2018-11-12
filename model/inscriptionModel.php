<?php
	require_once("dbModel.php");
	class Inscription extends DbModel{
		public function formIsValid($pseudo, $pass, $passConfirm, $email){
			$alert ="";
			if(isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['passConfirm']) && isset($_POST['email']) && ($_POST['pseudo'] !="") && ($_POST['pass'] !="") && ($_POST['passConfirm'] !="") && ($_POST['email'] !="")){
				$db = $this->dbConnect();
				
				$q = $db->query('SELECT pseudo FROM membres WHERE pseudo ="' . $pseudo.'"');
				
				if($datas = $q->fetch()){
				    $alert = "Ce pseudo est déjà utilisé, veuillez en saisir un autre.";
				} elseif ($pass != $passConfirm){
					$alert = "Les mots de passe saisis doivent être identiques.";
				} elseif (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)){
					$this->register($_POST['pseudo'], $_POST['pass'], $_POST['email']);
					$alert="Inscription réussie, <a href='index.php?action=connectionMemberView'>connectez-vous !</a>" ;
				} else{
					$alert = "Adresse mail incorrecte.";
				}

				$q->closeCursor();
				
			} else{
				$alert = "Tous les champs doivent être remplis";
			}
			return $alert;
		}

		public function register($pseudo, $pass, $email){
			$db = $this->dbConnect();
			$cryptPass = password_hash($pass, PASSWORD_DEFAULT); 
			$q = $db->prepare('INSERT INTO membres(pseudo, pass, mail) VALUES(:pseudo, :pass, :email)');
			$q->execute(array('pseudo' => $pseudo, 'pass' => $cryptPass, 'email' => $email));
		}

	}
?>