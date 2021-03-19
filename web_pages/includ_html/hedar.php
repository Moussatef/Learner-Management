<?php 
session_start();
  if(isset($_GET['logout'])){
    // unset($_SESSION['ID_ETD']); unset($_SESSION['Email_ETD']);unset($_SESSION['ID_ADM']);unset($_SESSION['ID_FRM']);
	session_destroy();
    header('Location: index.php');
}
?>
	</head>
	<body>
		<header class="header">
			<a href="" class="logo">HOWARD</a>
			<input class="menu-btn" type="checkbox" id="menu-btn" />
			<label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
			<ul class="menu">
                <?php if(!empty($_SESSION['ID_FRM']) || !empty($_SESSION['ID_ETD']) || !empty($_SESSION['ID_ADM']) ){ ?>
                    <li><a href="<?php echo $_SESSION['LogOut']; ?>"  >Logout </a></li>
                    <li><a href="<?php echo $_SESSION['Profil']; ?>">Profile</a></li>
                    <?php } else { ?>
				<li><a href="page_login.php">Login</a></li>
                <?php } ?>
				<li><a href="Page_contactUS.php">Contact Us</a></li>
				<li><a href="index.php">HOME</a></li>
			</ul>
		</header>