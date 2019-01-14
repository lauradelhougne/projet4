<?php
	require_once(__DIR__."/../model/mailModel.php");
	require_once(__DIR__."/../model/memberModel.php");

	class MailController{

		public function contactForm(){
			$alert ="";
			if(isset($_POST['name']) && isset($_POST['entreprise']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['message']) && ($_POST['name'] !="") && ($_POST['entreprise'] !="") && ($_POST['email'] !="") && ($_POST['phone'] !="") && ($_POST['message'] !="") ){
				if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['email'])){
					$mail = new Mail();
					$mail->contactForm(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['entreprise']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['phone']), htmlspecialchars($_POST['message']));
					$alert ="Demande envoyée";
					require(__DIR__."/../view/frontend/contactView.php");
				} else{
					$alert ="Adresse mail incorrecte.";
					require(__DIR__."/../view/frontend/contactView.php");
				}
			}else{
				$alert = "Tous les champs doivent être remplis";
				require(__DIR__."/../view/frontend/contactView.php");
			}
		}

		public function newsletter(){
			$getList = new Member();
			$getList->getMembersListNewsletter();
			$getList->getListNewsletter();
			$newsletter = new Mail();
			$newsletter->setTo($getList);
			$newsletter->newsletter($_POST['id']);
			print_r($newsletter->getTo());
		}
	}
?>