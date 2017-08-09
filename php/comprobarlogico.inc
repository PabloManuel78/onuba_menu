<?php
/* Devuelve el valor de uno o varios campos. Falso si no encuentra ningún registro.
	
	Parámetros:
	
	$nombre_tabla: Tabla de la DB
	$nombre_campo: Campo o campos de la tabla, para devolver varios campos separar por comas
	$clausula_where: De la consulta
	$debug: Puede mostrar información de depuración en pantalla.
	
*/

function comprobarlogico($nombre_tabla, $nombre_campo, $clausula_where, $debug = false)
{	
	global $conn;
	
	// Generamos la instrucción sql
	$sql = "select " . $nombre_campo . " from " . $nombre_tabla;
	
	// Concatenamos el Where si procede
	If ($clausula_where !== "")
	{
		$sql .= " where " . $clausula_where;
	}

	$result = $conn->query(strtolower($sql)) Or Die ("<p class='as400'>ERROR CL: $sql<p>");
	
	// Si devuelve datos lo devolvemos
	If ($result->num_rows == 0)
	{
		$r = false;
	}
	// Si no devolvermos false
	Else
	{
		$rs = $result->fetch_array(MYSQLI_NUM);
		
		if (count($rs) == 1) $r = $rs[0]; else foreach ($rs as $x) $r[] = $x;
	}

	$result->close();
	
// Devolvemos respuesta.
Return $r;
}
?>
