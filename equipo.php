<?php 
  $bodyClass = "equipo"; 
  include 'includes/header.php';
  include 'includes/nav.php';
  $persons = $sdk->gPersons();
  $result = $persons["colaborador1"];

?> 
    <main>
      <div class="container">
        <h3 class="">NOSOTROS / <span>EQUIPO</span></h3>
      </div>
      <section
        class="splide splide__equipo"
        aria-label="Splide Basic HTML Example"
      >
        <div class="splide__arrows">
          <button class="splide__arrow splide__arrow--prev">
            <img src="images/izq.png" alt="" />
          </button>
          <button class="splide__arrow splide__arrow--next">
            <img src="images/der.png" alt="" />
          </button>
        </div>

        <div class="splide__track">
          <ul class="splide__list list-equipo">
            <?php for ($a=0; $a < count($result); $a++) { ?>
              <li class="splide__slide single-equipo" data-nid="<?=$result[$a]->nid?>">
                <img src="<?=$sdk->globalURL . $result[$a]->field_foto_listado?>" alt="<?=$result[$a]->title?>" />
                <div class="flex">
                  <div class="info">
                    <div class="fx aife">
                      <h2><?=$result[$a]->title?></h2>
                      <?php if($result[$a]->field_redes_sociales != ""){ ?>
                        <div class="social">
                          <?php 
                            $redes = explode(", ", $result[$a]->field_redes_sociales);
                            for ($i=0; $i < count($redes); $i++) { 
                          ?>
                          <?=$iconos[$i]?></a>
                          <?php } ?> 
                        </div>
                      <?php } ?>
                      
                    </div>
                    <div class="fx aife">
                      <span class="position uppercase"><?=$result[$a]->field_profesion?></span>
                      <h3 class="uppercase">Proyectos</h3>
                    </div>
                    <div class="fx">
                      <div class="desc">
                        <?=$result[$a]->body?>

                      </div>
                      <div class="projects">
                        <ul>
                          <li><a href="">Contracorriente</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php } ?>
          </ul>
        </div>
      </section>
    </main>
<?php include 'includes/footer.php'; ?>
<script>
  var domElements = document.querySelectorAll(".single-equipo");

for(var i=0;i<domElements.length;i++){
   if(domElements[i].dataset.nid == <?=$_GET["id"]?>){
      if (document.querySelector(".splide__equipo")) {
        const splide = new Splide(".splide__equipo", {focus: "center",pagination: false,infinite: false,gap: 16,trimSpace: false,}).mount();
        const { Move } = splide.Components;
        Move.jump(i);
  document.querySelector(".single-equipo.is-active").classList.remove("is-active")

        domElements[i].classList.add("is-active")
      }
   }
}
</script>