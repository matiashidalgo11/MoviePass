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
		            <label style="border: 2px; border-radius: 2px; background-color: red; color: white; font-size: 22px; padding: 2px; font-style: verdana">Agregar Cine</label>
                    <p><hr>
                        <table width="600px">
		                    <tr>
                            <td><br>
                                    <div>
                                      <form action="<?php echo FRONT_ROOT?>CineController/add" method="POST">
                                        <div>
                                          <label for="cine" class="text-light" style="width: 68px">Nombre</label>
                                          <input type="text" name="nombre_cine" id="nombre_cine" required>
                                        </div>
                                        <div>
                                          <label for="cine" class="text-light">Direccion</label>
                                          <input type="text" name="direccion" id="direccion" required>
                                        </div>
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