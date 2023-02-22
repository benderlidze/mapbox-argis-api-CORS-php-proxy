<?php
// Get the image URL from the query string parameter
$image_url = $_GET['url'];

// Parse the image URL to extract the query string parameters
$url_parts = parse_url($image_url);
parse_str($url_parts['query'], $query_params);

// Merge the original query string parameters with any additional query string parameters in the request
$query_params = array_merge($query_params, $_GET);

// Reconstruct the image URL with the merged query string parameters
$image_url = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . http_build_query($query_params);

// Set the HTTP response headers to allow CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Pass the image through to the client
header("Content-type: image/png");
echo file_get_contents($image_url);
?>