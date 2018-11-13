<?php
session_start();
require_once "Config.php";
require_once baseRoot . "/recursos/Util.php";

validarSesion();

verPagina();