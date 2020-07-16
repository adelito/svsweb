<?php

namespace module\SGTVES\vo;

use core\vo\AbstractVO;

class UploadVO extends AbstractVO {

    private $codFileXml;
    private $nome_arquivo;
    private $dataFile;
    private $statusImportacao;



    public function __construct() {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getCodFileXml()
    {
        return $this->codFileXml;
    }

    /**
     * @param mixed $codFileXml
     */
    public function setCodFileXml($codFileXml)
    {
        $this->codFileXml = $codFileXml;
    }

    /**
     * @return mixed
     */
    public function getNomeArquivo()
    {
        return $this->nome_arquivo;
    }

    /**
     * @param mixed $nome_arquivo
     */
    public function setNomeArquivo($nome_arquivo)
    {
        $this->nome_arquivo = $nome_arquivo;
    }

    /**
     * @return mixed
     */
    public function getDataFile()
    {
        return $this->dataFile;
    }

    /**
     * @param mixed $dataFile
     */
    public function setDataFile($dataFile)
    {
        $this->dataFile = $dataFile;
    }

    /**
     * @return mixed
     */
    public function getStatusImportacao()
    {
        return $this->statusImportacao;
    }

    /**
     * @param mixed $statusImportacao
     */
    public function setStatusImportacao($statusImportacao)
    {
        $this->statusImportacao = $statusImportacao;
    }






    public function bind($array, $prefixo = "") {

        !empty($array["{$prefixo}CODFILEXML"]) ? $this->setCnpj(trim($array["{$prefixo}CODFILEXML"])) : null;
        !empty($array["{$prefixo}ARQUIVO_NOME"]) ? $this->setnome(trim($array["{$prefixo}ARQUIVO_NOME"])) : null;
        !empty($array["{$prefixo}DATAFILE"]) ? $this->setNFantasia(trim($array["{$prefixo}DATAFILE"])) : null;
        !empty($array["{$prefixo}STATUS_IMPORTACAO"]) ? $this->setLogradouro(trim($array["{$prefixo}STATUS_IMPORTACAO"])) : null;



        !empty($array["{$prefixo}data_inclusao"]) ? $this->setDataInclusao(trim($array["{$prefixo}data_inclusao"])) : null;
        !empty($array["{$prefixo}data_alteracao"]) ? $this->setDataAlteracao(trim($array["{$prefixo}data_alteracao"])) : null;
        !empty($array["{$prefixo}usuario_inclusao"]) ? $this->setUsuarioInclusao(trim($array["{$prefixo}usuario_inclusao"])) : null;
        !empty($array["{$prefixo}usuario_alteracao"]) ? $this->setUsuarioAlteracao(trim($array["{$prefixo}usuario_alteracao"])) : null;
        !empty($array["{$prefixo}excluido"]) ? $this->setExcluido(trim($array["{$prefixo}excluido"])) : null;


    }

}
