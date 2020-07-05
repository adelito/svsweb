<?php

namespace core\vo\pessoa;

use core\vo\AbstractVO;
use core\vo\pessoa\PessoaVO;
use core\vo\pessoa\TipoEmailVO;

/**
 * Classe modelo de E-mail
 * @access public
 * @package core
 * @subpackage vo
 */
class EmailVO extends AbstractVO {

    /**
     * Código do E-mail
     * @access private
     * @var integer 
     */
    private $id;

    /**
     * Objeto tipo E-mail
     * @access private
     * @var TipoEmailVO 
     */
    private $idTipoEmail;

    /**
     * Pessoa responsável pelo e-mail
     * @access private
     * @var PessoaVO $idPessoa
     */
    private $idPessoa;

    /**
     * Endereço E-mail da pessoa
     * @access private
     * @var string 
     */
    private $endereco;

    /* transient */
    private $exceto;

    /**
     * Construtor da classe
     * @access private
     * @param void
     * @return void
     */
    private function __construct() {
        parent::__construct();
        $this->idPessoa = new PessoaVO();
        $this->idTipoEmail = new TipoEmailVO();
    }

    /**
     * Retorna O código do endereço
     * @param void
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Retorna o objeto Tipo do E-mail
     * @param void
     * @return TipoEmailVO
     */
    public function getIdTipoEmail() {
        return $this->idTipoEmail;
    }

    /**
     * Retorna o Objeto Pessoa
     * @param void
     * @return PessoaVO
     */
    public function getIdPessoa() {
        return $this->idPessoa;
    }

    /**
     * Retorna o Endereço e-mail
     * @param void
     * @return string
     */
    public function getEndereco() {
        return $this->endereco;
    }

    /**
     * Retorna o código da propria entidade para fins de verificação
     * @param void
     * @return integer
     */
    public function getExceto() {
        return $this->exceto;
    }

    /**
     * Seta o código do e-mail
     * @param integer $id
     * @return void
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Seta objeto Tipo de Email
     * @param TipoEmailVO $idTipoEmail
     * @return void
     */
    public function setIdTipoEmail(TipoEmailVO $idTipoEmail) {
        $this->idTipoEmail = $idTipoEmail;
    }

    /**
     * Seta o objeto Pessoa a qual pertence o e-mail
     * @param PessoaVO $idPessoa
     * @return void
     */
    public function setIdPessoa(PessoaVO $idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    /**
     * Seta o Endereço de e-mail
     * @param string $endereco
     * @return void
     */
    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    /**
     * Seta o código da propria entidade para fins de verificação
     * @param integer $exceto
     * @return void
     */
    public function setExceto($exceto) {
        $this->exceto = $exceto;
    }

    /**
     * Metódo padrão para atribuição de valores
     * @param array $array Array com valores necessários para atribuição
     * @param string $prefixo prexixo da tabela
     * @return void
     */
    public function bind($array, $prefixo = "") {

        !empty($array["{$prefixo}ID_EMAIL"]) ? $this->setId(trim($array["{$prefixo}ID_EMAIL"])) : null;
        !empty($array["{$prefixo}ID_TIPO_EMAIL"]) ? $this->setIdTipoEmail(trim($array["{$prefixo}ID_TIPO_EMAIL"])) : null;
        !empty($array["{$prefixo}ENDERECO"]) ? $this->setEndereco(trim($array["{$prefixo}ENDERECO"])) : null;
        !empty($array["{$prefixo}ID_PESSOA"]) ? $this->idPessoa()->getId(trim($array["{$prefixo}ID_PESSOA"])) : null;

        // AbstractVO
        !empty($array["{$prefixo}MODIFICADO_EM"]) ? $this->setModificadoEm(trim($array["{$prefixo}MODIFICADO_EM"])) : null;
        !empty($array["{$prefixo}EXCLUIDO"]) ? $this->setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;
    }

}
