<?php
session_start();

if (isset($_GET['check'])) {
	unset($_SESSION['Username']);
	session_destroy();
	header("Location: ../Index.html");
}
if (isset($_SESSION['Username'])) {
?>
<html>

<head>
	<title>
		A2Z Computer Service
	</title>

	<!-- Icon for Title----------------------------------------------------------->
	<link rel="icon" href="Images/logo.png" type="image/x-icon">

</head>
<frameset rows="5%,8%,*" noresize border="0">
	<frame src="Pages/Nav/Nav1.php" scrolling="no">
		<frame src="Pages/Nav/Nav2.php" scrolling="no">
			<frame name="main" src="Pages/Home.php">

</frameset>

</html>
<?php
}
else{
	header("Location: ../Index.html");
}
?>