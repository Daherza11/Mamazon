<?php
check_admin();

if(isset($enviar)){
	$categoria = clear($categoria);

	$s = $mysqli->query("SELECT * FROM categorias WHERE categoria = '$categoria'");

	if(mysqli_num_rows($s)>0){
		alert("Esta categoría ya está agregada en la base de datos.");
		redir("");
	}else{
		$mysqli->query("INSERT INTO categorias (categoria) VALUES ('$categoria')");
		alert("Categoría agregada.",1,'agregar_categoria');
		//redir("");
	}
}

if(isset($eliminar)){
	$eliminar = clear($eliminar);
	$mysqli->query("DELETE FROM categorias WHERE id = '$eliminar'");
	alert("Categoría eliminada.",1,'agregar_categoria');
	//redir("?p=agregar_categoria");
}

?>

<center><h1>Agregar Categoría</h1></center><br><br>

<form method="post" action="">
	<div class="form-group">
		<input type="text" class="form-control" name="categoria" placeholder="Categoría"/>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="enviar" value="Agregar categoría"/>
	</div>
</form><br>

<br>

<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Categoría</th>
		<th>Acciones</th>
	</tr>

	<?php
	$q = $mysqli->query("SELECT * FROM categorias ORDER BY id ASC");
	while($r=mysqli_fetch_array($q)){
		?>
			<tr>
				<td><?=$r['id']?></td>
				<td><?=$r['categoria']?></td>
				<td><a style="color:#08f;" href="?p=agregar_categoria&eliminar=<?=$r['id']?>"><i class="fa fa-times"></i></td>
			</tr>
		<?php
	}
	?>
</table>