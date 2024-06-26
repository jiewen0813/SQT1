<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="css/style.css">
<style>
* {
	box-sizing: border-box;
}

.container{
	position: relative;
	text-align: center;
	border: 1px solid #808080;
	border-radius: 5px;
	background-color:#fafad2	;
	padding: 20px 0 30px;
}

/* style inputs and link buttons */
input,
.btn {
  width: 40%;
  padding: 12px;
  border: 1 px solid #000;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}

input:hover,
.btn:hover {
  opacity: 1;
}

/* style the submit button */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
</style>
</head>
<body>
<header>
<div class="header">
	
</div>
</header>
<main>
<h1 align="center">My Study KPI </h1>
<div class="container">
<h2>User Registration</h2>
<form action="register_action.php" method="post">
	<input type="text" id="userName" name="userName" required placeholder="User Name"><br><br>
	<input type="text" id="studentID" name="studentID" required placeholder="Student ID"><br><br>
	<input type="email" id="userEmail" name="userEmail" required placeholder="User Email"><br><br>
	<input type="password" id="userPwd" name="userPwd" required maxlength="8" placeholder="Password"><br><br>
	<input type="password" id="confirmPwd" name="confirmPwd" required placeholder="Confirm Password"><br><br>
	<input type="submit" value="Register">
</form>
</div>
</main>
<footer>
</footer>
</body>
</html>