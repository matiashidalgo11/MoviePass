<main>
    <div>
    <h2 class="text-light" >Agregar Rooms</h2>
        <form  action="<?php echo FRONT_ROOT; ?>/roomController/Add" method="POST">
            <div>
                <div>
                    <label class="text-light" for="nombre">Nombre</label>
                    <input type="text" name="nombre"  id="nombre" placeholder="Ingrese un nombre" required>
                </div>
                <div>
                    <label class="text-light" for="precio">Precio</label>
                    <input type="number" name="precio"  id="precio" placeholder="Precio" required>
                </div>
                <div>
                    <label class="text-light" for="capacidad">Capacidad</label>
                    <input type="number" name="capacidad"  id="capacity" placeholder="Ingrese una capacidad" required>
                </div>
            </div>
            <div>
                <div>
                    <label class="text-light" for="cine">Cine</label>
                    <select class="form-control" name="cine" id="cine">
                        <?php foreach ($cineArray as $value): ?> 
                           <option value="<?php echo $value->getId();?>">
                                <?php echo $value->getNombre();?>
                            </option>
                        <?php endforeach;  ?>
                    </select>                
                </div>
                <div>
                <input type="submit" name="submit" class="btn btn-primary" style="text-align: right;" value="Agregar">
                </div>
            </div>
        </form>
	</div>
	</body>
</main>