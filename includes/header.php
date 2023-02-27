<?php 
    include 'config.php';
    $iconos = [
      '<?xml version="1.0" encoding="UTF-8"?><svg id="Capa_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.25 49.25"><g id="Layer_1"><path fill="currentcolor" class="cls-1" d="m24.62,0C11.03,0,0,11.03,0,24.62s11.03,24.62,24.62,24.62,24.62-11.02,24.62-24.62S38.22,0,24.62,0Zm6.52,24.52h-4.26v15.21h-6.32v-15.21h-3v-5.37h3v-3.48c0-2.49,1.18-6.38,6.38-6.38l4.68.02v5.21h-3.4c-.55,0-1.34.28-1.34,1.46v3.16h4.82l-.55,5.37Z"/></g></svg>',
      '<?xml version="1.0" encoding="UTF-8"?><svg id="Capa_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.25 49.25"><g id="Layer_1"><path class="cls-1" fill="currentcolor" d="m24.62,0C11.03,0,0,11.03,0,24.62s11.03,24.62,24.62,24.62,24.62-11.02,24.62-24.62S38.22,0,24.62,0Zm12.41,19.66c.01.27.02.53.02.8,0,8.2-6.24,17.66-17.66,17.66-3.5,0-6.77-1.03-9.51-2.79.49.06.98.09,1.48.09,2.91,0,5.58-.99,7.71-2.66-2.72-.05-5.01-1.84-5.8-4.31.38.07.77.11,1.17.11.57,0,1.11-.08,1.64-.22-2.84-.57-4.98-3.08-4.98-6.08,0-.03,0-.05,0-.08.84.46,1.79.74,2.81.78-1.67-1.12-2.76-3.01-2.76-5.17,0-1.14.31-2.2.84-3.12,3.06,3.75,7.63,6.22,12.79,6.48-.11-.45-.16-.93-.16-1.41,0-3.43,2.78-6.21,6.21-6.21,1.79,0,3.4.75,4.53,1.96,1.41-.28,2.74-.79,3.94-1.51-.46,1.45-1.45,2.67-2.73,3.43,1.26-.15,2.45-.48,3.56-.98-.83,1.24-1.88,2.34-3.1,3.21Z"/></g></svg>',
      '<?xml version="1.0" encoding="UTF-8"?><svg id="Capa_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.25 49.25"><g id="Layer_1"><g><path class="cls-1" fill="currentcolor" d="m24.62,19.88c-2.62,0-4.75,2.13-4.75,4.75s2.13,4.75,4.75,4.75,4.75-2.13,4.75-4.75-2.13-4.75-4.75-4.75Z"/><path class="cls-1" fill="currentcolor" d="m35.73,16.22c-.26-.67-.57-1.14-1.07-1.64-.5-.5-.97-.81-1.64-1.07-.5-.2-1.26-.43-2.65-.49-1.5-.07-1.95-.08-5.76-.08s-4.25.01-5.76.08c-1.39.06-2.14.3-2.65.49-.66.26-1.14.57-1.64,1.07-.5.5-.81.97-1.07,1.64-.2.5-.43,1.26-.49,2.65-.07,1.5-.08,1.95-.08,5.76s.01,4.25.08,5.76c.06,1.39.3,2.14.49,2.65.26.66.57,1.14,1.07,1.64.5.5.97.81,1.64,1.07.5.2,1.26.43,2.65.49,1.5.07,1.95.08,5.76.08s4.26-.01,5.76-.08c1.39-.06,2.14-.3,2.65-.49.66-.26,1.14-.57,1.64-1.07s.81-.97,1.07-1.64c.19-.5.43-1.26.49-2.65.07-1.5.08-1.95.08-5.76s-.01-4.25-.08-5.76c-.06-1.39-.3-2.14-.49-2.65Zm-11.11,15.72c-4.04,0-7.32-3.28-7.32-7.32s3.28-7.32,7.32-7.32,7.32,3.28,7.32,7.32-3.28,7.32-7.32,7.32Zm7.61-13.21c-.94,0-1.71-.77-1.71-1.71s.77-1.71,1.71-1.71,1.71.77,1.71,1.71-.77,1.71-1.71,1.71Z"/><path class="cls-1" fill="currentcolor" d="m24.62,0C11.02,0,0,11.03,0,24.63s11.02,24.63,24.62,24.63,24.62-11.02,24.62-24.63S38.23,0,24.62,0Zm14.16,30.5c-.07,1.52-.31,2.55-.66,3.46-.36.94-.85,1.73-1.64,2.52-.79.79-1.59,1.28-2.52,1.64-.91.35-1.94.59-3.46.66-1.52.07-2,.09-5.87.09s-4.35-.02-5.87-.09c-1.52-.07-2.55-.31-3.46-.66-.94-.36-1.73-.85-2.52-1.64-.79-.79-1.28-1.59-1.64-2.52-.35-.91-.59-1.94-.66-3.46-.07-1.52-.09-2-.09-5.87s.02-4.35.09-5.87c.07-1.52.31-2.55.66-3.46.36-.94.85-1.73,1.64-2.52.79-.79,1.59-1.28,2.52-1.64.91-.35,1.94-.59,3.46-.66,1.52-.07,2-.09,5.87-.09s4.35.02,5.87.09c1.52.07,2.55.31,3.46.66.94.36,1.73.85,2.52,1.64.79.79,1.28,1.59,1.64,2.52.35.91.59,1.94.66,3.46.07,1.52.09,2,.09,5.87s-.02,4.35-.09,5.87Z"/></g></g></svg>',
      '<?xml version="1.0" encoding="UTF-8"?><svg id="Capa_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.25 49.25"><g id="Layer_1"><path class="cls-1" fill="currentcolor" d="m24.62,0C11.03,0,0,11.02,0,24.62s11.03,24.62,24.62,24.62,24.62-11.02,24.62-24.62S38.22,0,24.62,0Zm11.3,26.12l-15.71,9.97c-.29.18-.62.28-.95.28-.29,0-.59-.07-.85-.22-.57-.31-.92-.91-.92-1.55V14.66c0-.65.35-1.24.92-1.55.57-.31,1.26-.29,1.8.06l15.71,9.97c.51.33.82.89.82,1.5s-.31,1.17-.82,1.5Z"/></g></svg>',
      '<?xml version="1.0" encoding="UTF-8"?><svg id="Capa_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.25 49.25"><g id="Layer_1"><path class="cls-1" fill="currentcolor" d="m24.62,0C11.03,0,0,11.03,0,24.62s11.03,24.62,24.62,24.62,24.62-11.02,24.62-24.62S38.22,0,24.62,0Zm14.26,18.56c-1.64,9.27-10.83,17.11-13.6,18.91-2.77,1.79-5.29-.72-6.2-2.62-1.05-2.16-4.19-13.9-5.01-14.87-.82-.97-3.29.97-3.29.97l-1.2-1.57s5.01-5.98,8.82-6.73c4.04-.79,4.03,6.2,5,10.09.94,3.76,1.57,5.9,2.39,5.9s2.39-2.09,4.11-5.3c1.72-3.21-.07-6.05-3.44-4.04,1.35-8.07,14.05-10.01,12.4-.75Z"/></g></svg>'
    ];
    // DESCRIPCIONES
    $equipo=$sdk->infoGnrl->field_intro_equipo;
    $acercaDe=$sdk->infoGnrl->field_intro_acerca_de;
    $spPelis=$sdk->infoGnrl->field_intro_peliculas;
    $spSeries=$sdk->infoGnrl->field_intro_series;
    $dondeEstamos=$sdk->infoGnrl->field_intro_donde_estamos;
    $temas=$sdk->infoGnrl->field_intro_temas_generales;
    $paraServicios=$sdk->infoGnrl->field_intro_para_servicios_de_pr;
    $comoVincularme=$sdk->infoGnrl->field_intro_vincularme;
    $comoEsTrabajar=$sdk->infoGnrl->field_intro_ted;
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
  <head>
    <base href="/">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dynamo</title>
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
  <script>
    let infoGnrl = <?= json_encode($sdk->infoGnrl) ?>;
  </script>
  <div class="menu">
      <div class="container">
        <button id="closemenu">
          <img src="images/cerrar.png" alt="menu" />
        </button>
        <nav>
          <ul>
            <li>
              <a href="<?=$lang == "es" ? "" : "en/"?>peliculas/"> PELÍCULAS </a>
            </li>
            <li>
              <a href="<?=$lang == "es" ? "" : "en/"?>series/"> SERIES </a>
            </li>
            <li>
              <a href="javascript:;" class="nohover"> Servicios de producción </a>
              <ul>
                <li>
                  <a href="<?=$lang == "es" ? "" : "en/"?>servicios-de-produccion/peliculas/">— películas</a>
                </li>
                <li>
                  <a href="<?=$lang == "es" ? "" : "en/"?>servicios-de-produccion/series/">— SERIES</a>
                </li>
              </ul>
            </li>
          </ul>
          <ul>
            <li>
              <a href="<?=$lang == "es" ? "" : "en/"?>nosotros/">ACERCA DE DYNAMO</a>
            </li>
            <li>
              <a href="<?=$lang == "es" ? "" : "en/"?>equipo/">Equipo</a>
            </li>
            <li>
              <a href="<?=$lang == "es" ? "" : "en/"?>contactanos/">Contáctanos</a>
            </li>
            <li>
              <a href="<?=$lang == "es" ? "" : "en/"?>noticias/">Noticias</a>
            </li>
            <li>
              <a href="<?=$lang == "es" ? "" : "en/"?>comunicados-de-prensa">Comunicados</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <header>
      <div class="container">
        <div class="top">
          <a href="/"><img src="images/logo.png" alt="logo" /></a>
          <div class="right">
            <ul class="socials">
            <?php 
              $redes = explode(", ", $sdk->infoGnrl->field_redes_sociales);
              for ($i=0; $i < count($redes); $i++) { 
            ?>
            <li>
                <a href="<?=$redes[$i]?>" target="_blank">
                  <?=$iconos[$i]?>
                </a>
              </li>
            <?php } ?>
            </ul>
            <form action="/buscar/" method="GET" autocomplete="off">
              <span>
                <img src="images/lupa.png" alt="lupa" />
                <input type="search" name="search" id="search" />
              </span>
            </form>
            <a href="trabaja-con-nosotros/" class="uppercase">Trabaja con nosotros</a>
            <ul class="lang">
              <li>
              <a href="javascript:changeLang('<?=$lang == 'es' ? 'en' : 'es'?>');">    
              <?=$lang == 'es' ? 'ENGLISH' : 'ESPAÑOL'?>
              </a>  
            </li>
            </ul>
          </div>
        </div>
        <div class="bottom">
          <button id="menu"><img src="images/menu.png" alt="menu" /></button>
        </div>
      </div>
    </header>