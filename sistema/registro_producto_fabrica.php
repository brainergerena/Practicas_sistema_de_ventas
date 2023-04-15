 <?php include_once "includes/header.php";
  include "../conexion.php";
  if (!empty($_POST)) {
    $alert = "";
    if ( empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || $_POST['precio'] <  0 || empty($_POST['cantidad'] || $_POST['cantidad'] <  0 || empty($_POST['calidad']) || empty($_POST['peso'])  || empty($_POST['volumen']) || empty($_POST['tamaño']) || empty($_POST['empaque']) || empty($_POST['fecha']))) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
      $proveedor = $_POST['proveedor'];
      $producto = $_POST['producto'];
      $precio = $_POST['precio'];
      $cantidad = $_POST['cantidad'];
      $calidad = $_POST['calidad'];
      $peso = $_POST['peso']." kg ";
      $volumen = $_POST['volumen']. " m3 ";
      $tamaño = $_POST['tamaño'];
      $empaque = $_POST['empaque'];
      $fecha = $_POST['fecha'];
      $usuario_id = $_SESSION['idUser'];

      $query_insert = mysqli_query($conexion, "INSERT INTO fabrica(proveedor,descripcion,precio,existencia,calidad,peso,volumen,tamaño,empaque,fecha, usuario_id) values ('$proveedor','$producto', '$precio', '$cantidad','$calidad','$peso','$volumen','$tamaño','$empaque','$fecha','$usuario_id')");
      if ($query_insert) {
        $alert = '<div class="alert alert-primary" role="alert">
                Producto Registrado
              </div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el producto
              </div>';
      }
    }
  }
  ?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
     <a href="lista_productos_fabrica.php" class="btn btn-primary">Regresar</a>
   </div>

   <!-- Content Row -->
   <div class="row">
     <div class="col-lg-6 m-auto">
       <form action="" method="post" autocomplete="off">
         <?php echo isset($alert) ? $alert : ''; ?>
         <div class="form-group">
           <label>Usuario</label>
           <?php
            $query_proveedor = mysqli_query($conexion, "SELECT codproveedor, proveedor FROM proveedor ORDER BY proveedor ASC");
            $resultado_proveedor = mysqli_num_rows($query_proveedor);
            mysqli_close($conexion);
            ?>
           <select id="proveedor" name="proveedor" class="form-control">
             <?php
              if ($resultado_proveedor > 0) {
                while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                  // code...
              ?>
                 <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
             <?php
                }
              }
              ?>
           </select>
         </div>
         <div class="form-group">
           <label for="producto">Producto</label>
           <input type="text" placeholder="Ingrese nombre del producto" name="producto" id="producto" class="form-control">
         </div>
         <div class="form-group">
           <label for="precio">Precio</label>
           <input type="number" placeholder="Ingrese precio" class="form-control" name="precio" id="precio">
         </div>
         <div class="form-group">
           <label for="cantidad">Cantidad</label>
           <input type="number" placeholder="Ingrese cantidad" class="form-control" name="cantidad" id="cantidad">
         </div>
         <div class="form-group">
           <label for="calidad">Calidad</label>
           <input type="text" placeholder="Calidad" class="form-control" name="calidad" id="calidad">
         </div>
         <div class="form-group">
           <label for="peso">Peso (kg)</label>
           <input type="text" placeholder="Ingrese Peso" class="form-control" name="peso" id="peso">
         </div>
         <div class="form-group">
           <label for="volumen">Volumen (m3)</label>
           <input type="text" placeholder="Ingrese Volumen" class="form-control" name="volumen" id="volumen">
         </div>
         <div class="form-group">
           <label for="tamaño">Tamaño(Largo, ancho y alto)</label>
           <input type="text" placeholder="Ingrese Tamaño" class="form-control" name="tamaño" id="tamaño">
         </div>
         <div class="form-group">
           <label for="empaque">Unidad de Empaque</label>
           <input type="text" placeholder="Ingrese Empaque" class="form-control" name="empaque" id="empaque">
         </div>
         <div class="form-group">
           <label for="fecha">Fecha</label>
           <input type="datetime-local" placeholder="Ingrese Fecha" class="form-control" name="fecha" id="fecha">
         </div>
         <input type="submit" value="Guardar Producto" class="btn btn-primary">
       </form>
     </div>
   </div>


 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
 <?php include_once "includes/footer.php"; ?>