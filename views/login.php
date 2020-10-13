    <form action="<?= FRONT_ROOT ?>/CuentasController/verificar" method="POST">

        <input type="text" name="user" placeholder="Usuario" />
        <input type="password" name="pass" placeholder="Contraseña" />
        <button type="submit">Log in</button>
    </form>

    <form action="<?= FRONT_ROOT ?>Movies/listMovies" method="POST">

    <a href="<?= FRONT_ROOT ?>/CuentasController/registrarse" >Crear usuario</a>
    <button type="submit">Actualizar Lista</button>

    </form>
