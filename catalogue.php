<?php require('inc_connexion.php')?>
 <?php 
	
if (isset($_GET['hidden_id'])) // si le formualire a été envoyé
{
	if(isset($_COOKIE['user_cart'])) // si le cookie existe
	{
	//valeur du cookie
	$cart_data = $_COOKIE['user_cart'];
	$cart_data = unserialize($cart_data);
	}
	else
	{
		$cart_data = array ();
	}
	$product_id_list = array_column($cart_data,'product_id');
	if (in_array($_GET['hidden_id'],$product_id_list))
	{
		foreach ($cart_data as $keys => $values)
		{
			if ($cart_data[$keys]['product_id'] == $_GET['hidden_id'])
			{
				$cart_data[$keys]['product_quantity'] = $cart_data[$keys]['product_quantity'] + $_GET['hidden_quantity']; 
			}
		}
	}
	else
	{
		$user_cart = array (
			'product_id' => $_GET['hidden_id'],
			'product_quantity' => $_GET['hidden_quantity'],
			'product_name' => $_GET['hidden_name'],
			'product_price' => $_GET['hidden_price']	
		);
		$cart[] = $user_cart;

	}
	$product_data = serialize($cart_data);
	setcookie('user_cart', $product_data, time()+604800);
}

	$result = $mysqli->query('SELECT id, name, price FROM products');
	while ($row = $result->fetch_array())
		{
			//création d'un nouvel array affichable hors de la boucle
			$products[$row['id']]['name']= $row['name'];
			$products[$row['id']]['price']= $row['price'];
		}
		/*affichage des résultats*/
		?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
<title></title>
</head>

<body>

	<ul>
		<?php foreach ($products as $id=>$product) :?>
		<form action="get"> 
			<p>
			<?php echo $product['name'] ?><input type="hidden" name="hidden_id" value="<?php echo $id?>" required>
			<input type ="hidden" name="hidden_name" value ="<?php echo $product['name']?>">
			<input type ="hidden" name="hidden_price" value ="<?php echo $product['price']?>"> <?php echo $product['price']?> euros 
			<label for="quantity">Quantité</label>
			<input type="number" name="hidden_quantity" required min="1" max="100">
			<input type="submit" name="validate" value="Ajouter au panier" formaction="catalogue.php?id=<?php echo $id?>">
			</p>
		</form>
		<?php endforeach ?>
	</ul>
	<a href="panier.php">Voir mon panier</a>
<?php require('inc_footer.php')?>
	


