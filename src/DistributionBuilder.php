<?php
namespace YUti\Copula;

class DistributionBuilder extends AbstractBuilder
{
    public function __construct()
    {
        $this->repository = self::defaultRepository();
    }

    private static function defaultRepository()
    {
        return array(
            'normal'  => function ($p) { return new NormalDistribution(0, 1);  },
            'uniform' => function ($p) { return new UniformDistribution(0, 1); },
        );
    }
}
