<!DOCTYPE html>
<html lang="pl"> <!-- Deklaracja dokumentu HTML i ustawienie języka na polski -->
<head>
    <meta charset="UTF-8"> <!-- Ustawienie kodowania znaków na UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Optymalizacja dla Internet Explorera -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsywność strony -->
    <title>Rozgrywki futbolowe</title> <!-- Tytuł strony wyświetlany w przeglądarce -->
    <link rel="stylesheet" href="./styl.css"> <!-- Połączenie z zewnętrznym plikiem CSS -->
</head>
<body>
    <!-- Sekcja nagłówka -->
    <header>
        <h2>Światowe rozgrywki piłkarskie</h2> <!-- Nagłówek strony -->
        <img src="./obraz1.jpg" alt="boisko"> <!-- Obrazek przedstawiający boisko -->
    </header>
    
    <!-- Sekcja z meczami -->
    <div id="mecze">
       <?php
            // Połączenie z bazą danych
            $conn = mysqli_connect('localhost', 'root', '', 'egzamin');
       
            // Zapytanie SQL wybierające dane o meczach, gdzie "zespol1" to "EVG"
            $q = "SELECT `zespol1`, `zespol2`,`wynik`,`data_rozgrywki` FROM `rozgrywka` WHERE `zespol1` = 'EVG';";

            // Wykonanie zapytania
            $res = mysqli_query($conn, $q);
            
            // Pętla generująca div-y z danymi o meczach
            while($row = mysqli_fetch_array($res)){
                echo "<div>
                    <h3>$row[0] - $row[1]</h3><br> <!-- Nazwy drużyn -->
                    <h4>$row[2]</h4><br> <!-- Wynik meczu -->
                    <p>w dniu: $row[3]</p> <!-- Data meczu -->
                </div>";
            }
       ?>
    </div>
    
    <!-- Sekcja główna -->
    <main>
        <h2>Reprezentacja Polski</h2> <!-- Nagłówek sekcji głównej -->
    </main>
    
    <!-- Sekcja lewa -->
    <section id="lewy">
        <p>Podaj pozycję zawodników (1-bramkarze, 2-obrońcy, 3-pomocnicy, 4-
            napastnicy):</p> <!-- Instrukcja do formularza -->
        <form action="./futbol.php" method="post"> <!-- Formularz wysyłający dane metodą POST -->
            <input type="number" name="liczba"> <!-- Pole do wpisania liczby -->
            <button name="submit">Sprawdź</button> <!-- Przycisk do wysłania danych -->
        </form>
        <ul>
            <?php 
                // Sprawdzenie, czy formularz został wysłany
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $dane = $_POST['liczba']; // Pobranie wprowadzonej liczby
                    if (empty($dane)){ // Sprawdzenie, czy pole jest puste
                        // Nic nie robimy, jeśli pole jest puste
                    } else {
                        // Zapytanie SQL wybierające zawodników o podanej pozycji
                        $q2 = "SELECT `imie`,`nazwisko` FROM `zawodnik` 
                               JOIN pozycja On zawodnik.pozycja_id = pozycja.id 
                               WHERE pozycja.id = $dane;";
                        $res2 = mysqli_query($conn, $q2);

                        // Pętla generująca listę zawodników
                        while($row2 = mysqli_fetch_array($res2)){
                            echo "<li>$row2[0], $row2[1]</li>"; // Wyświetlanie imienia i nazwiska
                        }
                    }
                }
                mysqli_close($conn); // Zamknięcie połączenia z bazą danych
            ?>
        </ul>
    </section>
    
    <!-- Sekcja prawa -->
    <section id="prawy">
        <img src="./zad1.png" alt="piłkarz"> <!-- Obrazek przedstawiający piłkarza -->
        <p>Autor: 000000000</p> <!-- Podpis autora strony -->
    </section>
</body>
</html>
