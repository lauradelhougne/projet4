<?php 

	$title = "Contact";	

	ob_start();	
?>

<!-- Page Header -->
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

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <p>Pour toute demande ou prise de contact professionnelle, merci de remplir le formulaire ci-dessous :</p>
      
      <form name="sentMessage" id="contactForm" novalidate>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Nom</label>
            <input type="text" class="form-control" placeholder="Nom" id="name" required data-validation-required-message="Please enter your name.">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Entreprise</label>
            <input type="text" class="form-control" placeholder="Entreprise" id="name" required data-validation-required-message="Please enter your name.">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>E-mail</label>
            <input type="email" class="form-control" placeholder="E-mail" id="email" required data-validation-required-message="Please enter your email address.">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group col-xs-12 floating-label-form-group controls">
            <label>Numéro de téléphone</label>
            <input type="tel" class="form-control" placeholder="Téléphone" id="phone" required data-validation-required-message="Please enter your phone number.">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Message</label>
            <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <br>
        <div id="success"></div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyer</button>
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