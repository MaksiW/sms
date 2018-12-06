<?php
include 'db.php';

$text           = $_GET['text'];
$loginInstagram = $_GET['total_sms'];

createTable('sms');
writeDbArray('sms', $text, $loginInstagram);