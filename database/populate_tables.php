<?php
    $env = parse_ini_file("../.env") or die("Unable to parse environment file!");


    $conn = new mysqli($env["DB_HOST"], $env["DB_USER"], $env["DB_PASS"], $env["DB_NAME"]);
    if ($conn->connect_error)
    {
        die("Unable to connect to database: " . $conn.connect_error);
    }


    /*** Populate weather conditions ***/
    $conditions = json_decode(file_get_contents("../weatherapi/weather_conditions.json"));

    $sql = "INSERT INTO `conditions` (code, day, night, icon) VALUES";
    foreach ($conditions as $c)
    {
        $sql .= " ("
          . $c->code . ', "'
          . $c->day . '", "'
          . $c->night . '", '
          . $c->icon . '),';
    }
    $sql = substr_replace($sql, ';', -1);
    echo "$sql\n\n\n";

    if (!$conn->query($sql))
        die("Unable to populate conditions table: " . $conn->error);

    /*** Populate weather quotes ***/
    $quotes = json_decode(file_get_contents("../weatherquotes.json"));
    foreach(glob("../weatherquotes/*json") as $filename)
    {
        echo "Parsing $filename\n";
        $quotes = json_decode(file_get_contents("$filename"));

        $sql = "INSERT INTO `weatherquotes` (code, tempmin, tempmax, day, night, quote, source) VALUES";

        foreach ($quotes as $q)
        {
            foreach ($q->codes as $c)
            {
                $sql .= " ("
                . $c . ', '
                . $q->tempmin . ', '
                . $q->tempmax . ', '
                . $q->day + 0 . ', '
                . $q->night + 0 . ', "'
                . $q->quote . '", "'
                . $q->source . '"),';
            }
        }
        $sql = substr_replace($sql, ';', -1);
        echo "$sql\n\n\n";

        if (!$conn->query($sql))
           die("Unable to populate weatherquotes table: " . $conn->error);
    }


    /*** Populate location quotes ***/
    $quotes = json_decode(file_get_contents("../locationquotes.json"));

    $sql = "INSERT INTO `locationquotes` (location, quote, source) VALUES";
    foreach ($quotes as $q)
    {
        foreach ($q->locations as $l)
        {
            $sql .= ' ("'
              . $l . '", "'
              .$q->quote . '", "'
              .$q->source . '"),';
        }
    }
    $sql = substr_replace($sql, ';', -1);

    if (!$conn->query($sql))
        die("Unable to populate locationquotes table: " . $conn->error);

    /*** Populate time quotes ***/
    $quotes = json_decode(file_get_contents("../timequotes.json"));

    $sql = "INSERT INTO `timequotes` (timestart, timeend, quote, source) VALUES";
    foreach ($quotes as $q)
    {
        $sql .= '("'
          . $q->timestart . '", "'
          . $q->timeend . '", "'
          . $q->quote . '", "'
          . $q->source . '"),';
    }
    $sql = substr_replace($sql, ';', -1);

    if (!$conn->query($sql))
        die("Unable to populate timequotes table: " . $conn->error);
?>