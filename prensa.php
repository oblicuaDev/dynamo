<?php 
  $activeMenu = 7; 
  $bodyClass = "news"; 
  include 'includes/header.php';
  include 'includes/nav.php';
  $news = $sdk->gPrensa("", true);
$bannerNews = $filtered_array = array_filter($news, function($obj) {
  return $obj->field_on_slider == '1';
});

?> 

    <main>
      <div class="banner-news">
        <img src="" alt="">
        <div class="info">
          <div class="top">
            <h2></h2>
          </div>
          <div class="dots-slider"></div>
          <div class="bottom">
            <a href="" target="_blank" class="btn more uppercase">Quiero saber más</a>
          </div>
        </div>
        <img src="images/scroll.png" alt="scroll" id="scrolldown" />
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
                <a href="<?=$new->field_link_noticia != "" ? $new->field_link_noticia : '/comunicado-de-prensa/'.  $sdk->get_alias($new->title) .'-' . $new->nid ?>" target="_blank" class="btn nobg">VER MÁS</a>
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

<script>
 let arrayOfResponses = <?= json_encode($bannerNews) ?>;
    let arraybanners = arrayOfResponses.map( (banner) => ({
          image: `${banner.field_image}`,
          name: banner.title,
          link: banner.field_link_noticia,
        })
      );
  if (document.querySelector(".banner-news")) {
  let index = 0;
  let timeSlider = 4000;
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
      ".banner-news img"
    ).src = `${globalURL}${arraybanners[index].image}`;
    document.querySelector(
      ".info .top h2"
    ).innerHTML = `${arraybanners[index].name}`;
    document.querySelector(
      ".btn.more"
    ).href = `${arraybanners[index].link}`;
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
      if (index == arraybanners.length - 1) {
        index = 0;
      } else {
        index++;
      }
      width = 0;
    }

    }
  animationStart();

  if(arraybanners.length > 1){
    intervalAnimationStart = setInterval(() => {
      clearInterval(interval);
      animationStart();
    }, timeSlider);

  }

}
</script>