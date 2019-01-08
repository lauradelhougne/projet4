<?php $title="Première connexion Admin";
ob_start();?>

<div class="py-5 bg-dark">
    <h1 class='h1Admin'>CONNECTION A LA ZONE D'ADMINISTATION</h1>

    <p style="color:#fff; text-align: center;">Bienvenue <?= htmlspecialchars($_COOKIE["pseudo"])?>,<br>Veuillez choisir un mot de passe pour accéder à l'interface d'administration.</p>

      <div class="container">
        <div class="row">
            <div class="formContainer col-md-6 col-sm-10 col-10" style="text-align: center; margin:auto; padding: 0;">
                <h5 class="card-header">Enregistrez votre mot de passe d'administation</h5>
                <div class="card-body">
                    <form action="index.php?action=registerMpAdmin" method="post" class="formMember">
                        
                        <div class="form-group row">
                            <label for="pass" class="col-sm-6 col-form-label">Mot de passe</label>  <input type="password" name="pass" id="pass" class=" col-md-5 col-sm-10 col-10"><br>
                        </div>
                        <div class="form-group row">
                            <label for="passConfirm" class="col-sm-6 col-form-label">Confirmez le mot de passe</label>  <input type="password" name="passConfirm" id="passConfirm" class=" col-md-5 col-sm-10 col-10"><br>
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
      
    </div>
</div>

<?php 
$content = ob_get_clean();

require(__DIR__."/template.php");
?>
