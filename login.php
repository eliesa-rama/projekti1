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

// Kërko përdoruesin në bazën e të dhënave
$sql = "SELECT fjalekalimi FROM perdoruesi WHERE emri='$emri'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verifiko fjalëkalimin
    if (password_verify($fjalekalimi, $row['fjalekalimi'])) {
        echo "Kyçja u krye me sukses!";
    } else {
        echo "Fjalëkalimi është i gabuar.";
    }
} else {
    echo "Përdoruesi nuk ekziston.";
}

$conn->close();
?>
