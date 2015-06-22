<?php
   require_once 'DBWork.php';
   $msg;
   global $list;
   $conn;
   $conn = new Database();
   $msg = $conn->Check();
   if($msg)
    {
    	echo 'Connection established';
		
    }
   else
   	{
   	   echo	'Connection not established';
   	}
	$msg=false;
	if(isset($_POST['Add']))
	{
		if(($_POST['Name']!=null)&&($_POST['Number']!=null))	
		{
			$msg = $conn->Add($_POST['Name'], $_POST['Number']);
		}	
		else 
		{
		    echo"ENTRIES CANNOT BE NULL";	
		}
		if($msg)
		{
			echo 'ENTRIES CREATED SUCCESSFULLY';
		}
		else 
		{
		    echo'ENTRIES NOT CREATED';	
		}
		$list = $conn->Show();
	}
	if(isset($_POST['Update']))
	{
		$list = $conn->Show();
	}
	if(isset($_GET['uid']))
	{
		$uid = $_GET['uid'];
		echo $uid;
		$msg = $conn->Delete($uid);
	    if($msg)
		{
			echo'SUCCESSFULY DELETED RECORD';
		}
		else 
		{
		    echo'RECORD NOT DELETED';
		}
		$list = $conn->Show();
	}
	if(isset($_POST['search']))
	{
		$name = $_POST['name_search'];
		$list = $conn->Search($name);
	}
		
	   
?>


<!DOCTYPE HHTML>
<html>
	<head>
		<title> Basic phonebook with bootstrap :playing with PHP MYSQL </title>
		<?php include 'depend.php';
		?>

	</head>
	<body>
		<div id="container-fluid">
			<div id="row">
				<form class="form-inline" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<div class="form-group">
						<input type="Name" class="form-control" placeholder="Name" name="Name">
						<input type="Text" class="form-control" placeholder="Phone number" name="Number">
						<button type"submit" class="btn btn-success" name="Add">Add</button>
						<button type"submit" class="btn btn-warning" name="Update">Update List</button>
					</div>
				</form>
				<form class="form-inline" method="post" action="">
					<div class="form-group">
						<input type="search" class="form-control" placeholder="Search" name="name_search">
						<button type"submit" class="btn btn-info" name="search">Search</button>
					</div>
				</form>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Name</th>
							<th>Mob No</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
						<?php 
					     for($i=0;$i<count($list);$i++)
						  {?>
						   <tr>
						   	 <td><?php echo ($i+1);?> </td>
						   	 <td><?php echo $list[$i]['name'];?> </td>
						   	 <td><?php echo $list[$i]['number'];?></td>
						   	 <td><a href="<?php echo $_SERVER['PHP_SELF'];echo'?uid=';echo $list[$i]['uid'];?>" name="del" type="submit">Delete</a></td>
						   </tr>   	
						   <?php
					   }?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>