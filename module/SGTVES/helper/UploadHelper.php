<?php

namespace module\SGTVES\helper;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\helper\FormatHelper;
use core\helper\SessionHelper;



class UploadHelper extends AbstractDAO
{
    private $output_dir;
    private $datafile;
    private $status_importacao;
    private $arquivo;

    public function UploadXml()
    {
        $datafile = date('Y-m-d');
        $output_dir =  'public\upload/';
        $status_importacao = 0;
        $arquivo = $_FILES;

        if (isset($arquivo['file']['name']) && $arquivo['file']['name'] != '') {
            $objDaoHelper = new DaoHelper();
            $ret = array();
            if (is_array($arquivo["file"]["name"])) {
                $fileCount = count($arquivo["file"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $fileName = $arquivo["file"]["name"][$i];
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
                            ':datafile' => $datafile,
                            ':status_importacao' => $status_importacao,
                        ));


                        move_uploaded_file($arquivo["file"]["tmp_name"][$i], $output_dir . $fileName);
                        $ret[] = $fileName;
                        json_encode($ret);
                        # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
//                        $objDaoHelper->setRetornoOperacao(TRUE);

                        # Encerrando conexão #
//                    $objDaoHelper->setConexao(NULL);
                    } catch (Exception $ex) {
                        throw new \Exception($ex->getMessage());
                    }

                    # Retorno da Resposta #
//                return $objDaoHelper->getRetorno();
                }
            }

            echo 1;

        }
    }
}


