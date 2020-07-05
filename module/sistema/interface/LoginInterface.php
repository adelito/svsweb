<?php

 interface SetorInterface {
   
 	public function cadastrar($objSetorVO);
 	public function alterar($objSetorVO);
 	public function listarPorIdOrgao($objSetorVO);
 	public function listar();
 	public function selecionar($objSetorVO);
 	public function excluir($objSetorVO);
  
}
 
?>
