<?php

namespace Mhcgolds\Harpia;

class Harpia
{
    private const DEFAULT_STRENGTH_POINTS = 1;

    private string $regexp;
    private string $testedPassword;
    private array $segments = [];
    private bool $result;

    public function addSegment(EPatern $pattern): Harpia
    {
        $this->segments[]= new HarpiaSegment($pattern, strengthPoints: self::DEFAULT_STRENGTH_POINTS);
        return $this;
    }

    public function addAlphaAll(): Harpia
    {
        return $this->addSegment(EPatern::ALPHA_ALL);
    }

    public function addAlphaLowerCase(): Harpia
    {
        return $this->addSegment(EPatern::ALPHA_LOWERCASE);
    }

    public function addAlphaUpperCase(): Harpia
    {
        return $this->addSegment(EPatern::ALPHA_UPPERCASE);
    }

    public function addNumeric(): Harpia
    {
        return $this->addSegment(EPatern::NUMERIC);
    }

    public function addSpecialChars(): Harpia
    {
        return $this->addSegment(EPatern::SPECIAL_CHARS);
    }

    public function addCustomPattern(string $regex, int $strengthPoints = 1): Harpia
    {
        $this->segments[]= new HarpiaSegment(customPattern: $regex, strengthPoints: $strengthPoints);
        return $this;
    }

    public function check(string $password): HarpiaResult
    {
        if (count($this->segments) === 0) {
            throw new HarpiaException('No segments provided');
        }

        if (empty($password)) {
            throw new HarpiaException('No password provided');
        }

        $this->testedPassword = $password;
        $this->result = $this->testPassword();

        return new HarpiaResult($this);
    }

    private function testPassword(): bool
    {
        $regexp = [];
        foreach ($this->segments as $segment) {
            $regexp[]= '([' . $segment->getSegmentPattern() . ']+)';
        }

        $this->regexp = '/' . implode('|', $regexp) . '/';
        preg_match_all($this->regexp, $this->testedPassword, $output_array);
        $matches = 0;

        foreach ($output_array as $index => $regexMatches)
        {
            if ($index > 0)
            {
                foreach ($regexMatches as $regexMatch) {
                    if (!empty($regexMatch)) {
                        $this->segments[($index - 1)]->setMatched(true);
                        $matches++;
                        break;
                    }
                }
            }
        }

        return ($matches === count($this->segments));
    }

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getSegments(): array
    {
        return $this->segments;
    }

    public function getTestedPassword(): string
    {
        return $this->testedPassword;
    }
}