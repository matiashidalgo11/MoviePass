
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
.movie-card {
  background: #ffffff;
  box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 315px;
  margin: 2em;
  border-radius: 10px;
  display: inline-block;
}
.movie-card {
  background: #ffffff;
  box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 315px;
  margin: 2em;
  border-radius: 10px;
  display: inline-block;
}

.movie-header {
  padding: 0;
  margin: 0;
  height: 367px;
  width: 100%;
  display: block;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
.movie-card:hover {
  -webkit-transform: scale(1.03);
          transform: scale(1.03);
  box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.08);
}

.movie-content {
  padding: 18px 18px 24px 18px;
  margin: 0;
}

.movie-content-header, .movie-info {
  display: table;
  width: 100%;
}

.movie-title {
  font-size: 24px;
  margin: 0;
  display: table-cell;
}
.movie-info {
  margin-top: 1em;
}

</style>


<div id="box" class="container" style="background-color: rgba(230, 230, 230, 0.5);">
       
                  <div class="row" >   
                      <div class="col-md-8">
                                  
                                      
                        <form action="<?php echo FRONT_ROOT?> funcionController/SearchByGenre" method="POST">
                        <label for="generos">Elija genero:</label>
                        <select id="idGender" name="idGender">
                                  <?php foreach ($listGenres as $genre) { ?>
                                                    <option value="<?= $genre->getId(); ?>"><?= $genre->getName(); ?></option>
                                                    <?php } ?>
                                                
                          </select>
                                  <button type="submit" class="btn btn-primary">Enviar</button>
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
                <div class="scrollmenu" align="center">
                       <div class="row row-cols-1 row-cols-md-3">
                            
                    <?php foreach ($funcionesList as $funcion)
                    {
                        ?>

                          <div class="movie-card">
                          <div class="" >
                                <div class="header-icon-container">
                                  <a href="#">
                                          <img src="<?php echo  IMG_BASE_TMBD . "w220_and_h330_face" . $funcion->getMovie()->getPoster_path();?>" alt="Card image">
                                  </a>
                                </div>
                          </div><!--movie-header-->
                                      <div class="movie-content">
                                    <div class="movie-content-header">
                                            <a href="#">
                                              <h3 class="movie-title"><?php echo $funcion->getMovie()->getTitle();?></h3>
                                            </a>
                                            <div class="imax-logo"></div>
                                    </div>
                                    <div class="movie-info">
                                            <div class="info-section">
                                              <label>Date & Time</label>
                                              <span><?php echo $funcion->getDate(); ?>- <?php echo $funcion->getHour(); ?></span>
                                            </div><!--date,time-->
                                              <div class="info-section">
                                                <label>Cine: </label>
                                                <span><?php echo $funcion->getRoom()->getCine()->getNombre(); ?></span>
                                              </div><!--screen-->
                                                  <div class="info-section">
                                                  <label>Sala: </label>
                                                  <span><?php echo $funcion->getRoom()->getNombre(); ?></span>
                                                </div><!--row-->
                                                <div class="info-section">
                                                  <label>Direccion: </label>
                                                  <span><?php echo $funcion->getRoom()->getCine()->getDireccion(); ?></span>
                                                </div><!--seat-->
                                                <div class="card-body">
                                                  <form action="<?php echo FRONT_ROOT?>CompraController/buyMovie" method="POST">  <button type="submit" class="btn btn-primary" name="idFuncion" value="<?php echo $funcion->getId()?>" >Tickets</button> </form>                 
                                                 </div>
                                    </div>
                                  </div><!--movie-content-->
                          </div><!--movie-card-->

                    <?php   } ?>
                          
                    </div><!--container-->  
               </div>
         </div>                       



</div>



<?php require_once(VIEWS_PATH."footer.php"); ?>




