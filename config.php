<?php
        define('DB_HOST','localhost');
       define('DB_USER','strona'); //wpisz nazwęużytkownika bazy danych @94-23-92-182.ovh.net
       define('DB_PASS','test'); //wpisz hasło dla tego użytkownikar
       $polacz = mysql_connect(DB_HOST, DB_USER, DB_PASS)
           or die('Nie udalo polaczyc sie z baza danych. '.mysql_error());
       $link=$polacz;
       define('DB_POLACZ','$polacz');
       $DB = mysql_select_db('ugm'); //db1170634');
       mysql_query("SET NAMES 'utf8';"); 
       mysql_query('SET CHARACTER SET utf8_polish_ci;');
?>
