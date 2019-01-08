<?php
	require(__DIR__."/../model/mailModel.php");

	class MailController{
		public function mailMemberRegister($pseudo, $mail){
			$mail = new Mail();
			$mail->setPseudo($pseudo);
			$mail->setTo($mail);
			$mail->mailMemberRegister();
		}
	}
?>