
<?php 

 	$sql = mysqli_connect("localhost","root","","sedmi_cas"); 
 	$query = "SELECT naziv FROM proizvodi";
 	$rezultat = $sql->query($query);

 	$query1 = "SELECT username FROM users";
 	$rezultat1 = $sql->query($query1);
 	//var_dump($rezultat);

 ?>



<!DOCTYPE html>
<html>
	<head>
		<title></title>
	
		<style>
			.option{color:black;}
		</style>
		<script src="js/jquery.js"></script>
	</head>
	<body>


		<form action="register.php" method="POST">
			<h3>Registracija</h3>
			<input type="text" name="ime" placeholder="Unesite vase ime" required />
			<input type="password" name="sifra" placeholder="Unesite vasu sifru" required />
			<input type="email" name="email" placeholder="Unesite vas mail" required />
			<input type="submit" value="Registruj se">
		</form>

		<form action="login.php" method="POST">
			<h3>Login na sajt</h3>
			<input type="email" name="email" placeholder="Unesite vas mail" required />
			<input type="password" name="sifra" placeholder="Unesite vasu sifru" required />
			<input type="submit" value="Uloguj se">
		</form>


		<form action="kupovina.php" method="POST">
			<h3>Kupovina proizvoda</h3>
			<input type="email" name="email" placeholder="Unesite vas mail" required />
			<input type="password" name="sifra" placeholder="Unesite vasu sifru" required />
			<select   name="proizvod"  class="select" required>
				<option   value="" disabled selected hidden >Odaberite zeljeni proizvod</option>
				<?php if($rezultat->num_rows>=1){
						while($rows = $rezultat->fetch_assoc()){	
				 ?>
				<option  class="option"  value="<?php echo $rows['naziv'] ?>" name = "proizvod" ><?php echo $rows['naziv'] ?></option>
				<?php 
							}
						}
				 ?>
			</select>
			<input type="submit" value="Kupi">
		</form>

		<form action="proizvod.php" method="POST">
			<h3>Lista kupaca koji su kupili odredjeni proizvod</h3>
			<select   name="proizvod"  class="select" required>
				<option   value="" disabled selected hidden >Odaberite zeljeni proizvod</option>
				<?php 
					$rezultat = $sql->query($query);
					if($rezultat->num_rows>=1){
						while($rows = $rezultat->fetch_assoc()){	
				 ?>
				<option  class="option"  value="<?php echo $rows['naziv'] ?>" name = "proizvod" ><?php echo $rows['naziv'] ?></option>
				<?php 
							}
						}
				 ?>
			</select>
			<input type="submit" value="Prikazi">
		</form>

		<form action="cena.php" method="POST">
			<h3>Lista proizvoda koji su skuplji od odredjene cene</h3>
			<input type="number" step="any" name="cena" placeholder="Unesite najmanu cenu proizvoda" required />
			<input type="submit" value="Prikazi">
		</form>

		<form action="kupac.php" method="POST">
			<h3>Lista proizvoda koji su kupljeni od strane odredjenog kupca</h3>
			<select   name="kupac"  class="select" required>
				<option   value="" disabled selected hidden >Odaberite odredjenog kupca</option>
				<?php if($rezultat1->num_rows>=1){
						while($rows = $rezultat1->fetch_assoc()){	
				 ?>
				<option  class="option"  value="<?php echo $rows['username'] ?>" name = "kupac" ><?php echo $rows['username'] ?></option>
				<?php 
							}
						}
				 ?>
			</select>
			<input type="submit" value="Prikazi">
		</form>

		<script>
			$(document).ready(function(){
				$('.select').css('color','gray');
   				$('.select').on('change',function() {
   					$(this).css('color','black');
   				}); 

			});


		</script>
	</body>
</html>

<?php 
	$sql->close();

 ?>

