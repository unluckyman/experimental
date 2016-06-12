$(document).ready(function(){
  var dropzoneForm = $('#dropzone_form');

  Dropzone.options.dropzone = {
    url: '/uwa/' + dropzoneForm.data('folder') + '/upload',
    uploadMultiple: true,
    acceptedFiles: 'image/*, application/*',
    autoProcessQueue: false,
    addRemoveLinks: true,
    dictDefaultMessage: "Arraste seus arquivos para esse espaço",
    dictFallbackMessage: "Seu navegador não suporta o drag'n'drop de arquivos para upload.",
    dictFallbackText: "Por favor use o fallback abaixo para fazer o upload de seus arquivos.",
    dictFileTooBig: "Arquivo muito grande ({{filesize}}MiB). Tamanho máximo permitido: {{maxFilesize}}MiB.",
    dictInvalidFileType: "Você não pode enviar arquivos desse tipo.",
    dictResponseError: "Servidor respondeu com código {{statusCode}}.",
    dictCancelUpload: "Envio cancelado",
    dictCancelUploadConfirmation: "Tem certeza que quer cancelar esse envio?",
    dictRemoveFile: "Remover",
    dictMaxFilesExceeded: "Você não pode enviar mais nenhum arquivo.",
    maxFiles: 10,
    parallelUploads: 10,
    maxFilesize: 150, //150 MB
    init: function() {
      this.canSubmit = false;

      this.on('queuecomplete', function(){
        if(this.canSubmit) {
          dropzoneForm.submit();
        }
      });

      this.on('successmultiple', function(files, response){
        var json = $.parseJSON(response);
        var tam = json.length;
        var elem = '';

        for (var i = 0; i < tam; i++) {
          elem = elem + '<input type="hidden" name="' + dropzoneForm.data('model') + '_images[][path]" value="' + json[i] + '">';
        };

        dropzoneForm.append(elem);

        this.canSubmit = true;
      });

      this.on('errormultiple', function(files, message, xhr){
        alert('Erro no envio de imagens');
        this.canSubmit = false;
      });
    }
  };

  dropzoneForm.on('submit', function(e){
    var d = document.querySelector('#dropzone').dropzone;

    // case not wanting to upload any pictures
    if(d.files.length === 0) {
      return true;
    }

    if(d.canSubmit) {
      return true;
    }

    e.preventDefault();
    d.processQueue();

    // return false to obligate being triggered by queuecomplete dropzone's event
    return false;
  });
});
