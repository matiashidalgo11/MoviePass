<?php require_once(VIEWS_PATH."nav-bar.php");
    require_once(VIEWS_PATH."header.php");
?>

<div  class="container"> 

            <div>
                    
                    

                    <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Pelicula</th>
                <th scope="col">Tickets Vendidos</th>
                <th scope="col">Remanentes</th>
                </tr>
            </thead>
            <tbody>
            <?php
                                    if(isset($funcionTickets)){
                                        foreach($funcionTickets as $value)
                                        {
                                            ?>
                                            
                                                <tr>
                                                    <td><?php echo $value['funcion']->getId(); ?></td>
                                                    <td><?php echo $value['funcion']->getMovie()->getTitle(); ?></td>
                                                    <td><?php echo $value['soldTickets']; ?></td>
                                                    <td><?php echo $value['remanentes']; ?></td>
                                                </tr>
                                            
                                            <?php
                                        }
                                    }
                                ?>
                
            </tbody>

                </div>

            

 <?php require_once(VIEWS_PATH."footer.php");?>