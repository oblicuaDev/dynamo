<?php 
  $activeMenu = 7; 
  $bodyClass = "news"; 
  include 'includes/header.php';
  include 'includes/nav.php';
  $news = $sdk->gPrensa("");
  $bannerNews = $filtered_array = array_filter($news, function($obj) {return $obj->field_on_slider == '1';});
?> 
<script>
 let arrayOfResponses = <?= json_encode($bannerNews) ?>;
  let arraybannersNews = arrayOfResponses.map( (banner) => ({
        image: `${banner.field_image}`,
        name: banner.title,
        link: banner.field_link_noticia,
      })
    );
</script>

    <main>
    <div class="banner-news">
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
      <?php for ($i=0; $i < count($news); $i++) { $new = $news[$i] ?>
        <div class="slider-4">
          <div class="container">
            <div class="slider-4-item">
              <div class="text">
                <div class="top">
                  <p>
                    <?=$new->title?>

                  </p>
                  <small><?=$new->field_fecha?></small>
                </div>
                <a href="<?=$new->field_link_noticia != "" ? $new->field_link_noticia : "/noticias/".$sdk->get_alias($new->title)."-".$new->nid  ?>" <?=$new->field_link_noticia != "" ? "target='_blank'" : ""?> class="btn nobg">VER MÁS</a>
              </div>
              <div class="image">
                <img src="<?=$sdk->globalURL?><?=$new->field_image?>" alt="<?=$new->title?>" />
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </main>
<?php include 'includes/footer.php'; ?>