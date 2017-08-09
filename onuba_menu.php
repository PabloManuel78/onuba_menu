<?php
	// Abre la conexión : user-contraseña-db
	$conn = new mysqli("localhost", "nombre_usuario", "password", "nombre_db");
	
	if ($conn->connect_errno) die("<b>Imposible conectar con DB:</b><br>($conn->connect_errno) $conn->connect_error");

	$conn->set_charset("utf8");

	require("js/onuba_menu_1_0/php/onuba_menu.inc");
	require("js/onuba_menu_1_0/php/comprobarlogico.inc");

?>

<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		
		<!-- jquery 2.2.4 -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

		<!-- font-awesome 4.7.0 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	

		<!-- Onuba Menú -->
		<link rel="stylesheet" href="/js/onuba_menu_1_0/css/onuba_menu.min.css">
		<script src="/js/onuba_menu_1_0/js/onuba_menu.min.js"></script>	
		
		<style>
			body {
			    background-image: none !important;
			    background-color: #f6f6f6 !important;
			}			
		</style>

	    <script type="text/javascript">
				
			$(document).ready(function() {

				onuba_menu();

			});
	    </script>

	</head>

	<body>
	
		<div class="jumbotron text-center">
			<img src="https://webforever.es/data/dms/logo-onuba-menu.png" class="img-responsive center-block"/>
			<h1>Plugin con PHP, MySql, Bootstrap y Jquery</h1>
			<p>Crea un menú multinivel con infinitas categorías. Ocupa 989bytes ¡Menos de 1kb! </p>
			
			<p>
				<a class="btn btn-primary btn-lg" href="#php" role="button">Parte PHP</a>
			</p>
			<p>
				<a class="btn btn-primary btn-lg" href="#jq" role="button">Parte Jquery</a>
			</p>
			<p>
				<a class="btn btn-primary btn-lg" href="#css" role="button">Parte CSS</a>
			</p>
			<p>
				<a class="btn btn-success btn-lg" href="#demo" role="button">¡Demo!</a>
			</p>
		</div>
		
		<div class="container container-700" id = "php">
		
			<div class="page-header text-center alert alert-success">
				<h2>Parte PHP</h2>
				<h3>Genera el menú a través de PHP</h3>
			</div>			
			
			<div class="row">
				<div class="col-sm-6">
					<h3>Base de datos.</h3>
					<p>
						Puedes usar o no este plugin con PHP. A través de una sencilla tabla podrás crear menús con infinitas
						subcategorías. Para ellos tendrás que crear esta tabal en tu base de datos.<br><br>
						El código está testeado y probado bajo PHP 5.6.31 y la versión del cliente de base 
						de datos es: libmysql - mysqlnd 5.0.11-dev - 20120503<br><br>
						Se trata de un código muy sencillo. No debes de ter problemas con otras versiones de PHP ni con otros
						motores de bases de datos. Cualquier duda consúltanos.
					</p>
				</div>
				<div class="col-sm-6">
					<code>
						CREATE TABLE `menus` <br>
						(<br>
						  `id` int(9) NOT NULL AUTO_INCREMENT,<br>
						  `menu` int(9) NOT NULL DEFAULT '0',<br>
						  `idpadre` int(9) NOT NULL DEFAULT '0',<br>
						  `nombre` varchar(150) NOT NULL,<br>
						  `title` varchar(256) NOT NULL,<br>
						  `url` varchar(512) NOT NULL,<br>
						  `clases` varchar(100) NOT NULL,<br>
						  `pos` int(3) NOT NULL DEFAULT '1'<br>
						) <br>
						ENGINE=InnoDB DEFAULT CHARSET=utf8;<br>
					</code>
				</div>
			</div>
			
			<br><br><br>
			
			<div class="row">
				<div class="col-sm-6">
					<h3>Funcion PHP onuba_menu()</h3>
					<p>
						Te harán falta dos funciones. La primera es la función PHP <b>onuba_menu</b> Esta es la principal. 
						Con esta función creas la estructura HTML que necesita el plugin para navegar por el menú.<br><br>
						
						En la tabla anterior puedes tener varios menús en una sóla tabla. Identifica a cada menú de manera numérica
						a través del campo <code>`menu` int(9)</code><br><br>
						
						Funciona con dos parámetros. El primero es el menú que quieres crear en HTML y el segundo es el tema CSS.
						Este segundo es opcional. Puedes dejarlo en blanco, elegir uno de los que hemos creado o bien crear el 
						tuyo propio.<br><br>
						
						<a class="btn btn-primary" target="_blank" href="https://webforever.es/js/onuba_menu_1_0/php/onuba_menu.inc">
							Ver función php onuba_menu()
						</a>

					</p>
				</div>
				<div class="col-sm-6">
					<h3>Funcion PHP comprobar_logico()</h3>
					<p>
						Es una función de uso genérico por nuestro gestor de contenido webforever.es, simplemente extrae el valor
						de un campo de la base de datos pasado de manera externa. Se usa en onuba_menu() para obtener el nombre del 
						menú.<br><br>

						
						<a class="btn btn-primary" target="_blank" href="https://webforever.es/js/onuba_menu_1_0/php/comprobarlogico.inc">
							Ver función php comprobarlogico()
						</a>

					</p>
				</div>
				
			</div>
		
			<div class="page-header text-center alert alert-success" id="jq">
				<h2>Parte Jquery</h2>
				<h3>Tan sólo añade las llamadas a tu página. Ten en cuenta que las rutas de acceso a onuba_menu pueden cambiar al subir los archivos a tu hosting.</h3>
			</div>			
			
			<div class="row">
				<div class="col-sm-12">
					<h3>Componentes necesarios para que funcione el plugin</h3>
					<p>Añadelos en tu HEAD HTML</p>
					
					<code>
						&lt;!-- jquery 2.2.4 --&gt;<br>
						&lt;script src=&quot;https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js&quot;&gt;&lt;/script&gt;
						<br><br>
					</code>
					
					<code>
						&lt;!-- font-awesome 4.7.0 --&gt;<br>
						&lt;link rel=&quot;stylesheet&quot; href=&quot;https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css&quot;&gt;
						<br><br>
					</code>

					<code>
						&lt;!-- Bootstrap --&gt;<br>
						&lt;link rel=&quot;stylesheet&quot; href=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css&quot; &gt;<br>
						&lt;script src=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js&quot; &gt;&lt;/script&gt;
						<br><br>
					</code>
					
					<code>
						&lt;!-- Onuba Men&uacute; --&gt;<br>
						&lt;link rel=&quot;stylesheet&quot; href=&quot;/js/onuba_menu_1_0/css/onuba_menu.min.css&quot;&gt;<br>
						&lt;script src=&quot;/js/onuba_menu_1_0/js/onuba_menu.min.js&quot;&gt;&lt;/script&gt;
						<br><br>
					</code>
					
				</div>
			</div>
		
			<div class="page-header text-center alert alert-success" id="css">
				<h2>Parte CSS</h2>
				<h3>Usa el nuestro o crea el tuyo propio</h3>
			</div>		
				
			<div class="row">
				<div class="col-sm-6">
					<h3>CSS mínimo</h3>
					<p>
						Aquí te mostramos el CSS que hace falta para que funcione onuba_menu. Tan sólo son unas líneas ya que
						usa la clase <code>list-group</code> de Bootstrap. Así mismo en el archivo verás que hay temas que puedes
						añadir en la llamada a la función PHP. Pero estos son opcionales.<br><br>

						
						<a class="btn btn-primary" target="_blank" href="https://webforever.es/js/onuba_menu_1_0/css/onuba_menu.css">
							Ver archivo CSS completo
						</a>

					</p>
				</div>
				<div class="col-sm-6">
					<code>
					@keyframes om_kf_entrar{&nbsp;<br />
					&nbsp;&nbsp; &nbsp;0% { opacity:0 }<br />
					&nbsp;&nbsp; &nbsp;<br />
					&nbsp;&nbsp; &nbsp;100% { opacity:1 }&nbsp;<br />
					}<br /><br />
					</code>
					
					<code>
					.onuba_menu .om_entrar {&nbsp;<br />
					&nbsp;&nbsp; &nbsp;animation: om_kf_entrar 1.5s both;<br />
					}<br /><br />
					</code>
					
					<code>
					.onuba_menu .om_salir {&nbsp;<br />
					&nbsp;&nbsp; &nbsp;display: none;<br />
					}<br /><br />
					&nbsp;
					</code>
				</div>
			</div>
		
			<div class="page-header text-center alert alert-success">
				<h2>¡Ejemplo!</h2>
				<h3>
					Este es el resultado. Un menú con infinitas subcategorías.Como puedes ver se respetan los enlaces.
					Es decir, en una línea tienes hipervínculo y acceso a la subcategoría de manera independiente.
				</h3>
			</div>		
			
			<br /><br /><br /><br /><br />
			
			<div class="row" id="demo">
				<div class="col-sm-4 col-sm-offset-4"><?php onuba_menu(1, "om_tema_lista");?></div>
			</div>
		</div>
	
		<div class="jumbotron text-center">
			<img src="https://webforever.es/data/dms/logo-onuba-menu.png" class="img-responsive center-block"/>
			<h2>¿Alguna duda para hacerlo funcionar?</h2>
			<p>Contacta con Webforever.es y te ayudaremos a configurarlo.</p>
			
			<p>
				<a class="btn btn-primary btn-lg" href="https://webforever.es/inicio" role="button">Nuestra Web</a>
				<a class="btn btn-primary btn-lg" href="https://webforever.es/localizacion" role="button">Contacta</a>
				<a class="btn btn-primary btn-lg" href="https://github.com/PabloManuel78/onuba_menu role="button">github</a>
			</p>
			
			<h6>
				<p>Copyright 2017 · <a href="/avisolegal">Aviso Legal</a> · WebForever.es CIF: 29795733S <a href="https://webforever.es" rel="nofollow">Web desarrollada por Webforever.es</a></p>
			</h6>
		</div>

	</body>

</html>

<?php

global $conn;

// Cierra la conexión.
if (isset($conn) == true) $conn->close();

?>

<!--//Web desarrollada por Pablo Manuel Burrero Sánchez | Copyright: (C)2005-2017//-->

