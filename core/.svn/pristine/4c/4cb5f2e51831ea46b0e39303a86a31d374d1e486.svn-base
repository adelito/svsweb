<?php

namespace core\helper;

/**
 * Classe utilitária para CNPJ
 * @package core
 * @subpackage helper
 * @author Ramatis Reis <ramatis.reis@educacao.ba.gov.br>
 */
class CnpjHelper {

    const INVALID = 'cnpjInvalid';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $messageTemplates = array(
        self::INVALID => 'CNPJ informado é inválido.',
    );

    
    
    static public function isValid($value) {
        $cnpj = self::trim($value);
        if (self::respectsRegularExpression($cnpj) != 1) {
            return false;
        } else {
            $x = strlen($cnpj) - 2;
            if (self::applyingCnpjRules($cnpj, $x) == 1) {
                $x = strlen($cnpj) - 1;
                if (self::applyingCnpjRules($cnpj, $x) == 1) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    /**
     * @param $cnpj
     * @return string
     */
    static private function trim($cnpj) {
        return preg_replace('/[.,\/, -]/', '', $cnpj);
    }

    /**
     * @param $cnpj
     * @return bool
     */
    static private function respectsRegularExpression($cnpj) {
        $regularExpression = '[0-9]{2,3}\\.?[0-9]{3}\\.?[0-9]{3}/?[0-9]{4}-?[0-9]{2}';

        if (!@ereg("^" . $regularExpression . "\$", $cnpj)) {
            return false;
        }

        return true;
    }
    
    /**
     * @param $cnpj
     * @param $x
     * @return bool
     */
    static private function applyingCnpjRules($cnpj, $x)
    {
        $VerCNPJ = 0;
        $ind = 2;
        for ($y = $x; $y>0; $y--) {
            $VerCNPJ += (int) substr($cnpj, $y-1, 1) * $ind;
            if ($ind > 8) {
                $ind = 2;
            } else {
                $ind++;
            }
        }
        $VerCNPJ %= 11;
        if (($VerCNPJ == 0) || ($VerCNPJ == 1)) {
            $VerCNPJ = 0;
        } else {
            $VerCNPJ = 11 - $VerCNPJ;
        }
        if ($VerCNPJ != (int) substr($cnpj, $x, 1)) {
            return false;
        } else {
            return true;
        }
    }

}
