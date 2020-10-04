<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Bootstrap Example</title>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link href="bootstrap.min.css" rel="stylesheet" />
<link href="w3.css" rel="stylesheet" />
<link href="font-awesome.min.css" rel="stylesheet" />
<link href="bootstrap.min.css" rel="stylesheet" />
<script src="jquery.min.js" type="text/javascript"></script>
<script src="popper.min.js" type="text/javascript"></script>
<script src="bootstrap.min.js" type="text/javascript"></script>
<script src="a076d05399.js"></script>
<script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>
<script src="stock_subsys.js" type="text/javascript"></script>
<link href="stock_subsys.css" rel="stylesheet" />
</head>

<body>

<?php
include 'herbalife.php';
//include 'post.php';

$conn = OpenCon();

?>

<div class="header">
	<h2 class="logo" style="color: white; float: left; margin-left: 30px; font-family:'Yu Gothic'">Millos Trading	<i class="fas fa-leaf" style="color: green"></i></h2>
	<div class="header-right">
		<a href="#home">Manage Orders</a> <a class="active" href="#contact">Manage 
		Stocks</a> <a href="#about">Log Out</a> </div>
</div>
<div style="text-align: center; margin: 30px 0px 15px 0px">
	<h1>Inventory Details</h1>
</div>
<div class="divDesign">
	<h4>TOTAL INVENTORY VALUE (RM)</h4>
	<p style="color: green"> <?php echo CalculateTotal($conn); ?> </p>
</div>
<div class="divDesign">
	<h4>TOTAL PRODUCTS</h4>
	<p><?php echo $total_product ?></p>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
		
			<div class="modal-header">
				<h2 id="form_title" class="modal-title">Add New Product</h2>
				<button class="close" data-dismiss="modal" type="button">&times;
				</button></div>
				<form id="myForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<div class="modal-body">
			
				<div class="container">
					
						<div class="form-group">
							<label for="productName">Product Name:</label>
							<input id="productName" class="form-control input-product" placeholder="Banana Milkshake" type="text" name="productName" required/>
						</div>
						<div class="form-group">
							<label for="productQty">Quantity:</label>
							<input id="productQty" type="number" min="1" max="100" class="form-control input-product" placeholder="5" name="productQty" required/>
						</div>
						<div class="form-group">
							<label for="productOriPrice">Original Price (RM):</label>
							<input id="productOriPrice" type="number" min="1" max="100" step="0.01"  class="form-control input-product" placeholder="5" name="productOriPrice" required/>
						</div>
						<div class="form-group">
							<label for="productSellPrice">Selling Price (RM):</label>
							<input id="productSellPrice" type="number" min="1" max="100" step="0.01"  class="form-control input-product" placeholder="10" name="productSellPrice" required/>
						</div>
	
				</div>
			</div>
			
			<div class="modal-footer">
			
				<input class="btn btn-default" value="Add" type="submit" name="someAction"/>
				<button class="btn btn-default" data-dismiss="modal" type="button">
				Cancel</button></div>
					</form>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	function messEdit(){
	 
	 alert("Your record is successfully edited");
	 return true; 
	 
	}

</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['someAction'])) {
    // collect value of input field
    $productName= $_POST['productName'];
    $productQty= $_POST['productQty'];
    $productOriPrice= $_POST['productOriPrice'];
    $productSellPrice= $_POST['productSellPrice'];
    $productID = $total_product +1;

    if (empty($productName)) {
        echo "Name is empty";
    } else {
    	
        $sql = "INSERT INTO PRODUCT (product_id,product_desc, unit_price,sell_price, quantity) VALUES ('$productID','$productName', '$productOriPrice','$productSellPrice', '$productQty')";
		
		if ($conn->query($sql) === TRUE) {
			//echo "<script type='text/javascript'>alert('Successfully deleted'); window.location.href='index.php';</script>"; 

		  header("Location:index.php");
        exit;
        
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		 unset($_POST);
        
    }
}

if(isset($_GET['delete_id'])) //returns true or false (it checks if a value is present)
{
     $sql="DELETE FROM product WHERE product_id=".$_GET['delete_id'];
     if ($conn->query($sql) === TRUE) {
		  #echo "New record created successfully";
		   echo "<script type='text/javascript'>alert('Successfully deleted'); window.location.href='index.php';</script>"; 
		  header("Location:index.php");
        exit;
       
        }
     
}

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['editAction'])) {
echo "New record edited successfully";

    // collect value of input field
    $productNoEditID= $_POST['productID'];
    $productEditedName= $_POST['productEditName'];
    $productEditedQty= $_POST['productEditQty'];
    $productEditedOriPrice= $_POST['productEditOriPrice'];
    $productEditedSellPrice= $_POST['productEditSellPrice'];
    $productID = $total_product +1;

    if (empty($productEditedName)) {
        echo "Name is empty";
    } else {
    	
       $sql="UPDATE product SET product_desc='$productEditedName' , unit_price=".$productEditedOriPrice.", sell_price=".$productEditedSellPrice.", quantity=".$productEditedQty." WHERE product_id=".$productNoEditID;
		
		if ($conn->query($sql) === TRUE) {
		  #echo "New record created successfully";
		  header("Location:index.php");
        exit;
        
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		 unset($_POST);
        
    }
}

?>

<div class="ex3">
	<table id="myTable">
		<tr>
			<th>ID</th>
			<th>Product Name</th>
			<th>Quantity</th>
			<th>Original Price (RM)</th>
			<th>Selling Price (RM)</th>
			<th>Profit (RM)</th>
			<th></th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
		
<?php

$no = 1;

$sql = "SELECT * FROM PRODUCT";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    #echo "id: " . $row["cust_id"]. " - Name: " . $row["cust_name"]. " " . $row["cust_phone"]. "<br>";
    $productName = $row["product_desc"];
    $profit = $row["sell_price"] - $row["unit_price"];
?>

		<tr>
			<td><?php echo $no ++ ?></td>
			<td><?php echo $productName ?></td>
			<td><?php echo $row["quantity"] ?></td>
			<td><?php echo $row["unit_price"] ?></td>
			<td><?php echo $row["sell_price"] ?></td>
			<td><?php echo $profit ?></td>
			<td></td>
			<td><a name="delete" href="javascript:delete_id(<?php echo $row["product_id"]; ?>)" ><i class="fa fa-trash" style="color: red"></i></a></td>
			<td><a name="update" data-target="#myEditModal" data-toggle="modal" onclick="updateId('<?=$productName;?>', <?php echo $row["quantity"] ?> ,<?php echo $row["unit_price"] ?>,<?php echo $row["product_id"] ?>,<?php echo $row["sell_price"] ?> )"><i class="fas fa-edit" style="color: dodgerblue"></i></a></td>
		</tr>

<?php    
  }
} else {
  echo "0 results";
}

CloseCon($conn);

?>

	</table>
</div>

<button id="addProductBtn" class="button" data-target="#myModal" data-toggle="modal">
<span>Add Product</span></button>

<!-- Modal -->
<div id="myEditModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h2 id="form_title" class="modal-title">Edit Product</h2>
				<button class="close" data-dismiss="modal" type="button">&times;
				</button></div>
				<form id="myEditForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<div class="modal-body">
				<div class="container">
					
						<div class="form-group">
						
							<label for="productID">Product ID:</label>
							<input id="productID" class="form-control input-product" type="text" name="productID" readonly="readonly"/>
						</div>

						<div class="form-group">
							<label for="productEditName">Product Name:</label>
							<input id="productEditName" class="form-control input-product" type="text" name="productEditName" required/>
						</div>
						<div class="form-group">
							<label for="productEditQty">Quantity:</label>
							<input id="productEditQty" type="number" min="1" max="100" class="form-control input-product" name="productEditQty" required/>
						</div>
						<div class="form-group">
							<label for="productEditOriPrice">Original Price (RM):</label>
							<input id="productEditOriPrice" type="number" min="1" max="100" step="0.01" class="form-control input-product" name="productEditOriPrice" required/>
						</div>
						<div class="form-group">
							<label for="productEditSellPrice">Selling Price (RM):</label>
							<input id="productEditSellPrice" type="number" min="1" max="100" step="0.01" class="form-control input-product" name="productEditSellPrice" required/>
						</div>
						
				</div>
			</div>
			<div class="modal-footer">
			
				<input class="btn btn-default" value="Edit" id="editSubmit" type="submit" onclick="return messEdit()" name="editAction"/>
				<button class="btn btn-default" data-dismiss="modal" type="button">
				Cancel</button></div>
				</form>
		</div>
	</div>
</div>

</body>

</html>
