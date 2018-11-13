<?php
 //mb_internal_encoding("UTF-8");
error_reporting(E_ALL | E_STRICT);
//error_reporting(0);

ini_set('default_charset','US7ASCII');
//ini_set('default_charset','utf-8');


//ini_set('filter.default','full_special_chars');
//ini_set('filter.default', '0');




// DESARROLLO EN LOCAL
/*
define("serverName", "localhost");
define("dirProyect", "residencias");

define( "baseRoot", $_SERVER['DOCUMENT_ROOT'] . '/' . dirProyect);
define( "urlBase", "http://" . serverName . '/' . dirProyect );
*/

// PRODUCCION
/*
define( "baseRoot", $_SERVER['DOCUMENT_ROOT'] );
define( "urlBase", "https://dominio" );
*/


// PRODUCCION sis2, nuevo sitio

define( "baseRoot", $_SERVER['DOCUMENT_ROOT']."/DescansoMedicoGTH" );
define( "urlBase", "http://localhost/DescansoMedicoGTH" );




