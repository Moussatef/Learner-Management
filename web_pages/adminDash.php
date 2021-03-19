<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
		<title>Document</title>
		<link rel="stylesheet" href="sass/navbar.css" />
		<link rel="stylesheet" href="sass/footer.css">
        <link rel="stylesheet" href="sass/main.css">

        
        <link rel="stylesheet" href="sass/styles.css">

<?php   include('server.php');
		include('connect.php');
		include('includ_html/hedar.php');

		if( empty($_SESSION['ID_ADM']))
		header("Location:index.php");


		$do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

		$comnd = $con->prepare("SELECT COUNT(personne_formateur.ID_FORMATEUR) as NB FROM personne_formateur "); 
    	$comnd->execute();
		$row_1 =$comnd->fetch();
		$comnd = $con->prepare("SELECT COUNT(personne_etud.ID_ETUDIANT) as NB FROM personne_etud "); 
    	$comnd->execute();
		$row_2 =$comnd->fetch();
		$comnd = $con->prepare("SELECT COUNT(classe_etd.ID_CLASSE_ETD) as NB FROM classe_etd "); 
    	$comnd->execute();
		$row_3 =$comnd->fetch();
		
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM personne WHERE ID_PERSON=$id");
			$n = mysqli_fetch_array($record);
            $name = $n['NOM'];
            $fname = $n['PRENOM'];
            $age = $n['AGE'];
            $email = $n['EMAIL'];
            $password = $n['PASSWORD'];
	}
?>
		<main>
			<div class="l-navbar" id="nav-bar">
				<nav class="nav">
					<div>
						<a href="adminDash.php" class="nav__link">
							<i class="bx bx-grid-alt nav__icon"></i>
							<span class="nav__logo-name">Dashboard</span>
						</a>
						<div class="nav__list">
							<a href="adminDash.php?do=add" class="nav__link ">
								<i class="fas fa-user-plus nav__icon"></i>
								<span class="nav__name">Add</span>
							</a>
							
							<a href="adminDash.php?do=msg" class="nav__link ">
								<i class="fab fa-facebook-messenger nav__icon"></i>
								<span class="nav__name">Messages</span>
							</a>
						</div>
					</div>
				</nav>
			</div>
		<div class="containerDash">
			<div class="maincontent">
				<div class="adminDashtitle">
					<h1>Admin Dashboard</h1>
				</div>
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
		<?php if (isset($_SESSION['message'])): ?>
	        <div class="msg">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ; ?>

		
		<?php 
		if($do == 'Manage' || $do=='add' || $do=='edit'){
		?>
	<div class="aze">
		<div class="<?php if($do=='Manage') echo 'mng_class';else echo 'tables';  ?> ">
               <?php $results1 = mysqli_query($db, "SELECT * from personne inner join personne_etud on personne.ID_PERSON = personne_etud.ID_PERSON"); ?>
			   <h2 class="titles">Table des Etudiant</h2>
                <div class="tablewrapper ">
                    <table>
                        <thead>
                            <tr>
							<th>Id</th>
                                <th>Name</th>
                                <th>First name</th>
                                <th id="show">Age</th>
                                <th  id="show">Email</th>
                                <th id="show">Password</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <?php while ($row1 = mysqli_fetch_array($results1)) { ?>
                            <tr>
								<td><?php echo $row1['ID_PERSON']; ?></td>
                                <td><?php echo $row1['NOM']; ?></td>
                                <td><?php echo $row1['PRENOM']; ?></td>
                                <td id="show"><?php echo $row1['AGE']; ?></td>
                                <td id="show"><?php echo $row1['EMAIL']; ?></td>
                                <td id="show"><?php echo $row1['PASSWORD']; ?></td>
                                <td>
                                    <a href="adminDash.php?do=edit&edit=<?php echo $row1['ID_PERSON']; ?>" class="edit_btn" ><img width="20px" src="img/edit.png"></a>
                                </td>
                                <td>
                                    <a href="server.php?del=<?php echo $row1['ID_PERSON']; ?>" class="del_btn"><img width="20px" src="img/remove.png"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
					<?php
		
					$results2 = mysqli_query($db, "SELECT * FROM personne INNER JOIN personne_formateur ON personne.ID_PERSON = personne_formateur.ID_PERSON"); ?>
			   <h2 class="titles">Table des Formateurs</h2>
                <div class="tablewrapper">
                    <table>
                        <thead>
                            <tr>
								<th>Id</th>
                                <th>Name</th>
                                <th>First nmae</th>
                                <th id="show">Age</th>
                                <th id="show">Email</th>
                                <th id="show">Password</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        
                        <?php while ($row2 = mysqli_fetch_array($results2)) { ?>
                            <tr>
							    <td><?php echo $row2['ID_PERSON']; ?></td>
                                <td><?php echo $row2['NOM']; ?></td>
                                <td><?php echo $row2['PRENOM']; ?></td>
                                <td id="show"><?php echo $row2['AGE']; ?></td>
                                <td id="show"><?php echo $row2['EMAIL']; ?></td>
                                <td id="show"><?php echo $row2['PASSWORD']; ?></td>
                                <td>
                                    <a href="adminDash.php?do=edit&edit=<?php echo $row2['ID_PERSON']; ?>" class="edit_btn" ><img width="20px" src="img/edit.png"></a>
                                </td>
                                <td>
                                    <a href="server.php?del=<?php echo $row2['ID_PERSON']; ?>" class="del_btn"><img width="20px" src="img/remove.png"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    </div>
					<?php
		
					$results2 = mysqli_query($db, "SELECT   classe_etd.* , CONCAT(personne.NOM,' ',personne.PRENOM) AS Nom_cmp,COUNT(personne_etud.ID_ETUDIANT) AS NB_ETD 
					FROM classe_etd INNER JOIN personne_formateur ON personne_formateur.ID_FORMATEUR = classe_etd.ID_FORMATEUR 
					INNER JOIN personne ON personne_formateur.ID_PERSON = personne.ID_PERSON 
					INNER JOIN personne_etud ON classe_etd.ID_CLASSE_ETD = personne_etud.ID_ClasseETD
					GROUP BY  classe_etd.NOM ,Nom_cmp"); ?>
			   <h2 class="titles">Table Classe </h2>
                <div class="tablewrapper">
                    <table>
                        <thead>
                            <tr>
								<th>ID_Classe</th>
                                <th>Classe Name</th>
                                <th colspan="2">Formateur Name</th>
                                <th >N° Student</th>
                            </tr>
                        </thead>
                        
                        <?php while ($row2 = mysqli_fetch_array($results2)) { ?>
                            <tr>
							    <td><?php echo $row2['ID_CLASSE_ETD']; ?></td>
								<td><?php echo $row2['NOM']; ?></td>
                                <td><?php echo $row2['Nom_cmp']; ?></td>
                                <td><?php echo $row2['NB_ETD']; ?></td>
                                <!-- <td>
                                    <a href="adminDash.php?do=edit&edit=<php echo $row2['ID_CLASSE_ETD']; ?>" class="edit_btn" ><img width="20px" src="img/edit.png"></a>
                                </td>
                                <td>
                                    <a href="server.php?del=<php echo $row2['ID_CLASSE_ETD']; ?>" class="del_btn"><img width="20px" src="img/remove.png"></a>
                                </td> -->
                            </tr>
                        <?php } ?>
                    </table>
                    </div>
					<?php } ?>
		</div>
		<?php
		if( $do=='add' || $do=='edit'){ ?>

            <form id="adminform" method="post" action="server.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="input-group">
                    <!-- <label>Name</label> -->
                    <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>">
                </div>
                <div class="input-group">
                    <!-- <label>First name</label> -->
                    <input type="text" name="fname" placeholder="First Name" value="<?php echo $fname; ?>">
                </div>
                <div class="input-group">
                    <!-- <label>Age</label> -->
                    <input type="text" name="age" placeholder="Age" value="<?php echo $age; ?>">
                </div>
                <div class="input-group">
                    <!-- <label>Email</label> -->
                    <input type="email" placeholder="Email //Ex : azert@email.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="input-group">
                    <!-- <label>Password</label> -->
                    <input type="password" name="password" placeholder="password" value="<?php echo $password; ?>">
                </div>
				<div class="azerty input-group">
				    <?php $results4 = mysqli_query($db, "SELECT * FROM classe_etd"); ?>
					<!-- <label>
						classe Name :
					</label> -->
					<select id="selectA" name="classes">
						<?php while ($row4 = mysqli_fetch_array($results4)) { ?>
							<option value="<?php echo $row4['ID_CLASSE_ETD']; ?>"><?php echo $row4['NOM']; ?></option>
						<?php } ?>
					</select>
                    <input type="text" id="inp_class" style="display:none;" name="class_name" placeholder="Classe Name" value="">


				</div>

				<div class="radio input-group">
                    <label>Etudiant : <input  id="etd_R" class="radiobutton" type="radio" name="selection" checked value="etudiant"></label>
                    
					<label>Formateur : <input id="frm_R" class="radiobutton" type="radio" name="selection"  value="formateur"></label>
                </div>
				<script src="js/checkBX.js"></script>
				
				 
                <div class="input-group">
                <?php if ($update == true): ?>
                <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
                <?php else: ?>
                    <button class="btn" type="submit" name="save" >Save</button>
                <?php endif ?>
		        </div>
	        </form>
			<?php } ?>
		</div>
		<?php 
		if($do == 'msg'){
		
		$results3 = mysqli_query($db, "SELECT * FROM box_message"); ?>
		<div class="meessagesTitle">
			<h2 id ="Messages">Messages</h2>
			<hr>
		</div>
		<div class=" messagesCards ">
		<?php while ($row3 = mysqli_fetch_array($results3)) { ?>
			<div class="cards">
			<div class="isma">
			<div class="name"><?php echo $row3['NOM']; ?></div>
			<a href="server.php?delM=<?php echo $row3['id_Msg']; ?>" class="del_message del_btn"><img width="20px" src="img/remove.png"></a>
			</div>
				<div class="phone"><?php echo $row3['Telephon']; ?></div>
				<div class="phone"><?php echo $row3['EMAIL']; ?></div>
				<hr>
				<div class="msgC"><?php echo $row3['Message']; ?></div>
				<hr>
				<div class="date"><?php echo $row3['Date']; ?></div>
				
			</div>
			<?php } ?>
			
		</div>
		<?php } ?>

		
	</div>
</div>

		</main>
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

		<!-- footer start -->
		<!-- <footer class="">
			<div class="footer">
				<div class="footer-section footer1">
					<img id="logo-footer" src="img/howard_social2.png" alt="logo" />
					<p>
							Find and Compare Great Car Deals. <br>
							Book with Confidence Create a Car <br>
							and Monitor Car Deals for Specific Travel Dates
					</p>
					<br />
					<a class="socials" href="#"
						><img src="img/facebook.png" alt=""
					/></a>
					<a class="socials" href="#"
						><img src="img/instagram.png" alt=""
					/></a>
					<a class="socials" href="#"
						><img src="img/linkedin.png" alt=""
					/></a>
					<a class="socials" href="#"
						><img src="img/Twitter.png" alt=""
					/></a>
				</div>
				<div class="footer-section footer2">
					<ul class="boxFooter">
						<h2>Product</h2>
						<li><a href="#">Theme Design</a></li>
						<li><a href="#">Plug in Design</a></li>
						<li><a href="#">WordPress</a></li>
						<li><a href="#">Some World</a></li>
						<li><a href="#">Contact Design</a></li>
					</ul>
				</div>
				<div class="footer-section footer3">
					<ul class="boxFooter">
						<h2>Useful links</h2>
						<li><a href="#">sponsors</a></li>
						<li><a href="#">Our Murch</a></li>
						<li><a href="#">Sales</a></li>
						<li><a href="#">Best Deals</a></li>
						<li><a href="#">Customer Service</a></li>
					</ul>
				</div>
				<div class="footer-section footer4">
					<ul class="boxFooter">
						<h2>Address</h2>
						<li><a href="#">127, DownTown</a></li>
						<li><a href="#">7D1F S2 Long Street</a></li>
						<li><a href="#">London</a></li>
						<li><a href="#">United kingdom</a></li>
					</ul>
				</div>
			</div>
			<div class="footer-bottom">
				All rights reserved &copy;copyrights 2021
			</div>
		</footer> -->

		<!-- footer end -->
		<!-- <script src="js/app.js"></script> -->
	</body>
</html>
