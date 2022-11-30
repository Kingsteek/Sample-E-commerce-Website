<style>
<?php include './css/style.css'; ?>
</style>
 <?php
	require_once("cart_dbConn.php");
	$db_handle = new DBController();
	$product_array = $db_handle->runQuery("SELECT * FROM PRODUCT ORDER BY ProductID ASC");
	
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
			<div class="product-item">
			<form method="POST" action="http://eris.ad.murdoch.edu.au/~33970651/Assignment2/Server/index.php?action=add&code=<?php echo $product_array[$key]["ProductID"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["Image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["Name"]; ?></div>
			<div class="product-description"><?php echo $product_array[$key]["Description"]; ?></div>
            <div class="product-measurement"><?php echo $product_array[$key]["Measurement"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["Price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="Quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}

	}
	?>
 