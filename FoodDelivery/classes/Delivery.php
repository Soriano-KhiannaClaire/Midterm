<?php
abstract class DeliveryMode {
    protected $orderId;

    public function __construct($orderId) {
        $this->orderId = $orderId;
    }

    abstract public function deliver();
}
?>
