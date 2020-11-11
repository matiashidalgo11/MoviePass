<div class='container-fluid'>

  <nav id="menuNav" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <i class="fas fa-video"> MoviePass</i>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto ">

        <?php if (isset($_SESSION['cuenta'])) { ?>
        <?php if ($_SESSION['cuenta']->getPrivilegios() == 0) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= FRONT_ROOT ?>CineController/showList">Administrar Cines</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= FRONT_ROOT ?>#">Administrar Usuarios</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= FRONT_ROOT ?>#">Actualizar Cartelera</a>
          </li>

        <?php } else { ?>



          <li class="nav-item active">
            <a class="nav-link" href="#">Cines <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= FRONT_ROOT ?>MoviesController/listMovies">Cartelera</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= FRONT_ROOT ?>MoviesController/listMovies">Funciones</a>
          </li>

          

        <?php } }?>

        <?php if (!isset($_SESSION['cuenta']) || $_SESSION['cuenta']->getPrivilegios() != 0 ) { ?> 

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Generos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php foreach ($listGenres as $genre) { ?>

                <form action="<?= FRONT_ROOT ?>MoviesController/listMovieByGenre" method="post">

                  <input type="hidden" value="<?= $genre->getId(); ?>" name="idGenre">

                  <button class="dropdown-item" type="submit"> <?= $genre->getName(); ?> </button>

                </form>

              <?php } ?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Todo</a>
            </div>
          </li>
          
      </ul>

        <?php } ?> 



      <?php if (!isset($_SESSION['cuenta'])) { ?>

        <div class="userOff d-flex align-items-end">
          <a class="nav-link" href="<?= FRONT_ROOT ?>LoginController/init">Iniciar Sesion</a>

          <a class="nav-link" href="<?= FRONT_ROOT ?>CuentasController/registrarse">Crear Cuenta</a>
        </div>


      <?php } else if ($_SESSION['cuenta']->getPrivilegios() == 1) { ?>
        <?php $perfil = $_SESSION['cuenta']->getProfile();   ?>




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
              <a class="dropdown-item" href="<?php echo FRONT_ROOT?>TicketController/ticketViewByUser">Ver mis Tickets</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?= FRONT_ROOT ?>CuentasController/cerrarSesion">Cerrar Sesion</a>
            </div>
          </li>

        </div>


      <?php } else { ?>

        <?php if ($_SESSION['cuenta']->getPrivilegios() == 0) { ?>

          <div class="userOff d-flex align-items-end">
            <a class="nav-link" href="<?= FRONT_ROOT ?>CuentasController/cerrarSesion">Admin</a>

          </div>

      <?php }
      } ?>


    </div>
  </nav>
</div>