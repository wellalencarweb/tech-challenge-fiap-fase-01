<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain\ValueObjects;

use InvalidArgumentException;

final class OrderId
{
    private ?int $value;

    /**
     * OrderId constructor.
     * @param int $id
     * @throws InvalidArgumentException
     */
    public function __construct(?int $id)
    {
        if ($id) {
            $this->validate($id);
        }

        $this->value = $id;
    }

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    private function validate(int $id): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', OrderId::class, $id)
            );
        }
    }

    public function value(): ?int
    {
        return $this->value;
    }

}
