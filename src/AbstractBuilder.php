<?php
namespace YUti\Copula;

abstract class AbstractBuilder
{
    protected $repository;

    private function getBuildFunction($key)
    {
        if (array_key_exists($key, $this->repository)) {
            return $this->repository[$key];
        }

        return false;
    }

    public function build($kind, array $params)
    {
        $buildFunction = $this->getBuildFunction($kind);
        if ($buildFunction) {
            return $buildFunction($params);
        }

        return false;
    }
}
