<?php

	/**
	 * Simplified curl call.  Returns the result on true or false on failure.
	 * 
	 * @param  string  $url    The URL to hit with the curl call.
	 * @param  array   $fields The fields to POST to that url.
	 * @param  boolean $head   Weather to include the header as part of the response.
	 * @return [type]          The full response on success or false on failure.
	 */
	function jdCurl($url, $fields, $head = FALSE) {
		// Initialize curl
		$ch = curl_init();
		// Set the curl options
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);
		curl_setopt($ch,CURLOPT_HEADER, TRUE);
		// Get the response
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		// Split the header and body parts
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header = substr($response, 0, $header_size);
		$body = substr($response, $header_size);
		// Close curl
		curl_close($ch);
		// If the header option was set to true
		if ($head === TRUE) {
			// Return the header and body
			return array(
				'header' => trim($header),
				'info' => $info,
				'body' => $body
			);
		} else {
			// Return the body
			return array(
				'info' => $info,
				'body' => $body
			);
		}
	}

?>
