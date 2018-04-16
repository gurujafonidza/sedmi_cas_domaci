<?php
	
	$sql = mysqli_connect("localhost", "root","","sedmi_cas");

	# trim sluzi za brisanje whitespace-a (praznog prostora, space dugme)
	$ime 	=	trim($_POST['ime']);
	$sifra  =   trim($_POST['sifra']);
	$email  =   trim($_POST['email']);

	if($ime == "") 
	{
		echo "Invalid username";
		return false;
	}


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

	$ime 	= $sql->real_escape_string($ime);
	$email 	= $sql->real_escape_string($email);


	//echo "Ime je:".$ime."<br>";
	//echo "Mail je:".$email."<br>";

	# SELECT * FROM users WHERE username='$ime' OR email='$email'

	

	$rezultat = $sql->query("SELECT * FROM users WHERE username='{$ime}' OR email='{$email}' ");

	if($rezultat->num_rows >= 1) {
		echo "Korisnik vec postoji";
		return false;
	}

	$sifra = hash('sha256', $sifra);
	
	$sql->query("INSERT INTO users (username, password, email) VALUES ('{$ime}', '{$sifra}', '{$email}') ");

	echo "Dobrodosao/la";
	

	$sql->close();

?>
