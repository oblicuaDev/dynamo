<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=export_data.xls");  //File name extension was wrong
include '../includes/config.php';
$db = new dbase();
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
          $query = "SELECT * FROM `forms` WHERE `parent_for` LIKE '%".$_GET['vacante']."%' AND type_for=5 AND reg_eli = 0";
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
$result = $db->customQuery($query);
$string = '<table style="width:100%">';
$valid_ext = array("pdf","doc","docx","jpg","png","jpeg");

$jArr = json_decode($result->fetch_assoc()['content_for'], true);
$string .= '<tr>';
foreach ($jArr as $key => $item) {
    $string .= '<th>'.$key.'</th>';
}
$string .= '</tr>';

while ($row = $result->fetch_assoc()) { 
    $jArr = json_decode($row['content_for'], true);
    $string .= '<tr>';
    foreach ($jArr as $key => $item) {
        if(in_array(explode(".", $item)[1],$valid_ext)){
            $string .= '<td><a href="https://dynamo.mottif.tv/set/uploads/'.$item.'">https://dynamo.mottif.tv/set/uploads/'.$item.'</a></td>';  
        }else{
            $string .= '<td>'.$item.'</td>';  
        }
    }
    $string .= '</tr>';
}
$string .= '</table>';
echo $string;
?>