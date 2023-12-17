<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

use Carbon\CarbonImmutable;

abstract class DateTimeValueObject
{
    public function __construct(public readonly CarbonImmutable $value)
    {
    }

    public function isGreaterThan(DateTimeValueObject $time): bool
    {
        return $this->value->gt($time->value);
    }

    public function diffInSeconds(DateTimeValueObject $time): int
    {
        return $this->value->diffInSeconds($time->value);
    }
    
    public function __toString(): string
    {
        return $this->value->toIso8601ZuluString();
    }
}