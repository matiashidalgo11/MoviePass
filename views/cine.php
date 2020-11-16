
<?php
require_once(VIEWS_PATH."navUser.php");
require_once(VIEWS_PATH."header.php");
?>

<style>
body {
    height: 100%;
    max-height: 100vh;
    margin: 0;
}


#box {
    min-height: 100vh !important;
    height: auto !important;
    margin-bottom: 10%;
	  margin-top: 5%;
  	border-radius: 25px;
    
} 

h1{
  font-size: 20px;
  margin-top: 10%;
}


.container {
     min-height: 100vh; 
     height: 100% !important;
     width: 100%;
 }

.movieBoxes {
    margin-left: 7%;
    width: 85%;
    padding: 10px;
    margin-bottom: 10%;
    margin-top: -10%;
}

   .col-md-3 img {
     opacity: 0.8; 
     cursor: pointer; 
   }
   
   .col-md-3 img:hover {
     opacity: 1;
   }


#searchBox{
    position: relative;
    transform: translate(-50%,-50%);
    transition: all 1s;
    width: 50px;
    height: 50px;
    background: white;
    box-sizing: border-box;
    border-radius: 25px;
    border: 4px solid white;
    padding: 5px;
	  margin-top: 17%;
	  margin-left: 36%;
}

#inputSearch{
    position: absolute;
    width: 100%;;
    height: 42.5px;
    line-height: 30px;
    outline: 0;
    border: 0;
    display: none;
    font-size: 1em;
    border-radius: 20px;
    padding: 0 20px;
}

#inputConfig{
    box-sizing: border-box;
    padding: 10px;
    width: 42.5px;
    height: 42.5px;
    position: absolute;
    top: 0;
    right: 0;
    border-radius: 50%;
    color: #07051a;
    text-align: center;
    font-size: 1.2em;
    transition: all 1s;
}

#searchBox:hover{
    width: 200px;
    cursor: pointer;
}

#searchBox:hover input{
    display: block;
}

#searchBox:hover .fa{
    background: #07051a;
    color: white;
    display: block;
}



#icon{
  margin-right: 2%;
}

.button {
  background-color: rgba(39, 116, 70, 1);
  border: none;
  color: white;
  padding: 5% 30%;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 1rem;
  cursor: pointer;
}
.button .icon {
  width: 40px;
  height: 40px;
  margin-top: 5%;
  filter: invert(100%);
}  

textbox {
  width: 70%;
  overflow: hidden;
  font-size: 15px;
  padding: 8px 0;
  margin-bottom: 5%;
  border-bottom: 1px solid white;
}
	 
.custom-select{
	width: 25%;
  float: right;
}

</style>


<div id="box" class="container" style="background-color: rgba(230, 230, 230, 0.5);">
            <div class="row" >   
                <div class="col-md-8">
                            
                                
                  <form action="<?php echo FRONT_ROOT?> funcionController/SearchByGenre" method="POST">
                  <label for="cars">Elija genero:</label>
                  <select id="idGender" name="idGender">
                             <?php foreach ($listGenres as $genre) { ?>
                                              <option value="<?= $genre->getId(); ?>"><?= $genre->getName(); ?></option>
                                              <?php } ?>
                                          
                    </select>
                             <input type="submit">
                    </form>
       
                    <div class="textbox">
                        <form  action="<?php echo FRONT_ROOT?> funcionController/SearchByDate" method = "POST">
                            <input id="inputDate" type="date" name="date">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>			
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                    <form id ="searchBox" action="<?php echo FRONT_ROOT ?>funcionController/SearchByName" method = "POST">
                        <input id ="inputSearch" type="search" name="nameMovie">
                            <i class="fa fa-search" id="inputConfig"></i>
                    </form>				 
            </div>
            <div class="row">
                    <div class="scrollmenu">
                            <div class="row row-cols-1 row-cols-md-4">
                                    <?php foreach($funcionesList as $funcion){ ?>

                                            <div class="column">
                                                    <div class="card" style="width: 20rem;">
                                                            <img class="card-img-top" src=<?php echo IMG_BASE_TMBD . "w220_and_h330_face" . $funcion->getMovie()->getPoster_path() ?> alt="Card image cap">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title"><?php echo $funcion->getMovie()->getTitle()?></h5>
                                                                        <p class="card-text">CINE: <?php echo $funcion->getRoom()->getCine()->getNombre()?><br> SALA: <?php echo $funcion->getRoom()->getNombre()?></p>
                                                                    </div>
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">DIA: <?php echo $funcion->getDate()?></li>
                                                                        <li class="list-group-item">HORA: <?php echo $funcion->getHour()?></li>
                                                                        <li class="list-group-item">DIRECCION: <?php echo $funcion->getRoom()->getCine()->getDireccion()?></li>
                                                                    </ul>
                                                                <div class="card-body">
                                                                    <form action="<?php echo FRONT_ROOT?>CompraController/buyMovie" method="POST">  <button type="submit" name="idFuncion" value="<?php echo $funcion->getId()?>" >Tickets</button> </form>
                                                                    
                                                                    </div>
                                                    </div>

                                            </div>       

                                    <?php }?>
                            </div>
                    </div>
            </div>



</div>



<?php require_once(VIEWS_PATH."footer.php"); ?>




