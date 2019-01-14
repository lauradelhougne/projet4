<?php
	require(__DIR__."/../model/episodeModel.php");

	class EpisodeController{

		public function createEpisode(){
			$alert ="";
			if(isset($_POST['title']) && isset($_POST['content']) && ($_POST['title'] !="") && ($_POST['content'] !="")){
				if(empty(trim(htmlspecialchars($_POST['id'])))){
					$episode = new Episode();
					$episode->setTitle(htmlspecialchars($_POST['title']));
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
						
						$newsletter = new MailController();
						$newsletter->newsletter();
						
						header("Location: index.php?action=episodes");
  						exit();
					}

				} else{
					$episode = new Episode();
					$episode->setId(intval(htmlspecialchars($_POST['id'])));
					$episode->setTitle(htmlspecialchars($_POST['title']));
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
			$alert = $getContent->getContentForModify(htmlspecialchars($_GET['id']));

			require(__DIR__."/../view/backend/adminViews/episodesAdmin.php");
		}

		public function moveToTrash(){
			$episode = new Episode();
			$episode->read(htmlspecialchars($_GET['id']));
			$episode->setTrash(true);
			$episode->update();
			header("Location: index.php?action=episodes");
			exit();
			
		}

		public function restore(){
			$episode = new Episode();
			$episode->read(htmlspecialchars($_GET['id']));
			$episode->setTrash(false);
			$episode->update();
			header("Location: index.php?action=trash");
			exit();
		}

		public function delete(){
			$episode = new Episode();
			$episode->delete(htmlspecialchars($_GET['id']));
			header("Location: index.php?action=trash");
			exit();
		}

		public function getEpisodesList(){
			$episodeList = new Episode();
			$episodeList->episodeList();

		}

		public function getEpisodesPagination(){
			$episodeList = new Episode();
			$episodeList->getEpisodesPagination();
		}

		public function getDraftList(){
			$draftList = new Episode;
			$draftList->draftList();
		}

		public function getDraftPagination(){
			$episodeList = new Episode();
			$episodeList->getDraftPagination();
		}

		public function getTrashList(){
			$trashList = new Episode;
			$trashList->trashList();
		}

		public function getTrashPagination(){
			$episodeList = new Episode();
			$episodeList->getTrashPagination();
		}

		public function getEpisodesListFront(){
			$getEpisodesList = new Episode();
			$getEpisodesList->getEpisodesListFront();
		}

		public function getEpisodeFront(){
			$getEpisodes = new Episode();
			$getEpisodes->getEpisodeFront(htmlspecialchars($_GET['id']));
		}

		public function getPrevPost(){
			$prevPost = new Episode();
			$prevPost->getPrevPost(htmlspecialchars($_GET['id']));
		}

		public function getNextPost(){
			$nextPost = new Episode();
			$nextPost->getNextPost(htmlspecialchars($_GET['id']));
		}

	}
?>