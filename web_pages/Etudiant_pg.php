<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<title>Document</title>
		<link rel="stylesheet" href="sass/navbar.css" />
		<link rel="stylesheet" href="sass/footer.css">
        <link rel="stylesheet" href="sass/main.css">
        
        <link rel="stylesheet" href="sass/Etudiant_sass.css">


<?php 
	include 'connect.php';
	$_SESSION['LogOut']='Etudiant_pg.php?logout=1';
	$_SESSION['Profil']='Etudiant_pg.php?dash=0';
	include("includ_html/hedar.php");
	$db = mysqli_connect('localhost', 'root', '', 'brief4_conception');

	// initialize variables
	$email = "";
	$newpass = "";
	$reptpass = "";
	$id = 0;
	$emailErr = "";
	$passErr = "";
	$update = false;
	$dash=isset($_GET['dash']) ? $_GET['dash'] : 0;

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }
	if(!empty($_SESSION['ID_ETD'])){
		$ID_ETD = $_SESSION['ID_ETD'];
		$results = mysqli_query($db,"SELECT personne.* FROM personne INNER JOIN personne_etud on personne.ID_PERSON = personne_etud.ID_PERSON WHERE personne_etud.ID_ETUDIANT=$ID_ETD"); 
    	$results2 = mysqli_query($db,"SELECT classe_etd.ID_CLASSE_ETD,classe_etd.NOM,personne_formateur.ID_FORMATEUR,CONCAT(personne.PRENOM ,' ', personne.NOM) AS Full_Name FROM classe_etd  INNER JOIN personne_formateur on personne_formateur.ID_FORMATEUR=classe_etd.ID_FORMATEUR INNER JOIN personne_etud on personne_etud.ID_ClasseETD=classe_etd.ID_CLASSE_ETD RIGHT JOIN personne on personne.ID_PERSON = personne_formateur.ID_PERSON WHERE personne_etud.ID_ETUDIANT = $ID_ETD");
		$results3 = mysqli_query($db,"SELECT module.NOM_MODULE,notes.NOTE FROM notes INNER JOIN module on notes.ID_MODULE= module.ID_MODULE WHERE notes.ID_ETUDIANT=$ID_ETD");
		$row = mysqli_fetch_array($results);
         $id_personne= $row['ID_PERSON'];
		$nom_e = $row['NOM'];
		$pren_e=$row['PRENOM'];
		$age = $row['AGE'];
		$emal_e=$row['EMAIL'];
	
	while($row = mysqli_fetch_array($results2)){
		$ID_classe = $row['ID_CLASSE_ETD'];
		$Nom_classe = $row['NOM'];
		$ID_Formateur =$row['ID_FORMATEUR'];
		$Nom_Formateur = $row['Full_Name'];
	}
	if (isset($_GET['dash'])==2) {
		echo $_GET['dash'];
		$id = $_SESSION['ID_ETD'];
		$update = true;
		$email = $emal_e;
	}
	if($_SERVER['REQUEST_METHOD']=='POST'){
       if(strcmp($_POST["email"],$emal_e)!=0)
		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		  }else {
			$email = test_input($_POST["email"]);
			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
			// check if e-mail address is well-formed
			if (preg_match($regex,$email)) {
				$stmt = $con->prepare("UPDATE personne SET EMAIL=? where personne.ID_PERSON=?");
				$stmt->execute(array($email,$id_personne));
				$_SESSION['up'] = "Email saved"; 
				header('url:Etudiant_pg.php?dash=1');
			}else {
				$emailErr = "Invalid email format";
			}
		}
		if (!empty($_POST["newpass"]) && !empty($_POST["reptpass"]) ) {
			$newpass = $_POST["newpass"] ;
			$reptpass = $_POST["reptpass"] ;
			if (strcmp($newpass,$reptpass)==0) {
				$stmt = $con->prepare("UPDATE personne SET PASSWORD=? where personne.ID_PERSON=?");
				$stmt->execute(array($newpass,$id_personne));
				if(!empty($_SESSION['up']))
				$_SESSION['up'] = "Email & Password saved";
				else {
					$_SESSION['up'] = "Password saved";
				}
				header('url:Etudiant_pg.php?dash=1');
			  
			}else {
				$passErr = "Invalid Password format";
			}
		  }else {
			$passErr = "Password is required";
		}
	}
	?>
	<div class="contant">
		<div class="dashb">
			<a href="Etudiant_pg.php?dash=1"><div>Profil</div></a>
			<a href="Etudiant_pg.php?dash=2"><div>Edit</div></a>
		</div>
		<div class="div_cont">
		<div class="contant">
			<div class="info profil_card">
				<div class="imgP">
					<img src="img/profil.png" alt="">
				</div>
				<div class=Info_P>
					<table>
						<tr>
							<td>Nom</td>
							<td>:</td>
							<td><?php echo $nom_e; ?></td>
						</tr>
						<tr>
							<td>Prenom</td>
							<td>:</td>
							<td><?php echo $pren_e; ?></td>
						</tr>
						<tr>
							<td>Age</td>
							<td>:</td>
							<td><?php echo $age; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?php echo $emal_e; ?></td>
						</tr>
							<!-- <td>
								<a href="Etudiant_pg.php?edit=" class="edit_btn" >Edit</a>
							</td> -->
						<?php
					}else {
							header('Location:index.php');
						} ?>			
					</table>
				</div>
			</div>
			<div class="info">
				<div class="tabl_classe">
					<table>
							<tr>
								<th>Classe</th>
								<th>Nom Formateur</th>
							</tr>
							<tr>
								<td><?php echo $Nom_classe; ?></td>
								<td><?php echo $Nom_Formateur; ?></td>
							</tr>			
					</table>
				</div>
						<div class="tabl_classe">
							<table>
								<thead>
									<tr>
										<th>Module</th>
										<th>Note</th>
									</tr>
								</thead>
								<?php while ($row_n = mysqli_fetch_array($results3)) { ?>
									<tr>
										<td><?php echo $row_n['NOM_MODULE']; ?></td>
										<td><?php echo $row_n['NOTE']; ?></td>
									</tr>
								<?php } ?>
							</table>
						</div>
				</div>
			</div>
			<?php if ($dash == 2){ 
				if (isset($_SESSION['up'])){ ?>
				<div class="msg">
				<?php 
					echo $_SESSION['up']; 
					unset($_SESSION['up']);
				?>
	</div>
    <?php } ?>
	<form method="POST" action="?dash=2" >
	<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email" value="<?php echo $email; ?>">
			<span><?php echo $emailErr; ?></span>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="newpass" value="" placeholder="New Password">
			<br><br>
			<input type="password" name="reptpass" value="" placeholder="Repet New Password">
			<br><br>
			<span><?php echo $passErr; ?></span>
		</div>
		<div class="input-group">
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
	
		</div>
		<?php  }else {  ?>

			<div class="btm_div">
				<img src="img/profil1.png" alt="">
				<img src="img/profil2.png" alt="">
			</div>
		</div>
		<?php } ?>
		</div>
	</div>
	</form>
	<?php include("includ_html/footer_html.php"); ?>