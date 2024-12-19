<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div>
            <h1>Bienvenido!!!</h1>
            <!-- Le muestro los errores en caso de haber alguno-->
            <?php $errors = $this->session->flashdata('errores');
            ?>
            <!-- Formulario del login que hace la accion en login del controlador-->
            <form method="post" action="<?php echo site_url('LoginControl/login')?>">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <!-- Para mantener el usuario traigo en flash data el nombre del usuario-->
                    <input type="text" class="form-control" id="usuario"  value="<?php echo set_value('usuario', $this->session->flashdata('usuario')) ?>" placeholder="Usuario"  name="usuario">
                    <?php if(!empty($errors)){
                         if(isset($errors['usuario'])){?>
                            <span class="text-danger">
                                <?php echo $errors['usuario'];?>
                            </span>
                        <?php }
                        if(isset($errors['Usuarios'])){ ?>
                            <span class="text-danger">
                                <?php echo $errors['Usuarios'];?>
                            </span>
                        <?php }
                    }?>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" placeholder="Contraseña"name="contrasena">
                    <?php if(!empty($errors)){
                         if(isset($errors['contrasena'])){?>
                            <span class="text-danger">
                                <?php echo $errors['contrasena'];?>
                            </span>
                        <?php }
                        if(isset($errors['Contrasenas'])){ ?>
                            <span class="text-danger">
                                <?php echo $errors['Contrasenas'];?>
                            </span>
                        <?php }
                    }?>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>