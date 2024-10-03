<?php

namespace Mhcgolds\Harpia;

class HarpiaResult
{
    public bool $result;
    public array $matchedSegments = [];
    public array $unmatchedSegments = [];
    public string $testedPassword;
    public int $strengthPoints = 0;

    public function __construct(private Harpia $parent)
    {
        $this->result = $this->parent->getResult();
        $this->testedPassword = $this->parent->getTestedPassword();
        $segments = $this->parent->getSegments();

        foreach ($segments as $segment) {
            if ($segment->isMatched()) {
                $this->matchedSegments[] = $segment->getSegmentPattern();
                $this->strengthPoints+= $segment->getStrenghtPoints();
            }
            else {
                $this->unmatchedSegments[] = $segment->getSegmentPattern();
            }
        }
    }
}