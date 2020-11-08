<?php require_once(VIEWS_PATH."nav-bar.php");
        require_once(VIEWS_PATH."header.php");

?>


<div id="listaCines">
    <div class ="container"> 
        <div class="listcinema-container">
            <div class="row">
                <div class="col-9">
                    <h2> Sucursales
                </div>
                <div class="col-3">
                    <form method="get" action="<?php echo FRONT_ROOT?>cine/showAdd">
                        <button type="submit" class="btn btn-dark">Agregar nuevo cine</button>
                    </form>
                </div>
                
            </div>
            <div class="row">
                <?php 
                foreach($arrayCine as $cine)
                {

                ?>
                <div class="col-3" style="margin-bottom:20px">
                    <div class="card">
                        <div class="card-img-top cinema-card container">
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text"> <?php echo $cine->getNombre(); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        
                        <span class="h5 card-title">Direccion: <?php echo $cine->getDireccion(); ?></span></br>
                        <form class="" action="<?php echo FRONT_ROOT?>cine/remove" method="POST">
                            <button type="submit" name="idCine" class="btn-dark btn-sm" value="<?php echo $cine->getId($id) ?>">Eliminar</button>
                        </form>
                        <form action="<?php echo FRONT_ROOT?>room/showList" method="POST">
                            <button type="submit"  name="idCine" class="btn-dark btn-sm" value="<?php echo $cine->getId(); ?>">Ver Salas</button>
                        </form>
                        </div>
                    </div>
                
                </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>


<?php require_once(VIEWS_PATH."footer.php");?>