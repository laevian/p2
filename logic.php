<?php

/*
The following code scrapes the page at http://www.ccc.commnet.edu/grammar/misspelled_words.htm for the table of words it contains, cleans the data, and then generates a password using four words picked at random from the array of words.

*/

$rawdata = file_get_contents("http://www.ccc.commnet.edu/grammar/misspelled_words.htm");

$dom = new domDocument; 

@$dom->loadHTML($rawdata); # loads the HTML into the domDocument

$tables = $dom->getElementsByTagName('table'); # grabs all of the tables from the HTML

foreach ($tables as $table => $data) { # cycles through $tables array until it gets to the one I want, and then dumps the values into $wordTable.
	
	$wordTable = $tables[3];
    # echo $data->nodeValue, PHP_EOL; # on each cycle, outputs the data from the processed table
}

$wordList = $wordTable->nodeValue; # takes the entire set of words from DOMElement wordTable, makes it new string wordList.
$words = explode(" ", $wordList); # turns wordList into an array.
$wordCount = count($words);

		$error = NULL;
		$password = "";
		$numOfWords = $_GET["numOfWords"];
	
	if ($_GET["numOfWords"] == NULL)
	{
		$numOfWords = 4;
	}
	
	else if ($_GET["numOfWords"] == "0" OR is_numeric($_GET["numOfWords"]) == false)
	{
		$error = "The Number of Words input field only accepts numbers between 1 and 9. Please change your input and try again.";
		$numOfWords = 4;
	}


	for ($i = 0; $i < $numOfWords; $i++)
	{
		
		if ($i == 0)
		{
			$randWord = rand(0, $wordCount-1); #generates a number 
			$wordChoice = $words[$randWord];
			$password = $wordChoice;
		}
		
		else if ($i > 0)
		{
			$randWord = rand(0, $wordCount-1); #generates a number 
			$wordChoice = $words[$randWord];
			$password = $password."-".$wordChoice;	
		}
	}
	
	if (isset($_GET["symbol"])){
		$symbolArray = ["~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "="];
		$randSymbol = rand(0, 13);
		$symbolChoice = $symbolArray[$randSymbol];
		$password = $password."-".$symbolChoice;
		
	}
	
	if (isset($_GET["number"])){
		$randNumber = rand(0, 9);
		$password = $password."-".$randNumber;
	}
	
	return $password;
	
?>