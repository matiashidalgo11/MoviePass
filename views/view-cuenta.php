<?php require_once(VIEWS_PATH."nav-bar.php");
        require_once(VIEWS_PATH."header.php");

?>

<div class="row justify-content-center">
<div class="card" style="width: 35rem;">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Informacion</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Email: </th>
      <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getEmail() : 'Vacio'; ?></td>
    </tr>
    <tr>
      <th scope="row">Nombre: </th>
      <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getProfile()->getNombre() : 'Vacio'; ?></td>
    </tr>
    <tr>
      <th scope="row">Apellido: </th>
      <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getProfile()->getApellido() : 'Vacio'; ?></td>
    </tr>
    <tr>
      <th scope="row">Dni: </th>
      <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getProfile()->getDni() : 'Vacio'; ?></td>
    </tr>
    <tr>
      <th scope="row">Telefono: </th>
      <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getProfile()->getTelefono() : 'Vacio'; ?></td>
    </tr>
    <tr>
      <th scope="row">Direccion: </th>
      <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getProfile()->getDireccion() : 'Vacio'; ?></td>
    </tr>
    
  </tbody>

  
</table>
  <a href="<?= FRONT_ROOT ?>CuentasController/editarCuenta" type="button">Editar Cuenta</a>
</div>
</div>

<?php require_once(VIEWS_PATH."footer.php");?>