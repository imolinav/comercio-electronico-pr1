<?php 

class Product {
    protected $id;
    protected $name;
    protected $company_id;
    protected $price;
    protected $offer;
    protected $description;

    public function __construct($id = '', $name = '', $company_id = '', $price = '', $offer = '', $description = '') {
        $this->id = $id;
        $this->name = $name;
        $this->company_id = $company_id;
        $this->price = $price;
        $this->offer = $offer;
        $this->description = $description;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): Product {
        $this->name = $name;
        return $this;
    }

    public function getCompanyId(): int {
        return $this->company_id;
    }

    public function setCompanyId(int $company_id): Product {
        $this->company_id = $company_id;
        return $this;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setPrice(float $price): Product {
        $this->price = $price;
        return $this;
    }

    public function getOffer(): float {
        return $this->offer;
    }

    public function setOffer(float $offer): Product {
        $this->offer = $offer;
        return $this;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): Product {
        $this->description = $description;
        return $this;
    }
}

?>