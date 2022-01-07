<?php

// Get our helper functions
require_once("inc/functions.php");

// Set variables for our request
$shop = "mymoodlecourse";
$token = "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";
$query = array(
	"Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);

// Run API call to get products
$products = shopify_call($token, $shop, "/admin/products/6661594153039/metafields.json");

// Convert product JSON information into an array
$products = json_decode($products['response'], TRUE);

// Get the ID of the first product

echo "<pre>";
print_r($products);
echo "</pre>";