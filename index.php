<?php $bodyClass = "home"; include 'includes/header.php'; $banners = $sdk->gBanners(); ?>   
    <main>
      <div class="banner-home">
        <img src="" alt="" />
        <div class="info">
        <div class="top">
            <h2></h2>
            <div class="director">
              <strong class="uppercase"></strong>
              <p class="Barlow"></p>
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
      <section
        class="splide splide__home-1"
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
          <ul class="splide__list">
            <?php for ($i=0; $i < count($banners); $i++) { ?>
              <li class="splide__slide">
                <a href="<?=$banners[$i]->field_link?>">
                  <img src="<?=$sdk->globalURL . $banners[$i]->field_image?>" alt="<?=$banners[$i]->title?>" />
                  <?php if($banners[$i]->field_mostrar_boton == "1"){ ?>
                    <?php if($banners[$i]->field_boton_rojo_ == "1"){ ?>
                      <button class="btn red uppercase">CONOCER</button>
                    <?php }else{ ?>
                      <button class="btn white uppercase">CONOCER</button>
                    <?php } ?>
                  <?php } ?>
                </a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </section>
      <div class="banner-2">
        <img src="<?=$sdk->globalURL . $sdk->infoGnrl->field_banner_reel?>" alt="banner2" />
        <a data-fancybox data-type="video" href="<?=$sdk->infoGnrl->field_link_reel?>" class="btn more2 uppercase">VER REEL COMPLETO</a>
      </div>
      <div class="banner-3 container"></div>
      <section
        class="splide slider-4 container"
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
        <div class="splide__track"><ul class="splide__list"></ul></div>
      </section>
    </main>
  <?php include 'includes/footer.php'; ?>