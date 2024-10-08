<?php  

    /**
     * Funcion is_null
     */
    
    // Variable no definida 
    var_dump(is_null($var));
    echo "<br>";
    $var = null;
    var_dump(is_null($var));
    echo "<br>";

    unset($var);
    var_dump(is_null($var));
    echo "<br>";