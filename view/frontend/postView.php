<?php 
	$title = "Episode";	

	ob_start();	
?>

    <?php
        $getEpisode= new EpisodeController;
        $getEpisode->getEpisodeFront();
    ?>

      <div class="container">
        <div class="row" >
          <div class="prevNextContainer d-flex align-items-center">
            <a href="index.php?action=prevPost&id=<?php echo $_GET['id']?>" id="prev" title="Précédent"><i class="fas fa-chevron-left"></i></a>
            <p>- EPISODE -</p>
            <a href="index.php?action=nextPost&id=<?php echo $_GET['id']?>" id="next" title="Suivant"><i class="fas fa-chevron-right"></i> </a>
          </div>
        </div>
      </div>

      <hr>
    <?php if(isset($_SESSION['isConnect'])){ ?>
      
      <div class="card my-4">
        <h5 class="card-header">Laissez un commentaire</h5>
        <div class="card-body">
          <form action="index.php?action=postComment" onsubmit="return verification()" method="post" id="commentForm">
            <div class="form-group">
              <label style="font-weight: bold;"><?= htmlspecialchars($_COOKIE["pseudo"])?></label>
              <input type="text" name="idEpisode" value="<?php 
                if(isset($_GET['id'])){
                  echo $_GET['id'];
                } ?>
              ">
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="3" placeholder="Message" id="comment" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" >Envoyer</button> <p id="alert"></p>
          </form>
        </div>
      </div>

    <?php }else{ ?>
      <div class="card my-4">
        <h5 class="card-header">Pour laisser un commentaire, <a href="index.php?action=connectionMemberView">connectez-vous</a> !</h5>
      </div>
    <?php } ?>
      <a href id="ancreComs"></a>
      <?php 
        $commentsList = new CommentController;
        $commentsList->getCommentsListFront();
      ?>
      

    </div>

  </div>


</div>


<hr>

<script>
  function verification(){
    if($("#comment").val().trim().length<1){
      $("#alert").text("Veuillez écrire un commentaire avant de cliquer sur envoyer");
      return false;
    } else{
      return true;
      
    }

  }
</script>

<?php
	$content = ob_get_clean();

  require("footerView.php");
  require("template.php");
  
?>