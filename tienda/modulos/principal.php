<?php
if(isset($agregar) && isset($cant)){


	if(!isset($_SESSION['id_cliente'])){
		redir("?p=login");
	}


	$idp = clear($agregar);
	$cant = clear($cant);
	$id_cliente = clear($_SESSION['id_cliente']);

	$v = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");

	if(mysqli_num_rows($v)>0){

		$q = $mysqli->query("UPDATE carro SET cant = cant + $cant WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	
	}else{

		$q = $mysqli->query("INSERT INTO carro (id_cliente,id_producto,cant) VALUES ($id_cliente,$idp,$cant)");

	}

	alert("Se ha agregado al carrito de compras.",1,'principal');
	//redir("?p=principal");
}
?>
<h1>Últimos 3 Productos Agregados</h1><br><br>
<?php
$q = $mysqli->query("SELECT * FROM productos WHERE oferta = 0 ORDER BY id DESC LIMIT 3");

while($r=mysqli_fetch_array($q)){
	$preciototal = 0;
			if($r['oferta']>0){
				if(strlen($r['oferta'])==1){
					$desc = "0.0".$r['oferta'];
				}else{
					$desc = "0.".$r['oferta'];
				}

				$preciototal = $r['price'] -($r['price'] * $desc);
			}else{
				$preciototal = $r['price'];
			}
	?>
		<div class="producto">
			<div class="name_producto"><?=$r['name']?></div>
			<div><img class="img_producto" src="productos/<?=$r['imagen']?>"/></div>
			<?php
				if($r['oferta']>0){
					?>
					<br><del>$<?=number_format($r['price'])?> <?=$divisa?></del><span class="precio"> <?=$preciototal?> <?=$divisa?></span>
					<?php
				}else{
					?>
					<span class="precio"><br>$<?=number_format($r['price'])?> <?=$divisa?></span>
					<?php
				}
			?>
			<button style="color:white; background: #ff8800;" class="btn btn-warning float-right" onclick="agregar_carro('<?=$r['id']?>');"><i class="fa fa-shopping-cart"></i></button>
		</div>
	<?php
}
?>
<h1>Últimas 3 Ofertas Agregadas</h1><br><br>

<?php
	$q = $mysqli->query("SELECT * FROM productos WHERE oferta>0 ORDER BY id DESC LIMIT 3");

	while($r=mysqli_fetch_array($q)){
	$preciototal = 0;

			if($r['oferta']>0){
				if(strlen($r['oferta'])==1){
					$desc = "0.0".$r['oferta'];
				}else{
					$desc = "0.".$r['oferta'];
				}

				$preciototal = $r['price'] -($r['price'] * $desc);
			}else{
				$preciototal = $r['price'];
			}

	?>
		<div class="producto">
			<div class="name_producto"><?=$r['name']?></div>
			<div><img class="img_producto" src="productos/<?=$r['imagen']?>"/></div>
			<br><del>$<?=number_format($r['price'])?> <?=$divisa?></del><span class="precio"> <?=$preciototal?> <?=$divisa?></span>
			<button style="color:white; background: #ff8800;" class="btn btn-warning float-right" onclick="agregar_carro('<?=$r['id']?>');"><i class="fa fa-shopping-cart"></i></button>
		</div>
	<?php
}
?>




<script type="text/javascript">
	
	function agregar_carro(idp){

		cant = $("#cant"+idp).val();
		var cant = prompt("¿Qué cantidad desea agregar?",1);

		if(cant.length>0){
			window.location="?p=principal&agregar="+idp+"&cant="+cant;
		}
	}

</script>