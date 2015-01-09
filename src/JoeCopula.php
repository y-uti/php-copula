<?php
namespace YUti\Copula;

class JoeCopula implements Copula
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
        $t = $this->theta;
        $uc = pow(1 - $u, $t);
        $vc = pow(1 - $v, $t);

        return 1 - pow($uc + $vc - $uc * $vc, 1 / $t);
    }
}
