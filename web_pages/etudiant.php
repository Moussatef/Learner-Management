<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- ===== BOX ICONS ===== -->
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
      integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
      crossorigin="anonymous"
    />

    <!-- ===== CSS ===== -->
    
		<link rel="stylesheet" href="sass/styles.css">
    <link rel="stylesheet" href="sass/main.css">
    <link rel="stylesheet" href="sass/etudiant.css" />
    <link rel="stylesheet" href="sass/navbar.css" />
    <title>Etudiant Dashboard</title>


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

	$comnd = $con->prepare("SELECT COUNT(personne_formateur.ID_FORMATEUR) as NB FROM personne_formateur "); 
    	$comnd->execute();
		$row_1 =$comnd->fetch();
		$comnd = $con->prepare("SELECT COUNT(personne_etud.ID_ETUDIANT) as NB FROM personne_etud "); 
    	$comnd->execute();
		$row_2 =$comnd->fetch();
		$comnd = $con->prepare("SELECT COUNT(classe_etd.ID_CLASSE_ETD) as NB FROM classe_etd "); 
    	$comnd->execute();
		$row_3 =$comnd->fetch();

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

    <div class="l-navbar" id="nav-bar">
      <nav class="nav">
        <div>
          <a href="index.php" class="nav__logo">
            <!-- <i class="bx bx-layer nav__logo-icon"></i> -->
            <i class="bx bxs-home nav__logo-icon"></i>
            <span class="nav__logo-name">HOWARD</span>
          </a>

          <div class="nav__list">
            <a href="etudiant.php?dash=1" class="nav__link ">
              <i class="bx bx-grid-alt nav__icon"></i>
              <span class="nav__name">Dashboard</span>
            </a>

            <a href="etudiant.php?dash=2" class="nav__link ">
              <i class="fas fa-pen nav__icon"></i>
              <span class="nav__name">Edit</span>
            </a>
          </div>
        </div>
      </nav>
    </div>
    <!-- start Cart etudiant -->

    <div class="title-sec"><?php echo $nom_e." ".$pren_e; ?></div>
	<div class="sts">
			<div class="item">
				<h3>
					Number of teachers<br><br> <span > <?php echo $row_1['NB'];  ?></span>
				</h3>
			</div>
			<div class="item">
				<h3>
					Number of students<br><br><span > <?php echo $row_2['NB'];  ?></span>
				</h3>
			</div>
			<div class="item">
				<h3>
					Number of classes<br><br><span > <?php echo $row_3['NB'];  ?></span>
				</h3>
			</div>
		
		</div>

    <div class="etu-cart">
      <div class="etu-avatar">
        <img src="img/profil.png" alt="" />
      </div>

      <div class="etu-content">
        <p><b>Nom : </b><?php echo $nom_e; ?></p>
        <p><b>Prenom : </b><?php echo $pren_e; ?></p>
        <p><b>Age : </b><?php echo $age; ?></p>
        <p><b>Email : </b><?php echo $emal_e; ?></p>
        <p><b>Ville : </b>Safi</p>
        <p><b>Classe : </b><?php echo $Nom_classe; ?></p>
        <p><b>Formateur : </b><?php echo $Nom_Formateur; ?></p>
      </div>
    </div>
    <?php
					}else {
							header('Location:index.php');
						} ?>	

    <!-- end Cart etudiant -->

    <!-- Start Note Etudiant table -->
    
    <!-- end  Note Etudiant table -->

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

			<table>
      <h2>
        Les Notes
      </h2>
      <thead>
        <tr>
          <th>Module</th>
          <th>Note</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row_n = mysqli_fetch_array($results3)) { ?>
        <tr>
        <td><?php echo $row_n['NOM_MODULE']; ?></td>
										<td><?php echo $row_n['NOTE']; ?></td>
									</tr>
								<?php } ?>
      </tbody>
    </table>
		</div>
		<?php } ?>
		</div>
	</div>
	</form>
    

  <footer>
      <div class="footer-con">
        <div class="footer-row footer-row__1">
          <ul>
            <li><a href="#">&#169; 2020 All Right reserved</a></li>
          </ul>
        </div>
        <div class="footer-row footer-row__2">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Logout</a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
          </ul>
        </div>
        <div class="footer-row footer-row__3">
          <ul>
            <li>
              <a href="#"><i class="fab fa-facebook"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-instagram-square"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-twitter"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </footer>
    	<!-- footer end -->
	</body>
</html>
