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

echo '<p>'."Dzisiaj jest:  <br/>".dzien_tyg(date("w")).', '.date("d").' '.miesiac_pl(date("n")).' '.date("Y").'</p>';
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

<form action="wynik.php" method="post">
    <p1>
        <label>
            Wybierz datę raportu
        </label>
    </p1>

	<select name="dzien">
        <option>01</option>
        <option>02</option>
        <option>03</option>
        <option>04</option>
        <option>05</option>
        <option>06</option>
        <option>07</option>
        <option>08</option>
        <option>09</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>
        <option>21</option>
        <option>22</option>
        <option>23</option>
        <option>24</option>
        <option>25</option>
        <option>26</option>
        <option>27</option>
        <option>28</option>
        <option>29</option>
        <option>30</option>
        <option>31</option>
    </select>
    
    <select name="miesiac">
        <option>01</option>
        <option>02</option>
        <option>03</option>
        <option>04</option>
        <option>05</option>
        <option>06</option>
        <option>07</option>
        <option>08</option>
        <option>09</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
    </select>
    
    <select name="rok">
        <option>2020</option>
    </select>

<button id="sender"> WYBIERZ DATĘ</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
 
   $("#sender").click(function(){
 
   $.get("skrypt.php?akcja");
 
   });
 
});
<script>

</form>
</body>
</html>