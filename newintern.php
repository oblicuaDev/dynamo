<?php 
  $activeMenu = 6; 
  $bodyClass = "new-intern"; 
  include 'includes/header.php';
  include 'includes/nav.php';
  if($_GET["type"] == 1){
      $new = $sdk->gNews($_GET["id"]);
      
    }else{
      $new = $sdk->gPrensa($_GET["id"]);
  }
?> 
    <main>
        <div class="container">
            <h2>NOTICIAS</h2>
        </div>
        <div class="content container">
            <img src="<?=$sdk->globalURL?><?=$new->field_image?>" alt="<?=$new->title?>" />
            <div class="txt">
                <h2>
                    <?=$new->title?>

                </h2>
                <small><?=$new->field_fecha?></small>
                <?=$new->body?>
            </div>

        </div>
    </main>
<?php include 'includes/footer.php'; ?>