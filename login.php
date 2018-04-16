<?php 
	$sql = mysqli_connect("localhost", "root","","sedmi_cas");

	# trim sluzi za brisanje whitespace-a (praznog prostora, space dugme)
	
	$sifra  =   trim($_POST['sifra']);
	$email  =   trim($_POST['email']);


	# strlen se koristi kako bi dobili duzinu nekog stringa
	if(strlen($sifra) < 6) 
	{
		echo "Invalid password";
		return false;
	}


	if($email == "") 
	{
		echo "Invalid email";
		return false;
	}

	$email 	= $sql->real_escape_string($email);
	$sifra = hash('sha256', $sifra);

	$rezultat = $sql->query("SELECT * FROM users WHERE email='{$email}' AND password='{$sifra}' ");

	//var_dump($rezultat);

	
	if($rezultat->num_rows >= 1) {
		echo "Dobrodosli/la";
	}	
	else
	{
		echo "Nepostojeci korisnik";
	}

	$sql->close();



 ?>