<?php

class ProductRating {
    protected $id;
    protected $product_id;
    protected $user_id;
    protected $rating;
    protected $comment;
    protected $utility;

    public function __construct($id = '', $product_id = '', $user_id = '', $rating = '', $comment = '', $utility = '') {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->utility = $utility;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getProductId(): int {
        return $this->product_id;
    }

    public function setProductId(int $product_id): ProductRating {
        $this->product_id = $product_id;
        return $this;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): ProductRating {
        $this->user_id = $user_id;
        return $this;
    }

    public function getRating(): int {
        return $this->rating;
    }

    public function setRating(int $rating): ProductRating {
        $this->rating = $rating;
        return $this;
    }

    public function getComment(): string {
        return $this->comment;
    }

    public function setComment(string $comment): ProductRating {
        $this->comment = $comment;
        return $this;
    }

    public function getUtility(): int {
        return $this->utility;
    }

    public function setUtility(int $utility): ProductRating {
        $this->utility = $utility;
        return $this;
    }
}

?>