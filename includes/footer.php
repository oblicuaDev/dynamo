<div id="preloader">
<img src="images/logo.gif" alt="logo" />
</div>
<?php if(!isset($noFooter)){ ?>
  <footer>
        <div class="container">
          <div class="top">
            <a href="/"><img src="images/logo.png" alt="logo" /></a>
            <div class="right">
              <ul class="socials">
              <?php 
              
                $redes = explode(", ", $sdk->infoGnrl->field_redes_sociales);
                for ($i=0; $i < count($redes); $i++) { 
              ?>
               <li>
                  <a href="<?=$redes[$i]?>" target="_blank">
                    <?=$iconos[$i]?>
                  </a>
                </li>
              <?php } ?>
              </ul>
              <a href="<?=$lang == "es" ? "" : "en/"?>trabaja-con-nosotros/" class="uppercase">Trabaja con nosotros</a>
              <a href="<?=$lang == "es" ? "" : "en/"?>contactanos/" class="uppercase">Contáctanos</a>
            </div>
          </div>
          <div class="places">
            <?php 
            $direcciones = explode("|", $sdk->infoGnrl->field_direcciones);
            for ($i=0; $i < count($direcciones); $i++) { 
            ?>
             <section>
             <?=$direcciones[$i]?>
            </section>
            <?php } ?>
          </div>
          <div class="bottom">
            <section class="registro">
              <h3>¿QUIERES SABER MÁS DE NUESTRAS PRODUCCIONES?</h3>
              <a href="javascript:Fancybox.show([{src: 'boxes/newsletter.php',type: 'ajax'}]);" class="btn orange">REGISTRO</a>
            </section>
            <nav>
              <section><a href="<?=$lang == "es" ? "" : "en/"?>preguntas-frecuentes/">PREGUNTAS FRECUENTES</a></section>
              <section><a href="javascript:Fancybox.show([{src: 'boxes/postula_proyecto.php',type: 'ajax'}]);">POSTULA TU PROYECTO</a></section>
              <section><a href="javascript:Fancybox.show([{src: 'boxes/prensa.php',type: 'ajax'}]);">PRENSA</a></section>
              <section class="certificados">
                <strong>CERTIFICADOS:</strong>
                <a href="javascript:Fancybox.show([{src: 'boxes/certificados_tributarios.php',type: 'ajax'}]);">TRIBUTARIOS</a>
                <a href="javascript:Fancybox.show([{src: 'boxes/certificados_comerciales.php',type: 'ajax'}]);">comerciales</a>
                <a href="javascript:Fancybox.show([{src: 'boxes/certificados_laborales_proyectos.php',type: 'ajax'}]);">laborales por proyecto</a>
                <a href="javascript:Fancybox.show([{src: 'boxes/certificados_laborales_general.php',type: 'ajax'}]);">laborales generales</a>
              </section>
              <section class="politics">
                <a href="/politica-de-recepcion-de-informacion-y-presentacion-de-ideas/"
                  >POLÍTICA DE RECEPCIÓN DE INFORMACIÓN Y PRESENTACIÓN DE IDEAS</a
                ><a href="/politicas-de-tratamiento-de-datos-personales/">POLÍTICA DE TRATAMIENTO DE DATOS PERSONALES</a
                ><a href="/terminos-condiciones/">términos y condiciones</a>
              </section>
            </nav>
          </div>
        </div>
      </footer>
<?php } ?>
    
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="js/main.js?v=<?=time();?>"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>