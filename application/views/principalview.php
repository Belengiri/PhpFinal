<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="justify-content-center align-items-center p-4" >
      <div class="d-flex align-items-center gap-4 bg-secondary">
        <h1 class=" fw-bold">Principal!!!</h1>
          <!-- para el boton SALIR uso una etiqueta A con site_url-->
        <a href="<?php echo site_url('PrincipalControl/salir'); ?>" class="btn btn-danger">Salir</a>
      </div>
      <!--Bajo los errores a una variable -->
      <?php $errors = $this->session->flashdata('errores');?>
      <form action="<?php echo site_url('PrincipalControl/agregar'); ?>" method="post" class="d-flex gap-4 p-4 bg-secondary">
        <div class="mb-3">
          <label for="apellido" class=" fw-bold">Apellido</label>
          <input  class="form-control fw-semibold" type="text" id="apellido" value="<?php echo set_value('apellido', $this->session->flashdata('apellido')) ?>"  name="apellido">
          <!--uso los errores para mostrarlos -->
          <?php if(!empty($errors)){
              if(isset($errors['apellido'])){?>
                <span class="text-warning">
                  <?php echo $errors['apellido'];?>
                </span>
              <?php }
          }?>
        </div>
        <div class="mb-3">
          <label for="nota1" class=" fw-bold">Nota 1</label>
          <!--En el atributo VALUE es muy importante distingir los campos para completarlos si el formulario f
          ue enviado con errores y siga manteniendo los valores ingresados y el ECHO es muy importante para mostrar datos 
          -->
          <input  class="form-control fw-semibold" type="number" id="nota1" value="<?php echo set_value('nota1', $this->session->flashdata('nota1')) ?>" name="nota1">
          <?php if(!empty($errors)){
              if(isset($errors['nota1'])){?>
                <span class="text-warning">
                  <?php echo $errors['nota1'];?>
                </span>
              <?php }
          }?>
        </div>
        <div class="mb-3">
          <label for="nota2" class=" fw-bold">Nota 2</label>
          <input  class="form-control fw-semibold" type="number" id="nota2" value="<?php echo set_value('nota2', $this->session->flashdata('nota2')) ?>" name="nota2">
          <?php if(!empty($errors)){
              if(isset($errors['nota2'])){?>
                <span class="text-warning">
                  <!-- ECHO y el array de errores y en especifico que error muestra -->
                  <?php echo $errors['nota2'];?>
                </span>
              <?php }
          }?>
        </div>
        <div class="mb-3">
          <label for="nota3" class=" fw-bold">Nota 3</label>
          <input  class="form-control fw-semibold" type="number" id="nota3" value="<?php echo set_value('nota3', $this->session->flashdata('nota3')) ?>"  name="nota3">
          <?php if(!empty($errors)){
              if(isset($errors['nota3'])){?>
                <span class="text-warning">
                  <?php echo $errors['nota3'];?>
                </span>
              <?php }
          }?>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit"><i class="fas fa-plus"> </i> </button>
        </div>
        <?php
        //muestra un mensaje cuando el registro fue cargado con exito
            $mensaje = $this->session->flashdata('mensaje');
            if(!empty($mensaje)){
              if(isset($mensaje['agregado'])){?>
                  <span class="alert alert-warning">
                      <?php echo $mensaje['agregado'];?>
                  </span>
            <?php  }
            }
          ?>
      </form>

      <div class="p-4 justify-content-center align-items-center">
        <h1>Lista!!</h1>
        <table class="table table-success table-bordered border-dark border border-5 text-center">
          <thead>
            <tr class="border-3">
              <th class="border-3" scope="col">Apellido</th>
              <th class="border-3" scope="col">Nota 1</th>
              <th class="border-3" scope="col">Nota 2</th>
              <th class="border-3" scope="col">Nota 3</th>
              <th class="border-3" scope="col">Promedio</th>
              <th class="border-3"> </th>
            </tr>
          </thead>
          <!--Primero !EMPTY y luego FOREACH para recorrer el array de usuarios que viene del controlador con la vista -->
          <?php if(!empty($usuarios)) {?>
            <?php foreach ($usuarios as $usuario){ ?>
            <tbody>
              <tr class="table-light border-dark border-3">
                <!-- scope="row" NEGRITA -->
                <!-- fs-3 hace que el tamaño sea mas grande , cuanto menor el num mas grande la letra -->
                <!-- fw-semibold hace que la letra este en NEGRITA al igual que scope pero un poco menos oscura -->
                      <!--ECHO -->
                <th class="border-3 fs-3" scope="row"> <?php echo $usuario["Apellido"]?></th>
                <td class="border-3 fw-semibold fs-3" ><?php echo $usuario["Nota1"]?></td>
                <td class="border-3 fw-semibold fs-3"><?php echo $usuario["Nota2"]?></td>
                <td class="border-3 fw-semibold fs-3"><?php echo $usuario["Nota3"] ?></td>
                <!--floor hace el rendondeo del decimal -->
                <td class="border-3 fw-semibold fs-3"><?php echo floor((($usuario["Nota1"] + $usuario["Nota2"] + $usuario["Nota3"])/ 3)*10)/10;?></td>
                <td class="border-3 fw-semibold fs-3">
                  <a href="<?php echo site_url('PrincipalControl/eliminar/'.$usuario["id_usuario"]); ?>" class="btn btn-danger"><i class=" fas fa-times"></i> </a>
                </td>
              </tr>
            </tbody>
              <?php }?>
          <?php }else { ?>
              <tr>
                <td colspan="4" class="text-center">No hay datos disponibles</td>
              </tr>
          <?php }?>
        </table>
      </div>
      <?php
      //muestra el mensaje cuando el registro fue eliminado con exito
        $mensaje = $this->session->flashdata('mensaje');
        if(!empty($mensaje)){
          if(isset($mensaje['eliminado'])){?>
              <span class="alert alert-warning">
                  <?php echo $mensaje['eliminado'];?>
              </span>
        <?php  }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>