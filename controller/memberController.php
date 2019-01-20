<?php
 ob_start();
?>
<?php
	require_once(__DIR__."/../model/memberModel.php");
	require_once(__DIR__."/../model/episodeModel.php");

	class MemberController{

		public function register(){
			
			$inscription = new Member();
			$alert = $inscription->formRegisterIsValid(htmlspecialchars($_POST["pseudo"]), htmlspecialchars($_POST["pass"]), htmlspecialchars($_POST["passConfirm"]), htmlspecialchars($_POST["email"]));
			require(__DIR__."/../view/backend/memberViews/inscriptionMemberView.php");
		}

		public function connect(){
			$connection = new Member();
			$alert = $connection->formConnectIsValid(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST["pass"]));
			
			if($alert !=""){
				require(__DIR__."/../view/backend/memberViews/connectionMemberView.php");
			} else{
				$connection = new Member();
				$alert = $connection->readAdmin(htmlspecialchars($_POST['pseudo']));
				header("Location: index.php");
  						exit();
			}
		}

		public function registerMpAdmin(){
			$mpAdmin = new Member();
			$alert = $mpAdmin->registerMpAdmin(htmlspecialchars($_POST["pass"]), htmlspecialchars($_POST["passConfirm"]));
			require(__DIR__."/../view/backend/securityAdminViews/firstConnect.php");
		}

		public function connectAdmin(){
			$connectAdmin = new Member();
			$alert = $connectAdmin->connectionAdmin($_POST['pass']);
			if($alert !=""){
				require(__DIR__."/../view/backend/securityAdminViews/adminConnection.php");
			} else{
				header("Location: index.php?action=admin");
  				exit();
			}
			
		}

		public function bookmarkNext(){
			$bookmark = new Member();
			$bookmark->bookmarkNext(htmlspecialchars($_GET['id']));

		}

		public function bookmark(){
			
				$bookmark = new Member();
				$bookmark->bookmark(htmlspecialchars($_GET['id']));
			

		}

		public function getBookmark(){
			if(isset($_SESSION['bookmark']) && $_SESSION['bookmark'] == "no"){
				$firstPost = new Episode();
				$firstPost->getFirstPost();
				$id = $firstPost->getId();
				$bookmark = new Member();
				$bookmark->bookmark($id);
			}
				$bookmark = new Member();
				$bookmark->getBookmark();
			
		}

		public function deconnect(){
			$deconnection = new Member();
			$deconnection->deconnect();
			header("Location: index.php");
			exit();
		}

		public function newsletterRegister(){
			$newsletterRegister = new Member();
			$newsletterRegister->newsletterRegister();
			header("Location: index.php");
			exit();
		}

		public function getListNewsletter(){
			$list = new Member();
			$list->getListNewsletter();
		}
	}
?>