<?php

namespace module\sgo\helper;

use config\SystemConfig;
use module\sapf\vo\OutroVinculoVO;
use core\helper\BoHelper;
use core\helper\FormatHelper;

class DistribuirConcessaoHelper {

    static public function obterDistribuicao(\ArrayIterator $objDistribuicaoConcessaoVO) {
        $js = '';
        foreach ($objDistribuicaoConcessaoVO as $item) {
            $js .= '
                {
                    id: "' . $item->getId(). '",
                    labels: [
                        "' . $item->getIdUsp()->getDescricao() . '",
                        "' . FormatHelper::padraoMoedaView(FormatHelper::padraoMoedaBanco($item->getValor())) . '"
                        ],

                    values: [
                        "' . $item->getIdUsp()->getId() . '",
                        "' . $item->getValor() . '"
                        ],
                },';
        }
        return "[$js]";
    }

}
