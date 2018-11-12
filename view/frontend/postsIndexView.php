<?php 


	$title = "Index des épisodes";	

	ob_start();	
?>

<!-- Page Header -->
<header class="masthead" style="background-image: url('public/img/mountains.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-md-11 mx-auto">
        <div class="site-heading">
          <h1>INDEX DES EPISODES</h1>
          <span class="subheading">BILLET SIMPLE POUR L'ALASKA</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="post-preview">
        <a href="index.php?action=post">
          <h2 class="post-title">
            EPISODE 3
          </h2>
          <h3 class="post-subtitle">
            Et quoniam inedia gravi adflictabantur, locum petivere Paleas nomine, vergentem in mare, valido muro firmatum, ubi conduntur nunc usque commeatus distribui militibus omne latus Isauriae defendentibus adsueti.
          </h3>
        </a>
        <p class="post-meta">Posté le 8/10/2018</p>
      </div>
      <hr>
      <div class="post-preview">
        <a href="index.php?action=post">
          <h2 class="post-title">
            EPISODE 2
          </h2>
          <h3 class="post-subtitle">
            Et quoniam inedia gravi adflictabantur, locum petivere Paleas nomine, vergentem in mare, valido muro firmatum, ubi conduntur nunc usque commeatus distribui militibus omne latus Isauriae defendentibus adsueti.
          </h3>
        </a>
        <p class="post-meta">Posté le 7/10/2018</p>
      </div>
      <hr>
      <div class="post-preview">
        <a href="index.php?action=post">
          <h2 class="post-title">
            EPISODE 1
          </h2>
          <h3 class="post-subtitle">
            Et quoniam inedia gravi adflictabantur, locum petivere Paleas nomine, vergentem in mare, valido muro firmatum, ubi conduntur nunc usque commeatus distribui militibus omne latus Isauriae defendentibus adsueti.
          </h3>
        </a>
        <p class="post-meta">Posté le 6/10/2018</p>
      </div>
      <hr>
      <!-- Pager -->
      <div class="clearfix">
        <a class="btn btn-primary float-right" href="#">Suite &rarr;</a>
      </div>
    </div>
  </div>
</div>

<hr>

<?php
	$content = ob_get_clean();

  require("footerView.php");
  require("template.php");
?>