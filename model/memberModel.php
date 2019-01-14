<?php session_start();
	require_once("dbModel.php");
	require(__DIR__."/../model/mailModel.php");
	class Member extends DbModel{
		private $mpAdmin = 0;
		private $listNewsletter;

		public function getMpAdmin(){
			return $this->mpAdmin;
		}

		public function setMpAdmin($mpAdmin){
			if (is_bool($mpAdmin)) {
				$this->mpAdmin = $mpAdmin;
			}
		}

		public function getListNewsletter(){
			return $this->listNewsletter;
		}

		public function setListNewsletter($listNewsletter){
			$this->listNewsletter = $listNewsletter;
		}

		public function formRegisterIsValid($pseudo, $pass, $passConfirm, $email){
			$alert ="";
			if(isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['passConfirm']) && isset($_POST['email']) && ($_POST['pseudo'] !="") && ($_POST['pass'] !="") && ($_POST['passConfirm'] !="") && ($_POST['email'] !="")){
				$db = $this->dbConnect();
				
				$q = $db->prepare('SELECT pseudo FROM members WHERE pseudo =:pseudo');
				$q->execute(array('pseudo'=> $pseudo));
				if($datas = $q->fetch()){
				    $alert = "Ce pseudo est déjà utilisé, veuillez en saisir un autre.";
				} elseif ($pass != $passConfirm){
					$alert = "Les mots de passe saisis doivent être identiques.";
				} elseif (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)){
					$this->register(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['pass']), htmlspecialchars($_POST['email']));
					$mail = new Mail();
					$mail->mailMemberRegister(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['email']));
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
			$q = $db->prepare('INSERT INTO members(pseudo, pass, mail) VALUES(:pseudo, :pass, :email)');
			$q->execute(array('pseudo' => $pseudo, 'pass' => $cryptPass, 'email' => $email));
		}

		
		public function formConnectIsValid($pseudo, $pass){
			$alert ="";
			if(isset($_POST['pseudo']) && isset($_POST['pass']) && ($_POST['pseudo'] !="") && ($_POST['pass'] !="")){
				$db = $this->dbConnect();
				$q = $db->prepare('SELECT id, pseudo, pass, admin, newsletter FROM members WHERE pseudo = :pseudo');
				$q->execute(array('pseudo' => $pseudo));
				
				if($datas = $q->fetch()){
					$passCorrect = password_verify(htmlspecialchars($_POST['pass']), $datas['pass']); 

					if( !$passCorrect){
						$alert = "Mot de passe invalide";

					} else{
						$_SESSION['isConnect'] = "connected";
						setcookie("id",$datas['id']);
						setcookie("pseudo",$datas['pseudo']);
						if(($datas["admin"]? true : false) == true){
							$_SESSION['isAdmin'] = "ok";
						}
						
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

		public function bookmark($id){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, pseudo, id_episode FROM members WHERE id = :id');
				$q->execute(array('id' => $_COOKIE['id']));
				if($datas = $q->fetch()){
					if($datas['id_episode'] < $id){
						$q = $db->prepare('UPDATE members SET id_episode = :id_episode WHERE id= :id');
						$q->execute(array('id_episode' => $id, 'id' => $_COOKIE['id']));
						$q->closeCursor();
					}
				}
		}

		public function bookmarkNext($id){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, pseudo, id_episode FROM members WHERE id = :id');
			$q->execute(array('id' => $_COOKIE['id']));

			$id_episode_q = $db->prepare('SELECT MIN(id) FROM episodes WHERE (id > :id AND draft=0 AND trash=0)');
			$id_episode_q->execute(array('id' => $id));

			if($datas = $q->fetch() && $id_episode_d = $id_episode_q->fetch()){
				if($datas['id_episode'] < $id_episode_d['MIN(id)'])
				{
					$q = $db->prepare('UPDATE members SET id_episode = :id_episode WHERE id= :id');
					$q->execute(array('id_episode' => $id_episode_d['MIN(id)'], 'id' => $_COOKIE['id']));
					$q->closeCursor();
				}
			}
		}

		public function getBookmark(){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, id_episode FROM members WHERE id = :id');
			$q->execute(array('id' => $_COOKIE['id']));
			if($datas = $q->fetch()){
				if(isset($datas['id_episode'])){
					header("Location: index.php?action=post&id=".$datas['id_episode']);
					exit();
					$q->closeCursor();
				} else {
					$db = $this->dbConnect();
					$q = $db->query('SELECT MIN(id) FROM episodes WHERE (draft=0 AND trash=0)');
					$datas = $q->fetch();
					header("Location: index.php?action=post&id=".$datas['id']);
					exit();
					$q->closeCursor();
				}
			}
		}

		public function readAdmin($pseudo){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, idMember, pseudoMember, mpAdmin FROM admin WHERE pseudoMember = :pseudo');
			$q->execute(array('pseudo' => $pseudo));
			if($datas = $q->fetch()){
				if(!empty($datas['mpAdmin'])){
					$_SESSION['registerMpAdmin'] = "ok";
				}
			}
		}

		public function registerMpAdmin($pass, $passConfirm){
			$alert ="";
			if(isset($_POST['pass']) && isset($_POST['passConfirm']) && ($_POST['pass'] !="") && ($_POST['passConfirm'] !="")){
				if ($pass != $passConfirm){
					$alert = "Les mots de passe saisis doivent être identiques.";
				} else{
					$cryptPass = password_hash($pass, PASSWORD_DEFAULT);
					$db = $this->dbConnect();
					$q = $db->prepare('UPDATE admin SET mpAdmin = :mpAdmin WHERE pseudoMember = :pseudo');
					$q->execute(array('mpAdmin' => $cryptPass, "pseudo"=> $_COOKIE['pseudo']));
					$alert="Mot de passe enregistré, <a href='index.php?action=admin'>connectez-vous !</a>" ;
					$_SESSION['registerMpAdmin'] = "ok";
				}
				return $alert;
			}else{
					return "Veuillez remplir tous les champs!";
				}
		}

		public function connectionAdmin($pass){
			$alert ="";
			if(isset($_POST['pass']) && ($_POST['pass'] !="")){
				$db = $this->dbConnect();
				$q = $db->prepare('SELECT id, pseudoMember, mpAdmin FROM admin WHERE pseudoMember = :pseudo');
				$q->execute(array('pseudo' => $_COOKIE['pseudo']));
				
				if($datas = $q->fetch()){
					$passCorrect = password_verify(htmlspecialchars($_POST['pass']), $datas['mpAdmin']); 

					if( !$passCorrect){
						$alert = "Mot de passe invalide";

					} else{
						$_SESSION['adminConnected'] = "ok";
					}

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

		public function getMembersListNewsletter(){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT mail FROM members WHERE (newsletter=1)');
			$q->execute();
			$list = $q->fetchAll();
			$this->setListNewsletter($list);
		}

	}
?>