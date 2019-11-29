var path = window.location.pathname,
host     = window.location.hostname + (window.location.port !== '' ? ':' + window.location.port : '')
protocol = window.location.protocol;
vars     = user_last_online.split('/'),
load_interval = window.load_interval;

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout(timer);
    timer = setTimeout(callback, ms);
  };
})();

if (path == beranda_mhs_path+'/data_mhs' || path == beranda_mhs_path+'/data_jadwal' || path == beranda_mhs_path+'/nilai_mhs') {
  var controller_path = beranda_mhs_path;
}
else if (path == beranda_ptk_path+'/data_tenaga_pendidik' || path == beranda_ptk_path+'/jadwal_mengajar' || path == beranda_ptk_path+'/nilai_mhs') {
  var controller_path = beranda_ptk_path;
}

$(function(){

    $(document).ajaxSend(function(eve,xhr,settings){
      if (settings['data'].search('csrf_key=') < 0) {
        settings['data'] = settings['data']+'&csrf_key='+token;
      }
    });

    /*Mousewheel Horizontal*/
    $('.control-panel-data').mousewheel(function(eve,delta){
      eve.preventDefault();
      this.scrollLeft -= (delta*40);
    });
    /*END -- Mousewheel Horizontal*/

    /*Window Resize*/
    $(window).resize(function(){ 
      if ($(window).width() > 980) {
        if ($('.box-profile .profil-kompetensi').text().length > 20) {
          $('.box-profile .profil-kompetensi').removeClass('pull-right').css('margin-bottom','0px');
        }
        if ($('.box-profile .profil-jenjang').text().length > 12) {
          $('.box-profile .profil-jenjang').removeClass('pull-right').css('margin-bottom','0px');
        }
        if ($('.box-profile .profil-kelas-didik').text().length > 22) {
          $('.box-profile .profil-kelas-didik').removeClass('pull-right').css('margin-bottom','0px');
        }
      }      

      if ($(window).width() > 1062) {        
        $('.box-profile .profil-jenjang').addClass('pull-right');
      }
      if ($(window).width() <= 1062 || $(window).width() <= 1342) {        
        $('.box-profile .profil-jenjang').removeClass('pull-right').css('margin-bottom','0px');        
      }

      /*mobile screen size*/
      if ($(window).width() <= 980) {
        $('.box-profile .profil-kompetensi').addClass('pull-right');        
        $('.box-profile .profil-jenjang').addClass('pull-right');
        $('.box-profile .profil-kelas-didik').addClass('pull-right');
      }

      if($(window).width() < 725){

      }
    });
    /*END -- Window Resize*/

    /*Moment JS*/
    moment.locale('id');
    $('#user-widget-detail small').text('Terakhir kali login '+moment(vars[0]).fromNow());
    $('#tab_info_akun .detail-nidn,#tab_info_akun .detail-nim').text(moment(vars[0]).fromNow());
    /*END -- Moment JS*/

    /*First Load Page*/
    if (path == index_path || path == index_path+'/') {
      if (vars[1] == 'ptk') {
        Pace.once('done', function(){
          daftar_jadwal(true);
          var detail_ptk = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{data:'ptk'});
          detail_ptk.then(function(detail_ptk){
            chart_ptk(detail_ptk.canvas);
            if (detail_ptk.pd.length > 4) {
              $('.grafik-ptk ul.daftar-pd').css('height','163px');
            }
            else{
              $('.grafik-ptk ul.daftar-pd').css('height','');
            }
            $('.grafik-ptk ul.daftar-pd').text('');
            $.each(detail_ptk.pd, function(index,data_record){
              $('.grafik-ptk ul.daftar-pd').append(
                '<li><a>'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')<span class="pull-right badge" style="background-color:'+data_record.color_detail+'">'+data_record.statik_ptk+'%</span></a></li>'
                );
            });
          }).catch(function(error){});
        });
      }
      else if (vars[1] == 'mhs') {
        daftar_jadwal_mhs(true);
      }
    }
    
    if (path == path_profil_pt) {
      $('#tab-identitas-pt .detail-data-pt').text('-');
      var results = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{data:'data_identitas_pt'},500);
      results.then(function(results){
        if (results.data == '') {
          $('#tab-identitas-pt .detail-data-pt').text('-');
        }
        else{
          $.each(results.data, function(index, data_record){
            $.each(data_record, function(name, data_record){
              if (data_record =='') {
                data_record ='-';
              }
              if (name == 'website') {
                $('#tab-identitas-pt .'+name).parents().attr('href',protocol + '//'+data_record);
              }
              if (name == 'rt' || name == 'rw') {
                $('#tab-identitas-pt .'+name).text(data_record);
              }
              $('#tab-identitas-pt .detail-data-pt.'+name).text(data_record);
            });          
          });
        }

        if (results.prodi == '') {
          $('#tab-identitas-pt #prodi .dl-horizontal dd').text('-');
        }
        else{
          $.each(results.prodi, function(index, data_record){
            $.each(data_record, function(name, data_record){
              if (data_record =='' || data_record =='0000-00-00') {
                data_record ='-';
              }
              $('#tab-identitas-pt #prodi span.'+name).text(data_record+' Orang');
              $('#tab-identitas-pt #prodi dd.'+name).text(data_record);
            });          
          });
        }

        if (results.konsentrasi == '') {
          $('#tab-identitas-pt #prodi .kons-pd-box').hide();
          $('#tab-identitas-pt #prodi .tbl-data-konst-pd').find('tbody').html('<tr><td colspan="2">Program studi saat ini tidak memiliki konsentrasi</td></tr>');
        }
        else{
          $('#tab-identitas-pt #prodi .kons-pd-box').show();
          $('#tab-identitas-pt #prodi .tbl-data-konst-pd').find('tbody').html('');
          var no = 1;
          $.each(results.konsentrasi, function(index,data_record){
            $('#tab-identitas-pt #prodi .tbl-data-konst-pd').find('tbody').append('<tr><td class="text-center">'+no+'</td><td>'+data_record.nm_konsentrasi+'</td></tr>');
            no++;
          });
        }
      }).catch(function(error){});
    }
    /*END -- First Load Page*/

    /*HASHCHANGE*/
    $(window).hashchange(function(){
      var hash = $.param.fragment();

      if (hash.search('tambah') == 0) {
        if (path.search('beranda_ptk/nilai_mhs') > 0) {
          var kelas = getUrlVars()['kelas'],
          mata_pelajaran = getUrlVars()['mata_pelajaran'];
          $('#form-input').show();
          $('#myModal .modal-title').text('Input Nilai Siswa');
          $('#myModal #form-input input[name=kelas]').val(kelas);
          $('#myModal #form-input input[name=mata_pelajaran]').val(mata_pelajaran);
          $('#myModal #form-input .input-nilai-ket').html('Input nilai siswa pada kelas&nbsp<strong>'+kelas+'</strong>&nbspdengan mata pelajaran&nbsp<strong>'+mata_pelajaran+'</strong>&nbsp!');
        }
        modal_animated('zoomIn');
        $('#myModal #form-input').attr('action','tambah');
        $('#myModal #submit').text('Input Nilai');
        $('.modal').addClass('modal-info');
        $('#myModal').modal('show');
      }

      else if (hash == 'tampilkan') {
        if (path == beranda_mhs_path+'/nilai_mhs') {
          $('#myModal #form-ambil-nilai').show();
        }
        modal_animated('zoomIn');
        $('#myModal #form-input').attr('action','ambil');
        $('#myModal #submit').text('Tampilkan Nilai');
        $('.modal').addClass('modal-success');
        $('#myModal').modal('show');
      }
    });    

    $(window).trigger('hashchange');
    /*END -- HASHCHANGE*/
    
    /*Modal Event*/
    $('#myModal, #myModal-sekolah').on('show.bs.modal',function(e){
      $('body').addClass('modal-show');      
    });

    $('#myModal').on('hidden.bs.modal',function(e){
      modal_animated('zoomOutDown');
      window.history.pushState(null,null,path);
      $('#myModal form').hide();
      $('#rincian-siswa').hide();
      $('#submit').show();
      $('#batal').text('Batal');
      $('#myModal #tamp-data, #myModal #delete-selected, #myModal #pindah-kelas').attr('id','submit');
      $('.timepicker').val('14:08');
      $('.modal').removeClass('modal-info');
      $('.modal').removeClass('modal-success');
      $('.modal').removeClass('modal-danger');
      $('.modal').removeClass('modal-primary');
      $('.modal').removeClass('modal-warning');
      $('#myModal #form-input').find('input[type=text],input[type=number],input[type=email]').val('');
      $('input[type="radio"]').iCheck('uncheck');
      $('#myModal select.select2_thn_angkatan, #myModal select.select2_kelas, #myModal select#select2_wali_kelas').text('');
      $('#myModal .select2').val(null).trigger('change');
      $('#myModal .select2').prop('disabled',false);
      $("#myModal").find('.has-error').removeClass('has-error');
      $('#alert-place').text('');
      $('#myModal #form-input .tab_ortu, #myModal #form-input .tab_wali').removeClass('active');      
      $('#myModal #tab_ortu, #myModal #tab_wali').removeClass('active');
      $('#form-input .tab_ortu, #form-input .tab_wali').find('a').attr('aria-expanded','false');
      $('#form-input .tab_siswa').addClass('active');      
      $('#form-input .tab_siswa').find('a').attr('aria-expanded','true');      
      $('#form-input #tab_siswa').addClass('active');
      $('#myModal .modal-dialog').removeClass('modal-lg');
      $('#myModal .data-message').hide();
      $('#myModal .data-message .content-message').addClass('centered-content');
      $('#myModal .data-message .content-message').html('Maaf, data yang anda cari tidak ditemukan');
    });    
    $('#myModal').on('hide.bs.modal',function(e){
      modal_animated('zoomOutDown');      
      $('.overflow-tab').scrollTop(0);      
    });
    /*END -- Modal Event*/

    /*Datatable Plugin*/
    /*END -- Datatable Plugin*/

    /*Select2 Plugin*/
    $(".select2_jadwal").select2({
      placeholder: "Pilih tahun akademik",      
      ajax: {
        url: protocol + '//'+host+path_home+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_thn_ajaran',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.jadwal,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },            
      minimumInputLength: 1,
      language: 'id',
      allowClear: true,
      templateResult: function formatselect(state){
        if (state.loading) {
          return state.text;
        }
        var vars_select = state.thn_ajaran_jdl,
        smstr = vars_select.split('/'),
        thn = smstr[0];
        if (smstr[1] == '1') {
          var semester = 'Ganjil';
        }
        else{
          var semester = 'Genap';
        }
        var $state = $(
          "<p style='margin-bottom:0px'>"+thn+"/"+semester+" "+state.nama_prodi+" ("+state.jenjang_prodi+")</p>"
        );
        if (state.text != undefined) {
          return $state;
        }
      }
    });
    /*END -- Select2 Plugin*/

    /*Onclick Event*/
    $(document).on('click','.show-about', function(eve){
      eve.preventDefault();
      $('#about').modal('show');
    });

    $('.refresh-data').on('click',function(eve){
      eve.preventDefault();
      $(this).find('i').addClass('fa-spin');
      if (path == path_profil_pt && $(this).attr('data-refresh') == 'data-identitas-pt') {
        $('#tab-identitas-pt #prodi .tbl-data-konst-pd').find('tbody').prepend('<tr class="load-row"><td colspan="2" class="load-data text-center">Memproses Data</td></tr>');
        var results = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{data:'data_identitas_pt'},500);
        results.then(function(results){
          if (results.data == '') {
            $('#tab-identitas-pt .detail-data-pt').text('-');
          }
          else{
            $.each(results.data, function(index, data_record){
              $.each(data_record, function(name, data_record){
                if (data_record =='') {
                  data_record ='-';
                }
                if (name == 'website') {
                  $('#tab-identitas-pt .'+name).parents().attr('href',protocol + '//'+data_record);
                }
                if (name == 'rt' || name == 'rw') {
                  $('#tab-identitas-pt .'+name).text(data_record);
                }
                $('#tab-identitas-pt .detail-data-pt.'+name).text(data_record);
              });          
            });
          }

          if (results.prodi == '') {
            $('#tab-identitas-pt #prodi .dl-horizontal dd').text('-');
          }
          else{
            $.each(results.prodi, function(index, data_record){
              $.each(data_record, function(name, data_record){
                if (data_record =='' || data_record =='0000-00-00') {
                  data_record ='-';
                }
                $('#tab-identitas-pt #prodi span.'+name).text(data_record+' Orang');
                $('#tab-identitas-pt #prodi dd.'+name).text(data_record);
              });          
            });
          }

          if (results.konsentrasi == '') {
            $('#tab-identitas-pt #prodi .kons-pd-box').hide();
            $('#tab-identitas-pt #prodi .tbl-data-konst-pd').find('tbody').html('<tr><td colspan="2" class="text-center">Program studi saat ini tidak memiliki konsentrasi</td></tr>');
          }
          else{
            $('#tab-identitas-pt #prodi .kons-pd-box').show();
            $('#tab-identitas-pt #prodi .tbl-data-konst-pd').find('tbody').html('');
            var no = 1;
            $.each(results.konsentrasi, function(index,data_record){
              $('#tab-identitas-pt #prodi .tbl-data-konst-pd').find('tbody').append('<tr><td class="text-center">'+no+'</td><td>'+data_record.nm_konsentrasi+'</td></tr>');
              no++;
            });
          }
        }).catch(function(error){});
      }
      delay(function(){
        $('.refresh-icon').removeClass('fa-spin');
      },1000);
    });

    $('.verifikasi-data').on('click',function(eve){
      eve.preventDefault();
      swal({          
        type:'info',
        title:'Peringatan',
        text:'Jika anda melakukan verifikasi data, maka data anda akan dinyatakan valid.',
        showCancelButton: true,
        confirmButtonText:'<i class="fa fa-check"></i> Verifikasi Data',
        cancelButtonText:'<i class="fa fa-times"></i> Batal',
      }).then(function(){
        swal({          
          title:'Data Terverifikasi',
          type:'success',
          timer: 2000
        });
        delay(function(){
          window.location.href=protocol + "//"+host+controller_path+"/verifikasi_data/true";
        },500);        
      });
    });

    $('.verifikasi-salah').on('click',function(eve){
      eve.preventDefault();
      swal({          
        type:'info',
        title:'Peringatan',
        text:'Apakah anda yakin data ini masih terdapat data yang tidak valid?.',
        showCancelButton: true,
        confirmButtonText:'<i class="fa fa-check"></i> Iya',
        cancelButtonText:'<i class="fa fa-times"></i> Batal',
      }).then(function(){
        swal({          
          title:'Verifikasi Data Diteruskan Ke Admin',
          type:'success',
          timer: 2000
        });
        delay(function(){
          window.location.href=protocol + "//"+host+controller_path+"/verifikasi_data/false";
        },500);        
      });
    });

    $('#change-pass').on('click',function(eve){
      eve.preventDefault();
      var old_pass = $('.old-password').val(),
      new_pass = $('.new-password').val(),
      re_pass = $('.renew-password').val(),
      btn_act = $(this).find('i');
      $("#old-password,#new-password,#renew-password").removeClass('has-error');
      if (old_pass !='' && new_pass !='' && re_pass !='') {
        btn_act.removeClass('fa-key').addClass('fa-circle-o-notch fa-spin');
        var change_pass = getJSON_async(protocol + '//'+host+path_home+'/action/change_password',{new_password:new_pass,renew_password:re_pass,old_password:old_pass},500,true);
        change_pass.then(function(change_pass){
          if (change_pass.status == 'success') {
            swal({
              type:'success',
              title:'Status Password',
              text:'Password berhasil diganti'
            });
            $('.old-password,.new-password,.renew-password').val('');
          }
          else if (change_pass.status == 'failed_db') {
            swal({
              type:'error',
              title:'Kesalahan',
              text:'Terjadi kesalahan dalam memperbahrui password'
            });
          }
          else {
            if (change_pass.errors['old_password']) {
              swal({
                type:'error',
                title:'Kesalahan',
                text:change_pass.errors['old_password']
              });
              $('.old-password,.new-password,.renew-password').val('');
              $("#old-password").addClass('has-error');
            }
            else if (change_pass.errors['new_password']){
              swal({
                type:'error',
                title:'Kesalahan',
                text:change_pass.errors['new_password']
              });
              $("#new-password,#renew-password").addClass('has-error');
            }
            else{
              swal({
                type:'error',
                title:'Kesalahan',
                text:change_pass.errors['renew_password']
              });
              $("#renew-password").addClass('has-error');
            }
          }
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-key');
        }).catch(function(error){
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-key');
        });
      }
      else{
        swal({
          type:'error',
          title:'Kesalahan',
          text:'Masukkan data password dengan lengkap'
        });
      }
    });

    $(document).on('click','.show-error', function(eve){
      eve.preventDefault();      
      $(".error-detail").show();
      $(".show-error").text('Hide Error').removeClass('show-error').addClass('hide-error');
    });

    $(document).on('click','.hide-error', function(eve){
      eve.preventDefault();      
      $(".error-detail").hide();
      $(".hide-error").text('Show Error').removeClass('hide-error').addClass('show-error');
    });
    /*END -- Onclick Event*/

    /*OnChange Event*/
    $('#box-jadwal .select2_jadwal, #box-nilai .select2_jadwal').on('change', function(){
      if ($(this).val() != null) {
        $('.tamp-jadwal, .tamp-all-jadwal, .tamp-nilai').removeClass('disabled');
      }
      else{
        $('.tamp-jadwal, .tamp-all-jadwal, .tamp-nilai').addClass('disabled');
      }
    });

    $('#box-content .select2_jadwal').on('change', function(){
      if ($(this).val() != null) {
        $('.tamp-kls').removeClass('disabled');
      }
      else{
        $('.tamp-kls').addClass('disabled');
      }
    });
    /*END -- OnChange Event*/

    /*Ajax Success Event*/
    $(document).ajaxSuccess(function(eve,xhr){
      token = xhr.responseJSON['n_token'];
    });
    /*END -- Ajax Success Event*/

});

  /*Function: Get JSON respon*/
  function getJSON_async(url,data,timeout,error_message){
    /*var rand_v = Math.floor(Math.random() * (99999999999999999 - 1000000000000000)) + 1000000000000000;*/
    if (data != undefined) {
      data['csrf_key'] = token;
    }
    else{
      data = {'csrf_key' : token};
    }
    return new Promise(function(solve,reject){
      var json_respons = $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType:'json',
        beforeSend: function(a,b){
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
        },
        complete: function(xhr,status){
          if (xhr.status == 200 && status == 'success') {
            var data_respon = xhr.responseJSON;
            token = data_respon.n_token;
            setTimeout(function(){
              $('.modal .load-data').replaceWith('');
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
  /*END -- Function: Get JSON respon*/

  /*Function: Get hash value*/
  function getUrlVars(){
    var vars_url = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
      hash = hashes[i].split('=');
      vars_url.push(hash[0]);
      vars_url[hash[0]] = hash[1];
    }
    return vars_url;
  }
  /*END -- Function: Get hash value*/

  function check_all(){
    /*document.getElementsByClassName('data_action').checked = true;*/
    $('.data_action').attr("checked",true);
  }

  function modal_animated(animated){
    var animated = $('#myModal .modal-dialog, #myModal-sekolah .modal-dialog').attr('class','modal-dialog '+animated+' animated');    
  }

  function collapse(string){
    var box = $(string);
      //Find the body and the footer
    var box_content = box.find("> .box-body, > .box-footer, > form  >.box-body, > form > .box-footer");
    if (!box.hasClass("collapsed-box")) {
        //Convert minus into plus
        box.find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
        //Hide the content
        box_content.slideUp(450, function () {
          box.addClass("collapsed-box");
        });
      } else {                        
        //Convert plus into minus
        box.find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
        //Show the content
        box_content.slideDown(450, function () {
          box.removeClass("collapsed-box");
        });
      }
  }

  /*Function: Collapse box*/
  function collapse_box(string){
    var box = $(string);
      //Find the body and the footer
    var box_content = box.find("> .box-body, > .box-footer, > form  >.box-body, > form > .box-footer");    
    //Convert plus into minus
    box.find('.box-header .fa-plus').removeClass('fa fa-plus').addClass('fa fa-minus');
    //Show the content
    box_content.slideDown(450, function () {
      box.removeClass("collapsed-box");
    });      
  }
  /*END -- Function: Collapse box*/