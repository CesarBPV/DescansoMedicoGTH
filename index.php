<?php

session_start();

require_once "recursos/Config.php";
//require_once baseRoot . "/recursos/Conexion.php";
require_once baseRoot . "/recursos/Util.php";

$accion = empty($_REQUEST['accion']) ? "vacia" : $_REQUEST['accion'];

switch ($accion) {
    case "login":
        iniciarSesion();
        break;
    case "CS":
        cerrarSesion();
        break;
    case "vacia":
        vacio();
        break;

    /*case "loginPort":
        logueoPortal();
        break;
    */
    case "getUserName":
        getUsuario();
        break;
}

function vacio(){
    header("Location:" . urlBase . "/recursos/Inicio.php");
    exit;
}

function cerrarSesion(){

    $titulo = 'Iniciar Sesion';
    $url = "index.php";
    $accion = 'MXC';

    $_SESSION = array();
    session_destroy();
    verPagina("",$titulo,baseRoot . '/recursos/vista/login.phtml');
}


function iniciarSesion()
{

    $s_login=$_REQUEST['f_login'];
    $s_password=$_REQUEST['f_password'];

    if ($usuarioBienestar = esUsuarioBienestar2datos($s_login, $s_password)) {

        $_SESSION["ss_idusuario"] = $usuarioBienestar['IDUSUARIO'];
        $_SESSION["ss_usuario"] = $usuarioBienestar['LOGIN'];
        $_SESSION["ss_idrole"] = $usuarioBienestar['ROLE_ID'];

        header("Location:" . urlBase . "/recursos/Inicio.php");
        exit;

    } elseif ($datos = validEstudiante2Datos($s_login, $s_password)) {
        $alumno = getEstudianteDatos($datos['codalu']);
        $_SESSION["ss_idusuario"] = $alumno['CODIGO_PERSONAL'];
        $_SESSION["ss_usuario"] = $alumno['DATO_NOMBRES'];
        $_SESSION["ss_coduniv"] = $alumno['DOCUMENTOS_CODUNIV'];
        if($resiAct=esResidenteActual($alumno['DOCUMENTOS_CODUNIV'])){
            $_SESSION["ss_idrole"] = 10;
            $_SESSION["ss_idresidente"] = $resiAct['IDRESIDENTE'];
        }elseif ($exResi=esExResidente($alumno['DOCUMENTOS_CODUNIV'])){
            $_SESSION["ss_idrole"] = 11;
        }else{
            $_SESSION["ss_idrole"] = 4;
        }

        header("Location:" . urlBase . "/recursos/Inicio.php");
        exit;
    } else {

        echo'<script>alert("El usuario y/o clave son incorrectos")</script>';
        echo'<script>alert("por favor vuelva a intentarlo!")</script>';
        echo '<script>location.href = "' . urlBase . '/index.php"</script>';
    }
}

function esExResidente($coduniv){
    $sql="SELECT IDRESIDENTE AS VER FROM DEBU.RS_RESIDENTE WHERE IDESTUDIANTE='$coduniv' AND ROWNUM=1";
    $cnid = conectar();
    $stid = consulta($cnid, $sql);
    if($r=respuesta($stid)){

        oci_free_statement($stid);
        oci_close($cnid);

        return $r;

    } else {
        oci_free_statement($stid);
        oci_close($cnid);
        return $r;
    }
}