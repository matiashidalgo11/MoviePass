<?php require_once(VIEWS_PATH."nav-bar.php");
        require_once(VIEWS_PATH."header.php");

?>

<div>
  <div>
    <h1>
     Funciones
    </h1>
  </div>
  <div>
  <button type="button">
   <a class="text-light" href="<?php echo FRONT_ROOT ;?>/funcionControllet/GetAll">Mostrar</a>
  </button>
  </div>
  <div>
  <button type="button">
      <a class="text-light" href="<?php echo FRONT_ROOT ;?>/funcionController/showAdd">Agregar</a>
  </button>
</div>
<table>
    <thead>
      <tr>
           <th>Id</th>
           <th>Nombre de la Pelicula</th>
           <th>Nombre de la Sala</th>
           <th>Fecha</th>
           <th>Hora</th>
           <th>Id del Cine</th>
           <th>Precio de la Entrada</th>
      </tr>
    </thead>
    <tbody>
    <?php
          foreach ($funcionList as $value):?>
          <tr>
             <td> <?php echo $value->getId(); ?></td>
             <td> <?php echo $value->getMovie()->getTitle(); ?></td>
             <td> <?php echo $value->getRoom()->getNombre(); ?></td>
             <td> <?php echo $value->getDate(); ?> </td>  
             <td> <?php $open_time_date=strtotime($value->getOpeningTime());
                        echo date("h:i A", $open_time_date);?> 
            </td> 
             <td> <?php echo $value->getRoom()->getIdCine();?> </td>
             <td> <?php echo $value->getPrecio();?> </td>
            <td>
              <form action="<?php echo FRONT_ROOT ;?>/funcionController/Delete" method="POST"> 
                  <input type="hidden" value='<?php echo $value->getId(); ?>'>
                  <button type="submit" class='btn text-light'>Eliminar
                </button>
              </form> 
            </td>
          </tr>
        <?php endforeach; ?>
  </tbody>
</table>
</div>

<?php require_once(VIEWS_PATH."footer.php");?>