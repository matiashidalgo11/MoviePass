<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-12 col-sm-6 col-md-3">

        

            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>CuentasController/crear" method="POST">

                <h1>Registro</h1>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="email" value= " <?php if (isset($_SESSION['fb-userData'])) echo $_SESSION['fb-userData']['email'] ?>" <?php if (isset($_SESSION['fb-userData'])) echo "disabled" ?>>
                        
                        <?php if (isset($_SESSION['fb-userData'])){?>

                            <input type = "hidden" name = "email" id = "emailF" required value="<?php  echo $_SESSION['fb-userData']['email'] ?>">

                        <?php }?>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="password">
                    </div>
                </div>

                <div class="form-group">
                        <label for="inputPassword4">Repetir Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="rPassword">
                </div>

                <div class="form-group">
                        <label for="inputEmail4">Dni</label>
                        <input type="number" class="form-control" id="inputEmail4" name="dni">
                </div>

                
                <div class="form-row">

                    <div class="form-group col-md-6">

                        <label for="inputEmail4">Nombre</label>
                        <input type="text" class="form-control" id="inputEmail4" name="nombre" value= " <?php if (isset($_SESSION['fb-userData'])) echo $_SESSION['fb-userData']['first_name'] ?>" <?php if (isset($_SESSION['fb-userData'])) echo "disabled" ?>>
                            
                        <?php if (isset($_SESSION['fb-userData'])){?>

                            <input type = "hidden" name = "nombre" id = "nombreF" required value="<?php  echo $_SESSION['fb-userData']['first_name'] ?>">

                        <?php }?>

                    </div>


                    <div class="form-group col-md-6">

                        <label for="inputPassword4">Apellido</label>
                        <input type="text" class="form-control" id="inputPassword4" name="apellido" value= " <?php if (isset($_SESSION['fb-userData'])) echo $_SESSION['fb-userData']['last_name'] ?>" <?php if (isset($_SESSION['fb-userData'])) echo "disabled" ?>>
                            
                        <?php if (isset($_SESSION['fb-userData'])){?>

                            <input type = "hidden" name = "apellido" id = "apellidoF" required value="<?php  echo $_SESSION['fb-userData']['last_name'] ?>">

                        <?php }?>       
                    
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Telefono</label>
                        <input type="number" class="form-control" id="inputEmail4" name="telefono">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Domicilio</label>
                        <input type="text" class="form-control" id="inputPassword4" name="direccion">
                    </div>
                </div>

                
                <?php if (isset($_SESSION['fb-userData'])) {?>

                <div class="form-group">
                        <label for="inputIdFb">Id Facebook</label>
                        <input type="text" class="form-control" id="inputIdFb" name="idFb" value= " <?= $_SESSION['fb-userData']['id'] ?>" disabled >
                        <input type="hidden" class="form-control" id="inputIdFb" name="idFb" value= " <?= $_SESSION['fb-userData']['id'] ?>" >

                </div>

                <?php }?>
                
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>

        </div>

    </div>

</div>