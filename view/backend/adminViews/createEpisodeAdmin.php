<?php $title="Tableau de bord - Créer épisodes";
ob_start();?>

<div class="container">
	<div class="row">
		<h1>Créer</h1>
		<a href="index.php?action=episodes" class="button" id="creer">Annuler</a>
		<a href="index.php?action=drafts" class="button" id="brouillon">Brouillons</a>
		<a href="index.php?action=trash" class="button" id="corbeille">Corbeille</a>
	</div>
</div>

<div class="container">            
  <form action="index.php?action=createFormEpisode" method="post">

    <label for="title" class="col-form-label" style="margin-bottom: 20px; font-weight: bold;">Titre de l'épisode</label> : 
    <input type="text" name="title" id="title" value="<?php 
      if(isset($_GET['id'])){
        $modif = new Episode;
        $modif->getContentForModify($_GET['id']);
        echo $modif->getTitle();
      } ?>"><?= $alert ?><br>

    <input type="text" name="id" id="idHidden" value="<?php 
      if(isset($_GET['id'])){
        echo $_GET['id'];
      } ?>
    ">

    <textarea name="content" id="textarea"><?php 
      if(isset($_GET['id'])){
        $modif = new Episode;
        $modif->getContentForModify($_GET['id']);
        echo $modif->getContent();
      } ?></textarea>

    <div class="container">
      <div class="row">
        <input type="submit" name="draft" value="Enregistrer le brouillon" id="draft">
        <input type="submit" name="publish" value="Publier" id="publish">
      </div>
    </div>
  </form>
</div>

  <script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
  <script>
  tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css']
});

  </script>

<?php 
$content = ob_get_clean();
require(__DIR__."/template.php");
?>
