<?php 
	$cart_data = $_COOKIE['user_cart'];
	$cart_data = unserialize($cart_data);
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
<title></title>
</head>

<body>
<ul>
		<?php foreach ($cart_data as $keys=>$values) :?>
		<li><?php echo $values['product_name'].' - '.$values["product_price"].' euros quantité: '. $values['product_quantity'].' total :'.$values['product_quantity']*$values["product_price"]?></li>
		<?php endforeach ?>
</ul>
	<a href="catalogue.php">Retour aux achats</a>
	</body>
</html>
