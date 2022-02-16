<?php     
   /* session_start();
    if (isset($_SESSION['usuario'])){
        $nombreUsuario = $_SESSION['usuario'];
        echo "<h1>$nombreUsuario</h1><hr><br>";
    } else {header('Location: index.html'); die();} */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <form onsubmit="return false;" id="formulario">
    </hr>

        <label for="fnombre">Nombre Producto:</label><br>
        <input type="text" id="fnombre" name="producto_nombre"><br><br>
        
        <label for="fcantidad">Cantidad:</label><br>
        <input type="number" id="fcantidad" name="producto_cantidad"><br><br>
            
        <label for="fprecio">Precio:</label><br>
        <input type="number" id="fprecio" name="producto_precio"><br><br>

        <br>
        <button onclick="registrarProducto();">Registrar Producto</button><br><br>
        <button onclick="visualizarProductos();">Visualizar Productos en Inventario</button>
            
    </form>

    <br><br>

    <div>
    <table style="border: 1px solid #000; text-align: center;">
    <tbody id="tablaUsuarios">
    
    </tbody>
    </table>  
    </div>

    <script type="text/javascript">
        function registrarProducto(){
            
            var solicitudHttp = new XMLHttpRequest ();
            solicitudHttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.response != ""){
                        console.log(this.response);
                        alert(JSON.parse(this.response));
                        document.getElementById("formulario").reset();
                    }
                }
            }

            var formularioDatos = new FormData (document.getElementById("formulario"));
            solicitudHttp.open("POST", "registroProducto.php");
            solicitudHttp.send(formularioDatos);
            
        };


        function visualizarProductos (){
            var solicitudHttp = new XMLHttpRequest ();
            solicitudHttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.response != ""){
                    
                        if (JSON.parse(this.response) == 0 ) {alert("Falla al obtener los registros");}
                        else {
                            alert("Productos recibidos");
                            console.log(JSON.parse(this.response));

                            var respuestaJson = JSON.parse(this.response);
                            var tabla = document.getElementById("tablaUsuarios");
                            tabla.setAttribute("border","2");
                            
                            tabla.innerHTML = "<tr><th>ID Producto</th><th>Nombre del Producto</th><th>Precio del Producto</th><th>Cantidad</th><th>Modificar Cantidad</th></tr>";

                            respuestaJson.forEach(usuario => {

                            var fila = document.createElement("tr");
                            var nombre = document.createElement("td");
                            var textoCelda = document.createTextNode(usuario['producto_id']);
                            nombre.appendChild(textoCelda); 
                            fila.appendChild(nombre);

                            var apellido = document.createElement("td"); 
                            var textoCelda = document.createTextNode(usuario['producto_nombre']);
                            apellido.appendChild(textoCelda);
                            fila.appendChild(apellido);

                            var cedula = document.createElement("td"); 
                            var textoCelda = document.createTextNode(usuario['producto_precio']);
                            cedula.appendChild(textoCelda);
                            fila.appendChild(cedula);

                            trabajo = document.createElement("td"); 
                            var textoCelda = document.createTextNode(usuario['producto_cantidad']);
                            trabajo.appendChild(textoCelda);
                            fila.appendChild(trabajo);

                            var botonModificar = document.createElement("button");
                            botonModificar.textContent = "Modificar";
                            botonModificar.value = usuario['producto_id'];
                            fila.appendChild(botonModificar);

                            var modificar = document.createElement("input");
                            modificar.type = "number";
                            fila.appendChild(modificar);

                            
                            botonModificar.onclick = function () {
                                
                                var filaBoton = this.parentElement;
                                var nuevaCantidad = filaBoton.lastElementChild;
                                //alert(nuevaCantidad.value);

            var solicitudHttp = new XMLHttpRequest ();
            solicitudHttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.response != ""){
                        
                        alert(JSON.parse(this.response));
                        if (JSON.parse(this.response) == "Cantidad Cambiada") {
                            visualizarProductos();
                        } else {alert("No se pudo modificar la cantidad");}
                    }
                }
            }

            var datos = new FormData ();
            datos.append("producto_cantidad", nuevaCantidad.value);
            datos.append("producto_id", this.value)
            solicitudHttp.open("POST", "modificarCantidad.php");
            solicitudHttp.send(datos);

                            }

                            tabla.appendChild(fila);


                            }); 

                        }
                    }
                }
            }

            solicitudHttp.open("POST", "visualizarProductos.php");
            solicitudHttp.send( );
        }

    </script>

        

</body>
</html>