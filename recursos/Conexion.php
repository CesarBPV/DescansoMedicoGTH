<?php
function conectar(){
	
    
    /* APP localhost y BD pruebas*/
	//$cnid = oci_connect("usuario", "contraseña", "ruta o dominio", "AL32UTF8");
	//$cnid = oci_connect("debu", "1234", "localhost/XE", "UTF8");
	
	/* APP produccion y BD produccion*/
	// "algunos nombre de dominios" solo funciona en el server de produccion, en localhost hay que ponerle ip
	//$cnid = oci_connect("usuario", "contraseña", "ruta o dominio", "US7ASCII"); 
	
	/* APP localhost y BD de produccion */
	//$cnid = oci_connect("usuario", "contraseña", "ruta o dominio", "US7ASCII"); 

    /* APP PRODUCCION Y BD PRUEBAS */
	//$cnid = oci_connect("xxxxx", "xxxxx", "xxxxx", "US7ASCII"); 

	if (!$cnid) {
	    $e = oci_error();
	    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	return $cnid;
}


function consulta($cn="", $sql=""){

	
	$stid = oci_parse($cn, $sql);

	$r = oci_execute($stid);


	if (!$r) {
	    $e = oci_error($stid);
	    throw new Exception (htmlentities($e['message']));
    }
	
	return $stid;
}

function respuesta($stid=""){
	//global $stid, $result;

	$result = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
	
    return $result;
}
function respuesta2($stid=""){
    //global $stid, $result;

    $result = oci_fetch_all($stid,$resp,0,-1,OCI_FETCHSTATEMENT_BY_ROW);
    if($result>0){
        return $resp;
    }else{
        return $result;
    }
}
