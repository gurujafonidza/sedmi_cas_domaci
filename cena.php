<?php 

		$sql = mysqli_connect("localhost", "root","","sedmi_cas");
		$cena 	=	trim($_POST['cena']);
		
		/*
		if(!is_numeric($cena))
		{
			
			echo "Uneli ste pogresno cenu";
			return false;
		}
		else
		{
			$rezultat = $sql->query("SELECT naziv,cena FROM proizvodi WHERE cena>='{$cena}'");
			//var_dump($rezultat);

		}

		*/
		

 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		table{
			border-collapse: collapse;
		}
		td, th {
    		border: 1px solid black;
		}
</style>
</head>
<body>

	<?php 
		if(!is_numeric($cena))
		{
			
			echo "Uneli ste pogresno cenu";
			return false;
		}
		else
		{
			$rezultat = $sql->query("SELECT naziv,cena FROM proizvodi WHERE cena>='{$cena}' ORDER BY cena ASC");
			if($rezultat->num_rows>=1)
			{ 	

	?>			
				<table>
						<tr>
							<th>Naziv Proizvoda</th>
							<th>Cena Proizvoda</th>
						</tr>	
	<?php	
				while($row = $rezultat->fetch_assoc())
				{
	?>
					<tr>
						<td><?php echo $row['naziv'] ?></td>
						<td><?php echo $row['cena'] ?></td>
					</tr>


	<?php 
				}
			}
		}
	?>


	</table>
	
</body>
</html>

<?php 

	$sql->close();
 ?>
