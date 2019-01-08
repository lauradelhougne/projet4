<?php $title="Accès Refusé";
ob_start();?>

<div class="py-5 bg-dark">
    <h1 class='h1Admin'>CONNECTION A LA ZONE D'ADMINISTATION</h1>

        <p class="accessRefused" style="color:#red; text-align: center;">ACCES REFUSE</p><br>

        <p style="color:#fff; text-align: center;">Bonjour <?= htmlspecialchars($_COOKIE["pseudo"])?>,<br>Vous n'êtes pas autorisé à accéder à l'interface d'administration.</p>
        
    
</div>

<?php 
$content = ob_get_clean();

require('template.php');
?>
