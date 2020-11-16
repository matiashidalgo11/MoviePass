<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="card bg-dark text-white ">
            
            <img src=<?= IMG_BASE_TMBD . "w220_and_h330_face" . $movie->getPoster_path() ?> class="card-img" alt=<?= $movie->getTitle()?>>
        
            <div class="card-img-overlay d-flex align-items-end">
                
                <div class="list-group">
                    <h5 class="card-title "><?= $movie->getTitle()?></h5>
                    <p class="card-text"><?= $movie->getRelease_date()?></p>
                </div>

            </div>

        </div>


    </div>

</div>


<div class="container-fluid">
<div class="row">
                <div class="scrollmenu" align="center">
                       <div class="row row-cols-1 row-cols-md-3">
                            
                    <?php foreach ($funcionesList as $funcion)
                    {
                        ?>

                          <div class="movie-card">
                          <div class="" >
                                <div class="header-icon-container">
                                  <a href="#">
                                          <img src="<?php echo  IMG_BASE_TMBD . "w220_and_h330_face" . $funcion->getMovie()->getPoster_path();?>" alt="Card image">
                                  </a>
                                </div>
                          </div><!--movie-header-->
                                      <div class="movie-content">
                                    <div class="movie-content-header">
                                            <a href="#">
                                              <h3 class="movie-title"><?php echo $funcion->getMovie()->getTitle();?></h3>
                                            </a>
                                            <div class="imax-logo"></div>
                                    </div>
                                    <div class="movie-info">
                                            <div class="info-section">
                                              <label>Date & Time</label>
                                              <span><?php echo $funcion->getDate(); ?>- <?php echo $funcion->getHour(); ?></span>
                                            </div><!--date,time-->
                                              <div class="info-section">
                                                <label>Cine: </label>
                                                <span><?php echo $funcion->getRoom()->getCine()->getNombre(); ?></span>
                                              </div><!--screen-->
                                                  <div class="info-section">
                                                  <label>Sala: </label>
                                                  <span><?php echo $funcion->getRoom()->getNombre(); ?></span>
                                                </div><!--row-->
                                                <div class="info-section">
                                                  <label>Direccion: </label>
                                                  <span><?php echo $funcion->getRoom()->getCine()->getDireccion(); ?></span>
                                                </div><!--seat-->
                                                <div class="card-body">
                                                  <form action="<?php echo FRONT_ROOT?>CompraController/buyMovie" method="POST">  <button type="submit" class="btn btn-primary" name="idFuncion" value="<?php echo $funcion->getId()?>" >Tickets</button> </form>                 
                                                 </div>
                                    </div>
                                  </div><!--movie-content-->
                          </div><!--movie-card-->

                    <?php   } ?>
                          
                    </div><!--container-->  
               </div>
         </div>

         </div>