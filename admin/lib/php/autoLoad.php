<?php

function autoload($nom_classe){
    
    if(file_exists('lib/php/classe/'.$nom_classe.'.class.php')){
        require 'lib/php/classe/'.$nom_classe.'.class.php';
    }
    if(file_exists('admin/lib/php/classe/'.$nom_classe.'.class.php')){
        require 'admin/lib/php/classe/'.$nom_classe.'.class.php';
    }
}

spl_autoload_register('autoload');
