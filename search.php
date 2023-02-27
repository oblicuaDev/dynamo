<?php 
  $bodyClass = "search"; 
  include 'includes/header.php';
  include 'includes/nav.php';
  $news = $sdk->gSearch($_GET["search"]);
?> 

    <main>
      <?php for ($i=0; $i < count($news); $i++) { $new = $news[$i] ?>
        
          <div class="slider-4">
            <div class="container">
              <div class="slider-4-item">
                <div class="text">
                  <div class="top">
                    <p>
                      <?=$new->title?>
                    </p>
                    <?php if($new->field_mostrar_fecha == '1'){?>
                      <small><?=$new->field_fecha?></small>
                    <?php }?>
                  </div>
                  <?php 
                  switch ($new->type) {
                      case 'Noticias':
                        $link = $new->field_link_noticia != "" ? $new->field_link_noticia : "/comunicado-de-prensa/".$sdk->get_alias($new->title)."-".$new->nid;
                        $target = $new->field_link_noticia != "" ? "target='_blank'" : "";
                        echo '<a href="'. $link.'" '.$target.' class="btn nobg">VER MÁS</a>';
                        break;
                        case 'Comunicados de prensa':
                        $link = $new->field_link_noticia != "" ? $new->field_link_noticia : "/comunicado-de-prensa/".$sdk->get_alias($new->title)."-".$new->nid;
                        $target = $new->field_link_noticia != "" ? "target='_blank'" : "";
                        echo '<a href="'.$link.'" '.$target.' class="btn nobg">VER MÁS</a>';
                        break;
                        case 'Temporadas':
                        echo '<a href="'. "/serie/".$sdk->get_alias($new->title)."-".$new->nid.'" class="btn nobg">VER MÁS</a>';
                        break;
                        case 'Películas':
                        echo '<a href="'. "/pelicula/".$sdk->get_alias($new->title)."-".$new->nid.'" class="btn nobg">VER MÁS</a>';
                        break;
                  }
                  ?>
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