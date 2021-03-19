	
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
        <link rel="stylesheet" href="sass/styles.css">
	
	
	
	<?php 
		include("includ_html/hedar.php");
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
	?>
		<div class="pushDown"></div>
		<main>
			<div class="container">
				<div class="box box1">
					<h1>Welcome to HOWARD UNIVERSITY</h1>
					<p>Lorem ipsum, dolor sit amet consectetur 
						adipisicing elit. Tempore nobis nihil aspernatur 
						recusandae quam iure et?
					</p>

					<?php if(!empty($_SESSION['ID_FRM']) || !empty($_SESSION['ID_ETD']) || !empty($_SESSION['ID_ADM'])){ ?>
                         <p>Read more about HOWARD university</p>
				<?php }else {
				?>
				<button class="buttonHome"><a style="text-decoration:none;" href="page_login.php">Login</a></button>
				<?php } ?>
				</div>
				<div class="box box2"><img class="home" src="img/home.png" alt=""></div>	
			</div>
				<div class="sebarator">
					<h1>Read more about HOWARD university</h1>
				</div>
					 <div class="wrapperCards">
					 <div class="containerA">
						<img src="img/education.png" alt="Avatar" class="image">
						<div class="overlay">
						  <div class="text">
							<h2>Best university in north america</h2>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
								 Dolorum hic veniam culpa. Fuga libero nostrum ab vitae doloribus, 
								 ipsa illum voluptate laborum, nesciunt 
								 amet vero dolorum esse rerum est explicabo!</p>
						  </div>
						</div>
					  </div>
					  <div class="containerA">
						<img src="img/imagination.png" alt="Avatar" class="image">
						<div class="overlay">
						  <div class="text">
							<h2>Best university in north america</h2>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
								 Dolorum hic veniam culpa. Fuga libero nostrum ab vitae doloribus, 
								 ipsa illum voluptate laborum, nesciunt 
								 amet vero dolorum esse rerum est explicabo!</p>
						  </div>
						</div>
					  </div>
					  <div class="containerA">
						<img src="img/phisics.png" alt="Avatar" class="image">
						<div class="overlay">
						  <div class="text">
							<h2>Best university in north america</h2>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
								 Dolorum hic veniam culpa. Fuga libero nostrum ab vitae doloribus, 
								 ipsa illum voluptate laborum, nesciunt 
								 amet vero dolorum esse rerum est explicabo!</p>
						  </div>
						</div>
					  </div>
					  <div class="containerA">
						<img src="img/teacher.png" alt="Avatar" class="image">
						<div class="overlay">
						  <div class="text">
							<h2>Best university in north america</h2>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
								 Dolorum hic veniam culpa. Fuga libero nostrum ab vitae doloribus, 
								 ipsa illum voluptate laborum, nesciunt 
								 amet vero dolorum esse rerum est explicabo!</p>
						  </div>
						</div>
					  </div>
					</div>
		</main>

		<div class="sts">
			<div class="item">
				<h3>
					Number <span style="color:rgb(108,99, 255);">of teachers</span><br><br> <span style="font-size:60px;"> 7<?php echo $row_1['NB'];  ?></span>
				</h3>
			</div>
			<div class="item">
				<h3>
					Number <span style="color:rgb(108,99, 255);">of students</span><br><br><span style="font-size:60px;"> 2<?php echo $row_2['NB'];  ?></span>
				</h3>
			</div>
			<div class="item">
				<h3>
					Number <span style="color:rgb(108,99, 255);">of classes</span><br><br><span style="font-size:60px;"> 4<?php echo $row_3['NB'];  ?></span>
				</h3>
			</div>
		
		</div>
		<div class="sebarator">
					<h1>we offer world recognised diplomats</h1>
				</div>
					<section>
					
			<img src="img/1.jpg" id="slider" />
			<ul class="nvigation">
				<li onclick="imgSlider('img/1.jpg')">
					<img src="img/1.jpg" />
				</li>
				<li onclick="imgSlider('img/2.jpg')">
					<img src="img/2.jpg" />
				</li>
				<li onclick="imgSlider('img/3.jpg')">
					<img src="img/3.jpg" />
				</li>
				<li onclick="imgSlider('img/4.jpg')">
					<img src="img/4.jpg" />
				</li>
			</ul>
		</section>

		<script>
			function imgSlider(anything) {
				document.getElementById("slider").src = anything;
			}
		</script>

		<?php include("includ_html/footer_html.php"); ?>
