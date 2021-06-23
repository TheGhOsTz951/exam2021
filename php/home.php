<!DOCTYPE html>

<?php
    $servername = "localhost";
    $username = "labottegadisasso";
    $password = "";
    $dbname = "my_labottegadisasso";

    $type = '0';
    $name = $surname = $mail = $pw = $date = $city = $address = $civic = '';

    $logErr = $nameErr = $surnameErr = $mailErr = $pwErr = $dateErr = $cityErr = $addressErr = $civicErr = $acceptErr = '';
    $err = 0;

    session_start();
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type = test_input($_POST["tipo"]);

        if ($type == 0) {  // Type = 0 indica la login
            $mail = test_input($_POST["log_mail"]);
            $pw = test_input($_POST["log_password"]);
            $hash = null;

            $conn = new mysqli($servername, $username, $password, $dbname);
                
            if ($conn->connect_error) {
                die("Errore del database! Riprova più tardi.");
            }

            $sql = "SELECT pw FROM Utente WHERE email='$mail'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $hash = $row['pw'];
                }
            }

            // Verifica se l'hash corrisponde alla password (hash: password cifrata)
            $verify = password_verify($pw, $hash);

            // Se la password è giusta assegna un valore alla variabile di sessione per far capire che l'utente ha loggato
            if ($verify) {
                $_SESSION['email'] = $mail;
            } else {
                $logErr = "* Email o password errata";
                $err++;
            }

            $conn->close();
        } else if ($type == 1) {  // Type = 1 indica la registrazione
            
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
        } else {
            echo 'Errore nella compilazione da parte del sito! Riprova!';
        }
    }
    
    // Se nella url il valore get = true l'if parte
    if (isset($_GET['exit'])) {
        unset($_SESSION['email']);
    }

    // Se la variabile di sessione email esiste vuol dire che l'utente ha loggato
    if (isset($_SESSION['email'])) {
        $logButton = '<a id="logButton" class="button is-danger" href="home.php?exit=true">Esci</a>';
    } else {
        $logButton = '<a id="logButton" class="button is-link" onclick="openLogin();">Accedi</a>';
    }

    // Testa gli input per evitare js injection
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<html class="has-navbar-fixed-top" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mall@Home | Home</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/bulma.min.css">
    <link rel="stylesheet" href="../css/mybulma.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../images/logo.ico">
</head>

<body>
    <div id="modal-login" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box px-5 py-4">
                <h1 id="logTitle" class="has-text-centered is-size-3 mb-4">Accedi</h1>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">  
                    <!-- INIZIO SEZIONE ACCEDI -->

                    <div id="logDiv" class="">
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" name="log_mail" type="email" placeholder="rossi.luigi@email.com"
                                value="<?php echo isset($_POST['log_mail']) ? $_POST['log_mail'] : '' ?>">

                                <span class="icon is-small is-left">
                                    <i class="fas fa-user-circle"></i>
                                </span>
                            </div>
                        </div>
                    
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control has-icons-left">
                                <input class="input" name="log_password" type="password" placeholder="CiaoMondo32"
                                value="<?php echo isset($_POST['log_password']) ? $_POST['log_password'] : '' ?>">

                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>

                        <p class="help is-danger has-text-centered"><?php echo $logErr; ?></p>
                    
                        <div class="field">
                            <div class="control buttons is-centered mt-5">
                                <button class="button is-success" type="submit">Accedi</button>
                            </div>
                        </div>
                    </div>

                    <!-- FINE SEZIONE ACCEDI -->

                    <input type="text" name="tipo" id="typeTeller" class="hidden" value="0">

                    <!-- INIZIO SEZIONE REGISTRAZIONE -->

                    <div id="signDiv" class="hidden">
                        <div class="columns">
                            <div class="column is-6 mb-0 pb-0 field">
                                <label class="label">Nome</label>
                                <div class="control has-icons-left">
                                    <input class="input" name="sign_name" type="text" placeholder="Luca" 
                                    value="<?php echo isset($_POST['sign_name']) ? $_POST['sign_name'] : '' ?>">

                                    <span class="icon is-small is-left">
                                        <i class="fas fa-signature"></i>
                                    </span>
                                </div>
                                <p class="help is-danger"><?php echo $nameErr; ?></p>
                            </div>
                            
                            <div class="column mb-0 pb-0 field">
                                <label class="label">Cognome</label>
                                <div class="control has-icons-left">
                                    <input class="input" name="sign_surname" type="text" placeholder="Di Giacomo"
                                    value="<?php echo isset($_POST['sign_surname']) ? $_POST['sign_surname'] : '' ?>">

                                    <span class="icon is-small is-left">
                                        <i class="fas fa-signature"></i>
                                    </span>
                                </div>
                                <p class="help is-danger"><?php echo $surnameErr; ?></p>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" name="sign_email" type="email" placeholder="luca.giacomo24@mail.com"
                                value="<?php echo isset($_POST['sign_email']) ? $_POST['sign_email'] : '' ?>">

                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <p class="help is-danger"><?php echo $mailErr; ?></p>
                        </div>

                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control has-icons-left">
                                <input class="input" name="sign_password" type="password" placeholder="qwerty098"
                                value="<?php echo isset($_POST['sign_password']) ? $_POST['sign_password'] : '' ?>">

                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <p class="help is-danger"><?php echo $pwErr; ?></p>
                        </div>

                        <div class="columns">
                            <div class="column is-7 mb-0 pb-0 field">
                                <label class="label">Data di nascita</label>
                                <div class="control has-icons-left">
                                    <input class="input" name="sign_date" type="date"
                                    value="<?php echo isset($_POST['sign_date']) ? $_POST['sign_date'] : '' ?>">

                                    <span class="icon is-small is-left">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <p class="help is-danger"><?php echo $dateErr; ?></p>
                            </div>
                            
                            <div class="column mb-0 pb-0 field">
                                <label class="label">Città</label>
                                <div class="control has-icons-left">
                                    <input class="input" name="sign_city" type="text" placeholder="Milano"
                                    value="<?php echo isset($_POST['sign_city']) ? $_POST['sign_city'] : '' ?>">

                                    <span class="icon is-small is-left">
                                        <i class="fas fa-building"></i>
                                    </span>
                                </div>
                                <p class="help is-danger"><?php echo $cityErr; ?></p>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column is-9 mb-0 field">
                                <label class="label">Indirizzo</label>
                                <div class="control has-icons-left">
                                    <input class="input" name="sign_address" type="text" placeholder="Via Giulio Cesare"
                                    value="<?php echo isset($_POST['sign_address']) ? $_POST['sign_address'] : '' ?>">

                                    <span class="icon is-small is-left">
                                        <i class="fas fa-globe-europe"></i>
                                    </span>
                                </div>
                                <p class="help is-danger"><?php echo $addressErr; ?></p>
                            </div>

                            <div class="column mb-0 field">
                                <label class="label">Civico</label>
                                <div class="control has-icons-left">
                                    <input class="input" name="sign_civic" type="number" placeholder="86"
                                    value="<?php echo isset($_POST['sign_civic']) ? $_POST['sign_civic'] : '' ?>">

                                    <span class="icon is-small is-left">
                                        <i class="fas fa-compass"></i>
                                    </span>
                                </div>
                                <p class="help is-danger"><?php echo $civicErr; ?></p>
                            </div>
                        </div>
                        
                        <div class="field">
                            <div class="control">
                                <label class="checkbox">
                                    <input type="checkbox" name="sign_accept">
                                    Accetto i <a href="../html/termini.html">termini e condizioni</a>
                                </label>
                            </div>
                            <p class="help is-danger"><?php echo $acceptErr; ?></p>
                        </div>

                        <div class="field">
                            <div class="control buttons is-centered mt-5">
                                <button class="button is-success" type="submit">Registrati</button>
                            </div>
                        </div>
                    </div>

                    <!-- FINE SEZIONE REGISTRAZIONE -->
                </form>

                <p id="logText" class="help has-text-centered mt-5">
                    Non sei registrato? <a onclick="changeLogin();">Registrati!</a>
                </p>
            </div>
        </div>
        <button class="modal-close is-large" aria-label="close" onclick="closeLogin();"></button>
    </div>

    <nav class="navbar is-fixed-top is-primary has-shadow">
        <div class="navbar-brand">
            <a class="navbar-item" href="../php/home.php">
                <img src="../images/logoMH.png" alt="Mall@Home" id="brand-logo">
            </a>

            <a id='brand-name' class="navbar-item" href="../php/home.php">
                MALL@HOME
            </a>
    
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
    
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                
            </div>
    
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Altro
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="../html/termini.html">
                            Termini e condizioni
                        </a>
                        <a class="navbar-item" href="../html/privacy.html">
                            Privacy policy
                        </a>
                        <a class="navbar-item" href="#">
                            Contatti
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="mailto:mallathome@gmail.com?subject=Segnalazione problema&body=Vorrei far notare il problema relativo a - SCRIVERE QUI IL PROBLEMA -">
                            Segnala un problema
                        </a>
                    </div>
                </div>

                <div class="navbar-item">
                    <div class="buttons">
                        <?php echo $logButton; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="columns is-mobile divHeader mb-0">
            <div class="column is-10 is-offset-1 has-text-centered divSearch">
                <h1 id="searchTitle" class="my-2">Cerca la tua Città</h1>
        
                <div id="searchBar" class="column">
                    <div class="control has-icons-left">
                        <input class="input is-primary py-5" type="text" placeholder="Es. Milano"
                            onkeyup="showHint(this.value)">
        
                        <span class="icon is-small is-left py-5">
                            <i class="fas fa-signature"></i>
                        </span>
                    </div>
                </div>
        
                <div id="schede-negozi"></div>
            </div>
        
            <div class=""></div>
        </div>
    </main>
        
        
    <footer class="footer">
        <div class="content has-text-centered">
            <p id='footer-text'>
                <strong>Mall@Home</strong> creato da Alessio Ricciuti. Il codice sorgente usa la licenza
                <a id='footer-link' href="http://opensource.org/licenses/mit-license.php">MIT</a>.
            </p>
        </div>
    </footer>
</body>

<script src="https://kit.fontawesome.com/0d1c6dcc96.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
</html>

<?php 
    // Se ci sono stati errori nella login/signup, riapre l'ultima utilizzata
    if ($err > 0 && $type == 1) {
        echo '<script>openLogin(); changeLogin();</script>';
    } else if ($err > 0 && $type == 0) {
        echo '<script>openLogin();</script>';
    }
?>