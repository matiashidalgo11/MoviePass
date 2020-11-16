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

<!--         <table>
    <thead>
      <tr>
           <th>Id</th>
           <th>Nombre de la Pelicula</th>
           <th>Nombre de la Sala</th>
           <th>Fecha</th>
           <th>Hora</th>
           <th>Id del Cine</th>
           <th>Precio de la Entrada</th>
      </tr>
    </thead>
    <tbody>
    <?php
          foreach ($funcionList as $value):?>
          <tr>
             <td> <?php echo $value->getId(); ?></td>
             <td> <?php echo $value->getMovie()->getTitle(); ?></td>
             <td> <?php echo $value->getRoom()->getNombre(); ?></td>
             <td> <?php echo $value->getDate(); ?> </td>  
             <td> <?php $open_time_date=strtotime($value->getOpeningTime());
                        echo date("h:i A", $open_time_date);?> 
            </td> 
             <td> <?php echo $value->getRoom()->getIdCine();?> </td>
             <td> <?php echo $value->getPrecio();?> </td>
            <td>
              <form action="<?php echo FRONT_ROOT ;?>/funcionController/Delete" method="POST"> 
                  <input type="hidden" value='<?php echo $value->getId(); ?>'>
                  <button type="submit" class='btn text-light'>Eliminar
                </button>
              </form> 
            </td>
          </tr>
        <?php endforeach; ?>
  </tbody>
</table> -->

    </div>

</div>

