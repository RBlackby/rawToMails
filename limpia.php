<?php

//Expresión regular para determinar si es o no un email
$pattern = '/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,4}\b/i';

//Array para ir guardando los emails válidos
$dbmails = [];

//Leo el archivo txt donde tiene la información de emails con textos sin limpiar
$myFile = new SplFileObject("crudo.txt");



//Recorro el archivo txt crudo aplicando la expresión regular línea por línea
//si calza como un email válido lo guarda en el array
while (!$myFile->eof()) {
    $valor = $myFile->fgets();

    if(preg_match ( $pattern, $valor, $matches )){
        
        //guardamos el correo en el array de mails
        $new = array_push($dbmails, $matches);
        
    }

}


//Abrimos el txt donde guardaremos los emails obtenidos
$myfileDB = fopen("DB.txt", "w") or die("Unable to open file!");

//recorresmos el array de emails y lo registramo en una línea del DB.txt
foreach ($dbmails as $valor) {
    $mail = strtolower($valor[0]).";\n";
    fwrite($myfileDB, $mail);
}

//cerramo el archivo
fclose($myfileDB);

//Confirmación que se realizó todo bien
echo "LISTO";

?>