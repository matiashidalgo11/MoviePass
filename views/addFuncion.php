<main>
	<div>
    <h2 class="text-light" >Agregar Funcion</h2>
        <form action="<?php echo FRONT_ROOT; ?>/funcionController/Add" method="POST"> 
            <div>
                <div>
                    <label>Pelicula</label>
                    <select name="funcionMovie" id="funcionMovie">
                    <?php foreach ($moviesArray as $value): ?> 
                           <option value="<?php echo $value->getId();?>">
                                <?php echo $value->getTitle();?>
                            </option>
                        <?php endforeach;  ?>    
                    </select>                
                </div>
                  <div class="col-md">
                    <label>Room</label>
                    <select name="funcionRoom" id="funcionRoom">
                       <?php foreach ($roomsArray as $value2): ?> 
                           <option value="<?php echo $value2->getIdRoom();?>">                              
                                <?php 
                                    echo $value2->getIdCine()."-". $value2->getNombre();
                                ?>
                            </option>
                        <?php endforeach;  ?>    
                    </select>                    
                </div>
                <div>
                    <label>Fecha</label>
                    <input type="date" name="funcionDate" id="funcionDate" placeholder="Ingrese una fecha" required>
                </div>
                <div class="col-md">
                    <label for="funcionHour">Hora</label>
                    <input type="time" name="funcionHour"id="funcionHour" placeholder="Ingrese una fecha" required>
                </div>
            </div>
            <div>
                <input type="submit" name="submit" style="text-align: right;" value="Agregar">
            </div>
        </form>
	</div>
	</body>
</main>
