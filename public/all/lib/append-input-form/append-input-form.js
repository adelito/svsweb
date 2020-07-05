/*!
 * jQuery AppendInputForm
 * version: 1.0.0
 * @requires jQuery v1.5 or later
 * Author: (c) 2020 Carlivan Silva Pereira, carlivanpereira@gmail.com 
 * http://www.casipe.com.br
 */

function PluginAppendInputForm() {}

PluginAppendInputForm.prototype.init = function (selectorForm) {
    this.selectorForm = selectorForm;
    this.formData = new FormData(this.selectorForm);
    
}
PluginAppendInputForm.prototype.formDatas = function () {    
    return this.formData;
}

PluginAppendInputForm.prototype.base64ToBlob = function (base64, contentType, size) {

    var contentType = contentType || '';
    var sliceSize = size || 512;

    var byteCharacters = atob(base64);
    var byteArrays = new Array();

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);

        byteArrays.push(byteArray);
    }
    return new Blob(byteArrays, {type: contentType});
}
PluginAppendInputForm.prototype.exceptionError = function (message, codeError) {
    if (codeError) {
        this.error = codeError
    }
    this.message = message;
}

PluginAppendInputForm.prototype.append = function (nameInput, data) {
    if (!nameInput) {
        throw new this.exceptionError("nameInput empty", '001');
    }
    if (!data) {
        throw new this.exceptionError("Data empty", '002');
    }
    this.formData.append(nameInput, data);
}

PluginAppendInputForm.prototype.appendFile = function (nameInput, fileData, nameImage) {

    if (!nameInput) { 
        throw new this.exceptionError("File - nameInput empty", '003');
    } 
    if (fileData < 15) {  
        throw new this.exceptionError("File - imageData empty", '004');
    }
    if(fileData.indexOf("public") == -1 && fileData.indexOf("dados") == -1){
    var splitData = fileData.split(";");
    var contentType = splitData[0].split(":")[1];
    var base64 = splitData[1].split(",")[1];
    var blob = this.base64ToBlob(base64, contentType);

    this.formData.append(nameInput, blob, nameImage);
    }
}

//Begin plugin
function AppendInputForm(selector) {
    const plugin = new PluginAppendInputForm();
    if (selector) {
        plugin.init(selector);
    }    
    return plugin;
}
