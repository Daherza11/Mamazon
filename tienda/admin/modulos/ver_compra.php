<?php
check_admin();

$id = clear($id);

$s = $mysqli->query("SELECT * FROM compra WHERE id = '$id'");
$r= mysqli_fetch_array($s);

$sc = $mysqli->query("SELECT * FROM clientes WHERE id = '".$r['id_cliente']."'");
$rc = mysqli_fetch_array($sc);

$nombre = $rc['name'];

?>
<h1>Viendo compra de <span style="color: #08f"> <?=$nombre?> </span></h1><br>

Fecha: <?=fecha($r['fecha'])?><br>
Total: $<?=number_format($r['monto'])?> <?=$divisa?><br>
Estado: <?=estado($r['estado'])?><br><br>

<table class="table table-striped">
	<tr>
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Precio por unidad</th>
		<th>Precio total</th>
	</tr>
	<?php
		$sp = $mysqli->query("SELECT * FROM productos_compra WHERE id_compra = '$id'");
		while($rp=mysqli_fetch_array($sp)){

			$spro = $mysqli->query("SELECT * FROM productos WHERE id = '".$rp['id_producto']."'");
			$rpro = mysqli_fetch_array($spro);

			$nombre_producto = $rpro['name'];

			$montototal = $rp['monto'] * $rp['cantidad'];
			?>
			<tr>
				<td><?=$nombre_producto?></td>
				<td><?=$rp['cantidad']?></td>
				<td>$<?=number_format($rp['monto'])?> <?=$divisa?></td>
				<td>$<?=number_format($montototal)?> <?=$divisa?></td>
			</tr>
			<?php
		}
	?>
</table>