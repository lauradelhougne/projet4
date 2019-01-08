<?php $title="Accès Refusé";
ob_start();?>

<div class="py-5 bg-dark">
    <h1 class='h1Admin'>ACCES REFUSE</h1>

        <p class="accessRefused" style="color:#red; text-align: center;"><i class='fas fa-exclamation-triangle'></i></p><br>

        <p style="color:#fff; text-align: center;">Vous n'êtes pas autorisé à accéder à cette page.</p>
        
    
</div>

<?php 
$content = ob_get_clean();

require('template.php');
?>
