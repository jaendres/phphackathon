
<?php
echo "1";
    $phrase = array(
        'jonesy1' => 'Bullets, Swords and grenades. Monsters better be afraid of me!',
        'hawk' => 'You See this, husks? Im dancing on your graves!',
        'renegade' => 'Im back again, like shackleton, im bizzarre-o like pizarro and magellan. Word to da Gama.',
        'jess' => 'Give me a minuet im dancing!'
    );

    require_once(__DIR__ . '/../vendor/autoload.php');
echo "2";
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__.'/.env');

    $rcsdk = new RingCentral\SDK\SDK(getenv('RINGCENTRAL_CLIENT_ID'), getenv('RINGCENTRAL_CLIENT_SECRET'), getenv('RINGCENTRAL_SERVER_URL'));

    $platform = $rcsdk->platform();
echo "3";
    $platform->login(getenv('RINGCENTRAL_USERNAME'), getenv('RINGCENTRAL_EXTENSION'), getenv('RINGCENTRAL_PASSWORD'));

    $r = $platform->post('/account/~/extension/~/sms', array(
        'from' => array('1234567890' => getenv('RINGCENTRAL_USERNAME')),
        'to' => array(
            array('6085135286' => getenv('RINGCENTRAL_RECEIVER')),
        ),
        'text' => $phrase['jess'],
    ));
echo "4";
    print_r($r->json()->id);

?>