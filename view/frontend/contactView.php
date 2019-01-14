<?php 

	$title = "Contact";	

	ob_start();	
?>

<header class="masthead" style="background-image: url('public/img/fjord.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Formulaire de contact</h1>
          <span class="subheading">Contact professionnel uniquement</span>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <p>Pour toute demande ou prise de contact professionnelle, merci de remplir le formulaire ci-dessous :</p>
      
      <form form action="index.php?action=contactForm" method="post" id="contactForm" novalidate>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Nom</label>
            <input type="text" class="form-control inputContact" placeholder="Nom" name="name" id="name">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Entreprise</label>
            <input type="text" class="form-control inputContact" placeholder="Entreprise" name="entreprise" id="entreprise">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>E-mail</label>
            <input type="email" class="form-control inputContact" placeholder="E-mail" name="email" id="email">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group col-xs-12 floating-label-form-group controls">
            <label>Numéro de téléphone</label>
            <input type="tel" class="form-control inputContact" placeholder="Téléphone" name="phone" id="phone">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Message</label>
            <textarea rows="5" class="form-control inputContact" placeholder="Message" name="message" id="message"></textarea>
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <br>
        <div id="success"></div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyer</button>
           <?php if(isset($alert)){echo $alert;}?>
        </div>

        
       
      </form>
    </div>
  </div>
</div>

<hr>

<?php
	$content = ob_get_clean();

  require("footerView.php");
  require("template.php");


?>