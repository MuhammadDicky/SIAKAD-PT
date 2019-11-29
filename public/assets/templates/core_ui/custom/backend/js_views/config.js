var global_vars = {
    'path' : window.location.pathname,
    'host' : window.location.hostname,
    'id_data_akademik_u' : '',
    'load_interval' : '',
    'intval_vars' : '',
    'load_state' : false,
    'element_vars' : [],
    'dashboard_path_dt' : (function(){
        return [
            data_dashboard_path,
            data_dashboard_path+"/",
            data_dashboard_path+"/pengolahan_database",
            data_dashboard_path+"/pengaturan"
        ];
    })(),
    'master_path_dt' : (function(){
        return [
            data_master_path+"/data_identitas_pt",
            data_master_path+"/data_fakultas_pstudi",
            data_master_path+"/data_angkatan",
            data_master_path+"/data_thn_akademik"
        ];
    })(),
    'user_path_dt' : (function(){
        return [
            data_pengguna_path+"/data_pengguna_mahasiswa",
            data_pengguna_path+"/data_pengguna_ptk",
            data_pengguna_path+"/data_pengunjung"
        ];
    })(),
    'akademik_path_dt' : (function(){
        return [
            data_akademik_path+"/data_mahasiswa",
            data_akademik_path+"/data_ptk",
            data_akademik_path+"/data_mata_kuliah",
            data_akademik_path+"/data_jadwal_kuliah",
            data_akademik_path+"/data_nilai_mhs",
            data_akademik_path+"/data_alumni_do"
        ];
    })()
};

var create_ctrl_pt = (function(){
    if (check_array_exist(global_vars.dashboard_path_dt, global_vars.path) == true) {
        return data_dashboard_path;
    }
    else if (check_array_exist(global_vars.master_path_dt, global_vars.path) == true) {
        return data_master_path;
    }
    else if (check_array_exist(global_vars.user_path_dt, global_vars.path) == true) {
        return data_pengguna_path;
    }
    else if (check_array_exist(global_vars.akademik_path_dt, global_vars.path) == true) {
        return data_akademik_path;
    }
})();

global_vars.controller_path = create_ctrl_pt;

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout(timer);
    timer = setTimeout(callback, ms);
  };
})();

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
      clearInterval(global_vars.intval_vars);
      global_vars.intval_vars = setInterval(function(){
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

  /*slimScroll Plugin*/
  $('.default-overflow-container').slimScroll({
    position: 'right',
    height: '340px',
  });
  /*END -- slimScroll Plugin*/

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

  /*Modal Event*/
  var modal_show_animated = 'zoomIn';
  var modal_hide_animated = 'zoomOutDown';
  $('.modal').on('show.bs.modal', function(e){
    modal_animated(modal_show_animated, modal_hide_animated);
    $('body').addClass('modal-show');
  });

  $('#myModal').on('hidden.bs.modal', function(e){
    modal_animated(modal_hide_animated, modal_show_animated);
    window.history.pushState(null, null , global_vars.path);
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
    if (global_vars.path== global_vars.controller_path+'/data_fakultas_pstudi') {
      html = '<ol style="text-align:left">'
      +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Fakultas</a> untuk menambah data fakultas</li>'
      +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Program Studi</a> untuk menambah program studi</li>'
      +'<li>klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i></a> pada daftar fakultas untuk menambah program studi</li>'
      +'</ol>';
    }
    else if (global_vars.path== global_vars.controller_path+'/data_thn_akademik') {
      html = '<ol style="text-align:left">'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Tahun Akademik</a> Untuk menambah tahun akademik</li>'
        +'<li>Klik tombol <a class="btn btn-danger text-white"><i class="fa fa-ban"></i> Tutup Tahun Akademik</a> Untuk menutup/nonaktifkan tahun akademik yang sedang berjalan</li>'
        +'<li>klik <div class="toggle btn btn-success btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-success btn-sm toggle-on"><i class="fa fa-check-circle"></i> Diterapkan</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div> | <div class="toggle btn btn-danger off btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-danger btn-sm active toggle-off"><i class="fa fa-ban"></i> Tidak Diterapkan</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div>'
        +' pada daftar tahun akademik untuk menerapkan atau menutup tahun akademik</li>'
        +'<li>klik <div class="toggle btn btn-success btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-success btn-sm toggle-on"><i class="fa fa-check-circle"></i> Input Nilai</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div> | <div class="toggle btn btn-danger off btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-danger btn-sm active toggle-off"><i class="fa fa-ban"></i> Input Nilai</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div>'
        +' pada daftar tahun akademik agar proses input nilai bisa dilakukan maupun sebaliknya</li>'
        +'</ol>';
    }
    else if (global_vars.path== global_vars.controller_path+'/data_angkatan') {
      html = '<ol style="text-align:left">'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Tahun Angkatan</a> Untuk menambah tahun angkatan mahasiswa</li>'
        +'<li>Klik tombol <a class="btn btn-danger text-white"><i class="fa fa-trash"></i> Hapus</a> Untuk menghapus tahun angkatan mahasiswa</li>'
        +'<li>klik tombol <a class="btn btn-warning text-white"><i class="fa fa-list"></i></a> Untuk melihat daftar angkatan mahasiswa dan klik tombol <a class="btn btn-success"><i class="fa fa-pencil-square"></i></a> Untuk mengedit data tahun angkatan</li>'
        +'</ol>';
    }
    else if (global_vars.path== global_vars.controller_path+'/data_mata_kuliah') {
      html = '<ol style="text-align:left">'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Mata Kuliah</a> untuk menambah mata kuliah</li>'
        +'<li>Klik tombol <a class="btn btn-danger text-white"><i class="fa fa-trash"></i> Hapus</a> pada control panel untuk menghapus multiple data</li>'
        +'<li>Klik tombol <a class="btn btn-success text-white"><i class="fa fa-list"></i> Tampilkan Mata Kuliah</a> untuk Menampilkan mata kuliah berdasarkan prodi yang dipilih</li>'
        +'</ol>';
    }
    else if (global_vars.path== global_vars.controller_path+'/data_jadwal_kuliah') {
      html = '<ol style="text-align:left">'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Buat Jadwal Kuliah</a> untuk menambah jadwal kuliah kuliah</li>'
        +'<li>Klik tombol <a class="btn btn-danger text-white"><i class="fa fa-trash"></i> Hapus</a> pada control panel untuk menghapus multiple data</li>'
        +'<li>Klik tombol <a class="btn btn-success text-white"><i class="fa fa-list"></i> Tampilkan Jadwal Kuliah</a> untuk menampilkan jadwal kuliah berdasarkan tahun akademik dan prodi yang dipilih</li>'
        +'<li>Klik tombol <a class="btn btn-info text-white"><i class="fa fa-plus"></i> Tambah Mahasiswa</a> untuk menambah mahasiswa kedalam kelas yang bersangkutan</li>'
        +'</ol>';
    }
    else if (global_vars.path== global_vars.controller_path+'/pengaturan') {
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

});