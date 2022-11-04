<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Die For Fun</title>
<link href='project2.css' rel='stylesheet' type='text/css'>
  </head>
	<body>

	<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="game.php">Game</a></li>
	<li><a class = "active" href="#about">About</a></li>
	<li><a href="contact.html">Contact</a></li>
	<li><a href="summary.html">Summary</a></li>
	</ul>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['name'];	
	$cookie_name = "user";
	setcookie($cookie_name, $name);
	
    if (empty($name) && isset($_COOKIE["user"])) {
		$val = $_COOKIE["user"];
    } else {    
		$val = $name;	
    }
}
else{
	$val = $_COOKIE["user"];
}
?>
<div class="welcome">
	<p>Welcome <?= $val?>!</p>
</div>
   <div class="header">
		 <p>The Dice Game | Fun Game For Kids And Adults</p>
	</div>


	<div class="aboutusdescription">
		<p>  Hey! This is a board game in which dice are rolled. Each player gets a chance to roll in this game.
The die will determine how many positions each player advances.
The score is reduced proportionally in danger positions.<p></p>
</div>
<img src="dice6.png" alt="Paris" class="center">

</body>
</html>
