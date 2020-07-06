<?php

namespace module\sgo\helper;
use core\helper\FormatHelper;
use core\helper\SessionHelper;

class ReforcoHelper
{


  static public function obterReforco(\ArrayIterator $objReforcoOrcamentariaVO)
  {
    $js = '';
    foreach ($objReforcoOrcamentariaVO as $item) {

        $js .= '
        {
            id: "' . $item->getId(). '",
            labels: [
                "' . $item->getIdAcao()->getDescricao(). '",
                "' . $item->getIdNatureza()->getDescricao(). '",
                "' . $item->getIdDestinacao()->getcodigoDestinacao(). '",
                "' . FormatHelper::padraoMoedaView(FormatHelper::padraoMoedaBanco($item->getValor())). '"
                ],

            values: [
                "' . $item->getIdAcao()->getId(). '",
                "' . $item->getIdNatureza()->getId(). '",
                "' . $item->getIdDestinacao()->getId(). '",
                "' . $item->getValor() . '"
                ],
        },';
}
    return "[$js]";
}
}
