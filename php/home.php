<!DOCTYPE html>
<html class="has-navbar-fixed-top" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mall@Home | Home</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/bulma.min.css">
    <link rel="stylesheet" href="../css/mybulma.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/bulma-calendar.min.css">
</head>

<body>
    <div id="modal-login" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box px-5 py-4">
                <h1 id="logTitle" class="has-text-centered is-size-3 mb-4">Accedi</h1>

                <form action="">
                    <!-- INIZIO SEZIONE ACCEDI -->

                    <div id="logDiv" class="">
                        <div class="field">
                            <label class="label">Username</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" placeholder="Es. Luigi987">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user-circle"></i>
                                </span>
                            </div>
                        </div>
                    
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" placeholder="Es. CiaoMondo32">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>
                    
                        <div class="field">
                            <div class="control buttons is-centered mt-5">
                                <button class="button is-success">Accedi</button>
                            </div>
                        </div>
                    </div>

                    <!-- FINE SEZIONE ACCEDI -->

                    <!-- INIZIO SEZIONE REGISTRAZIONE -->

                    <div id="signDiv" class="hidden">
                        <div class="columns">
                            <div class="column is-6 mb-0 pb-0 field">
                                <label class="label">Nome</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" placeholder="Luca">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-signature"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="column mb-0 pb-0 field">
                                <label class="label">Cognome</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" placeholder="Di Giacomo">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-signature"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" placeholder="luca.giacomo24@mail.com">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control has-icons-left">
                                <input class="input" type="password" placeholder="qwerty098">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column is-7 mb-0 pb-0 field">
                                <label class="label">Data di nascita</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="date">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="column mb-0 pb-0 field">
                                <label class="label">Città</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" placeholder="Milano">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-building"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column is-9 mb-0 field">
                                <label class="label">Indirizzo</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" placeholder="Via Giulio Cesare">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-globe-europe"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="column mb-0 field">
                                <label class="label">Civico</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="number" placeholder="86">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-compass"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="field">
                            <div class="control">
                                <label class="checkbox">
                                    <input type="checkbox">
                                    Accetto i <a href="termini.html">termini e condizioni</a>
                                </label>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control buttons is-centered mt-5">
                                <button class="button is-success">Registrati</button>
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
            <a class="navbar-item" href="home.html">
                Mall@Home
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
                        <a class="navbar-item" href="../html/contatti.html">
                            Contatti
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="../html/segnalazioni.html">
                            Segnala un problema
                        </a>
                    </div>
                </div>

                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-link" onclick="openLogin();">
                            Accedi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="columns is-mobile divHeader">
        <div class="column is-6 is-offset-3 box has-text-centered divSearch">
            <h1 class="my-2">Inserisci la tua località per visualizzare gli alimentari disponibili in zona</h1>
            
            <form action="">
                <input class="column is-6 input is-primary mt-4 mb-2" type="text" placeholder="Es. Milano"
                    onkeyup="showHint(this.value)">
            </form>
            <span id="txtHint"></span>
        </div>
    </div>

    <div class="test">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>

    <footer class="footer">
        <div class="content has-text-centered">
          <p>
            <strong>Mall@Home</strong> creato da Alessio Ricciuti. Il codice sorgente usa la licenza
            <a href="http://opensource.org/licenses/mit-license.php">MIT</a>.
          </p>
        </div>
    </footer>
</body>

<script src="https://kit.fontawesome.com/0d1c6dcc96.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
<script src="../js/bulma-calendar.min.js"></script>
</html>

