var path = window.location.pathname,
host     = window.location.hostname,
id_data_akademik_u,
load_interval,
intval_vars,
load_state = false,
element_vars = [],
controller_path,
dashboard_path_dt = [
  data_dashboard_path,
  data_dashboard_path+"/",
  data_dashboard_path+"/pengolahan_database",
  data_dashboard_path+"/pengaturan"
],
master_path_dt = [
  data_master_path+"/data_identitas_pt",
  data_master_path+"/data_fakultas_pstudi",
  data_master_path+"/data_angkatan",
  data_master_path+"/data_thn_akademik"
],
user_path_dt = [
  data_pengguna_path+"/data_pengguna_mahasiswa",
  data_pengguna_path+"/data_pengguna_ptk",
  data_pengguna_path+"/data_pengunjung"
],
akademik_path_dt = [
  data_akademik_path+"/data_mahasiswa",
  data_akademik_path+"/data_ptk",
  data_akademik_path+"/data_mata_kuliah",
  data_akademik_path+"/data_jadwal_kuliah",
  data_akademik_path+"/data_nilai_mhs",
  data_akademik_path+"/data_alumni_do"
];

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout(timer);
    timer = setTimeout(callback, ms);
  };
})();

if (check_array_exist(dashboard_path_dt,path) == true) {
  controller_path = data_dashboard_path;
}
else if (check_array_exist(master_path_dt,path) == true) {
  
  controller_path = data_master_path;
}
else if (check_array_exist(user_path_dt,path) == true) {
  controller_path = data_pengguna_path;
}
else if (check_array_exist(akademik_path_dt,path) == true) {
  controller_path = data_akademik_path;
}

$(function(){

  /*Default Settings*/
  try{
    /*DatePicker Plugin*/
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      language: 'id'
    });

    $('.datepicker').datepicker().on('changeDate',function(eve){
    }).on('hide',function(eve){
      eve.preventDefault();
      eve.stopPropagation();
    });
    /*END -- DatePicker Plugin*/

    /*Select2*/
    $.fn.select2.defaults.set("language","id");
    /*END -- Select2*/

    /*Datatable With AJAX*/
    $.fn.dataTable.ext.errMode = 'none';
    $.extend( true, $.fn.dataTable.defaults, {
      "oLanguage": {
        "oPaginate": {
          "sNext": "<li class='fa fa-angle-double-right' title='Selanjutnya'></li>",
          "sPrevious": "<li class='fa fa-angle-double-left' title='Sebelumnya'></li>",
          "sFirst": "Pertama",
          "sLast": "Terakhir"
        },
        "sInfo": "Menampilkan Data (_START_ Sampai _END_) Dari _TOTAL_ Data",
        "sInfoEmpty": "Data tidak ditemukan",
        "sProcessing": "<div class='datatable-loading-text load-datatable'>Memuat Data</div>",
        "sLoadingRecords": "<center>Memproses Data...</center>",
        "sSearch": "",
        "sInfoFiltered": " - Hasil Pencarian Dari _MAX_ Data",
        "sZeroRecords": "<center>Data yang dicari tidak ditemukan</center>"
      },
      "fnDrawCallback": function(){
        $('input.icheck-input-checkbox[type="checkbox"]').iCheck({
          /*checkboxClass: 'icheckbox_square-blue',*/
          checkboxClass: 'icheckbox_flat-blue'
        });
        $('.datatables-refresh-btn').removeClass('disabled');
      },
      "initComplete": function(settings, json) {
      }
    });
    $('.datatable-dt').on('preXhr.dt', function(e,settings,data){
      var i = 0;
      $('.load-datatable').html('Memuat Data');
      clearInterval(intval_vars);
      intval_vars = setInterval(function(){
        $('.load-datatable').append('. ');
        i++;
        if (i == 4) {
          $('.load-datatable').html('Memuat Data');
          i = 0;
        }
      },400);

      data.csrf_key = token;
      var selected_vars = $(this).attr('data-tbl-selected');
      if (selected_vars != undefined) {
        selected_vars = selected_vars.split(' ');
        $('.'+selected_vars[0]).iCheck('uncheck');
        $('.'+selected_vars[1]).iCheck('uncheck');
      }
    });
    /*END -- Datatable With AJAX*/
  }
  catch(error){

  }
  /*END -- Default Settings*/

  /*Moment JS*/
  var last_online_user = $('#user-widget-detail .user-last-time-login').attr('data-time');
  $('#user-widget-detail .user-last-time-login').text('Terakhir kali login '+moment(last_online_user).fromNow());
  $('.last-online-user-text').text(moment(last_online_user).fromNow());
  /*END -- Moment JS*/

  /*Mousewheel Horizontal*/
  try{
    $('.control-panel-data').mousewheel(function(eve,delta){
      eve.preventDefault();
      this.scrollLeft -= (delta*40);
    });
  }
  catch(error){}
  /*END -- Mousewheel Horizontal*/

  /*iCheck*/
  try{
    $('input.icheck-input-radio[type="radio"]').iCheck({
      radioClass: 'iradio_flat-blue'
    });
    $('input.icheck-input-checkbox[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue'
    });
  }
  catch(error){

  }
  $(document).off('ifChecked ifUnchecked');
  $(document).on('ifChecked', '.check-all-data', function(){
    var class_selected = $(this).attr('data-selected'),
    class_all_selected = $(this).attr('data-all-selected');
    $('.'+class_selected).iCheck('check');
    $('.'+class_all_selected).iCheck('check');
  });
  $(document).on('ifUnchecked', '.check-all-data', function(){
    var class_selected = $(this).attr('data-selected'),
    class_all_selected = $(this).attr('data-all-selected'),
    class_toggle = $(this).attr('data-toggle');
    $('.'+class_selected).iCheck('uncheck');
    $('.'+class_all_selected).iCheck('uncheck');
    $(class_toggle).addClass('disabled');
  });
  $(document).on('ifChecked', '.check-data', function(){
    var class_selected = $(this).attr('data-selected'),
    class_all_selected = $(this).attr('data-all-selected'),
    class_toggle = $(this).attr('data-toggle'),
    id = $('.'+class_selected+':checked').length,
    check_num = $('.'+class_selected).length;
    if (check_num == id) {
      $('.'+class_all_selected).iCheck('check');
    }
    else{
      $.each($('.'+class_all_selected), function(index,obj){
        $('.'+class_all_selected)[index].checked = false;
      });
      $('.'+class_all_selected).iCheck('update');
    }

    if (id > 0) {
      $(class_toggle).removeClass('disabled');
    }
    else{
      $(class_toggle).addClass('disabled');
    }
  });
  $(document).on('ifUnchecked', '.check-data', function(){
    var class_selected = $(this).attr('data-selected'),
    class_all_selected = $(this).attr('data-all-selected'),
    class_toggle = $(this).attr('data-toggle'),
    id = $('.'+class_selected+':checked').length;
    $.each($('.'+class_all_selected), function(index,obj){
      $('.'+class_all_selected)[index].checked = false;
    });
    $('.'+class_all_selected).iCheck('update');
    if (id > 0) {
      $(class_toggle).removeClass('disabled');
    }
    else{
      $(class_toggle).addClass('disabled');
    }
  });
  /*END -- iCheck*/

  /*HASHCHANGE*/
  $(window).off('hashchange');

  $(window).bind('hashchange', function(eve){
    var hash = $.param.fragment();
    $('#batal').text('Batal');
    $('.modal .submit-btn, .modal .submit-again-btn').hide();
    $('.modal .load-data').replaceWith('');
    $('.modal .modal-body').append('<p class="load-data text-center mb-0">Memproses Data</p>');

    if (hash == 'tambah') {
      $('.modal .load-data').replaceWith('');
      $('#myModal form, #myModal .list-selected, #myModal .data-message').hide();
      $('.modal .submit-btn, .modal .submit-again-btn').show();
      $('#myModal').modal('show');
      $('.modal').addClass('modal-info').find('.modal-dialog').addClass('modal-lg');
      modal_animated('zoomIn');
      if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
        $('#myModal #form-input').show();
        $('#myModal #form-input-pstudi').hide();
        $('#myModal .modal-title').text('Tambah Data Fakultas');
      }
      else{
        $('#myModal').modal('hide');
      }

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
      if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
        if (getUrlVars() == 'prodi') {
          $('#myModal #form-input-pstudi, .modal .submit-btn, .modal .submit-again-btn').show();
          $('#myModal .modal-title').text('Tambah Program Studi');
          $('#myModal #submit').text('Simpan');
          $('#myModal #submit').prepend('<li class="fa fa-save"></li> ');
          $('#myModal #submit-again').prepend('<li class="fa fa-clone"></li> ');
        }
        else if (getUrlVars()['fk'] != undefined) {
          $('#myModal .modal-title').text('Tambah Program Studi');
          var fk = getUrlVars()['fk'],
          id = getUrlVars()['i'],
          data = getJSON_async('http://'+host+controller_path+'/action/ambil',{id_fk:id,data:'data_fakultas'},1000);
          data.then(function(nama_fk){
            $('#form-input-pstudi').show();
            if (nama_fk.record != '') {
              $('#form-input-pstudi .select2_fk').prepend('<option value="'+nama_fk.record[0]['id_fk']+'">'+nama_fk.record[0]['nama_fakultas']+'</option>');
            }
            else{
              $('#form-input-pstudi .select2_fk').text('');
            }
          });
        }
        else if (getUrlVars()['prodi_kons'] != undefined) {
          if ($('#box-prodi').is(':visible') || $('#box-detail-fk').is(':visible')) {
            $('#myModal .modal-title').text('Tambah Konsentrasi Program Studi');
            var pd = getUrlVars()['prodi_kons'],
            id = getUrlVars()['i'],
            data = getJSON_async('http://'+host+controller_path+'/action/ambil_id',{id_pd:id,data:'data_prodi'},1000);
            data.then(function(nama_pd){
              $('#form-input-konsentrasi-pd').show();
              if (nama_pd.record_pd != '') {
                $('#form-input-konsentrasi-pd .select2_prodi').prepend('<option value="'+nama_pd.record_pd[0]['id_prodi']+'">'+nama_pd.record_pd[0]['nama_prodi']+' ('+nama_pd.record_pd[0]['jenjang_prodi']+')</option>');
              }
              else{
                $('#form-input-konsentrasi-pd .select2_prodi').text('');
              }
            });
          }
          else{
            $('#myModal').modal('hide');
          }
        }
        else{
          $('#myModal').modal('hide');
        }
      }

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
      }
      else{
        $('.modal .load-data').remove();
      }
    }

    else if(hash.search('edit') == 0){
      $('#myModal form, #myModal .submit-again-btn, .data-message').hide();
      $('.modal').addClass('modal-success').find('.modal-dialog').addClass('modal-lg');
      $('#myModal').modal('show');
      modal_animated('zoomIn');
      if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
        var urlvar = getUrlVars();          
        if (urlvar[0] == 'fk') {
          var id = getUrlVars()['fk'];
          var data = getJSON_async('http://'+host+controller_path+'/action/ambil',{id_fk:id,data:'data_fakultas'},500);
          data.then(function(edit_fk){
            if (edit_fk.total_rows > 0) {
              $('#myModal #form-input').show();
              $.each(edit_fk.record[0], function(index, data_record){
                $('#form-input .'+index).val(data_record);
                if (index == 'akreditasi_fk') {
                  $('#form-input .'+index).trigger('change.select2');
                }
                if (index == 'tgl_berdiri') {
                  $('#form-input .'+index).datepicker("update", new Date(data_record));
                }
              });
            }
          });
          $('#myModal .modal-title').text('Edit Data Fakultas');
          $('#form-input-pstudi').hide();
        }
        else if (urlvar[0] == 'pd'){
          var id = getUrlVars()['pd'];            
          var data = getJSON_async('http://'+host+controller_path+'/action/ambil',{id_pd:id,data:'data_prodi',act:'edit'},500);
          data.then(function(edit_pd){
            if (edit_pd.total_rows > 0) {
              $('#myModal #form-input-pstudi').show();
              $.each(edit_pd.data, function(index, data_record){            
                $.each(data_record, function(index, data_record){                
                  $('#form-input-pstudi .'+index).val(data_record);
                  $('#form-input-pstudi .'+index).trigger('change.select2');
                  if (index == 'tgl_berdiri_prodi' || index == 'tgl_sk_prodi') {
                    $('#form-input-pstudi .'+index).datepicker("update", new Date(data_record));
                  }
                });
                $('#form-input-pstudi .select2_fk').prepend('<option value="'+data_record.id_fk_pd+'">'+data_record.nama_fakultas+'</option>');
              });
            }
          });
          $('#myModal .modal-title').text('Edit Data Program Studi');
          $('#form-input').hide();
        }
        else if (urlvar['data'] == 'konsentrasi_prodi'){
          if ($('#box-detail-fk').is(':visible')) {
            var id = getUrlVars()['konsentrasi'];
            var data = getJSON_async('http://'+host+controller_path+'/action/ambil',{id:id,data:'data_konsentrasi_pd'},500);
            data.then(function(edit_konsentrasi_pd){
              if (edit_konsentrasi_pd.total_rows > 0) {
                $('#form-input-konsentrasi-pd').show();
                $.each(edit_konsentrasi_pd.data, function(index, data_record){            
                  $.each(data_record, function(index, data_record){                
                    $('#form-input-konsentrasi-pd .'+index).val(data_record);
                  });
                  $('#form-input-konsentrasi-pd .select2_prodi').prepend('<option value="'+data_record.id_pd_konst+'">'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</option>');
                });
              }
            });
            $('#myModal .modal-title').text('Edit Konsentrasi Program Studi');
          }
          else{
            $('.modal').modal('hide');
          }
        }
      }
      else{
        $('#myModal').modal('hide');
      }

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
      if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
        var urlvar = getUrlVars();
        if (urlvar[0] == 'fk') {
          var id = getUrlVars()['fk'];
          var data = getJSON_async('http://'+host+controller_path+'/action/ambil_id',{id_fk:id,data:'data_fakultas'},500);
          data.then(function(detail_fk){
            if (detail_fk.total_rows > 0) {
              $.each(detail_fk.record_fk, function(index, data_record){              
                  $('.data-message').show();                
                  $('.data-message .content-message').html('Apakah anda yakin ingin menghapus data fakultas&nbsp<strong>'+data_record.nama_fakultas+'</strong>&nbsp?').addClass('centered-text');
                  $('#form-input .id_fk').attr('value',data_record.id_fk);                
                });            
            }
          });
          $('#myModal .modal-title').text('Hapus Data Fakultas');
        }
        else if (urlvar[0] == 'pd') {
          var id = getUrlVars()['pd'];            
          var data = getJSON_async('http://'+host+controller_path+'/action/ambil_id',{id_pd:id,data:'data_prodi'},500);
          data.then(function(detail_pd){
            if (detail_pd.total_rows > 0) {
              $.each(detail_pd.record_pd, function(index, data_record){              
                  $('.data-message').show();
                  $('.data-message .content-message').html('Apakah anda yakin ingin menghapus data program studi&nbsp<strong>'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</strong>&nbsp?').addClass('centered-text');
                  $('#form-input-pstudi .id_prodi').attr('value',data_record.id_prodi);
                  $('#form-input-pstudi .id_fk_pd').attr('value',data_record.id_fk_pd);
                });            
            }
          });
          $('#myModal .modal-title').text('Hapus Data Program Studi');
        }
        else if (urlvar['data'] == 'konsentrasi_prodi'){
          if ($('#box-detail-fk').is(':visible')) {
            var id = getUrlVars()['konsentrasi'];
            var data = getJSON_async('http://'+host+controller_path+'/action/ambil',{id:id,data:'data_konsentrasi_pd'},500);
            data.then(function(edit_konsentrasi_pd){
              if (edit_konsentrasi_pd.total_rows > 0) {
                $.each(edit_konsentrasi_pd.data, function(index, data_record){            
                  $('.data-message').show();
                  $('.data-message .content-message').html('Apakah anda yakin ingin menghapus data konsentrasi&nbsp<strong>'+data_record.nm_konsentrasi+'</strong>&nbsp pada program studi <strong>'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</strong>&nbsp?').addClass('centered-text');
                  $('#form-input-konsentrasi-pd .select2_prodi').prepend('<option value="'+data_record.id_pd_konst+'">'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</option>');
                  $('#form-input-konsentrasi-pd .id_konst').attr('value',data_record.id_konst);
                });
              }
            });
            $('#myModal .modal-title').text('Hapus Konsentrasi Program Studi');
          }
          else{
            $('.modal').modal('hide');
          }
        }
        else{
          $('#myModal').modal('hide');
        }
      }

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
      if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
        var selectedItems = [],
        vars = getUrlVars();
        if (vars == 'fk') {
          var check = 'data_fk';
          $(".check-fk:checked").each(function() {
            selectedItems.push($(this).val());
          });       
        }
        else if (vars == 'pd') {
          var check = 'data_pd';
          $(".check-prodi:checked").each(function() {
            selectedItems.push($(this).val());
          });       
        }
        $('.data-message').show();
        var count = selectedItems.length;          
        if (count > 0 ) {
          var data = getJSON_async('http://'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_data_master',check:check},1000);
          data.then(function(detail_data){
            $('.data-message .content-message').addClass('centered-text');
            if (detail_data.total_rows > 0 ) {
              if (vars == 'fk') {
                $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+detail_data.total_rows+'&nbspdata</strong>&nbspFakultas ?');
              }
              else if (vars == 'pd') {
                $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+detail_data.total_rows+'&nbspdata</strong>&nbspProgram Studi ?');
              }
            }
            else{
              if (vars == 'fk') {
                $('.data-message .content-message').html('Data fakultas yang anda ingin hapus tidak ditemukan dalam database!');
              }
              else if (vars == 'pd') {
                $('.data-message .content-message').html('Data program studi yang anda ingin hapus tidak ditemukan dalam database!');
              }
            }
          });
        }
        else{
          $('.data-message .content-message').addClass('centered-content');
          if (vars == 'fk') {
            $('.data-message .content-message').html('Silahkan pilih data Fakultas yang ingin dihapus!');
          }
          else if (vars == 'pd') {
            $('.data-message .content-message').html('Silahkan pilih data Program Studi yang ingin dihapus!');
          }
          $('#submit, #delete-selected').hide();
          $('#batal').text('Tutup');
        }

        if (vars == 'fk') {
          $('#myModal .modal-title').text('Hapus Data Fakultas');
        }
        else if (vars == 'pd') {
          $('#myModal .modal-title').text('Hapus Data Program Studi');
        }
      }

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
      if (path.search('admin/data_akademik/data_mahasiswa') > 0 || path.search('admin/data_akademik/data_alumni_do') > 0) {
        $('#submit').show();
        if (getUrlVars()['mhs'] != null) {
          id_data_akademik_u = getUrlVars()['mhs'];
        }
        else if (getUrlVars()['alumni'] != null) {
          id_data_akademik_u = getUrlVars()['alumni'];
          $('#box-detail-mhs .box-title').text('Detail Data Alumni');
          $('#box-detail-mhs').attr('data-detail','alumni');
        }
        else if (getUrlVars()['mhs_do'] != null) {
          id_data_akademik_u = getUrlVars()['mhs_do'];
          $('#box-detail-mhs .box-title').text('Detail Data Mahasiswa Drop Out');
          $('#box-detail-mhs').attr('data-detail','mhs_do');
        }
        $('.detail-mhs-btn[data-search='+id_data_akademik_u+']').find('i').removeClass('fa-id-card').addClass('fa-circle-o-notch fa-spin');
        var detail_mhs = getJSON_async('http://'+host+controller_path+'/action/ambil',{id:id_data_akademik_u,data:'data_mhs'},500,true);
        detail_mhs.then(function(detail_mhs){
          $('.detail-mhs-btn').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-id-card');
          if (detail_mhs.total_rows > 0) {
            detail_akademik_mhs();
            if ($('#box-detail-mhs').is(':visible')) {
              $('#detail-mhs .close-tab, #detail-mhs .close-dt-tab').removeClass('active');
              $('#detail-mhs .close-tab').find('a').attr('aria-expanded','false');
              $('#detail-mhs .open-tab, #detail-mhs .open-dt-tab').addClass('active');
              $('#detail-mhs .open-tab').find('a').attr('aria-expanded','true');
              $('#box-detail-mhs .detail-data-mhs').text('');
            }
            $('#box-detail-mhs').slideDown().attr('data-search',id_data_akademik_u);
            $('html, body').animate({scrollTop:$('#box-detail-mhs').offset().top - 55},1000);
            $.each(detail_mhs.record_mhs, function(index, data_record){
              $.each(data_record, function(index, data_record){
                if (data_record =='' || data_record =='0' || data_record == null) {
                  data_record='-';
                }
                if (index=='jk' && data_record=='L') {
                  data_record='Laki - Laki';
                }
                else if(index=='jk' && data_record=='P'){
                  data_record='Perempuan';
                }
                if (index == 'active_status') {
                  if (data_record == '1') {
                    data_record = 'Aktif';
                  }
                  else{
                    data_record = 'Nonaktif';
                  }
                }
                if (index == 'last_online') {
                  if (data_record != '0000-00-00 00:00:00') {
                    data_record = moment(data_record).fromNow();
                  }
                  else{
                    data_record = 'Belum pernah login';
                  }
                }
                $('#box-detail-mhs .detail-'+index).text(data_record);
              });
              if (data_record.status_verifikasi_mhs == 1) {
                $('#box-detail-mhs .detail-status-data').replaceWith('<button type="button" class="btn btn-success btn-block dt-vld detail-status-data" data-status="'+data_record.status_verifikasi_mhs+'"><b><i class="fa fa-check-square-o"></i> Terverifikasi</b></button>');
              }
              else if (data_record.status_verifikasi_mhs == 2) {
                $('#box-detail-mhs .detail-status-data').replaceWith('<button type="button" class="btn btn-danger btn-block dt-vld detail-status-data" data-status="'+data_record.status_verifikasi_mhs+'"><b><i class="fa fa-times"></i> Data Salah</b></button>');
              }
              else if (data_record.status_verifikasi_mhs == 0) {
                $('#box-detail-mhs .detail-status-data').replaceWith('<button type="button" class="btn btn-default btn-block dt-vld detail-status-data" data-status="'+data_record.status_verifikasi_mhs+'"><b><i class="fa fa-warning"></i> Belum Diverifikasi</b></button>');
              }
              if (data_record.tgl_lulus != null && data_record.tgl_drop_out == null) {
                $('#box-detail-mhs .detail-status').text(data_record.status_mhs);
                $('#box-detail-mhs .list-tgl-kelulusan-mhs').show();
                $('#box-detail-mhs .list-tgl-do-mhs, #box-detail-mhs .list-tgl-masuk').hide();
              }
              else if (data_record.tgl_lulus == null && data_record.tgl_drop_out != null) {
                $('#box-detail-mhs .detail-status').text(data_record.status_mhs);
                $('#box-detail-mhs .list-tgl-do-mhs').show();
                $('#box-detail-mhs .list-tgl-kelulusan-mhs, #box-detail-mhs .list-tgl-masuk').hide();
              }
              else{
                $('#box-detail-mhs .list-tgl-kelulusan-mhs,#box-detail-mhs .list-tgl-do-mhs').hide();
                $('#box-detail-mhs .detail-status').text(data_record.status_mhs);
                $('#box-detail-mhs .list-tgl-masuk').show();
              }
              $('.photo-mhs-detail').attr('src',data_record.photo_mhs);
              $('#box-detail-mhs .detail-nama_prodi').text(data_record.nama_prodi+' ('+data_record.jenjang_prodi+')');
              $('#box-detail-mhs .change-pass-user').val('user-'+data_record.id_user+'-'+data_record.nisn+'-'+data_record.in_user);
              $('#box-detail-mhs').find('div.overlay').fadeOut();
            });
          }
          else{
            window.history.pushState(null,null,path);
            swal({
              title:'Info',
              text: 'Maaf, data mahasiswa yang anda cari tidak ditemukan!',
              type:'info',
              timer: 2000
            });
          }
        }).catch(function(){
          $('.detail-mhs-btn[data-search='+id_data_akademik_u+']').find('i').removeClass('fa-fa-circle-o-notch fa-spin').addClass('fa-times');
          setTimeout(function(){
            $('.detail-mhs-btn[data-search='+id_data_akademik_u+']').find('i').removeClass('fa-times fa-fa-circle-o-notch fa-spin').addClass('fa-id-card');
          },1000);
        });
        $('#myModal .modal-title').text('Detail Data Mahasiswa');
      }
      else if (path.search('admin/data_akademik/data_ptk') > 0) {
        id_data_akademik_u = getUrlVars()['ptk'];
        $('#box-ptk').find('div.overlay').fadeIn();
        $('.detail-ptk-btn[data-search='+id_data_akademik_u+']').find('i').removeClass('fa-id-card').addClass('fa-circle-o-notch fa-spin');
        var data = getJSON_async('http://'+host+controller_path+'/action/ambil',{id_ptk:id_data_akademik_u,data:'data_ptk'},500,true);
        data.then(function(detail_ptk){
          if (detail_ptk.total_rows > 0) {
            detail_data_ptk();
            if ($('#box-ptk').is(':visible')) {
              $('#detail-ptk .close-tab, #detail-ptk .close-dt-tab').removeClass('active');
              $('#detail-ptk .close-tab').find('a').attr('aria-expanded','false');
              $('#detail-ptk .open-tab, #detail-ptk .open-dt-tab').addClass('active');
              $('#detail-ptk .open-tab').find('a').attr('aria-expanded','true');
              $('#box-ptk .detail-data-ptk').text('');
            }
            $('#box-ptk').slideDown().attr('data-search',id_data_akademik_u);
            $('html, body').animate({scrollTop:$('#box-ptk').offset().top - 55},1000);
            $.each(detail_ptk.record_ptk, function(index, data_record){
              $.each(data_record, function(index, data_record){                
                if (data_record =='' || data_record =='0' || data_record =='0000-00-00') {
                  data_record='-';
                }
                if (index == 'active_status') {
                  if (data_record == '1') {
                    data_record = 'Aktif';
                  }
                  else{
                    data_record = 'Nonaktif';
                  }
                }
                if (index=='jk_ptk' && data_record=='L') {
                  data_record='Laki - Laki';
                }
                else if(index=='jk_ptk' && data_record=='P'){
                  data_record='Perempuan';
                }
                if (index == 'last_online') {
                  if (data_record != '0000-00-00 00:00:00') {
                    data_record = moment(data_record).fromNow();
                  }
                  else{
                    data_record = 'Belum pernah login';
                  }
                }
                $('#box-ptk .detail-'+index).text(data_record);
              });
              if (data_record.status_verifikasi_ptk == 1) {
                $('#box-ptk .detail-status-data').replaceWith('<button type="button" class="btn btn-success btn-block dt-vld detail-status-data" data-status="'+data_record.status_verifikasi_ptk+'"><b><i class="fa fa-check-square-o"></i> Terverifikasi</b></button>');
              }
              else if (data_record.status_verifikasi_ptk == 2) {
                $('#box-ptk .detail-status-data').replaceWith('<button type="button" class="btn btn-danger btn-block dt-vld detail-status-data" data-status="'+data_record.status_verifikasi_ptk+'"><b><i class="fa fa-times"></i> Data Salah</b></button>');
              }
              else if (data_record.status_verifikasi_ptk == 0) {
                $('#box-ptk .detail-status-data').replaceWith('<button type="button" class="btn btn-default btn-block dt-vld detail-status-data" data-status="'+data_record.status_verifikasi_ptk+'"><b><i class="fa fa-warning"></i> Belum Diverifikasi</b></button>');
              }
              $('.photo-ptk-detail').attr('src',data_record.photo_ptk);
              $('#box-ptk .detail-nama_prodi').text(data_record.nama_prodi+' ('+data_record.jenjang_prodi+')');
              $('#box-ptk .change-pass-user').val('user-'+data_record.id_user+'-'+data_record.nuptk+'-'+data_record.in_user);
            });
          }
          else{
            window.history.pushState(null,null,path);
            swal({
              title:'Info',
              text: 'Maaf, data tenaga pendidik yang anda cari tidak ditemukan!',
              type:'info',
              timer: 2000
            });
          }
          $('.detail-ptk-btn').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-id-card');
          $('#box-ptk').find('div.overlay').fadeOut();
        }).catch(function(){
          $('.detail-ptk-btn[data-search='+id_data_akademik_u+']').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-times');
          setTimeout(function(){
            $('.detail-ptk-btn[data-search='+id_data_akademik_u+']').find('i').removeClass('fa-times fa-circle-o-notch fa-spin').addClass('fa-id-card');
          },1000);
        });
        $('#myModal .modal-title').text('Detail Data Tenaga Pendidik');
      }
      else if (path.search('admin/') > 0 || path.search('admin') > 0) {
        if (getUrlVars()[0] == 'id_user') {
          $('#myModal #rincian-ptk, #myModal #rincian-mhs').hide();
          $('#myModal').modal('show').find('.modal-dialog').addClass('modal-lg');
          $('.modal').addClass('modal-warning');
          var id = getUrlVars()['id_user'];
          var level = getUrlVars()['level'];
          var data = getJSON_async('http://'+host+controller_path+'/dashboard/data_statistik/pengguna',{id:id,level:level},500);
          data.then(function(detail_user){
            if (detail_user.total_rows > 0) {
              if (detail_user.data == 'mhs') {
                $('#myModal #rincian-mhs').show();
                $('#myModal #rincian-ptk').hide();
                $('#myModal #rincian-ptk').find('dd').text('');
                $.each(detail_user.record, function(index, data_record){
                  $.each(data_record, function(index, data_record){                
                    if (data_record =='' || data_record =='0') {
                      data_record='-';
                    }
                    if (index=='jk' && data_record=='L') {
                      data_record='Laki - Laki';
                    }
                    else if(index=='jk' && data_record=='P'){
                      data_record='Perempuan';
                    }
                    $('#rincian-mhs #detail-'+index).text(data_record);
                  });
                  $('#rincian-mhs #detail-nama_prodi').text(data_record.nama_prodi+' ('+data_record.jenjang_prodi+')');
                });
              }
              else{
                $('#myModal #rincian-ptk').show();
                $('#myModal #rincian-mhs').hide();
                $('#myModal #rincian-mhs').find('dd').text('');
                $.each(detail_user.record, function(index, data_record){
                  $.each(data_record, function(index, data_record){                
                    if (data_record =='' || data_record =='0') {
                      data_record='-';
                    }
                    if (index=='jk_ptk' && data_record=='L') {
                      data_record='Laki - Laki';
                    }
                    else if(index=='jk_ptk' && data_record=='P'){
                      data_record='Perempuan';
                    }
                    $('#rincian-ptk #detail-'+index).text(data_record);
                  });
                  $('#rincian-ptk #detail-nama_prodi').text(data_record.nama_prodi+' ('+data_record.jenjang_prodi+')');
                });
              }
            }
            else{
              $('#myModal #rincian-mhs, #myModal #rincian-ptk').hide();
              $('#myModal .data-message .content-message').html('Maaf, data yang anda cari tidak ditemukan');
              $('.data-message').show();
            }
          }).catch(function(error){
            $('#myModal #rincian-mhs, #myModal #rincian-ptk').hide();
            $('.data-message').show();
            $('.data-message .content-message').addClass('centered-text').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
          });
          $('#myModal .modal-title').text('Detail Data Pengguna');
        }
      }
    }

    $('.modal #batal').prepend('<li class="fa fa-times"></li> ');
  });

  $(window).trigger('hashchange');
  /*END -- HASHCHANGE*/

  /*Modal Event*/
  var modal_show_animated = 'zoomIn';
  var modal_hide_animated = 'zoomOutDown';
  $('.modal').on('show.bs.modal', function(e){
    modal_animated(modal_show_animated, modal_hide_animated);
    $('body').addClass('modal-show');
  });

  $('#myModal').on('hidden.bs.modal', function(e){
    modal_animated(modal_hide_animated, modal_show_animated);
    window.history.pushState(null,null,path);
    $('#myModal form,#rincian-siswa,.list-selected,.hide-modal-content').hide();
    $('#myModal .submit-btn, #myModal #tamp-data, #myModal #delete-selected, #myModal #pindah-kelas,#myModal #update-mk').attr('id','submit');
    $('#submit').show();
    $('#submit-again').text('Simpan dan Tambah');
    $('#batal').text('Batal');
    $('.list-selected .list-mhs-selected').find('tbody').text('');
    $('.modal').removeClass('modal-lg modal-sm modal-info modal-success modal-danger modal-primary modal-warning');
    $('#myModal').find('input[type=text],input[type=hidden],input[type=number],input[type=email],input[type=password],textarea').val('');
    $('#barchart-alumni').replaceWith('<canvas id="barchart-alumni" class="chart" style="height: 280px; width: 510px;"></canvas>');
    $('#barchart-mhs-do').replaceWith('<canvas id="barchart-mhs-do" class="chart" style="height: 280px; width: 510px;"></canvas>');
    $('#myModal .timepicker').val('14:08');
    $('#myModal .select2').val(null).trigger('change');
    $('#myModal .select2-remote-dt').text('');
    $('#myModal .select2').prop('disabled',false);
    $("#myModal").find('.is-invalid').removeClass('is-invalid');
    $("#myModal").find('.is-invalid-select').removeClass('is-invalid-select');
    $("#myModal").find('.invalid-feedback').remove();
    $('#alert-place').text('');
    $('#myModal .close-tab, #myModal .close-dt-tab').removeClass('active');
    $('#myModal .close-tab').find('a').attr('aria-expanded','false');
    $('#myModal .open-tab, #myModal .open-dt-tab').addClass('active');
    $('#myModal .open-tab').find('a').attr('aria-expanded','true');
    $('#myModal .modal-dialog').removeClass('modal-lg').removeAttr('style');
    $('#myModal .data-message').hide().removeClass('mt-4');
    $('#myModal .data-message .content-message').addClass('centered-content').removeClass('centered-text');
    $('#myModal .data-message .content-message').html('Maaf, data yang anda cari tidak ditemukan');
    $('#myModal dl dd').text('');
    $('#detail-rt-rw').append("<font id='detail-rt'></font>/<font id='detail-rw'></font>");
    $('#myModal dl dd#password').html(
      "<div class='pass password-cry pull-left'></div>"
      +"<div class='password pull-left' id='detail-uncrypt_password'></div>"
      +"<div class='pull-right show-password' title='Tampilkan password'><span class='glyphicon glyphicon-eye-close'></span><div>"
      );
    $('#myModal .file-select-foto').parents().find('.fileinput-remove-button').hide();

    try {
      $('#myModal input[type="radio"]').iCheck('uncheck');
      $('#myModal .file-select-foto').fileinput('clear');
    }
    catch(error){

    }
  });

  $('.modal').on('hide.bs.modal', function(e){
    modal_animated('zoomOutDown');
    $('.modal .overflow-tab, .modal .content-responsive').scrollTop(0);
    $('.modal .tab-pane, .tab-overflow-container').scrollTop(0);
    $('.modal .slimScrollDiv').find('.slimScrollBar').css('top','0px');
  });

  $('.modal .nav-tabs li a').on('shown.bs.tab', function(){
    $('.modal .tab-pane').scrollTop(0);
  });
  /*END -- Modal Event*/

  /*Onclick Event*/
  $('.info').on('click', function(){
    var html;
    var data_info = $(this).attr('data-info');
    if (path == controller_path+'/data_fakultas_pstudi') {
      html = '<ol style="text-align:left">'
      +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Fakultas</a> untuk menambah data fakultas</li>'
      +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Program Studi</a> untuk menambah program studi</li>'
      +'<li>klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i></a> pada daftar fakultas untuk menambah program studi</li>'
      +'</ol>';
    }
    else if (path == controller_path+'/data_thn_akademik') {
      html = '<ol style="text-align:left">'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Tahun Akademik</a> Untuk menambah tahun akademik</li>'
        +'<li>Klik tombol <a class="btn btn-danger text-white"><i class="fa fa-ban"></i> Tutup Tahun Akademik</a> Untuk menutup/nonaktifkan tahun akademik yang sedang berjalan</li>'
        +'<li>klik <div class="toggle btn btn-success btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-success btn-sm toggle-on"><i class="fa fa-check-circle"></i> Diterapkan</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div> | <div class="toggle btn btn-danger off btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-danger btn-sm active toggle-off"><i class="fa fa-ban"></i> Tidak Diterapkan</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div>'
        +' pada daftar tahun akademik untuk menerapkan atau menutup tahun akademik</li>'
        +'<li>klik <div class="toggle btn btn-success btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-success btn-sm toggle-on"><i class="fa fa-check-circle"></i> Input Nilai</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div> | <div class="toggle btn btn-danger off btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-danger btn-sm active toggle-off"><i class="fa fa-ban"></i> Input Nilai</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div>'
        +' pada daftar tahun akademik agar proses input nilai bisa dilakukan maupun sebaliknya</li>'
        +'</ol>';
    }
    else if (path == controller_path+'/data_angkatan') {
      html = '<ol style="text-align:left">'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Tahun Angkatan</a> Untuk menambah tahun angkatan mahasiswa</li>'
        +'<li>Klik tombol <a class="btn btn-danger text-white"><i class="fa fa-trash"></i> Hapus</a> Untuk menghapus tahun angkatan mahasiswa</li>'
        +'<li>klik tombol <a class="btn btn-warning text-white"><i class="fa fa-list"></i></a> Untuk melihat daftar angkatan mahasiswa dan klik tombol <a class="btn btn-success"><i class="fa fa-pencil-square"></i></a> Untuk mengedit data tahun angkatan</li>'
        +'</ol>';
    }
    else if (path == controller_path+'/data_mata_kuliah') {
      html = '<ol style="text-align:left">'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Mata Kuliah</a> untuk menambah mata kuliah</li>'
        +'<li>Klik tombol <a class="btn btn-danger text-white"><i class="fa fa-trash"></i> Hapus</a> pada control panel untuk menghapus multiple data</li>'
        +'<li>Klik tombol <a class="btn btn-success text-white"><i class="fa fa-list"></i> Tampilkan Mata Kuliah</a> untuk Menampilkan mata kuliah berdasarkan prodi yang dipilih</li>'
        +'</ol>';
    }
    else if (path == controller_path+'/data_jadwal_kuliah') {
      html = '<ol style="text-align:left">'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Buat Jadwal Kuliah</a> untuk menambah jadwal kuliah kuliah</li>'
        +'<li>Klik tombol <a class="btn btn-danger text-white"><i class="fa fa-trash"></i> Hapus</a> pada control panel untuk menghapus multiple data</li>'
        +'<li>Klik tombol <a class="btn btn-success text-white"><i class="fa fa-list"></i> Tampilkan Jadwal Kuliah</a> untuk menampilkan jadwal kuliah berdasarkan tahun akademik dan prodi yang dipilih</li>'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Mahasiswa</a> untuk menambah mahasiswa kedalam kelas yang bersangkutan</li>'
        +'</ol>';
    }
    else if (path == controller_path+'/pengaturan') {
      if (data_info == 'layout-setting') {
        html = '<ol style="text-align:left;">'
          +'<li>Pilihan layout untuk merubah tampilan sistem dimana terdiri dari:'
          +'<ul style="margin-left:-22px;list-style-type:square">'
          +'<li><b>Fixed-Layout</b></li>'
          +'<li><b>Boxed-Layout</b></li>'
          +'<li><b>Toggle Sidebar</b></li>'
          +'<li><b>Toggle Right Sidebar</b></li>'
          +'</ul>'
          +'</li>'
          +'<li>Warna layout untuk merubah warna dasar tampilan sistem yang terdiri dari 12 pilihan warna</li>'
          +'<li>Pengaturan default layout ialah <b>Fixed-Layout</b> dan <b>Skin Yellow</b></li>'
          +'</ol>';
      }
      else if (data_info == 'backup-db') {
        html = '<ol style="text-align:left;">'
          +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-download"></i></a> untuk download backup database dan klik tombol <a class="btn btn-danger"><i class="fa fa-trash"></i></a> untuk menghapus backup database</li>'
          +'<li>Klik tombol <a class="btn btn-default text-white"><i class="fa fa-download"></i> Backup Database</a> untuk memulai proses backup database</li>'
          +'<li>Klik tombol <a class="btn btn-default text-white"><i class="fa fa-download"></i> Backup Tabel</a> untuk memulai proses backup tabel database yang dipilih</li>'
          +'</ol>';
      }
    }

    if (html != '' && html != undefined) {
      swal({          
        type:'info',
        title:'Petunjuk',
        html: html,
        confirmButtonText:'<i class="fa fa-check"></i> Ok'
      });
    }
  });
  /*END -- Onclick Event*/

  /*Submit AJAX*/
  $(document).on('click', '#submit', function(eve){
    eve.stopImmediatePropagation();
    eve.preventDefault();
    
    $('#form-input, form').find('.is-invalid').removeClass('is-invalid');
    $('#form-input, form').find('.is-invalid-select').removeClass('is-invalid-select');
    $('#form-input, form').find('.invalid-feedback').remove();
    var submit_btn = $(this).find('li');
    var action = $('#form-input').attr('action');
    var mp = getUrlVars();
    if (mp == 'prodi' || mp == 'fk,i,token' || mp == 'pd,token') {
      var datasend = $('#form-input-pstudi').serialize();
    }
    else if (mp == 'kelas_mhs') {
      var datasend = $('#form-input-kls-mhs').serialize()+'&kelas_mhs='+mp['kelas_mhs'];
    }
    else if (mp == 'kelas') {
      if (action == 'update') {
        var datasend = $('#form-pindah-kelas').serialize();
      }
      else{
        var datasend = {id_mhs_kls:$('#form-input .id_jdl').val(),data_mhs_kls:''};
        datasend['csrf_key'] = token;
      }
    }
    else if (mp['data'] == 'mhs_do' || mp['mhs_do'] != null || mp['data'] == 'drop_out') {
      var datasend = $('#form-input-mhs-do').serialize();
      if (mp['data'] == 'drop_out') {
        var id = [];
        $(".check-siswa:checked").each(function() {
          if ($(this).val() != '') {
            id += 'mhs-data[]='+$(this).val()+'&';
          }
        });
        datasend = id+datasend;
      }
    }
    else if (mp['data'] == 'alumni') {
      if ($('#form-input-alumni').is(':visible')) {
        var datasend = $('#form-input-alumni').serialize();
        var id = [];
        $(".check-siswa:checked").each(function() {
          if ($(this).val() != '') {
            id += 'id[]='+$(this).val()+'&';
          }
        });
        datasend = id+datasend;
      }
      else{
        var datasend = $('#form-input').serialize();
      }
    }
    else if (mp['data-selected'] == 'alumni-mhs-do') {
      if ($('.select2_data').val() == 0) {
        var datasend = $('#form-input').serialize()+'&update=batch';
      }
      else if ($('.select2_data').val() == 1) {
        var datasend = $('#form-input-mhs-do').serialize()+'&update=batch';
      }
      var id = [];
      $(".check-mhs-dt:checked").each(function() {
        if ($(this).val() != '') {
          id += '&in_mhs[]='+$(this).val();
        }
      });
      datasend = datasend+id;
    }
    else if (mp['data'] == 'pend_ptk') {
      var datasend = $('#form-input-studi-ptk').serialize();
      if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') != '') {
        datasend = datasend+'&ptk_detail='+$('#box-ptk').attr('data-search');
      }
    }
    else if (mp['data'] == 'research_ptk') {
      var datasend = $('#form-input-penelitian-ptk').serialize();
      if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') != '') {
        datasend = datasend+'&ptk_detail='+$('#box-ptk').attr('data-search');
      }
    }
    else if (mp['data'] == 'konsentrasi_prodi' || mp['prodi_kons'] != undefined) {
      var datasend = $('#form-input-konsentrasi-pd').serialize();
    }
    else if (mp['data'] == 'template') {
      var datasend = $('#form-input-template').serialize();
    }
    else if (mp['data'] == 'menu') {
      var datasend = $('#form-input-menu').serialize();
    }
    else if (mp['data'] == 'sub-menu') {
      var datasend = $('#form-input-sub-menu').serialize();
    }
    else{          
      var datasend = $('#form-input').serialize();
    }

    /*datasend = datasend+'&csrf_key='+token;*/
    
    $('#alert-place').text('');
    var data = null;
    var hash = getUrlVars();      
    data = hash['data'];

    $.ajax('http://'+host+controller_path+'/action/'+action+'?token='+token+'&key='+rand_val(30),{
      dataType: 'json',
      type: 'POST',
      data: datasend,
      beforeSend: function(){
        submit_btn.removeClass('fa-save fa-trash fa-pencil-square').addClass('fa-circle-o-notch fa-spin');
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
          submit_btn.removeClass('fa-circle-o-notch fa-spin').addClass('fa-save');
        }
        else if (action == 'update') {
          submit_btn.removeClass('fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
        }
        else if (action == 'delete') {
          submit_btn.removeClass('fa-circle-o-notch fa-spin').addClass('fa-trash');
        }
        $('.submit-process').fadeOut();
      },
      success: function(data){
        token = data.n_token;
        if (action == 'tambah') {
          if (data.status == 'success') {
            if (data.data == 'data_identitas_pt') {
              if (data.record_pt == '') {
                $('#tab-identitas-pt .dl-horizontal .detail-data-pt').text('-');
                $('.box').hide();
                $('#tab-identitas-pt #profil, #tab-identitas-pt #kontak').append(
                  '<p class="text-center empty-pt-dt">Belum ada data untuk identitas perguruan tinggi. Klik <a class="btn btn-info btn-sm form-identitas-pt"><span class="fa fa-pencil-square"></span></a> untuk input data identitas perguruan tinggi pertama kalinya.</p>'
                  );
              }
              else{
                $('.box').show();
                $('.empty-pt-dt').remove();
                $.each(data.record_pt, function(index, data_record){
                  $.each(data_record, function(name, data_record){
                    if (data_record =='') {
                      data_record ='-';
                    }
                    if (name == 'rt' || name == 'rw') {
                      $('#tab-identitas-pt .'+name).text(data_record);
                    }
                    $('#tab-identitas-pt .detail-data-pt.'+name).text(data_record);
                  });          
                });
              }
              $('#myModal-pt').modal('hide');
            }
            else if (data.data == 'data_fakultas') {
              $('#box-content').find('div.overlay').fadeIn();
              $('.tbl-data-fk').DataTable().ajax.reload();
              $(document).bind('ajaxComplete', function(){
                $('#box-content').find('div.overlay').fadeOut();
              });
            }
            else if (data.data == 'data_prodi') {
              if ($('#box-detail-fk').is(':visible')) {
                $('#box-detail-fk').find('div.overlay').fadeIn();
                $(document).bind('ajaxComplete', function(){
                  $('#box-detail-fk').find('div.overlay').fadeOut();
                });
                var id = $('#form-input-pstudi .id_fk_pd').val();
                if ($('#box-prodi').is(':visible')) {
                  $('.tbl-data-pd').DataTable().ajax.reload();
                  $('.tbl-data-pd').DataTable().search('').draw();
                }
                data_detail_fk(id);
              }
              else{
                $('#box-content').find('div.overlay').fadeIn();
                $(document).bind('ajaxComplete', function(){
                  $('#box-content').find('div.overlay').fadeOut();
                });
              }
            }
            else if (data.data == 'data_thn_angkatan') {
              $('#box-content').find('div.overlay').fadeIn();
              $('#tbl-thn-angkatan').DataTable().ajax.reload();      
              $('#tbl-thn-angkatan').DataTable().search('').draw();                
              $(document).bind('ajaxComplete', function(){                
                $('#box-content').find('div.overlay').fadeOut();
              });                
            }
            else if (data.data == 'data_thn_akademik') {
              $('#box-content').find('div.overlay').fadeIn();
              $('#tbl-thn-akademik').DataTable().ajax.reload();
              $('#tbl-thn-akademik').DataTable().search('').draw();                
              $(document).bind('ajaxComplete', function(){                
                $('#box-content').find('div.overlay').fadeOut();
              });                
            }
            else if(data.data == 'data_mhs'){
              $('.check-all-siswa').iCheck('uncheck');
              $('#cari_thn_angkatan, #cari_prodi').val('');
              $('#box-siswa .box-title').text('Data Mahasiswa');
              $('#box-siswa').find('div.overlay').fadeIn();
              $('.tbl-data-mhs').DataTable().ajax.reload();
              $(document).bind('ajaxComplete', function(){          
                $('#box-siswa').find('div.overlay').fadeOut();                  
              });
              if ($('.file-select-foto').val() != '') {
                $('.file-select-foto').fileinput('refresh',{
                  'uploadExtraData':{
                    'data':data.in,
                    'pt':'mhs',
                    'csrf_key':token
                  },
                });
                $('.file-select-foto').fileinput('upload');
              }
            }
            else if(data.data == 'data_ptk'){
              $('.check-all-guru').iCheck('uncheck');                
              $('#box-guru').find('div.overlay').fadeIn();
              $('.tbl-data-ptk').DataTable().ajax.reload();
              $(document).bind('ajaxComplete', function(){          
                $('#box-guru').find('div.overlay').fadeOut();                  
              });
              if ($('.file-select-foto').val() != '') {
                $('.file-select-foto').fileinput('refresh',{
                  'uploadExtraData':{
                    'data':data.in,
                    'pt':'ptk',
                    'csrf_key':token
                  },
                });
                $('.file-select-foto').fileinput('upload');
              }
            }
            else if(data.data == 'data_studi_ptk'){
              if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') == data.in_ptk) {
                detail_data_ptk('studi_ptk');
              }
            }
            else if(data.data == 'data_penelitian_ptk'){
              if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') == data.in_ptk) {
                detail_data_ptk('penelitian_ptk');
              }
            }
            else if (data.data == 'data_mata_kuliah') {
              $('.check-all-mk').iCheck('uncheck');
              $('.box-daftar-mk').fadeIn('slow');
              $('html, body').animate({scrollTop:$('.box-daftar-mk').offset().top},800);
              daftar_mk($('select.id_pd_mk').val());
            }
            else if (data.data == 'data_jadwal') {
              $('#box-content').find('div.overlay').fadeIn();
              $('.tbl-daftar-jadwal').DataTable().ajax.reload();
              var thn;
              $.each(data.thn, function(index,data_record){
                thn = data_record.thn_ajaran_jdl+' '+data_record.id_pd_mk;
              });
              daftar_jadwal(thn);
              $(document).bind('ajaxComplete', function(){          
                $('#box-content').find('div.overlay').fadeOut();                  
              });
            }
            else if (data.data == 'data_mhs_kls') {
              $('#box-kelas-mhs').find('div.overlay').fadeIn();
              daftar_kelas_mhs(data.kelas);
              $(document).bind('ajaxComplete', function(){          
                $('#box-kelas-mhs').find('div.overlay').fadeOut();                  
              });
            }
            else if(data.data == 'data_alumni'){
              if ($('.select2_data').val() == 0) {
                $('.check-all-mhs-dt').iCheck('uncheck');
                $('#box-content').find('div.overlay').fadeIn();
                $('.tbl-data-alumni-do').DataTable().ajax.reload();
                $(document).bind('ajaxComplete', function(){          
                  $('#box-content').find('div.overlay').fadeOut();                  
                });
              }
            }
            else if(data.data == 'data_mhs_do'){
              if ($('.select2_data').val() == 1) {
                $('.check-all-mhs-dt').iCheck('uncheck');
                $('#box-content').find('div.overlay').fadeIn();
                $('.tbl-data-alumni-do').DataTable().ajax.reload();
                $(document).bind('ajaxComplete', function(){          
                  $('#box-content').find('div.overlay').fadeOut();                  
                });
              }
            }
            else if(data.data == 'data_template'){
              get_list_template();
              if ($('#file-select-image-template').val() != '') {
                $('#file-select-image-template').fileinput('refresh',{
                  'uploadExtraData':{
                    'file_type': 'image',
                    'in_template': data.in_template,
                    'data':'template-image',
                    'upload_act':'singleUpload',
                    'act':'insert',
                    'csrf_key':token
                  }
                });
                $('#file-select-image-template').fileinput('upload');
              }
            }
            else if(data.data == 'data_menu'){
              list_menu('all');
            }
            $('#myModal').modal('hide');
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
        else if (action == 'update') {
          if (data.status == 'success') {
            if (data.data == 'data_identitas_pt') {
              if (data.record_pt == '') {
                $('#tab-identitas-pt .dl-horizontal .detail-data-pt').text('-');
                $('.box').hide();
                $('#tab-identitas-pt #profil, #tab-identitas-pt #kontak').append(
                  '<p class="text-center empty-pt-dt">Belum ada data untuk identitas perguruan tinggi. Klik <a class="btn btn-info btn-sm form-identitas-pt"><span class="fa fa-pencil-square"></span></a> untuk input data identitas perguruan tinggi pertama kalinya.</p>'
                  );
              }
              else{
                $('.box').show();
                $('.empty-pt-dt').remove();
                $.each(data.record_pt, function(index, data_record){
                  $.each(data_record, function(name, data_record){
                    if (data_record =='') {
                      data_record ='-';
                    }
                    if (name == 'rt' || name == 'rw') {
                      $('#tab-identitas-pt .'+name).text(data_record);
                    }
                    $('#tab-identitas-pt .detail-data-pt.'+name).text(data_record);
                  });          
                });
              }
              $('#myModal-pt').modal('hide');                
            }
            else if (data.data == 'data_fakultas') {
              $('#box-content').find('div.overlay').fadeIn();
              $('.tbl-data-fk').DataTable().ajax.reload();                
              $(document).bind('ajaxComplete', function(){
                $('#box-content').find('div.overlay').fadeOut();
              });
              if ($('#box-detail-fk').is(':visible')) {
                var id = getUrlVars()['fk'];
                data_detail_fk(id);
              }
            }
            else if (data.data == 'data_prodi') {
              $('#box-detail-fk').find('div.overlay').fadeIn();
              $(document).bind('ajaxComplete', function(){
                $('#box-detail-fk').find('div.overlay').fadeOut();
              });
              if ($('#box-detail-fk').is(':visible')) {
                $('.close-dt-pd-bt').fadeOut();
                $('.detail-prodi').fadeOut().removeClass('active').find('a').attr('aria-expanded','false');
                $('#detail-prodi').removeClass('active');
                $('.daftar-prodi').addClass('active').find('a').attr('aria-expanded','true');
                $('#daftar-prodi').addClass('active');
                var id = $('#form-input-pstudi .id_fk_pd').val();
                data_detail_fk(id);
              }
              if ($('#box-prodi').is(':visible')) {
                $('.tbl-data-pd').DataTable().ajax.reload();
                $('.tbl-data-pd').DataTable().search('').draw();
              }
            }
            else if (data.data == 'data_konsentrasi_pd') {
              if ($('#tab-detail-fk .nav-tabs li.detail-prodi').is(':visible')) {
                delay(function(){
                  window.location.href= path+'#data?pd='+data.pd+'&token='+token+'';
                },500);
              }
              /*if ($('.box-konsentrasi-pd').attr('data-search') == data.pd) {
                daftar_konsentrasi(null,data.pd);
              }
              else if ($('.box-konsentrasi-pd').attr('data-search') != null) {
                daftar_konsentrasi(null,$('.box-konsentrasi-pd').attr('data-search'));
              }*/
            }
            else if (data.data == 'data_thn_akademik') {
              $('#box-content').find('div.overlay').fadeIn();
              $('#tbl-thn-akademik').DataTable().ajax.reload();
              $('#tbl-thn-akademik').DataTable().search('').draw();                
              $(document).bind('ajaxComplete', function(){                
                $('#box-content').find('div.overlay').fadeOut();
              });                
            }
            else if (data.data == 'data_thn_angkatan') {
              $('#box-content').find('div.overlay').fadeIn();
              $('#tbl-thn-angkatan').DataTable().ajax.reload();                
              $(document).bind('ajaxComplete', function(){
                $('#box-content').find('div.overlay').fadeOut();
              });
            }
            else if(data.data == 'data_mhs'){
              $('.check-all-siswa').iCheck('uncheck');
              if ($('#cari_thn_angkatan').val()=='' && $('#cari_prodi').val()=='') {
                $('#box-siswa .box-title').text('Data Mahasiswa');
              }
              if (data.status_update == true) {
                $('#box-siswa').find('div.overlay').fadeIn();
                $('.tbl-data-mhs').DataTable().ajax.reload();
                $(document).bind('ajaxComplete', function(){                
                  $('#box-siswa').find('div.overlay').fadeOut();                  
                });
              }
              if ($('.file-select-foto').val() != '') {
                $('.file-select-foto').fileinput('refresh',{
                  'uploadExtraData':{
                    'data':data.in,
                    'pt':'mhs',
                    'csrf_key':token
                  },
                });
                $('.file-select-foto').fileinput('upload');
              }
              if ($('#box-detail-mhs').is(':visible') && id_data_akademik_u == data.in && $('#box-detail-mhs').attr('data-search') == data.in) {
                delay(function(){
                  window.location.href= path+'#detail?mhs='+data.in+'&token='+token+'';
                },500);
              }
            }
            else if(data.data == 'data_ptk'){
              if (data.status_update == true) {
                $('#box-guru').find('div.overlay').fadeIn();
                $('.tbl-data-ptk').DataTable().ajax.reload();
                $(document).bind('ajaxComplete', function(){          
                  $('#box-guru').find('div.overlay').fadeOut();                  
                });
              }
              if ($('.file-select-foto').val() != '') {
                $('.file-select-foto').fileinput('refresh',{
                  'uploadExtraData':{
                    'data':data.in,
                    'pt':'ptk',
                    'csrf_key':token
                  },
                });
                $('.file-select-foto').fileinput('upload');
              }
              if ($('#box-ptk').is(':visible') && id_data_akademik_u == data.in) {
                delay(function(){
                  window.location.href= path+'#detail?ptk='+data.in+'&token='+token+'';
                },500);
              }
            }
            else if(data.data == 'data_studi_ptk'){
              if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') == data.in_ptk) {
                detail_data_ptk('studi_ptk');
              }
            }
            else if(data.data == 'data_penelitian_ptk'){
              if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') == data.in_ptk) {
                detail_data_ptk('penelitian_ptk');
              }
            }
            else if (data.data == 'data_mk') {
              $('.check-all-mk').iCheck('uncheck');
              $('.box-daftar-mk').fadeIn('slow');
              $('html, body').animate({scrollTop:$('.box-daftar-mk').offset().top},800);
              daftar_mk($('select.id_pd_mk').val());
            }
            else if (data.data == 'data_jadwal') {
              $('#box-content').find('div.overlay').fadeIn();
              $('.tbl-daftar-jadwal').DataTable().ajax.reload();
              var thn;
              $.each(data.thn, function(index,data_record){
                thn = data_record.thn_ajaran_jdl+' '+data_record.id_pd_mk;
              });
              daftar_jadwal(thn);
              $(document).bind('ajaxComplete', function(){          
                $('#box-content').find('div.overlay').fadeOut();                  
              });
            }
            else if (data.data == 'data_mhs_kls') {
              $('#box-kelas-mhs').find('div.overlay').fadeIn();
              daftar_kelas_mhs(data.c_kls);
              $(document).bind('ajaxComplete', function(){          
                $('#box-kelas-mhs').find('div.overlay').fadeOut();                  
              });
            }
            else if(data.data == 'data_alumni'){
              if ($('#box-detail-mhs').is(':visible') && id_data_akademik_u == data.in && $('#box-detail-mhs').attr('data-detail') == 'alumni' && $('#box-detail-mhs').attr('data-search') == data.in) {
                delay(function(){
                  window.location.href= path+'#detail?alumni='+data.in+'&token='+token+'';
                },500);
              }
            }
            else if(data.data == 'data_mhs_do'){
              if ($('#box-detail-mhs').is(':visible') && id_data_akademik_u == data.in && $('#box-detail-mhs').attr('data-detail') == 'alumni' && $('#box-detail-mhs').attr('data-search') == data.in) {
                delay(function(){
                  window.location.href= path+'#detail?mhs_do='+data.in+'&token='+token+'';
                },500);
              }
            }
            else if(data.data == 'data_konfigurasi'){
              get_app_config();
            }
            else if(data.data == 'data_template'){
              if ($('#file-select-image-template').val() != '') {
                $('#file-select-image-template').fileinput('refresh',{
                  'uploadExtraData':{
                    'file_type': 'image',
                    'in_template': data.in_template,
                    'data':'template-image',
                    'upload_act':'singleUpload',
                    'act':'update',
                    'csrf_key':token
                  }
                });
                $('#file-select-image-template').fileinput('upload');
              }
              else{
                get_list_template();
              }
            }
            else if(data.data == 'data_menu'){
              list_menu('all');
            }
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
        else if (action == 'delete') {
          if (data.status == 'success') {
            if (data.data == 'data_mhs') {
              $('.check-all-siswa').iCheck('uncheck');
              if ($('#cari_thn_angkatan').val()=='' && $('#cari_prodi').val()=='') {
                $('#box-siswa .box-title').text('Data Mahasiswa');
              }
              if (data.delete_id == $('#box-detail-mhs').attr('data-search')) {
                $('#box-detail-mhs').slideUp();
              }
              $('#box-siswa').find('div.overlay').fadeIn();
              $('.tbl-data-mhs').DataTable().ajax.reload();
              $(document).bind('ajaxComplete', function(){                
                $('#box-siswa').find('div.overlay').fadeOut();                  
              });
            }
            else if (data.data == 'data_ptk') {
              if (data.delete_id == $('#box-ptk').attr('data-search')) {
                $('#box-ptk').slideUp();
              }
              $('.check-all-guru').iCheck('uncheck');                
              $('#box-guru').find('div.overlay').fadeIn();
              $('.tbl-data-ptk').DataTable().ajax.reload();
              $(document).bind('ajaxComplete', function(){          
                $('#box-guru').find('div.overlay').fadeOut();                  
              });
            }
            else if(data.data == 'data_studi_ptk'){
              if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') == data.in_ptk) {
                detail_data_ptk('studi_ptk');
              }
            }
            else if(data.data == 'data_penelitian_ptk'){
              if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') == data.in_ptk) {
                detail_data_ptk('penelitian_ptk');
              }
            }
            else if (data.data == 'data_mk') {
              $('.check-all-mk').iCheck('uncheck');
              $('.check-mk').iCheck('uncheck');
              $('.hapus').addClass('disabled');
              $('.box-daftar-mk').fadeIn('slow');
              $('html, body').animate({scrollTop:$('.box-daftar-mk').offset().top},800);
              daftar_mk($('.box-daftar-mk').attr('data-search'));
            }
            else if (data.data == 'data_jadwal') {
              if (data.thn != '') {
                $('#box-content').find('div.overlay').fadeIn();
                var thn = data.thn+' '+data.pd;
                daftar_jadwal(thn,true);
                $(document).bind('ajaxComplete', function(){          
                  $('#box-content').find('div.overlay').fadeOut();                  
                });
              }
              else{
                $('.tbl-daftar-jadwal').DataTable().ajax.reload();
                $('#box-jadwal,#box-kelas-mhs').slideUp();
                $('table.tbl-data-jadwal').find('tbody').text('');
              }
            }
            else if (data.data == 'data_fakultas') {
              $('.check-all-fk, .check-all-prodi').iCheck('uncheck');
              $('#box-content').find('div.overlay').fadeIn();
              $('.tbl-data-fk').DataTable().ajax.reload();                
              $(document).bind('ajaxComplete', function(){
                $('#box-content').find('div.overlay').fadeOut();
              });
              if ($('#box-detail-fk').is(':visible')) {
                $('#box-detail-fk').slideUp();
              }
            }
            else if (data.data == 'data_prodi') {
              $('.check-all-prodi').iCheck('uncheck');                
              $('#box-detail-fk').find('div.overlay').fadeIn();
              $(document).bind('ajaxComplete', function(){
                $('#box-detail-fk').find('div.overlay').fadeOut();
              });
              if ($('#box-detail-fk').is(':visible')) {
                $('.close-dt-pd-bt').fadeOut();
                $('.detail-prodi').fadeOut().removeClass('active').find('a').attr('aria-expanded','false');
                $('#detail-prodi').removeClass('active');
                $('.daftar-prodi').addClass('active').find('a').attr('aria-expanded','true');
                $('#daftar-prodi').addClass('active');
                var id = $('#form-input-pstudi .id_fk_pd').attr('value');
                data_detail_fk(id);
              }
              if ($('#box-prodi').is(':visible')) {
                $('.tbl-data-pd').DataTable().ajax.reload();
                $('.tbl-data-pd').DataTable().search('').draw();
              }
            }
            else if (data.data == 'data_konsentrasi_pd') {
              if ($('#tab-detail-fk .nav-tabs li.detail-prodi').is(':visible')) {
                delay(function(){
                  window.location.href= path+'#data?pd='+data.pd+'&token='+token+'';
                },500);
              }
              /*if ($('.box-konsentrasi-pd').attr('data-search') == data.pd) {
                daftar_konsentrasi(null,data.pd);
              }
              else if ($('.box-konsentrasi-pd').attr('data-search') != null) {
                daftar_konsentrasi(null,$('.box-konsentrasi-pd').attr('data-search'));
              }*/
            }
            else if (data.data == 'data_mhs_kls') {
              $('#box-kelas-mhs').find('div.overlay').fadeIn();
              daftar_kelas_mhs(data.c_kls);
              $(document).bind('ajaxComplete', function(){          
                $('#box-kelas-mhs').find('div.overlay').fadeOut();                  
              });
            }
            else if (data.data == 'data_alumni') {
              if ($('.select2_data').val() == 0) {
                $('.check-all-data').iCheck('uncheck');
                $('.box-alumni-do').find('div.overlay').fadeIn();
                $('.tbl-data-alumni-do').DataTable().ajax.reload();
                $(document).bind('ajaxComplete', function(){                
                  $('.box-alumni-do').find('div.overlay').fadeOut();                  
                });
                if ($('#box-detail-mhs').is(':visible')) {
                  if (getUrlVars()['alumni'] == $('#box-detail-mhs').attr('data-search')) {
                    $('#box-detail-mhs').slideUp();
                  }
                }
              }
            }
            else if (data.data == 'data_mhs_do') {
              if ($('.select2_data').val() == 1) {
                $('.check-all-data').iCheck('uncheck');
                $('.box-alumni-do').find('div.overlay').fadeIn();
                $('.tbl-data-alumni-do').DataTable().ajax.reload();
                $(document).bind('ajaxComplete', function(){                
                  $('.box-alumni-do').find('div.overlay').fadeOut();                  
                });
                if ($('#box-detail-mhs').is(':visible')) {
                  if (getUrlVars()['mhs_do'] == $('#box-detail-mhs').attr('data-search')) {
                    $('#box-detail-mhs').slideUp();
                  }
                }
              }
            }
            else if(data.data == 'data_template'){
              get_list_template();
            }
            else if(data.data == 'data_menu'){
              list_menu('all');
            }
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
  $(document).on('click', '#submit-again', function(eve){
    eve.stopImmediatePropagation();
    eve.preventDefault();
    
    $('#form-input, form').find('.is-invalid').removeClass('is-invalid');
    $('#form-input, form').find('.is-invalid-select').removeClass('is-invalid-select');
    $('#form-input, form').find('.invalid-feedback').remove();
    var submit_btn = $(this).find('li');
    var action = $('#form-input').attr('action');
    var mp = getUrlVars();      
    if (mp == 'jadwal') {
      var datasend = $('#form-input-jadwal').serialize();
    }
    else if (mp == 'prodi' || mp == 'fk,i,token' || mp == 'pd') {
      var datasend = $('#form-input-pstudi').serialize();
    }
    else if (mp == 'kelas_mhs') {
      var datasend = $('#form-input-kls-mhs').serialize()+'&kelas_mhs='+mp['kelas_mhs'];
    }
    else if (mp['data'] == 'pend_ptk') {
      var datasend = $('#form-input-studi-ptk').serialize();
      if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') != '') {
        datasend = datasend+'&ptk_detail='+$('#box-ptk').attr('data-search');
      }
    }
    else if (mp['data'] == 'research_ptk') {
      var datasend = $('#form-input-penelitian-ptk').serialize();
      if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') != '') {
        datasend = datasend+'&ptk_detail='+$('#box-ptk').attr('data-search');
      }
    }
    else if (mp['data'] == 'konsentrasi_prodi' || mp['prodi_kons'] != undefined) {
      var datasend = $('#form-input-konsentrasi-pd').serialize();
    }
    else if (mp['data'] == 'mhs_do') {
      var datasend = $('#form-input-mhs-do').serialize();
    }
    else{          
      var datasend = $('#form-input').serialize();
    }

    /*datasend = datasend+'&csrf_key='+token;*/

    $('#alert-place').text('');
    var data = null;
    var hash = getUrlVars();      
    data = hash['data'];

    $.ajax('http://'+host+controller_path+'/action/'+action+'?token='+token+'&key='+rand_val(30),{
      dataType: 'json',
      type: 'POST',
      data: datasend,
      beforeSend: function(){
        submit_btn.removeClass('fa-clone').addClass('fa-circle-o-notch fa-spin');
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
            submit_btn.removeClass('fa-circle-o-notch fa-spin').addClass('fa-check');
            setTimeout(function(){
              submit_btn.removeClass('fa-check fa-circle-o-notch fa-spin').addClass('fa-clone');
            },2000);
          }
          else{
            submit_btn.removeClass('fa-refresh fa-spin').addClass('fa-clone');
          }
        }
        $('.submit-process').fadeOut();
      },
      success: function(data){
        if (action == 'tambah') {
          if (data.status == 'success') {
            if (data.data == 'data_thn_angkatan') {
              $('#box-content').find('div.overlay').fadeIn();
              $('#tbl-thn-angkatan').DataTable().ajax.reload();      
              $('#tbl-thn-angkatan').DataTable().search('').draw();                
              $(document).bind('ajaxComplete', function(){                
                $('#box-content').find('div.overlay').fadeOut();
              });
            }
            else if (data.data == 'data_fakultas') {
              $('#box-content').find('div.overlay').fadeIn();
              $('.tbl-data-fk').DataTable().ajax.reload();
              $(document).bind('ajaxComplete', function(){
                $('#box-content').find('div.overlay').fadeOut();
              });
            }
            else if (data.data == 'data_prodi') {
              if ($('#box-detail-fk').is(':visible')) {
                $('#box-detail-fk').find('div.overlay').fadeIn();
                $(document).bind('ajaxComplete', function(){
                  $('#box-detail-fk').find('div.overlay').fadeOut();
                });
                var id = $('#form-input-pstudi .id_fk_pd').val();
                data_detail_fk(id);
              }
              else{
                $('#box-content').find('div.overlay').fadeIn();
                $(document).bind('ajaxComplete', function(){
                  $('#box-content').find('div.overlay').fadeOut();
                });
              }
            }
            else if (data.data == 'data_mhs') {
              $('.check-all-siswa').iCheck('uncheck');
              $('input[type="radio"]').iCheck('uncheck'); 
              $('#cari_thn_angkatan, #cari_prodi').val('');                
              $('#box-siswa .box-title').text('Data Mahasiswa');
              $('.tbl-data-mhs').DataTable().ajax.reload();
              if ($('.file-select-foto').val() != '') {
                $('.file-select-foto').fileinput('refresh',{
                  'uploadExtraData':{
                    'data':data.in,
                    'pt':'mhs',
                    'csrf_key':token
                  },
                });
                $('.file-select-foto').fileinput('upload');
              }
            }
            else if (data.data == 'data_ptk') {
              $('.check-all-guru').iCheck('uncheck');    
              $('input[type="radio"]').iCheck('uncheck');            
              $('#box-guru').find('div.overlay').fadeIn();
              $('.tbl-data-ptk').DataTable().ajax.reload();
              $(document).bind('ajaxComplete', function(){          
                $('#box-guru').find('div.overlay').fadeOut();
              });
              if ($('.file-select-foto').val() != '') {
                $('.file-select-foto').fileinput('refresh',{
                  'uploadExtraData':{
                    'data':data.in,
                    'pt':'ptk',
                    'csrf_key':token
                  },
                });
                $('.file-select-foto').fileinput('upload');
              }
            }
            else if(data.data == 'data_studi_ptk'){
              if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') == data.in_ptk) {
                detail_data_ptk('studi_ptk');
              }
            }
            else if(data.data == 'data_penelitian_ptk'){
              if ($('#box-ptk').is(':visible') && $('#box-ptk').attr('data-search') == data.in_ptk) {
                detail_data_ptk('penelitian_ptk');
              }
            }
            else if (data.data == 'data_mata_kuliah') {
              $('.check-all-mk').iCheck('uncheck');
              $('.box-daftar-mk').fadeIn('slow');
              $('html, body').animate({scrollTop:$('.box-daftar-mk').offset().top},800);
              daftar_mk($('select.id_pd_mk').val());
            }
            else if (data.data == 'data_jadwal') {
              $('#box-content').find('div.overlay').fadeIn();
              $('.tbl-daftar-jadwal').DataTable().ajax.reload();
              var thn;
              $.each(data.thn, function(index,data_record){
                thn = data_record.thn_ajaran_jdl+' '+data_record.id_pd_mk;
              });
              daftar_jadwal(thn);
              $(document).bind('ajaxComplete', function(){          
                $('#box-content').find('div.overlay').fadeOut();                  
              });
            }
            else if (data.data == 'data_mhs_kls') {
              $('#box-kelas-mhs').find('div.overlay').fadeIn();
              daftar_kelas_mhs(data.kelas);
              $(document).bind('ajaxComplete', function(){          
                $('#box-kelas-mhs').find('div.overlay').fadeOut();                  
              });
            }
            $('.modal #form-input,.modal form').find('input[type=text], input[type=number]').val('');
            $('.modal input[type="radio"]').iCheck('uncheck');
            $('.modal .select2').val(null).trigger('change');
            $('.modal').find('.is-invalid').removeClass('is-invalid');                            
            /*$('#alert-place').prepend(
              '<div class="alert alert-success alert-dismissible">'
              +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
              +'  <h4><i class="icon glyphicon glyphicon-ok"></i> Berhasil!</h4>'                
              +'  Data telah tersimpan'
              +'</div>'
            );*/
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
        token = data.n_token;
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
  /*END -- Submit AJAX*/

});