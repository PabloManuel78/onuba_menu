/*
* Onuba Menú v1.0
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


function onuba_menu() {

	// Al hacer clic en la clase OM_IR...
	$(document.body).on( "click touch", ".om_ir", function() {
		
		// La etiqueta con esta clase guarda un micro dato con el id del submenú.
		// Si no tiene esta etiqueta es que no hay submenú.
		menu_a_entrar = $(this).attr("data-onuba_menu")
		
		// Hacemos visible la lista correspondiente quitándole la clase OM_SALIR
		// y le añadimos la clase OM_ENTRAR que tiene un efecto de movimiento en opacidad.
        $('ul[data-onuba_menu="' + menu_a_entrar + '"]').removeClass('om_salir').addClass("om_entrar");
        
        // Ocultamos la lista UL en la que se ha hecho clic añadiendo la clase OM_SALIR
        $(this).parents(':eq(1)').addClass("om_salir")
    });

}		
