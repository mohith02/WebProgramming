<?php include("index.php"); ?>

<?php
$userName = $_POST["name"];
$email = $_POST["email"];

/* Confirm that values are present before accessing them. */
if(isset($_POST['name'])) {
    $user['name'] = urlencode($_POST['name']);
}
if(isset($_POST['email'])) {
    $user['email'] = urlencode($_POST['email']);
}

/* check: names cannot be digits */
if (preg_match("/[0-9]/", $_POST["name"]) === 1) {
    $errors[] = "Name cannot be digits";

}

/* alphabetic letters with the first letter of each world capitalized. */
$words = explode(" ", $user["name"]);
for ($i = 0; $i < count($words); $i++) {
    if(strcmp(ucfirst($words[$i]),$words[$i]) !== 0) {
        $errors[] = "Name must be capitalized";
        break;
    }
}
$words = explode(" ", $user["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Invalid email format";
}

/* Write to singles.txt after validation. */
if (empty($errors)) {
    //parse form details into a one line
    $user_details = $user;
    $to_write = implode(",", $user_details);
    file_put_contents("singles2.txt", PHP_EOL.$to_write, FILE_APPEND);
?>
    <pre>
        Thank you for signing up
        Now <a href="signin.php">Log in to Play!</a>
    </pre>
<?php
}
else {
?>
	<h1>Error! Invalid data.</h1>
	<p>
		We're sorry.  You submitted invalid user information.
		Please try again.
        Note: Check if first letter in NAME is capitalized or check email.
	</p>
<?php
}
?>
