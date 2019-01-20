<?php ob_start();?>

<footer class="py-5 bg-dark">
      <div class="container">
        <div class="row">
          
          <div class="card my-4" style="text-align: center; margin:auto;">
            <h5 class="card-header">Newsletter</h5>
            <div class="card-body">
              <p>Inscrivez-vous et recevez un mail à chaque nouvel épisode publié !</p>
              <form action="" method="post">
                  <div class="input-prepend">
                      <input type="text" id="" name="" placeholder="votre@email.com">
                  </div>
                  <br />
                  <input type="submit" value="S'inscrire" class="btn btn-large" />
              </form>
            </div>
          </div>    
          
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto" class="containerSocialIcons">
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
