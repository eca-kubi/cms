<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/6/2019
 * Time: 7:25 PM
 * This script will be used to update mtn bill
 * Logic is as follows (very simple):
 *  SELECT ALL SUBSCRIBERS FROM TABLE1
 *  FOR EACH SUBSCRIBER
 *      IF PHONE NUMBER EXISTS
 *          UPDATE TABLE1
 *      ELSE
 *          INSERT NEW SUBSCRIBER (PHONE NUMBER, AMOUNT) INTO TABLE2
 * END
 */
require_once 'autoload.php';
// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'appiahmakuta');
define('DB_PASS', 'gmail300');
define('DB_NAME', 'mtn_subscribers');

const TABLE1 = 'subscribers';
const TABLE2 = 'subscribers2';
$db = Database::getDbh();
$subscribers = [];
$subscribers = $db->objectBuilder()
    ->get(TABLE1);
foreach ($subscribers as $subscriber) {
    $phone = $subscriber->phone;
    $amount = $subscriber->amount;
    $subscriber_exists = $db->where('phone', $phone)
        ->has(TABLE2);
    if ($subscriber_exists) {
        $db->where('phone', $phone,)
            ->update(TABLE2, ['amount' => $amount]);
    } else {
        $db->insert(TABLE2, [
            'phone' => $phone,
            'amount' => $amount
        ]);
    }
}