<?php 
  $activeMenu = 1; 
  $bodyClass = "about"; 
  include 'includes/header.php';
  include 'includes/nav.php';
?> 
<main>
  <div class="container">
    <h2>ACERCA DE <span>DYNAMO</span></h2>
    <?=$acercaDe?>
  </div>
  <div class="trailer">
    <div class="container">
      <a
      data-fancybox 
      data-type="video" 
      href="<?=$sdk->infoGnrl->field_link_reel?>"
        id="play"
        ><img src="images/play.png" alt="play"
      /></a>
    </div>
    <img src="<?=$sdk->globalURL . $sdk->infoGnrl->field_imagen_acerca_de?>" />
  </div>
</main>
<?php include 'includes/footer.php'; ?>