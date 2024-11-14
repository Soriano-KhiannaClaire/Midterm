<?php
include_once 'PaymentMethod.php';

class CreditCard extends PaymentMethod {
    public function processTransaction($amount) {
        echo "Processing Credit Card payment of $$amount<br>";
    }
}
?>
