<?php
abstract class PaymentMethod {
    abstract public function processTransaction($amount);
}
?>
