<?php 
  $bodyClass = "contact"; 
  $activeMenu = 5; 
  include 'includes/header.php';
  include 'includes/nav.php';
?> 
    <main>
      <div class="container">
        <h1>CONTÁCTANOS</h1>
        <div class="short-data">
          <div class="txt">

            <strong>¿TIENES UNA PREGUNTA?</strong>
            <p>
              Aquí encontrarás la respuesta a muchas de las preguntas más
              frecuentes sobre Dynamo. Elige una.
            </p>
          </div>
          <a href="<?=$lang == "es" ? "" : "en/"?>preguntas-frecuentes/" class="btn orange-bg">HAZ CLIC</a>
        </div>
        <div class="short-data">
          <div class="txt">

            <strong>¿QUIERES TRABAJAR CON NOSOTROS?</strong>
            <p>
              Visita la sección TRABAJA CON NOSOTROS en la que se encuentran las
              vacantes a las que puedes aplicar. Postúlate.
            </p>
          </div>
          <a href="trabaja-con-nosotros/" class="btn orange-bg">HAZ CLIC</a>
        </div>
        <div class="short-data">
          <div class="txt">

            <strong>¿TIENES UNA IDEA PARA UN PROYECTO?</strong>
            <p>
              Si tienes una idea para un proyecto, una serie o un producto
              audiovisual, compártela con nosotros.
            </p>
          </div>
          <a
            href="javascript:Fancybox.show([{src: 'boxes/postula_proyecto.php',type: 'ajax'}]);"
            class="btn orange-bg"
            >HAZ CLIC</a
          >
        </div>
        <hr />
        <div class="short-data">
          <div class="txt">

            <strong>SECCIÓN PRENSA</strong>
            <p>PR., material de prensa, entrevistas, comentarios...</p>
          </div>
          <a href="<?=$lang == "es" ? "" : "en/"?>comunicados-de-prensa"" class="btn orange-bg">HAZ CLIC</a>
        </div>
        <div class="short-data">
          <div class="txt">

            <strong>TEMAS GENERALES</strong>
            <?=$temas?>
          </div>
        </div>
        <div class="short-data">
          <div class="txt">

            <strong>PARA SERVICIOS DE PRODUCCIÓN</strong>
            <?=$paraServicios?>
          </div>
        </div>
        <hr />
        <div class="certificados">
          <strong>CERTIFICADOS</strong>
          <a
            href="javascript:Fancybox.show([{src: 'boxes/certificados_tributarios.php',type: 'ajax'}]);"
            class="btn orange-bg"
            >TRIBUTARIOS</a
          >
          <a
            href="javascript:Fancybox.show([{src: 'boxes/certificados_comerciales.php',type: 'ajax'}]);"
            class="btn orange-bg"
            >COMERCIALES</a
          >
          <a
            href="javascript:Fancybox.show([{src: 'boxes/certificados_laborales_proyectos.php',type: 'ajax'}]);"
            class="btn orange-bg"
            >LABORALES POR PROYECTO</a
          >
          <a
            href="javascript:Fancybox.show([{src: 'boxes/certificados_laborales_general.php',type: 'ajax'}]);"
            class="btn orange-bg"
            >LABORALES GENERALES</a
          >
        </div>
        <div class="where">
          <h3>¿DÓNDE ESTAMOS?</h3>
          <?=$dondeEstamos?>
          <ul class="locations">
          <?php 
          $direcciones = explode("|", $sdk->infoGnrl->field_direcciones);
          $direccionesLinks = explode("|", $sdk->infoGnrl->field_links_mapas);
          for ($i=0; $i < count($direcciones); $i++) { 
          ?>
<li>

  <a href="<?=$direccionesLinks[$i]?>" target="_blank">
    <img src="images/map.png" alt="map" />
  </a>
  <?=$direcciones[$i]?>
</li>
<?php } ?>
          </ul>
        </div>
      </div>
    </main>
<?php include 'includes/footer.php'; ?>