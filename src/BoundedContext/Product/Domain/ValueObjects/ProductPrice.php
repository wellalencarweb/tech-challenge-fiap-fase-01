<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\ValueObjects;

use InvalidArgumentException;

final class ProductPrice
{
    private float $value;

    /**
     * ProductCpf constructor.
     * @param float $price
     * @throws InvalidArgumentException
     */
    public function __construct(float $price)
    {
        $this->validate($price);
        $this->value = $price;
    }

    /**
     * @param float $price
     * @throws InvalidArgumentException
     */
    private function validate(float $price): void
    {

        if (!$this->validatePrice($price)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the invalid price: <%s>.', ProductPrice::class, $price)
            );
        }
    }

    public function value(): ?float
    {
        return $this->value;
    }

    public function validatePrice(float $price): bool
    {
        if (!is_numeric($price)) {
            return false;
        }

        if (floor($price * 100) != $price * 100) {
            return false;
        }

        return true;
    }
}
