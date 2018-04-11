  var delay = (function(){
    var timer = 0;
    return function(callback, ms){
      clearTimeout(timer);
      timer = setTimeout(callback, ms);
    };
  })();

  moment.locale('id');
  
  /*Swal Config*/
  swal.setDefaults({
    onOpen: function() {
      $('body').addClass('modal-show');
      $('.swal2-container').addClass('style-2');
    }
  });
  /*END -- Swal Config*/

  $(function(){
    /*Onclick Event*/
    $(document).on('click', '[data-widget=remove]', function(eve){
        eve.preventDefault();

        var card = $(this).parent().parent().parent();
        if (check_array_exist(card[0].classList, 'card')) card.slideUp();
    });
    
    $(document).on('click', '.modal .refresh-modal-form', function(eve){
        eve.preventDefault();
        $('.modal').find('input[type=text], input[type=number], input[type=email]').val('');
        $('.modal form .select2').val(null).trigger('change');
        $(".modal").find('.is-invalid').removeClass('is-invalid');
        $(".modal").find('.is-invalid-select').removeClass('is-invalid-select');
        $(".modal").find('.invalid-feedback').remove();
        $('.modal #alert-place').text('');
        try {
        $('.modal input[type="radio"]').iCheck('uncheck');
        }
        catch (error) {

        }
    });
    /*END -- Onclick Event*/
  })

  /*Function*/
  /*Function: Get JSON Respon*/
  function getJSON_async(url,data,timeout,error_message){
    if (data != undefined) {
      data['csrf_key'] = token;
    }
    else{
      data = {'csrf_key' : token};
    }

    return new Promise(function(solve,reject){
      var json_respons = $.ajax({
        type: 'POST',
        url: url+'?token='+token+'&key='+rand_val(30),
        data: data,
        dataType:'json',
        beforeSend: function(a,b){
          load_inval();
        },
        complete: function(xhr,status){
          if (xhr.status == 200 && status == 'success') {
            var data_respon = xhr.responseJSON;
            if (data_respon.n_token != null) {
              token = data_respon.n_token;
            }
            else{
              token = rand_val();
            }
            setTimeout(function(){
              $('.modal .load-data').remove();
              clearInterval(global_vars.load_interval);
              if (data_respon.login_rld == null) {
                solve(data_respon);
              }
              else{
                data_respon.status = '0';
                data_respon.statusText = 'Session anda telah berakhir dan telah direset kembali!';
                reject(data_respon);
              }
            },timeout);
          }
        },
        error:function(jqXHR,status,error){
          if (jqXHR.status == 500) {
            console.log('Error '+jqXHR['status']+' = '+jqXHR['statusText']);
          }
          else if (jqXHR.status == 200) {
            jqXHR.statusText = 'Parser Error';
            console.log('Error '+jqXHR['status']+' = '+jqXHR['statusText']);
          }
          else if (jqXHR.status == 0) {
            jqXHR.statusText = 'No Respon From Server';
            console.log('Error '+jqXHR['status']+' = '+jqXHR['statusText']);
          }
          else{
            console.log('status = '+status);
          }
          reject(jqXHR);
          $('.modal .load-data').replaceWith('');
          clearInterval(global_vars.load_interval);
          if (error_message == true) {
            swal({
              title:'Error',
              html: 'Maaf, terjadi kesalahan!'
                  +'<p style="text-align:right;"><a href="" class="show-error">Show Error</a></p><div style="font-family:Segoe UI;text-align: center;display:none" class="error-detail">Error '+jqXHR.status+': '+jqXHR.statusText+'</div>',
              type:'error',
              confirmButtonText:'<i class="fa fa-check"></i> Ok'
            });
          }
        }
      });
    });
  }

  /*Function: Get HTML Respon*/
  function getHtml_page(data){
    data['csrf_key'] = token;
    return $.ajax({
      type: 'POST',
      url: 'http://'+global_vars.host+'/siakad-uncp/admin/html_request',
      data: data,
      global:false,
      async:false,
      complete: function(xhr){
        /*$.getScript("http://localhost/siakad-uncp/template/backend/adminlte/dist/js/app_elementJS.js");*/
      },
      success:function(msg){
      }
    }).responseText;
  }
  /*END -- Function: Get HTML Respon*/

  /*Function: Get HASH value*/
  function getUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  }
  /*END -- Function: Get HASH value*/

  function load_inval(){
    clearInterval(global_vars.load_interval);
    var i = 0;
    global_vars.load_interval = setInterval(function(){
      $('.load-data').append('. ');
      i++;
      if (i == 4) {
        $('.load-data').html('Memproses Data');
        i = 0;
      }
    },400);
  }

  function modal_animated(animated, remove_animated){
    $('.modal .modal-dialog').removeClass(remove_animated + ' animated');
    var animated = $('#myModal .modal-dialog, #myModal-pt .modal-dialog').addClass(animated + ' animated')
  }

  /*Function: Check Array key Exist*/
  function check_array_exist(array_dt,val){
    var array_len = array_dt.length;
    var status;
    $.each(array_dt, function(index,dt){
      if (dt == val) {
        status = true;
        return false;
      }
      else if (index+1 == array_len && dt != val) {
        status  = false;
      }
    });
    return status;
  }
  /*END -- Check Array key Exist*/

  /*Function: Random value*/
  function rand_val(num){
    if (num == null) {
      num = 20;
    }
    var string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    var str_length = string.length;
    var val = '';
    for (var i=1; i <= num ; i++) { 
      var start = Math.floor(Math.random() * str_length);
      val += string[start];
    }
    return val;
  }
  /*END -- Function: Random value*/

  /*Function: hashchange*/
  function start_hashchange(callback){
    $(window).off('hashchange');
    $(window).bind('hashchange', function(eve){
        var hash = $.param.fragment();
        init_hashchange('begin');
        callback(hash);
        init_hashchange('end');
    });
    $(window).trigger('hashchange');
  }
  /*END -- Function: hashchange*/

  /*Function: init hashchange*/
  function init_hashchange(state){
      if (state == 'begin') {
        $('#batal').text('Batal');
        $('.modal .submit-btn, .modal .submit-again-btn').hide();
        $('.modal .load-data').replaceWith('');
        $('.modal .modal-body').append('<p class="load-data text-center mb-0">Memproses Data</p>');
      } else if (state == 'end') {
        $('.modal #batal').prepend('<li class="fa fa-times"></li> ');
      }
  }
  /*END -- Function: init hashchange*/

  /*Function: hashchange action*/
  function hashchange_act(hash, callback){
    if (hash == 'tambah') {
        $('.modal .load-data').replaceWith('');
        $('#myModal form, #myModal .list-selected, #myModal .data-message').hide();
        $('.modal .submit-btn, .modal .submit-again-btn').show();
        $('#myModal').modal('show');
        $('.modal').addClass('modal-info').find('.modal-dialog').addClass('modal-lg');
        modal_animated('zoomIn');
        callback();
        $('#myModal #form-input').attr('action','tambah');
        $('#myModal #submit').text('Simpan');
        $('#myModal #submit').prepend('<li class="fa fa-save"></li> ');
        $('#myModal #submit-again').prepend('<li class="fa fa-clone"></li> ');
    } 
    else if (hash.search('tambah') == 0) {
        $('#myModal form, #myModal .list-selected, #myModal .data-message').hide();
        $('#myModal .submit-btn').attr('id','submit');
        $('#myModal #form-input').attr('action','tambah');
        $('.modal').addClass('modal-info').find('.modal-dialog').addClass('modal-lg');
        $('#myModal').modal('show');
        modal_animated('zoomIn');
        var data = callback();
        if (data != undefined) {
            data.then(function(dt){
              $('#myModal .submit-btn').attr('id','submit').html('<li class="fa fa-save"></li> Simpan</button>');
              if (global_vars.load_state == true && global_vars.load_state != false) {
                global_vars.load_state = false;
                $('.modal .modal-body').append('<p class="load-data text-center">Memproses Data</p>');
                $('#myModal form, #myModal .submit-btn, #myModal .list-selected').hide();
                load_inval();
              }
              else{
                if (dt.total_rows != null && dt.total_rows > 0 || dt.status_jdl != null && dt.status_jdl == 1 || global_vars.path.search('admin/data_master/data_fakultas_pstudi') > 0 && getUrlVars()['fk'] != undefined || global_vars.path.search('admin/data_master/data_fakultas_pstudi') > 0 && getUrlVars()['prodi_kons'] != undefined) {
                  if (getUrlVars()['data'] != undefined && getUrlVars()['data'] == 'alumni' || getUrlVars()['data'] != undefined && getUrlVars()['data'] == 'drop_out') {
                    $('.modal .submit-btn').show();
                  }
                  else{
                    $('.modal .submit-btn, .modal .submit-again-btn').show();
                  }
                  $('#myModal .submit-btn').html('<li class="fa fa-save"></li> Simpan');
                  $('#myModal .submit-again-btn').html('<li class="fa fa-clone"></li> Simpan dan Tambah');
                }
                else{
                  if (dt.message != null && dt.message != '') {
                    $('.data-message .content-message').addClass('centered-text').html(dt.message);
                  }
                  else{
                    $('.data-message .content-message').addClass('centered-text').html('Maaf, data yang anda cari tidak ditemukan');
                  }
                  $('.modal .submit-btn, .modal .submit-again-btn').hide();
                  $('#myModal #batal').text('Tutup').prepend('<li class="fa fa-times"></li> ');
                  $('.data-message').show();
                }
              }
            }).catch(function(error){
              $('#myModal .submit-btn').attr('id','submit').html('<li class="fa fa-save"></li> Simpan</button>').hide();
              $('#myModal #batal').text('Tutup').prepend('<li class="fa fa-times"></li> ');
              $('.modal .submit-btn, .modal .submit-again-btn').hide();
              $('.data-message').show();
              $('.data-message .content-message').addClass('centered-text').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
            });
        } else{
            $('.modal .load-data').remove();
        }
    }
    else if(hash.search('edit') == 0){
        $('#myModal form, #myModal .submit-again-btn, .data-message').hide();
        $('.modal').addClass('modal-success').find('.modal-dialog').addClass('modal-lg');
        $('#myModal').modal('show');
        modal_animated('zoomIn');
        var data = callback();
        if (data != undefined) {
            Pace.restart();
            data.then(function(dt){
                if (dt.total_rows != null && dt.total_rows > 0 || dt.status_jdl != null && dt.status_jdl == 1) {
                    $('#myModal #form-input').attr('action','update');
                    $('#myModal .submit-btn').text('Update').prepend('<li class="fa fa-pencil-square"></li> ').show();
                }
                else{
                    if (dt.message != null && dt.message != '') {
                    $('.data-message .content-message').addClass('centered-text').html(dt.message);
                    }
                    else{
                    $('.data-message .content-message').addClass('centered-text').html('Maaf, data yang anda cari tidak ditemukan');
                    }
                    $('.modal .submit-btn, .modal .submit-again-btn, .modal .list-selected').hide();
                    $('#myModal #batal').text('Tutup').prepend('<li class="fa fa-times"></li> ');
                    $('.data-message').show();
                }
            }).catch(function(error){
                $('#myModal #batal').text('Tutup').prepend('<li class="fa fa-times"></li> ');
                $('.modal .submit-btn, .modal .submit-again-btn, .modal .list-selected').hide();
                $('.data-message').show();
                $('.data-message .content-message').addClass('centered-text').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
            });
        }
        else{
            $('.modal .load-data').remove();
        }
    }
    else if(hash.search('hapus') == 0){
        $('#myModal').modal('show');
        $('#myModal form, #myModal #submit-again, .data-message').hide();
        $('.modal').addClass('modal-danger').find('.modal-dialog').removeClass('modal-lg modal-sm');
        modal_animated('zoomIn');
        var data = callback();
        if (data != undefined) {
            data.then(function(dt){
                if (dt.total_rows != null && dt.total_rows > 0 || dt.status_jdl != null && dt.status_jdl == 1) {
                    $('#myModal #form-input').attr('action','delete');
                    $('#myModal #submit').text('Hapus').show().prepend('<li class="fa fa-trash"></li> ');
                }
                else{
                    if (dt.message != null && dt.message != '') {
                        $('.data-message .content-message').addClass('centered-text').html(dt.message);
                    }
                    else{
                        $('.data-message .content-message').addClass('centered-content').html('Data yang ingin anda hapus tidak ditemukan');
                    }
                    $('#myModal form,#myModal .submit-btn, #myModal .submit-again-btn, #myModal .list-selected').hide();
                    $('#myModal #batal').text('Tutup').prepend('<li class="fa fa-times"></li> ');
                    $('.data-message').show();
                }
            }).catch(function(error){
                $('#myModal form, .modal .submit-btn, .modal .submit-again-btn, .list-selected').hide();
                $('#myModal #batal').text('Tutup').prepend('<li class="fa fa-times"></li> ');
                $('.data-message').show();
                $('.data-message .content-message').addClass('centered-text').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
            });
        }
        else{
            $('.modal .load-data').remove();
        }
    }
    else if (hash == 'delete_selected' || hash.search('delete_selected')==0) {
        $('#myModal form, #submit-again').hide();
        $('.modal').addClass('modal-danger').find('.modal-dialog').removeClass('modal-lg modal-sm');
        $('#myModal').modal('show');
        $('.data-message').show().find('.content-message').text('');
        modal_animated('zoomIn');
        var data = callback();
        if (data != undefined) {
            data.then(function(dt){
                if (dt.total_rows != null && dt.total_rows > 0 || dt.status_jdl != null && dt.status_jdl == 1) {
                    $('#myModal #form-input').attr('action','delete');
                    $('#myModal #submit').attr('id','delete-selected').html('<li class="fa fa-trash"></li> Hapus').show();
                    $('#myModal #delete-selected').html('<li class="fa fa-trash"></li> Hapus').show();
                }
                else{
                    if (dt.message != null && dt.message != '') {
                    $('.data-message .content-message').addClass('centered-text').html(dt.message);
                    }
                    else{
                    $('.data-message .content-message').addClass('centered-text').html('Maaf, data yang anda cari tidak ditemukan');
                    }
                    $('.modal .submit-btn, .modal .submit-again-btn, .modal .list-selected').hide();
                    $('#myModal #batal').html('<li class="fa fa-times"></li> Tutup');
                    $('.data-message').show();
                }
                $('#myModal form').hide();
            }).catch(function(error){
                $('#myModal #batal').html('<li class="fa fa-times"></li> Tutup');
                $('.modal .submit-btn, .modal .submit-again-btn, .modal .list-selected').hide();
                $('.data-message').show();
                $('.data-message .content-message').addClass('centered-text').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
            });
        }
        else{
            $('.modal .load-data').remove();
        }
    }
    else if(hash.search('detail') == 0){
        $('#submit, #submit-again, .data-message').hide();
        $('#batal').text('Tutup');
        callback();
    }
    else{
        callback();
    }
  }
  /*END -- Function: hashchange action*/

  /*Function: Submit Ajax*/
  function submit_ajax(set){
    var url = set.url();

    $(document).off('click', '#submit');
    $(document).on('click', '#submit', function(eve){
        eve.stopImmediatePropagation();
        eve.preventDefault();
        
        $('#form-input, form').find('.is-invalid').removeClass('is-invalid');
        $('#form-input, form').find('.is-invalid-select').removeClass('is-invalid-select');
        $('#form-input, form').find('.invalid-feedback').remove();
        $('#alert-place').text('');
        var submit_btn = $(this);
        var submit_btn_ic = submit_btn.find('li');
        var action = $('#form-input').attr('action');
        if (url.url == 'custom') {
            var url_target = 'http://'+url.custom+'/action/'+action+'?token='+token+'&key='+rand_val(30);
        }
        else {
            var host = url.host;
            var controller_path = url.controller_path;
            var url_target = 'http://'+host+controller_path+'/action/'+action+'?token='+token+'&key='+rand_val(30);
        }

        var data = set.datasend();
        if (data == null || data == undefined) {
            var data = $('#form-input').serialize();
        }
        /*data = datasend+'&csrf_key='+token;*/

        $.ajax(url_target, {
            dataType: 'json',
            type: 'POST',
            data: data,
            beforeSend: function(){
                submit_btn_ic.removeClass('fa-save fa-trash fa-pencil-square').addClass('fa-circle-o-notch fa-spin');
                submit_btn.addClass('disabled');
                $('#alert-place').text('');
            },
            complete: function(xhr){
                if (xhr.responseJSON['login_rld'] != null) {
                    $('#alert-place').text('');
                    $('#alert-place').prepend(
                        '<div class="alert alert-info alert-dismissible">'
                        +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                        +'  <h4><i class="icon fa fa-info-circle"></i> Info!</h4>'
                        +'  <font>Session anda telah berakhir, silihkan klik ulang untuk melanjutkan proses!</font>'
                        +'</div>'
                    );
                }
                if (action == 'tambah') {
                    submit_btn_ic.removeClass('fa-circle-o-notch fa-spin').addClass('fa-save');
                }
                else if (action == 'update') {
                    submit_btn_ic.removeClass('fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
                }
                else if (action == 'delete') {
                    submit_btn_ic.removeClass('fa-circle-o-notch fa-spin').addClass('fa-trash');
                }
                submit_btn.removeClass('disabled');
                $('.submit-process').fadeOut();

            },
            success: function(data){
                token = data.n_token;
                if (action == 'tambah' && data.status == 'success') {
                    set.callback_rn(action, data);
                    $('#myModal').modal('hide');
                    swal({
                        title:'Data Berhasil Di Simpan',
                        type:'success',
                        timer: 2000
                    });
                }
                else if (action == 'update') {
                    if (data.status == 'success') {
                        set.callback_rn(action, data);
                        $('#myModal').modal('hide');
                        swal({
                            title:'Data Berhasil Di Update',
                            type:'success',
                            timer: 2000
                        });
                    }
                    else if (data.status == 'nothing_change') {
                        $('.modal').modal('hide');
                    }
                }
                else if (action == 'delete') {
                    if (data.status == 'success') {
                        set.callback_rn(action, data);
                        $('#myModal').modal('hide');
                        swal({
                            title:'Data Berhasil Di Hapus',
                            type:'success',
                            timer: 2000
                        });
                    }
                    else{
                        var error_message = '  <font>Gagal menghapus data</font>';
                        if (data.status == 'no_active_thn_jdl') {
                            error_message = '  <font>'+data.error_message+'</font>';
                        }
                        else if (data.status == 'no_active_thn_kls') {
                            error_message = '  <font>'+data.error_message+'</font>';
                        }
                        $('#alert-place').prepend(
                            '<div class="alert alert-danger alert-dismissible mt-4">'
                            +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                            +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
                            +error_message
                            +'</div>'
                        );
                    }
                }

                if (action == 'tambah' && data.status == 'failed' || action == 'update' && data.status == 'failed') {
                    $('#alert-place').prepend(
                        '<div class="alert alert-danger alert-dismissible mt-4">'
                        +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                        +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
                        +'  <font><ul style="padding-left:15px"></ul></font>'
                        +'</div>'
                    );
                    $.each(data.errors, function(key, value){
                        $('#alert-place font ul').append('<li>'+value+'</li>');
                        $("[name="+key+"]").addClass('is-invalid');
                        var input_dt = $("[name="+key+"]")[0];
                        var text = document.createElement('div');
                        text.setAttribute('class', 'invalid-feedback');
                        text.innerHTML = value;
                        if (input_dt.localName == 'input') {
                            input_dt.parentNode.insertBefore(text, input_dt.nextSibling);
                        }
                        else{
                            if (input_dt.localName == 'select' && check_array_exist(input_dt.classList, 'select2')) {
                                $("[name="+key+"]").siblings('.select2').find('.select2-selection ').addClass('is-invalid-select');
                                input_dt.parentNode.append(text);
                            }
                        }
                    });
                }
                else if (action == 'tambah' && data.status != 'success' && data.status != 'failed' || action == 'update' && data.status != 'success' && data.status != 'failed') {
                    $('#alert-place').prepend(
                        '<div class="alert alert-danger alert-dismissible mt-4">'
                        +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                        +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
                        +'  <font>Ada masalah ketika menyimpan ke database</font>'
                        +'</div>'
                    );
                }
            },
            error: function(){
                if (action == 'tambah') {
                    submit_btn.removeClass('fa-circle-o-notch fa-spin').addClass('fa-save');
                }
                else if (action == 'update') {
                    submit_btn.removeClass('fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
                }
                else if (action == 'delete') {
                    submit_btn.removeClass('fa-circle-o-notch fa-spin').addClass('fa-trash');
                }
                swal({
                    title:'Error',
                    text: 'Maaf, telah terjadi error pada server!',
                    type:'error',
                    timer: 2000
                });
            }
        });
    });

    $(document).off('click', '#submit-again');
    $(document).on('click', '#submit-again', function(eve){
        eve.stopImmediatePropagation();
        eve.preventDefault();
        
        $('#form-input, form').find('.is-invalid').removeClass('is-invalid');
        $('#form-input, form').find('.is-invalid-select').removeClass('is-invalid-select');
        $('#form-input, form').find('.invalid-feedback').remove();
        $('#alert-place').text('');
        var submit_btn = $(this);
        var submit_btn_ic = submit_btn.find('li');
        var action = $('#form-input').attr('action');
        if (url.url == 'custom') {
            var url_target = 'http://'+url.custom+'/action/'+action+'?token='+token+'&key='+rand_val(30);
        }
        else {
            var host = url.host;
            var controller_path = url.controller_path;
            var url_target = 'http://'+host+controller_path+'/action/'+action+'?token='+token+'&key='+rand_val(30);
        }

        var data = set.datasend();
        if (data == null || data == undefined) {
            var data = $('#form-input').serialize();
        }
        /*data = datasend+'&csrf_key='+token;*/

        $.ajax(url_target, {
            dataType: 'json',
            type: 'POST',
            data: data,
            beforeSend: function(){
                submit_btn_ic.removeClass('fa-clone').addClass('fa-circle-o-notch fa-spin');
                submit_btn.addClass('disabled');
                $('#alert-place').text('');
            },
            complete: function(xhr){
                if (xhr.responseJSON['login_rld'] != null) {
                    $('#alert-place').text('');
                    $('#alert-place').prepend(
                        '<div class="alert alert-info alert-dismissible mt-4">'
                        +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                        +'  <h4><i class="icon fa fa-info-circle"></i> Info!</h4>'
                        +'  <font>Session anda telah berakhir, silihkan klik ulang untuk melanjutkan proses!</font>'
                        +'</div>'
                    );
                }
                if (action == 'tambah') {
                    if (xhr.responseJSON['status'] == 'success') {
                        submit_btn_ic.removeClass('fa-circle-o-notch fa-spin').addClass('fa-check');
                        setTimeout(function(){
                            submit_btn_ic.removeClass('fa-check fa-circle-o-notch fa-spin').addClass('fa-clone');
                        },2000);
                    }
                    else{
                        submit_btn_ic.removeClass('fa-refresh fa-spin').addClass('fa-clone');
                    }
                }
                submit_btn.removeClass('disabled');
                $('.submit-process').fadeOut();
            },
            success: function(data){
                if (action == 'tambah') {
                    if (data.status == 'success') {
                        set.callback_rn(action, data);
                        $('.modal #form-input,.modal form').find('input[type=text], input[type=number]').val('');
                        $('.modal input[type="radio"]').iCheck('uncheck');
                        $('.modal .select2').val(null).trigger('change');
                        $('.modal').find('.is-invalid').removeClass('is-invalid');
                        swal({
                            title:'Data Berhasil Di Simpan',
                            type:'success',
                            timer: 2000
                        });
                    }
                    else if (data.status == 'failed') {
                        $('#alert-place').prepend(
                            '<div class="alert alert-danger alert-dismissible mt-4">'
                            +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                            +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
                            +'  <font><ul style="padding-left:15px"></ul></font>'
                            +'</div>'
                        );
                        $.each(data.errors, function(key, value){
                            $('#alert-place font ul').append('<li>'+value+'</li>');
                            $("[name="+key+"]").addClass('is-invalid');
                            var input_dt = $("[name="+key+"]")[0];
                            var text = document.createElement('div');
                            text.setAttribute('class', 'invalid-feedback');
                            text.innerHTML = value;
                            if (input_dt.localName == 'input') {
                                input_dt.parentNode.insertBefore(text, input_dt.nextSibling);
                            }
                            else{
                                if (input_dt.localName == 'select' && check_array_exist(input_dt.classList, 'select2')) {
                                $("[name="+key+"]").siblings('.select2').find('.select2-selection ').addClass('is-invalid-select');
                                input_dt.parentNode.append(text);
                                }
                            }
                        });
                    }
                    else{
                        $('#alert-place').prepend(
                            '<div class="alert alert-danger alert-dismissible mt-4">'
                            +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                            +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
                            +'  <font>Ada masalah ketika menyimpan ke database</font>'
                            +'</div>'
                        );
                    }
                }
            },
            error: function(){
                if (action == 'tambah') {
                    submit_btn.removeClass('fa-refresh fa-spin').addClass('fa-clone');
                }
                swal({
                    title:'Error',
                    text: 'Maaf, telah terjadi error pada server!',
                    type:'error',
                    timer: 2000
                });
            }
        });
    });
  }
  /*END -- Function: Submit Ajax*/

  /*Function: Delete Multiple Data*/
  function delete_multiple_dt(callback) {
    $(document).off('click','#delete-selected');
    $(document).on('click','#delete-selected', function(eve){
        eve.stopImmediatePropagation();
        eve.preventDefault();
        
        var data = $('#data').attr('name'),
        btn_act = $(this).find('li');
        btn_act.removeClass('fa-trash').addClass('fa-circle-o-notch fa-spin');
        var return_data = callback();
        if (return_data.dt != undefined && return_data.dt < 1) {
            $('#alert-place').html(
                '<div class="alert alert-danger alert-dismissible">'
                +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
                +'  <font>Silahkan pilih data yang ingin dihapus</font>'
                +'</div>'
            );
        }
        if (return_data.delete_dt != undefined) {
            return_data.delete_dt.then(function(data){
                btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-trash');
                if (data.status == 'success') {
                    swal({
                        title:'Data Berhasil Di Hapus',
                        type:'success',
                        timer: 2000
                    });
                }
                else{
                    if (data.message != null) {
                        $('#alert-place').html(
                            '<div class="alert alert-danger alert-dismissible">'
                            +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                            +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
                            +'  <font>'+data.message+'</font>'
                            +'</div>'
                        );
                    }
                    else if (data.errors == null || data.message == null) {
                        $('.data-message').show();
                        $('.data-message .content-message').addClass('centered-content').html('Maaf, terjadi kesalahan ketika menghapus data!');
                    }
                }
            }).catch(function(error){
                btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-trash');
                $('#alert-place').html(
                    '<div class="alert alert-danger alert-dismissible">'
                    +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
                    +'  <font>Terjadi kesalahan saat menghapus data, <b>Error '+error.status+': '+error.statusText+'</b></font>'
                    +'</div>'
                );
            });
        }
    });
  }
  /*END -- Function: Delete Multiple Data*/

  /*Function: Show Datatables Row Detail*/
  function show_row_detail(set) {
    $(document).off('click', '.detail-row');
    $(document).on('click', '.detail-row', function (eve) {
        eve.stopImmediatePropagation();
        eve.preventDefault();

        var tr = $(this).closest('tr');
        var data_row = $(this).attr('data-search');
        var row = set.callback(data_row, tr);
  
        if (row != undefined) {
            if (row.child.isShown()) {
                $('div.slider-detail', row.child()).slideUp(function(){
                    row.child.hide();
                });
                $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
            }
            else {
                row.child(row_detail(row.data(), data_row, set.detail_dt(row.data(), data_row)), 'no-padding').show();
                $('div.slider-detail', row.child()).slideDown();
                $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
            }
        }
    });
  }
  /*END -- Function: Show Datatables Row Detail*/

  /*Function: Datatables Row Detail*/
  function row_detail(str, data, detail_dt) {
    var row_respon = detail_dt;
    if (row_respon.detail_row_respon != undefined) {
      return '<div class="slider-detail text-center" data-search="'+row_respon.id_row+'" style="display:none;margin: 10px 0 10px 0"><font class="load-data">Memproses Data</font></div>';
    }
  }
  /*END -- Function: Datatables Row Detail*/