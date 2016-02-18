<?php

	/*
	The following code scrapes the page at http://www.ccc.commnet.edu/grammar/misspelled_words.htm for the table of words it contains, cleans the data, and then generates a password using four words picked at random from the array of words.

	*/

	$rawdata = file_get_contents("http://www.ccc.commnet.edu/grammar/misspelled_words.htm");

	$dom = new domDocument; 

	@$dom->loadHTML($rawdata); # loads the HTML into the domDocument

	$tables = $dom->getElementsByTagName('table')->item(3); # grabs all of the tables from the HTML
	
/*	foreach ($tables as $data) { # cycles through $tables to pull out the word table
		$wordTable = (array)$tables;
	}*/

	$wordList = $tables->nodeValue; # dumps DOMElement data into a string
	$words = explode(" ", $wordList); # dumps string data into an array
	$wordCount = count($words); #upper limit for rand

	$error = NULL; #resets the error, if it has been set before
	$password = "";
	$numOfWords = $_GET["numOfWords"];
		
	if ($_GET["numOfWords"] == NULL){ #Initial page load case
		$numOfWords = 4;
	}
		
	else if ($_GET["numOfWords"] == "0" OR is_numeric($_GET["numOfWords"]) == false){ #error catching
		$error = "The Number of Words input field only accepts numbers between 1 and 9. Please change your input and try again.";
		$numOfWords = 4;
	}


	for ($i = 0; $i < $numOfWords; $i++) #loop to process user input
	{
		
		if ($i == 0) #sets the first word (no - needed), then proceeds to the else if
		{
			$randWord = rand(0, $wordCount-1);
			$wordChoice = $words[$randWord];
			$password = $wordChoice;
		}
			
		else if ($i > 0)#concats password thus far with -[new word]
		{
			$randWord = rand(0, $wordCount-1);
			$wordChoice = $words[$randWord];
			$password = $password."-".$wordChoice;
		}
	}
		
	if (isset($_GET["symbol"])){ #concats password with a symbol if checkbox is ticked
		$symbolArray = ["~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "="];
		$randSymbol = rand(0, 13);
		$symbolChoice = $symbolArray[$randSymbol];
		$password = $password."-".$symbolChoice;
			
	}
		
	if (isset($_GET["number"])){ #concats password with a number if checkbox is ticked
		$randNumber = rand(0, 9);
		$password = $password."-".$randNumber;
	}
		
	
?>