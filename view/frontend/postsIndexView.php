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

      <?php
        $getList= new CommentController;
        $getList->getEpisodesList();
      ?>

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