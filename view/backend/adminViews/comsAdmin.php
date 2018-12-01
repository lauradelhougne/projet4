<?php $title="Tableau de bord - Commentaires";
ob_start();?>

<h1>Commentaires</h1>

<?php 
$content = ob_get_clean();
require(__DIR__."/template.php");
?>
