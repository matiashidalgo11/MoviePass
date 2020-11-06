<form action="<?php echo FRONT_ROOT?>cine/add" method="POST">
<table>
<h2 class="text-light" >Agregar Cines</h2>
  <tr>
    <td><label for="cine">Nombre</label></td>
    <td><input type="text" name="nombre_cine" id="nombre_cine" require></td>
  </tr>
  <tr>
    <td><label for="cine">Direccion</label></td>
    <td><input type="text" name="direccion" id="direccion" require></td>
  </tr>
  <tr>
    <td><button type="submit">Aceptar</button></td>
    <td></td>
  </tr>
</table>
</form>