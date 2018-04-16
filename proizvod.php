<?php 

	$sql = mysqli_connect("localhost", "root","","sedmi_cas");
	if(isset($_POST['proizvod']))
		$proizvod = $_POST['proizvod'];
	else
		echo "Niste odabrali proizvod!!!";

	#OVO JE PRIMER SA INNER JOIN
	$query = "SELECT u.username
            FROM users u
            INNER JOIN kupovina k
            ON u.ID = k.IDkorisnika 
            INNER JOIN  proizvodi p
            ON p.ID = k.IDproizvoda 
            WHERE p.naziv='{$proizvod}'"; 

    $rezultat = $sql->query($query);
    echo "Lista kupaca koja je kupio/la $proizvod:"."<br>";
    if($rezultat->num_rows>=1){

		while($row = $rezultat->fetch_assoc())
		{
			echo $row['username']."<br>";
		}

	}
	else
		echo "Prazna";	
   

	#OVO JE PRIMER BEZ INNER JOIN
	/*

	$rezultat = $sql->query("SELECT ID FROM proizvodi WHERE naziv='{$proizvod}'");

	if($rezultat->num_rows>=1)
	{
		echo "Lista kupaca koja je kupio/la $proizvod:"."<br>";
		while($row = $rezultat->fetch_assoc())
		{
			$rezultat1 = $sql->query("SELECT IDkorisnika FROM kupovina WHERE IDproizvoda='{$row["ID"]}'");
			if($rezultat1->num_rows>=1){
				while($row1 = $rezultat1->fetch_assoc())
				{
					$rezultat2 = $sql->query("SELECT username FROM users WHERE ID='{$row1["IDkorisnika"]}'");
					if($rezultat2->num_rows>=1){
						
						while($row2 = $rezultat2->fetch_assoc())
						{
							echo $row2['username']."<br>";
						}

					}
				}
			}
			else
				echo "Prazna";		
		}	

	}

	*/

	$sql->close();
 ?>