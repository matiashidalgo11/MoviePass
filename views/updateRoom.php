<!DOCTYPE html>
<html>
    <head>
        <?php require_once(VIEWS_PATH."nav-bar.php");
        require_once(VIEWS_PATH."header.php");
        ?>
        <title>Actualiza Salas</title>
    </head>
<body>
    <table border="2" align="center" cellspacing="5px">
        <div>
		    <tr align="center" >
                <td><br>
		            <label style="border: 2px; border-radius: 2px; background-color: red; color: white; font-size: 22px; padding: 2px; font-style: verdana">Actualizar Salas</label>
                    <p>
                        <div>
                            <label class="text-light" style="width: 70px">Nombre</label>
                            <input type="text" name="nombre" id="nombre" disabled placeholder="<?php echo $room->getNombre();?>" required>
                        </div>
                        <div>
                            <label class="text-light" style="width: 70px">Precio</label>
                            <input type="number" name="precio" id="precio" disabled placeholder="<?php echo $room->getPrecio();?>" required>
                        </div>
                        <div>
                            <label class="text-light">Capacidad</label>
                            <input type="number" name="capacidad" id="capacity" disabled placeholder="<?php echo $room->getCapacidad();?>" required>
                        </div><hr>
                    </p>
		        </td>
            </tr>
            <tr align="center">
                <td>
                    <form action="<?php echo FRONT_ROOT ;?> RoomController/Update" method="POST"> 
                        <input type="hidden" name="idRoom" value='<?php echo $room->getId(); ?>'>
                        <p>
                            <table   width="600px">
                                <tr>
                                    <td>
                                        <div>
                                            <label class="text-light" style="width: 80px" required>Nombre: </label>
                                            <input type="text" name="nombre"></input>
                                        </div>
                                        <div>
                                            <label class="text-light" style="width: 80px" required>Precio:</label>
                                            <input type="number" name="precio"></input>
                                        </div>
                                        <div>
                                            <label class="text-light" required>Capacidad:</label>
                                            <input type="number" name="capacity"></input>
                                        </div>
                                        <input type="hidden" name="idCine" value="<?php echo $room->getCine()->getId(); ?>"> 
                                    </td>
                                </tr>
                            </table>
                        </p>
                        <button type="submit" name="actualizar" class='btn text-light' style="background-color: red; font-size: 17px; border-radius: 4px; width: 150px">Actualizar</button>
                    </form>
		        </td>
            </tr>
        </div>
    </table>
</body>