<?php

class Status implements JsonSerializable
{
    const Available = 'Available';
    const Sold = 'Sold';
    const Expired = 'Expired';

    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function Available(): self
    {
        return new self(self::Available);
    }

    public static function Sold(): self
    {
        return new self(self::Sold);
    }

    public static function Expired(): self
    {
        return new self(self::Expired);
    }

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value->value) {
            self::Available => 'Available',
            self::Sold => 'Sold',
            self::Expired => 'Expired',
            default => throw new InvalidArgumentException("Invalid status value: $value"),
        };
    }
    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
    public static function fromString(string $value): self
    {
        return match ($value) {
            self::Available => self::Available(),
            self::Sold => self::Sold(),
            self::Expired => self::Expired(),
            default => throw new InvalidArgumentException("Invalid status value: $value"),
        };
    }
    public function jsonSerialize() :mixed
    {
        return $this->value;
    }
}


