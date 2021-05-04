<?php

require_once 'vendor/autoload.php';

use sanduhrs\BigBlueButton;

$url = 'http://test-install.blindsidenetworks.com/bigbluebutton/api';
$secret = '8cd8ef52e8e101574e400365b55e11a6';
$endpoint = '/';

// Initialize a BigBlueButton object.
$bbb = new BigBlueButton($url, $secret, $endpoint);
$meeting = $bbb->server->addMeeting([
    'id' => '695-114-822-447',
    'attendeePW' => 'Guphei4i',
    'moderatorPW' => 'ioy9Xep9',
    'name' => 'test meeting',
    'welcome' => 'خوش آمدید.',
    'logoutURL' => 'otapams.org',
    'allowModsToUnmuteUsers' => TRUE,
    'bannerText	' => '',
    'bannerColor' => 'red',
    'record' => 'true',
    'guestPolicy' => 'ASK_MODERATOR',
    'logo' => 'https://online.codynick.com/codynick-logo-banner.png'
    ]);
    if($_GET['role'] == 1) {
        $url = $meeting->join($_GET['name'], true);
        header("Location: $url");
    }
    else if($_GET['role'] == 0) {
        $option = ['guest' => true];
        $url = $meeting->join($_GET['name'],false, $option);
        header("Location: $url");
    }
