<?php

if(file_exists('admin/lib/php/dbConnectMysql.php')){
    include('admin/lib/php/dbConnectMysql.php');
    include('admin/lib/php/autoLoad.php');
}
else if(file_exists('lib/php/dbConnectMysql.php')){
    include('lib/php/dbConnectMysql.php');
    include('lib/php/autoLoad.php');
}
