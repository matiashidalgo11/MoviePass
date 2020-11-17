<!DOCTYPE html>
<html>
    <head>
<?php require_once(VIEWS_PATH."nav-bar.php");
        require_once(VIEWS_PATH."header.php");
?>
<title>Actualiza Cines</title>
    </head>
<body>
    <table border="2" align="center" cellspacing="5px">
        <div>
		    <tr align="center" >
                <td><br>
		            <label style="border: 2px; border-radius: 2px; background-color: red; color: white; font-size: 22px; padding: 2px; font-style: verdana">Agregar Sala</label>
                    <p><hr>
                        <table width="600px">
		                    <tr>
                            <td><br>
                                    <div>
                                        <form  action="<?php echo FRONT_ROOT?>roomController/Add" method="POST">
                                            <div>
                                                <label class="text-light" for="nombre" style="width: 75px">Nombre</label>
                                                <input type="text" name="nombre"  id="nombre" placeholder="Ingrese un nombre" required>
                                            </div>
                                            <div>
                                                <label class="text-light" for="precio" style="width: 75px">Precio</label>
                                                <input type="number" name="precio"  id="precio" placeholder="Precio" required>
                                            </div>
                                            <div>
                                                <label class="text-light" for="capacidad">Capacidad</label>
                                                <input type="number" name="capacidad"  id="capacity" placeholder="Ingrese una capacidad" required>
                                            </div>
                                            <input type = "hidden" name = "idCine" id = "idCine" required value="<?= $idCine?>">
	                                </div>
                                </td>
                            </tr>
                        </table>
                    </p>
                </td>
            <tr>
        </div>
        </form>
    </table>
</body>
<?php require_once(VIEWS_PATH."footer.php");?>