<?php
namespace YUti\Copula;

class DistributionBuilder extends AbstractBuilder
{
    protected static function defaultRepository()
    {
        return array(
            'normal'  => function ($p) {
                return new NormalDistribution($p['mean'], $p['stddev']); },
            'uniform' => function ($p) {
                return new UniformDistribution($p['min'], $p['max']); },
        );
    }
}
