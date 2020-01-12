<?php
require_once("config.php");

    $polaczenie = @new mysqli($host, $user, $password, $name);

function dni_mies($mies,$rok) {

 $dni = 31;
 while (!checkdate($mies, $dni, $rok)) $dni--;

return $dni;
}

function dzien_tyg_nr($mies,$rok) {

 $dzien = date("w", mktime(0,0,0,$mies,1,$rok));


return $dzien;
}

function dzien_tyg($nr) {

 $dzien = array(0 => "Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Pi&#177;tek", "Sobota");

return $dzien[$nr];
}


function miesiac_pl($mies) {

 $mies_pl = array(1=>"Stycznia", "Lutego", "Marca", "Kwietnia", "Maja", "Czerwieca", "Lipieca", "Sierpnia", "Wrze&#182;nia", "PaĽdziernika", "Listopada", "Grudnia");

return $mies_pl[$mies];
}

?>

<html>
<head>
<title>Kalendarz</title>

<meta http-equiv="content-type" content="text/xml; charset=iso-8859-2" />
<meta http-equiv="content-language" content="pl" />

<link rel="Stylesheet" href="css/style2.css">

</head>
<body>

<div id="kalendarz">
<?php
echo "Dzisiaj jest:".'<p>'.dzien_tyg(date("w")).', '.date("d").' '.miesiac_pl(date("n")).' '.date("Y").'</p>';
?>
<ul>
 <li>N&nbsp;</li>
 <li>Pn</li>
 <li>Wt</li>
 <li>Śr</li>
 <li>Cz</li>
 <li>Pt</li>
 <li>Sb</li>
</ul>

<ul>
<?php
for($i=0;$i<dzien_tyg_nr(date("n"),date("Y"));$i++)
 echo '<li class="hidden">00</li> ';

for($i=1;$i<dni_mies(date("n"),date("Y")) +1;$i++) {
 if ($i<10) $i = '0'.$i;
 if ($i == date("d")) echo '<li class="akt">'.$i.'</li> ';
  else echo '<li>'.$i.'</li> ';
}
?>
</ul>
<div>

</body>
</html>