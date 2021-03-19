<?php 
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
        $classId = $_SESSION['classId'];
        $idP = $_POST['id'];
        $name =  $_POST['name'];
        $fname =  $_POST['fname'];
        $age =  $_POST['age'];
        $email =  $_POST['email'];
        $password =  $_POST['password']; 
            //echo $classId;
                mysqli_query($db, "INSERT INTO personne (NOM, PRENOM, AGE, EMAIL, PASSWORD) VALUES ('$name', '$fname','$age', '$email','$password')");
                 $results_etd=mysqli_query($db,"SELECT ID_PERSON FROM personne ORDER BY ID_PERSON DESC LIMIT 3");
                $row = mysqli_fetch_array($results_etd);
                $ID_ETD = $row['ID_PERSON'];
                echo $ID_ETD . '<br>' . $classId;
                mysqli_query($db, "INSERT INTO personne_etud (ID_PERSON ,ID_ClasseETD) VALUES ('$ID_ETD','$classId')");
                $_SESSION['message'] = "Etudiant sauvegardé avec succès";
                header('location: teacherDash.php');
            	
	}

    if (isset($_POST['update'])) {
        $id = $_POST['id']; 
        $name =  $_POST['name'];
        $fname =  $_POST['fname'];
        $age =  $_POST['age'];
        $email =  $_POST['email'];
        $password =  $_POST['password'];
        mysqli_query($db, "UPDATE personne SET NOM='$name', PRENOM='$fname', AGE='$age', EMAIL='$email', PASSWORD='$password' WHERE ID_PERSON =$id");
        $_SESSION['message'] = " mis a jour acomplit!";
        header('location: teacherDash.php');
    }
     
    if (isset($_POST['saveNote'])) {
        $idFrm = $_SESSION['ID_FRM'];
        $idEtudiante = $_POST['studentsIds'];
        $idModule = $_POST['moduleIds'];
        $note = $_POST['note'];
        
        //test
                
                $result = mysqli_query($db,"SELECT notes.ID_ETUDIANT ,notes.NOTE FROM notes INNER JOIN module ON module.ID_MODULE = notes.ID_MODULE WHERE notes.ID_ETUDIANT = '$idEtudiante' and 
                module.ID_MODULE = '$idModule'");
                $row3 = mysqli_fetch_array($result);
                $alreadyNote = $row3['NOTE'];
                echo 'note : '. $alreadyNote;
                
               
                if(mysqli_num_rows($result) >0){
                   $_SESSION['module'] ='student number '. $idEtudiante.' already has '.  $alreadyNote . ' in this subject';
                }else{
                    $_SESSION['module'] ='Done !';

                                    mysqli_query($db, "INSERT INTO `notes`(ID_FORMATEUR, ID_ETUDIANT, ID_MODULE, NOTE) VALUES ('$idFrm','$idEtudiante','$idModule','$note')");
                                    $_SESSION['message'] = "la note a été sauvegardé avec succès";
                }
                                    header('location:teacherDash.php?do=msg');
         //test

        
                  
            	
	} 
