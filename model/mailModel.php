<?php
	require_once("dbModel.php");

	class Mail extends DbModel{
		private $_pseudo;
		private $_to;
		private $_subject;
		private $_message;
		private $_from;

		public function getPseudo(){
			return $this->pseudo;
		}

		public function setPseudo($pseudo){
			if (is_string($pseudo))
		    {
		      $this->pseudo = $pseudo;
		    }
		}

		public function getTo(){
			return $this->to;
		}

		public function setTo($to){
			
		      $this->to = $to;
		    
		}

		public function getSubject(){
			return $this->subject;
		}

		public function setSubject($subject){
			if (is_string($subject))
		    {
		      $this->subject = $subject;
		    }
		}

		public function getMessage(){
			return $this->message;
		}

		public function setMessage($message){
			if (is_string($message))
		    {
		      $this->message = $message;
		    }
		}

		public function getFrom(){
			return $this->from;
		}

		public function setFrom($from){
			
		      $this->from = $from;
		    
		}

		public function mailMemberRegister($pseudo, $email){
			$to = $email;
			$subject = '=?UTF-8?B?'.base64_encode("Inscription membre réussie").'?=';
			$message = utf8_decode("<p>Bonjour ".$pseudo.",</p>
						<p>Votre inscription est réussie, et votre compte a été créé! </p>
						<p>A bientot sur notre Blog</p>
						<br>
						<p>Le site 'BILLET SIMPLE POUR L'ALASKA'</p>");
		    
		     $headers = array('From: delhougne.laura@gmail.com',
						     'Reply-To: delhougne.laura@gmail.com',
						     'Cci: delhougne.laura@gmail.com',
							 'MIME-Version: 1.0',
						     'Content-type: text/html; charset=iso-8859-1',
						     'Content-Transfer-Encoding: 8bit');

			mail($to,$subject,$message,implode("\r\n", $headers));
		}

		public function contactForm($name, $entreprise, $email, $phone, $message){
			$to = "delhougne.laura@gmail.com";
			$subject = '=?UTF-8?B?'.base64_encode("Demande de contact").'?=';
			$message = utf8_decode("<p>Bonjour Mr Forteroche,</p><br>
						<p>Vous avez reçu un message :</p>
						<p>Nom : ".$name."</p>
						<p>Entreprise : ".$entreprise."</p>
						<p>Adresse mail : ".$email."</p>
						<p>Telephone : ".$phone."</p>
						<p>Message : ".$message."</p>
						<br>"
						);

			$headers = array('From: ' .$email,
						     'Reply-To: ' .$email,
							 'MIME-Version: 1.0',
						     'Content-type: text/html; charset=iso-8859-1',
						     'Content-Transfer-Encoding: 8bit');

			mail($to,$subject,$message,implode("\r\n", $headers));
		}

		public function newsletter($id){
			$to = $this->getTo();
			$subject = "Newsletter";
			$message = utf8_decode("<p>Bonjour,</p><br>
						<p>Un nouvel épisode vient du roman 'BILLET SIMPLE POUR L'ALASKA' vient d'être publié !</p><br>
						<a href =''>Venez le découvrir !</a>
						<br>"
						);
			$headers = array('From: delhougne.laura@gmail.com',
						     'Reply-To: delhougne.laura@gmail.com',
						     'Cci: delhougne.laura@gmail.com',
							 'MIME-Version: 1.0',
						     'Content-type: text/html; charset=iso-8859-1',
						     'Content-Transfer-Encoding: 8bit');

			mail($to,$subject,$message,implode("\r\n", $headers));
		}

	}

?>


