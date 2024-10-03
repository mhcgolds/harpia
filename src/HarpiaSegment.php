<?php

namespace Mhcgolds\Harpia;

class HarpiaSegment
{
    private bool $matched = false;

    public function __construct(private ?EPatern $pattern = null, private ?string $customPattern = null, private int $strengthPoints = 1)
    {
    }

    public function getSegmentPattern(): string
    {
        if ($this->pattern !== null) {
            return $this->pattern->value;
        }
        else if ($this->customPattern !== null) {
            return $this->customPattern;
        }

        throw new HarpiaException('No pattern defined for segment');
    }

    public function isMatched(): bool
    {
        return $this->matched;
    }

    public function setMatched(bool $matched): void
    {
        $this->matched = $matched;
    }

    public function getStrenghtPoints(): int
    {
        return $this->strengthPoints;
    }
}