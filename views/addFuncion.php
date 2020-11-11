<main>
	<div>
    <h2 class="text-light" >Agregar Funcion</h2>
        <form action="<?php echo FRONT_ROOT; ?>funcionController/Add" method="POST"> 
            <div>
                <div>
                    <label>Pelicula</label>
                    <select name="idMovie" id="funcionMovie">
                    <?php foreach ($moviesArray as $value): ?> 
                           <option value="<?php echo $value->getId();?>">
                                <?php echo $value->getTitle();?>
                            </option>
                        <?php endforeach;  ?>    
                    </select>                
                
                
                </div>
                  <div class="col-md">
                    <label>Room <?php echo ": " . $idRoom ;?></label>
                    <input type = "hidden" name = "idRoom" id = "idRoom" required value="<?= $idRoom?>">
                         
                </div>

                
                <div>
                    <label>Fecha</label>
                    <input type="date" name="date" id="funcionDate" placeholder="Ingrese una fecha" required>
                </div>
                <div class="col-md">
                    <label for="funcionHour">Hora</label>
                    <input type="time" name="hour" id="funcionHour" placeholder="Ingrese una fecha" required>
                </div>
            </div>
            <div>
                <input type="submit" name="submit" style="text-align: right;" value="Agregar">
            </div>
        </form>
	</div>
	</body>
</main>
