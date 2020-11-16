<!DOCTYPE html>
<html>
    <head>
        <?php 
            require_once(VIEWS_PATH."nav-bar.php");
            require_once(VIEWS_PATH."header.php");
        ?>
        <title>Actualiza Cines</title>
    </head>
<body>
    <table border="2" align="center" cellspacing="5px">
        <div>
		    <tr align="center" >
                <td><br>
		            <label style="border: 2px; border-radius: 2px; background-color: red; color: white; font-size: 22px; padding: 2px; font-style: verdana">Actualizar Cine</label>
                    <p>
                        <div>
                            <label class="text-light">Nombre</label>
                            <input type="text" name="nombre" id="nombre" disabled placeholder="<?php echo $cine->getNombre();?>" >
                        </div>
                        <div>
                            <label class="text-light">Direccion</label>
                            <input type="text" name="direccion" id="direccion" disabled placeholder="<?php echo $cine->getDireccion();?>" >
                        </div><hr>
                    </p>
		        </td>
            </tr>
            <tr align="center">
                <td>
                    <form action="<?php echo FRONT_ROOT ;?>/CineController/Update" method="POST"> 
                        <input type="hidden" name="idCine" value='<?php echo $cine->getId(); ?>'>
                        <p>
                            <table width="600px">
                                <tr>
                                    <td>
                                        <div>
                                            <label class="text-light" style="width: 70px" required>Nombre: </label>
                                            <input type="text" name="nombre"></input>
                                        </div>
                                        <div>
                                            <label class="text-light" required>Direccion:</label>
                                            <input type="text" name="direccion"></input>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </p>
                        <div>
                            <button type="submit" class='btn text-light'  style="background-color: red; font-size: 17px; border-radius: 4px; width: 150px">Actualizar</button>
                        </div>
                    </form>
		        </td>
            </tr>
        </div>
    </table>
</body>