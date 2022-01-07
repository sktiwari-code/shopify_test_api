<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "964feeefcee11ac893e9208742187a46";
$scopes = "read_orders,write_products,read_products";
$redirect_uri = "http://localhost/shopify/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();