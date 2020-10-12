<form action="<?= FRONT_ROOT ?>/CuentasController/crear" method="POST">
<table>
  <tr>
    <td><label for="cuenta">Email</label></td>
    <td><input type="text" name="email_cuenta" id="email_cuenta"></td>
  </tr>
  <tr>
    <td><label for="cuenta">Contraseña</label></td>
    <td><input type="password" name="password_cuenta" id="password_cuenta"></td>
  </tr>
  <tr>
    <td><label for="cuenta">Nombre</label></td>
    <td><input type="text" name="nombre" id="nombre"></td>
  </tr>
  <tr>
    <td><label for="cuenta">Apellido</label></td>
    <td><input type="text" name="apellido" id="apellido"></td>
  </tr>
  <tr>
    <td><label for="cuenta">Telefono</label></td>
    <td><input type="text" name="telefono" id="telefono"></td>
  </tr>
  <tr>
    <td><label for="cuenta">Domicilio</label></td>
    <td><input type="text" name="domicilio" id="domicilio"></td>
  </tr>
  <tr>
    <td><button type="submit">Aceptar</button></td>
    <td></td>
  </tr>
</table>
</form>