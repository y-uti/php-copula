<?php
namespace YUti\Copula;

class JointDensity
{
    private $distribution;
    private $delta;

    public function __construct(JointDistribution $distribution, $delta)
    {
        $this->distribution = $distribution;
        $this->delta = $delta;
    }

    public function __invoke($x, $y)
    {
        $dist = $this->distribution;
        $d = $this->delta;

        $numer =
            $dist($x + $d, $y + $d)
            - $dist($x + $d, $y)
            - $dist($x, $y + $d)
            + $dist($x, $y);

        return $numer / ($d * $d);
    }
}
