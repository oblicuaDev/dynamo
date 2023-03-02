<?php 
  $bodyClass = "serie"; 
  $activeMenu = 2; 
  include 'includes/header.php';
  include 'includes/nav.php';
  $temporada = $sdk->gMovies($_GET['id']);

?> 
<script>    let temporada = <?= json_encode($temporada) ?>;</script>
    <main>
      <div class="container">
      <?php 
      if($temporada->field_produccion_propia == "0"){
        echo "<h2>PELICULAS</h2>";
      }else{
        echo "<h2>SERVICIOS DE PRODUCCIÓN / <span>PELICULAS</span></h2>";
      } 
    ?>
      </div>
      <div class="trailer">
        <div class="container">
          <a
            href="<?=$temporada->field_link_trailer?>"
            data-fancybox
            id="play"
            ><img src="images/play.png" alt="play"
          /></a>
        </div>
        <img src="<?=$sdk->globalURL?><?=$temporada->field_banner?>" />
      </div>
      <div class="info container">
        <img src="<?=$sdk->globalURL?><?=$temporada->field_cartel?>" alt="ds" class="poster" />
        <div class="data">
          <div class="left">
            <h3><?=$temporada->title?></h3>
            <p class="created"> <?=$temporada->field_creado_por?></p>
            <p class="Barlow total">
            <?=$temporada->field_paises?> / <?=$temporada->field_year?> / <?=$temporada->field_duracion?>
            </p>
            <?php if($temporada->field_produccion_propia == "0"){ ?>
              <p class="Changa prod">PRODUCCIÓN ORIGINAL</p>
            <?php } ?>
            <?php if($temporada->field_link_imdb != ""){ ?>
              <a href="<?=$temporada->field_link_imdb?>">
                <img src="images/imdb.png" alt="imdb" class="imbd" />
              </a>
            <?php } ?>
            <?=$temporada->body?>
            <div class="platforms"></div>
            <div class="tops">
            <?=$temporada->field_top_netflix?>
            </div>
          </div>
          <div class="right">
            <div class="festivales"></div>
            <?php if($temporada->field_cliente != ""){ ?>
              <h4>CLIENTE</h4>
              <ul>
                <li>
                  <p><?=$temporada->field_cliente?></p>
                </li>
              </ul>
            <?php } ?>
            <h4>REPARTO</h4>
            <?=$temporada->field_reparto?>
            <div class="directors">
              <?=$temporada->field_colaboradores?>
            </div>

            <?php if($temporada->field_festivales_premios){ ?>
            <div class="awards">
            <h4>FESTIVALES / PREMIOS</h4>
            <?=$temporada->field_festivales_premios?>
            </div>
          <?php } ?>
            </div>

          <div class="gallery">
            <?php 
            $galeria = explode(", ",$temporada->field_galeria_imagenes );
            $galeriaG = explode(", ",$temporada->field_galeria_imagenes_grandes );
            // for ($i = 0; $i < count($galeria); $i += 2) {
            //   $element1 = $sdk->globalURL . $galeria[$i];
            //   $element2 = $sdk->globalURL . $galeria[$i+1];
            //   echo "<a href='' data-fancybox='gallery' data-src='$element2'><img src='$element1' alt='foto'/></a>";
            // }
            for ($i = 0; $i < count($galeria); $i++) {
              $element1 = $sdk->globalURL . $galeria[$i];
              $element2 = $sdk->globalURL . $galeriaG[$i];
              echo "<a href='' data-fancybox='gallery' data-src='$element2'><img src='$element1' alt='foto'/></a>";
            }
            ?>
          </div>
        </div>
      </div>
    </main>
<?php include 'includes/footer.php'; ?>
<script>
  async function getAll() {
    let plataformas = await getFestivalesPlataformas(temporada,"field_plataforma");

    document.querySelector(".platforms").innerHTML += plataformas;
    let premios = await getFestivalesPlataformas(temporada,"field_premios");
    if(premios == ""){
      document.querySelector(".festivales").style.display = "none";
    }else{
      document.querySelector(".festivales").innerHTML += premios;
    }
    if(window.innerWidth > 768){
      document.querySelector("main").style.height =
        document.querySelector("main").clientHeight - 180 + "px";
    }
  }
  getAll();
</script>