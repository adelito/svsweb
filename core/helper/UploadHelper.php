<?php

namespace core\helper;

use core\exception\FileException;

/**
 * Classe utilitária para Upload
 * @package core
 * @subpackage helper
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class UploadHelper {

    private $arquivo;
    private $extensao;
    private $nome;
    private $extPermitidas;
    private $caminho;
    private $tamanhoMax;

    /**
     * Método construtor
     * @param type $arquivo $_FILES[] do php
     * @param type $extPermitidas Array com as extensões permitidas
     * @return void
     * @throws FileException
     */
    function __construct($arquivo, $caminho, $extPermitidas = array("png", "jpeg", "jpg", "gif"), $tamanhoMax = 100) {
        if (!isset($arquivo)) {
            throw new FileException('O arquivo não foi indicado');
        } else {
            $this->arquivo = $arquivo;
            // Extensão
            $this->extensao = substr($arquivo['name'], strrpos($arquivo['name'], '.') + 1);
            // Renomeia
            $this->nome = md5("arquivo" . '_' . rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . date("dmYhis") . microtime(true)) . '.' . $this->extensao;
            //Extensoes permitidas
            $this->extPermitidas = $extPermitidas;
            //Caminho
            $this->caminho = $caminho;
            // Tamanho máximo permitido
            $this->tamanhoMax = $tamanhoMax;
        }
    }

    /**
     * Método que verifica permissão das extensões
     * @param void 
     * @return boolean
     */
    public function verificarExtensao() {
        $permitido = false;
        for ($i = 0; $i < sizeof($this->extPermitidas); $i++) {
            if (strcasecmp($this->extPermitidas[$i], $this->extensao) == 0) {
                $permitido = true;
            }
        }
        return $permitido;
    }

    /**
     * Verifica se o tamanho do arquivo não ultrapassa o limite
     * @param void
     * @return boolean Se o arquivo for maior retorna false.
     */
    public function verificarTamanho() {
        if ((($this->arquivo['size'] / 1024) / 1024) > $this->tamanhoMax) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Salva um novo nome para o arquivo
     * @param string novo nome.
     * @return void
     * @throws FileException
     */
    public function renomear($novoNome) {
        if (isset($novoNome) && is_string($novoNome)) {
            $this->nome = $novoNome . '_' . time() . '.' . $this->extensao;
        } else {
            throw new FileException("Novo Nome não indicado", 1);
        }
    }

    /**
     * 
     * Retorna o nome do arquivo
     * @param void
     * @return string Nome do Arquivo
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Armazena as extensões permitidas
     * @param array extensões permitidas
     * @return void
     * @throws FileException
     */
    public function setExtensoes($extensoes) {
        if (count($extensoes) > 0) {
            $this->extPermitidas = $extensoes;
        } else {
            throw new FileException("Extensões não definidas");
        }
    }

    /**
     * Armazena o caminho que irá salvar o upload
     * @param string $caminho
     * @throws FileException
     */
    public function setCaminho($caminho) {
        if (strlen($caminho) > 0)
            $this->caminho = $caminho;
        else
            throw new FileException("Caminho não definido");
    }

    /**
     * Apaga o arquivo armazenado
     * @param string $caminho
     * @return bool 
     */
    public function unlink($caminhoArquivo = "") {

        if (empty($caminhoArquivo)) {
            $caminhoArquivo = $this->caminho . $this->nome;
        }

        if (file_exists($caminhoArquivo)) {
            return unlink($caminhoArquivo);
        } else {
            return false;
        }
    }

    /**
     * Realiza o processo de Upload do arquivo
     * @param void
     * @return boolean
     * @throws FileException em caso de Falha
     */
    public function upload() {
        if ($this->verificarExtensao()) {
            if ($this->verificarTamanho()) {

                if (is_uploaded_file($this->arquivo['tmp_name'])) {
                    if (@copy($this->arquivo['tmp_name'], $this->caminho . $this->nome)) {
                        return true;
                    } else
                        throw new FileException("Não foi possível copiar o arquivo");
                } else
                    throw new FileException("Arquivo não encontrado");
            } else
                throw new FileException("Tamanho do upload excedeu o tamanho permitido de " . $this->tamanhoMax . " Mb");
        } else
            throw new FileException('Extensão não permitida');
    }

    /**
     * Seta o Nome do Arquivo
     * @param string $nome Nome do Arquivo
     * @return void
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }

}

?>
