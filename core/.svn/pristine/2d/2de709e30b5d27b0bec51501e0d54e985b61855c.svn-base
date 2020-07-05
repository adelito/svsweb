<?php

namespace core\helper;

use Exception;
use core\component\ReCaptcha\ReCaptcha;
use config\SystemConfig;

/**
 * Classe utilitária de segurança
 * @package core
 * @subpackage helper
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class SafeHelper {

    /**
     * Verifica a existencia de códigos maliciosos
     * @access public
     * @param string $valor Valor a ser verificado
     * @return string Valor livre de código malicioso
     */
    public static function safe($value) {

        if (isset($value)) {
            try {
                if (is_array($value)) {
                   return SafeHelper::verifyAllValues($value);
                } else {
                    $value = SafeHelper::ripTags($value);
                    self::validacoes($value);
                    return addslashes($value);
                }
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        } else {
            return "";
        }
    }

    /**
     * Verifica todos os valores da requisição quanto a a existencia de tags
     * @access public
     * @param boolean $removeControlCharacters Parametro para habilitar a remoção de caracteres de controle
     * @param boolean $removeMultipleSpaces Parametro para habilitar a remoção de multiplos espaços em branco
     * @param array $string Valor original a ser tratado
     * @return string Valor tratado quanto a tags, espacos e caracteres de controle
     */
    public static function ripTags($string, $removeMultipleSpaces = true, $removeControlCharacters = false) {

        $string = preg_replace('/<[^>]*>/', ' ', $string);

        if ($removeControlCharacters) {
            $string = str_replace("\r", '', $string);
            $string = str_replace("\n", ' ', $string);
            $string = str_replace("\t", ' ', $string);
        }

        if ($removeMultipleSpaces) {
            $string = trim(preg_replace('/ {2,}/', ' ', $string));
        }

        return $string;
    }

    private static function validacoes($value) {

        /*  if (\preg_match('/(\%27)|(\')|(\-\-)|(\%23)|(#)/ix', $valor)) {
          throw new Exception("Tentativa de SQL Injection simples");
          } else
          } */
        if (\preg_match('/((\%3D)|(=))[^\n]*((\%27)|(\')|(\-\-)|(\%3B)|(;))/i', $value)) {
            throw new \Exception("Tentativa de SQL Injection por meta-characters");
        } else if (\preg_match('/\w*((\%27)|(\'))((\%6F)|o|(\%4F))((\%72)|r|(\%52))/ix', $value)) {
            throw new \Exception("Tentativa de SQL Injection normal");
        } else if (\preg_match('/exec(\s|\+)+(s|x)p\w+/ix', $value)) {
            throw new \Exception("Tentativa de SQL Injection com execução de core");
        } else if (\preg_match('/((\%3C)|<)((\%2F)|\/)*[a-z0-9\%]+((\%3E)|>)/ix', $value)) {
            throw new \Exception("Tentativa de XSS simples");
        } else if (\preg_match('/((\%3C)|<)((\%69)|i|(\%49))((\%6D)|m|(\%4D))((\%67)|g|(\%47))[^\n]+((\%3E)|>)/i', $value)) {
            throw new \Exception("Tentativa de XSS");
        } else if (\preg_match('/((\%3C)|<)[^\n]+((\%3E)|>)/i', $value)) {
            throw new \Exception("Tentativa de XSS");
        }
    }

    /**
     * Verifica todos os valores da requisição quanto a a existencia de códigos maliciosos
     * @access public
     * @param array $request Array com valores da requisição
     * @return array Array com valores da requisição livre de código malicioso
     */
    public static function verifyAllValues($request) {
        foreach ($request as $key => $value) {

            if (is_array($value)) {
                SafeHelper::verifyAllValues($value);
            } else {
                $request[$key] = SafeHelper::Safe($value);
            }
        }
        return $request;
    }

    /**
     * Gerador de Código HASH para a aplicação RASEA
     * @access public
     * @param string $value Valor a ser criptografado
     * @return string Hash sha1
     */
    public static function generateRaseahash($value) {
        return hash_pbkdf2('sha1', $value, "SeC_CMo-bA_Gov_bR", 1000, 48);
    }

    /**
     * Gerador de Código HASH para a aplicação com tamanhos personalizados
     * @access public
     * @param string $value Valor a ser criptografado
     * @return string Hash sha1
     */
    public static function generateHash($value, $size) {
        return hash_pbkdf2('sha1', $value, "SeC_CMo-bA_Gov_bR", 1000, $size);
    }

    /**
     * Checa se o procedimeto do Recaptcha foi seguido com sucesso
     * @access public
     * @param string $value Chave resposta recaptcha
     * @param string $ip Endereço IP do usuário
     * @return bool
     */
    public static function isValidReCaptcha($value, $ip) {
        $objRecaptcha = new ReCaptcha(SystemConfig::RECAPTCHA_SECRET_KEY);
        $resp = $objRecaptcha->verify($value, $ip);
        if ($resp->isSuccess()) {
            return TRUE;
            // verified!
            // if Domain Name Validation turned off don't forget to check hostname field
            // if($resp->getHostName() === $_SERVER['SERVER_NAME']) {  }
        } else {
            return FALSE;
        }
    }

    public static function isInvalidPassword($pass) {

        $retorno = false;

        if (strlen($pass) < 6 || !preg_match("/[a-zA-Z]/", $pass) || !filter_var($pass, FILTER_SANITIZE_NUMBER_INT)) {
            $retorno = "A nova senha deve conter no mínimo 6 caracteres e deve possuir letras e números";
        }

        return $retorno;
    }

    /**
     * Função para gerar senhas aleatórias
     *
     * @param integer $tamanho Tamanho da senha a ser gerada
     * @param boolean $maiusculas Se terá letras maiúsculas
     * @param boolean $numeros Se terá números
     * @param boolean $simbolos Se terá símbolos
     *
     * @return string A senha gerada
     */
    public static function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {

        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $totalLetra = $tamanho;

        $retorno = '';
        $caracteresLetrasCarac = '';
        $caracteresNumeros = '';

        $caracteresLetrasCarac .= $lmin;

        if ($maiusculas) {
            $caracteresLetrasCarac .= $lmai;
        }

        if ($simbolos) {
            $caracteresLetrasCarac .= $simb;
        }

        if ($numeros) {
            $totalLetra = 3;
        }

        $len = strlen($caracteresLetrasCarac);
        for ($n = 1; $n <= $totalLetra; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteresLetrasCarac[$rand - 1];
        }


        if ($numeros) {
            $len = strlen($num);

            for ($n = 1; $n <= $tamanho - $totalLetra; $n++) {
                $rand = mt_rand(1, $len);
                $retorno .= $num[$rand - 1];
            }
        }

        return $retorno;
    }

}
