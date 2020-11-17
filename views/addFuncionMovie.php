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

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="card bg-dark text-white ">
            
            <img src=<?= IMG_BASE_TMBD . "w220_and_h330_face" . $movie->getPoster_path() ?> class="card-img" alt=<?= $movie->getTitle()?>>
        
            <div class="card-img-overlay d-flex align-items-end">
                
                <div class="list-group">
                    <h5 class="card-title "><?= $movie->getTitle()?></h5>
                    <p class="card-text"><?= $movie->getRelease_date()?></p>
                </div>

            </div>

        </div>

        <div id="box" class="container" style="background-color: rgba(230, 230, 230, 0.5);">
       
       
<div class="row">
     <div class="scrollmenu" align="center">
            <div class="row row-cols-1 row-cols-md-3">
            <table width="600px">
		                    <tr>
                                <td><br>
                                    <div>
                                        <form action="<?php echo FRONT_ROOT; ?>funcionController/Add" method="POST"> 
                                            <div>
                                                <label class="text-light">Seleccione Sala</label>
                                                <select name="idRoom" id="funcionMovie" required>
                                                    <?php foreach ($roomList as $room): ?> 
                                                    <option value="<?php echo $room->getId();?>">
                                                        <?php echo $room->getNombre()."/Cine:".$room->getCine()->getNombre();?>
                                                    </option>
                                                    <?php endforeach;  ?>    
                                                </select>
                                            </div>
                                         
                                                <label class="text-light">Fecha</label>
                                                <input type="date" name="date" id="funcionDate" placeholder="Ingrese una fecha" required>
                                            </div>
                                            <div>
                                                <label class="text-light" for="funcionHour">Hora</label>
                                                <input type="time" name="hour" id="funcionHour" placeholder="Ingrese una fecha" required>
                                            </div>
	                                </div>
                                </td>
                            </tr>
                        </table> 
               
         </div><!--container-->  
    </div>
</div>                       