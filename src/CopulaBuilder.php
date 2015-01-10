<?php
namespace YUti\Copula;

class CopulaBuilder extends AbstractBuilder
{
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
}
