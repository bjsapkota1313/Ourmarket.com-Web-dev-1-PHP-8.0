<?php
require_once __DIR__ . "/User.php";
require_once __DIR__ . "/Status.php";

class Ad implements jsonSerializable
{
    private int $id;
    private string $productName;
    private string $description;
    private string $postedDate;
    private float $price;
    private string $imageUri;
    private User $user;
    private Status $status;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getImageUri(): string
    {
        return $this->imageUri;
    }

    /**
     * @param string $imageUri
     */
    public function setImageUri(string $imageUri): void
    {
        $this->imageUri = $imageUri;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return String
     */
    public function getPostedDate(): string
    {
        return $this->postedDate;
    }

    /**
     * @param String $postedDate
     */
    public function setPostedDate(string $postedDate): void
    {
        $this->postedDate = $postedDate;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
    public function __equals($other): bool
    {
        return $this->id === $other->id;
    }
}
