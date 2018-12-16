<?php
	require_once("dbModel.php");
	class Comment extends DbModel{
		private $_id;
		private $_idEpisode;
		private $_pseudo;
		private $_comment;
		private $_dateComment;
		private $_undesirable;
		private $_approuved;

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

		public function getUndesirable(){
			return $this->undesirable;
		}

		public function setUndesirable($undesirable){
			if (is_bool($undesirable)) {
   				$this->undesirable = $undesirable;
			}
		}

		public function getApprouved(){
			return $this->approuved;
		}

		public function setApprouved($approuved){
			if (is_bool($approuved)) {
   				$this->approuved = $approuved;
			}
		}


		public function create(){
			$db = $this->dbConnect();
			$q = $db->prepare('INSERT INTO comments(id_episode, pseudo, comment, date_comment, undesirable) VALUES(:id_episode, :pseudo, :comment,  NOW(), :undesirable )');
			$q->execute(array('id_episode' => $this->idEpisode, 'pseudo' => $this->pseudo, 'comment' => $this->comment, 'undesirable' => ($this->undesirable)?1:0));
		}

		public function update(){
			echo "ok";
		}

		public function delete($id){
			$db = $this->dbConnect();
			$q = $db->query('DELETE FROM episodes WHERE id= "'.$id.'" ');

		}

		public function getCommentsListAdmin(){

			$db = $this->dbConnect();
			$q = $db->query('SELECT id, id_episode, pseudo, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %H:%i:%s\') AS date_comment, approuved, undesirable FROM comments ORDER BY CASE WHEN undesirable =\'1\' THEN date_comment END DESC');

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

		public function getCommentsList($idEpisode){
			$db = $this->dbConnect();
			$q = $db->query('SELECT id, pseudo, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y\') AS date_comment FROM comments WHERE id_episode= "'.$idEpisode.'" ORDER BY id DESC');

			while ($datas = $q->fetch()){
			?>
				<div class="media mb-4 comment">
			        <div class="media-body">
			          <h5 class="mt-0" style="font-size: 1.5em; color: black;"><?= $datas['pseudo'] ?></h5>
			          <p class="comment"><?= $datas['comment'] ?></p>
			          Posté le <?= $datas['date_comment'] ?> <a class="moderateButton" href="#">Signaler</a>
			        </div>
			        <hr>
			    </div>
			<?php
			} 
			$q->closeCursor();
		}


		public function getEpisodesList(){
			$db = $this->dbConnect();
			$q = $db->query('SELECT id, title, content, DATE_FORMAT(date_create, \'%d/%m/%Y\') AS date_create FROM episodes WHERE (draft=0 AND trash=0) ORDER BY id DESC');

			while ($datas = $q->fetch()){
			?>
				<div class="post-preview">
			        <a href="index.php?action=post&id=<?php echo $datas['id']?>">
			          <h2 class="post-title">
			            <?php echo $datas['title']?>
			          </h2>
			          <h3 class="post-subtitle">
			            <?php echo substr($datas['content'], 0, 200). " ..." ?>
			          </h3>
			        </a>
			        <p class="post-meta">Posté le <?php echo $datas['date_create']?></p>
			    </div>
			    <hr>
			<?php
			} 
			$q->closeCursor();
		}

		public function getEpisode($id){
			$db = $this->dbConnect();
			$q = $db->query('SELECT id, title, content, DATE_FORMAT(date_create, \'%d/%m/%Y\') AS date_create FROM episodes WHERE id= "'.$id.'" ');
			while ($datas = $q->fetch()){?>
				
				<header class="masthead" style="background-image: url('public/img/mountains.jpg')">
				  <div class="overlay"></div>
				  <div class="container">
				    <div class="row">
				      <div class="col-lg-10 col-md-11 mx-auto">
				        <div class="site-heading">
				          <h1><?php echo $datas['title']?></h1>
				          <span class="subheading">BILLET SIMPLE POUR L'ALASKA</span>
				        </div>
				      </div>
				    </div>
				  </div>
				</header>

				<div class="container">

				  <div class="row">

				    <div class="col-lg-11" style="margin: auto;">

				      <p>Publié le <?php echo $datas['date_create']?></p>

				      <hr>

				      <?php echo $datas['content']?>

				      <hr>
			<?php
			}
			$q->closeCursor();
		}

		
	}

?>