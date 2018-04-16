<?php 

$sql = mysqli_connect("localhost", "root","","sedmi_cas");

	# trim sluzi za brisanje whitespace-a (praznog prostora, space dugme)
	$email  =   trim($_POST['email']);
	$sifra  =   trim($_POST['sifra']);

	if(isset($_POST['proizvod']))
		$proizvod = $_POST['proizvod'];
	else
		echo "Niste odabrali proizvod!!!";

	//echo $proizvod;
	


	# strlen se koristi kako bi dobili duzinu nekog stringa

	
	if($email == "") 
	{
		echo "Invalid email";
		return false;
	}

	if($sifra == "") 
	{
		echo "Invalid password";
		return false;
	}

	
	$email 	= $sql->real_escape_string($email);
	$sifra = hash('sha256', $sifra);


	//echo "Ime je:".$ime."<br>";
	//echo "Mail je:".$email."<br>";

	# SELECT * FROM users WHERE username='$ime' OR email='$email'

	$rezultat = $sql->query("SELECT ID FROM users WHERE email='{$email}' AND password='{$sifra}' ");

	$rezultat1 = $sql->query("SELECT ID FROM proizvodi WHERE naziv='{$proizvod}'");

	if(($rezultat->num_rows>=1)&&($rezultat1->num_rows>=1))
	{
		while(($row = $rezultat->fetch_assoc())&&($row1 = $rezultat1->fetch_assoc()))

		//	echo $row["ID"]." ".$row1["ID"]; 

		$sql->query("INSERT INTO kupovina(IDkorisnika, IDproizvoda) VALUES ('{$row["ID"]}','{$row1["ID"]}')");
		echo "Kupovina uspesna";
	}
	else
	{
		if($rezultat->num_rows==0)
			echo "Nepostojeci korisnik!!!";

		if($rezultat1->num_rows==0)	
			echo "Nepostojeci proizvod!!!";
	}

	$sql->close();
	

 ?>