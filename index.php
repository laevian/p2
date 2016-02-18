<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<head>

	<title>Leslie Pocklington P2</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<?php require('logic.php'); ?>


</head>
<body>

	<div class="container">
	
		<div class="bodytext">
		
		<h1>XKCD-Style Password Generator</h1><br>
		
		Looking for a challenge? This password generator is designed to produce passwords containing the most misspelled words in the English dictionary.<br><br>

		
		<div class="passwordOutput"><?php echo $password ?></div><br>
		
		<div class="errorOutput"><?php echo @$error; ?></div><br>
		
		<form action="index.php" method="GET">
			<label>Number of Words</label><br>
			<input type="text" name="numOfWords" maxlength=1 size="2"> (9 max)
			<label><br><br>
				<input type="checkbox" name="symbol" value="hasSymbol">Add Symbol
			</label><br>
			<label>
				<input type="checkbox" name="number" value="hasNumber">Add Number
			</label><br><br>
			<input type="submit" value="Generate Password">
		</form>			
	
			
			<p class="projectlinks">
			P1 <a href="https://github.com/laevian/p1">Github</a> / <a href="http://p1.lpocklin.me/">Live</a><br>
			P2 Github<br>
			P3 Github / Live<br>
			P4 Github / Live<br>
		</p>

		</div>

	
	</div>

</body>
</html>