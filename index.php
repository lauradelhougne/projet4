<?php
require("controller/memberController.php");
require("controller/episodeController.php");
require("controller/commentController.php");
require("controller/mailController.php");

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

	elseif($_GET['action'] == "inscribe"){
		$memberController = new MemberController();
		$memberController->inscribe();
	}

	elseif($_GET['action'] == "connect" && empty($_SESSION['isAdmin'])){
		$memberController = new MemberController();
		$memberController->connect();
	}


	elseif($_GET['action'] == "deconnection"){
		$memberController = new MemberController();
		$memberController->deconnect();
	}

	elseif($_GET['action'] == "bookmark"){
		$bookmark= new MemberController();
		$bookmark->bookmark();
	}

	elseif($_GET['action'] == "getBookmark"){
		$bookmark= new MemberController();
		$bookmark->getBookmark();
	}
	
	elseif($_GET['action'] == "post"){
		if(isset($_COOKIE['id'])){
			$bookmark= new MemberController();
			$bookmark->bookmark();
			}
		require('view/frontend/postView.php');
	}

	elseif($_GET['action'] == "moderateComment"){

		$commentController = new CommentController();
		$commentController->moderateComment();
	}

	elseif($_GET['action'] == "prevPost"){
		$prevPost= new EpisodeController();
		$prevPost->getPrevPost();
		
	}

	elseif($_GET['action'] == "nextPost"){
		$bookmark= new MemberController();
		$bookmark->bookmarkNext();
		$nextPost= new EpisodeController();
		$nextPost->getNextPost();
	}

	elseif($_GET['action'] == "contactForm"){
		$contactForm= new MailController();
		$contactForm->contactForm();
		
	}
	elseif(($_GET['action'] == "admin")&&(!isset($_SESSION['isConnect']))){
		require('view/backend/securityAdminViews/notConnected.php');
	}

	elseif( ($_GET['action'] == "admin") && (isset($_SESSION['isConnect'])) && (empty($_SESSION['isAdmin'])) ){
		require('view/backend/securityAdminViews/accessRefused.php');
	}

	elseif(($_GET['action'] == "admin") && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 'ok' && (empty($_SESSION['registerMpAdmin']))){
		require('view/backend/securityAdminViews/firstConnect.php');
	}

	elseif(($_GET['action'] == "registerMpAdmin") && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 'ok' && (empty($_SESSION['registerMpAdmin']))){
		$mpAdmin= new MemberController();
		$mpAdmin->registerMpAdmin();

	}

	elseif(($_GET['action'] == "admin") && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 'ok' && $_SESSION['registerMpAdmin'] == "ok" && empty($_SESSION['adminConnected']) ){
		require('view/backend/securityAdminViews/adminConnection.php');
	}

	elseif(($_GET['action'] == "adminConnected") && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 'ok' && $_SESSION['registerMpAdmin'] == "ok" && empty($_SESSION['adminConnected']) ){
		$connectAdmin= new MemberController();
		$connectAdmin->connectAdmin();
	}
	
	elseif(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 'ok' && $_SESSION['registerMpAdmin'] == "ok" && $_SESSION['adminConnected'] == "ok"){


		if($_GET['action'] == "admin"){
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

			$adminController = new EpisodeController();
			$adminController->createEpisode();
		}

		elseif($_GET['action'] == "moveToTrash"){

			$adminController = new EpisodeController();
			$adminController->moveToTrash();
		}

		elseif($_GET['action'] == "restore"){

			$adminController = new EpisodeController();
			$adminController->restore();
		}

		elseif($_GET['action'] == "delete"){

			$adminController = new EpisodeController();
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

			$commentController = new CommentController();
			$commentController->approuveComment();
		}

		elseif($_GET['action'] == "deleteComment"){

			$commentController = new CommentController();
			$commentController->deleteComment();
		}
	} else {
		require ('view/backend/securityAdminViews/404.php');
	}
}else{
	require('view/frontend/indexView.php');
}

?>