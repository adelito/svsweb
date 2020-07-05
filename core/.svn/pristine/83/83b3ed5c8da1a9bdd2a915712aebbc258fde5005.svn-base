<?php

namespace core\helper;

/**
 * Classe utilitária de Data
 * @package core
 * @subpackage helper
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class DataHelper {

    /**
     * Verifica se uma data é válida
     * @static
     * @access public
     * @param string $data data a ser validada
     * @param string $separador Separador utilizado
     * @return boolean True para válido e False para inválido
     */
    public static function isValid($data, $separador = '/') {
        $data = explode($separador, $data);
        return checkdate($data[1], $data[0], $data[2]);
    }

    /**
     * 
     * @param string $cod
     * @return string
     */
    public static function mesPorExtenso($mes) {


        switch ($mes) {
            case "01": $mes = 'Janeiro';
                break;
            case "02": $mes = 'Fevereiro';
                break;
            case "03": $mes = 'Março';
                break;
            case "04": $mes = 'Abril';
                break;
            case "05": $mes = 'Maio';
                break;
            case "06": $mes = 'Junho';
                break;
            case "07": $mes = 'Julho';
                break;
            case "08": $mes = 'Agosto';
                break;
            case "09": $mes = 'Setembro';
                break;
            case "10": $mes = 'Outubro';
                break;
            case "11": $mes = 'Novembro';
                break;
            case "12": $mes = 'Dezembro';
                break;
        }

        return $mes;
    }

    /**
     * Semana por Extenso
     * @param Integer $semana
     * @return type
     */
    public static function semanaPorExtenso($semana) {


        switch ($semana) {
            case 0: $semana = 'Domingo';
                break;
            case 1: $semana = 'Segunda-Feira';
                break;
            case 2: $semana = 'Terca-Feira';
                break;
            case 3: $semana = 'Quarta-Feira';
                break;
            case 4: $semana = 'Quinta-Feira';
                break;
            case 5: $semana = 'Sexta-Feira';
                break;
            case 6: $semana = 'Sábado';
                break;
        }

        return $semana;
    }

    /**
     * Método responsável por validar uma data específica
     * @access public
     * @param  $data data a ser validada
     * @param  $msg mensagem de exceção
     * @throws Exception
     * @return void
     */
    public static function validarData($data, $msg) {
        if (empty(preg_match("/([0-2][0-9]|3[0-1])\/[0-1][0-9]\/[0-9]{4}/", $data))) {
            throw new Exception($msg);
        }
    }

    /**
     * Converte String para DateTime
     * @static
     * @access public
     * @param string $data String no formato dd/mm/yyyy a ser convertida 
     *  @return \DateTime
     */
    public static function strToDateTime($data) {
        $match = [];
        preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $data, $match);
        return \DateTime::createFromFormat('d/m/Y', $match[0]);
    }

    /**
     * Converte DateTime para String
     * @static
     * @access public
     * @param string $data String no formato DD/MM/YYYY
     *  @return \String 
     */
    public static function dataPorExtenso($data, $timezone = 'America/Bahia') {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set($timezone);
        return strftime('%d de %B de %Y', strtotime($data));
    }

    /* @access public
     * @param string $data1 String no formato DD/MM/YYYY
     * @param string $data2 String no formato DD/MM/YYYY
     *  @return \String 
     */

    public static function comparaDataMaior($date1, $date2, $formate = 'd/m/Y H:i:s', $formateDate2 = 'd/m/Y H:i:s') {
        return self::comparaData($date1, $date2, '>', $formate);
    }

    /**
     * Compara 2  datas
     * @static
     * @access public
     * @param string $data1
     * @param string $data2
     * @param string $comparacao != | == | < | > | <= | >= 
     *  @return \String 
     */
    public static function comparaData($date1, $date2, $comparacao, $formate = 'Y-m-d H:i:s') {

        $date1 = \DateTime::createFromFormat($formate, $date1);
        $date2 = \DateTime::createFromFormat($formate, $date2);

        if (!($date1 instanceof \DateTime)) {
            throw new \Exception('Data de entrada invalida!!');
        }

        if (!($date2 instanceof \DateTime)) {
            throw new \Exception('Data de entrada invalida!!');
        }

        switch ($comparacao) {
            case '!=':
                return ($date1 != $date2);
                break;
            case '==':
                return ($date1 == $date2);
                break;
            case '<':
                return ($date1 < $date2);
                break;
            case '<=':
                return ($date1 <= $date2);
                break;
            case '>=':
                return ($date1 >= $date2);
                break;
            case '>':
                return ($date1 > $date2);
                break;
        }
        return false;
    }

    /**
     * Diferença em Dias
     * @static
     * @access public
     * @param string $dataInicio
     * @param string $dataFim
     * @param string $formatoInicio Formato de entrada da data
     * @param string $formatoFim Formato de saida da data
     * @return integer 
     */
    public static function diferencaEmDias($dataInicio, $dataFim, $formatoInicio = 'd/m/Y', $formatoFim = 'd/m/Y') {

        $dataInicio = \DateTime::createFromFormat($formatoInicio, $dataInicio);
        $dataFim = \DateTime::createFromFormat($formatoFim, $dataFim);

        if (!($dataInicio instanceof \DateTime)) {
            throw new \Exception('Data de entrada invalida!!');
        }

        if (!($dataFim instanceof \DateTime)) {
            throw new \Exception('Data de finalização invalida!!');
        }

        return $dataInicio->diff($dataFim)->days;
    }

    /**
     *  Adiciona uma quantidade de dias a uma data e retorna a data final
     *  Seu retorno é a data final ou o próximo dia útil imediato a data final
     * @static
     * @access public
     * @param string $dataInicio
     * @param string $formatoInicio Formato de entrada da data
     * @param bool $util Flag que indica se a data retornada deverá ser alterada para o próximo dia útil imediato
     * @return string 
     */
    public static function adicionarDias($dataInicio, $dias, $util = false, $formatoInicio = 'd/m/Y', $formatoSaida = 'd/m/Y') {

        $dataInicio = \DateTime::createFromFormat($formatoInicio, $dataInicio);

        if (!($dataInicio instanceof \DateTime)) {
            return null;
        }

        $util ? $dataInicio->modify("+" . (ceil($dias) - 1) . " weekdays") : $dataInicio->modify("+" . (ceil($dias) - 1) . " days");

        if ($formatoSaida == 'object') {
            return $dataInicio;
        } else {
            return $dataInicio->format($formatoSaida);
        }
    }

    /**
     *  Subtrai uma quantidade de dias a uma data e retorna a data final
     *  Seu retorno é a data final ou o próximo dia útil imediato a data final
     * @static
     * @access public
     * @param string $dataInicio
     * @param string $formatoInicio Formato de entrada da data
     * @param bool $util Flag que indica se a data retornada deverá ser alterada para o próximo dia útil imediato
     * @return string 
     */
    public static function subtairDias($dataInicio, $dias, $util = false, $formatoInicio = 'd/m/Y', $formatoSaida = 'd/m/Y') {

        $dataInicio = \DateTime::createFromFormat($formatoInicio, $dataInicio);

        if (!($dataInicio instanceof \DateTime)) {
            return null;
        }


        $util ? $dataInicio->modify("-" . (ceil($dias) - 1) . " weekdays") : $dataInicio->modify("-" . (ceil($dias) - 1) . " days");

        if ($formatoSaida == 'object') {
            return $dataInicio;
        } else {
            return $dataInicio->format($formatoSaida);
        }
    }

    /**
     * Diferença em Horas
     * @static
     * @access public
     * @param string $_horaInicio
     * @param string $_horaFim
     * @param string $formatoInicio Formato de entrada da hora
     * @param string $formatoFim Formato de saida da hora
     * @return integer
     */
    public static function diferencaEmHoras($horaInicio, $horaFim, $formato = 'H:i:s') {

        $hInicio = \DateTime::createFromFormat($formato, $horaInicio);
        $hFim = \DateTime::createFromFormat($formato, $horaFim);

        if (!($hInicio instanceof \DateTime)) {
            throw new \Exception('Hora inicio invalida:' . $horaInicio);
        }
        if (!($hFim instanceof \DateTime)) {
            throw new \Exception('Hora fim invalida' . $horaFim);
        }

        $horaInicioArray = explode(':', $horaInicio);
        $horaFimArray = explode(':', $horaFim);
        $_horaInicio = $horaInicioArray[0];
        $_horaFim = $horaFimArray[0];
        if ($_horaInicio >= 24 | $_horaFim >= 24 || ($_horaInicio > $_horaFim)) {
            throw new \Exception("Horas inicio/fim invalidas:  $horaInicio/$horaFim");
        }

        $diff = $hFim->diff($hInicio);
        $horas = str_pad($diff->h, 2, "0", STR_PAD_LEFT);
        $minutos = str_pad($diff->i, 2, "0", STR_PAD_LEFT);
        $segundos = str_pad($diff->s, 2, "0", STR_PAD_LEFT);

        return "{$horas}:{$minutos}:{$segundos}";
    }

    /**
     * Total de dias do periodo
     * @static
     * @access public
     * @param string $dataInicio
     * @param string $dataFim
     * @param string $tipoDia 1=Todos os dias; 2=Exceto domingo; 3=Exceto sabado e domingo
     * @param string $formato Formato de saida da hora
     * @return integer
     */
    public static function totalDiasPeriodo($dataInicio, $dataFim, $tipoDia = 1, $formato = 'd/m/Y') {

        $objDataInicio = \DateTime::createFromFormat($formato, $dataInicio);
        $objDataFim = \DateTime::createFromFormat($formato, $dataFim);

        if (!($objDataInicio instanceof \DateTime)) {
            throw new \Exception('Data inicio invalida:' . $dataInicio);
        }
        if (!($objDataFim instanceof \DateTime)) {
            throw new \Exception('Data fim invalida' . $dataFim);
        }

        $diaIni = $objDataInicio->format('d');
        $mesIni = $objDataInicio->format('m');
        $anoIni = $objDataInicio->format('Y');
        $diaFim = $objDataFim->format('d');
        $mesFim = $objDataFim->format('m');
        $anoFim = $objDataFim->format('Y');
        $totalDia = 0;

        //Percorre todos os anos do periodo informado
        for ($ano = $anoIni; $anoFim >= $ano; $ano++) {

            //Percorre todos os meses do ano
            for ($mes = $mesIni; $mes <= 12; $mes++) {

                //Recupera a quantidade de dias do mes
                $dias_no_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

                $continuaMesAno = !($mesFim == $mes && $ano == $anoFim);

                //Percorre todos os dias do mes
                for ($dia = $diaIni; $dia <= $dias_no_mes; $dia++) {

                    $timestamp = mktime(0, 0, 0, $mes, $dia, $ano);
                    $semana = date("N", $timestamp);

                    if ($tipoDia == 1) {
                        $totalDia++;
                    } else {
                        //Verifica o dia NAO util (sabado/domingo)
                        $paramSemana = ($tipoDia == 2) ? 7 : 6;
                        if ($semana < $paramSemana) {
                            $totalDia++;
                        }
                    }

                    //Limita o dia da ultima data informada
                    if (($diaFim == $dia && !$continuaMesAno)) {
                        break;
                    }
                }
                //Limita o mes da ultima data informada
                if (!$continuaMesAno) {
                    break;
                }
            }
        }
        return $totalDia;
    }

}
