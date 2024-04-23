<?php
	include('conn.php');
	require __DIR__ .'/simplehtmldom_1_9_1/simple_html_dom.php';
	
	// for loop x3 or some other number
	for ($i = 0; $i < 3; $i++) {
	
		$random_array = array();
		
		for ($x = 0; $x < 2; $x++) {
			// generate a random topic
			$result = mysqli_query($conn, "SELECT topic FROM topics ORDER BY Rand() LIMIT 1");
			$word = mysqli_fetch_assoc($result);
				
			// Create a DOM object from a URL
			$topic = str_replace(" ", "%20", $word['topic']);
			$url = "https://relatedwords.org/relatedto/";
			$url .= $topic;
			$html = file_get_html($url);
			
			$words = array();

			// Find all anchor tags and add their visible text to the $words array
			foreach($html->find('.words li') as $element) {
				   $words[] = $element->innertext;
			}
			
			// generate a random number out of the words array
			$random = $words[array_rand($words)];
			if (rand(0, 2) > 0) {
			  $random = ucfirst($random);
			}
			$random_array[] = $random;
		}
		
		// Randomly chooses between a verb or an adj; save in var $line
		if (rand(0, 1) == 0) {
		  $f_contents = file("verbs.txt");
		  $line = $f_contents[array_rand($f_contents)];
		  // Randomly capitalize the first letter of words
		  if (rand(0, 2) > 0) {
			$line = ucfirst($line);
		  }
		  array_splice( $random_array, 1, 0, trim($line)); // splice in at position 1
		}
		else {
		  $f_contents = file("adjs.txt");
		  $line = $f_contents[array_rand($f_contents)];
		  if (rand(0, 2) > 0) {
			$line = ucfirst($line);
		  }
		  array_unshift($random_array, trim($line));
		}

		// This combines words in the array $words with a random symbol
		$symbols = array(
		  "!", ",", "&", 
		  "^", ".", "#", 
		  "@", "?", "*",
		  "0", "1", "2",
		  "3", "4", "5",
		  "6", "7", "8",
		  "9"
		);

		$long = "";

		foreach ($random_array as $r) {
		  $long .= $r . $symbols[array_rand($symbols)];
		}
			
		mysqli_query($conn,"insert into `generated_passwords` (password) values ('$long')");
			
	}
	
	header('location:main.php');	
	
	// make a random array of words composed of words related to topic
		// generate a random word related to topic
		// do above a bunch of times + save into a single array
	// join those words together
	// echo final product
	
	// if you want to put the final product in main.php, save (post) the generated word to a new table and then get the table from main.php
?>