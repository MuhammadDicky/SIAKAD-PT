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

  /*Onclick Event*/
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
              clearInterval(load_interval);
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
          clearInterval(load_interval);
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
      url: 'http://'+host+'/siakad-uncp/admin/html_request',
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
    clearInterval(load_interval);
    var i = 0;
    load_interval = setInterval(function(){
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
        $('.modal').addClass('modal-info').find('.modal-dialog').addClass('modal-lg');;
        $('#myModal').modal('show');
        modal_animated('zoomIn');
        var data = callback();
        if (data != undefined) {
            data.then(function(dt){
              $('#myModal .submit-btn').attr('id','submit').html('<li class="fa fa-save"></li> Simpan</button>');
              if (load_state == true && load_state != false) {
                load_state = false;
                $('.modal .modal-body').append('<p class="load-data text-center">Memproses Data</p>');
                $('#myModal form, #myModal .submit-btn, #myModal .list-selected').hide();
                load_inval();
              }
              else{
                if (dt.total_rows != null && dt.total_rows > 0 || dt.status_jdl != null && dt.status_jdl == 1 || path.search('admin/data_master/data_fakultas_pstudi') > 0 && getUrlVars()['fk'] != undefined || path.search('admin/data_master/data_fakultas_pstudi') > 0 && getUrlVars()['prodi_kons'] != undefined) {
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