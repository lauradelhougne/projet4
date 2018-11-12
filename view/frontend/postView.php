<?php 
	$title = "Episode";	

	ob_start();	
?>

<!-- Page Header -->
<header class="masthead" style="background-image: url('public/img/mountains.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-md-11 mx-auto">
        <div class="site-heading">
          <h1>EPISODE 1</h1>
          <span class="subheading">BILLET SIMPLE POUR L'ALASKA</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-11" style="margin: auto;">

      <p>Publié le 6/10/2018</p>

      <hr>
      <!-- Post Content -->
      <p >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>

      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>

      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

      <hr>

      <div class="container">
        <div class="row" >
          <div class="prevNextContainer d-flex align-items-center">
            <a href="" id="prev" title="Précédent"><i class="fas fa-chevron-left"></i></a>
            <p>- EPISODE -</p>
            <a href="" id="next" title="Suivant"><i class="fas fa-chevron-right"></i> </a>
          </div>
        </div>
      </div>

      <hr>
      <?php if(isset($_SESSION['isConnect'])){ ?>
      <!-- Comments Form -->
      <div class="card my-4">
        <h5 class="card-header">Laissez un commentaire</h5>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label style="font-weight: bold;"><?=$_COOKIE["pseudo"]?></label>
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="3" placeholder="Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
          </form>
        </div>
      </div>
    <?php }else{ ?>
      <div class="card my-4">
        <h5 class="card-header">Pour laisser un commentaire, <a href="index.php?action=connectionMemberView">connectez-vous</a> !</h5>
      </div>
    <?php } ?>

      <!-- Single Comment -->
      <div class="media mb-4">
        <div class="media-body">
          <h5 class="mt-0">Nom</h5>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        </div>
      </div>

      <div class="media mb-4">
        <div class="media-body">
          <h5 class="mt-0">Nom</h5>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        </div>
      </div>

    </div>

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->

<hr>

<?php
	$content = ob_get_clean();

    require("footerView.php");
  require("template.php");
  
?>