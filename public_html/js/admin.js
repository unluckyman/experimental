/*!
 * UWA v0.2
 * Copyright 2015 Update Soluções
 */
jQuery(function(){

  // somente executado se houver um form na página
  // ativa o tooltip usado para mostrar os campos obrigatórios
  if($('form').length){
    $('.required > label').tooltip();
  }

  // validação dos campos obrigatórios de um form antes do submit
  $('form').on('click', '[type="submit"]', function(e){
    e.preventDefault();
    var canSubmit = true,
        requiredTexts = $('.required.text'), // campos de input[type='text']
        requiredPasswords = $('.required.password'), // campos de input[type='password']
        requiredTSelects = $('.required.select'), // campos de select
        requiredTextareas = $('.required.textarea'); // campos de textarea


    for(var i = 0; i < requiredTexts.length; i++ ) {
      if($(requiredTexts[i]).find('input[type="text"]').val().trim() === '') {
        var btnFile = $(requiredTexts[i]).find('.btn-file');
        canSubmit = false;

        $(requiredTexts[i]).addClass('has-error');
        if(btnFile.length) {
          btnFile.removeClass('btn-default').addClass('btn-danger');
        }
        $(requiredTexts[i]).find('label').tooltip('show');
      }
    }

    for(var i = 0; i < requiredTextareas.length; i++ ) {
      if($(requiredTextareas[i]).children('textarea').hasClass('ckeditor')) {
        var name = $(requiredTextareas[i]).children('textarea').attr('name');
        if(CKEDITOR.instances[name].document.getBody().getText().trim() === '') {
          canSubmit = false;
          $(requiredTextareas[i]).addClass('has-error');
          $(requiredTextareas[i]).children('label').tooltip('show');
        }
      }
    }

    for(var i = 0; i < requiredPasswords.length; i++ ) {
      if($(requiredPasswords[i]).children('input').val().trim() === '') {
        canSubmit = false;
        $(requiredPasswords[i]).addClass('has-error');
        $(requiredPasswords[i]).children('label').tooltip('show');
      }
    }

    for(var i = 0; i < requiredTSelects.length; i++ ) {
      if($(requiredTSelects[i]).children('input').val() === '') {
        canSubmit = false;
        $(requiredTSelects[i]).addClass('has-error');
        $(requiredTSelects[i]).children('label').tooltip('show');
      }
    }

    if(canSubmit) {
      $(this).closest('form').submit();
    }
  });

  //oculta as mensagens de alerta depois de um tempo
  $('div.alert').not('.alert-important').delay(3000).slideUp(300);

  //marca para deletar as fotos de um Article
  $('.images-delete').on('click', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $(this).parent().remove();
    $('#dropzone_form').append('<input type="hidden" name="images_deleted[]" value="'+ id +'">');
  });

  //lança janela de confirmação para os elementos do cake que são do tipo postButton (os botões de excluir)
  $('.post-button').on('click', function(e){
    e.preventDefault();

    if(window.confirm('Tem certeza que deseja excluir?')) {
      $(this).closest('form').submit();
    }
  });

  //mostra o preview do campo image no módulo de Article
  $('#image-input').on('change', function(){
    var input = this;

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#image-filename').val(input.files[0].name);
        $('#image-preview').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  });
});