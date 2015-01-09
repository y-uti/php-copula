<?php
namespace YUti\Copula;

class ClaytonCopula implements Copula
{
    private $theta;

    public function __construct($theta)
    {
        $this->theta = $theta;
    }

    public function getTheta()
    {
        return $this->theta;
    }

    public function __invoke($u, $v)
    {
        $mt = -1 * $this->theta;
        $uc = pow($u, $mt);
        $vc = pow($v, $mt);

        return max(pow($uc + $vc - 1, 1 / $mt), 0);
    }
}
