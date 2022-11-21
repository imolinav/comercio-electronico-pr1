<?php

class Purchase {
    protected $id;
    protected $user_id;
    protected $user_direction;
    protected $user_payment;
    protected $discount_id;
    protected $finished_at;

    public function __construct($id = '', $user_id = '', $user_direction = '', $user_payment = '', $discount_id = '', $finished_at = '') {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->user_direction = $user_direction;
        $this->user_payment = $user_payment;
        $this->discount_id = $discount_id;
        $this->finished_at = $finished_at;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): Purchase {
        $this->user_id = $user_id;
        return $this;
    }

    public function getUserDirection(): int {
        return $this->user_direction;
    }

    public function setUserDirection(int $user_direction): Purchase {
        $this->user_direction = $user_direction;
        return $this;
    }

    public function getUserPayment(): int {
        return $this->user_payment;
    }

    public function setUserPayment(int $user_payment): Purchase {
        $this->user_payment = $user_payment;
        return $this;
    }

    public function getDiscountId(): int {
        return $this->discount_id;
    }

    public function setDiscountId(int $discount_id): Purchase {
        $this->discount_id = $discount_id;
        return $this;
    }

    public function getFinishedAt(): Date {
        return $this->finished_at;
    }

    public function setFinishedAt(Date $finished_at): Purchase {
        $this->finished_at = $finished_at;
        return $this;
    }
}

?>