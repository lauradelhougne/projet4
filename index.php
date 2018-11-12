<?php
require("controller/memberController.php");

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

} else{
	require('view/frontend/indexView.php');
}

?>
