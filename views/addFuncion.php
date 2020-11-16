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
		            <label style="border: 2px; border-radius: 2px; background-color: red; color: white; font-size: 22px; padding: 2px; font-style: verdana">Agregar Funcion</label>
                    <p><hr>
                        <table width="600px">
		                    <tr>
                                <td><br>
                                    <div>
                                        <form action="<?php echo FRONT_ROOT; ?>funcionController/Add" method="POST"> 
                                            <div>
                                                <label class="text-light">Pelicula</label>
                                                <select name="idMovie" id="funcionMovie" required>
                                                    <?php foreach ($moviesArray as $value): ?> 
                                                    <option value="<?php echo $value->getId();?>">
                                                        <?php echo $value->getTitle();?>
                                                    </option>
                                                    <?php endforeach;  ?>    
                                                </select>
                                            </div>
                                            <div>
                                                <label class="text-light">Room <?php echo ": " . $idRoom ;?></label>
                                                <input type = "hidden" name = "idRoom" id = "idRoom" required value="<?= $idRoom?>">
                                            </div>
                                            <div>
                                                <label class="text-light">Fecha</label>
                                                <input type="date" name="date" id="funcionDate" placeholder="Ingrese una fecha" required>
                                            </div>
                                            <div>
                                                <label class="text-light" for="funcionHour">Hora</label>
                                                <input type="time" name="hour" id="funcionHour" placeholder="Ingrese una fecha" required>
                                            </div>
	                                </div>
                                </td>
                            </tr>
                        </table>
                    </p>
                    <div>
                        <button type="submit" class='btn text-light' style="background-color: red; font-size: 17px; border-radius: 4px; width: 150px">Agregar</button>
                    </div>
                </td>
            <tr>
        </div>
        </form>
    </table>
</body>
