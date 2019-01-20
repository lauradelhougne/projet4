<?php $title="Tableau de bord - Corbeille";
ob_start();?>

<div class="container">
	<div class="row">
		<h1>Corbeille</h1>
		<a href="index.php?action=episodes" class="button" id="creer">Retour</a>
	</div>
</div>

<div class="container">            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 15em;">TITRE</th>
        <th>EXTRAIT</th>
        <th style="width: 10em;">REDACTION</th>
        <th>SUPPRIMER</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $getList= new EpisodeController;
        $getList->getTrashListAdmin();
      ?>
    </tbody>
  </table>
   <?php
        $getList->getTrashPagination();
   ?>
</div>


<?php 
$content = ob_get_clean();
require(__DIR__."/template.php");
?>
