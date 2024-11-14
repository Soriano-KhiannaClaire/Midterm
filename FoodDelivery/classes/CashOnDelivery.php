<?php
include_once 'PaymentMethod.php';

class CashOnDelivery extends PaymentMethod {
    public function processTransaction($amount) {
        echo "Processing Cash on Delivery payment of $$amount<br>";
    }
}
?>
