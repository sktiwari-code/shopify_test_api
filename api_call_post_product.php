<?php

// Get our helper functions
require_once("inc/functions.php");

// Set variables for our request
$shop = "mymoodlecourse";
$token = "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";
$query = array(
	"Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);

// Modify product data
$product_data = [
	"product" => [
        "title" => "PHP Programing2",
        "body_html" => "<strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.!</strong>",
        "vendor" => "moodle course",
        "product_type" => "course",
        "status" => "draft",
        "metafields" => [
            [
            "namespace" => "course",
            "key" => "courseid",
            "value" => "65",
            'value_type' => 'string'
          ]
          ]
            ]
        ];

// Run API call to modify the product
//$modified_product = shopify_call($token, $shop, "/admin/products.json", $product_data, 'POST');
echo "<pre>";
print_r($modified_product);
echo "</pre>";