<?php
/*
*   Onuba Menú v1.0
*	PHP · MySql · Bootstrap · Jquery
*
*	Developed by 
*		Pablo Manuel Burrero Sánchez
*		webforever.es
*
*   Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
*
*   GitHub: https://github.com/PabloManuel78/onuba_menu
*/

/*
Esta función funciona desde la siguiente tabla de menús:

CREATE TABLE `menus` 
(
  `id` int(9) NOT NULL,
  `menu` int(9) NOT NULL DEFAULT '0',
  `idpadre` int(9) NOT NULL DEFAULT '0',
  `nombre` varchar(150) NOT NULL,
  `title` varchar(256) NOT NULL,
  `url` varchar(512) NOT NULL,
  `clases` varchar(100) NOT NULL,
  `pos` int(3) NOT NULL DEFAULT '1'
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/
function onuba_menu($menu = 0, $tema = "")
{	
	global $conn;
	
	// Obtenemos los IDS matrices del menú pasado. LLevan IdPadre 0.
	$sql = "select id, idpadre, nombre, title, url from menus where menu=" . $menu . " and idpadre=0 order by pos";
	$result = $conn->query($sql) Or Die ("ER0167: Error cargando datos");
	if ($result->num_rows == 0) return;

	echo "<nav class='onuba_menu $tema'>";
	
		// Lista del menú padre o inicial (idpadre=0)
		echo "<ul class='list-group' data-onuba_menu='" . $menu . "-om_ul'>";
		
		// Índice para crear a su vez los índices de los campos DATA
		$i=0;
		
		// Recorremos y creamos una lista UL con el menú inicial.
		while($rs = $result->fetch_object())
		{
			$i++;
				
			$indice = "-" . $i;
				
			// LI opción de menú
			echo "<li class='list-group-item'>" .
					"<a title='" . $rs->title . "' href='" . $rs->url . "'>" . $rs->nombre . "</a>";
			
			// Si tiene hijos tendremos que pintar su lista UL
			// Por lo tanto añadimos flecha al final.
			if ((int)comprobarlogico("menus", "id", "idpadre=" . $rs->id) !== 0)
			{
				// Pintamos el botón para entrar en el submenú
				// En el campo DATA concatenamos por delante el valor de $menu para poder tener
				// varios menús en una página.
				echo "<span class='om_ir pull-right' data-onuba_menu='" . $menu . "-om_ul" . $indice . "'>" . 
						"<i class='fa fa-chevron-right'></i>" . 
					 "</span>";
				
				// Creamos array.
				// Su índice será el idpadre y su valor el índice para campos DATA.
				$ids[$rs->id] = $indice;
			}
	
			echo "</li>";
		}
	
		$result->close();
		
		echo "</ul>";
		
		// Si hay submenús, es decir, si la variable $IDS está inicializada.
		while(isset($ids))
		{
			// Pintamos IDS2 y vaciamos IDS para volverlo a llenar o no.
			$ids2 = $ids;
			unset($ids);
			
			foreach ($ids2 as $id_padre => $indice_ul)
			{
				// Abrimos lista
				echo "<ul class='list-group om_salir' data-onuba_menu='" . $menu . "-om_ul" . $indice_ul . "'>";
				
				// LI para subir/volver al menú padre.								
				echo "<li class='list-group-item active'>" .
						"<span class='om_ir' data-onuba_menu='" . $menu . "-om_ul" . substr($indice_ul, 0, -2) . "'>" . 
							"<i class='fa fa-chevron-left'></i>" . 
						"</span>" . 
						"<span class='pull-right'>" .
							comprobarlogico("menus", "nombre", "id=" . $id_padre) .
						"</span>" .
					 "</li>";
				
				// Buscamos los hijos del Id padre que ya sabemos que tienen submenús.
				$sql = "select id, nombre, title, url from menus where idpadre=" . $id_padre . " order by pos";
				$result = $conn->query($sql) Or Die ("ER0167: Error cargando datos");
				if ($result->num_rows == 0) continue;
				
				// Pintamos las LI con sus enlaces y guardamos los ids que contienen más 
				// enlaces.
				$i=0;
				while($rs = $result->fetch_object())
				{
					$i++;
					
					$indice = "-" . $i;
					
					echo "<li class='list-group-item'>" .
							"<a title='" . $rs->title . "' href='" . $rs->url . "'>" . $rs->nombre . "</a>";
					
					// Si tiene hijos tendremos que pintar su lista UL
					if ((int)comprobarlogico("menus", "id", "idpadre=" . $rs->id) !== 0)
					{
						$sigue = true;
						
						// Pintamos el botón para entrar en el submenú
						echo "<span class='om_ir pull-right' data-onuba_menu='" . $menu . "-om_ul" . $indice_ul . $indice . "'>" . 
								"<i class='fa fa-chevron-right'></i>" . 
							 "</span>";
						
						// Creamos array bidimensional. La columna 0 guarda el ID.
						// La columna 1 guarda el índice.
						$ids[$rs->id] = $indice_ul . $indice;
					}
			
					echo "</li>";
				}
			
				$result->close();
			
				echo "</ul>";
				
			}
		}

	echo "</nav>";
}
?>
