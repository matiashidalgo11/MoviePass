
<div class="container-fluid">


        <div class="row justify-content-center">

            <div class="col-12 col-sm-6 col-md-3">


                <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>CuentasController/verificar" method="POST">
                        <h3 class="text-center font-eight-bol">Iniciar Sesion</h3>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                            <small id="emailHelp" class="form-text text-muted">Ingrese un email valido.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Entrar</button>
                        <a href="<?= FRONT_ROOT ?>CuentasController/registrarse" class="btn btn-success"> Registrarse</a>
                </form>
            </div>

        </div>

</div>

