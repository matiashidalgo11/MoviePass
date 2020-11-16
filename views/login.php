
<div class="container-fluid">


        <div class="row justify-content-center">

            <div class="col-12 col-sm-6 col-md-3">


                <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>CuentasController/verificar" method="POST">
                        <h3 class="text-center font-eight-bol">Iniciar Sesion</h3>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control <?=(isset($_SESSION['loginValidator']['emailValidator']))? $_SESSION['loginValidator']['emailValidator'] : "";?>" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" >
                            <div class="invalid-feedback">
                             El email es invalido
                            </div>
                            
                        </div>


                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control <?=(isset($_SESSION['loginValidator']['passValidator']))? $_SESSION['loginValidator']['passValidator'] : "";?>" id="exampleInputPassword1" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>">
                            <div class="invalid-feedback">
                             Password incorrecto
                            </div>
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Entrar</button>
                        <a href="<?= FRONT_ROOT ?>CuentasController/registrarse" class="btn btn-success"> Registrarse</a>
                        <a href="<?= $fullURL ?>">Entrar con Facebook</a>
                </form>
            </div>

        </div>

</div>



