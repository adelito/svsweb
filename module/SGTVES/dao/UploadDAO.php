<?php

namespace module\SGTVES\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use module\SGTVES\vo\UploadVO;
use core\helper\FormatHelper;

/**
 * Classe de persistência referente à Upload
 * @acess public
 * @package framework
 * @subpackage dao
 */
class UploadDAO extends AbstractDAO {

    /**
     * Método que adiciona Uploades
     * @param UploadVO $objUploadVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function Upload(UploadVO $objUploadVO) {
        $objDaoHelper = new DaoHelper();
        $output_dir =  'public\upload/';


        if (is_array($_FILES["file"]["name"])) {
            $fileCount = count($_FILES["file"]["name"]);
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES["file"]["name"][$i];
                try {
                    $objDaoHelper->setConexao(parent::getInstance('TESTE'));

                    # Comando SQL #
                    $objDaoHelper->setSql("INSERT INTO TESTE.TBFILEXML
                                  (
                                   arquivo_nome,
                                   datafile,
                                   status_importacao)                                    
                                 VALUES 
                                 ( 
                                   :arquivo_nome,
                                   :datafile,
                                   :status_importacao)");

                    $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));


                    # Executando comando #
                    $objDaoHelper->getStmt()->execute(array(
                        ':arquivo_nome' => $fileName,
                        ':datafile' => $objUploadVO->getDataFile(),
                        ':status_importacao' => $objUploadVO->getStatusImportacao(),
                    ));


                    move_uploaded_file($_FILES["file"]["tmp_name"][$i], $output_dir . $fileName);
                    $ret[] = $fileName;
                    json_encode($ret);
                    # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
                        $objDaoHelper->setRetornoOperacao(TRUE);

                    # Encerrando conexão #
                    $objDaoHelper->setConexao(NULL);
                } catch (Exception $ex) {
                    throw new \Exception($ex->getMessage());
                }

                # Retorno da Resposta #
//                return $objDaoHelper->getRetorno();
            }
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }



}
