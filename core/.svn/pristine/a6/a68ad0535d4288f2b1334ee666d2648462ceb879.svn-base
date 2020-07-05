<?php

namespace core\helper;

/**
 * Classe utilitária para formatação
 * @package core
 * @subpackage helper
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class FormatHelper {

    /**
     * Formata Moeda para padrão do banco de dados
     * @static
     * @access public
     * @param float|string $valor 
     * @return string Valor formatado
     */
    public static function padraoMoedaBanco($valor) {
        return empty($valor) ? '' : str_replace(',', '.', str_replace('.', '', $valor));
    }

    /**
     * Formata Moeda para padrão da View
     * @static
     * @access public
     * @param float|string $valor 
     * @return string Valor formatado
     */
    public static function padraoMoedaView($valor) {
        return empty($valor) ? '' : number_format($valor, 2, ',', ".");
    }

    /**
     * Formata data para padrão do banco de dados
     * @static
     * @access public
     * @param string $valor 
     * @return string Data formatado
     */
    public static function padraoDataBanco($valor) {
        return empty($valor) ? '' : date('d/m/Y', strtotime(str_replace('/', '-', $valor)));
    }

    /**
     * Formata hora para padrão de View
     * @static
     * @access public
     * @param float|string $valor 
     * @return string Data formatado
     */
    public static function padraoDataView($valor) {
        return empty($valor) ? '' : date('d/m/Y', strtotime(str_replace('/', '-', $valor)));
    }

    /**
     * Formata hora para padrão do banco de dados
     * @static
     * @access public
     * @param string $valor 
     * @return string Data formatado
     */
    public static function padraoHoraBanco($valor) {
        return empty($valor) ? '' : date('H:i:s', str_replace('/', '', $valor));
    }

    /**
     * Formata data para padrão de View
     * @static
     * @access public
     * @param float|string $valor 
     * @return string Data formatado
     */
    public static function padraoHoraView($valor) {
        return empty($valor) ? '' : date('H:i:s', strtotime(str_replace('/', '-', $valor)));
    }

    /**
     * Formata CEP
     * @static
     * @access public
     * @param string $valor 
     * @return string CEP formatado
     */
    public static function Cep($valor) {
        return empty($valor) ? '' : self::mask(self::removeMask($valor), '#####-###');
    }

    /**
     * Formata CPF
     * @static
     * @access public
     * @param string $valor 
     * @return string CPF formatado
     */
    public static function Cpf($valor) {
        return empty($valor) ? '' : self::mask(self::removeMask($valor), '###.###.###-##');
    }

    /**
     * Formata CNPJ
     * @static
     * @access public
     * @param string $valor 
     * @return string CNPJ formatado
     */
    public static function cnpj($valor) {
        return empty($valor) ? '' : self::mask(self::removeMask($valor), '##.###.###/####-##');
    }

    /**
     * Formatator genérico
     * @static
     * @access public
     * @param string $valor Valor a ser formatado
     * @param string $mask Máscara a ser aplicada 
     * @return string valor formatado
     */
    public static function mask($valor, $mask) {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($valor[$k]))
                    $maskared .= $valor[$k++];
            }
            else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    /**
     * Removedor de formatação genérico
     * @static
     * @access public
     * @param string $valor Valor a ter a mascara removida
     * @return string Valor com a formatacao removida
     */
    public static function removeMask($valor) {
        return str_replace(array('.', '-', '/', '\\', ',', '|', '_', '(', ')', '[', ';', "'", '"', ' ', '  '), '', trim($valor));
    }

    /**
     * Formata TELEFONE
     * @static
     * @access public
     * @param string $valor 
     * @return string Telefone fixo formatado
     */
    public static function telefoneFixo($valor) {
        return empty($valor) ? '' : self::mask(self::removeMask($valor), '(##) ####-####');
    }

    /**
     * Formata CELULAR
     * @static
     * @access public
     * @param string $valor 
     * @return string Celular formatado
     */
    public static function celular($valor) {
        return empty($valor) ? '' : self::mask(self::removeMask($valor), '(##) #####-####');
    }

    /**
     * Remove Acentos
     * @static
     * @access public
     * @param string $valor 
     * @return string Valor com acentos removidos
     */
    public static function removerAcentos($valor) {
        return strtr(utf8_decode($valor), utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'), 'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy');
    }

    /**
     * Remove Caracteres especiais
     * @static
     * @access public
     * @param string $valor 
     * @return string Valor com caracteres especiais removidos
     */
    public static function removeSpecialChars($valor) {
        return preg_replace('/(\(|\)|-|\.)/', "", $valor);
    }

    /**
     * Gerar base 64 de arquivos
     * @static
     * @access public
     * @param string $dir Diretório do arquivo
     * @param string $typeBase64 Tipo de arquivo a ser gerado no base64 | Ex data:image
     * @return string arquivo convertido em base 64
     */
    public static function generateFileBase64($dir,$typeBase64) {
        $type = pathinfo($dir, PATHINFO_EXTENSION);
        $data = file_get_contents($dir);
        return $typeBase64 .DIRECTORY_SEPARATOR. $type . ';base64,' . base64_encode($data);
    }

}
