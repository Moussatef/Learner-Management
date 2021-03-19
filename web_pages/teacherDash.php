

<!DOCTYPE html>
<html lang="en">
	<head>
	
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Document</title>
		<link rel="stylesheet" href="sass/styles.css">
		<link rel="stylesheet" href="sass/teacherDash.css">
		<head>
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
	<?php 

include("includ_html/hedar.php");
include('TeacherApp.php');
 $idF =  $_SESSION['ID_FRM'];
 $test='';
  if (!empty($_SESSION['module'])){
			$test = $_SESSION['module'];
			unset($_SESSION['module']);
		}
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT personne.* from classe_etd INNER JOIN personne_etud ON classe_etd.ID_CLASSE_ETD = personne_etud.ID_ClasseETD INNER JOIN personne on  personne.ID_PERSON = personne_etud.ID_PERSON WHERE classe_etd.ID_FORMATEUR = '$idF' and personne.ID_PERSON=$id");

			$n = mysqli_fetch_array($record);
		
            $name = $n['NOM'];
            $fname = $n['PRENOM'];
            $age = $n['AGE'];
            $email = $n['EMAIL'];
            $password = $n['PASSWORD'];
	}
             $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';
			
	
	?>
		<main>

			<div class="containerDash">
			
			<div class="l-navbar" id="nav-bar">
				<nav class="nav">
					<div>
						<a href="teacherDash.php" class="nav__link">
							<i class="bx bx-grid-alt nav__icon"></i>
							<span class="nav__logo-name">Students</span>
						</a>
						<div class="nav__list">
							<a href="teacherDash.php?do=add" class="nav__link ">
								<i class="fas fa-user-plus nav__icon"></i>
								<span class="nav__name">Add Student</span>
							</a>
							
							<a href="teacherDash.php?do=msg" class="nav__link ">
							<i class="fas fa-marker"></i>
								<span class="nav__name">Add note</span>
							</a>
						</div>
					</div>
				</nav>
			</div>
		<div class="maincontent">
		
			<div class="adminDashtitle">

			<h1>Formateur Dashboard</h1>	
			</div>
			<div class="mobileNav">
			<div>
						<a href="teacherDash.php" class="_link">
							<i class="bx bx-grid-alt nav__icon"></i>
							<span class="_logo-name">Students</span>
						</a>
						<div class="nav__list">
							<a href="teacherDash.php?do=add" class="_link ">
								<i class="fas fa-user-plus nav__icon"></i>
								<span class="_name">Add Student</span>
							</a>
							
							<a href="teacherDash.php?do=msg" class="_link ">
							<i class="fas fa-marker"></i>
								<span class="_name">Add note</span>
							</a>
						</div>
					</div>
				</nav>
			</div>
			
			<div class="teachercardWrapper">
			<div class="drop teachercard">
				
			</div>
			<div class="drop teachercard">
				
			</div>
			<?php 
			include 'connect.php';
			$comnd = $con->prepare("SELECT COUNT(personne_formateur.ID_FORMATEUR) as NB FROM personne_formateur "); 
			$comnd->execute();
			$row_1 =$comnd->fetch();
			$comnd = $con->prepare("SELECT COUNT(personne_etud.ID_ETUDIANT) as NB FROM personne_etud "); 
			$comnd->execute();
			$row_2 =$comnd->fetch();
			$comnd = $con->prepare("SELECT COUNT(classe_etd.ID_CLASSE_ETD) as NB FROM classe_etd "); 
			$comnd->execute();
			$row_3 =$comnd->fetch();
			
			$idF =  $_SESSION['ID_FRM'];
			$identifiant=$_SESSION['ID_FRM']; $results3 = mysqli_query($db, "SELECT ID_CLASSE_ETD ,NOM FROM `classe_etd` WHERE classe_etd.ID_FORMATEUR ='$identifiant'");
			$row3 = mysqli_fetch_array($results3);
			$className = $row3['NOM'];
			$idClassEtusiant = $row3['ID_CLASSE_ETD'];
			$_SESSION['classId'] = $idClassEtusiant;
			?>
			<div id="123abc" class ="teachercard">
				<h2><?php echo $_SESSION['Full_Name'];?></h2>
				<h3><?php echo $className; ?></h3>
			</div>
			</div>
			<?php 
		if($do == 'Manage' || $do=='add' || $do=='edit'){
		?>
				<?php $results2 = mysqli_query($db, "SELECT personne_etud.ID_ETUDIANT ,  personne.* from classe_etd INNER JOIN personne_etud ON classe_etd.ID_CLASSE_ETD = personne_etud.ID_ClasseETD INNER JOIN personne on  personne.ID_PERSON = personne_etud.ID_PERSON WHERE classe_etd.ID_FORMATEUR = '$idF' GROUP by personne.ID_PERSON");?>
				<div class="tableWrapperT">
				<div class="sts">
			<div class="item" style="width:250px;font-size:20px;height:175px;">
				<h3>
					Number of teachers<br><br> <span > <?php echo $row_1['NB'];  ?></span>
				</h3>
			</div>
			<div class="item" style="width:250px;font-size:20px;height:175px;">
				<h3>
					Number of students<br><br><span > <?php echo $row_2['NB'];  ?></span>
				</h3>
			</div>
			
		
		</div>
				<h2 class="titles">Table de vos etudiants</h2>
				<table>
                        <thead>
                            <tr>
								<th>Id</th>
                                <th>Name</th>
                                <th>First nmae</th>
                                <th id="show">Age</th>
                                <th id="show">Email</th>
                                <th id="show">Password</th>
                                <th></th>
                            </tr>
                        </thead>
                        
                        <?php while ($row2 = mysqli_fetch_array($results2)) { ?>
                            <tr>
							    <td><?php echo $row2['ID_ETUDIANT']; ?></td>
                                <td><?php echo $row2['NOM']; ?></td>
                                <td><?php echo $row2['PRENOM']; ?></td>
                                <td id="show"><?php echo $row2['AGE']; ?></td>
                                <td id="show"><?php echo $row2['EMAIL']; ?></td>
                                <td id="show"><?php echo $row2['PASSWORD']; ?></td>
                                <td>
                                    <a href="teacherDash.php?do=edit&edit=<?php echo $row2['ID_PERSON']; ?>" class="edit_btn" ><img width="20px" src="img/edit.png"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
				</div>
				<?php } ?>

				
				<div class="actionsWrapper">
				<?php
					if( $do=='add' || $do=='edit'){ ?>
				<form id="formT" method="post" action="TeacherApp.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="input-group">
                    <label></label>
                    <input type="text" placeholder="Name" name="name" value="<?php echo $name; ?>">
                </div>
                <div class="input-group">
                    <label></label>
                    <input type="text" placeholder="First name" name="fname" value="<?php echo $fname; ?>">
                </div>
                <div class="input-group">
                    <label></label>
                    <input type="text" placeholder="Age" name="age" value="<?php echo $age; ?>">
                </div>
                <div class="input-group">
                    <label></label>
                    <input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="input-group">
                    <label></label>
                    <input type="password"  placeholder="Password" name="password" value="<?php echo $password; ?>">
                </div>
				 
                <div class="input-group">
                <?php if ($update == true): ?>
                <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
                <?php else: ?>
                    <button class="btn" type="submit" name="save" >Save</button>
                <?php endif ?>
		        </div>
	        </form>
			<?php } ?>
			<?php 
		if($do == 'msg'){?>
			<div class="mlkj">
			<form method="post" action="TeacherApp.php">

			<div class="input-group">
			<?php $results7 = mysqli_query($db, "SELECT personne_etud.ID_ETUDIANT ,  personne.* FROM personne INNER JOIN personne_etud ON personne.ID_PERSON = personne_etud.ID_PERSON INNER JOIN classe_etd ON personne_etud.ID_ClasseETD = classe_etd.ID_CLASSE_ETD WHERE classe_etd.ID_FORMATEUR='$idF'"); ?>
                    <label>Identifiant des etudiants : </label>
                    <select class="idsbStudents" name="studentsIds">
					<?php while ($row7 = mysqli_fetch_array($results7)) { ?>
								<option value="<?php echo $row7['ID_ETUDIANT']; ?>"><?php echo $row7['ID_ETUDIANT']; ?></option>
					<?php } ?> 
					</select>
                </div>

				<?php $results8 = mysqli_query($db, "SELECT * FROM module"); ?>
				<div class="input-group">
                    <label>Module :</label>
                    <select class="idsbStudents" name="moduleIds">
					<?php while ($row8 = mysqli_fetch_array($results8)) { ?>
								<option value="<?php echo $row8['ID_MODULE']; ?>"><?php echo $row8['NOM_MODULE']; ?></option>
					<?php } ?> 
					</select>
                </div>
				
				<div class="input-group">
                    <label>Note : <span style="color:red;"><?php echo $test; ?></span></label>
					<p></p>
					<input type="text" name="note" id="noteStudent">
                </div>
				<div class="input-group">
					<button class="btn" type="submit" name="saveNote" >Save</button>	
					</form>
                </div>
				<div class="tableNote">
				<table id="table123">
                        <thead>
                            <tr>
								<th>Id de l'etudiant</th>
                                <th>id du module</th>
                                <th>Id du note</th>
								<th>Id Formateur</th>
                            </tr>
                        </thead>
						<?php $results10 = mysqli_query($db, "SELECT * FROM notes WHERE notes.ID_FORMATEUR ='$idF'"); ?>
                        <?php while ($row10 = mysqli_fetch_array($results10)) { ?>
                            <tr>
							    <td><?php echo $row10['ID_ETUDIANT']; ?></td>
                                <td><?php echo $row10['ID_MODULE']; ?></td>
                                <td><?php echo $row10['NOTE']; ?></td>
								<td><?php echo $row10['ID_FORMATEUR']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
				</div>
			</div>
			<?php } ?>
			</div>
		</div>
		
		</div>
	</div>
</div>
		</main>

		<!-- footer start -->
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
		<script src="js/app.js"></script>
	</body>
</html>
