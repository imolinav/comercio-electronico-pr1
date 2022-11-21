<?php

class PaymentType {
    protected $id;
    protected $type;

    public function __construct($id = '', $type = '') {
        $this->id = $id;
        $this->type = $type;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): PaymentType {
        $this->type = $type;
        return $this;
    }
}

?>