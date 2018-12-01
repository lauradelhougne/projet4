<?php $title="Tableau de bord - Brouillons";
ob_start();?>

<div class="container">
	<div class="row">
		<h1>Brouillons</h1>
		<a href="index.php?action=createEpisodes" class="button" id="creer">Créer</a>
		<a href="index.php?action=episodes" class="button" id="brouillon">Episodes</a>
		<a href="index.php?action=trash" class="button" id="corbeille">Corbeille</a>
	</div>
</div>

<div class="container">            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 15em;">TITRE</th>
        <th>EXTRAIT</th>
        <th style="width: 10em;">REDACTION</th>
        <th>CORBEILLE</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $getList= new AdminController;
        $getList->getDraftList();
      ?>
    </tbody>
  </table>
</div>


<?php 
$content = ob_get_clean();
require(__DIR__."/template.php");
?>
