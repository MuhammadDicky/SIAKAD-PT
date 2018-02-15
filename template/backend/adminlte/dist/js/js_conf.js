var path = window.location.pathname;
var host = window.location.hostname;

$(function(){

    $(window).resize(function(){ 
      if ($(window).width() >= 520) {
        $('.login-box').css('width','490px');      
      }
      if ($(window).width() < 520) {      
        $('.login-box').css('width','');      
      }
      if ($(window).width() >= 550) {      
        $('.input-user,.input-pass').addClass('col-xs-6');
      }
      if ($(window).width() < 550) {      
        $('.input-user,.input-pass').removeClass('col-xs-6');
      }
    });
    if ($(window).width() >= 520) {
      $('.login-box').css('width','490px');      
    }
    if ($(window).width() < 520) {      
      $('.login-box').css('width','');
    }
    if ($(window).width() >= 550) {      
      $('.input-user,.input-pass').addClass('col-xs-6');
    }
    if ($(window).width() < 550) {      
      $('.input-user,.input-pass').removeClass('col-xs-6');
    }

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    if ($('.swal2-container').is(':visible')) {
      $('.swal2-container').addClass('style-2');
    }

    /*Login Check with AJAX*/
    $(document).on('click', '#login', function(eve){
      eve.preventDefault();
      $('.has-error').removeClass('has-error');
      if ($('input[name=username]').val() != '' && $('input[name=password]').val() != '') {
        var action = $('#form-login').attr('action');
        if ($('form#form-login').is(':visible')) {
          var datasend = $('#form-login').serialize();
        }
        else{
          var datasend = {password:$('input#password').val()};
        }
        $('#login').find('span').removeClass('fa-sign-in').addClass('fa-spinner fa-spin');
        $('.log-in').removeClass('fa-arrow-right').addClass('fa-spinner fa-spin');

        $.ajax(url_login+'/user/'+action,{
          dataType: 'json',
          type: 'POST',
          data: datasend,
          success: function(data){          
            if (data.status == 'failed') {
              $.each(data.errors, function(key, value){
                if (value == 'Password kosong, tolong disi dengan benar') {
                  $('input#password').focus();
                  $(".password-input").addClass('has-error');
                }
                else{
                  if (value == 'Username yang anda masukkan salah' || value == 'Username kosong, isi dengan benar') {
                    $(".username").addClass('has-error');
                  }
                  else{
                    $(".username, .password-input").addClass('has-error');
                  }
                  $('input#username').focus().val('');
                  $('input#password').val('');
                }
                swal({
                  title:'Login Gagal',
                  text: value,
                  type:'error',
                  timer: 2000
                });
              });
              $('#login').find('span').addClass('fa-sign-in').removeClass('fa-spinner fa-spin');
              $('.log-in').addClass('fa-arrow-right').removeClass('fa-spinner fa-spin');
            }
            else if (data.status == 'success') {
              if (data.active_status == "1") {
                if (data.level == 'admin') {
                  window.location.href= data.url_target;
                }
                else{              
                  window.location.href= data.url_target;
                }
                $('#login').find('span').addClass('fa-check').removeClass('fa-spinner fa-spin');
                $('.log-in').addClass('fa-check').removeClass('fa-spinner fa-spin');
              }
              else{
                $('input#username').focus().val('');
                $('input#password').val('');
                swal({
                  title:'Login Gagal',
                  text: 'Akun yang anda gunakan dinonaktifkan',
                  type:'error',
                  timer: 2000
                });
                $('#login').find('span').addClass('fa-sign-in fa-spinner').removeClass('fa-spinner fa-spin');
                $('.log-in').addClass('fa-arrow-right').removeClass('fa-spinner fa-spin');
              }
            }        
          },
          error: function(){
            swal({
              title:'Login Error',
              text: 'Maaf, telah terjadi error pada server!',
              type:'error',
              timer: 2000
            });
            $('#login').find('span').addClass('fa-sign-in').removeClass('fa-spinner fa-spin');
            $('.log-in').addClass('fa-arrow-right').removeClass('fa-spinner fa-spin');
          }
        });
      }
      else{
        if ($('input[name=username]').val() == '') {
          var value = 'Username kosong, isi dengan benar';
          $(".username").addClass('has-error');
          $('input#username').focus().val('');
          if ($('input[name=password]').val() == '') {
            $(".password-input").addClass('has-error');
            var value = 'Username dan password kosong, isi dengan benar';
          }
        }
        else if ($('input[name=password]').val() == '') {
          var value = 'Password kosong, tolong disi dengan benar';
          $(".password-input").addClass('has-error');
          $('input#password').focus().val('');
        }
        swal({
          title:'Login Gagal',
          text: value,
          type:'error',
          timer: 2000
        });
      }
    });

    $(document).on('click', '.close', function(){
      $('#alert-place').css('margin-bottom','0');
      $('.login-box').css('margin','11% auto');
    });
    
});