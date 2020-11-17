<?php require_once(VIEWS_PATH."nav-bar.php");
    require_once(VIEWS_PATH."header.php");

?>

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-12 col-sm-6 col-md-3">

        

            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>CuentasController/updateCuenta" method="POST">

                <h1>Actualizar</h1>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>

                        <input type="email" class="form-control" id="inputEmail4" name="email" 
                         value= "<?= (isset($_SESSION['cuenta']))? $_SESSION['cuenta']->getEmail() : 'Vacio'; ?>" disabled>
                        
                        <div class="invalid-feedback">
                             El email ya se encuentra en uso
                        </div>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control <?php if(isset($_SESSION['updateValidator'])) echo $_SESSION['updateValidator']['password']; ?>" id="inputPassword4" name="password"
                        value="<?= (isset($_SESSION['cuenta']))? $_SESSION['cuenta']->getPassword() : 'Vacio'; ?>">
                        <div class="invalid-feedback">
                             El password no coincide
                        </div>
                    </div>
                </div>

                <div class="form-group">
                        <label for="inputPassword4">Repetir Password</label>
                        <input type="password" class="form-control <?php if(isset($_SESSION['updateValidator'])) echo $_SESSION['updateValidator']['password']; ?>" id="inputPassword4" name="rPassword">
                </div>

                <div class="form-group">
                        <label for="inputEmail4">Dni</label>
                        <input type="number" class="form-control " id="inputEmail4" name="dni"
                        value = "<?= (isset($_SESSION['cuenta']))? $_SESSION['cuenta']->getProfile()->getDni() : 'Vacio'; ?>" disabled>
                        <div class="invalid-feedback">
                             El dni ya se encuentra en uso
                        </div>
                </div>

                
                <div class="form-row">

                    <div class="form-group col-md-6">

                        <label for="inputEmail4">Nombre</label>
                        <input type="text" class="form-control" id="inputEmail4" name="nombre" value= "<?= (isset($_SESSION['cuenta']))? $_SESSION['cuenta']->getProfile()->getNombre() : 'Vacio'; ?>" >
                            
            
                    </div>


                    <div class="form-group col-md-6">

                        <label for="inputPassword4">Apellido</label>
                        <input type="text" class="form-control" id="inputPassword4" name="apellido" value= "<?= (isset($_SESSION['cuenta']))? $_SESSION['cuenta']->getProfile()->getApellido() : 'Vacio'; ?>" >    
                    
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Telefono</label>
                        <input type="number" class="form-control" id="inputEmail4" name="telefono"
                        value="<?= (isset($_SESSION['cuenta']))? $_SESSION['cuenta']->getProfile()->getTelefono() : 'Vacio'; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Domicilio</label>
                        <input type="text" class="form-control" id="inputPassword4" name="direccion"
                        value="<?= (isset($_SESSION['cuenta']))? $_SESSION['cuenta']->getProfile()->getDireccion() : 'Vacio'; ?>">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>

        </div>

    </div>

</div>

<?php require_once(VIEWS_PATH."footer.php");?>