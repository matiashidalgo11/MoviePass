

<?php

include_once(VIEWS_PATH."nav-bar.php");
include_once(VIEWS_PATH."header.php");

?>



<div class="container">
        <h1 class="text-info">Cine: <?php echo $roomList[0]->getCine()->getNombre();?></h1>
        

        <form class="form-inline" action="<?php echo FRONT_ROOT?>Room/ShowAddView" method = "POST">
                    <label><h2 style="color:black">LISTADO DE SALAS</h2></label>
                    <input type = "hidden" name = "id" id = "idCinema" required value="<?php echo $idCinema;?>">
                    <input type="submit" value="Crear Sala" style="color:black">
        </form>
        

        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Capacidad</th>
                <th scope="col">Valor entrada</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        if(isset($roomList)){

                            foreach($roomList as $key=> $room)
                            {   
                               
                                ?>
                                
                                    <tr>
                                        <td><?php echo $room->getId(); ?></td>
                                        <td><?php echo $room->getNombre(); ?></td>
                                        <td><?php echo $room->getCapacidad();?> personas</td>
                                        <td>$<?php echo $room->getPrecio(); ?></td>
                                        <td><form action = "<?php echo FRONT_ROOT?>Room/Remove" method = "POST"><button class="btn-xs btn btn-danger" type = "submit" name = "remove" value = "<?php echo $room->getId(); ?>">Eliminar</button></form>
                                            <form action = "<?php echo FRONT_ROOT?>Room/Edit" method = "POST"><button class="btn-xs btn btn-danger" type = "submit" name = "remove" value = "<?php echo $room->getId(); ?>">Editar</button></form> 
                                            <form action = "<?php echo FRONT_ROOT?>Show/ShowAddView" method = "POST">
                                               <input type="hidden" name="room" value="<?php $room;?>">
                                               <button class="btn-xs btn btn-danger" type = "submit" name = "remove" >AddShow</button>
                                            </form>
                                         </td>
                                    </tr>
                                    
                                
                                <?php
                                
                            }
                        }
                ?>
    
            </tbody>
        </table>

    </div>
















<?php
    include_once(VIEWS_PATH."footer.php");
?>