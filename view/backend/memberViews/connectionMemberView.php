<?php $title="Connexion";
ob_start();?>

<div class="py-5 bg-dark">
    <h1 class='h1Admin'>Espace membre</h1>
      <div class="container">
        <div class="row">
            <div class="formContainer col-md-5 col-sm-10 col-10" style="text-align: center; margin:auto; padding: 0;">
                <h5 class="card-header">Connexion</h5>
                <div class="card-body">
                    <form action="index.php?action=connect" method="post" class="formMember">

                        <div class="form-group row">
                            <label for="pseudo" class="col-sm-5 col-form-label">Pseudo</label> 
                            <input type="text" name="pseudo" id="pseudo" class=" col-md-6 col-sm-10 col-10"><br>
                        </div>
                        <div class="form-group row">
                            <label for="pass" class="col-sm-5 col-form-label">Mot de passe</label> 
                            <input type="password" name="pass" id="pass" class=" col-md-6 col-sm-10 col-10"><br>
                        </div>  
                            <input type="submit" value="Envoyer" class="send">
                    </form>

                    <?php 
                        if(isset ($alert)){
                            echo $alert;
                        } 
                    ?>
                </div>
            </div>
        </div>
        <p style="color:#fff; text-align: center;">Vous n'êtes pas inscrit? <a href="index.php?action=inscriptionMemberView" style="color:#4be8ef;">Inscrivez-vous !</a></p>
    </div>
</div>

<?php 
$content = ob_get_clean();
require('navView.php');

ob_start();?>

<footer class="py-5 bg-dark">
    <div class="container">
      <p class="col-md-12 sm-12 text-center text-white"><a href="#" style="color: white;  text-decoration: none;">Mentions légales</a></p>
      <p class="col-md-12 sm-12 text-center text-white">Copyright &copy; Tous droits reservés</p>

    <p class="col-md-12 sm-12 text-center text-white"><a href="#" style="color: white; text-decoration: none;">Administration</a></p>
    </div>
</footer>

<?php 
$footer = ob_get_clean();
require('template.php');
?>
