<?php $title="Authentification";
ob_start();?>

<div class="py-5 bg-dark">
    <h1 class='h1Admin'>CONNECTION A LA ZONE D'ADMINISTATION</h1>

        <p style="color:#fff; text-align: center;">VOUS N'ÊTES PAS CONNECTE, VEUILLEZ VOUS IDENTIFIER. <br></p>

       <p style="text-align: center; margin-top: 100px;"><a href="index.php?action=connectionMemberView" style="color:#4be8ef;">Se connecter !</a></p>
</div>

<?php 
$content = ob_get_clean();

require('template.php');
?>
