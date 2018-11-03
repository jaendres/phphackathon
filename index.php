<!DOCTYPE html>
<html>
<head>
<title>FortniteQuotes - Save the World</title>
</head>
<body>
</body>
</html>
<?php

    $phrase = array(
        'jonesy1' => 'Bullets, Swords and grenades. Monsters better be afraid of me!',
        'hawk' => 'You See this, husks? Im dancing on your graves!',
        'renegade' => 'Im back again, like shackleton, im bizzarre-o like pizarro and magellan. Word to da Gama.',
        'jess' => 'Give me a minuet im dancing!'
    );

    require_once(__DIR__ . '/vendor/autoload.php');
echo "2";
/**
    $rcsdk = new RingCentral\SDK\SDK(getenv('RINGCENTRAL_CLIENT_ID'), getenv('RINGCENTRAL_CLIENT_SECRET'), getenv('RINGCENTRAL_SERVER_URL'));

    $platform = $rcsdk->platform();
echo "3-";
    $platform->login(getenv('RINGCENTRAL_USERNAME'), getenv('RINGCENTRAL_EXTENSION'), getenv('RINGCENTRAL_PASSWORD'));

    $r = $platform->post('/account/~/extension/~/sms', array(
        'from' => array('phoneNumber' => getenv('RINGCENTRAL_USERNAME')),
        'to' => array(
            array('phoneNumber' => getenv('RINGCENTRAL_RECEIVER')),
        ),
        'text' => $phrase['jess'],
    ));
echo "4";
    print_r($r->json()->id);
 */

$rcsdk = new RingCentral\SDK\SDK(getenv('RINGCENTRAL_CLIENT_ID'), getenv('RINGCENTRAL_CLIENT_SECRET'), getenv('RINGCENTRAL_SERVER_URL'));
$platform = $rcsdk->platform();
// Authorize
$platform->login(getenv('RINGCENTRAL_USERNAME'), getenv('RINGCENTRAL_EXTENSION'), getenv('RINGCENTRAL_PASSWORD'));
// Make a call
$response = $platform->post('/account/~/extension/~/ringout', array(
    'from' => array('phoneNumber' => getenv('RINGCENTRAL_USERNAME')),
    'to'   => array('phoneNumber' => getenv('RINGCENTRAL_RECEIVER'))
));
$json = $response->json();
$lastStatus = $json->status->callStatus;
// Poll for call status updates
while ($lastStatus == 'InProgress') {
    $current = $platform->get($json->uri);
    $currentJson = $current->json();
    $lastStatus = $currentJson->status->callStatus;
    print 'Status: ' . json_encode($currentJson->status) . PHP_EOL;
    sleep(2);
}
print 'Done.' . PHP_EOL;

?>