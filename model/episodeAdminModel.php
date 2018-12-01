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
		}

		public function read($id){
			$db = $this->dbConnect();
			$q = $db->query('SELECT id, title, content, draft, trash, DATE_FORMAT(date_modif, \'%d/%m/%Y à %H:%i:%s\') AS date_modif FROM episodes WHERE id= "'.$id.'" ');
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
			}
		}

		public function delete($id){
			$db = $this->dbConnect();
			$q = $db->query('DELETE FROM episodes WHERE id= "'.$id.'" ');
		}

		public function getContentForModify($id){
			$alert ="";
			$db = $this->dbConnect();
			$q = $db->query('SELECT id, title, content FROM episodes WHERE id= "'.$id.'" ');
			while ($datas = $q->fetch()){
				$this->setTitle($datas["title"]);
				$this->setContent($datas["content"]);
			}

			$q->closeCursor();
		}


		public function episodeList(){
			$db = $this->dbConnect();
			$q = $db->query('SELECT id, title, content, DATE_FORMAT(date_create, \'%d/%m/%Y à %H:%i:%s\') AS date_create FROM episodes WHERE (draft=0 AND trash=0) ORDER BY id DESC');

			while ($datas = $q->fetch()){
			?>
				<tr>
					<td><?php echo $datas['title']?></td>
					<td class="tdContent"><?php echo substr($datas['content'], 0, 65). " ..." ?></td>
					<td class="tdDate"><?php echo $datas['date_create']?></td>
					<td><a href="index.php?action=createEpisodes&id=<?php echo $datas['id']?>">Modifier</a></td>
					<td><a href="index.php?action=moveToTrash&id=<?php echo $datas['id']?>">Supprimer</a></td>
				</tr>
			<?php
			} 
			$q->closeCursor();

		}

		public function draftList(){
			$db = $this->dbConnect();
			$q = $db->query('SELECT id, title, content FROM episodes WHERE (draft=1 AND trash=0) ORDER BY id DESC');

			while ($datas = $q->fetch()){
			?>
				<tr>
					<td><?php echo $datas['title']?></td>
					<td class="tdContent"><?php 
						echo substr($datas['content'], 0, 65); 
						if(strlen($datas['content']) >= 65){echo " ...";}?></td>
					<td><a href="index.php?action=createEpisodes&id=<?php echo $datas['id']?>">Continuer de rédiger</a></td>
					<td><a href="index.php?action=moveToTrash&id=<?php echo $datas['id']?>">Supprimer</a></td>
				</tr>
			<?php
			} 
			$q->closeCursor();
		}

		public function trashList(){
			$db = $this->dbConnect();
			$q = $db->query('SELECT id, title, content FROM episodes WHERE trash=1 ORDER BY id DESC');

			while ($datas = $q->fetch()){
			?>
				<tr>
					<td><?php echo $datas['title']?></td>
					<td class="tdContent"><?php 
						echo substr($datas['content'], 0, 65); 
						if(strlen($datas['content']) >= 65)
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
	}

?>