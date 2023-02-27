<?php 
  $bodyClass = "work"; 
  include 'includes/header.php';
  include 'includes/nav.php';
  $vacantes = $sdk->gVacantes();
?> 
<main>
  <div class="container">
    <h1>TRABAJA CON NOSOTROS</h1>
    <section class="how">
      <h3>¿cómo puedo VINCULARME?</h3>
      <?=$comoVincularme?>
    </section>
    <section class="vacantes">
      <h3>VACANTES</h3>
      <section class="list-vacantes">
        <?php 
          for ($i=0; $i < count($vacantes); $i++) { 
          $vacante = $vacantes[$i];
          $date1 = $vacante->field_fecha_1;
          $timestamp1 = strtotime($date1);
          $timestamp2 = time();
          if ($timestamp1 > $timestamp2) {
        ?>
          <article>
            <div class="txt">
              <h4><?=$vacante->title?></h4>
              <p>
                <strong> POSTÚLATE HASTA EL: </strong>
              </p>
              <span class="date"> <?=$vacante->field_fecha?> </span>
              <strong> REQUISITOS MÍNIMOS </strong>
              <?=$vacante->body?>
            </div>
            <a
              href="javascript:Fancybox.show([{src: 'boxes/mepostulo.php?vacante=<?=$vacante->nid?>&vacanteName=<?=$vacante->title?>',type: 'ajax'}]);;"
              class="btn orange"
              >postularme</a
            >
          </article>
        <?php 
          if($i % 3 === 2){
            echo " <hr />";
          }
          }
          }
        ?>
       
      </section>
    </section>
    <div class="trabajar-dynamo">
      <img src="<?=$sdk->globalURL . $sdk->infoGnrl->field_img_tc?>" alt="trabajo" />
      <div class="info">
        <h3>¿cómo ES TRABAJAR EN DYNAMO?</h3>
        <?=$comoEsTrabajar?>
      </div>
    </div>
  </div>
</main>
<?php include 'includes/footer.php'; ?>