<?php

class Company {
    protected $id;
    protected $name;
    protected $field;
    protected $description;
    protected $tags;

    public function __construct($id = '', $name = '', $field = '', $description = '', $tags = '') {
        $this->id = $id;
        $this->name = $name;
        $this->field = $field;
        $this->description = $description;
        $this->tags = $tags;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): Company {
        $this->name = $name;
        return $this;
    }

    public function getField(): string {
        return $this->field;
    }

    public function setField(string $field): Company {
        $this->field = $field;
        return $this;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): Company {
        $this->description = $description;
        return $this;
    }

    public function getTags(): string {
        return $this->tags;
    }

    public function setTags(string $tags): Company {
        $this->tags = $tags;
        return $this;
    }
}

?>