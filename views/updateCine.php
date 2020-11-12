<main>
    <div>
    <h2 class="text-light">Actualizar Cine</h2>
            <div>
                <div>
                    <label class="text-light">Nombre</label>
                    <input type="text" name="nombre" id="nombre" disabled placeholder="<?php echo $cine->getNombre();?>" required>
                </div>
                <div>
                    <label class="text-light">Direccion</label>
                    <input type="text" name="direccion" id="direccion" disabled placeholder="<?php echo $cine->getDireccion();?>" required>
                </div>
            </div>

        <form action="<?php echo FRONT_ROOT ;?>/CineController/Update" method="POST"> 
                <input type="hidden" name="ID" value='<?php echo $cine->getId(); ?>'>

                <label class="text-light">Nombre: </label>
                <input type="text" name="nombre"></input>

                <label class="text-light">Direccion:</label>
                <input type="text" name="direccion"></input>

                <button type="submit" class='btn text-light'> 
                Actualizar
            </button>

        </form>
    </div>
</main>