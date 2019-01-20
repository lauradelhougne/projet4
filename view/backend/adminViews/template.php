<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="public/css/style.css" rel="stylesheet">
    <link href="public/css/styleAdmin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <link rel="icon" href="public/img/favicon.ico">
  </head>

  <body >

    <nav>
      <nav class="navbar navbar-default navbar-fixed-top">
        <h2 class="navbar-brand" href="#" >TABLEAU DE BORD</h2>
        
        <div class="nav navbar-nav navbar-right flex-row" style="font-weight: bold;">
          <a  href="index.php?action=episodes" style="margin-right: 1em;"<?php if(($_GET['action'] == 'admin') OR ($_GET['action'] == 'episodes') OR ($_GET['action'] == 'drafts') OR ($_GET['action'] == 'trash') OR ($_GET['action'] == 'createEpisodes')){echo "style='color: #31ecff;'";}?> id="articleResp">Episodes</a>
          <a  href="index.php?action=coms" style="margin-right: 1em;" <?php if($_GET['action'] == 'coms'){echo "style='color: #31ecff;'";}?> id="comResp">Commentaires</a>
          <a href="index.php" style="margin-right: 1em;" id="retourResp">Retour</a>
          <a class="deconnect" href="index.php?action=deconnection" title="Déconnexion"><i class="fas fa-power-off" id="off"></i></a>
        </div>
      </nav>
      
    </nav>

    <content>
      <div class="container col-md-12" style="background-color: #343a40;" >
        <div class="row">
          
            <div class="sidebar-wrapper col-md-2">
              <ul class="sidebar-nav">
                <li><a  href="index.php?action=episodes" <?php if(($_GET['action'] == 'admin') OR ($_GET['action'] == 'episodes') OR ($_GET['action'] == 'drafts') OR ($_GET['action'] == 'trash') OR ($_GET['action'] == 'createEpisodes')){echo "style='color: #31ecff;'";}?> id="article"><i class="fas fa-pen-nib"></i>EPISODES</a></li>
                <li><a  href="index.php?action=coms" 
                  <?php if($_GET['action'] == 'coms'){echo "style='color: #31ecff;'";}?> id="com"><i class="fas fa-comment-dots"></i>COMMENTAIRES</a></li>
                <li style="margin-top: 50px;"><a id="retour"  href="index.php"><i class="fas fa-arrow-left"></i>Retour au blog</a></li>
              </ul>
              
            </div>
          
          <div class="content  col-md-10"><?= $content ?></div>
        </div>
      
    </content>

    <footer style="background-color: #343a40; margin: 0; padding: 20px 0 20px;">
      <div class="container">
          <p class="col-md-12 sm-12 text-center "><a href="index.php?action=legalNotice" style="color: #fff;  text-decoration: none;">Mentions légales</a></p>
          <p class="col-md-12 sm-12 text-center " style="color: #fff;">Copyright &copy; Tous droits reservés</p>
      </div>
    </footer>

 
    <script src="public/vendor/jquery/jquery.js"></script>

    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/script.js"></script>
    <script src="public/js/ajax.js"></script>
    <script src="public/js/fr_FR.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>

  </body>

</html>

