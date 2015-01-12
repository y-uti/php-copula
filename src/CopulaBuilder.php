<?php
namespace YUti\Copula;

class CopulaBuilder extends AbstractBuilder
{
    protected static function defaultRepository()
    {
        return array(
            'amh'      => function ($p) { return new AliMikhailHaqCopula($p['theta']); },
            'clayton'  => function ($p) { return new ClaytonCopula($p['theta']);       },
            'fhlb'     => function ($p) { return new FrechetHoeffdingLBCopula();       },
            'fhub'     => function ($p) { return new FrechetHoeffdingUBCopula();       },
            'frank'    => function ($p) { return new FrankCopula($p['theta']);         },
            'gumbel'   => function ($p) { return new GumbelCopula($p['theta']);        },
            'joe'      => function ($p) { return new JoeCopula($p['theta']);           },
            'plackett' => function ($p) { return new PlackettCopula($p['theta']);      },
            'product'  => function ($p) { return new ProductCopula();                  },
        );
    }
}
