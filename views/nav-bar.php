


<div class='container-fluid'>

        <?php if (isset($_SESSION['cuenta'])) { ?>
        <?php if ($_SESSION['cuenta']->getPrivilegios() == 0) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= FRONT_ROOT ?>#">Administrar Cines</a>
          </li>

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
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Generos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach($listGenres as $genre){ ?>

            <form action="<?php echo FRONT_ROOT ?>movies/listMovieByGenre" method="post">

              <input type="hidden" value="<?= $genre->getId();?>" name="idGenre">

              <button class="dropdown-item"  type="submit"> <?= $genre->getName();?> </button>
              
            </form>

            <?php } ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Todo</a>
        </div>
      </li>
      

          <li class="nav-item">
            <a class="nav-link" href="<?= FRONT_ROOT ?>MoviesController/listMovies">Funciones</a>
          </li>

          

        <?php } }?>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Generos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php foreach ($listGenres as $genre) { ?>

                <form action="<?php echo FRONT_ROOT ?>movies/listMovieByGenre" method="post"> 

                  <input type="hidden" value="<?= $genre->getId(); ?>" name="idGenre">

                  <button class="dropdown-item" type="submit"> <?= $genre->getName(); ?> </button>

                </form>

              <?php } ?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Todo</a>
            </div>
          </li>
          
      </ul>
   
      <form class="form-inline my-2 my-lg-0 ">
         <input class="form-control mr-sm-2" type="search" placeholder="Search Movie" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>


      <div class="userOff d-flex align-items-end">
        <a class="nav-link" href="#">Iniciar Sesion</a>
      
        <a class="nav-link" href="<?= FRONT_ROOT ?>cuentas/registrarse">Crear Cuenta</a>
     </div>
     

  </div>
</nav>
</div>





