<?php
require_once(VIEWS_PATH."navUser.php");
require_once(VIEWS_PATH."header.php");
?>


<div class="scrollmenu"> 

<div class="row">
                             <div class="column">

                                    <div class="card" style="width: 18rem;height: 37rem;">
                                            <img class="card-img-top" src="<?php echo IMG_BASE_TMBD . "w220_and_h330_face" . $funcion->getMovie()->getPoster_path() ?>" alt="Card image cap">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title" style="color:black" align="center"><?php echo $funcion->getMovie()->getTitle()?></h5>
                                                                        <p class="card-text" style="color:black" align="center"> Cine: <?php echo $funcion->getRoom()->getCine()->getNombre()?></p>
                                                                    <p class="card-text" style="color:black" align="center"> Sala: <?php echo $funcion->getRoom()->getNombre()?></p>
                                                                    </div>
                                    </div>
                            </div>
                          
                            <div class="column">

                                    <div class="card" style="width: 18rem; height: 37rem;">
                                                <div class="card-body">
                                                                    <h5 class="card-title" style="color:black">Overview:</h5>
                                                                    <h6 class="card-subtitle mb-2 text-muted"style="color:black"><?php echo $funcion->getMovie()->getOverview()?></h6>
                                                                    <p class="card-text" style="color:black"> Popularity: <?php echo $funcion->getMovie()->getPopularity()  ?></p> 
                                                                    <p class="card-text" style="color:black" > Fecha: <?php echo $funcion->getDate(); ?></p>
                                                                    <p class="card-text" style="color:black"> Hora: <?php echo $funcion->getHour()?></p>
                                                                    <p class="card-text" style="color:black"> Idioma: <?php echo $funcion->getMovie()->getOriginal_language()?></p>
                                                </div>
                                    </div>
                            </div>
                            
    
</div>
</div>

<form action="<?php echo FRONT_ROOT?>compra/add" method="POST">
<table>
<h2 class="text-light" >Comprar Tickets</h2>
        <input type="hidden" name="idFuncion" value="<?php echo $funcion->getId()?>">
  <tr>
    <td><label for="cine">Cantidad de tickets</label></td>
    <td><input type="text" name="totalTickets" require></td>
  </tr>
    <input type="hidden" name="descuento" value="0">
  <tr>
    <td><button type="submit">Aceptar</button></td>
    <td></td>
  </tr>
</table>
</form>









<?php require_once(VIEWS_PATH."footer.php"); ?>