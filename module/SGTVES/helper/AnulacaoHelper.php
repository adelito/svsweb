<?php

namespace module\sgo\helper;
use core\helper\FormatHelper;

use core\helper\SessionHelper;

class AnulacaoHelper
{


  static public function obterAnulacao(\ArrayIterator $objAnulacaoOrcamentariaVO)
  {
    $js = '';
    foreach ($objAnulacaoOrcamentariaVO as $item) {

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
