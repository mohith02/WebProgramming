<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Die For Fun</title>
<link href='project2.css' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <form action = "signup-submit.php" method="post" name="sign up for beta form">
      <div class="header">
        <img src="dice.jpg" alt="NA">
         <p>Test your luck with Dice</p>
      </div>
      <div class="signup">
        <p style="text-align:center;">Sign up if you are a new user</p></div>
      <div class="input">
				<input type="text" class="button" required id="name" name="name" placeholder="NAME : Web Programming">
			</div >
			<div class="input">
    <input type="text" class="button" required id="email" name="email" placeholder="EMAIL : webprogramming@gmail.com">
      </div>

      <div class="signin">
        <p style="text-align:center;">Returning User?</p></div>
        <p style="text-align:center;"><a href="signin.php" style="color:white;">Sign in here</a></p>


			<div class="checkboxy">

		     <input required name="checky" id="checky" value="1" type="checkbox" /><label class="terms">I accept the terms of use</label>
				 <a class = "tnc" href="TandC.html" style="color:white;">T&C</a>
	</div>
			<div class="input">
				<input type="submit" class="button" id="submit" value="SIGN UP">
			</div>
    </form>

  </body>
</html>
