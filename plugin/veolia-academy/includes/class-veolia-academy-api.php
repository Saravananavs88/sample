<?php

/**
 * Define the API functionality
 *
 * Loads and defines the API files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/includes
 */

/**
 * Define the API functionality.
 *
 * Loads and defines the API files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/includes
 * @author     Arunkumar <arunkumar.ravindran@zucisystems.com>
 */
class Veolia_Academy_API
{

	public function callAPI($method, $url, $data, $header = 'xml')
	{
		global $api_headers, $api_headers_json;


		if ($header == 'json')
			$header = $api_headers_json;
		else
			$header = $api_headers;

		$curl = curl_init();
		switch ($method) {
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);
				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "PUT":
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "DELETE":
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			default:
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
				if ($data)
					$url = sprintf("%s?%s", $url, http_build_query($data));
		}
		// OPTIONS:
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		// EXECUTE:
		$xml_response = curl_exec($curl);


		curl_close($curl);
		$xml_data = simplexml_load_string($xml_response, "SimpleXMLElement", LIBXML_NOCDATA);
		$json   = json_encode($xml_data);
		$result = json_decode($json, TRUE);
		return $result;
	}
}
