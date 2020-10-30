<form action="<?= FRONT_ROOT ?>/CineController/add" method="POST">
<table>
  <tr>
    <td><label for="cine">Nombre</label></td>
    <td><input type="text" name="nombre_cine" id="nombre_cine" require></td>
  </tr>
  <tr>
    <td><label for="cine">Capacidad</label></td>
    <td><input type="text" name="capacidad_total" id="capacidad_total" require></td>
  </tr>
  <tr>
    <td><label for="cine">Direccion</label></td>
    <td><input type="text" name="direccion" id="direccion" require></td>
  </tr>
  <tr>
    <td><label for="cine">Valor de Entradas</label></td>
    <td><input type="text" name="valor_entrada" id="valor_entrada" require></td>
  </tr>
  <tr>
    <td><button type="submit">Aceptar</button></td>
    <td></td>
  </tr>
</table>
</form>