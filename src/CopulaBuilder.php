<?php
namespace YUti\Copula;

class CopulaBuilder
{
    private $repository;

    public function __construct()
    {
        $this->repository = self::defaultRepository();
    }

    private static function defaultRepository()
    {
        return array(
            'amh'      => function ($p) { return new AliMikhallHaqCopula($p['theta']); },
            'clayton'  => function ($p) { return new ClaytonCopula($p['theta']);       },
            'frank'    => function ($p) { return new FrankCopula($p['theta']);         },
            'gumbel'   => function ($p) { return new GumbelCopula($p['theta']);        },
            'joe'      => function ($p) { return new JoeCopula($p['theta']);           },
            'plackett' => function ($p) { return new PlackettCopula($p['theta']);      },
            'product'  => function ($p) { return new ProductCopula();                  },
        );
    }

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
