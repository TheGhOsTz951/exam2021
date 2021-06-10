<?php
    $servername = "localhost";
    $username = "bottegasasso";
    $password = "";
    $dbname = "my_bottegasasso";

    session_start();
    
    $name = $surname = $mail = $pw = $date = $city = $address = $civic = '';
    $logErr = $nameErr = $surnameErr = $mailErr = $pwErr = $dateErr = $cityErr = $addressErr = $civicErr = $acceptErr = '';

    $err = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vari controlli agli input del form
        if (empty($_POST["sign_name"])) {  // Nome
            $nameErr = '* Inserire nome';
            $err++;
        } else {
            $name = test_input($_POST["sign_name"]);

            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "* Inserire solo lettere";
                $err++;
            }
        }

        if (empty($_POST["sign_surname"])) {  // Cognome
            $surnameErr = '* Inserire cognome';
            $err++;
        } else {
            $surname = test_input($_POST["sign_surname"]);

            if (!preg_match("/^[a-zA-Z-' ]*$/", $surname)) {
                $surnameErr = "* Inserire solo lettere";
                $err++;
            }
        }

        if (empty($_POST["sign_email"])) {  // Email
            $mailErr = '* Inserire email';
            $err++;
        } else {
            $mail = test_input($_POST["sign_email"]);
        }

        if (empty($_POST["sign_password"])) {  // Password
            $pwErr = '* Inserire password';
            $err++;
        } else {
            $pw = test_input($_POST["sign_password"]);
        }

        if (empty($_POST["sign_date"])) {  // Data
            $dateErr = '* Inserire data';
            $err++;
        } else {
            $date = test_input($_POST["sign_date"]);
        }

        if (empty($_POST["sign_city"])) {  // Città
            $cityErr = '* Inserire città';
            $err++;
        } else {
            $city = test_input($_POST["sign_city"]);

            if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
                $cityErr = "* Inserire solo lettere";
                $err++;
            }
        }

        if (empty($_POST["sign_address"])) {  // Indirizzo
            $addressErr = '* Inserire indirizzo';
            $err++;
        } else {
            $address = test_input($_POST["sign_address"]);

            if (!preg_match("/^[a-zA-Z-' ]*$/", $address)) {
                $addressErr = "* Inserire solo lettere";
                $err++;
            }
        }

        if (empty($_POST["sign_civic"])) {  // Civico
            $civicErr = '* Inserire civico';
            $err++;
        } else {
            $civic = test_input($_POST["sign_civic"]);
        }

        if (!isset($_POST["sign_accept"])) {  // Checkbox
            $acceptErr = '* Accetta per registrarti';
            $err++;
        }

        // Controllo errori
        if ($err == 0) {
            $pw_hash = password_hash($pw, PASSWORD_BCRYPT);

            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Errore del database! Riprova più tardi.");
            } 

            $sql = "INSERT INTO Utente (nome, cognome, email, pw, città, indirizzo, civico, dataNascita)
            VALUES ('$name', '$surname', '$mail', '$pw_hash', '$city', '$address', '$civic', '$date')";

            if ($conn->query($sql) === TRUE) {
                echo "Registrazione riuscita!";
            } else {
                echo "Errore nella registrazione";
            }

            $conn->close();
        }
        
        header("Location: http://localhost/exam2021/php/home.php?id=" . $nameErr . "&sex=" . $surnameErr);
    }

    // Testa gli input per evitare js injection
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>