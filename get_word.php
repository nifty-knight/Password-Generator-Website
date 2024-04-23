<?php
	require __DIR__ .'/simplehtmldom_1_9_1/simple_html_dom.php';
	
	// Create a DOM object from a URL
	$topic = str_replace(" ", "%20", "warrior");
	$url = "https://relatedwords.org/relatedto/";
	$url .= $topic;
	$html = file_get_html($url);
	
	$words = array();

	// Find all anchor tags and add their visible text to the $words array
	foreach($html->find('.words li') as $element) {
		   array_push($words, $element->innertext);
	}
	
	// generate a random number out of the words array and print the word at that index
	echo $words[array_rand($words)];	

/*
	// Find all anchor tags and print their href attributes
	foreach($html->find('.words') as $element) {
	   foreach ($element->find('li') as $word) {
		   array_push($words, $word->innertext);
	    }
	}
	
*/

	// how to post a random word?
		// use GET on main to get the word
		// or just save to an array or to a database
?>