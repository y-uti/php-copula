<?php
namespace YUti\Copula;

class PlackettCopula implements Copula
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
        $uv = 1 + ($t - 1) * ($u + $v);
        $numer = $uv - sqrt($uv * $uv - 4 * $u * $v * $t * ($t - 1));
        $denom = 2 * ($t - 1);

        return $numer / $denom;
    }
}
