<?php

namespace core\vo\pessoa;

use core\vo\AbstractVO;
use core\vo\pessoa\PessoaVO;
use core\vo\pessoa\LocalidadeVO;
use core\vo\pessoa\TipoLogradouroVO;
use core\vo\pessoa\TipoEnderecoVO;


class EnderecoVO extends AbstractVO {

    /**
     * Código do endereço
     * @var integer 
     */
    private $id;
    /**
     * Objeto do Tipo de Logradouro
     * @var TipoLogradouroVO 
     */
    private $idTipoLogradouro;
    /**
     * Objeto Tipo de Endereço
     * @var TipoEnderecoVO 
     */
    private $idTipoEndereco;
    /**
     * Objeto de Pessoa
     * @var PessoaVO 
     */
    private $idPessoa;
    /**
     * Logradouro
     * @var string 
     */
    private $logradouro;
    /**
     * Complemento
     * @var string 
     */
    private $complemento;
    /**
     * CEP
     * @var string 
     */
    private $cep;
    /**
     * Objeto Localidade
     * @var LocalidadeVO 
     */
    private $idLocalidade;
    /**
     * Bairro do endereço
     * @var string 
     */
    private $bairro;
    
    /**
     * Número do endereço
     * @var integer 
     */
    private $numero;
    
    /**
     * Zona
     * @var string 
     */
    private $zona;


    function __construct() {
        parent::__construct();
        $this->idTipoLogradouro = new TipoLogradouroVO();
        $this->idTipoEndereco = new TipoEnderecoVO();
        $this->idLocalidade = new LocalidadeVO();
        $this->idPessoa = new PessoaVO();
    }

  
    public function getId() {
        return $this->id;
    }

    public function getIdTipoLogradouro(): TipoLogradouroVO {
        return $this->idTipoLogradouro;
    }

    public function getIdTipoEndereco(): TipoEnderecoVO {
        return $this->idTipoEndereco;
    }

    public function getIdPessoa(): PessoaVO {
        return $this->idPessoa;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getIdLocalidade(): LocalidadeVO {
        return $this->idLocalidade;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getZona() {
        return $this->zona;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdTipoLogradouro(TipoLogradouroVO $idTipoLogradouro) {
        $this->idTipoLogradouro = $idTipoLogradouro;
    }

    public function setIdTipoEndereco(TipoEnderecoVO $idTipoEndereco) {
        $this->idTipoEndereco = $idTipoEndereco;
    }

    public function setIdPessoa(PessoaVO $idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setIdLocalidade(LocalidadeVO $idLocalidade) {
        $this->idLocalidade = $idLocalidade;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setZona($zona) {
        $this->zona = $zona;
    }

        

    /**
     * Metódo padrão para atribuição de valores
     * @param array $array Array com valores necessários para atribuição
     * @param string $prefixo prexixo da tabela
     */
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}ID_ENDERECO"]) ? $this->setId(trim($array["{$prefixo}ID_ENDERECO"])) : null;
        !empty($array["{$prefixo}ID_PESSOA"]) ? $this->idPessoa()->getId(trim($array["{$prefixo}ID_PESSOA"])) : null;
        !empty($array["{$prefixo}ID_TIPO_LOGRADOURO"]) ? $this->idTipoLogradouro()->getId(trim($array["{$prefixo}ID_TIPO_LOGRADOURO"])) : null;
        !empty($array["{$prefixo}ID_TIPO_ENDERECO"]) ? $this->idTipoEndereco()->getId(trim($array["{$prefixo}ID_TIPO_ENDERECO"])) : null;
        !empty($array["{$prefixo}ID_LOCALIDADE"]) ? $this->idLocalidade()->getId(trim($array["{$prefixo}ID_LOCALIDADE"])) : null;
        
        !empty($array["{$prefixo}LOGRADOURO"]) ? $this->setLogradouro(trim($array["{$prefixo}LOGRADOURO"])) : null;
        !empty($array["{$prefixo}COMPLEMENTO"]) ? $this->setComplemento(trim($array["{$prefixo}COMPLEMENTO"])) : null;
        !empty($array["{$prefixo}CEP"]) ? $this->setCep(trim($array["{$prefixo}CEP"])) : null;
        !empty($array["{$prefixo}BAIRRO"]) ? $this->setBairro(trim($array["{$prefixo}BAIRRO"])) : null;
        !empty($array["{$prefixo}NUMERO"]) ? $this->setNumero(trim($array["{$prefixo}NUMERO"])) : null;
        !empty($array["{$prefixo}ZONA"]) ? $this->setZona(trim($array["{$prefixo}ZONA"])) : null;
        
        // AbstractVO
        !empty($array["{$prefixo}MODIFICADO_EM"]) ? $this->setModificadoEm(trim($array["{$prefixo}MODIFICADO_EM"])) : null;
        !empty($array["{$prefixo}EXCLUIDO"]) ? $this->setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;
    }

}
