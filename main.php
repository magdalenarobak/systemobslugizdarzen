<?php
    session_start();

    if(!isset($_SESSION['zalogowany'])){
        header ("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl-PL">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title>Strona_glowna</title>
        <link rel="stylesheet" href="css/main_style.css" type="text/css">
        <link rel="stylesheet" href="css/main_style2.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
	
    <body>
	<div class="all"> 
	<br/>
	<div class="naglowek">System obsługi zadań</div>
	    <div class="create">
            <a href="task.php"><button type="button" id="btn">Utwórz zadanie</button></a>
            <a href="date.php"><button type="button" id="btn">Raport</button></a>

            <div class="procent">
            <?php
            require_once("config.php");

            $polaczenie = @new mysqli($host, $user, $password, $name);
        
            if($polaczenie->connect_errno!=0){
                echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
            } 
            $sql = "SELECT * FROM Zdarzenia WHERE idKategorii=3";
            
            $result = $polaczenie->query($sql);
             if($result->num_rows >0){
                $zm=0;
                while($row = $result->fetch_assoc()){
                    $zm++;
                }
            }


            $sql2 = "SELECT * FROM Zdarzenia";
            
            $result = $polaczenie->query($sql2);
            if($result->num_rows >0){
                $zm1=0;
                while($row = $result->fetch_assoc()){
                    $zm1++;
                }
            }

            $zm3=($zm/$zm1)*100;
            echo "Wykonanych: ".$zm." z ".$zm1."   (".$zm3."%)";
        
            $polaczenie->close();
            ?>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        echo "Użytkownik: <i>".$_SESSION['login']."</i>";
                    ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="logout.php">Wyloguj się</a>
                </div>
            </div>
        </div>
	<br/><br/><br/>
        <header>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Do zrobienia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">W Trakcie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Zrobione</a>
                </li>
            </ul>
        </header>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h2 class="title">Do zrobienia</h2><hr class="h1">

                <?php

                require_once("config.php");

                $polaczenie = @new mysqli($host, $user, $password, $name);
                $polaczenie->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
                $polaczenie->query("SET CHARSET utf8");	
                $zapytanie = "SELECT z.zdarzenie, z.opis, z.data, z.nr_pokoju, p.nazwa, u.imie, u.nazwisko FROM Zdarzenia z
						LEFT JOIN Kategorie k ON z.idKategorii = k.idKategorii
                        LEFT JOIN Priorytety p ON z.idPriorytetu = p.idPriorytetu 
                        LEFT JOIN Uzytkownicy u ON z.idUzytkownika = u.idUzytkownika
                        WHERE k.idKategorii = 1
                        ORDER BY z.data DESC";
                $wynik = $polaczenie->query($zapytanie);
                while ($baza = $wynik->fetch_assoc()){ 
					echo "<div class='butt-input100 validate-input bg1'>";
                        echo "<span class='label-input100'>Temat zadania</span>";
                        echo"<div class='create'>";
                            echo"<div class='input100 input100-big'>".$baza['zdarzenie']."</div>";
                            echo"<div class='no-wrap'>Data i godzina: <i>".$baza['data']."</i><br>
                            Nr pokoju: <i>".$baza['nr_pokoju']."</i></div>";
                        echo"</div>";
                    echo"</div>";

                    echo"<div class='butt-input100 validate-input'>";
                        echo"<span class='label-input100'>Opis zadania</span>";
                        echo"<div class='input100'>".$baza['opis']."</div>";
                    echo"</div>";
                
                    echo"<div class='butt-input100 input100-select bg1'>";
                        echo"<span class='label-input100'>Priorytet zadania</span>";
                        echo"<div class='input100'><b>".$baza['nazwa']."</b></div>";
                    echo"</div>";

                    echo"<div class='butt-input100 validate-input margin-bottom'>";
                        echo"<span class='label-input100'>Wykonawca zadania</span>";
                        echo"<div class='input100'>".$baza['imie']." ".$baza['nazwisko']."</div>";
                    echo"</div>";

                    echo"<a href='update.php'><button class='przycisk'>Zmień status zadania</button></a>";
                    }
                ?>
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h2 class="title">W Trakcie</h2><hr class="h1">
                <?php
	
                $zapytanie = "SELECT z.zdarzenie, z.opis, z.data, z.nr_pokoju, p.nazwa, u.imie, u.nazwisko FROM Zdarzenia z
                LEFT JOIN Kategorie k ON z.idKategorii = k.idKategorii
                LEFT JOIN Priorytety p ON z.idPriorytetu = p.idPriorytetu 
                LEFT JOIN Uzytkownicy u ON z.idUzytkownika = u.idUzytkownika
                WHERE k.idKategorii = 2
                ORDER BY z.data DESC";
                $wynik = $polaczenie->query($zapytanie);
                while ($baza = $wynik->fetch_assoc()){ 
                    echo "<div class='butt-input100 validate-input bg1'>";
                        echo "<span class='label-input100'>Temat zadania</span>";
                        echo"<div class='create'>";
                            echo"<div class='input100 input100-big'>".$baza['zdarzenie']."</div>";
                            echo"<div class='no-wrap'>Data i godzina: <i>".$baza['data']."</i><br>
                            Nr pokoju: <i>".$baza['nr_pokoju']."</i></div>";
                        echo"</div>";
                    echo"</div>";

                    echo"<div class='butt-input100 validate-input'>";
                        echo"<span class='label-input100'>Opis zadania</span>";
                        echo"<div class='input100'>".$baza['opis']."</div>";
                    echo"</div>";

                    echo"<div class='butt-input100 input100-select bg1'>";
                        echo"<span class='label-input100'>Priorytet zadania</span>";
                        echo"<div class='input100'><b>".$baza['nazwa']."</b></div>";
                    echo"</div>";

                    echo"<div class='butt-input100 validate-input margin-bottom'>";
                        echo"<span class='label-input100'>Wykonawca zadania</span>";
                        echo"<div class='input100'>".$baza['imie']." ".$baza['nazwisko']."</div>";
                    echo"</div>";

                    echo"<a href='update.php'><button class='przycisk'>Zmień status zadania</button></a>";
                }
                ?>
            </div>

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <h2 class="title">Zrobione</h2><hr class="h1">
                <?php

                $zapytanie = "SELECT z.zdarzenie, z.opis, z.data, z.nr_pokoju, p.nazwa, u.imie, u.nazwisko FROM Zdarzenia z
                LEFT JOIN Kategorie k ON z.idKategorii = k.idKategorii
                LEFT JOIN Priorytety p ON z.idPriorytetu = p.idPriorytetu 
                LEFT JOIN Uzytkownicy u ON z.idUzytkownika = u.idUzytkownika
                WHERE k.idKategorii = 3
                ORDER BY z.data DESC";
                $wynik = $polaczenie->query($zapytanie);
                while ($baza = $wynik->fetch_assoc()){ 
                    echo "<div class='butt-input100 validate-input bg1'>";
                    echo "<span class='label-input100'>Temat zadania</span>";
                    echo"<div class='create'>";
                        echo"<div class='input100 input100-big'>".$baza['zdarzenie']."</div>";
                        echo"<div class='no-wrap'>Data i godzina: <i>".$baza['data']."</i><br>
                        Nr pokoju: <i>".$baza['nr_pokoju']."</i></div>";
                    echo"</div>";
                    echo"</div>";

                    echo"<div class='butt-input100 validate-input'>";
                    echo"<span class='label-input100'>Opis zadania</span>";
                    echo"<div class='input100'>".$baza['opis']."</div>";
                    echo"</div>";

                    echo"<div class='butt-input100 input100-select bg1'>";
                    echo"<span class='label-input100'>Priorytet zadania</span>";
                    echo"<div class='input100'><b>".$baza['nazwa']."</b></div>";
                    echo"</div>";

                    echo"<div class='butt-input100 validate-input margin-bottom'>";
                    echo"<span class='label-input100'>Wykonawca zadania</span>";
                    echo"<div class='input100'>".$baza['imie']." ".$baza['nazwisko']."</div>";
                    echo"</div>";

                    echo"<a href='update.php'><button class='przycisk'>Zmień status zadania</button></a>";
                }
                ?>
            </div>

        </div>
		
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
	
</html>