<?php
	require(__DIR__."/../model/inscriptionModel.php");
	
	class MemberController{

		public function inscribe(){
			
			$inscription = new Inscription();
			$alert = $inscription->formIsValid($_POST["pseudo"], $_POST["pass"], $_POST["passConfirm"], $_POST["email"]);
			require(__DIR__."/../view/backend/memberViews/inscriptionMemberView.php");
		}

	}
?>