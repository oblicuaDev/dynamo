<?php 
  $bodyClass = "socio"; 
  include 'includes/header.php';
  include 'includes/nav.php';
  $persons = $sdk->gPersons();
  $socios = $persons["socios"];
?> 

    <main>
      <div class="container">
        <h3 class="">NOSOTROS / <span>SOCIOS</span></h3>
      </div>
      <section
        class="splide splide__socios"
        aria-label="Basic Structure Example"
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
          <ul class="splide__list">
            <?php for ($i=0; $i < count($socios); $i++) {  ?>
              <li
                data-nid="<?=$socios[$i]->nid?>"
                class="splide__slide single-socio <?=$socios[$i]->field_desc_position == "1" ? "right": "left"?>"
                style="background-image: url(<?=$sdk->globalURL . $socios[$i]->field_foto?>)"
              >
                <div class="container">
                  <div class="info">
                    <img
                      src="<?=$sdk->globalURL . $socios[$i]->field_foto?>"
                      alt="<?=$sdk->globalURL . $socios[$i]->field_foto?>"
                    />
                    <h2><?=$socios[$i]->title?></h2>
                    <span class="position"><?=$socios[$i]->field_profesion?></span>
                    <?=$socios[$i]->body?>
                    </p>
                  </div>
                </div>
              </li>
            <?php }?>
          </ul>
        </div>
      </section>
    </main>
   <?php include 'includes/footer.php'; ?>

   <script>
  var domElements = document.querySelectorAll(".single-socio");

for(var i=0;i<domElements.length;i++){
   if(domElements[i].dataset.nid == <?=$_GET["id"]?>){
      if (document.querySelector(".splide__socios")) {
        const splide = new Splide(".splide__socios", { pagination: false }).mount();
        const { Move } = splide.Components;
        Move.jump(i);
      }
   }
}
</script>