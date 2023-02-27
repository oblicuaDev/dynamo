<?php 
  $bodyClass = "team"; 
  $activeMenu = 9; 
  include 'includes/header.php';
  $persons = $sdk->gPersons();
  include 'includes/nav.php';
  $socios = $persons["socios"];
  $colaborador1 = $persons["colaborador1"];
?>
   
    <main>
      <div class="container">
        <h3 class="">NOSOTROS / <span>EQUIPO</span></h3>
        <h2 class=""><span>SOCIOS</span></h2>
      </div>

      <ul class="socios">
        <?php for ($i=0; $i < count($socios); $i++) { ?>
          <li>
            <a href="socios/<?=$sdk->get_alias($socios[$i]->title)?>-<?=$socios[$i]->nid?>">
              <div class="image">
                <img src="<?=$sdk->globalURL . $socios[$i]->field_foto_listado?>" alt="<?=$socios[$i]->title?>" />
              </div>
              <strong><?=$socios[$i]->title?></strong>
              <small class="Changa"><?=$socios[$i]->field_profesion?></small>
            </a>
          </li>
        <?php }?>
      </ul>
      <div class="container">
        <h2 class=""><span>EQUIPO</span></h2>
        <div class="double">
          <?=$equipo?>
        </div>
        <ul class="team-list">
        <?php for ($i=0; $i < count($colaborador1); $i++) { ?>
          <li>
            <a href="colaboradores/<?=$sdk->get_alias($colaborador1[$i]->title)?>-<?=$colaborador1[$i]->nid?>">
              <div class="image">
                <img src="<?=$sdk->globalURL . $colaborador1[$i]->field_foto_listado?>" alt="<?=$colaborador1[$i]->title?>" />
              </div>
              <strong><?=$colaborador1[$i]->title?></strong>
              <small class="Changa"><?=$colaborador1[$i]->field_profesion?></small>
            </a>
          </li>
        <?php }?>
        </ul>
      </div>
    </main>
    <?php include 'includes/footer.php'; ?>