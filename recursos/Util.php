<?php
// Funciones utiles a usar
require_once "Config.php";
//require_once baseRoot . "/recursos/Conexion.php";

function validarSesion()
{
    
	$usu=$_SESSION["ss_usuario"];
    if(empty($usu)){
	    header("Location:" . urlBase . "/index.php?accion=CS");
        exit;
    }else{
        header("Location:" . urlBase . "/index.php");
        exit;
    }
}



/******************** CARGAR CONTENIDO EN LA PLANTILLA *****************************/

function cargarPlantilla($plantillaPath=''){

    if (empty($plantillaPath)) {
    	//$plantillaPath = baseRoot . '/recursos/templates/ivan/plantilla.phtml';
    	$plantillaPath = baseRoot . '/recursos/templates/gentelella/index.phtml';
    }

	ob_start();
	require_once $plantillaPath;
	//require_once baseRoot . '/recursos/layout/plantilla.phtml';
	$plantilla = ob_get_clean();
	
	//$plantilla = pagina_a_String(baseRoot . '/recursos/layout/plantilla.phtml');
	
	//$plantilla = reemplazarContenido('#TITULO#' ,$title , $pagina);
	//$header = pagina_a_String('app/views/default/sections/s.header.php');
	//$plantilla = reemplazarContenido('/\#HEADER\#/ms' ,$header , $pagina);
	//$menu_left = pagina_a_String('app/views/default/sections/s.menuizquierda.php');
	//$plantilla = replace_content('/\#MENULEFT\#/ms' ,$menu_left , $pagina);
	
	return $plantilla;
}

/* convierte una pagina a string */
function pagina_a_String($page)
{
    return file_get_contents($page);
}

function verPagina($vista="", $titulo="", $plantillaPath="")
{
	$plantilla = cargarPlantilla($plantillaPath);
    /*ob_start();
    require_once baseRoot . '/recursos/templates/gentelella/principal.phtml';
    $estilosp = ob_get_clean();*/

    if($vista!=""){
        $plantilla = reemplazarContenido('#titulo#', $titulo , $plantilla);
        $plantilla = reemplazarContenido('#SCRIPTS#', "" , $plantilla);
        $plantilla = reemplazarContenido('#CONTENIDO#', $vista , $plantilla);
        //$plantilla = reemplazarContenido('#SCRIPTS#', $estilosp , $plantilla);
    }/*else{
    $plantilla = reemplazarContenido('#CONTENIDO#', $vista , $plantilla);
    $plantilla = reemplazarContenido('#SCRIPTS#', $estilosp , $plantilla);
    }*/

    echo $plantilla;
}

function reemplazarContenido($in='#CONTENIDO#', $out, $pagina)
{
    return str_replace($in, $out, $pagina);
}

 /******************** CARGAR CONTENIDO EN LA PLANTILLA - FIN ************************/


/* mete las vistas en los helpers de gentelella, con titulos y sub titulos y devuelve ese preparado */
function prepararVista($viewHelper, $vista, $titulo)
{

	$viewHelperPath = baseRoot . '/recursos/templates/gentelella/view_helpers/' . $viewHelper .'.phtml';
	$viewHelperString = pagina_a_String($viewHelperPath);
    
    //$viewHelperString = reemplazarContenido('#titulo#', $titulo, $viewHelperString);
    $viewHelperString = reemplazarContenido('#titulo#', $titulo, $viewHelperString);
	$viewHelperString = reemplazarContenido('#cuerpo#', $vista, $viewHelperString);

	return $viewHelperString;

}

function siBusquedaXNombre($modoBusqueda, $nombre, $apePat, $apeMat, $url, $accion)
{
	if ($modoBusqueda == "XName") {
		//lanzar metodo que muestre candidatos a inscripcion, el cual enviara el codigo
        //la accion verFichaInscrip y modoBusqueda=XCode
		echo "imprime textArea con posibles candidatos de manera que trae codigo";
		exit;
	}
	return;
}

// Elimina los ceros a la izquierda del codigo universitario, si tuviera.
function delCerosIzqCodeUni($codigo)
{
	// quita los ceros a la izquierda y convierte el string en entero
	//$codigo = (int) $codigo;

    // quita los ceros pero sigue siendo string
    $codigo = number_format($codigo, 0, '', '');
    
    return $codigo;
}

function utf8ize($d) { 
    if (is_array($d)) { 
        foreach ($d as $k => $v) { 
            $d[$k] = utf8ize($v); 
        } 
    } else if (is_string ($d)) { 
        return utf8_encode($d); 
    } return $d; 
}