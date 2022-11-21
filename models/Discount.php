<?php

class Discount {
    protected $id;
    protected $code;
    protected $quantity;
    protected $discount_type;
    protected $valid_until;

    public function __construct($id = '', $code = '', $quantity = '', $discount_type = '', $valid_until = '') {
        $this->id = $id;
        $this->code = $code;
        $this->quantity = $quantity;
        $this->discount_type = $discount_type;
        $this->valid_until = $valid_until;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getCode(): string {
        return $this->code;
    }

    public function setCode(string $code): Discount {
        $this->code = $code;
        return $this;
    }

    public function getQuantity(): float {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): Discount {
        $this->quantity = $quantity;
        return $this;
    }

    public function getDiscountType(): int {
        return $this->discount_type;
    }

    public function setDiscountType(int $discount_type): Discount {
        $this->discount_type = $discount_type;
        return $this;
    }

    public function getValidUntil(): string {
        return $this->valid_until;
    }

    public function setValidUntil(string $valid_until): Discount {
        $this->valid_until = $valid_until;
        return $this;
    }
}

?>