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
    <link rel="icon" href="public/img/favicon.ico">
  </head>

  <body>

    <?php
        if(isset($_SESSION['isConnect'])){ ?>
          <nav class="navbar navbar-expand-lg navbar-light fixed-top"  id="mainNav">
          <div class="container">
            <a class="navbar-brand" href="index.php?action=indexView">JEAN FORTEROCHE</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              Menu
              <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=indexView#about">A propos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=postsIndexView">Episodes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=contactView">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=getBookmark" title="Dernier épisode lu">Marque-page</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=deconnection">Deconnexion</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <?php
        } else {?>
            <nav class="navbar navbar-expand-lg navbar-light fixed-top"  id="mainNav">
              <div class="container">
                <a class="navbar-brand" href="index.php?action=indexView">JEAN FORTEROCHE</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  Menu
                  <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="index.php?action=indexView#about">A propos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.php?action=postsIndexView">Episodes</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.php?action=contactView">Contact</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.php?action=connectionMemberView">Se connecter</a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
        <?php } ?>

    <?= $content ?>

    <?= $footer ?>

    
    <script src="public/vendor/jquery/jquery.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/script.js"></script>
    <script src="public/js/ajax.js"></script>

  </body>

</html>
