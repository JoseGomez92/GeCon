/*
 * Funcion para redireccionar cuando se pusa el boton volver.
 */
    //La clave es la direccion actual y el valor la redirecion a redirigir
    var arrayRedirecciones = {"eliminar_enlace":"gestionar_enlaces", "gestionar_enlaces":"ver_tipos_enlaces",
        "modificar_enlace":"gestionar_enlaces","ver_tipos_enlaces":"ver_tipos_enlaces","eliminar_tipo":"modificar_borrar_tipo",
        "gestionar_tipos":"gestionar_tipos","modificar_borrar_tipos":"gestionar_tipos","modificar_tipo":"modificar_borrar_tipo"};

    function redireccionar(){
	//Obtenemos la url completa
	path = location.href;
        back = path;
        //Buscamos dentro del path la redireccion en el array
        for(var url in arrayRedirecciones){
            //Comprobamos que coincida la pagina actual con algunas de las indicadas en el array de redirecciones
            if(path.indexOf(url) != -1){
                back = path.replace(url, arrayRedirecciones[url]);
                console.log(back + ' --- ' + path);
            }
        }
	//Añadimos la entrada al historial (la cual no dispara un evento de cambio de estado)
	history.pushState(null, null, path);
	//Añadimos el manejador de eventos para el cambio de estado en el historial
	window.addEventListener('popstate', function(e) {
            location.href = (null, null, back);
	});
    }
    //Se invoca a la funcion
    redireccionar();
