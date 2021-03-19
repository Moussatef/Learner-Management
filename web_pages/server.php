<?php 
	// session_start();
	$db = mysqli_connect('localhost', 'root', '', 'brief4_conception');

	// initialize variables
    $id = 0;
	$name = "";
	$fname = "";
    $age = "";
    $email = "";
    $password = "";
	$update = false;
    
	if (isset($_POST['save'])) {
        $name =  $_POST['name'];
        $fname =  $_POST['fname'];
        $age =  $_POST['age'];
        $email =  $_POST['email'];
        $password =  $_POST['password']; 
        $answer = $_POST['selection']; 
        $ID_Classe_ETD = $_POST['classes']; 
        $Nom_Classe = $_POST['class_name'];

         if ($answer == "etudiant") {       
                mysqli_query($db, "INSERT INTO personne (NOM, PRENOM, AGE, EMAIL, PASSWORD) VALUES ('$name', '$fname','$age', '$email','$password')") ;
               $stm = mysqli_query($db,"SELECT ID_PERSON FROM personne ORDER BY ID_PERSON DESC LIMIT 1") ;
               $row = mysqli_fetch_array($stm);
               $ID_ETD = $row['ID_PERSON'];
                mysqli_query($db, "INSERT INTO personne_etud(ID_PERSON,ID_ClasseETD) VALUES ('$ID_ETD','$ID_Classe_ETD') ");
                $_SESSION['message'] = "Etudiant sauvegardé avec succès";
                header('location: adminDash.php?do=add');
            }
         elseif($answer == 'formateur') {   
                mysqli_query($db, "INSERT INTO personne (NOM, PRENOM, AGE, EMAIL, PASSWORD) VALUES ('$name', '$fname','$age', '$email','$password')");
                mysqli_query($db, "INSERT INTO personne_formateur(ID_PERSON) SELECT ID_PERSON FROM personne ORDER BY ID_PERSON DESC LIMIT 1"); 
                $stm = mysqli_query($db,"SELECT ID_FORMATEUR FROM personne_formateur ORDER BY ID_FORMATEUR DESC LIMIT 1") ;
                $row = mysqli_fetch_array($stm);
                $ID_Form = $row['ID_FORMATEUR'];
                mysqli_query($db, "INSERT INTO classe_etd(ID_FORMATEUR,NOM) VALUES ('$ID_Form','$Nom_Classe') ");
                $_SESSION['message'] = "Formateur sauvegardé avec succès";
                header('location: adminDash.php?do=add');
            }
            	
	}

    if (isset($_POST['update'])) {
        $id = $_POST['id']; 
        $name =  $_POST['name'];;
        $fname =  $_POST['fname'];
        $age =  $_POST['age'];
        $email =  $_POST['email'];
        $password =  $_POST['password'];
    
        mysqli_query($db, "UPDATE personne SET NOM='$name', PRENOM='$fname', AGE='$age', EMAIL='$email', PASSWORD='$password' WHERE ID_PERSON =$id");
        $_SESSION['message'] = " mis a jour acomplit!";
        header('location: adminDash.php?do=add');
    }

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM personne WHERE ID_PERSON=$id");
        mysqli_query($db, "DELETE FROM personne_formamteur WHERE ID_PERSON=$id");
        mysqli_query($db, "DELETE FROM personne_etud WHERE ID_PERSON=$id");
        
        $_SESSION['message'] = "suppression accompli"; 
        header('location: adminDash.php?do=add'); 
    }

    if (isset($_GET['delM'])) {
        $id = $_GET['delM'];
        mysqli_query($db, "DELETE FROM box_message WHERE id_Msg=$id");
        $_SESSION['message'] = "suppression accompli"; 
        header('location: adminDash.php');
    }