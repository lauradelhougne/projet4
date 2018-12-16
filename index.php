<?php
require("controller/memberController.php");
require("controller/adminController.php");
require("controller/commentController.php");

if(isset($_GET['action'])){
	if($_GET['action'] == "indexView"){
		require('view/frontend/indexView.php');
	}
	elseif($_GET['action'] == "postsIndexView"){
		require('view/frontend/postsIndexView.php');
	}

	elseif($_GET['action'] == "contactView"){
		require('view/frontend/contactView.php');
	}
	elseif($_GET['action'] == "connectionMemberView"){
		require('view/backend/memberViews/connectionMemberView.php');
	}
	elseif($_GET['action'] == "inscriptionMemberView"){
		require('view/backend/memberViews/inscriptionMemberView.php');
	}
	elseif($_GET['action'] == "post"){
		require('view/frontend/postView.php');
	}

	elseif($_GET['action'] == "inscribe"){
		$memberController = new MemberController();
		$memberController->inscribe();
	}

	elseif($_GET['action'] == "connect"){
		$memberController = new MemberController();
		$memberController->connect();
	}

	elseif($_GET['action'] == "deconnection"){
		$memberController = new MemberController();
		$memberController->deconnect();
	}



	elseif($_GET['action'] == "admin"){
		require('view/backend/adminViews/episodesAdmin.php');
	}

	elseif($_GET['action'] == "episodes"){
		require('view/backend/adminViews/episodesAdmin.php');
	}

	elseif($_GET['action'] == "drafts"){
		require('view/backend/adminViews/draftsAdmin.php');
	}

	elseif($_GET['action'] == "trash"){
		require('view/backend/adminViews/trashAdmin.php');
	}

	elseif($_GET['action'] == "createEpisodes"){
		$alert = "";
		require('view/backend/adminViews/createEpisodeAdmin.php');
	}

	elseif($_GET['action'] == "createFormEpisode"){

		$adminController = new AdminController();
		$adminController->createEpisode();
	}

	elseif($_GET['action'] == "moveToTrash"){

		$adminController = new AdminController();
		$adminController->moveToTrash();
	}

	elseif($_GET['action'] == "restore"){

		$adminController = new AdminController();
		$adminController->restore();
	}

	elseif($_GET['action'] == "delete"){

		$adminController = new AdminController();
		$adminController->delete();
	}

	elseif($_GET['action'] == "coms"){
		require('view/backend/adminViews/comsAdmin.php');
	}

	elseif($_GET['action'] == "postComment"){
		$frontController = new CommentController();
		$frontController->postComment();
	}

	elseif($_GET['action'] == "approuveComment"){

		$commentController = new commentController();
		$commentController->approuveComment();
	}

	elseif($_GET['action'] == "deleteComment"){

		$commentController = new commentController();
		$commentController->deleteComment();
	}

} else{
	require('view/frontend/indexView.php');
}

?>

