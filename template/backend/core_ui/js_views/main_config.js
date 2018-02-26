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