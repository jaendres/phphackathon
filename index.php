<!DOCTYPE html>
<html>
<head>
<title>FortniteQuotes - Save the World</title>
</head>
<body>
<form action="/" method="post">
Phone Number Here <br>
<input type="text" name="PhoneNumber" value=""> <br>
<input type="text" name="CharacterName" value=""> <br>
<input type="submit" value="Your Quote Should Be Sent!">
</body>
</html>
<?php

    $phrase = array(
        'jonesy1' => 'Bullets, Swords and grenades. Monsters better be afraid of me!',
        'hawk' => 'You See this, husks? Im dancing on your graves!',
        'renegade' => 'Im back again, like shackleton, im bizzarre-o like pizarro and magellan. Word to da Gama.',
        'jess' => 'Give me a minute im dancing!'
    );

    require_once(__DIR__ . '/vendor/autoload.php');
echo "2";
/**



    $rcsdk = new RingCentral\SDK\SDK(getenv('RINGCENTRAL_CLIENT_ID'), getenv('RINGCENTRAL_CLIENT_SECRET'), getenv('RINGCENTRAL_SERVER_URL'));
    $platform = $rcsdk->platform();
    // Authorize
    $platform->login(getenv('RINGCENTRAL_USERNAME'), getenv('RINGCENTRAL_EXTENSION'), getenv('RINGCENTRAL_PASSWORD'));
    // Make a call
    $response = $platform->post('/account/~/extension/~/ringout', array(
        'from' => array('phoneNumber' => getenv('RINGCENTRAL_USERNAME')),
        'to'   => array('phoneNumber' => $_POST['PhoneNumber'])
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
    
    print $phrase[$_POST['CharacterName']];
 

*/

if( $_POST['PhoneNumber'] != '' AND $_POST['CharacterName'] != '' ){


    $rcsdk = new RingCentral\SDK\SDK(getenv('RINGCENTRAL_CLIENT_ID'), getenv('RINGCENTRAL_CLIENT_SECRET'), getenv('RINGCENTRAL_SERVER_URL'));

    $platform = $rcsdk->platform();

    $platform->login(getenv('RINGCENTRAL_USERNAME'), getenv('RINGCENTRAL_EXTENSION'), getenv('RINGCENTRAL_PASSWORD'));

    $r = $platform->post('/account/~/extension/~/sms', array(
        'from' => array('phoneNumber' => '+19492648959'),
        'to' => array(
            array('phoneNumber' => $_POST['PhoneNumber']),
        ),
        'text' => $phrase[$_POST['CharacterName']],
    ));
}


?>