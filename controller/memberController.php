<?php
	require(__DIR__."/../model/inscriptionModel.php");
	require(__DIR__."/../model/connectModel.php");

	class MemberController{

		public function inscribe(){
			
			$inscription = new Inscription();
			$alert = $inscription->formIsValid($_POST["pseudo"], $_POST["pass"], $_POST["passConfirm"], $_POST["email"]);
			require(__DIR__."/../view/backend/memberViews/inscriptionMemberView.php");
		}

		public function connect(){
			$connection = new Connection();
			$alert = $connection->formConnectIsValid($_POST['pseudo'], $_POST["pass"]);
			
			if($alert !=""){
				require(__DIR__."/../view/backend/memberViews/connectionMemberView.php");
			} else{
				require(__DIR__."/../view/frontend/indexView.php");
			}
		}

		public function deconnect(){
			$deconnection = new Connection();
			$deconnection->deconnect();
			require(__DIR__."/../view/frontend/indexView.php");
		}
	}
?>