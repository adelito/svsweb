function fixBinary (bin) {
    var length = bin.length;
    var buf = new ArrayBuffer(length);
    var arr = new Uint8Array(buf);
    for (var i = 0; i < length; i++) {
      arr[i] = bin.charCodeAt(i);
    }
    return buf;
  }

$(document).ready(function(){
   var modal = $('.modal-foto-perfil');
   var modalInterno = $('.modal-foto-perfil .interno');
   
   
   fotoInput = $("#fotoperfil").fileinput({
    language: "pt-BR",        
    overwriteInitial: true,
    maxFileSize: 1024 * 5,
    showClose: false,
    showCaption: false,
    showBrowse: false,
    browseOnZoneClick: true,
    showRemove: false,
    removeLabel: '',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    removeTitle: 'Cancelar',
    elErrorContainer: '#kv-avatar-errors-2',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: $('#imgPreview').html(),
    layoutTemplates: {main2: '{preview} {remove} {browse}'},
    allowedFileExtensions: ["jpg","jpge","png"],
    uploadUrl: '/perfil/uploadImage'
    
});
        
fotoInput.on('fileimageloaded', function(event, previewId) {
     var titleModal = '<h3>Edite a sua foto</h3>'
     var img = $('#' + previewId).find('img.file-preview-image');     
     
     var newImg =  $('<img id="dynamic">');
         newImg.attr('src', img.attr('src'))
         
     var btResult = '<div class="bt"> <button class="btn bg-green waves-effect border-radius-5  btSelectPerfil">Selecionar</button> <button class="btn bg-orange waves-effect border-radius-5 btClosePerfil">Cancelar</button> </div>'
    
    modalInterno.html('');
    modalInterno.append(titleModal);     
    modalInterno.append(newImg);     
    modalInterno.append(btResult);         
    
    modal.show();
    
     uploadCrop = $('.modal-foto-perfil img').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200            
        },
        boundary: {
            width:250,
            height:250
        }
    });
    
    
     
})
 
 fotoInput.on('fileuploaded', function(event, data, previewId, index) {
    var img = $('.file-preview-image').attr('src');
    $('.topbar-foto').attr('src',img);
    $('.fotoPerfil').attr('src',img);
    $('.kv-file-remove').hide();
});
 
 
 
 
fotoInput.on('fileuploaderror', function(event, data, msg) {
    $('.kv-file-remove').show();
});

   
   $(document).on('click','.btSelectPerfil',function(){
       $('.kv-file-upload').hide();
       var size = { width: 200, height: 200 };       
       uploadCrop.croppie('result', {
				type: 'canvas',
				size: size,
				resultSize: {
					width: 50,
					height: 50
				}
			}).then(function (resp) {                            
                                      var respBinary = resp.split(',')[1];
                                      var binary = fixBinary(atob(respBinary));                                      
                                      var file = new File([binary], $('.file-preview-image').attr('title') , {
                                        type: "image/jpeg",
                                      });
                                      
                                    fotoInput.fileinput('updateStack', 0, file);                                       
                                    $('.file-preview-image').attr('src', resp);                                       
                                    fotoInput.fileinput('upload');
                                   // window.location.reload();
                    });
       
       modalInterno.html('');
       modal.hide();   
       
   });
   
    
    $(document).on('click','.btClosePerfil',function(){
       fotoInput.val(''); 
       fotoInput.fileinput('refresh');
       modalInterno.html('');
       modal.hide();              
       window.location.reload();
    });

    
   
   
    
})