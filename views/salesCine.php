
<?php require_once(VIEWS_PATH."nav-bar.php");
    require_once(VIEWS_PATH."header.php");
?>

<div  class="container"> 

            <div>
                    
                    

                    <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Direccion</th>
                <th scope="col">Tickets Vendidos</th>
                <th scope="col">Capacidad Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
                                    if(isset($cineEntradas)){
                                        foreach($cineEntradas as $cineEntrada)
                                        {
                                            ?>
                                            
                                                <tr>
                                                    <td><?php echo $cineEntrada['cine']->getId(); ?></td>
                                                    <td><?php echo $cineEntrada['cine']->getNombre(); ?></td>
                                                    <td><?php echo $cineEntrada['cine']->getDireccion(); ?></td>
                                                    <td><?php echo $cineEntrada['ventas']; ?></td>
                                                    <td><?php echo $cineEntrada['capacidadTotal']; ?></td>
                                                </tr>
                                            
                                            <?php
                                        }
                                    }
                                ?>
                
            </tbody>

                </div>

                <div >
                    
                    

                    <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Direccion</th>
                <th scope="col">Recaudacion</th>
                </tr>
            </thead>
            <tbody>
            <?php
                                    if(isset($cineDinero)){
                                        foreach($cineDinero as $value)
                                        {
                                            ?>
                                            
                                                <tr>
                                                    <td><?php echo $value['cine']->getId(); ?></td>
                                                    <td><?php echo $value['cine']->getNombre(); ?></td>
                                                    <td><?php echo $value['cine']->getDireccion(); ?></td>
                                                    <td><?php echo $value['recaudacion']; ?></td>
                                                </tr>
                                            
                                            <?php
                                        }
                                    }
                                ?>
                
            </tbody>

                </div>
















</div>












<?php require_once(VIEWS_PATH."footer.php");?>