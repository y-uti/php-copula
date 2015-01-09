<?php
namespace YUti\Copula;

class UniformDistribution implements Distribution
{
    private $min;
    private $max;

    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function getMin()
    {
        return $this->min;
    }

    public function getMax()
    {
        return $this->max;
    }

    public function __invoke($x)
    {
        return max(0, min(($x - $this->min) / ($this->max - $this->min), 1));
    }
}
