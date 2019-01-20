<?php
	require_once("dbModel.php");
	class Episode extends DbModel{
		private $_id;
		private $_title;
		private $_content;
		private $_dateCreate;
		private $_dateModif;
		private $_draft;
		private $_trash;

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			if (is_numeric($id))
		    {
		      $this->id = $id;
		    }
		}

		public function getTitle(){
			return $this->title;
		}

		public function setTitle($title){
			if (is_string($title))
		    {
		      $this->title = $title;
		    }
		}

		public function getContent(){
			return $this->content;
		}

		public function setContent($content){
			if (is_string($content))
		    {
		      $this->content = $content;
		    }
		}

		public function getDateCreate(){
			return $this->dateCreate;
		}

		public function setDateCreate($dateCreate){
		      $this->dateCreate = $dateCreate;
		}

		public function getDateModif(){
			return $this->dateModif;
		}

		public function setDateModif($dateModif){
		      $this->dateModif = $dateModif;
		}

		public function getDraft(){
			return $this->draft;
		}

		public function setDraft($draft){
			if (is_bool($draft)) {
   				$this->draft = $draft;
			}
		}

		public function getTrash(){
			return $this->trash;
		}

		public function setTrash($trash){
			if (is_bool($trash)) {
   				$this->trash = $trash;
			}
		}

		public function create(){
			$alert="";
			$db = $this->dbConnect();
			$q = $db->prepare('INSERT INTO episodes(title, content, draft, trash, date_create, date_modif) VALUES(:title, :content, :draft, :trash, NOW(), NOW() )');
			$q->execute(array('title' => $this->title, 'content' => $this->content, 'draft' => ($this->draft)?1:0, 'trash' => ($this->trash)?1:0));
			$q->closeCursor();
		}

		public function read($id){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, title, content, draft, trash, DATE_FORMAT(date_modif, \'%d/%m/%Y à %H:%i:%s\') AS date_modif FROM episodes WHERE id=:id');
			$q->execute(array('id' => $id));
			while ($datas = $q->fetch()){
				$this->setId($id);
				$this->setTitle($datas["title"]);
				$this->setContent($datas["content"]);
				$this->setDraft($datas["draft"]? true : false);
				$this->setTrash($datas["trash"]? true : false);
				$this->setDateModif($datas["date_modif"]);
			}
			$q->closeCursor();
		}

		public function update(){
			$alert="";
			if (isset($this->id) && is_numeric($this->id))
			{
				$db = $this->dbConnect();
				$q = $db->prepare('UPDATE episodes SET title = :title, content = :content, draft = :draft, trash= :trash, date_modif = NOW() WHERE id= :id');
				$q->execute(array('title' => $this->title, 'content' => $this->content, 'draft' => ($this->draft)?1:0, 'trash' => ($this->trash)?1:0, 'id' => $this->id));
				$q->closeCursor();
			}
		}

		public function delete($id){
			$db = $this->dbConnect();
			$q = $db->prepare('DELETE FROM episodes WHERE id= :id ;
							DELETE FROM comments WHERE id_episode= :idEpisode ');
			$q->execute(array('id' => $id, 'idEpisode' => $id));
			$q->closeCursor();
		}

		public function getContentForModify($id){
			$alert ="";
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, title, content FROM episodes WHERE id= :id ');
			$q->execute(array('id' => $id));
			while ($datas = $q->fetch()){
				$this->setTitle($datas["title"]);
				$this->setContent($datas["content"]);
			}

			$q->closeCursor();
		}


		public function episodeListAdmin(){
			$db = $this->dbConnect();
			$nbRows = $db->query("SELECT COUNT(*) FROM episodes WHERE (draft=0 AND trash=0) ORDER BY id DESC");
			$result = $nbRows->fetch();
			$count = $result[0];
			$limit = 10;
			if(isset($_GET['page'])){
				$currentPage = intval($_GET['page']);
				if($currentPage>$count){
					$currentPage = $count;
				}
			}else{
				$currentPage = 1;
			}

			$firstRow = ($currentPage - 1) * $limit;

			$q = $db->query('SELECT id, title, content, DATE_FORMAT(date_create, \'%d/%m/%Y à %H:%i:%s\') AS date_create FROM episodes WHERE (draft=0 AND trash=0) ORDER BY id DESC LIMIT ' .$firstRow.', '.$limit. '');

			while ($datas = $q->fetch()){
			?>
				<tr>
					<td><?php echo $datas['title']?></td>
					<td class="tdContent"><?php echo substr($datas['content'], 0, 100). " ..." ?></td>
					<td class="tdDate"><?php echo $datas['date_create']?></td>
					<td><a href="index.php?action=createEpisodes&id=<?php echo $datas['id']?>">Modifier</a></td>
					<td><a href="index.php?action=moveToTrash&id=<?php echo $datas['id']?>">Corbeille</a></td>
				</tr>
			<?php
			} 
			$q->closeCursor();

		}

		public function getEpisodesPagination(){
			$db = $this->dbConnect();
			$nbRows = $db->query("SELECT COUNT(*) FROM episodes WHERE (draft=0 AND trash=0) ORDER BY id DESC");
			$result = $nbRows->fetch();
			$count = $result[0];  
			$limit = 10;
			$total_pages = ceil($count / $limit);

			if(isset($_GET['page'])){
				$currentPage = intval($_GET['page']);
				if($currentPage>$count){
					$currentPage = $count;
				}
			}else{
				$currentPage = 1;
			}

			echo '<p class="pagination"> Page(s) : ';

			for($i = 1; $i <= $total_pages; $i++){
				if ($i == $currentPage){
					echo '['.$i.'] ';
				}else{
					echo '<a href="index.php?action=episodes&page='.$i.'" style="margin-left: 0.2em;">' .$i. '</a> ';
				}
			}
			echo '</p>';
			$nbRows->closeCursor();
		}

		public function draftListAdmin(){
			$db = $this->dbConnect();
			$nbRows = $db->query("SELECT COUNT(*) FROM episodes WHERE (draft=1 AND trash=0) ORDER BY id DESC");
			$result = $nbRows->fetch();
			$count = $result[0]; 
			$limit = 10;

			if(isset($_GET['page'])){
				$currentPage = intval($_GET['page']);
				if($currentPage>$count){
					$currentPage = $count;
				}
			}else{
				$currentPage = 1;
			}

			$firstRow = ($currentPage - 1) * $limit;

			$q = $db->query('SELECT id, title, content FROM episodes WHERE (draft=1 AND trash=0) ORDER BY id DESC LIMIT ' .$firstRow.', '.$limit. '');

			while ($datas = $q->fetch()){
			?>
				<tr>
					<td><?php echo $datas['title']?></td>
					<td class="tdContent"><?php 
						echo substr($datas['content'], 0, 100); 
						if(strlen($datas['content']) >= 100){echo " ...";}?></td>
					<td><a href="index.php?action=createEpisodes&id=<?php echo $datas['id']?>">Continuer de rédiger</a></td>
					<td><a href="index.php?action=moveToTrash&id=<?php echo $datas['id']?>">Supprimer</a></td>
				</tr>
			<?php
			} 
			$q->closeCursor();

			
		}

		public function getDraftPagination(){
			$db = $this->dbConnect();
			$nbRows = $db->query("SELECT COUNT(*) FROM episodes WHERE (draft=1 AND trash=0) ORDER BY id DESC");
			$result = $nbRows->fetch();
			$count = $result[0];  
			$limit = 10;
			$total_pages = ceil($count / $limit);

			if(isset($_GET['page'])){
				$currentPage = intval($_GET['page']);
				if($currentPage>$count){
					$currentPage = $count;
				}
			}else{
				$currentPage = 1;
			}

			echo '<p class="pagination"> Page(s) : ';

			for($i = 1; $i <= $total_pages; $i++){
				if ($i == $currentPage){
					echo '['.$i.'] ';
				}else{
					echo '<a href="index.php?action=drafts&page='.$i.'" style="margin-left: 0.2em;">'.$i.'</a>';
				}
			}
			echo '</p>';
			$nbRows->closeCursor();
		}

		public function trashListAdmin(){
			$db = $this->dbConnect();
			$nbRows = $db->query("SELECT COUNT(*) FROM episodes WHERE trash=1 ORDER BY id DESC");
			$result = $nbRows->fetch();
			$count = $result[0]; 
			$limit = 10;

			if(isset($_GET['page'])){
				$currentPage = intval($_GET['page']);
				if($currentPage>$count){
					$currentPage = $count;
				}
			}else{
				$currentPage = 1;
			}

			$firstRow = ($currentPage - 1) * $limit;
			
			$q = $db->query('SELECT id, title, content FROM episodes WHERE trash=1 ORDER BY id DESC LIMIT ' .$firstRow.', '.$limit. '');

			while ($datas = $q->fetch()){
			?>
				<tr>
					<td><?php echo $datas['title']?></td>
					<td class="tdContent"><?php 
						echo substr($datas['content'], 0, 100); 
						if(strlen($datas['content']) >= 100)
							{
								echo " ...";
							}?></td>
					<td><a href="index.php?action=restore&id=<?php echo $datas['id']?>">Restaurer</a></td>
					<td><a class="deleteConfirm" onClick="confirm_click(<?php echo $datas['id']?>);" href="#">Supprimer definitivement</a></td>

				</tr>

			<?php
			
			} 
			$q->closeCursor();

			?><script>
				function confirm_click(id){
					$.confirm({
						title: "Attention !",
					    content: "Etes-vous sûr de vouloir supprimer définitivement cet épisode ?",
					    buttons: {
					        delete: {
					        	text: "Supprimer",
					            action: function(){location.href = "index.php?action=delete&id="+id;}
					        },
					        annuler: {
					        	text: "Annuler",
					        	action: function(){location.href = "index.php?action=trash";}
					        }

					    }
					});
				}
			</script>
			<?php
		}

		public function getTrashPagination(){
			$db = $this->dbConnect();
			$nbRows = $db->query("SELECT COUNT(*) FROM episodes WHERE trash=1 ORDER BY id DESC");
			$result = $nbRows->fetch();
			$count = $result[0];  
			$limit = 10;
			$total_pages = ceil($count / $limit);

			if(isset($_GET['page'])){
				$currentPage = intval($_GET['page']);
				if($currentPage>$count){
					$currentPage = $count;
				}
			}else{
				$currentPage = 1;
			}

			echo '<p class="pagination"> Page(s) : ';

			for($i = 1; $i <= $total_pages; $i++){
				if ($i == $currentPage){
					echo '['.$i.'] ';
				}else{
					echo '<a href="index.php?action=trash&page='.$i.'" style="margin-left: 0.2em;">'.$i.'</a> ';
				}
			}
			echo '</p>';
			$nbRows->closeCursor();
		}

		public function getEpisodesListFront(){
			$db = $this->dbConnect();
			$nbRows = $db->query("SELECT COUNT(*) FROM episodes WHERE (draft=0 AND trash=0) "); 
			$result = $nbRows->fetch();
			$count = $result[0];  
			$limit = 5;
			
			$total_pages = ceil($count / $limit);

			if(isset($_GET['page'])){
				$currentPage = intval($_GET['page']);
				if($currentPage>$count){
					$currentPage = $count;
				}
			}else{
				$currentPage = 1;
			}

			$firstRow = ($currentPage - 1) * $limit;

			$q = $db->query('SELECT id, title, content, DATE_FORMAT(date_create, \'%d/%m/%Y\') AS date_create FROM episodes WHERE (draft=0 AND trash=0) ORDER BY id DESC LIMIT ' .$firstRow.', '.$limit. '');

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

			echo '<p class="pagination"> Page(s) : ';

			for($i = 1; $i <= $total_pages; $i++){
				if ($i == $currentPage){
					echo '['.$i.'] ';
				}else{
					echo '<a href="index.php?action=postsIndexView&page='.$i.'" style="margin-left: 0.2em;">' .$i. '</a> ';
				}
			}
			echo '</p>';
		}

		public function getEpisodeFront($id){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_create, \'%d/%m/%Y\') AS date_create FROM episodes WHERE id= :id');
			$q->execute(array('id' => $id));
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

		public function getPrevPost($id){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT * FROM episodes where id IN (SELECT MAX(id) FROM episodes WHERE (id < :id AND draft=0 AND trash=0))');
			$q->execute(array('id' => $id));
			if($datas = $q->fetch()){
				header("Location: index.php?action=post&id=".$datas['id']);
				exit();
			} else{
				header("Location: index.php?action=post&id=". $id);
				exit();
			}
		}

		public function getNextPost($id){
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT * FROM episodes where id IN (SELECT MIN(id) FROM episodes WHERE (id > :id AND draft=0 AND trash=0))');
			$q->execute(array('id' => $id));
			if($datas = $q->fetch()){
				header("Location: index.php?action=post&id=".$datas['id']);
				exit();
			} else{
				header("Location: index.php?action=post&id=". $id);
				exit();
			}
		}

		public function getFirstPost(){
			$db = $this->dbConnect();
			$q = $db->query('SELECT * FROM episodes WHERE (draft=0 AND trash=0) ORDER BY id ASC');
			$datas = $q->fetch();
			$this->setId($datas['id']);
			
		}
	}

?>