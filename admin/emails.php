<?php 
  include '../includes/config.php';
  $bodyClass = "emails"; 
  $db = new dbase();
?> 
<!DOCTYPE html>
<html lang="es">
  <head>
    <base href="/">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dynamo</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/themes/splide-default.min.css"
    />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/styles.css?v=<?=time();?>" />
  </head>
  <body class="<?=$bodyClass?>">
<main>
    <aside>
        <a href="/correos-recibidos/certificados_comerciales" class="Changa uppercase">Certificados Comerciales</a>
        <a href="/correos-recibidos/certificados_laborales_general" class="Changa uppercase">Certificados Laborales General</a>
        <a href="/correos-recibidos/certificados_laborales_proyectos" class="Changa uppercase">Certificados laborales proyectos</a>
        <a href="/correos-recibidos/certificados_tributarios" class="Changa uppercase">Certificados tributarios</a>
        <a href="/correos-recibidos/mepostulo" class="Changa uppercase">Postulaciones</a>
        <a href="/correos-recibidos/newsletter" class="Changa uppercase">Newsletter</a>
        <a href="/correos-recibidos/postula_proyecto" class="Changa uppercase">Postulaciones proyectos</a>
        <a href="/correos-recibidos/prensa" class="Changa uppercase">Prensa</a>
    </aside>
    <div class="container history-list">
    <a href="/get/exportExcel.php?type=<?=$_GET['type']?><?php if(isset($_GET['vacante'])){ $vacanteID = explode("-", $_GET['vacante'])[1]; echo "&vacante=" . $vacanteID; }?>" class="excel">Exportar excel</a>

    <?php 
 switch ($_GET['type']) {
    case 'certificados_comerciales':
        $query = "SELECT * FROM forms where type_for=1 AND reg_eli = 0";
  
        break;
    case 'certificados_laborales_general':
        $query = "SELECT * FROM forms where type_for=2 AND reg_eli = 0";
  
        break;
    case 'certificados_laborales_proyectos':
        $query = "SELECT * FROM forms where type_for=3 AND reg_eli = 0";
  
        break;
    case 'certificados_tributarios':
        $query = "SELECT * FROM forms where type_for=4 AND reg_eli = 0";
  
        break;
    case 'mepostulo':
      $query = "SELECT * FROM forms where type_for=5 AND reg_eli = 0";
        if(isset($_GET['vacante'])){
          $vacanteID = explode("-", $_GET['vacante'])[1];
            $query = "SELECT * FROM `forms` WHERE `parent_for` LIKE '%".$vacanteID."%' AND type_for=5 AND reg_eli = 0";
          }
          echo '<form action="/correos-recibidos/mepostulo" method="GET" id="vacanteForm"><input type="text" id="vacante" name="vacante" placeholder="Burcar por vacante"><button type="submit" class="btn orange">Buscar</button></form>';
        break;
    case 'newsletter':
        $query = "SELECT * FROM forms where type_for=6 AND reg_eli = 0";
  
        break;
    case 'postula_proyecto':
        $query = "SELECT * FROM forms where type_for=7 AND reg_eli = 0";
  
        break;
    case 'prensa':
        $query = "SELECT * FROM forms where type_for=8 AND reg_eli = 0";
  
        break;
  }
?>

    <ul class="thead">
        <li><strong>Nombre</strong></li>
        <li><strong>Correo</strong></li>
        <li><strong>Teléfono</strong></li>
        <li><strong>CC</strong></li>

        <li><strong></strong></li>
        <li><strong></strong></li>
    </ul>

    <?php
        $result = $db->customQuery($query);
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $jArr = json_decode($row['content_for'], true);
    ?>
    <ul>
        <li title="<?= $jArr['name']?>"><?= $jArr['name']?></li>
        <li title="<?= $jArr['email']?>"><?= $jArr['email']?></li>
        <li title="<?= $jArr['phone']?>"><?= $jArr['phone']?></li>
        <li title="<?= $jArr['cc']?>"><?= $jArr['cc']?></li>
  
        <li title="<?= $jArr['file']?>"><a href="https://dynamo.mottif.tv/set/uploads/<?= $jArr['file']?>" target="_blank"><?= $jArr['file']?></a></li>
        <li title="<?= $jArr['portafolio']?>"><a href="https://dynamo.mottif.tv/set/uploads/<?= $jArr['portafolio']?>" target="_blank"><?= $jArr['portafolio']?></a></li>
    </ul>

    
    <?php $counter++; }
    
    ?>
  </div>

</main>
<?php include '../includes/footer.php'; ?>