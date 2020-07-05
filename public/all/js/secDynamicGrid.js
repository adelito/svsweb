var list = {view: [], dados: []};
var idLoadData = null;

function LoadlistaInit(array) {
    if (listaInit.dados.length > 0) {
        list = listaInit;
        setList(list);
    }
}

function setList(list) {
    var linha = '';
    var auxDisabled = '';
    var auxRevisao = $('.dados-etapa').attr('data-revisao');
        
    if(auxRevisao != undefined){
        auxDisabled = 'disabled';
    }
    
    $.each(list.view, function (key, obj) {
        

           if(obj.EXCLUIDO == 0){
                linha += '<tr>';
                linha += '<td class="align-center" id="">    <div class="btn-group tableAction">        <button type="button" class="btn btn-default waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" '+auxDisabled+'><i class="material-icons">keyboard_arrow_down</i></button>         <ul class="dropdown-menu ">';
                linha += '<li><a style="cursor: pointer;" onclick="loadData(' + key + ');"><i class="material-icons bg-orange padding-5 ">create</i>&nbsp;Alterar</a></li>';
                linha += '<li><a style="cursor: pointer;" onclick="deleteData(' + key + ');" class=""><i class="material-icons bg-red padding-5 ">delete_forever</i>&nbsp;Excluir</a></li>';
                linha += '</ul></div> </td>';
                for (var key in obj) {
                    if (obj[key] == null) {
                        obj[key] = '';
                    }
                    if( key != "EXCLUIDO"  && key != "ID_REFERENCIAS_PLANO" ){
                        linha += '<td>' + obj[key] + '</td>';
                    }
                }
                linha += '</tr>';
            }
                
    });

    $('#listTable').html(linha);
}

function addData() {
    var formGeral = $('.form-grid').attr('data-form');
    var campos = $('.form-grid input,.form-grid select'); //Inputs que irão ser adicionado ao grid
    var camposDados = []; //dados em branco
    var camposView = []; //dados em branco

    campos.each(function (index, element) {

        var id = $(this).attr('id');
        if (id != undefined) {
            //Só adiciona aos campos dados os que tiverem id            
            var valDados = $(this).val();
            var valView = $(this).val();
            if (this.tagName == 'SELECT') {
                var valView = $(this).find('option:selected').text();
            }

            camposDados[id] = valDados;
            camposView[id] = valView;

            if ($(this).attr('data-valida') != undefined) {
                //revalidação do campos
                revalid(id);
            }
        }
    });

    if ($('.form-grid div.has-error').length === 0) {
        list.dados.push(camposDados);
        list.view.push(camposView);
        setList(list);
        $('#' + formGeral + ' input').val('');
        $('#' + formGeral + ' select').val('');
        $('#' + formGeral + ' #EXCLUIDO').val('0');
        $('.selectpicker').selectpicker('refresh');

    }
}

function updateData() {
    $('.btn-update-item').removeAttr('disabled');
    var formGeral = $('.form-grid').attr('data-form');
    var campos = $('.form-grid input,.form-grid select'); //Inputs que irão ser adicionado ao grid
    var camposDados = []; //dados em branco
    var camposView = []; //dados em branco


//    var CamposObrigatoriosValidos = true;

    campos.each(function (index, element) {

        var id = $(this).attr('id');
        if (id != undefined) {
            //Só adiciona aos campos dados os que tiverem id            
            var valDados = $(this).val();
            var valView = $(this).val();
            if (this.tagName == 'SELECT') {
                var valView = $(this).find('option:selected').text();
            }

            camposDados[id] = valDados;
            camposView[id] = valView;

            if ($(this).attr('data-valida') != undefined) {
                //revalidação do campos
                revalid(id);
            }
        }
    });

    if ($('.form-grid div.has-error').length === 0 && idLoadData !== null) {
        list.dados[idLoadData] = camposDados;
        list.view[idLoadData] = camposView;
        setList(list);
        idLoadData = null;
        $('#' + formGeral + ' input').val('');
        $('#' + formGeral + ' select').val('');
        $('#' + formGeral + ' #EXCLUIDO').val('0');
        $('.selectpicker').selectpicker('refresh');        
        $('.form-grid .data-block-insert').show();
        $('.form-grid .data-block-update').hide();
    }
}




function revalid(id) {
    $('form').data('bootstrapValidator').enableFieldValidators(id, true, 'notEmpty');
    $('form').data('bootstrapValidator').revalidateField(id);

    if (id == 'ANO' && $('#' + id).val() != '') {
        $('form').data('bootstrapValidator').enableFieldValidators(id, true, 'date');
        $('form').data('bootstrapValidator').revalidateField(id);
    }
}

function deleteData(id) {
   
   var item = list.dados[id];

   //Vem do banco
   if(item.ID_REFERENCIAS_PLANO != undefined){
      list.view[id].EXCLUIDO =  '1'; //exclui da view
      list.dados[id].EXCLUIDO = '1'; // coloca nos dados como excluido para atualizar no controller
   }
   
   //Vem da view
   if(item.ID_REFERENCIAS_PLANO == undefined  || item.ID_REFERENCIAS_PLANO == "" ){
       list.view.splice(id,1);    
       list.dados.splice(id,1);
   }
   
   setList(list);

    return false;
}

function loadData(id) {

    var campos = $('.form-grid input,.form-grid select');
    var dadoSelecionado = list.dados[id];

    campos.each(function (index, element) {
        $(this).val(dadoSelecionado[$(this).attr('name')]);
    });

    $('.form-grid .data-block-insert').hide();
    $('.form-grid .data-block-update').show();

    idLoadData = id;
    
    $('form').data('bootstrapValidator').resetForm();
    $('.selectpicker').selectpicker('refresh');
    return false;
}

function reset() {

    idLoadData = null;
    var formGeral = $('.form-grid').attr('data-form');
    $('#' + formGeral + ' input').val('');
    $('#' + formGeral + ' select').val('');
    $('.selectpicker').selectpicker('refresh');
//    $('form').data('bootstrapValidator').resetForm();
    $('.form-grid .data-block-insert').show();
    $('.form-grid .data-block-update').hide();
    $('#' + formGeral + ' #EXCLUIDO').val('0');
}

$(document).ready(function () {
    LoadlistaInit();
    $(document).on('click', '.form-grid .btn-add-item', function () {
        addData();
    });

    $(document).on('click', '.form-grid .btn-update-item', function () {
        updateData();
    });

    $(document).on('click', '.form-grid .btn-cancel-update-item', function () {
        reset();
    });
    
    $(document).on('click', '.btn-add-limpar', function () {
        reset();
        $('form').data('bootstrapValidator').enableFieldValidators('ID_CLASSIFICACAO_REFERENCIA', false, 'notEmpty');    
        $('form').data('bootstrapValidator').enableFieldValidators('TITULO', false, 'notEmpty');    
        $('form').data('bootstrapValidator').enableFieldValidators('AUTOR', false, 'notEmpty');    
    });
    
    
    

});


