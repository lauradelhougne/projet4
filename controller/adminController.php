<?php
	require(__DIR__."/../model/episodeAdminModel.php");

	class AdminController{

		public function createEpisode(){
			$alert ="";
			if(isset($_POST['title']) && isset($_POST['content']) && ($_POST['title'] !="") && ($_POST['content'] !="")){
				if(empty(trim($_POST['id']))){
					$episode = new Episode();
					$episode->setTitle($_POST['title']);
					$episode->setContent($_POST['content']);
					$episode->setTrash(false);
					if(isset($_POST['draft'])){
						$episode->setDraft(true);
						$episode->create();
						header("Location: index.php?action=drafts");
  						exit();
						
					} elseif(isset($_POST['publish'])){
						$episode->setDraft(false);
						$episode->create();
						header("Location: index.php?action=episodes");
  						exit();
					}

				} else{
					$episode = new Episode();
					$episode->setId(intval($_POST['id']));
					$episode->setTitle($_POST['title']);
					$episode->setContent($_POST['content']);
					$episode->setTrash(false);
					if(isset($_POST['draft'])){
						$episode->setDraft(true);
						$episode->update();
						header("Location: index.php?action=drafts");
  						exit();
					} elseif(isset($_POST['publish'])){
						$episode->setDraft(false);
						$episode->update();
						header("Location: index.php?action=episodes");
  						exit();
					}
				}
				
			} else{
				$alert = "Tous les champs doivent être remplis";
				require(__DIR__."/../view/backend/adminViews/createEpisodeAdmin.php");
			}
		}

		public function getContentForModify(){
			$getContent = new Episode();
			$alert = $getContent->getContentForModify($_GET['id']);
			require(__DIR__."/../view/backend/adminViews/episodesAdmin.php");
		}

		public function moveToTrash(){
			$episode = new Episode();
			$episode->read($_GET['id']);
			$episode->setTrash(true);
			$episode->update();
			require(__DIR__."/../view/backend/adminViews/trashAdmin.php");
		}

		public function restore(){
			$episode = new Episode();
			$episode->read($_GET['id']);
			$episode->setTrash(false);
			$episode->update();
			require(__DIR__."/../view/backend/adminViews/trashAdmin.php");
		}

		public function delete(){
			$episode = new Episode();
			$episode->delete($_GET['id']);
			require(__DIR__."/../view/backend/adminViews/trashAdmin.php");
		}

		public function getEpisodesList(){
			$episodeList = new Episode();
			$episodeList->episodeList();
		}

		public function getDraftList(){
			$draftList = new Episode;
			$draftList->draftList();
		}

		public function getTrashList(){
			$trashList = new Episode;
			$trashList->trashList();
		}
	}
?>