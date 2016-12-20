<?php
    // mysql database connection details
    $host = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "BDRRHH";

    // open connection to mysql database
    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Connection Error " . mysqli_error($connection));

    $tildes = $connection->query("SET NAMES 'utf8'");

    // fetch mysql table rows
    $sql = "select * from BDAltasCandi";
    $result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

    $fp = fopen('books.csv', 'w');

    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($fp, $row);
    }
    
    fclose($fp);

    //close the db connection
    mysqli_close($connection);
?>