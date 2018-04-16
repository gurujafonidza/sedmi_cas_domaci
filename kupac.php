<?php 

	$sql = mysqli_connect("localhost", "root","","sedmi_cas");
	if(isset($_POST['kupac']))
	{
		$kupac = $_POST['kupac'];
		//echo $kupac;
	}
	else
		echo "Niste odabrali kupca!!!";

	#OVO JE PRIMER SA INNER JOIN

	/*
	$query = "SELECT p.naziv
            FROM proizvodi p
            INNER JOIN kupovina k
            ON p.ID = k.IDproizvoda  
            INNER JOIN  users u
            ON u.ID = k.IDkorisnika  
            WHERE u.username='{$kupac}'"; 

    $rezultat = $sql->query($query);
    //var_dump($rezultat);
    echo "Lista proizvoda koje je kupio/la $kupac:"."<br>";
    if($rezultat->num_rows>=1){

		while($row = $rezultat->fetch_assoc())
		{
			echo $row['naziv']."<br>";
		}

	}
	else
		echo "Prazna";	
   
	*/
	#OVO JE PRIMER BEZ INNER JOIN
	

	$rezultat = $sql->query("SELECT ID FROM users WHERE username='{$kupac}'");

	if($rezultat->num_rows>=1)
	{
		echo "Lista proizvoda koje je kupio/la $kupac:"."<br>";
		while($row = $rezultat->fetch_assoc())
		{
			$rezultat1 = $sql->query("SELECT IDproizvoda FROM kupovina WHERE IDkorisnika='{$row["ID"]}'");
			if($rezultat1->num_rows>=1){
				while($row1 = $rezultat1->fetch_assoc())
				{
					$rezultat2 = $sql->query("SELECT naziv FROM proizvodi WHERE ID='{$row1["IDproizvoda"]}'");
					if($rezultat2->num_rows>=1){
						
						while($row2 = $rezultat2->fetch_assoc())
						{
							echo $row2['naziv']."<br>";
						}

					}
				}
			}
			else
				echo "Prazna";		
		}	

	}

	

	$sql->close();
 ?>