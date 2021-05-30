document.addEventListener('DOMContentLoaded', () => {

    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach(el => {
            el.addEventListener('click', () => {

                // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementById(target);

                // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

            });
        });
    }

});

function openLogin() {
    let modal = document.getElementById('modal-login');
    let html = document.documentElement;

    modal.className += ' is-active';
    html.className += ' is-clipped';
}

function closeLogin() {
    let modal = document.getElementById('modal-login');
    let html = document.documentElement;

    modal.classList.remove('is-active');
    html.classList.remove('is-clipped');
}

function changeLogin() {
    let logDiv = document.getElementById('logDiv');
    let signDiv = document.getElementById('signDiv');

    let logTitle = document.getElementById('logTitle');
    let logText = document.getElementById('logText');

    if (logDiv.style.display != 'none') {
        logDiv.style.display = 'none';
        signDiv.style.display = 'block';

        logTitle.textContent='Registrati';
        logText.innerHTML = 'Sei già registrato? ';

        let tag = document.createElement('a');
        let a = document.createTextNode("Accedi!");
        tag.appendChild(a);
        tag.onclick = function () { changeLogin(); };

        logText.appendChild(tag);
        

    } else {
        logDiv.style.display = 'block';
        signDiv.style.display = 'none';
        
        logTitle.textContent = 'Accedi';
        logText.innerHTML = 'Non sei registrato? ';

        let tag = document.createElement('a');
        let a = document.createTextNode("Registrati!");
        tag.appendChild(a);
        tag.onclick = function () { changeLogin(); };

        logText.appendChild(tag);
    }
}


// --- AJAX Things ---

function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "test.php?q=" + str, true);
        xmlhttp.send();
    }
}