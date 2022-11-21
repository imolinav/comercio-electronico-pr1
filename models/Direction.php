<?php

class Direction {
    protected $id;
    protected $user_id;
    protected $name;
    protected $surname;
    protected $street;
    protected $postal_code;
    protected $country;
    protected $phone;
    protected $email;

    public function __construct($id = '', $user_id = '', $name = '', $surname = '', $street = '', $postal_code = '', $country = '', $phone = '', $email = '') {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->surname = $surname;
        $this->street = $street;
        $this->postal_code = $postal_code;
        $this->country = $country;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): Direction {
        $this->user_id = $user_id;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): Direction {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname(string $surname): Direction {
        $this->surname = $surname;
        return $this;
    }

    public function getStreet(): string {
        return $this->street;
    }

    public function setStreet(string $street): Direction {
        $this->street = $street;
        return $this;
    }

    public function getPostalCode(): int {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): Direction {
        $this->postal_code = $postal_code;
        return $this;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function setCountry(string $country): Direction {
        $this->country = $country;
        return $this;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function setPhone(string $phone): Direction {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): Direction {
        $this->email = $email;
        return $this;
    }
}

?>