<nav class="float container">
  <ul>
    <li><a href="javascript:;" class="Changa uppercase nohover">Nosotros</a>
      <ul>
        <li><a href="<?=$lang == "es" ? "" : "en/"?>nosotros/" class="Changa uppercase <?=isset($activeMenu) && $activeMenu == 1 ? 'active' : ''?>">Acerca de Dynamo</a></li>
        <li><a href="<?=$lang == "es" ? "" : "en/"?>equipo/" class="Changa uppercase <?=isset($activeMenu) && $activeMenu == 9 ? 'active' : ''?>">Equipo</a></li>
      </ul>
    </li>
    <li><a href="<?=$lang == "es" ? "" : "en/"?>peliculas/" class="Changa uppercase <?=isset($activeMenu) && $activeMenu == 2 ? 'active' : ''?>">Películas</a></li>
    <li>
      <a href="<?=$lang == "es" ? "" : "en/"?>series/" class="Changa uppercase <?=isset($activeMenu) && $activeMenu == 3 ? 'active' : ''?>">Series</a>
    </li>
    <li><a href="javascript:;" class="Changa uppercase nohover">SERVICIOS DE PRODUCCIÓN</a>
    <ul>
        <li><a href="<?=$lang == "es" ? "" : "en/"?>servicios-de-produccion/peliculas/" class="Changa uppercase <?=isset($activeMenu) && $activeMenu == 4 ? 'active' : ''?>">Películas</a></li>
        <li><a href="<?=$lang == "es" ? "" : "en/"?>servicios-de-produccion/series/" class="Changa uppercase <?=isset($activeMenu) && $activeMenu == 8 ? 'active' : ''?>">Series</a></li>
      </ul>
  </li>
    <li><a href="<?=$lang == "es" ? "" : "en/"?>contactanos/" class="Changa uppercase <?=isset($activeMenu) && $activeMenu == 5 ? 'active' : ''?>">contáctanos</a></li>
    <li><a href="<?=$lang == "es" ? "" : "en/"?>noticias/" class="Changa uppercase <?=isset($activeMenu) && $activeMenu == 6 ? 'active' : ''?>">Noticias</a></li>
    <li><a href="<?=$lang == "es" ? "" : "en/"?>comunicados-de-prensa" class="Changa uppercase <?=isset($activeMenu) && $activeMenu == 7 ? 'active' : ''?>">Prensa</a></li>
  </ul>
</nav>