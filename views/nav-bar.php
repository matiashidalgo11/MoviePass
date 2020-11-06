<div class='container-fluid'>

  <nav id="menuNav" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <i class="fas fa-video"> MoviePass</i>
    </a>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
      
    <li class="nav-item active">
        <a class="nav-link" href="#">Cines <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>movies/listMovies">Cartelera</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>cine/ShowList">Administrar Cines</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Perfil
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>


            <form action="<?= FRONT_ROOT ?>movies/listMovieByGenre" method="post">




        <div class="userOff d-flex align-items-end">
          <form class="form-inline my-2 my-lg-0 ">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Movie" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="<?= FRONT_ROOT ?>LoginController/init" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= $perfil->getNombre() . " " . $perfil->getApellido() ?>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Perfil</a>
              <a class="dropdown-item" href="#">Historial Entradas</a>
              <a class="dropdown-item" href="#">Entradas Proximas</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Cerrar Sesion</a>
            </div>
          </li>

        </div>


      <?php } else { ?>

      <div class="userOff d-flex align-items-end">
        <a class="nav-link" href="#">Iniciar Sesion</a>
      
        <a class="nav-link" href="<?= FRONT_ROOT ?>cuentas/registrarse">Crear Cuenta</a>
     </div>
     

          <div class="userOff d-flex align-items-end">
            <a class="nav-link" href="<?= FRONT_ROOT ?>LoginController/init">Admin</a>

          </div>

      <?php }
      } ?>


    </div>
  </nav>
</div>