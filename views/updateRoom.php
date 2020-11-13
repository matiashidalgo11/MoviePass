<main>
    <div>
    <h2 class="text-light">Actualizar Cine</h2>
            <div>
                <div>
                    <label class="text-light">Nombre</label>
                    <input type="text" name="nombre" id="nombre" disabled placeholder="<?php echo $room->getNombre();?>" required>
                </div>
                <div>
                    <label class="text-light">Precio</label>
                    <input type="number" name="precio" id="precio" disabled placeholder="<?php echo $room->getPrecio();?>" required>
                </div>
            </div>
                <div>
                    <label class="text-light">Capacidad</label>
                    <input type="number" name="capacidad" id="capacity" disabled placeholder="<?php echo $room->getCapacidad();?>" required>
                </div>
            </div>

        <form action="<?php echo FRONT_ROOT ;?> RoomController/Update" method="POST"> 

                <input type="hidden" name="idRoom" value='<?php echo $room->getId(); ?>'>

                <label class="text-light">Nombre: </label>
                <input type="text" name="nombre"></input>

                <label class="text-light">Precio:</label>
                <input type="number" name="precio"></input>

                <label class="text-light">Capacidad:</label>
                <input type="number" name="capacity"></input>
                
                <input type="hidden" name="idCine" value="<?php echo $room->getCine()->getId(); ?>"> 

                <button type="submit" name="actualizar" class='btn text-light'> 
                Actualizar
            </button>

        </form>
    </div>
</main>