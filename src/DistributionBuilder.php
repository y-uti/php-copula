<?php
namespace YUti\Copula;

class DistributionBuilder extends AbstractBuilder
{
    protected static function defaultRepository()
    {
        return array(
            'normal'  => function ($p) { return new NormalDistribution(0, 1);  },
            'uniform' => function ($p) { return new UniformDistribution(0, 1); },
        );
    }
}
