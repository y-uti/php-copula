<?php
namespace YUti\Copula;

class NormalDistribution implements Distribution
{
    private $mean;
    private $stddev;

    public function __construct($mean = 0, $stddev = 1)
    {
        $this->mean = $mean;
        $this->stddev = $stddev;
    }

    public function __invoke($x)
    {
        return stats_cdf_normal($x, $this->mean, $this->stddev, 1);
    }
}
