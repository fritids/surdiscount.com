<?php

$id_costomer = $_GET['num'];
$id_newsletter = $_GET['newsletter'];

$message = file_get_contents( "$id_newsletter/index.html" );

echo str_replace( '#|num|#', $id_costomer, $message );
