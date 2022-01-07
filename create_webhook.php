<?php
$webhook_call_path='https://9149-171-76-255-79.ngrok.io/shopify/webhooks';
$array_webhook = [
        'webhook' => [
            'topic' => 'orders/paid',
            'address' => $webhook_call_path.'/read_order.php',
            'format' => 'json'
        ]
];

$webhook=shopify_call($token, $shop, "/admin/webhooks.json", $array_webhook, 'POST');

$webhooks=json_decode($webhook['response'], true);

echo "<pre>";
print_r($webhooks);
echo "</pre>";
?>

