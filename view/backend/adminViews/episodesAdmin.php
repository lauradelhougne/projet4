<?php $title="Tableau de bord - Episodes";
ob_start();?>

<div class="container">
	<div class="row">
		<h1>Episodes</h1>
		<a href="index.php?action=createEpisodes" class="button" id="creer">Créer</a>
		<a href="index.php?action=drafts" class="button" id="brouillon">Brouillon</a>
		<a href="index.php?action=trash" class="button" id="corbeille">Corbeille</a>
	</div>
</div>

<div class="container">            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 15em;">TITRE</th>
        <th>EXTRAIT</th>
        <th style="width: 10em;">DATE CREATION</th>
        <th>REDACTION</th>
        <th>CORBEILLE</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $getList= new AdminController;
        $getList->getEpisodesList();
      ?>
    </tbody>
  </table>
</div>


<?php 
$content = ob_get_clean();
require(__DIR__."/template.php");
?>
