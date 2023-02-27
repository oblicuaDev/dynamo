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
    <img src="" alt="monos" />
    <div class="info">
      <div class="top">
        <h2></h2>
        <div class="director">
          <strong class="uppercase"></strong>
          <p  class="Barlow"></p>
          <small class="Changa"></small>
        </div>
      </div>
      <div class="dots-slider">
      </div>
      <div class="bottom">
        <div class="platforms">
        </div>
        <a href="" class="btn more uppercase">Quiero saber más</a>
        <div class="festivales">
        </div>
      </div>
    </div>
    <img src="images/scroll.png" alt="scroll" id="scrolldown" />
  </div>
 <div class="recents">
   <h3>Proyectos recientes</h3>
   <ul class="grid-recents"></ul>
 </div>
  <h3>Todos los proyectos</h3>
  <ul class="grid-projects"></ul>
</main>
<?php include 'includes/footer.php'; ?>

<script>
    let arrayOfResponses = <?= json_encode($banners) ?>;
 let arraybanners = arrayOfResponses.map( (banner) => {
      const festivales =  getFestivalesPlataformas(
        banner,
        "field_premios"
      );
      const plataformas =  getFestivalesPlataformas(
        banner,
        "field_plataforma"
      );
      return {
        nid: banner.nid,
        image: `${globalURL}${banner.field_banner}`,
        name: banner.title,
        countries: banner.field_paises,
        year: banner.field_year,
        time: banner.field_duracion,
        director: banner.field_creado_por,
        festivals: festivales,
        platfforms: plataformas,
      };
    })
  let index = 0;
  let timeSlider = 8000;
  let dots = document.querySelector(".dots-slider");
  var width = 0;
  let interval;
  dots.innerHTML = "";
  if(arraybanners.length > 1){
    arraybanners.map((banner, i) => {
      dots.innerHTML += `<a href="javascript:gotoBanner(${i});"><div class="line"></div></a>`;
    });

  }

  function animationStart() {
    document.querySelector(
          ".banner-production img"
        ).src = `${arraybanners[index].image}`;
        document.querySelector(
          ".info .top h2"
        ).innerHTML = `${arraybanners[index].name}`;
        document.querySelector(
          ".director strong"
        ).innerHTML = `${arraybanners[index].director}`;
        document.querySelector(
          ".director p"
        ).innerHTML = `${arraybanners[index].countries} / ${arraybanners[index].year} / ${arraybanners[index].time}`;
        document.querySelector(
          ".banner-production .btn.more"
        ).href = `${typeProd != "1" ? "serie" : "pelicula"}/${get_alias(arraybanners[index].name)}-${arraybanners[index].nid}`;
    

        const myPromisePlatfforms = new Promise((resolve, reject) => {
          // Do some work (e.g. make an HTTP request)
          const result = arraybanners[index].platfforms;
            // If the work is successful, resolve the Promise
          if (result) {
            resolve(result);
          } else {
            // If the work fails, reject the Promise
            reject(new Error('Something went wrong'));
          }
        });
        let platfforms = myPromisePlatfforms.then(result =>  document.querySelector(
          ".platforms"
        ).innerHTML = `${result}`)
        const myPromisefestivals = new Promise((resolve, reject) => {
          // Do some work (e.g. make an HTTP request)
          const result = arraybanners[index].festivals;
            // If the work is successful, resolve the Promise
          if (result) {
            resolve(result);
          } else {
            // If the work fails, reject the Promise
            reject(new Error('Something went wrong'));
          }
        });
        let festivals = myPromisefestivals.then(result =>  document.querySelector(
          ".festivales"
        ).innerHTML = `${result}`)
    if(arraybanners.length > 1){
      var bar = document.querySelectorAll(".dots-slider a")[index];
  
      var line = document.querySelectorAll(".dots-slider a")[index].children[0];
      interval = setInterval(function () {
        if (width < bar.getClientRects()[0].width) {
          width += 1;
          line.style.width = width + "px";
          line.style.opacity = 1;
        } else if (width == bar.getClientRects()[0].width) {
          line.style.width = 0 + "px";
          line.style.opacity = 0;
        }
      }, timeSlider / bar.getClientRects()[0].width);
      line.style.opacity = 0;
 }
    if (index == arraybanners.length - 1) {
      index = 0;
    } else {
      index++;
    }
    width = 0;
  }
  animationStart();
  if(arraybanners.length > 1){

    intervalAnimationStart = setInterval(() => {
      clearInterval(interval);
      animationStart();
    }, timeSlider);
  }
  </script>