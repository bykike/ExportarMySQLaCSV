<?php
    // Detalles de conexión a la base de datos

    $host = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "BDRRHH";

    // Conectamos a la base de datos

    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Error en la conexión: " . mysqli_error($connection));

    //$tildes = $connection->query("SET NAMES 'utf8'");

    // Extraemos los datos

    $sql = "select * from BDAltasCandi";
    $result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

    $fp = fopen('books.csv', 'w');

    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($fp, $row);
    }
    
    fclose($fp);

    // Cerramos conexión

    mysqli_close($connection);
?>