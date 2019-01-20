<?php ob_start();?>

<footer class="py-5 bg-dark">
      <div class="container">
        <div class="row">
          
          <div class="card my-4" style="text-align: center; margin:auto;">
            <h5 class="card-header">Newsletter</h5>
            <?php if(isset($_SESSION['isConnect'])){?>
              <div class="card-body">
                <p>Inscrivez-vous et recevez un mail à chaque nouvel épisode publié !</p>
                <form action="index.php?action=newsletterRegister" method="post">
                    <input type="submit" value="S'inscrire" class="btn btn-large" style="margin: 5px;" />
                </form>
              </div>
            <?php
            } else {?>
              <div class="card-body">
                <p>Vous devez être connecté pour vous inscrire à la newsletter</p>
                <p style="text-align: center;"><a href="index.php?action=connectionMemberView" style="text-decoration: none; color: #2ab8be;">SE CONNECTER</a></p>
              </div>
            <?php } ?>

          </div>    
          
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto containerSocialIcons">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f" style="color: #fff"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-instagram" style="color: #fff"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-google-plus" style="color: #fff"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="container">
          <p class="col-md-12 sm-12 text-center text-white"><a href="index.php?action=legalNotice" style="color: white;  text-decoration: none;">Mentions légales</a></p>
          <p class="col-md-12 sm-12 text-center text-white">Copyright &copy; Tous droits reservés</p>

        <p class="col-md-12 sm-12 text-center text-white"><a href="index.php?action=admin" style="color: white; text-decoration: none;">Administration</a></p>
      </div>

    </footer>


<?php 
$footer = ob_get_clean();
?>
