<!DOCTYPE html>
<html>
<head>
<title>Login</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
<div class="header">
</div>
<h1 align="center">My Study KPI</h1>
<nav class="nav">
		<a href="index.php">HOME</a>
		<a href="register.php">REGISTER</a>
	</nav>
<main>
<div class="container">
<h2>Login</h2>
<form action="login_action.php" method="post">
	<input type="email" id="userEmail" name="userEmail" required placeholder="User Email"><br><br>
	<input type="password" id="userPwd" name="userPwd" required maxlength="8" placeholder="Password"><br><br>
	<input type="submit" value="Login"><br>

</form>
</div>
</main>
<footer>
	<small><i>Copyright &copy; 2023 - Leong Jie Wen</i></small>
	</footer>
</body>
</html>