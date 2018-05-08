<?php
    $cadena="";

    if($teacher==0)
    {
        $user_access= array();
        $myfile = fopen("students.txt", "r") or die("Unable to open file!");
        // Output one line until end-of-file
        while(!feof($myfile)) 
        {
            $cadena=$cadena . fgets($myfile);
        }

        fclose($myfile);

        $porciones = explode("\r\n", $cadena);
        for($i=0;$i<count($porciones)-1;$i++)
        {
            $por = explode("\t",$porciones[$i]);
            $user_access[]=[
                'matricula'=>$por[0],
                'nombre'=>$por[1],
                'carrera'=>$por[2],
                'correo'=>$por[3],
                'telefono'=>$por[4]];
        }    
    }
    else if($teacher==1)
    {
        $user_access= array();
        $myfile = fopen("teachers.txt", "r") or die("Unable to open file!");
        // Output one line until end-of-file
        while(!feof($myfile)) 
        {
            $cadena=$cadena . fgets($myfile);
        }

        fclose($myfile);

        $porciones = explode("\r\n", $cadena);
        for($i=0;$i<count($porciones)-1;$i++)
        {
            $por = explode("\t",$porciones[$i]);
            $user_access[]=[
                'numero'=>$por[0],
                'nombre'=>$por[1],
                'carrera'=>$por[2],
                'telefono'=>$por[3]];
        }
    }
    
?>


<?php

