<?php
namespace YUti\Copula;

class JointDistributionByCopula implements JointDistribution
{
    private $copula;
    private $xDist;
    private $yDist;

    public function __construct($copula, $xDist, $yDist)
    {
        $this->copula = $copula;
        $this->xDist = $xDist;
        $this->yDist = $yDist;
    }

    public function getCopula()
    {
        return $this->copula;
    }

    public function getXDist()
    {
        return $this->xDist;
    }

    public function getYDist()
    {
        return $this->yDist;
    }

    public function __invoke($x, $y)
    {
        $copula = $this->copula;
        $xDist = $this->xDist;
        $yDist = $this->yDist;

        return $copula($xDist($x), $yDist($y));
    }
}
