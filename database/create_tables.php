<?php
    $env = parse_ini_file("../.env") or die("Unable to parse environment file!");

    $DB_HOST = $env["DB_HOST"];
    $DB_USER = $env["DB_USER"];
    $DB_PASS = $env["DB_PASS"];
    $DB_NAME = $env["DB_NAME"];

    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if ($conn->connect_error)
    {
        die("Unable to connect to database: " . $conn.connect_error);
    }

    foreach(glob("*.sql") as $filename)
    {
        echo "Executing $filename\n";
        $file = fopen($filename, "r") or die("Can't open $filename!");
        $sql = fread($file, filesize($filename));
        if (!$conn->query($sql))
            echo "Error executing $filename: " . $conn->error;   
    }


?>