<?php $title="Tableau de bord - Commentaires";
ob_start();?>

<h1>Commentaires</h1>

<div class="container">            
  <table id="dtBasic" class="table table-bordered " >
    <thead>
      <tr>
      	<th>DATE</th>
        <th>PSEUDO</th>
        <th>COMMENTAIRE</th>
        <th>VOIR</th>
        <th>MODERER</th>
        <th>APPROUVER</th>
        <th>SUPPRIMER</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $getList= new CommentController;
        $getList->getCommentsListAdmin();
      ?>
    </tbody>
  </table>
  <?php
    $getList->getCommentsPagination();
  ?>
</div>


<?php 
$content = ob_get_clean();
require(__DIR__."/template.php");
?>
