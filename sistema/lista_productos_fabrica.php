<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Lista de Producción</h1>
		<a href="registro_producto_fabrica.php" class="btn btn-primary">Nuevo</a>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>USUARIO</th>
							<th>PRODUCTO</th>
							<th>PRECIO</th>
							<th>STOCK</th>
							<th>CALIDAD</th>
							<th>PESO</th>
							<th>VOLUMEN</th>
							<th>TAMAÑO</th>
							<th>EMPAQUE</th>
							<th>FECHA</th>
							<?php if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 1|| $_SESSION['rol'] == 2) { ?>
							<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";
						$id_user_activo = "";
						$id_user_activo = $_SESSION['idUser'];
						if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
						$query = mysqli_query($conexion, "SELECT * FROM fabrica");
						}else{
						$query = mysqli_query($conexion, "SELECT * FROM fabrica WHERE  usuario_id = '$id_user_activo' ");
						}
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { 
									$idnombre = $data['usuario_id'];
									$nombreusuario = mysqli_fetch_assoc( mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = '$idnombre'"));
								?>
								<tr>
									<td><?php echo $nombreusuario['nombre']; ?></td>
									<td><?php echo $data['descripcion']; ?></td>
									<td><div style="width: 7em;"><?php echo "$ ".number_format($data['precio'], 2, ',', '.'); ?></div></td>
									<td><?php echo $data['existencia']; ?></td>
									<td><?php echo $data['calidad']; ?></td>
									<td><?php echo $data['peso']; ?></td>
									<td><?php echo $data['volumen']; ?></td>
									<td><?php echo $data['tamaño']; ?></td>
									<td><?php echo $data['empaque']; ?></td>
									<td><?php echo $data['fecha']; ?></td>
										<?php if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
									<td>
										<!--<a href="agregar_producto_fabrica.php?id=<?php echo $data['codfabrica']; ?>" class="btn btn-primary"><i class='fas fa-audio-description'></i></a>-->

										<a href="editar_producto_fabrica.php?id=<?php echo $data['codfabrica']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>

										<form action="eliminar_producto_fabrica.php?id=<?php echo $data['codfabrica']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td>
										<?php } ?>
								</tr>
						<?php }
						} ?>
					</tbody>

				</table>
			</div>

		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include_once "includes/footer.php"; ?>