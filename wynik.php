
<html>
<link rel="Stylesheet" href="css/style3.css">
<body>

Raport dla dnia: <?php echo $_POST["dzien"]; ?><br>
W miesiącu: <?php echo $_POST["miesiac"]; ?><br>
Rok:<?php echo $_POST["rok"];?><br>
<?php
$dzien = $_POST['dzien'];
        $miesiac = $_POST['miesiac'];
        $rok= $_POST['rok'];

        $data=$rok."-".$miesiac."-".$dzien;
?>


<?php
require_once("config.php");

    $polaczenie = @new mysqli($host, $user, $password, $name);

    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
    } 
    $sql = "SELECT * FROM Zdarzenia WHERE data LIKE '%$data%' and idKategorii=3";
    
    $result = $polaczenie->query($sql);
if($result->num_rows >0){
    $zm=0;
    while($row = $result->fetch_assoc()){
        $zm++;
        echo "W tym dniu zostało wykonanych:  ". $zm ."  zadań";
    }
} else {
    echo "Brak wyników lub w tym dniu nie wykonano żadnych zadań";
}

    $polaczenie->close();
?>
</body>
</html> 