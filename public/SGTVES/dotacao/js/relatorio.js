$(document).ready(function () {

    $('#frmRelatorio')
        .bootstrapValidator({
            fields: {
                ID_ACAO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_NATUREZA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_DESTINACAO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                }
            }
        });
});
