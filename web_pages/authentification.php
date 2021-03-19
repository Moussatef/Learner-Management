<?php
session_start();
include 'connect.php';
// Check If User Coming From HTTP Post Request
if($_SERVER['REQUEST_METHOD']=='POST'){
    
	$email = $_POST['email'];
    $Pass = $_POST['pass'];
    
    // Insert iformation to Database 
    $comnd = $con->prepare("SELECT personne_formateur.ID_formateur, CONCAT(personne.PRENOM ,' ', personne.NOM)  as Full_Name  from personne INNER JOIN personne_formateur on personne.ID_PERSON = personne_formateur.ID_PERSON  WHERE personne.EMAIL=? and personne.PASSWORD = ? ");
    $comnd->execute(array($email,$Pass));
	$row =$comnd->fetch();
	$Count = $comnd->rowCount();

	if ($Count >0){
		$_SESSION['LogOut']='teacherDash.php?logout=1';
		$_SESSION['Profil']='teacherDash.php?dash=0';
		$_SESSION['ID_FRM']=$row['ID_formateur']; // Register Session Name 
		$_SESSION['Email_FRM']=$email; // Register Session Id
        $_SESSION['Full_Name']=$row['Full_Name'];
		header('Location: teacherDash.php'); // Redirect To Dashboard Page
		// echo('WELCOM BACK TEACHER '.$row['Full_Name'].' TO YOUR UNIVERSITY PAGE WEB');
		exit();
	}else{
		$comnd = $con->prepare("SELECT personne_etud.ID_ETUDIANT , CONCAT(personne.PRENOM ,' ', personne.NOM)  as Full_Name  from personne INNER JOIN personne_etud on personne.ID_PERSON = personne_etud.ID_PERSON  WHERE personne.EMAIL=? and personne.PASSWORD = ? ");
    	$comnd->execute(array($email,$Pass));
		$row =$comnd->fetch();
		$Count = $comnd->rowCount();
		if ($Count >0){
			$_SESSION['LogOut']='etudiant.php?logout=1';
			$_SESSION['Profil']='etudiant.php?dash=0';
			$_SESSION['ID_ETD']=$row['ID_ETUDIANT']; // Register Session Name 
			$_SESSION['Email_ETD']=$email; // Register Session Id
			//echo " id ETD ".$_SESSION['ID_ETD']."hada ETD ".$row['ID_PERSON'] ." Email : ".$_SESSION['Email_ETD'];
			header('Location: etudiant.php?dash=0'); // Redirect To Dashboard Page
			// echo('WELCOM BACK STUDENT '.$row['Full_Name'].' TO YOUR UNIVERSITY PAGE WEB');
			exit();
		}else {
			$comnd = $con->prepare("SELECT ID_ADMIN, Nom from admin WHERE EMAIL=? and PASSWORD =? "); 
    		$comnd->execute(array($email,sha1($Pass)));
			$row =$comnd->fetch();
			$Count = $comnd->rowCount();
			if ($Count >0){
				$_SESSION['LogOut']='adminDash.php?logout=1';
				$_SESSION['Profil']='adminDash.php';
				$_SESSION['ID_ADM']=$row['ID_ADMIN']; // Register Session Name 
				$_SESSION['Email_ADM']=$email; // Register Session Id
				header('Location: adminDash.php'); // Redirect To Dashboard Page
				//  echo('WELCOM BACK ADMIN '.$row['Nom'].'  TO YOUR Project');
				exit();
			}else {
				$_SESSION['err']="Your Email or Your Password Wrong";
			}
			
		}

	}
}