<?php
	require(__DIR__."/../model/commentModel.php");

	class CommentController{

		public function getCommentsListFront(){
			$getCommentsList = new Comment();
			$getCommentsList->getCommentsListFront(htmlspecialchars($_GET['id']));
		}

		public function postComment(){
			$postComment = new Comment;
			$postComment->setIdEpisode(trim(htmlspecialchars($_POST["idEpisode"])));
			$postComment->setPseudo(htmlspecialchars($_COOKIE["pseudo"]));
			$postComment->setComment(htmlspecialchars($_POST["comment"]));
			$postComment->setApprouved(false);
			$postComment->setUndesirable(false);
			$postComment->create();
			header("Location: index.php?action=post&id=".htmlspecialchars($_POST['idEpisode']));
			exit();
		}

		public function getCommentsListAdmin(){
			$commentsList = new Comment();
			$commentsList->getCommentsListAdmin();
		}

		public function deleteComment(){
			$deleteComment = new Comment();
			$deleteComment->delete(htmlspecialchars($_GET['id']));
		}

		public function approuveComment(){
			$comment = new Comment();
			$comment->read(htmlspecialchars($_GET['id']));
			$comment->setApprouved(true);
			$comment->setUndesirable(false);
			$comment->update();
			header("Location: index.php?action=coms");
			exit();
		}

		public function moderateComment(){
			$comment = new Comment();
			$comment->read(htmlspecialchars($_GET['id']));
			$comment->setApprouved(false);
			$comment->setUndesirable(true);
			$comment->update();
			header("Location: index.php?action=post&id=".htmlspecialchars($_GET['idEpisode']));
			exit();
		}
	}
?>