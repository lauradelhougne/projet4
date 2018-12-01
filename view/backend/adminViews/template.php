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
    
  </head>

  <body>

    <nav>
      <nav class="navbar navbar-default navbar-fixed-top">
        <h2 class="navbar-brand" href="#" >TABLEAU DE BORD</h2>
        
        <div class="nav navbar-nav navbar-right">
          <a class="deconnect" href="#" title="Déconnexion"><i class="fas fa-power-off" id="off"></i></a>
        </div>
      </nav>
      
    </nav>

    <content>
      <div class="container col-md-12" >
        <div class="row">
          
            <div class="sidebar-wrapper col-md-2">
              <ul class="sidebar-nav">
                <li><a id="article" href="index.php?action=episodes"><i class="fas fa-pen-nib"></i>EPISODES</a></li>
                <li><a id="com" href="index.php?action=coms"><i class="fas fa-comment-dots"></i>COMMENTAIRES</a></li>
                <li style="margin-top: 50px;"><a id="retour"  href="index.php"><i class="fas fa-arrow-left"></i>Retour au blog</a></li>
              </ul>
              
            </div>
          
          <div class="content  col-md-10"><?= $content ?></div>
        </div>
      
    </content>


    <script src="public/vendor/jquery/jquery.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
  </body>

</html>
