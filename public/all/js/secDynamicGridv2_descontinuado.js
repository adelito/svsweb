/*
 *  Project: secDynamicGridV2
 *  Description: Plugin de padronização do dynamicGrid
 *  Author: Leandro Sena
 *  Versão: 2.0
 *  License: 
 */
    

(function( $ ){
    
   
   //METHODS do plugin
    var methods = {
        
    /************************  INIT  ****************************/    
    init : function( options ) { 
        
            var settings   = $.extend( {}, defaults, options );
            this.secGrid = {};
            this.secGrid.list = settings.list;
            this.secGrid.target = settings.target;
        
           /**************** validações para executar ******************/                
            
            if(this.length > 1){
                $.error('Mais de elemento com a mesma instância do plugin');
                return false;
            }

            if(settings.target == null){
                $.error('Você precisa definir um target');
                return false;
            } 
            
          /******************************/
          
           settings.buttonAddLayout = '<div class="row"><div class="col-md-12 box-add-grid"><center>  ' + settings.buttonAddLayout + ' </center></div> </div>';
           $(this).append(settings.buttonAddLayout);           
           return this;
           
    },//END INIT
    /************************  UPDATE  ****************************/    
    
    add : function( content ) { 
                   

             var campos = $(this).find('select,input'); //Inputs que irão ser adicionado ao grid
             var camposDados = [];
             var camposView  = []; 

            campos.each(function (index, element) {

                 var name = $(this).attr('name');
                 if (name != undefined) {
                    //Só adiciona aos campos dados os que tiverem id            
                    var valDados = $(this).val();
                    var valView  = $(this).val();
                    if (this.tagName == 'SELECT') {
                        var valView = $(this).find('option:selected').text();
                    }
                     camposDados[name] = valDados;
                     camposView[name]  = valView;
                     
                    if ($(this).attr('data-valida') != undefined) {
                        //revalidação do campos
                        revalid(name);
                    }
                }
            });

           // console.log(camposDados);
            if ($('.form-grid div.has-error').length === 0) {                
                this.secGrid.list.dados.push(camposDados);
                this.secGrid.list.view.push(camposView);
                //setList(list);
                $(this).find('input').val('');
                $(this).find('select').val('');
                $('.selectpicker').selectpicker('refresh');
           }
                   
           return this;
    }, 
    /************************  UPDATE  ****************************/    
    
    update : function( content ) { 
     console.log('update',content);
     return this;
    },//END UPDATE
    // BUILD
    build : function(content){
            //função add
            var thisReff = this;
            $(this).find('.box-add-grid a').bind('click', function(){                      
                      methods['add'].apply(thisReff, {} );
            });        
           
            return this;
    }// END BUILD 
    
    
    
    
   //END METHODS do plugin 
  };
   
   
    
    $.fn.secDynamicGrid = function( method ) {
        if ( methods[method] ) {
          return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
          return methods.init.apply( this, arguments );
        } else {
          $.error( 'O método ' +  method + ' não existe no secDynamicGrid' );
        }  
    };
    
    
    //Configurações padrão
   var defaults = {
          target : null,
          list : {view: [], dados: [] },
          idLoadData : null,
          buttonAddLayout:'<a class="btn bg-green waves-effect border-radius-5 ">   <i class="material-icons">add</i>  <span class="m-r-10">Adicionar</span>  </a>',
   };

    
})( jQuery );




    gridCronograma = $('.form-grid').secDynamicGrid({
        target: '#listTable'        
    }).secDynamicGrid('build');


//function LoadlistaInit(array) {
//    if (listaInit.dados.length > 0) {
//        list = listaInit;
//        setList(list);
//    }
//}
//
///**
// * Seta os campos do form na Grid
// * @param {object} grid
// * @returns {void}
// */
//
//function setList(list) {
//    var linha = '';
//
//    $.each(list.view, function (key, obj) {
//           if(obj.EXCLUIDO == 0){
//                linha += '<tr>';
//                linha += '<td class="align-center" id="">    <div class="btn-group tableAction">        <button type="button" class="btn btn-default waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">keyboard_arrow_down</i></button>         <ul class="dropdown-menu ">';
//                linha += '<li><a style="cursor: pointer;" onclick="loadData(' + key + ');"><i class="material-icons bg-orange padding-5 ">create</i>&nbsp;Alterar</a></li>';
//                linha += '<li><a style="cursor: pointer;" onclick="deleteData(' + key + ');" class="alert-confirm-excluir"><i class="material-icons bg-red padding-5 ">delete_forever</i>&nbsp;Excluir</a></li>';
//                linha += '</ul></div> </td>';
//                for (var key in obj) {
//                    if (obj[key] == null) {
//                        obj[key] = '';
//                    }
//                    if(key != "EXCLUIDO"){
//                        linha += '<td>' + obj[key] + '</td>';
//                    }
//                }
//                linha += '</tr>';
//            }
//                
//    });
//
//    $('#listTable').html(linha);
//}
//
//
//function updateData() {
//    var formGeral = $('.form-grid').attr('data-form');
//    var campos = $('.form-grid input,.form-grid select'); //Inputs que irão ser adicionado ao grid
//    var camposDados = []; //dados em branco
//    var camposView = []; //dados em branco
//
//
////    var CamposObrigatoriosValidos = true;
//
//    campos.each(function (index, element) {
//
//        var id = $(this).attr('id');
//        if (id != undefined) {
//            //Só adiciona aos campos dados os que tiverem id            
//            var valDados = $(this).val();
//            var valView = $(this).val();
//            if (this.tagName == 'SELECT') {
//                var valView = $(this).find('option:selected').text();
//            }
//
//            camposDados[id] = valDados;
//            camposView[id] = valView;
//
//            if ($(this).attr('data-valida') != undefined) {
//                //revalidação do campos
//                revalid(id);
//            }
//        }
//    });
//
//    if ($('.form-grid div.has-error').length === 0 && idLoadData !== null) {
//        list.dados[idLoadData] = camposDados;
//        list.view[idLoadData] = camposView;
//        setList(list);
//        idLoadData = null;
//        $('#' + formGeral + ' input').val('');
//        $('#' + formGeral + ' select').val('');
//        $('.selectpicker').selectpicker('refresh');        
//        $('.form-grid .data-block-insert').show();
//        $('.form-grid .data-block-update').hide();
//    }
//}
//
//
//
//
//function revalid(id) {
//    $('form').data('bootstrapValidator').enableFieldValidators(id, true, 'notEmpty');
//    $('form').data('bootstrapValidator').revalidateField(id);
//
//    if (id == 'ANO' && $('#' + id).val() != '') {
//        $('form').data('bootstrapValidator').enableFieldValidators(id, true, 'date');
//        $('form').data('bootstrapValidator').revalidateField(id);
//    }
//}
//
//function deleteData(id) {
//   
//   var item = list.dados[id];
//
//   //Vem do banco
//   if(item.ID_REFERENCIAS_PLANO != undefined){
//      list.view[id].EXCLUIDO =  '1'; //exclui da view
//      list.dados[id].EXCLUIDO = '1'; // coloca nos dados como excluido para atualizar no controller
//   }
//   
//   //Vem da view
//   if(item.ID_REFERENCIAS_PLANO == undefined){
//       list.view.splice(id,1);    
//       list.dados.splice(id,1);
//   }
//   
//   console.log(id);
//   setList(list);
//
//    return false;
//}
//
//function loadData(id) {
//
//    var campos = $('.form-grid input,.form-grid select');
//    var dadoSelecionado = list.dados[id];
//
//    campos.each(function (index, element) {
//        $(this).val(dadoSelecionado[$(this).attr('name')]);
//    });
//
//    $('.form-grid .data-block-insert').hide();
//    $('.form-grid .data-block-update').show();
//
//    idLoadData = id;
//    
//    $('form').data('bootstrapValidator').resetForm();
//    $('.selectpicker').selectpicker('refresh');
//    return false;
//}
//
//function reset() {
//
//    idLoadData = null;
//    var formGeral = $('.form-grid').attr('data-form');
//    $('#' + formGeral + ' input').val('');
//    $('#' + formGeral + ' select').val('');
//    $('.selectpicker').selectpicker('refresh');
//    $('form').data('bootstrapValidator').resetForm();
//    $('.form-grid .data-block-insert').show();
//    $('.form-grid .data-block-update').hide();
//
//}
//
//$(document).ready(function () {
//    LoadlistaInit();
//    $(document).on('click', '.form-grid .btn-add-item', function () {
//        addData();
//    });
//
//    $(document).on('click', '.form-grid .btn-update-item', function () {
//        updateData();
//    });
//
//    $(document).on('click', '.form-grid .btn-cancel-update-item', function () {
//        reset();
//    });
//
//});
//

