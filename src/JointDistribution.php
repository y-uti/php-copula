<?php
namespace YUti\Copula;

interface JointDistribution
{
    public function __invoke($x, $y);
}
