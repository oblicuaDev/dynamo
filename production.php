<?php 

$bodyClass = "production"; 
include 'includes/header.php';

  if($_GET["type"] == "1"){
    if($_GET["propia"] == "0"){
      $activeMenu = 4; 
      $banners = $sdk->gMovieBanners(true);
    }else{
      $activeMenu = 2; 
      $banners = $sdk->gMovieBanners();
    } 
  }else{
    if($_GET["propia"] == "0"){
      $activeMenu = 8;
      $banners = $sdk->gSeriesBanners(true);
    }else{
      $activeMenu = 3; 
      $banners = $sdk->gSeriesBanners();
    } 

  }
  include 'includes/nav.php';
?> 
<script>
    let arrayOfResponses = <?= json_encode($banners) ?>;
  </script>
  <body class="<?=$bodyClass?>">
  <script>
  let typeProd = "<?= $_GET["type"] ?>";
  let propiaProd = "<?= $_GET["propia"] ?>";
  </script>
<main>
  <div class="container">
    <?php 
    if($_GET["type"] == "1"){
      if($_GET["propia"] == "0"){
        echo "<h2>SERVICIOS DE PRODUCCIÓN / <span>PELICULAS</span></h2>";
      }else{
        echo "<h2>PELÍCULAS</h2>";
      } 
    }else{
      if($_GET["propia"] == "0"){
        echo "<h2>SERVICIOS DE PRODUCCIÓN / <span>SERIES</span></h2>";
      }else{
        echo "<h2>SERIES</h2>";
      } 
  
    }
    ?>
  </div>
  <div class="banner-production">
        <img src="" alt="" />
        <div class="info">
        <div class="top">
            <h2></h2>
            <div class="director">
              <strong class="uppercase"></strong>
              <p class="Barlow"></p>
              <span class="Barlow"></span>
            </div>
          </div>
          <div id="dots"></div>
          <div class="bottom">
            <div class="platforms"></div>
            <a href="" class="btn more uppercase">Quiero saber más</a>
            <div class="festivales"></div>
          </div>
        </div>
        <img
          src="images/scroll.png"
          alt="scroll"
          id="scrolldown"
          class="shake-vertical"
        />
      </div>
 <div class="recents">
   <h3>Proyectos recientes</h3>
   <ul class="grid-recents"></ul>
 </div>
  <h3>Todos los proyectos</h3>
  <ul class="grid-projects"></ul>
</main>
<?php include 'includes/footer.php'; ?>