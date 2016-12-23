            
 <?php 

    // Forma 1 de descarga de archivo

    header("Content-disposition: attachment; filename=books.csv");
    header("Content-type: MIME");
    readfile("books.csv");


    // Forma 2 de descarga de archivo

    $filename="books.csv";
    $ctype=mime_content_type($filename);
    $file=basename($filename);

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: $ctype");
    $user_agent = strtolower ($_SERVER["HTTP_USER_AGENT"]);

    if ((is_integer (strpos($user_agent, "msie"))) && (is_integer (strpos($user_agent, "win"))))
    {
        header("Content-Disposition: filename=$file;");
    }
    else {
        header("Content-Disposition: attachment; filename=$file;");
    }

    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".filesize($filename));
    @readfile($filename);



    // Forma 3 de descarga de archivo

    $fileUrl='books.csv';
    downloadFile($fileUrl);

    // Usamos una función que pasaremos el nombre del archivo
    function downloadFile($fileUrl){
                // Obtengo el tamaño del archivo	
                if (substr($fileUrl,0,4)=='http') {
                    $fileSize = array_change_key_case(get_headers($fileUrl, 1),CASE_LOWER);
                    if ( strcasecmp($fileSize[0], 'HTTP/1.1 200 OK') != 0 ) { $fileSize = $fileSize['content-length'][1]; }
                    else { $fileSize = $fileSize['content-length']; }
                } else { $fileSize = @filesize($fileUrl); }

                // Descargo el archivo
                $ctype="application/octet-stream";
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false);
                header("Content-Type: $ctype");

                header("Content-Disposition: attachment; filename=\"".basename($fileUrl)."\";" );
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: ".$fileSize);
                readfile("$fileUrl");
                exit();
 
     }



?>