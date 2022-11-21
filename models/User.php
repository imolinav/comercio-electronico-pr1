<?php

class User {
    protected $id;
    protected $name;
    protected $surname;
    protected $email;
    protected $birth_date;

    public function __construct($id = '', $name = '', $surname = '', $email = '', $birth_date = '') {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->birth_date = $birth_date;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): User {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname(string $surname): User {
        $this->surname = $surname;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): User {
        $this->email = $email;
        return $this;
    }

    public function getBirthDate(): string {
        return $this->birth_date;
    }

    public function setBirthDate(string $birth_date): User {
        $this->birth_date = $birth_date;
        return $this;
    }
}

?>