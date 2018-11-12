<?php $title = "Acceuil";	?>

<?php ob_start();?>

<header class="masthead" style="background-image: url('public/img/fjord.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-11 mx-auto">
        <div class="site-heading">
          <h1>BILLET SIMPLE POUR L'ALASKA</h1>
          <span class="subheading">Venez découvrir la nouvelle oeuvre de Jean FORTEROCHE</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Page Content -->
<section class="py-5">
  <div class="container">
    <h1 class="indexH1">A propos</h1>
    <p>Et quoniam inedia gravi adflictabantur, locum petivere Paleas nomine, vergentem in mare, valido muro firmatum, ubi conduntur nunc usque commeatus distribui militibus omne latus Isauriae defendentibus adsueti. circumstetere igitur hoc munimentum per triduum et trinoctium et cum neque adclivitas ipsa sine discrimine adiri letali, nec cuniculis quicquam geri posset, nec procederet ullum obsidionale commentum, maesti excedunt postrema vi subigente maiora viribus adgressuri. </p>
  </div>
  <div class="container">
    <h1 class="indexH1">L'auteur</h1>
    <p>Et quoniam inedia gravi adflictabantur, locum petivere Paleas nomine, vergentem in mare, valido muro firmatum, ubi conduntur nunc usque commeatus distribui militibus omne latus Isauriae defendentibus adsueti. circumstetere igitur hoc munimentum per triduum et trinoctium et cum neque adclivitas ipsa sine discrimine adiri letali, nec cuniculis quicquam geri posset, nec procederet ullum obsidionale commentum, maesti excedunt postrema vi subigente maiora viribus adgressuri.</p>
  </div>
</section>

<?php
$content = ob_get_clean();

require("footerView.php");
require("template.php");

?>