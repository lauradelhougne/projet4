<?php
	require_once("dbModel.php");
	class Comment extends DbModel{
		private $_id;
		private $_idEpisode;
		private $_pseudo;
		private $_comment;
		private $_dateComment;
		private $_approuved;
		private $_undesirable;
		
		public function getId(){
			return $this->id;
		}

		public function setId($id){
			if (is_numeric($id))
		    {
		      $this->id = $id;
		    }
		}

		public function getIdEpisode(){
			return $this->idEpisode;
		}

		public function setIdEpisode($id){
			if (is_numeric($id))
		    {
		      $this->idEpisode = $id;
		    }
		}

		public function getPseudo(){
			return $this->pseudo;
		}

		public function setPseudo($pseudo){
			if (is_string($pseudo))
		    {
		      $this->pseudo = $pseudo;
		    }
		}

		public function getComment(){
			return $this->comment;
		}

		public function setComment($comment){
			if (is_string($comment))
		    {
		      $this->comment = $comment;
		    }
		}

		public function getDateComment(){
			return $this->dateComment;
		}

		public function setDateComment($dateComment){
		      $this->dateComment = $dateComment;
		}

		public function getApprouved(){
			return $this->approuved;
		}

		public function setApprouved($approuved){
			if (is_bool($approuved)) {
   				$this->approuved = $approuved;
			}
		}

		public function getUndesirable(){
			return $this->undesirable;
		}

		public function setUndesirable($undesirable){
			if (is_bool($undesirable)) {
   				$this->undesirable = $undesirable;
			}
		}

		public function read($id){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, id_episode, pseudo, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %H:%i:%s\') AS date_comment, approuved, undesirable FROM comments WHERE id= :id');
			$q->execute(array('id' => $id));
			while ($datas = $q->fetch()){
				$this->setId($id);
				$this->setIdEpisode($datas["id_episode"]);
				$this->setPseudo($datas["pseudo"]);
				$this->setComment($datas["comment"]);
				$this->setDateComment($datas["date_comment"]);
				$this->setApprouved($datas["approuved"]? true : false);
				$this->setUndesirable($datas["undesirable"]? true : false);
			}
			$q->closeCursor();
		}

		public function create(){
			$db = $this->dbConnect();
			$q = $db->prepare('INSERT INTO comments(id_episode, pseudo, comment, date_comment, approuved, undesirable) VALUES(:id_episode, :pseudo, :comment,  NOW(), :approuved, :undesirable)');
			$q->execute(array('id_episode' => $this->idEpisode, 'pseudo' => $this->pseudo, 'comment' => $this->comment, 'approuved' => ($this->approuved)?1:0, 'undesirable' => ($this->undesirable)?1:0));
			$q->closeCursor();
		}

		public function update(){
			if (isset($this->id) && is_numeric($this->id))
			{
				
				$db = $this->dbConnect();
				$q = $db->prepare('UPDATE comments SET pseudo = :pseudo, comment = :comment, approuved = :approuved, undesirable = :undesirable WHERE id= :id');
				$q->execute(array('pseudo' => $this->pseudo, 'comment' => $this->comment, 'approuved' => ($this->approuved)?1:0, 'undesirable' => ($this->undesirable)?1:0, 'id' => $this->id));
				$q->closeCursor();
			}
		}

		public function delete($id){
			$db = $this->dbConnect();
			$q = $db->prepare('DELETE FROM episodes WHERE id= :id ');
			$q->execute(array('id' =>$id));
			$q->closeCursor();
		}

		public function getCommentsListAdmin(){

			$db = $this->dbConnect();
			$q = $db->query('SELECT id, id_episode, pseudo, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %H:%i:%s\') AS date_comment, approuved, undesirable FROM comments WHERE(approuved=0 OR undesirable=1) ORDER BY undesirable DESC, date_comment DESC');

			while ($datas = $q->fetch()){
			?>
				<tr>
					<td><?php echo $datas['date_comment']?></td>
					<td><?php echo $datas['pseudo']?></td>
					<td><?php echo $datas['comment']?></td>
					<td style="text-align: center;"><a href="#">Voir la conversation</a></td>
					<td style="text-align: center;"><?php if(($datas['undesirable']?1:0) == 1){echo "<i class='fas fa-exclamation-triangle' style='color:red;' title='Signalé comme indésirable'></i>";}elseif(($datas['undesirable']?1:0) == 0){echo "<i class='fas fa-exclamation-triangle' style='color:#ddd;'></i>";}?></td>

					<td><a href="index.php?action=approuveComment&id=<?php echo $datas['id']?>">Approuver</a></td>
					<td><a onClick="confirm_click(<?php echo $datas['id']?>);" href="#">Supprimer</a></td>
				</tr>
			<?php
			} 
			$q->closeCursor();

			?><script>
				function confirm_click(id){
					$.confirm({
						title: "Attention !",
					    content: "Etes-vous sûr de vouloir supprimer définitivement ce commentaire ?",
					    buttons: {
					        delete: {
					        	text: "Supprimer",
					            action: function(){location.href = "index.php?action=deleteComment&id="+id;}
					        },
					        annuler: {
					        	text: "Annuler",
					        	action: function(){location.href = "index.php?action=coms";}
					        }

					    }
					});
				}
			
			</script>
			<?php
		}

		public function getCommentsListFront($idEpisode){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, id_episode, pseudo, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y\') AS date_comment, approuved FROM comments WHERE (id_episode= :idEpisode AND approuved =1) ORDER BY id DESC');
			$q->execute(array('idEpisode'=>$idEpisode));

			while ($datas = $q->fetch()){
			?>
				<div class="media mb-4 comment">
			        <div class="media-body">
			          <h5 class="mt-0" style="font-size: 1.5em; color: black;"><?= $datas['pseudo'] ?></h5>
			          <p class="comment"><?= $datas['comment'] ?></p>
			          Posté le <?= $datas['date_comment'] ?> <a class="moderateButton" href="index.php?action=moderateComment&id=<?php echo $datas['id']?>&idEpisode=<?php echo $datas['id_episode']?>">Signaler</a>
			        </div>
			        <hr>
			    </div>
			<?php
			} 
			$q->closeCursor();
		}

	}

?>