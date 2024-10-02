<?php
// Konfigurimi i lidhjes me bazën e të dhënave
$servername = "localhost";
$username = "root"; // Ndrysho në emrin tënd të përdoruesit
$password = ""; // Ndrysho në fjalëkalimin tënd
$dbname = "klienti";

// Krijo lidhjen
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Lidhja dështoi: " . $conn->connect_error);
}

// Merr të dhënat nga forma
$emri = $_POST['emri'];
$fjalekalimi = $_POST['fjalekalimi'];

// Kripto fjalëkalimin
$fjalekalimi_kript = password_hash($fjalekalimi, PASSWORD_DEFAULT);

// Fut të dhënat në tabelë
$sql = "INSERT INTO perdoruesi (emri, fjalekalimi) VALUES ('$emri', '$fjalekalimi_kript')";

if ($conn->query($sql) === TRUE) {
    echo "Regjistrimi u krye me sukses!";
} else {
    echo "Gabim: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
