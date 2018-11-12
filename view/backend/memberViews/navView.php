<?php ob_start();?>

<nav class="navbar navbar-expand-lg navbar-light fixed-top"  id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="index.html">JEAN FORTEROCHE</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=indexView">A propos</a>
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

<?php 
$nav = ob_get_clean();
?>
