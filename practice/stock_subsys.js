function delete_id(id)
{

	if(confirm("Are you sure you want to delete?")){
		window.location.href='index.php?delete_id='+id;
	}
}

function updateId(name,qty,oprice,id,sprice)
{

	document.getElementById("productEditName").value = name;
	document.getElementById("productEditQty").value = qty;
	document.getElementById("productEditOriPrice").value = oprice;
	document.getElementById("productEditSellPrice").value = sprice;
	document.getElementById("productID").value = id;

}
