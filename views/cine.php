



<?php
require_once(VIEWS_PATH."navUser.php");
require_once(VIEWS_PATH."header.php");


?>



<div class="row row-cols-1 row-cols-md-4">

<?php foreach($funcionesList as $funcion){ ?>

    
                <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src=<?php echo IMG_BASE_TMBD . "w220_and_h330_face" . $funcion->getMovie()->getPoster_path() ?> alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $funcion->getMovie()->getTitle()?></h5>
                                    <p class="card-text">CINE: <?php echo $funcion->getRoom()->getCine()->getNombre()?><br> SALA: <?php echo $funcion->getRoom()->getNombre()?></p>
                                 </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">DIA: <?php echo $funcion->getDate()?></li>
                                    <li class="list-group-item">HORA: <?php echo $funcion->getHour()?></li>
                                    <li class="list-group-item">DIRECCION: <?php echo $funcion->getRoom()->getCine()->getDireccion()?></li>
                                </ul>
                               <div class="card-body">
                                   <form action="<?php echo FRONT_ROOT?>compra/buyMovie" method="POST">  <button type="submit" name="idFuncion" value="<?php echo $funcion->getId()?>" >Tickets</button> </form>
                                  
                                </div>
                </div>

   

<?php }?>




</div>

<div>

    <a href="<?php echo FRONT_ROOT?>ticket/ticketViewByUser">Ver mis tickets</a>

</div>


<?php require_once(VIEWS_PATH."footer.php"); ?>