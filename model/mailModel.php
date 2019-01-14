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
			$subject = "Inscription membre réussie";
			$message = "<p>Bonjour <?php echo $pseudo?></p>,<br>
						<p>Votre inscription est réussie, et votre compte a été créé! </p>
						<p>A bientot sur notre Blog</p>
						<br>
						<p>Le site 'BILLET SIMPLE POUR L'ALASKA'</p>";
			 $headers[] = 'MIME-Version: 1.0';
		     $headers[] = 'Content-type: text/html; charset=iso-8859-1';
		    
		     $headers[] = 'From: <delhougne.laura@outlook.fr>';
		     $headers[] = 'Cc: delhougne.laura@outlook.fr';
		     $headers[] = 'Bcc: delhougne.laura@outlook.fr';

			//mail($to,$subject,$message,implode("\r\n", $headers));
		}

		public function contactForm($name, $entreprise, $email, $phone, $message){
			$to = $email;
			$subject = "Demande de contact";
			$message = "<p>Bonjour Mr Forteroche,</p><br>
						<p>Vous avez reçu un message :</p>
						<p>Nom : ".$name."</p>
						<p>Entreprise : ".$entreprise."</p>
						<p>Adresse mail : ".$email."</p>
						<p>Telephone : ".$phone."</p>
						<p>Message : ".$message."</p>
						<br>";
			 $headers[] = 'MIME-Version: 1.0';
		     $headers[] = 'Content-type: text/html; charset=iso-8859-1';
		    
		     $headers[] = 'From: <delhougne.laura@outlook.fr>';
		     $headers[] = 'Cc: delhougne.laura@outlook.fr';
		     $headers[] = 'Bcc: delhougne.laura@outlook.fr';

			//mail($to,$subject,$message,implode("\r\n", $headers));
		}

		public function newsletter($id){
			$to = $this->getTo();
			$subject = "Demande de contact";
			$message = "<p>Bonjour,</p><br>
						<p>Un nouvel épisode vient du roman 'BILLET SIMPLE POUR L'ALASKA' vient d'être publié !</p><br>
						<a href =''>Venez le découvrir !</a>
						<br>";
			 $headers[] = 'MIME-Version: 1.0';
		     $headers[] = 'Content-type: text/html; charset=iso-8859-1';
		     $headers[] = 'From: <delhougne.laura@outlook.fr>';
		     $headers[] = 'Cc: delhougne.laura@outlook.fr';
		     $headers[] = 'Bcc: delhougne.laura@outlook.fr';

		     print_r($to);
			//mail($to,$subject,$message,implode("\r\n", $headers));
		}

	}

?>


