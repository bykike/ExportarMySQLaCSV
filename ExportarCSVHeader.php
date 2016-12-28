<?php
// Función para descarga de archivo xls, válido PHP 4, PHP 5. 
function export_excel_csv()
{
    $conn = mysql_connect("localhost","root","root");
    $db = mysql_select_db("BDRRHH",$conn);

    
    $sql = "SELECT * FROM BDAltasCandi";
    $rec = mysql_query($sql) or die (mysql_error());
    
    $num_fields = mysql_num_fields($rec);
    
    echo $num_fields;
 
    for($i = 0; $i < $num_fields; $i++ )
    {
        $header .= mysql_field_name($rec,$i)."\t";
    }
      
    while($row = mysql_fetch_row($rec))
    {
        $line = '';
        foreach($row as $value)
        {                                            
            if((!isset($value)) || ($value == ""))
            {
                $value = "\t";
            }
            else
            {
                $value = str_replace( '"' , '""' , $value );
                $value = '"' . $value . '"' . "\t";
            }
            $line .= $value;
        }
        $data .= trim( $line ) . "\n";
    }
    
    $data = str_replace("\r" , "" , $data);
    
    if ($data == "")
    {
        $data = "\\n No Record Found!\n";                        
    }
    
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=reports.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$header\n$data";
}

export_excel_csv();

?>