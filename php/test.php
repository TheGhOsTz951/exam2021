<?php
    $servername = "localhost";
    $username = "bottegasasso";
    $password = "";
    $dbname = "my_info";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT cognome FROM alunni";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $a[] = $row['cognome'];
        }
    } else {
        echo "0 results";
    }

    $q = $_REQUEST["q"];

    $hint = "";

    // lookup all hints from array if $q is different from ""
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);

        foreach($a as $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($hint === "") {
                    $hint = $name;
                } else {
                    $hint .= ", $name";
                }
            }
        }
    }

    // Output "no suggestion" if no hint was found or output correct values
    echo $hint === "" ? "no suggestion" : $hint;
?>