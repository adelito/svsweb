<?php

namespace module\sistema\controller;

use core\controller\AbstractController;

class ComboController extends AbstractController {

    public function makeOptions($array, $selecionado = 0) {


        foreach ($array['retornoOperacao'] as $key => $value) {
            echo '<option value="' . $value->getId() . '" data-subtext="" ' . ($value->getId() == $selecionado ? 'selected' : '') . '>' . $value->getDescricao() . '</option>';
        }
    }

}

?>