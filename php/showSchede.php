<?php
    $servername = "localhost";
    $username = "bottegasasso";
    $password = "";
    $dbname = "my_bottegasasso";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT nominativo, descrizione, città, indirizzo, civico FROM negozio";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $cities[] = $row['città'];
            $schede[] = "<div class='scheda-interna'><h1>" . $row['nominativo'] . 
            "</h1><p>" . $row['descrizione'] . "</p></div>";
        }
    } else {
        echo "0 results";
    }

    $q = $_REQUEST["q"];

    $result = "";

    // lookup all hints from array if $q is different from ""
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);

        $cont = 0;

        foreach($cities as $city) {
            if (stristr($q, substr($city, 0, $len))) {
                if ($result === "") {
                    $result = $schede[$cont];
                } else {
                    $result .= $schede[$cont];
                }
            }

            $cont++;
        }
    }

    // Output "no suggestion" if no hint was found or output correct values
    echo $result === "" ? "<p style='color:red'>Nessun negozio presente nella città inserita</p>" : $result;
?>