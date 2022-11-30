<style>
<?php include './css/style.css'; ?>
</style>

<?php
session_start();
require_once("cart_dbConn.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM PRODUCT WHERE ProductID='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["ProductID"]=>array('name'=>$productByCode[0]["Name"], 'code'=>$productByCode[0]["ProductID"], 'quantity'=>$_POST["quantity"], 'Price'=>$productByCode[0]["Price"], 'image'=>$productByCode[0]["Image"]));
		
	

			if(!empty($_SESSION["cart_item"])) 
			{
				if(in_array($productByCode[0]["ProductID"],array_keys($_SESSION["cart_item"]))) 
				{
					
					foreach($_SESSION["cart_item"] as $k => $v) 
					{
							if($productByCode[0]["ProductID"] == $k) 
							{
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["ProductID"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>AGRICAL SHOPPING CART</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading">ADD PRODUCTS TO CART</div>

<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
<a id="btnEmpty" href="../WebClient/index.html#checkout">Checkout</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellspacing="1" cellpadding="10">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Product ID</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["Price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["Price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["ProductID"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$final_quantity += $item["quantity"];
				$final_price += ($item["Price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Final:</td>
<td align="right"><?php echo $final_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($final_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Empty Cart :(, Add Products to make me happy :)!</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM PRODUCT ORDER BY PRODUCTID ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["ProductID"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["Image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["Name"]; ?></div>
			<div class="product-description"><?php echo $product_array[$key]["Description"]; ?></div>
            <div class="product-measurement"><?php echo $product_array[$key]["Measurement"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["Price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
</BODY>
</HTML>