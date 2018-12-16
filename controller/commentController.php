<?php
	require(__DIR__."/../model/commentModel.php");

	class CommentController{

		public function getCommentsList(){
			$getCommentsList = new Comment();
			$getCommentsList->getCommentsList($_GET['id']);
		}

		public function getEpisodesList(){
			$getEpisodesList = new Comment();
			$getEpisodesList->getEpisodesList();
		}

		public function getEpisode(){
			$getEpisodes = new Comment();
			$getEpisodes->getEpisode($_GET['id']);
		}

		public function postComment(){
			$postComment = new Comment;
			$postComment->setIdEpisode(trim($_POST["idEpisode"]));
			$postComment->setPseudo($_COOKIE["pseudo"]);
			$postComment->setComment($_POST["comment"]);
			$postComment->setUndesirable(false);
			$postComment->create();
			header("Location: index.php?action=post&id=".$_POST['idEpisode']);
			exit();
		}

		public function getCommentsListAdmin(){
			$commentsList = new Comment();
			$commentsList->getCommentsListAdmin();
		}

		public function deleteComment(){
			$deleteComment = new Comment();
			$deleteComment->delete($_GET['id']);
		}

		public function approuveComment(){
			$approuveComment = new Comment();
			$approuveComment->update($_GET['id']);
		}
	}
?>