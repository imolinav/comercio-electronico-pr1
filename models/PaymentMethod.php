<?php

class PaymentMethod {
    protected $id;
    protected $user_id;
    protected $payment_type;
    protected $paypal_user;
    protected $credit_card;

    public function __construct($id = '', $user_id = '', $payment_type = '', $paypal_user = '', $credit_card = '') {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->payment_type = $payment_type;
        $this->paypal_user = $paypal_user;
        $this->credit_card = $credit_card;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): PaymentMethod {
        $this->user_id = $user_id;
        return $this;
    }

    public function getPaymentType(): int {
        return $this->payment_type;
    }

    public function setPaymentType(int $payment_type): PaymentMethod {
        $this->payment_type = $payment_type;
        return $this;
    }

    public function getPaypalUser(): string {
        return $this->paypal_user;
    }

    public function setPaypalUser(string $paypal_user): PaymentMethod {
        $this->paypal_user = $paypal_user;
        return $this;
    }

    public function getCreditCard(): string {
        return $this->credit_card;
    }

    public function setCreditCard(string $credit_card): PaymentMethod {
        $this->credit_card = $credit_card;
        return $this;
    }
}

?>