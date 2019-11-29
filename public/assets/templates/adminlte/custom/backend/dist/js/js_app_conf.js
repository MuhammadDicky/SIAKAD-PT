var path = window.location.pathname,
host     = window.location.hostname + (window.location.port !== '' ? ':' + window.location.port : ''),
hostProtocol = window.location.protocol,
id_data_akademik_u,
load_interval,
intval_vars,
load_state = false,
element_vars = [],
controller_path,
dashboard_path_dt = [
  data_dashboard_path,
  data_dashboard_path+"/",
  data_dashboard_path+"/dashboard",
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

/*if (path == data_dashboard_path || path == data_dashboard_path+'/' || path == data_dashboard_path+'/pengolahan_database' || path == data_dashboard_path+'/pengaturan') {
  var controller_path = data_dashboard_path;
}
else if (path == data_master_path+'/data_angkatan' || path == data_master_path+'/data_thn_akademik' || path == data_master_path+'/data_fakultas_pstudi' || path == data_master_path+'/data_kelas' || path == data_master_path+'/data_identitas_pt') {
  var controller_path = data_master_path;
}
else if (path == data_pengguna_path+'/data_pengguna_mahasiswa' || path == data_pengguna_path+'/data_pengguna_ptk' || path == data_pengguna_path+'/data_pengunjung') {
  var controller_path = data_pengguna_path;
}
else if (path ==  data_akademik_path+'/data_mahasiswa' || data_akademik_path+'/data_ptk' || data_akademik_path+'/data_mata_kuliah' || data_akademik_path+'/data_jadwal_kuliah' || data_akademik_path+'/data_nilai_mhs' || data_akademik_path+'/data_alumni_do') {
  var controller_path = data_akademik_path;
}*/

$(function(){

    /*Window Resize*/
    /*if($(window).width() < 900){
      $('.tbl-responsive').addClass('table-responsive');
    }
    $(window).resize(function(){     
     if($(window).width() < 900){
      $('.tbl-responsive').addClass('table-responsive');
     }
     else{
      $('.tbl-responsive').removeClass('table-responsive');
     }
    });*/
    /*END -- Window Resize*/

    /*AJAX Event*/
    $(document).ajaxSend(function(eve,xhr,settings){
      /*console.log(settings);
      console.log(xhr);*/
      if (settings['data'] != '[object FormData]' && settings['data'].search('csrf_key=') < 0) {
        settings['data'] = settings['data']+'&csrf_key='+token;
      }
    });
    /*END -- AJAX Event*/

    /*First Load Page*/
    if (path == controller_path+'/data_identitas_pt') {
      $('#tab-identitas-pt .detail-data-pt').text('-');
      var data_id_pt = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{data:'data_identitas_pt'},1000);
      data_id_pt.then(function(results){
        if (results.status == 'empty') {
          $('#tab-identitas-pt .detail-data-pt').text('-');
          $('.box').hide();
          $('#tab-identitas-pt #profil').append(
            '<p class="text-center empty-pt-dt">Belum ada data untuk identitas perguruan tinggi. Klik <a class="btn btn-info btn-sm form-identitas-pt"><span class="fa fa-pencil-square"></span></a> untuk input data identitas perguruan tinggi pertama kalinya.</p>'
            );
        }
        else{
          $('.box').show();
          $.each(results.data, function(index, data_record){
            $.each(data_record, function(name, data_record){
              if (data_record =='') {
                data_record ='-';
              }
              if (name == 'website') {
                $('#tab-identitas-pt .'+name).parents().attr('href',hostProtocol + '//'+data_record);
              }
              if (name == 'rt' || name == 'rw') {
                $('#tab-identitas-pt .'+name).text(data_record);
              }
              $('#tab-identitas-pt .detail-data-pt.'+name).text(data_record);
            });          
          });
        }
      });

      $('#tab-identitas-sekolah #container-form-profil, #tab-identitas-sekolah #container-form-kontak').slimScroll({
        position: 'right',
        height: '340',
      });
    }

    if (path == controller_path+'/pengolahan_database') {
      load_backup_tbl();
    }

    if (path == controller_path+'/pengaturan') {
      /*Check Browser storage*/
      if (typeof (Storage) == "undefined") {
        $('#settings-layout .body-settings-layout').prepend(
        '<div class="row">'
        +'  <div class="col-md-12">'
        +'    <div class="callout callout-danger">'
        +'      <h4><i class="fa fa-exclamation-circle"></i> Perhatian!</h4>'
        +'      <p>Browser yang anda pakai tidak mendukung untuk pengaturan layout, tolong gunakan browser modern untuk bisa menggunakan pengaturan layout!</p>'
        +'    </div>'
        +'  </div>'
        +'</div>'
        );
      }

      /*Load Config*/
      get_app_config();

      /*Load list template*/
      get_list_template();

      /*Load List Menu*/
      list_menu('all');

      /*Check Backup File*/
      load_backup_tbl();

      /*Sortable Master Plugin*/
      /*END -- Sortable Master Plugin*/
    }
    /*END -- First Load Page*/

    /*slimScroll Plugin*/
    $('.default-overflow-container').slimScroll({
      position: 'right',
      height: '340px',
    });
    $('.container-form-mhs').slimScroll({
      position: 'right',
      height: '265px',
    });
    $('#container-detail-user-mhs').slimScroll({
      position: 'right',
      height: '340px',
    });
    $('#container-detail-user-ptk').slimScroll({
      position: 'right',
      height: '250px',
    });
    $('#settings-layout #row-layout-settings .box .box-footer').slimScroll({
      position: 'right',
      height: '96px',
      distance: '2px'
    });
    /*END -- slimScroll Plugin*/

    /*Sortable Master Plugin*/
    /*END -- Sortable Master Plugin*/

    /*DatePicker Plugin*/          
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      language: 'id'
    });
    /*END -- DatePicker Plugin*/

    /*Timepicker Plugin*/
    $(".timepicker").timepicker({
      showMeridian: false,
      defaultTime: '14:08',
      showWidget: true,
      minuteStep:1,
      timeFormat: 'HH:mm',
    });

    $('.timepicker').timepicker().on('changeTime.timepicker', function(eve){
      var time = $(this).val();       
      if (time.length == 4) {
        $(this).val('0'+time);
      }
    });
    /*END -- Timepicker Plugin*/

    /*Script For prevent close modal after datepicker close*/
    $('.datepicker').datepicker().on('changeDate',function(eve){
    }).on('hide',function(eve){
      eve.preventDefault();
      eve.stopPropagation();
    });
    /*END -- Script For prevent close modal after datepicker close*/

    /*Mousewheel Horizontal*/
    $('.control-panel-data').mousewheel(function(eve,delta){
      eve.preventDefault();
      this.scrollLeft -= (delta*40);
    });
    /*END -- Mousewheel Horizontal*/

    /*Moment JS*/
    moment.locale('id');
    var last_online_user = $('#user-widget-detail .user-last-time-login').attr('data-time');
    $('#user-widget-detail .user-last-time-login').text('Terakhir kali login '+moment(last_online_user).fromNow());
    $('.last-online-user-text').text(moment(last_online_user).fromNow());
    /*END -- Moment JS*/

    /*HASHCHANGE*/
    $(window).hashchange(function(){
      var hash = $.param.fragment();
      $('#batal').text('Batal');
      $('.modal .submit-btn, .modal .submit-again-btn').hide();
      $('.modal .load-data').replaceWith('');
      $('.modal .modal-body').append('<p class="load-data text-center">Memproses Data</p>');

      if (hash == 'tambah') {
        $('.modal .load-data').replaceWith('');
        $('#myModal form, #myModal .list-selected, #myModal .data-message').hide();
        $('.modal .submit-btn, .modal .submit-again-btn').show();
        $('#myModal').modal('show');
        $('.modal').addClass('modal-info');
        modal_animated('zoomIn');
        if (path.search('admin/data_master/data_angkatan') > 0) {
          $('#myModal #form-input').show();
          $('#myModal .modal-title').text('Tambah Data Tahun Angkatan Mahasiswa');
        }
        else if (path.search('admin/data_master/data_thn_akademik') > 0) {
          $('#myModal #form-input').show();
          $('#myModal .modal-title').text('Tambah Data Tahun Akademik');
        }
        else if (path.search('admin/data_akademik/data_mahasiswa') > 0) {
          /*$('#myModal .form-container').html(getHtml_page({pg:'bs_modal',request:'form-input-mhs'}));*/
          $('#myModal .nav-tabs-custom').addClass('nav-info').removeClass('nav-success');
          $('#form-input .photo-usr-edit-n').attr('src',$('#form-input .photo-usr-edit-n').attr('default-photo'));
          $('#form-input .photo-file-name').text('Nama File: -');
          $('#form-input .remove-photo').hide();
          $('#form-input #tab_media .box').removeClass('box-success').addClass('box-info');
          $('#myModal #form-input, #form-input .ft-mhs-form').show();
          /*$('#form-input #tab_media').removeClass('style-1 overflow-tab').css('height','260px');*/
          $('#myModal .modal-title').text('Tambah Data Mahasiswa');
        }
        else if (path.search('admin/data_akademik/data_ptk') > 0) {
          $('#myModal .nav-tabs-custom').addClass('nav-info').removeClass('nav-success');
          $('#rincian-guru').hide();
          /*$('#form-input #tab_media').removeClass('style-1 overflow-tab');*/
          $('#form-input .photo-usr-edit-n').attr('src',$('#form-input .photo-usr-edit-n').attr('default-photo'));
          $('#form-input .photo-file-name').text('Nama File: -');
          $('#form-input .remove-photo').hide();
          $('#form-input #tab_media .box').removeClass('box-success').addClass('box-info');
          $('#myModal #form-input, #form-input .ft-mhs-form').show();
          $('#myModal .modal-title').text('Tambah Data Tenaga Pendidik');
        }
        else if (path.search('admin/data_akademik/data_mata_kuliah') > 0) {
          $('#myModal .nav-tabs-custom').addClass('nav-info').removeClass('nav-success');                    
          $('#myModal .modal-title').text('Tambah Data Mata Kuliah');
          $('#myModal #form-input').show();
          $('#myModal #form-input-jadwal').hide();
        }
        else if (path.search('admin/data_akademik/data_jadwal_kuliah') > 0) {
          $('#myModal #form-input-kls-mhs, #myModal #form-pindah-kelas, #myModal #form-input-jadwal').hide();
          $('#myModal .nav-tabs-custom').addClass('nav-info').removeClass('nav-success');
          $('#myModal .modal-title').text('Tambah Data Jadwal Kuliah');
          $('#myModal #form-input').show();
        }
        else if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
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
        modal_animated('zoomIn');
        $('#myModal form, #myModal .list-selected, #myModal .data-message').hide();
        $('#myModal .submit-btn').attr('id','submit');
        $('#myModal').modal('show');
        $('.modal').addClass('modal-info');
        $('#myModal #form-input').attr('action','tambah');
        if (path.search('admin/data_akademik/data_mahasiswa') > 0) {
          if (getUrlVars()['data'] == 'alumni') {
            $('#myModal .modal-title').text('Tambah Data Alumni');
            $('#submit-again').hide();
            var selectedItems = [];
            $(".check-siswa:checked").each(function() {
              selectedItems.push($(this).val());
            });       
            var count = selectedItems.length;
            if (count > 0 ) {
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mhs',check:'alumni'},1000);
              data.then(function(daftar_mhs){
                if (getUrlVars()['data'] == 'alumni') {
                  if (daftar_mhs.total_rows > 0 ) {
                    $('#form-input-alumni,#submit,.list-selected').show();
                    $('.list-selected').find('h5').text('Daftar Mahasiswa yang akan diinput kedalam data alumni:');
                    /*$('#myModal #submit').attr('id','input-alumni').text('Simpan');*/
                    $('.list-selected .list-mhs-selected').find('tbody').text('');
                    var no = 1;
                    $.each(daftar_mhs.data, function(index,data_record){
                      $('.list-selected .list-mhs-selected').find('tbody').append(
                          '<tr>'
                          +'  <td class="text-center">'+no+'</td>'
                          +'  <td class="text-center">'+data_record.nim+'</td>'
                          +'  <td>'+data_record.nama+'</td>'
                          +'</tr>'   
                        );
                      no++;
                    });
                  }
                  else{
                    $('.data-message').show();
                    $('#submit,.list-selected').hide();
                    $('.data-message .content-message').addClass('centered-content');
                    $('.data-message .content-message').html(daftar_mhs.message);
                    $('#batal').text('Tutup');
                  }
                }
                else{
                  load_state = true;
                }
              }).catch(function(){
              });
            }
            else{
              $('.data-message').show();
              $('#submit,.list-selected').hide();
              $('.data-message .content-message').addClass('centered-content');
              $('.data-message .content-message').html('Silahkan pilih data mahasiswa yang diinput ke data alumni!');
              $('#batal').text('Tutup');
            }
          }
          else if (getUrlVars()['data'] == 'drop_out') {
            $('#myModal .modal-title').text('Tambah Data Mahasiswa Drop Out');
            $('#submit-again').hide();
            var selectedItems = [];           
            $(".check-siswa:checked").each(function() {
              selectedItems.push($(this).val());
            });       
            var count = selectedItems.length;
            if (count > 0 ) {
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mhs',check:'alumni'},1000);
              data.then(function(daftar_mhs){
                if (getUrlVars()['data'] == 'drop_out') {
                  if (daftar_mhs.total_rows > 0 ) {
                    $('#form-input-mhs-do,#submit,.list-selected').show();
                    $('.list-selected').find('h5').text('Daftar Mahasiswa yang akan diinput kedalam data mahasiswa drop out:');
                    /*$('#myModal #submit').attr('id','input-mhs-do').text('Simpan');*/
                    $('.list-selected .list-mhs-selected').find('tbody').text('');
                    var no = 1;
                    $.each(daftar_mhs.data, function(index,data_record){
                      $('.list-selected .list-mhs-selected').find('tbody').append(
                          '<tr>'
                          +'  <td class="text-center">'+no+'</td>'
                          +'  <td class="text-center">'+data_record.nim+'</td>'
                          +'  <td>'+data_record.nama+'</td>'
                          +'</tr>'   
                        );
                      no++;
                    });
                  }
                  else{
                    $('.data-message').show();
                    $('#submit,.list-selected').hide();
                    $('.data-message .content-message').addClass('centered-content');
                    $('.data-message .content-message').html(daftar_mhs.message);
                    $('#batal').text('Tutup');
                  }
                }
                else{
                  load_state = true;
                }
              }).catch(function(){
              });
            }
            else{
              $('.data-message').show();
              $('#submit,.list-selected').hide();
              $('.data-message .content-message').addClass('centered-content');
              $('.data-message .content-message').html('Silahkan pilih data mahasiswa yang diinput ke data mahasiswa drop out!');
              $('#batal').text('Tutup');
            }
          }
          else{
            $('#myModal').modal('hide');
          }
        }
        else if (path.search('admin/data_akademik/data_ptk') > 0) {
          if (getUrlVars()['data'] == 'pend_ptk') {
            $('#myModal .modal-title').text('Tambah Data Riwayat Pendidikan Tenaga Pendidik');
            var in_ptk = getUrlVars()['in'];
            if (in_ptk != null && in_ptk != '') {
              var id_ptk = [];
              id_ptk.push(in_ptk);
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:id_ptk,data:'check_ptk',check:'data_exists'},1000);
              data.then(function(detail_ptk){
                if (detail_ptk.total_rows > 0) {
                  $('#form-input-studi-ptk').show();
                  $('#form-input-studi-ptk .select2_ptk').prepend('<option value="'+in_ptk+'">'+detail_ptk.data[0]['nidn']+' | '+detail_ptk.data[0]['nama']+'</option>');
                }
              });
            }
            else{
              $('#myModal .submit-btn').html('<li class="fa fa-save"></li> Simpan').show();
              $('#myModal .submit-again-btn').html('<li class="fa fa-clone"></li> Simpan dan Tambah').show();
              $('#form-input-studi-ptk').show();
            }
          }
          else if (getUrlVars()['data'] == 'research_ptk') {
            $('#myModal .modal-title').text('Tambah Data Penelitian Tenaga Pendidik');
            var in_ptk = getUrlVars()['in'];
            if (in_ptk != null && in_ptk != '') {
              var id_ptk = [];
              id_ptk.push(in_ptk);
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:id_ptk,data:'check_ptk',check:'data_exists'},1000);
              data.then(function(detail_ptk){
                if (detail_ptk.total_rows > 0) {
                  $('#form-input-penelitian-ptk').show();
                  $('#form-input-penelitian-ptk .select2_ptk').prepend('<option value="'+in_ptk+'">'+detail_ptk.data[0]['nidn']+' | '+detail_ptk.data[0]['nama']+'</option>');
                }
              });
            }
            else{
              $('#myModal .submit-btn').html('<li class="fa fa-save"></li> Simpan').show();
              $('#myModal .submit-again-btn').html('<li class="fa fa-clone"></li> Simpan dan Tambah').show();
              $('#form-input-penelitian-ptk').show();
            }
          }
        }
        else if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
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
            data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_fk:id,data:'data_fakultas'},1000);
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
              data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil_id',{id_pd:id,data:'data_prodi'},1000);
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
        else if (path.search('admin/data_akademik/data_jadwal_kuliah') > 0) {
          var vars = getUrlVars();
          if (vars['kelas_mhs'] != undefined) {
            $('#myModal .modal-title').text('Tambah Mahasiswa');
            if ($('#box-kelas-mhs').is(':visible')) {
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{status_kelas:vars['kelas_mhs'],data:'status_jdl'},1000);
              data.then(function(status_kelas){
                if (status_kelas.status_jdl == 1) {
                  $('#myModal #form-input-kls-mhs').show();
                }
                else{
                  $('#submit, #submit-again').hide();
                  $('.data-message').show();
                  $('#batal').text('Tutup');
                  if (status_kelas.status_jdl == 0) {
                    $('.data-message .content-message').html('Maaf, anda tidak bisa menambah mahasiswa dikelas ini karena tahun akademik kelas ini sudah tidak diterapkan!');
                  }
                  else{
                    $('.data-message .content-message').html('Maaf, kelas ini tidak terdaftar dalam database!');
                  }
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
        else if (path.search('admin/data_akademik/data_alumni_do') > 0) {
          $('#alumni,#mhs-do').show();
          $('.modal .load-data').replaceWith('');
          $('#myModal .submit-btn').html('<li class="fa fa-save"></li> Simpan').show();
          $('#myModal .submit-again-btn').html('<li class="fa fa-clone"></li> Simpan dan Tambah').show();
          if (getUrlVars()['data'] == 'alumni') {
            $('#myModal .modal-title').text('Tambah Data Alumni');
            $('#myModal #form-input').show();
          }
          else if (getUrlVars()['data'] == 'mhs_do') {
            $('#myModal .modal-title').text('Tambah Data Mahasiswa Drop Out');
            $('#myModal #form-input-mhs-do').show();
          }
          else{
            $('#myModal').modal('hide');
          }
        }
        else if (path.search('admin/pengaturan') > 0) {
          $('#myModal #batal').text('Batal');
          $('#myModal .submit-btn').html('<li class="fa fa-save"></li> Simpan').show();
          var url_vars = getUrlVars();
          if (url_vars['data'] != undefined && url_vars['data'] == 'template') {
            $('#myModal .modal-title').text('Tambah Data Template');
            $('#form-input-template').show();
          }
          else if (url_vars['data'] != undefined && url_vars['data'] == 'menu') {
            $('#myModal .modal-title').text('Tambah Data Menu');
            $('#form-input-menu').show();
            var level_access_menu = url_vars['lvl'];
            $('#form-input-menu select.level_access_menu').val(level_access_menu).trigger('change.select2');
          }
          else if (url_vars['data'] != undefined && url_vars['data'] == 'sub-menu') {
            $('#myModal .modal-title').text('Tambah Data Sub Menu');
            if (url_vars['in_menu'] != '') {
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_menu:url_vars['in_menu'],data:'data_menu'},500);
              data.then(function(detail_menu){
                if (detail_menu.total_rows > 0) {
                  $('#form-input-sub-menu .select2_parent_menu').html('');
                  $('#form-input-sub-menu .select2_parent_menu').prepend('<option value="'+detail_menu.record_menu[0]['id_menu']+'">'+detail_menu.record_menu[0]['nm_menu']+'</option>');
                }
                $('#form-input-sub-menu').show();
              });
            }
          }
          else{
            $('#myModal #batal').text('Tutup');
            $('#myModal .submit-btn').hide();
          }
        }
        else{
          $('#myModal').modal('hide');
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
        $('.modal').addClass('modal-success');
        $('#myModal').modal('show');
        modal_animated('zoomIn');
        if (path.search('admin/data_master/data_angkatan') > 0) {
          var id = getUrlVars()['thn'];
          var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{thn:id,data:'data_thn_angkatan'},500);
          data.then(function(edit_thn){
            if (edit_thn.total_rows > 0) {
              $('#myModal #form-input').show();
              $.each(edit_thn.record_thn, function(index, data_record){   
                if (data_record.tgl_masuk_angkatan != '0000-00-00') {
                  $('#form-input input[name=tgl_masuk_angkatan]').val(data_record.tgl_masuk_angkatan);
                  $('#form-input input[name=tgl_masuk_angkatan]').datepicker("update", new Date(data_record.tgl_masuk_angkatan));
                }
                $('#form-input input[name=thn_angkatan]').val(data_record.tahun_angkatan);
                $('#form-input #id_thn_angkatan').val(data_record.id_thn_angkatan);
              });
            }
          });
          $('#myModal .modal-title').text('Edit Data Tahun Angkatan Mahasiswa');
        }
        else if (path.search('admin/data_master/data_thn_akademik') > 0) {
          var id = getUrlVars()['i'];
          var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{thn:id,data:'data_thn_akademik'},500);
          data.then(function(edit_thn){
            if (edit_thn.total_rows > 0) {
              $('#myModal #form-input').show();
              $.each(edit_thn.record_thn, function(index, data_record){            
                if (index == 'tgl_mulai_thn_ajar' || index == 'tgl_akhir_thn_ajar') {
                  $('#form-input .'+index).datepicker("update", new Date(data_record));
                }
                $('#form-input .'+index).val(data_record);
                $('#form-input .'+index).trigger('change.select2');
              });
            }
          });
          $('#myModal .modal-title').text('Edit Data Tahun Akademik');
        }
        else if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
          var urlvar = getUrlVars();          
          if (urlvar[0] == 'fk') {
            var id = getUrlVars()['fk'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_fk:id,data:'data_fakultas'},500);
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
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_pd:id,data:'data_prodi',act:'edit'},500);
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
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:id,data:'data_konsentrasi_pd'},500);
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
        else if (path.search('admin/data_akademik/data_mahasiswa') > 0) {
          $('#myModal .nav-tabs-custom').addClass('nav-success').removeClass('nav-info');
          $('#rincian-siswa').hide();
          var id = getUrlVars()['mhs'];
          var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:id,data:'data_mhs',ac:''},500);
          data.then(function(detail_mhs){
            if (detail_mhs.total_rows > 0) {
              $('#myModal #form-input, #myModal #submit').show();
              $('#form-input .select2_prodi').text('');
              $('#form-input .ft-mhs-form').show();
              $('#form-input #tab_media .box').addClass('box-success').removeClass('box-info');
              $.each(detail_mhs.record_mhs, function(index, data_record){
                $.each(data_record, function(index, data_record){
                  if (data_record == '0' || data_record=='' || data_record=='0000-00-00') {
                    data_record = '';
                  }
                  if (index !='photo_mhs') {
                    $('#form-input .'+index).val(data_record);
                  }
                  if (index == 'jk') {
                    $('#form-input .'+data_record).iCheck('check');                
                  }
                  if (index == 'tgl_lhr' && data_record != '0000-00-00' && data_record != '') {
                    $('#form-input .'+index).datepicker("update", new Date(data_record));
                  }
                  $('#form-input select.'+index).trigger('change.select2');
                });
                if (data_record.check_file == true) {
                  /*$('#form-input #tab_media').addClass('style-1 overflow-tab');*/
                  $('#form-input .photo-usr-edit-n').attr('src',data_record.photo_mhs);
                  $('#form-input .photo-file-name').text('Nama File: '+data_record.file_name);
                  $('#form-input .remove-photo').show();
                }
                else{
                  /*$('#form-input #tab_media').removeClass('style-1 overflow-tab').css('height','260px');*/
                  $('#form-input .photo-usr-edit-n').attr('src',data_record.photo_mhs).attr('default-photo',data_record.photo_mhs);
                  $('#form-input .new-photo-usr').attr('default-photo',data_record.photo_mhs);
                  $('#form-input .photo-file-name').text('Nama File: -');
                  $('#form-input .remove-photo').hide();
                }
                
                if (data_record.nama_prodi != null) {
                  $('#form-input .select2_prodi').prepend('<option value="'+data_record.id_pd_mhs+'">'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</option>');
                }
                else{
                  $('#form-input .select2_prodi').text('');
                }
                if (data_record.tahun_angkatan != null) {
                  $('#form-input .select2_thn_angkatan').prepend('<option value="'+data_record.thn_angkatan+'">'+data_record.tahun_angkatan+'</option>');
                }
                else{
                  $('#form-input .select2_thn_angkatan').text('');
                }

                $('#form-input .photo-plc').val(data_record.photo_mhs);
              });
            }
          });
          $('#myModal .modal-title').text('Edit Data Mahasiswa');                    
        }
        else if (path.search('admin/data_akademik/data_ptk') > 0) {
          var vars_url = getUrlVars();
          if (vars_url['data'] == null) {
            $('#myModal .nav-tabs-custom').addClass('nav-success').removeClass('nav-info');
            var id = getUrlVars()['ptk'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_ptk:id,data:'data_ptk',ac:''},500);
            data.then(function(detail_ptk){
              if (detail_ptk.total_rows > 0) {
                $('#myModal #form-input').show();
                $('#form-input .ft-mhs-form').show();
                $('#form-input #tab_media .box').addClass('box-success').removeClass('box-info');
                $.each(detail_ptk.record_ptk, function(index, data_record){
                  $.each(data_record, function(index, data_record){
                    if (data_record == '0' || data_record == '0000-00-00') {
                      data_record = '';
                    }
                    if (index == 'jk_ptk') {
                      $('#form-input input[value='+data_record+']').iCheck('check');
                    }                
                    else if (index == 'tgl_lhr_ptk') {
                      $('#form-input input[name='+index+']').datepicker("update", new Date(data_record));
                    }
                    if (index != 'photo_ptk') {
                      $('#form-input .'+index).val(data_record);
                    }
                    $('#form-input select[name='+index+']').trigger('change.select2');
                  });
                  if (data_record.check_file == true) {
                    $('#form-input .photo-usr-edit-n').attr('src',data_record.photo_ptk);
                    $('#form-input .photo-file-name').text('Nama File: '+data_record.file_name);
                    $('#form-input .remove-photo').show();
                  }
                  else{
                    $('#form-input .photo-usr-edit-n').attr('src',data_record.photo_ptk);
                    $('#form-input .new-photo-usr').attr('default-photo',data_record.photo_mhs);
                    $('#form-input .photo-file-name').text('Nama File: -');
                    $('#form-input .remove-photo').hide();
                  }
                  $('#form-input .select2_prodi').prepend('<option value="'+data_record.id_prodi+'">'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</option>');
                });
              }
            });
            $('#myModal .modal-title').text('Edit Data Tenaga Pendidik');
          }
          else if (vars_url['data'] == 'pend_ptk') {
            var id = getUrlVars()['studi_ptk'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_studi:id,data:'data_studi_ptk'},500);
            data.then(function(detail_ptk){
              if (detail_ptk.total_rows > 0) {
                $('#myModal #form-input-studi-ptk').show();
                $.each(detail_ptk.studi_ptk, function(index, data_record){
                  $.each(data_record, function(index, data_record){
                    if (data_record == '0' || data_record == '0000-00-00') {
                      data_record = '';
                    }
                    if (index == 'tgl_ijazah_ptk') {
                      $('#form-input-studi-ptk input[name='+index+']').datepicker("update", new Date(data_record));
                    }
                    else{
                      $('#form-input-studi-ptk .'+index).val(data_record);
                    }
                  });
                  $('#form-input-studi-ptk .select2_ptk').prepend('<option value="'+data_record.id_ptk_studi+'">'+data_record.nidn+' | '+data_record.nama+'</option>');
                });
              }
            });
            $('#myModal .modal-title').text('Edit Data Riwayat Pendidikan Tenaga Pendidik');
          }
          else if (vars_url['data'] == 'research_ptk') {
            var id = getUrlVars()['research_ptk'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_penelitian_ptk:id,data:'data_penelitian_ptk'},500);
            data.then(function(detail_ptk){
              if (detail_ptk.total_rows > 0) {
                Pace.restart();
                $('#myModal #form-input-penelitian-ptk').show();
                $.each(detail_ptk.penelitian_ptk, function(index, data_record){
                  $.each(data_record, function(index, data_record){
                    if (data_record == '0' || data_record == '0000-00-00') {
                      data_record = '';
                    }
                    $('#form-input-penelitian-ptk .'+index).val(data_record);
                  });
                  $('#form-input-penelitian-ptk .select2_ptk').prepend('<option value="'+data_record.id_ptk_rsch+'">'+data_record.nidn+' | '+data_record.nama+'</option>');
                });
              }
            });
            $('#myModal .modal-title').text('Edit Data Penelitian Tenaga Pendidik');
          }
        }
        else if (path.search('admin/data_akademik/data_mata_kuliah') > 0) {
          var id = getUrlVars()['mk'];
          if (id != null) {
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_mk:id,data:'data_mk'},500);
            data.then(function(detail_mk){
              if (detail_mk.total_rows > 0) {
                $('#myModal #form-input').show();
                $.each(detail_mk.record_mk, function(index, data_record){
                  $.each(data_record, function(index, data_record){
                    if (index != 'id_pd_mk' || index != 'nama_prodi') {
                      $('#form-input .'+index).val(data_record);
                      $('#form-input .'+index).trigger('change.select2');
                    }
                  });
                  $('#form-input .select2_prodi').html('<option value="'+data_record.id_pd_mk+'">'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</option>');
                  if (data_record.jenis_jdl != 0 && data_record.nm_konsentrasi != null) {
                    $('#form-input .select2_konsentrasi_mk').html('<option value="'+data_record.jenis_jdl+'">'+data_record.nm_konsentrasi+'</option>');
                  }
                });
              }
            });
            $('#myModal .modal-title').text('Edit Data Mata Kuliah');
          }
          else{
            $('#myModal .modal-title').text('Edit Data Mata Kuliah');
            var selectedItems = [];           
            $(".check-mk:checked").each(function() {
              selectedItems.push($(this).val());
            });       
            var count = selectedItems.length;          
            if (count > 0 ) {
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mk',check:'data_exists'},1000);
              data.then(function(daftar_mk){
                if (daftar_mk.total_rows > 0 ) {
                  $('.list-selected').show().find('h5').text('Daftar Data Mata Kuliah yang akan diperbahrui:');
                  $('#form-edit-mk, #myModal .data-message').show();
                  $('#myModal #submit').attr('id','update-mk').text('Update');
                  $('.data-message .content-message').addClass('centered-text').html('Anda akan memperbahrui&nbsp<strong>'+daftar_mk.data.length+'&nbspdata</strong>&nbspmata kuliah<br>');
                  $('.list-selected .list-mhs-selected').find('tbody').text('');
                  var no = 1;
                  $.each(daftar_mk.data, function(index,data_record){
                    if (data_record.jenis_jdl != 0) {
                      var konsentrasi = ' <b>(Konsentrasi '+data_record.nm_konsentrasi+')</b>';
                    }
                    else{
                      var konsentrasi = '';
                    }
                    $('.list-selected .list-mhs-selected').find('tbody').append(
                        '<tr>'
                        +'  <td class="text-center">'+no+'</td>'
                        +'  <td class="text-center">'+data_record.kode_mk+'</td>'
                        +'  <td>'+data_record.nama_mk+''+konsentrasi+'</td>'
                        +'</tr>'   
                      );
                    no++;
                  });
                }
              });
            }
            else{
              $('.data-message').show();
              $('.data-message .content-message').addClass('centered-content').html('Silahkan pilih data mata kuliah yang ingin diedit!');
              $('#submit, #update-mk').hide();
              $('#batal').text('Tutup');
            }
          }
        }
        else if (path.search('admin/data_akademik/data_jadwal_kuliah') > 0) {
          if ($('#box-jadwal, #box-kelas-mhs').is(':visible')) {
            var vars = getUrlVars();
            if (vars == 'jadwal') {
              var id = getUrlVars()['jadwal'];
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_jdl:id,data:'data_jadwal_kuliah',act:'get'},500);
              data.then(function(detail_jdl){
                if (detail_jdl.total_rows > 0) {
                  $.each(detail_jdl.record_jdl, function(index, data_record){
                    if (data_record.status_jdl == 1) {
                      $('#myModal #form-input').show();
                      $.each(data_record, function(index, data_record){
                        $('#form-input .'+index).val(data_record);
                      });
                      if (data_record.jenis_jdl != '0') {
                        var konsentrasi = ' (Konsentrasi '+data_record.nm_konsentrasi+')';
                      }
                      else{
                        var konsentrasi = '';
                      }
                      $('#form-input .select2_thn_akademik').html('<option value="'+data_record.id_thn_ak_jdl+'">'+data_record.thn_ajaran_jdl+'</option>');
                      $('#form-input .select2_mk').html('<option value="'+data_record.id_mk_jdl+'">'+data_record.kode_mk+' | '+data_record.nama_mk+konsentrasi+'</option>');
                      $('#form-input .select2_ptk').html('<option value="'+data_record.id_ptk_jdl+'">'+data_record.nuptk+' | '+data_record.nama_ptk+'</option>');
                      $('#form-input .select2').trigger('change.select2');
                    }
                    else{
                      $('.data-message').show();
                      $('.data-message .content-message').html('Maaf, anda tidak bisa mengedit data jadwal ini karena tahun akademik jadwal ini sudah tidak diterapkan!');
                    }
                  });
                }
              });
              $('#myModal .modal-title').text('Edit Data Jadwal Kuliah');
            }
            else if (vars == 'kelas') {
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{status:vars['kelas'],data:'status_jdl'},500);
              data.then(function(status_kelas){
                if (status_kelas.status_jdl == 1) {
                  $('#myModal #form-pindah-kelas').show();
                  $('#form-pindah-kelas .jumlah').html('Silahkan pilih kelas mahasiswa yang akan diperbahrui');
                }
                else{
                  $('#submit, #submit-again,#submit,#myModal #form-pindah-kelas').hide();
                  $('.data-message').show();
                  $('#batal').text('Tutup');
                  if (status_kelas.status_jdl == 0) {
                    $('.data-message .content-message').html('Maaf, anda tidak bisa memindahkan kelas mahasiswa saat ini!');
                  }
                  else{
                    $('.data-message .content-message').html('Maaf, kelas ini tidak terdaftar dalam database!');
                  }
                }
              });
              $('#myModal .modal-title').text('Edit Kelas Mahasiswa');
            }
            else if (vars == 'kls_mhs') {
                $('#myModal .modal-title').text('Edit Data Kelas');
                $('#myModal #form-input-kls-mhs, #form-input').hide();
                var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{status_kelas:getUrlVars()['kls_mhs'],data:'status_jdl'},1000);
                data.then(function(status_kelas){
                  if (status_kelas.status_jdl == 1) {
                    $('.modal .modal-body').append('<p class="load-data text-center">Memproses Data</p>');
                    var selectedItems = [];           
                    $(".check-mhs-kls:checked").each(function() {
                      selectedItems.push($(this).attr('data-search'));
                    });
                    var count = selectedItems.length;
                    if (count > 0 ) {
                      return getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mhs',check:'data_exists',kls_mhs:getUrlVars()['kls_mhs']});
                    }
                    else{
                      $('.data-message').show();
                      $('.data-message .content-message').html('Silahkan pilih mahasiswa yang ingin anda pindahkan!');
                      $('.modal .submit-btn, .modal .submit-again-btn').hide();
                      $('#myModal #batal').text('Tutup').prepend('<li class="fa fa-times"></li> ');
                    }
                  }
                  else{
                    $('.data-message').show();
                    if (status_kelas.status_jdl == 0) {
                      $('.data-message .content-message').html('Maaf, anda tidak bisa memindahkan mahasiswa ke kelas lain saat ini karena tahun akademik kelas ini sudah tidak diterapkan!');
                    }
                    else{
                      $('.data-message .content-message').html('Maaf, kelas ini tidak terdaftar dalam database!');
                    }
                  }
                })
                .then(function(daftar_mhs){
                  if (daftar_mhs != undefined) {
                    if (daftar_mhs.total_rows > 0 ) {
                      $('#myModal #submit').attr('id','pindah-kelas').text('Update').prepend('<li class="fa fa-pencil-square"></li> ');
                      $('#myModal #form-pindah-kelas').show();
                      $('#form-pindah-kelas .jumlah').html('Anda akan memindahkan&nbsp<b>'+daftar_mhs.data.length+' data</b>&nbspmahasiswa ke kelas lain!, silahkan pilih kelas yang dituju');
                      $('.list-selected').show().find('h5').text('Daftar data mahasiswa yang akan dipindah kelas:');
                      $('.list-selected .list-mhs-selected').find('tbody').text('');
                      var no = 1;
                      $.each(daftar_mhs.data, function(index,data_record){
                        $('.list-selected .list-mhs-selected').find('tbody').append(
                            '<tr>'
                            +'  <td class="text-center">'+no+'</td>'
                            +'  <td class="text-center">'+data_record.nim+'</td>'
                            +'  <td>'+data_record.nama+'</td>'
                            +'</tr>'   
                          );
                        no++;
                      });
                    }
                    else{
                      if (daftar_mhs.message != null && daftar_mhs.message != '') {
                        $('.data-message').show();
                        $('.data-message .content-message').addClass('centered-text').html(daftar_mhs.message);
                        $('.modal .submit-btn, .modal .submit-again-btn').hide();
                        $('#myModal #batal').text('Tutup').prepend('<li class="fa fa-times"></li> ');
                      }
                    }
                  }
                });
            }
          }
          else{
            $('#myModal').modal('hide');
          }
        }
        else if (path.search('admin/data_akademik/data_alumni_do') > 0) {
          $('#alumni,#mhs-do').hide();
          if (getUrlVars()['alumni'] != null && getUrlVars()['alumni'] != undefined) {
            $('#myModal .modal-title').text('Edit Data Alumni');
            var id_alumni = getUrlVars()['alumni'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_alumni:id_alumni,data:'check_mhs',check:'data_exists'},500);
            data.then(function(daftar_mhs){
              if (daftar_mhs.total_rows > 0) {
                $('#myModal #form-input,.list-selected').show();
                $('.list-selected').show().find('h5').text('Data alumni yang akan diedit:');
                $('.list-selected .list-mhs-selected').find('tbody').text('');
                var no = 1;
                $.each(daftar_mhs.data, function(index,data_record){
                  $('.list-selected .list-mhs-selected').find('tbody').append(
                      '<tr>'
                      +'  <td class="text-center">'+no+'</td>'
                      +'  <td class="text-center">'+data_record.nim+'</td>'
                      +'  <td>'+data_record.nama+'</td>'
                      +'</tr>'   
                    );
                  no++;
                });
                $.each(daftar_mhs.data[0], function(index, data_record){
                  if (data_record == '0000-00-00' || data_record=='') {
                    data_record = '';
                  }
                  $('#form-input .'+index).val(data_record);
                });
              }
            });
          }
          else if (getUrlVars()['mhs_do'] != null && getUrlVars()['mhs_do'] != undefined) {
            $('#myModal .modal-title').text('Edit Data Mahasiswa Drop Out');
            var id_mhs_do = getUrlVars()['mhs_do'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_mhs_do:id_mhs_do,data:'check_mhs',check:'data_exists'},500);
            data.then(function(daftar_mhs){
              if (daftar_mhs.total_rows > 0) {
                $('#myModal #form-input-mhs-do,.list-selected').show();
                $('.list-selected').show().find('h5').text('Data mahasiswa drop out yang akan diedit:');
                $('.list-selected .list-mhs-selected').find('tbody').text('');
                var no = 1;
                $.each(daftar_mhs.data, function(index,data_record){
                  $('.list-selected .list-mhs-selected').find('tbody').append(
                      '<tr>'
                      +'  <td class="text-center">'+no+'</td>'
                      +'  <td class="text-center">'+data_record.nim+'</td>'
                      +'  <td>'+data_record.nama+'</td>'
                      +'</tr>'   
                    );
                  no++;
                });
                $.each(daftar_mhs.data[0], function(index, data_record){
                  if (data_record == '0000-00-00' || data_record=='') {
                    data_record = '';
                  }
                  $('#form-input-mhs-do .'+index).val(data_record);
                });
              }
            });
          }
          else if (getUrlVars() == 'data-selected') {
            if ($('.select2_data').val() == 0) {
              $('#myModal .modal-title').text('Hapus Data Alumni');
              var data_edit = 'alumni';
              var data_check = 'alumni';
              var data_form = '#form-input';
            }
            else if ($('.select2_data').val() == 1) {
              $('#myModal .modal-title').text('Hapus Data Mahasiswa Drop Out');
              var data_edit = 'mahasiswa drop out';
              var data_check = 'mhs_do';
              var data_form = '#form-input-mhs-do';
            }
            $('.data-message').show().find('.content-message').text('');
            var selectedItems = [];           
            $(".check-mhs-dt:checked").each(function() {
              selectedItems.push($(this).val());
            });
            var count = selectedItems.length;          
            if (count > 0 ) {
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mhs',check:'data_exists',data_check:data_check},1000);
              data.then(function(daftar_mhs){
                if (daftar_mhs.total_rows > 0 ) {
                  $('#myModal '+data_form).show();
                  $('.list-selected').show().find('h5').text('Daftar data '+data_edit+' yang akan diedit:');
                  $('.data-message .content-message').addClass('centered-text').html('Anda akan mengedit&nbsp<strong>'+daftar_mhs.data.length+'&nbspdata</strong>&nbsp'+data_edit+' !');
                  $('.list-selected .list-mhs-selected').find('tbody').text('');
                  var no = 1;
                  $.each(daftar_mhs.data, function(index,data_record){
                    $('.list-selected .list-mhs-selected').find('tbody').append(
                        '<tr>'
                        +'  <td class="text-center">'+no+'</td>'
                        +'  <td class="text-center">'+data_record.nim+'</td>'
                        +'  <td>'+data_record.nama+'</td>'
                        +'</tr>'   
                      );
                    no++;
                  });
                }
              });
            }
            else{
              $('.data-message .content-message').addClass('centered-content').html('Silahkan pilih data '+data_edit+' yang ingin diedit!');
              $('#submit, #delete-selected').hide();
              $('#batal').text('Tutup');
            }
          }
          else{
            $('#myModal').modal('hide');
          }
        }
        else if (path.search('admin/pengaturan') > 0) {
          var url_vars = getUrlVars();
          if (url_vars['data'] == 'config') {
            $('#myModal .modal-title').text('Edit Konfigurasi Umum');
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{data:'data_konfigurasi',konfigurasi:'web_konfigurasi'},500);
            data.then(function(config){
              if (config.total_rows > 0) {
                $('#form-input').show();
                $.each(config.data, function(index, data_record){
                  $('#form-input .'+index).val(data_record);
                  $('#form-input select.'+index).trigger('change.select2');
                });
              }
            });
          }
          else if (url_vars['data'] != undefined && url_vars['data'] == 'template') {
            $('#myModal .modal-title').text('Edit Data Template');
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_template:url_vars['in_template'],data:'data_template'},500);
            data.then(function(detail_template){
              if (detail_template.total_rows > 0) {
                $('#form-input-template').show();
                $.each(detail_template.record_template[0], function(index, data_record){
                  $('#form-input-template .'+index).val(data_record);
                });
              }
            });
          }
          else if (url_vars['data'] != undefined && url_vars['data'] == 'menu') {
            $('#myModal .modal-title').text('Edit Data Menu');
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_menu:url_vars['in_menu'],data:'data_menu'},500);
            data.then(function(detail_menu){
              if (detail_menu.total_rows > 0) {
                $('#form-input-menu').show();
                $.each(detail_menu.record_menu[0], function(index, data_record){
                  $('#form-input-menu .'+index).val(data_record).focus().blur();
                  $('#form-input-menu select.'+index).trigger('change.select2');
                });
              }
            });
          }
          else if (url_vars['data'] != undefined && url_vars['data'] == 'sub-menu') {
            $('#myModal .modal-title').text('Edit Data Sub Menu');
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_menu:url_vars['in_menu'],data:'data_sub_menu'},500);
            data.then(function(detail_menu){
              if (detail_menu.total_rows > 0) {
                $('#form-input-sub-menu').show();
                $.each(detail_menu.record_menu[0], function(index, data_record){
                  $('#form-input-sub-menu .'+index).val(data_record).focus().blur();
                  $('#form-input-sub-menu select.'+index).trigger('change.select2');
                });
                if (detail_menu.record_menu[0]['in_menu'] != null) {
                  $('#form-input-sub-menu .select2_parent_menu').prepend('<option value="'+detail_menu.record_menu[0]['in_menu']+'">'+detail_menu.record_menu[0]['nm_menu']+'</option>');
                }
              }
            });
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
        $('.modal').addClass('modal-danger');
        modal_animated('zoomIn');
        if (path.search('admin/data_akademik/data_mahasiswa') > 0) {
          $('#rincian-siswa').hide();
          $('#form-pindah-kelas').hide();
          var id = getUrlVars()['mhs'];
          var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil_id',{id:id,data:'data_mhs'},500);
          data.then(function(detail_mhs){
            if (detail_mhs.total_rows > 0 ) {
              $.each(detail_mhs.record_mhs, function(index, data_record){
                  $('.data-message, #submit').show();
                  $('.data-message .content-message').removeClass('centered-content');
                  $('.data-message .content-message').html('Apakah anda yakin ingin menghapus data mahasiswa <strong>'+data_record.nama+'</strong> dengan NIM <strong>'+data_record.nisn+'</strong> ?');
                  $('#form-input .id').attr('value',data_record.id);
                });
            }
          });
          $('#myModal .modal-title').text('Hapus Data Mahasiswa');
        }
        else if (path.search('admin/data_akademik/data_ptk') > 0) {
          var vars_url = getUrlVars();
          if (vars_url['data'] == null) {
            var id = getUrlVars()['ptk'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil_id',{id_ptk:id,data:'data_ptk'},500);
            data.then(function(detail_ptk){
              if (detail_ptk.total_rows > 0 ) {
                $.each(detail_ptk.record_ptk, function(index, data_record){
                    $('.data-message').show();
                    $('.data-message .content-message').removeClass('centered-content');
                    $('.data-message .content-message').html('Apakah anda yakin ingin menghapus data tenaga pendidik dengan nama <strong>'+data_record.nama_ptk+'</strong> dan NIDN <strong>'+data_record.nuptk+'</strong> ?');
                    $('.id_ptk').attr('value',data_record.id_ptk);                
                  });            
              }
            });
            $('#myModal .modal-title').text('Hapus Data Tenaga Pendidik');
          }
          else if (vars_url['data'] == 'pend_ptk') {
            $('#form-input-studi-ptk .select2_ptk').text('');
            var id = getUrlVars()['studi_ptk'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_studi:id,data:'data_studi_ptk'},500);
            data.then(function(detail_ptk){
              if (detail_ptk.total_rows > 0 ) {
                $.each(detail_ptk.studi_ptk, function(index, data_record){
                    $('.data-message').show();
                    $('.data-message .content-message').removeClass('centered-content');
                    $('.data-message .content-message').html('Apakah anda yakin ingin menghapus data pendidikan (Perguruan tinggi <b>'+data_record.nama_pt_studi+'</b> studi <b>'+data_record.studi_ptk+' '+data_record.jenjang_studi_ptk+'</b> dengan gelar <b>'+data_record.gelar_ak_ptk+'</b>) tenaga pendidik dengan nama <strong>'+data_record.nama+'</strong> dan NIDN <strong>'+data_record.nidn+'</strong> ?');
                    $('#form-input-studi-ptk .select2_ptk').prepend('<option value="'+data_record.id_ptk_studi+'">'+data_record.nidn+' | '+data_record.nama+'</option>');
                    $('#form-input-studi-ptk .id_studi').val(data_record.id_studi);
                  });            
              }
            });
            $('#myModal .modal-title').text('Hapus Data Riwayat Pendidikan Tenaga Pendidik');
          }
          else if (vars_url['data'] == 'research_ptk') {
            $('#form-input-penelitian-ptk .select2_ptk').text('');
            var id = getUrlVars()['research_ptk'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_penelitian_ptk:id,data:'data_penelitian_ptk'},500);
            data.then(function(detail_ptk){
              if (detail_ptk.total_rows > 0 ) {
                $.each(detail_ptk.penelitian_ptk, function(index, data_record){
                    $('.data-message').show();
                    $('.data-message .content-message').removeClass('centered-content');
                    $('.data-message .content-message').html('Apakah anda yakin ingin menghapus data penelitian (Judul <b>'+data_record.judul_penelitian+'</b> dibidang <b>'+data_record.bidang_ilmu+'</b> pada lembaga <b>'+data_record.lembaga+'</b>) tenaga pendidik dengan nama <strong>'+data_record.nama+'</strong> dan NIDN <strong>'+data_record.nidn+'</strong> ?');
                    $('#form-input-penelitian-ptk .select2_ptk').prepend('<option value="'+data_record.id_ptk_rsch+'">'+data_record.nidn+' | '+data_record.nama+'</option>');
                    $('#form-input-penelitian-ptk .id_penelitian_ptk').val(data_record.id_penelitian_ptk);
                  });            
              }
            });
            $('#myModal .modal-title').text('Hapus Data Penelitian Tenaga Pendidik');
          }
        }
        else if (path.search('admin/data_akademik/data_mata_kuliah') > 0) {
          var id = getUrlVars()['mk'];
          var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil_id',{id_mk:id,data:'data_mk'},500);
          data.then(function(detail_mk){
            if (detail_mk.total_rows > 0 ) {            
              $.each(detail_mk.record_mk, function(index, data_record){
                if (data_record.jenis_jdl != 0) {
                  var konsentrasi = ' (Konsentrasi '+data_record.nm_konsentrasi+')';
                }
                else{
                  var konsentrasi = '';
                }
                $('.data-message').show();
                $('.data-message .content-message').removeClass('centered-content');
                $('.data-message .content-message').html('Apakah anda yakin ingin menghapus mata kuliah <strong>'+data_record.nama_mk+konsentrasi+'</strong> program studi <strong>'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</strong> ?');
                $('#form-input .id_mk').val(data_record.id_mk);
                $('#form-input .id_pd_mk').val(data_record.id_pd_mk).text(data_record.nama_prodi);
              });            
            }
          });
          $('#myModal .modal-title').text('Hapus Data Mata Kuliah');
        }
        else if (path.search('admin/data_akademik/data_jadwal_kuliah') > 0) {
          if ($('#box-jadwal, #box-kelas-mhs').is(':visible')) {
            if (getUrlVars()[0] == 'jadwal') {
              var id = getUrlVars()['jadwal'];
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil_id',{id_jdl:id,data:'data_jadwal_kuliah'},500);
              data.then(function(detail_jdl){
                if (detail_jdl.total_rows > 0 ) {
                  $.each(detail_jdl.record_jdl, function(index, data_record){
                    if (data_record.status_jdl == 1) {
                      var thn = data_record.thn_ajaran_jdl.split('/');
                      if (thn[1] == 1) {
                        var thn_ajaran = thn[0]+'/Ganjil';
                      }
                      else {
                        var thn_ajaran = thn[0]+'/Genap';
                      }
                      if (data_record.jenis_jdl != '0') {
                        var jenis_jdl = ' (Konsentrasi '+data_record.nm_konsentrasi+')';
                      }
                      else{
                        var jenis_jdl = '';
                      }
                      $('.data-message').show();
                      $('.data-message .content-message').removeClass('centered-content');
                      $('.data-message .content-message').html('Apakah anda yakin ingin menghapus jadwal mata kuliah <strong>'+data_record.nama_mk+''+jenis_jdl+'</strong> kelas <strong>'+data_record.semester+'/'+data_record.kelas+'</strong> pada program studi <strong>'+data_record.nama_prodi+'</strong> tahun akademik <strong>'+thn_ajaran+'</strong> ?');
                      $('#form-input .id_jdl').val(data_record.id_jdl+'/'+data_record.id_pd_mk+'/'+data_record.id_thn_ak_jdl);
                    }
                    else{
                      $('#myModal #submit').hide();
                      $('.data-message').show();
                      $('#batal').text('Tutup');
                      $('.data-message .content-message').addClass('centered-content').html('Maaf, anda tidak bisa menghapus data jadwal ini karena tahun akademik jadwal ini sudah tidak diterapkan!');
                    }
                  });            
                }
              });
              $('#myModal .modal-title').text('Hapus Data Jadwal Kuliah');
            }
            else if (getUrlVars()[0] == 'kelas') {
              var id = getUrlVars()['kelas'];
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil_id',{id_kls:id,data:'kelas_mhs'},500);
              data.then(function(detail_mhs){
                if (detail_mhs.total_rows > 0 ) {
                  $.each(detail_mhs.record_mhs, function(index, data_record){
                    if (data_record.status_jdl == 1) {
                      var thn = data_record.thn_ajaran_jdl.split('/');
                      if (thn[1] == 1) {
                        var thn_ajaran = thn[0]+'/Ganjil';
                      }
                      else {
                        var thn_ajaran = thn[0]+'/Genap';
                      }
                      if (data_record.jenis_jdl != '0') {
                        var jenis_jdl = ' (Konsentrasi '+data_record.nm_konsentrasi+')';
                      }
                      else{
                        var jenis_jdl = '';
                      }
                      $('.data-message').show();
                      $('.data-message .content-message').removeClass('centered-content');
                      $('.data-message .content-message').html('Apakah anda yakin ingin menghapus mahasiswa <strong>'+data_record.nama+'</strong> dengan NIM <strong>'+data_record.nisn+'</strong> dari daftar mahasiswa kelas <strong>'+data_record.semester+'/'+data_record.kelas+'</strong> mata kuliah <strong>'+data_record.nama_mk+''+jenis_jdl+'</strong> pada program studi <strong>'+data_record.nama_prodi+'</strong> tahun akademik <strong>'+thn_ajaran+'</strong> ?');
                      $('#form-input .id_jdl').val(data_record.id_kelas+'/'+data_record.id_jdl_kls);
                    }
                    else{
                      $('#myModal #submit').hide();
                      $('.data-message').show();
                      $('#batal').text('Tutup');
                      $('.data-message .content-message').html('Maaf, anda tidak bisa menghapus daftar mahasiswa dikelas ini karena tahun akademik jadwal ini sudah tidak diterapkan!');
                    }
                  });            
                }
              });
              $('#myModal .modal-title').text('Hapus Data Kelas');
            }
          }
          else{
            $('#myModal').modal('hide');
          }
        }
        else if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
          var urlvar = getUrlVars();
          if (urlvar[0] == 'fk') {
            var id = getUrlVars()['fk'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil_id',{id_fk:id,data:'data_fakultas'},500);
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
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil_id',{id_pd:id,data:'data_prodi'},500);
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
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:id,data:'data_konsentrasi_pd'},500);
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
        else if (path.search('admin/data_akademik/data_alumni_do') > 0) {
          if (getUrlVars()['alumni'] != null) {
            var id_alumni = getUrlVars()['alumni'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_alumni:id_alumni,data:'check_mhs',check:'data_exists',data_check:'alumni'},500);
            data.then(function(daftar_mhs){
              if (daftar_mhs.total_rows > 0) {
                $.each(daftar_mhs.data, function(index, data_record){
                  $('.data-message').show();
                  $('.data-message .content-message').removeClass('centered-content').html('Apakah anda yakin ingin menghapus data alumni <strong>'+data_record.nama+'</strong> dengan NIM <strong>'+data_record.nim+'</strong> ?');
                  $('.in_mhs').attr('value',data_record.in_data);
                });
              }
            });
            $('#myModal .modal-title').text('Hapus Data Alumni');
          }
          else if (getUrlVars()['mhs_do'] != null) {
            $('#myModal .modal-title').text('Edit Data Mahasiswa Drop Out');
            var id_mhs_do = getUrlVars()['mhs_do'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_mhs_do:id_mhs_do,data:'check_mhs',check:'data_exists',data_check:'mhs_do'},500);
            data.then(function(daftar_mhs){
              if (daftar_mhs.total_rows > 0) {
                $.each(daftar_mhs.data, function(index, data_record){
                  $('.data-message').show();
                  $('.data-message .content-message').removeClass('centered-content').html('Apakah anda yakin ingin menghapus data mahasiswa drop out <strong>'+data_record.nama+'</strong> dengan NIM <strong>'+data_record.nim+'</strong> ?');
                  $('.in_mhs').attr('value',data_record.in_data);
                });
              }
            });
          }
          else{
            $('#myModal').modal('hide');
          }
        }
        else if (path.search('admin/pengaturan') > 0) {
          var url_vars = getUrlVars();
          if (url_vars['data'] != undefined && url_vars['data'] == 'template') {
            $('#myModal .modal-title').text('Hapus Data Template');
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_template:url_vars['in_template'],data:'data_template'},500);
            data.then(function(detail_template){
              if (detail_template.total_rows > 0) {
                $.each(detail_template.record_template, function(index, data_record){
                  $('.data-message, #submit').show();
                  $('.data-message .content-message').removeClass('centered-content');
                  $('.data-message .content-message').html('Apakah anda yakin ingin menghapus template <strong style="">'+data_record.template_name+'</strong> versi <strong>'+data_record.template_version+'</strong> ?');
                  $('#form-input-template .template_id').attr('value',data_record.template_id);
                });
              }
            });
          }
          else if (url_vars['data'] != undefined && url_vars['data'] == 'menu') {
            $('#myModal .modal-title').text('Hapus Data Menu');
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_menu:url_vars['in_menu'],data:'data_menu'},500);
            data.then(function(detail_menu){
              if (detail_menu.total_rows > 0) {
                $.each(detail_menu.record_menu, function(index, data_record){
                  $('.data-message, #submit').show();
                  $('.data-message .content-message').removeClass('centered-content');
                  $('.data-message .content-message').html('Apakah anda yakin ingin menghapus menu <strong style=""><span class="'+data_record.icon_menu+'"></span> '+data_record.nm_menu+'</strong>, Level Akses Menu <strong>'+data_record.level_access_menu+'</strong> ?');
                  $('#form-input-menu .id_menu').attr('value',data_record.id_menu);
                });
              }
            });
          }
          else if (url_vars['data'] != undefined && url_vars['data'] == 'sub-menu') {
            $('#myModal .modal-title').text('Hapus Data Sub Menu');
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_menu:url_vars['in_menu'],data:'data_sub_menu'},500);
            data.then(function(detail_menu){
              if (detail_menu.total_rows > 0) {
                $.each(detail_menu.record_menu, function(index, data_record){
                  $('.data-message, #submit').show();
                  $('.data-message .content-message').removeClass('centered-content');
                  $('.data-message .content-message').html('Apakah anda yakin ingin menghapus sub menu <strong>'+data_record.nm_sub_menu+'</strong>, Parent Menu <strong>'+data_record.nm_menu+'</strong> ?');
                  $('#form-input-sub-menu .id_sub_menu').attr('value',data_record.id_sub_menu);
                });
              }
            });
          }
        }
        else{
          $('#myModal').modal('hide');
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
        $('.modal').addClass('modal-danger');
        $('#myModal').modal('show');
        $('.data-message').show().find('.content-message').text('');
        modal_animated('zoomIn');
        if (path.search('admin/data_akademik/data_mahasiswa') > 0) {
          $('#form-pindah-kelas').hide();
          $('#rincian-siswa').hide();          
          $('#myModal .modal-title').text('Hapus Data Mahasiswa');
          var selectedItems = [];           
          $(".check-siswa:checked").each(function() {
            selectedItems.push($(this).val());
          });       
          var count = selectedItems.length;          
          if (count > 0 ) {
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mhs',check:'data_exists'},1000);
            data.then(function(daftar_mhs){
              if (daftar_mhs.total_rows > 0 ) {
                $('.list-selected').show().find('h5').text('Daftar data mahasiswa yang akan dihapus:');
                $('.data-message .content-message').addClass('centered-text');
                $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+daftar_mhs.data.length+'&nbspdata</strong>&nbspmahasiswa ?');
                $('.list-selected .list-mhs-selected').find('tbody').text('');
                var no = 1;
                $.each(daftar_mhs.data, function(index,data_record){
                  $('.list-selected .list-mhs-selected').find('tbody').append(
                      '<tr>'
                      +'  <td class="text-center">'+no+'</td>'
                      +'  <td class="text-center">'+data_record.nim+'</td>'
                      +'  <td>'+data_record.nama+'</td>'
                      +'</tr>'   
                    );
                  no++;
                });
              }
              else{
                $('.data-message .content-message').addClass('centered-content');
                $('.data-message .content-message').html(daftar_mhs.message);
                $('#submit, #delete-selected').hide();
                $('#batal').text('Tutup');
              }
            });
          }
          else{
            $('.data-message .content-message').addClass('centered-content');
            $('.data-message .content-message').html('Silahkan pilih data mahasiswa yang ingin dihapus!');
            $('#submit, #delete-selected').hide();
            $('#batal').text('Tutup');
          }
        }
        else if (path.search('admin/data_akademik/data_ptk') > 0) {
          $('.data-message').show();
          $('#rincian-guru').hide();
          $('#myModal .modal-title').text('Hapus Data PTK');
          var selectedItems = [];           
          $(".check-guru:checked").each(function() {
            selectedItems.push($(this).val());
          });       
          var count = selectedItems.length;          
          if (count > 0 ) {
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_ptk',check:'data_exists'},1000);
            data.then(function(daftar_ptk){
              if (daftar_ptk.total_rows > 0 ) {
                $('.list-selected').show().find('h5').text('Daftar data tenaga pendidik yang akan dihapus:');
                $('.data-message .content-message').addClass('centered-text');
                $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+daftar_ptk.data.length+'&nbspdata</strong>&nbsptenaga pendidik ?');
                $('.list-selected .list-ptk-selected').find('tbody').text('');
                var no = 1;
                $.each(daftar_ptk.data, function(index,data_record){
                  $('.list-selected .list-ptk-selected').find('tbody').append(
                      '<tr>'
                      +'  <td class="text-center">'+no+'</td>'
                      +'  <td class="text-center">'+data_record.nidn+'</td>'
                      +'  <td>'+data_record.nama+'</td>'
                      +'</tr>'   
                    );
                  no++;
                });
              }
              else{
                $('.data-message .content-message').addClass('centered-content');
                $('.data-message .content-message').html('Tenaga Pendidik yang anda pilih tidak ada didalam database atau sudah terhapus!');
                $('#submit, #delete-selected').hide();
                $('#batal').text('Tutup');
              }
            });
          }
          else{
            $('.data-message .content-message').addClass('centered-content');
            $('.data-message .content-message').html('Silahkan pilih data tenaga pendidik yang ingin dihapus!');
            $('#submit, #delete-selected').hide();
            $('#batal').text('Tutup');
          }
        }
        else if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
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
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_data_master',check:check},1000);
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
        else if (path.search('admin/data_akademik/data_mata_kuliah') > 0) {
          $('.data-message').show();          
          $('#myModal .modal-title').text('Hapus Data Mata Kuliah');
          var selectedItems = [];           
          $(".check-mk:checked").each(function() {
            selectedItems.push($(this).val());
          });       
          var count = selectedItems.length;
          if (count > 0 ) {
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mk',check:'data_exists'},1000);
            data.then(function(daftar_mk){
              if (daftar_mk.total_rows > 0 ) {
                $('.list-selected').show().find('h5').text('Daftar data mata kuliah yang akan dihapus:');
                $('#myModal #submit').attr('id','delete-selected');
                $('.data-message .content-message').addClass('centered-text');
                $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+daftar_mk.data.length+'&nbspdata</strong>&nbspmata kuliah ?');
                $('.list-selected .list-mhs-selected').find('tbody').text('');
                var no = 1;
                $.each(daftar_mk.data, function(index,data_record){
                  if (data_record.jenis_jdl != 0) {
                    var konsentrasi = ' <b>(Konsentrasi '+data_record.nm_konsentrasi+')</b>';
                  }
                  else{
                    var konsentrasi = '';
                  }
                  $('.list-selected .list-mhs-selected').find('tbody').append(
                      '<tr>'
                      +'  <td class="text-center">'+no+'</td>'
                      +'  <td class="text-center">'+data_record.kode_mk+'</td>'
                      +'  <td>'+data_record.nama_mk+''+konsentrasi+'</td>'
                      +'</tr>'   
                    );
                  no++;
                });
              }
            });
          }
          else{
            $('.data-message .content-message').addClass('centered-content');
            $('.data-message .content-message').html('Silahkan pilih data mata kuliah yang ingin dihapus!');
            $('#submit, #delete-selected').hide();
            $('#batal').text('Tutup');
          }
        }
        else if (path.search('admin/data_akademik/data_jadwal_kuliah') > 0) {
          if ($('#box-jadwal').is(':visible') || $('#box-kelas-mhs').is(':visible')) {
            var urlvar = getUrlVars();
            $('.data-message').show();
            if (urlvar['data'] == 'jadwal') {
              $('#myModal #form-input-kls-mhs').hide();
              $('#myModal .modal-title').text('Hapus Data Jadwal Kuliah');
              var selectedItems = [];           
              $(".check-jadwal:checked").each(function() {
                selectedItems.push($(this).val());
              });
              var count = selectedItems.length;
              if (count > 0 ) {
                var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_jadwal',check:'data_exists'},1000);
                data.then(function(data_jadwal){
                  if (data_jadwal.total_rows > 0) {
                    $('.data-message .content-message').addClass('centered-text').removeClass('centered-content');
                    $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+data_jadwal.total_rows+'&nbspdata</strong>&nbspjadwal kuliah ?');
                  }
                });
              }
              else{
                $('.data-message .content-message').addClass('centered-content');
                $('#submit, #delete-selected').hide();
                $('.data-message .content-message').html('Silahkan pilih jadwal kuliah yang ingin dihapus!');
              }
            }
            else if (urlvar['data'] == 'kls_mhs') {
              $('#myModal #form-input-kls-mhs').hide();
              $('#myModal .modal-title').text('Hapus Data Kelas');
              var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{status_kelas:getUrlVars()['kls_mhs'],data:'status_jdl'},1000);
              data.then(function(status_kelas){
                if (status_kelas.status_jdl == 1) {
                  $('.modal .modal-body').append('<p class="load-data text-center">Memproses Data</p>');
                  var selectedItems = [];           
                  $(".check-mhs-kls:checked").each(function() {
                    selectedItems.push($(this).attr('data-search'));
                  });
                  var count = selectedItems.length;
                  if (count > 0 ) {
                    return getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mhs',check:'data_exists',kls_mhs:getUrlVars()['kls_mhs']});
                  }
                  else{
                    $('.data-message .content-message').addClass('centered-content');
                    $('#submit, #delete-selected').hide();
                    $('#batal').text('Tutup');
                    $('.data-message .content-message').html('Silahkan pilih mahasiswa yang ingin dihapus dari kelas ini!');
                  }
                }
                else{
                  $('#submit, #submit-again').hide();
                  $('.data-message').show();
                  $('#batal').text('Tutup');
                  if (status_kelas.status_jdl == 0) {
                    $('.data-message .content-message').html('Maaf, anda tidak bisa menghapus mahasiswa dari kelas ini karena tahun akademik kelas ini sudah tidak diterapkan!');
                  }
                  else{
                    $('.data-message .content-message').html('Maaf, kelas ini tidak terdaftar dalam database!');
                  }
                }
              })
              .then(function(daftar_mhs){
                if (daftar_mhs != undefined) {
                  if (daftar_mhs.total_rows > 0 ) {
                    $('#myModal #submit').attr('id','delete-selected');
                    $('.data-message .content-message').addClass('centered-text').removeClass('centered-content');
                    $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+daftar_mhs.data.length+'&nbspdata</strong>&nbspmahasiswa dari kelas ini ?');
                    $('.list-selected').show().find('h5').text('Daftar data mahasiswa yang akan hapus dari kelas ini:');
                    $('.list-selected .list-mhs-selected').find('tbody').text('');
                    var no = 1;
                    $.each(daftar_mhs.data, function(index,data_record){
                      $('.list-selected .list-mhs-selected').find('tbody').append(
                          '<tr>'
                          +'  <td class="text-center">'+no+'</td>'
                          +'  <td class="text-center">'+data_record.nim+'</td>'
                          +'  <td>'+data_record.nama+'</td>'
                          +'</tr>'   
                        );
                      no++;
                    });
                  }
                  else{
                    if (daftar_mhs.message != null && daftar_mhs.message != '') {
                      $('.data-message').show();
                      $('.data-message .content-message').addClass('centered-text').html(daftar_mhs.message);
                      $('.modal .submit-btn, .modal .submit-again-btn').hide();
                      $('#myModal #batal').text('Tutup').prepend('<li class="fa fa-times"></li> ');
                    }
                  }
                }
              });;
            }
          }
          else{
            $('#myModal').modal('hide');
          }
        }
        else if (path.search('admin/data_akademik/data_alumni_do') > 0) {
          if ($('.select2_data').val() == 0) {
            $('#myModal .modal-title').text('Hapus Data Alumni');
            var data_delete = 'alumni';
            var data_check = 'alumni';
          }
          else if ($('.select2_data').val() == 1) {
            $('#myModal .modal-title').text('Hapus Data Mahasiswa Drop Out');
            var data_delete = 'mahasiswa drop out';
            var data_check = 'mhs_do';
          }
          $('.data-message').show();
          var selectedItems = [];           
          $(".check-mhs-dt:checked").each(function() {
            selectedItems.push($(this).val());
          });
          var count = selectedItems.length;          
          if (count > 0 ) {
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mhs',check:'data_exists',data_check:data_check},1000);
            data.then(function(daftar_mhs){
              if (daftar_mhs.total_rows > 0 ) {
                $('.list-selected').show().find('h5').text('Daftar data '+data_delete+' yang akan dihapus:');
                $('#myModal #submit').attr('id','delete-selected');
                $('.data-message .content-message').addClass('centered-text');
                $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+daftar_mhs.data.length+'&nbspdata</strong>&nbsp'+data_delete+' ?');
                $('.list-selected .list-mhs-selected').find('tbody').text('');
                var no = 1;
                $.each(daftar_mhs.data, function(index,data_record){
                  $('.list-selected .list-mhs-selected').find('tbody').append(
                      '<tr>'
                      +'  <td class="text-center">'+no+'</td>'
                      +'  <td class="text-center">'+data_record.nim+'</td>'
                      +'  <td>'+data_record.nama+'</td>'
                      +'</tr>'   
                    );
                  no++;
                });
              }
              else{
                $('.data-message .content-message').addClass('centered-content');
                $('.data-message .content-message').html(daftar_mhs.message);
                $('#submit, #delete-selected').hide();
                $('#batal').text('Tutup');
              }
            });
          }
          else{
            $('.data-message .content-message').addClass('centered-content');
            $('.data-message .content-message').html('Silahkan pilih data '+data_delete+' yang ingin dihapus!');
            $('#submit, #delete-selected').hide();
            $('#batal').text('Tutup');
          }
        }
        else{
          $('#myModal').modal('hide');
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
        modal_animated('zoomIn');
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
          var detail_mhs = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:id_data_akademik_u,data:'data_mhs'},500,true);
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
          var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_ptk:id_data_akademik_u,data:'data_ptk'},500,true);
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
            $('#myModal').modal('show');
            $('.modal').addClass('modal-warning');
            var id = getUrlVars()['id_user'];
            var level = getUrlVars()['level'];
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/dashboard/data_statistik/pengguna',{id:id,level:level},500);
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

      else if(hash.search('data')==0){
        modal_animated('zoomIn');
        if (path.search('admin/data_master/data_thn_akademik') > 0) {
          var thn_akademik = getUrlVars()['i'],
          data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{thn_ak:thn_akademik,data:'check_thn_ak'},500);
          $('.detail-data-thn-ak[data-search='+thn_akademik+']').find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
          data.then(function(check_thn_ak){
            $('.detail-data-thn-ak').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
            if (check_thn_ak.status == 'success') {
              var data = 'thn_akademik',
              title = 'Data Mahasiswa Tahun Akademik '+check_thn_ak.thn_akademik;
              $('#box-mhs .box-title').text(title);
              Pace.restart();
              $.fn.dataTable.ext.errMode='none';
              data_mhs_master(data,thn_akademik);
              $(document).bind('ajaxError', function(){
                swal({
                  title:'Error',
                  text: 'Maaf, telah terjadi error pada server!',
                  type:'error',
                  timer: 2000
                });
              });
              $('.static-mhs-tab').attr('href','#static-'+thn_akademik);
              $('.static-tab').attr('id','static-'+thn_akademik);
              $('.static-tab').removeClass('active');
              $('.static-mhs-tab').parents('li').removeClass('active');
              $('.static-mhs-tab').attr('aria-expanded','false');
              $('#daftar-mhs-thn-ak, .tab-daftar-mhs-thn-ak').addClass('active');
              $('.tab-daftar-mhs-thn-ak').find('a').attr('aria-expanded','true');
            }
            else{
              swal({
                title:'Info',
                text: 'Tahun akademik yang anda pilih tidak terdaftar dalam database!',
                type:'info',
                timer: 2000
              });
            }
          }).catch(function(){
            $('.detail-data-thn-ak').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
          });
        }
        else if (path.search('admin/data_master/data_angkatan') > 0) {
          var angkatan = getUrlVars()['mhs'],
          data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{thn_ak:angkatan,data:'check_thn_angkatan'},500);
          $('.detail-data-thn-mhs[data-search='+angkatan+']').find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
          data.then(function(check_thn_ak){
            $('.detail-data-thn-mhs').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
            if (check_thn_ak.status == 'success') {
              var data = 'thn_angkatan';
              var title = 'Data Mahasiswa Tahun Angkatan '+check_thn_ak.thn_angkatan;
              $('#box-mhs .box-title').text(title);
              Pace.restart();
              $.fn.dataTable.ext.errMode='none';
              data_mhs_master(data,angkatan);
              $(document).bind('ajaxError', function(){
                swal({
                  title:'Error',
                  text: 'Maaf, telah terjadi error pada server!',
                  type:'error',
                  timer: 2000
                });
              });
              $('.static-mhs-tab').attr('href','#static-'+angkatan);
              $('.static-tab').attr('id','static-'+angkatan);
              $('.static-tab').removeClass('active');
              $('.static-mhs-tab').parents('li').removeClass('active');
              $('.static-mhs-tab').attr('aria-expanded','false');
              $('#daftar-mhs-thn-ak, .tab-daftar-mhs-thn-ak').addClass('active');
              $('.tab-daftar-mhs-thn-ak').find('a').attr('aria-expanded','true');
            }
            else{
              swal({
                title:'Info',
                text: 'Tahun angkatan yang anda pilih tidak terdaftar dalam database!',
                type:'info',
                timer: 2000
              });
            }
          }).catch(function(){
            $('.detail-data-thn-mhs').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
          });
        }
        else if (path.search('admin/data_master/data_fakultas_pstudi') > 0) {
          if (getUrlVars()[0] == 'fk') {
            var id = getUrlVars()['i'];
            $('.close-dt-pd-bt').fadeOut();
            $('.detail-prodi').fadeOut().removeClass('active').find('a').attr('aria-expanded','false');
            $('#detail-prodi').removeClass('active');
            $('.daftar-prodi').addClass('active').find('a').attr('aria-expanded','true');
            $('#daftar-prodi').addClass('active');
            data_detail_fk(id);
          }
          else if (getUrlVars()[0] == 'pd') {
            if ($('#box-detail-fk').is(':visible')) {
              var id = getUrlVars()['pd'],
              id_fk,
              data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_pd:id,data:'data_prodi'},null,true);
              $('.data-detail-prodi[data-search='+id+']').find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
              data.then(function(detail_prodi){
                $('.data-detail-prodi').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
                if (detail_prodi.data != '') {
                  collapse_box('#detail-prodi .box');
                  $.each(detail_prodi.data, function(index, data_record){
                    id_fk = data_record.id_fk;
                    $('.detail-prodi').find('a').html('<span class="fa fa-list"></span> Detail Prodi '+data_record.nama_prodi);
                    $.each(data_record, function(index, data_record){
                      if (data_record == '' || data_record == '0000-00-00' || data_record == '0') {
                        data_record = '-';
                        $('#detail-prodi span.'+index).text(data_record);
                      }
                      else{
                        $('#detail-prodi span.'+index).text(data_record+' Orang');
                      }
                      $('#detail-prodi dd.'+index).text(data_record);
                    });
                  });
                  if ($('#box-detail-fk').is(':hidden')) {
                    data_detail_fk(id_fk);
                  }
                  $('.detail-prodi, .close-dt-pd-bt').fadeIn();
                  daftar_konsentrasi(null,id);
                }
                else{
                  window.history.pushState(null,null,path);
                  swal({
                    title:'Info',
                    text: 'Program Studi yang anda pilih tidak ada didalam database!',
                    type:'info',
                    timer: 2000
                  });
                }
              }).catch(function(){
                $('.data-detail-prodi').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
                window.history.pushState(null,null,path);
              });
            }
            else{
              window.history.pushState(null,null,path);
            }
          }
        }
        else if (path.search('admin/data_akademik/data_alumni_do') > 0) {
          $('#myModal').modal('show');
          $('#myModal .modal-dialog').addClass('modal-lg');
          if($(window).width() >= 1243){
            $('.modal-lg').css('width','1200px');
          }
          else if($(window).width() >= 1030){
            $('.modal-lg').css('width','1000px');
          }
          $('.modal').addClass('modal-warning');
          $('form,.submit-btn,.submit-again-btn').hide();
          $('#myModal .data-statistik-mhs').hide();
          $('#batal').text('Tutup');
          $('#myModal .modal-title').text('Data Statistik');

          setTimeout(function(){
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/data_statistik/alumni',null,500);
            data.then(function(detail_mhs){
              $('#myModal .data-statistik-mhs').show();
              if ($('#statistik-alumni').is(':visible')) {
                var chart = '#barchart-alumni',
                replace_chart = '<canvas id="barchart-alumni" class="chart" style="height: 300px; width: 510px;"></canvas>',
                detail_static = '.detail-jml-alumni';
              }
              else if ($('#statistik-mhs-do').is(':visible')) {
                var chart = '#barchart-mhs-do',
                replace_chart = '<canvas id="barchart-mhs-do" class="chart" style="height: 300px; width: 510px;"></canvas>',
                detail_static = '.detail-jml-mhs-do';
              }

              $(chart).replaceWith(replace_chart);
              line_chart_alumni_do(detail_mhs.nama_prodi,detail_mhs.mhs_lk,detail_mhs.mhs_pr,detail_mhs.color,chart);
              $(detail_static).text('');
              $(detail_static).prepend('<p class="text-center"><strong>Keterangan</strong></p>');
              var no = 1;
              $.each(detail_mhs.pd, function(index,data_record){
                $(detail_static).append(
                  '<div class="progress-group">'
                  +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> Prodi '+no+': '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</span>'
                  +'  <span class="progress-number">'+data_record.statik_mhs+'%</span>'
                  +'  <div class="progress sm">'
                  +'    <div class="progress-bar p-bar-'+no+'" style="background-color:'+data_record.color_detail+';"></div>'
                  +'  </div>'
                  +'</div>'
                );
                no++;
              });
              no = 1;
              delay(function(){
                $.each(detail_mhs.pd, function(index,data_record){
                  $(detail_static+' .p-bar-'+no).css('width',data_record.statik_mhs+'%');
                  no++;
                });
              },100);
            });
          },200);
        }
      }

      else if (hash.search('pindah_prodi')==0) {
        $('#myModal form, #submit-again').hide();
        $('.modal').addClass('modal-success');        
        modal_animated('zoomIn');
        $('#myModal').modal('show');
        if (path.search('admin/data_akademik/data_mahasiswa') > 0) {
          $('#rincian-siswa').hide();
          $('#myModal .modal-title').text('Update Program Studi Mahasiswa');
          var selectedItems = [];           
          $(".check-siswa:checked").each(function() {
            selectedItems.push($(this).val());
          });       
          var count = selectedItems.length;          
          if (count > 0 ) {
            var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:selectedItems,data:'check_mhs',check:'data_exists'},1000);
            data.then(function(daftar_mhs){
              if (hash.search('pindah_prodi')==0) {
                if (daftar_mhs.total_rows > 0 ) {
                  $('#form-pindah-kelas').show();
                  $('#form-pindah-kelas .jumlah').html('Anda akan memindahkan&nbsp<strong>'+daftar_mhs.data.length+'&nbspdata</strong>&nbspmahasiswa ke program studi<br>');
                  $('.list-selected').show().find('h5').text('Daftar Mahasiswa yang akan diperbahrui program studinya:');
                  $('.list-selected .list-mhs-selected').find('tbody').text('');
                  var no = 1;
                  $.each(daftar_mhs.data, function(index,data_record){
                    $('.list-selected .list-mhs-selected').find('tbody').append(
                        '<tr>'
                        +'  <td class="text-center">'+no+'</td>'
                        +'  <td class="text-center">'+data_record.nim+'</td>'
                        +'  <td>'+data_record.nama+'</td>'
                        +'</tr>'   
                      );
                    no++;
                  });
                }
                else{
                  $('.data-message').show();
                  $('.data-message .content-message').addClass('centered-content');
                  $('.data-message .content-message').html(daftar_mhs.message);
                  $('#submit, #delete-selected').hide();
                  $('#batal').text('Tutup');
                }
              }
              else{
                load_state = true;
              }
            });
          }
          else{
            $('.data-message').show();
            $('.data-message .content-message').addClass('centered-content');
            $('.data-message .content-message').html('Silahkan pilih data mahasiswa yang ingin dirubah program studinya!');
            $('#submit, #pindah-kelas').hide();
            $('#batal').text('Tutup');
          }
        }
        else{
          $('#myModal').modal('hide');
        }

        if (data != undefined) {
          data.then(function(){
            if (load_state == true && load_state != false) {
              load_state = false;
              $('#myModal .submit-btn').attr('id','submit');
              $('.modal .modal-body').append('<p class="load-data text-center">Memproses Data</p>');
              $('#myModal form, #myModal .submit-btn, #myModal .list-selected').hide();
              load_inval();
            }
            else{
              $('#myModal #submit').attr('id','pindah-kelas').html('<li class="fa fa-pencil-square"></li> Update Program Studi').show().css('pointer-events','');
            }
          }).catch(function(error){
            $('#myModal .submit-btn').hide().css('pointer-events','none');
            $('.data-message').show();
            $('.data-message .content-message').addClass('centered-text');
            $('.data-message .content-message').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
          });
        }
        else{
          $('#myModal .submit-btn').hide().css('pointer-events','none');
          $('.modal .load-data').remove();
        }
      }

      else if (hash.search('backup') == 0) {
        modal_animated('zoomIn');
        $('#myModal form, #myModal .list-selected, #myModal .data-message').hide();
        $('#myModal').modal('show');
        $('.modal').addClass('modal-info');
        $('#myModal #form-input').attr('action','backup');
        if (path.search('admin/pengaturan') > 0) {
          var backup_dt = getUrlVars()['dt'];
          if (backup_dt == 'database') {
            $('.modal .load-data').remove();
            $('#myModal form[form-data=backup-db]').show();
            $('#myModal .submit').attr('id','backup_db').text('Backup Database').prepend('<li class="fa fa-download"></li> ').show();
            $('#myModal #batal').text('Batal');
            $('#myModal .modal-title').text('Backup Database');
            $('#myModal').removeClass('modal-warning modal-success modal-default').addClass('modal-info');
          }
          else if (backup_dt == 'table_db') {
            $('.modal .load-data').remove();
            $('#myModal').modal('show');
            $('#myModal form[form-data=backup-db]').show();
            $('#myModal .modal-title').text('Backup Table Database');
            $('#myModal .submit').attr('id','backup_db_tbl').text('Backup Tabel').prepend('<li class="fa fa-download"></li> ').show();
            $('#myModal #batal').text('Batal');
            $('#myModal').removeClass('modal-warning modal-success modal-default').addClass('modal-info');
          }
        }
      }

      else if (hash.search('set') == 0 && path == controller_path+'/pengaturan') {
        var selected_set = $('.set-section[settings-section='+hash.split('set=')[1]+']'),
        setting_box = selected_set.attr('settings-box'),
        collapse_filter = selected_set.attr('collapse-filter');
        collapse_box(setting_box,collapse_filter);
        $('ul.sidebar-menu ul.treeview-menu li').removeClass('active');
        $('ul.sidebar-menu ul.treeview-menu li:has(a[href="#'+hash+'"])').addClass('active');
        for (var i = 1; i <= 6; i++) {
          selected_set.find('.setting-label').fadeToggle();
        }
        setTimeout(function(){
          $('html, body').animate({scrollTop:selected_set.offset().top - 55},800);
        },500);
      }

      $('#myModal #batal').prepend('<li class="fa fa-times"></li> ');

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
      $('.modal').removeClass('modal-info');
      $('.modal').removeClass('modal-success');
      $('.modal').removeClass('modal-danger');
      $('.modal').removeClass('modal-primary');
      $('.modal').removeClass('modal-warning');
      $('#myModal').find('input[type=text],input[type=hidden],input[type=number],input[type=email],input[type=password],textarea').val('');
      $('#barchart-alumni').replaceWith('<canvas id="barchart-alumni" class="chart" style="height: 280px; width: 510px;"></canvas>');
      $('#barchart-mhs-do').replaceWith('<canvas id="barchart-mhs-do" class="chart" style="height: 280px; width: 510px;"></canvas>');
      $('#myModal input[type="radio"]').iCheck('uncheck');
      $('#myModal select.select2_thn_angkatan, #myModal select#select2_wali_kelas').text('');
      $('#myModal .timepicker').val('14:08');
      $('#myModal .select2').val(null).trigger('change');
      $('#myModal .select2-remote-dt').text('');
      $('#myModal .select2').prop('disabled',false);
      $("#myModal").find('.has-error').removeClass('has-error');
      $('#alert-place').text('');
      $('#myModal .close-tab, #myModal .close-dt-tab').removeClass('active');
      $('#myModal .close-tab').find('a').attr('aria-expanded','false');
      $('#myModal .open-tab, #myModal .open-dt-tab').addClass('active');
      $('#myModal .open-tab').find('a').attr('aria-expanded','true');
      $('#myModal .modal-dialog').removeClass('modal-lg').removeAttr('style');
      $('#myModal .data-message').hide();
      $('#myModal .data-message .content-message').addClass('centered-content').removeClass('centered-text');
      $('#myModal .data-message .content-message').html('Maaf, data yang anda cari tidak ditemukan');
      $('#myModal dl dd').text('');
      $('#detail-rt-rw').append("<font id='detail-rt'></font>/<font id='detail-rw'></font>");
      $('#myModal dl dd#password').html(
        "<div class='pass password-cry pull-left'></div>"
        +"<div class='password pull-left' id='detail-uncrypt_password'></div>"
        +"<div class='pull-right show-password' title='Tampilkan password'><span class='glyphicon glyphicon-eye-close'></span><div>"
        );
      $('#myModal .file-select-foto').fileinput('clear');
      $('#myModal .file-select-foto').parents().find('.fileinput-remove-button').hide();
    });
    $('#myModal-pt').on('hidden.bs.modal', function(e){
      modal_animated('zoomOutDown');
      $('#myModal-pt input').val('');
      $("#myModal-pt").find('.has-error').removeClass('has-error');
      $('#alert-place').text('');
      $('#myModal-pt .close-tab, #myModal-pt .close-dt-tab').removeClass('active');
      $('#myModal-pt .close-tab').find('a').attr('aria-expanded','false');
      $('#myModal-pt .open-tab, #myModal-pt .open-dt-tab').addClass('active');
      $('#myModal-pt .open-tab').find('a').attr('aria-expanded','true');
    });
    /*$('#myModal').on('show.bs.modal',function(e){
      $('.modal-body').LoadingOverlay("show",{
        color: "rgba(255, 255, 255, 2)",
        fade: [500,1000],
        zIndex: 2000,    
        image:image_overlay_path,
        custom:$("<div>",{
          css:{
            "margin-top":"50px",
            "font-weight":"bold"
          },
          text:"Memuat...",
        }),
      });
      setTimeout(function(){
        $('.modal-body').LoadingOverlay("hide");
      },2000);
    });*/
    $('#myModal, #myModal-pt').on('hide.bs.modal', function(e){
      modal_animated('zoomOutDown');
      $('#myModal .overflow-tab, #myModal .content-responsive, #myModal-pt .overflow-tab').scrollTop(0);
      $('.modal .tab-pane, .tab-overflow-container').scrollTop(0);
      $('.modal .slimScrollDiv').find('.slimScrollBar').css('top','0px');
    });
    $('.modal .nav-tabs li a').on('shown.bs.tab', function(){
      $('.modal .tab-pane').scrollTop(0);
    });
    /*END -- Modal Event*/

    /*Onclick Event*/
    $('#refresh-form, .refresh-form').on('click', function(eve){
      eve.preventDefault();
      $('.modal').find('input[type=text],input[type=number],input[type=email]').val('');
      $('.modal input[type="radio"]').iCheck('uncheck');            
      $('.modal form .select2').val(null).trigger('change');
      $(".modal").find('.has-error').removeClass('has-error');
      $('.modal #alert-place').text('');
    });

    $('.refresh-data').on('click', function(eve){
      eve.preventDefault();
      Pace.restart();
      var box_selected = $(this).attr('data-refresh'),
      box_show = $(this).attr('data-box'),
      btn_act = $(this).find('i');
      btn_act.addClass('fa-spin');
      $(box_show).find('div.overlay').fadeIn();
      collapse_box(box_show);
      if (box_selected == 'data-alumni-do') {
        if ($('.select2_data').val() == 0 || $('.select2_data').val() == 1) {
          $('.check-all-mhs-dt').iCheck('uncheck');
          $('.tbl-data-alumni-do').DataTable().ajax.reload();
        }
      }
      else if (box_selected == 'statistik-alumni-mhs-do') {
        $('#myModal .content-responsive').scrollTop(0);
        if ($('#statistik-alumni').is(':visible')) {
          var data = 'alumni',
          chart = '#barchart-alumni',
          replace_chart = '<canvas id="barchart-alumni" class="chart" style="height: 280px; width: 510px;"></canvas>',
          detail_static = '.detail-jml-alumni';
        }
        else if ($('#statistik-mhs-do').is(':visible')) {
          var data = 'mhs_do',
          chart = '#barchart-mhs-do',
          replace_chart = '<canvas id="barchart-mhs-do" class="chart" style="height: 280px; width: 510px;"></canvas>',
          detail_static = '.detail-jml-mhs-do';
        }
        $(detail_static+' .progress-bar').css('width','0%');
        var detail_mhs = getJSON_async(hostProtocol + '//'+host+controller_path+'/data_statistik/'+data,null,500);
        detail_mhs.then(function(detail_mhs){
          $(chart).replaceWith(replace_chart);
          line_chart_alumni_do(detail_mhs.nama_prodi,detail_mhs.mhs_lk,detail_mhs.mhs_pr,detail_mhs.color,chart);
          $(detail_static).text('');
          $(detail_static).prepend('<p class="text-center"><strong>Keterangan</strong></p>');
          var no = 1;
          $.each(detail_mhs.pd, function(index,data_record){
            $(detail_static).append(
              '<div class="progress-group">'
              +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> Prodi '+no+': '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</span>'
              +'  <span class="progress-number">'+data_record.statik_mhs+'%</span>'
              +'  <div class="progress sm">'
              +'    <div class="progress-bar p-bar-'+no+'" style="background-color:'+data_record.color_detail+';"></div>'
              +'  </div>'
              +'</div>'
            );
            no++;
          });
          no = 1;
          setTimeout(function(){
            $.each(detail_mhs.pd, function(index,data_record){
              $(detail_static+' .p-bar-'+no).css('width',data_record.statik_mhs+'%');
              no++;
            });
          },100);
        });
      }
      else if (box_selected == 'config-app') {
        get_app_config();
      }
      else if (box_selected == 'list-template') {
        get_list_template();
      }
      else if (box_selected == 'list-menu') {
        list_menu('all');
      }
      else if (box_selected == 'backup-db') {
        load_backup_tbl();
      }
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1070);
    });

    $('#refresh-table-user').on('click', function(eve){
      eve.preventDefault();
      Pace.restart();      
      var btn_act = $(this).find('i');
      btn_act.addClass('fa-spin');
      $('#box-content').find('div.overlay').fadeIn();
      collapse_box('#box-content');
      $('#tbl-user').DataTable().ajax.reload();
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1070);
    });

    $('#refresh-table-mhs').on('click', function(eve){
      eve.preventDefault();
      Pace.restart();
      window.history.pushState(null,null,path);
      var btn_act = $(this).find('i');
      btn_act.addClass('fa-spin');
      $('#box-siswa').find('div.overlay').fadeIn();
      collapse_box('#box-siswa');
      $('.tbl-data-mhs').DataTable().ajax.reload();
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1070);
    });

    $('#refresh-table-guru').on('click', function(eve){
      eve.preventDefault();
      Pace.restart();
      window.history.pushState(null,null,path);
      var btn_act = $(this).find('i');
      btn_act.addClass('fa-spin');
      $('#box-guru').find('div.overlay').fadeIn();
      collapse_box('#box-guru');
      $('.tbl-data-ptk').DataTable().ajax.reload();
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1070);
    });

    $('#refresh-table-fk').on('click', function(eve){
      eve.preventDefault();
      Pace.restart();
      window.history.pushState(null,null,path);
      collapse_box('#box-content');
      var btn_act = $(this).find('i');
      btn_act.addClass('fa-spin');
      $('#box-content').find('div.overlay').fadeIn();      
      $('.tbl-data-fk').DataTable().ajax.reload();
      if ($('#statik-fk').is(':visible')) {
        data_master_chart('','static_mhs_fk');
      }
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1070);
    });

    $('.refresh-table-pd').on('click', function(eve){
      eve.preventDefault();
      Pace.restart();
      var btn_act = $(this).find('i');
      if ($('#box-prodi').is(':visible')) {
        btn_act.addClass('fa-spin');
        setTimeout(function(){
          btn_act.removeClass('fa-spin');
        },1070);
      }
      $('#box-prodi').slideDown();
      $('#box-prodi').find('div.overlay').fadeIn();
      $('.tbl-data-pd').DataTable().ajax.reload();
      collapse_box('#box-prodi');
      $('html, body').animate({scrollTop:$('#box-prodi').offset().top - 55},800);
    });

    $('#refresh-thn-ak').on('click', function(eve){
      eve.preventDefault();
      Pace.restart();
      window.history.pushState(null,null,path);
      var btn_act = $(this).find('i');
      btn_act.addClass('fa-spin');
      $('#box-content').find('div.overlay').fadeIn();      
      $('#tbl-thn-akademik').DataTable().ajax.reload();
      if ($('#statik-thn-ak').is(':visible')) {
        if ($('.select2_thn_akademik').val()) {
          thn_akademik_chart($('.select2_thn_akademik').val());
        }
        else{
          thn_akademik_chart();
        }
      }
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1070);
    });

    $('#refresh-table-thn-angkatan').on('click', function(eve){
      eve.preventDefault();
      window.history.pushState(null,null,path);
      var btn_act = $(this).find('i')
      btn_act.addClass('fa-spin');
      Pace.restart();
      collapse_box('#box-content');
      $('#box-content').find('div.overlay').fadeIn();
      $('#tbl-thn-angkatan').DataTable().ajax.reload();      
      if ($('#tbl-thn-angkatan').DataTable().search() != '') {
        $('#tbl-thn-angkatan').DataTable().search('').draw();
      }                  
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1070);
    });

    $('#refresh-table-visitors').on('click', function(eve){
      eve.preventDefault();
      Pace.restart();
      window.history.pushState(null,null,path);
      var btn_act = $(this).find('i');
      btn_act.addClass('fa-spin');
      $('#box-content').find('div.overlay').fadeIn();
      if ($('#visitors-mhs').is(':visible')) {
        $('.tbl-pengunjung-mhs').DataTable().ajax.reload();
      }
      if ($('#visitors-ptk').is(':visible')) {
        $('.tbl-pengunjung-ptk').DataTable().ajax.reload();
      }
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1070);
    });

    $('#semua-data').on('click', function(eve){
      eve.preventDefault();
      Pace.restart();
      window.history.pushState(null,null,path);
      $('#cari_thn_angkatan, #cari_prodi').val('');
      if ($('#box-siswa').is(':visible') || $('#box-guru').is(':visible') || $('.box-alumni-do').is(':visible')) {
        $('.control-panel-data-tbl .select2_thn_angkatan, .control-panel-data-tbl .select2_prodi').val('').text('');
        $('.control-panel-data-tbl .select2_status_aktif_ptk').val(null).trigger('change');
      }
      if ($('.control-panel-data-tbl .select2_data').val() == 0) {
        $('.box-alumni-do .box-title').text('Data Alumni');
      }
      else if ($('.control-panel-data-tbl .select2_data').val() == 1) {
        $('.box-alumni-do .box-title').text('Data Mahasiswa Drop Out');
      }
      $('.control-panel-data-tbl .select2_src_dt').val(null).trigger('change');

      $('.btn-status-data,.btn-status-user').attr('data-search','');
      $('#box-siswa .box-title').text('Data Mahasiswa');
      $('#box-guru .box-title').text('Data Tenaga Pendidik');
      $('#box-siswa, #box-guru,#box-content').find('div.overlay').fadeIn();
      $('.control-panel-data-tbl .cari-data-tbl').val('');
      $('#tamp-data').addClass('disabled');
      collapse_box('#box-siswa, #box-guru,#box-content');
      var table_rld = $(this).attr('table-refresh');
      if (table_rld == undefined) {
        $('.tbl-data-mhs, .tbl-data-ptk, #tbl-user, .tbl-data-alumni-do').DataTable().ajax.reload();
      }
      else{
        $(table_rld).DataTable().ajax.reload();
      }
      $('.semua-data').hide();
      $('html, body').animate({scrollTop:$('#box-siswa, #box-guru,#box-content').offset().top - 55},800);
    });

    $(document).on('click', '#tamp-data', function(eve){
      eve.preventDefault();
      Pace.restart();
      window.history.pushState(null,null,path);
      $('.semua-data').show();
      $('#myModal').modal('hide');
      if ($('#form-get .select2_prodi').val() && $('#form-get .select2_thn_angkatan').val() || $('.control-panel-data-tbl .select2_prodi').val() && $('.control-panel-data-tbl .select2_thn_angkatan').val() || $('.control-panel-data .select2_browser').val() && $('.control-panel-data .select2_platform').val()) {
        $('#box-siswa .box-title').text('Data Mahasiswa Program Studi '+$('#form-get .select2_prodi').find(':selected').text()+' Angkatan Tahun '+$('#form-get .select2_thn_angkatan').find(':selected').text());
        $('#box-siswa .box-title').text('Data Mahasiswa Program Studi '+$('.control-panel-data-tbl .select2_prodi').find(':selected').text()+' Angkatan Tahun '+$('.control-panel-data-tbl .select2_thn_angkatan').find(':selected').text());
        if ($('.control-panel-data-tbl .select2_data').val() == 0) {
          $('.box-alumni-do .box-title').text('Data Alumni Program Studi '+$('.control-panel-data-tbl .select2_prodi').find(':selected').text()+' Angkatan Tahun '+$('.control-panel-data-tbl .select2_thn_angkatan').find(':selected').text());
        }
        else if ($('.control-panel-data-tbl .select2_data').val() == 1) {
          $('.box-alumni-do .box-title').text('Data Mahasiswa Drop Out Program Studi '+$('.control-panel-data-tbl .select2_prodi').find(':selected').text()+' Angkatan Tahun '+$('.control-panel-data-tbl .select2_thn_angkatan').find(':selected').text());
        }
        $('#cari_prodi').val($('#form-get .select2_prodi').val());
        $('#cari_thn_angkatan').val($('#form-get .select2_thn_angkatan').val());
      }
      else if ($('#form-get .select2_thn_angkatan').val() || $('.control-panel-data-tbl .select2_thn_angkatan').val()) {
        $('#box-siswa .box-title').text('Data Mahasiswa Angkatan Tahun '+$('#form-get .select2_thn_angkatan').find(':selected').text());
        if ($('.control-panel-data-tbl .select2_data').val() == 0) {
          $('.box-alumni-do .box-title').text('Data Alumni Angkatan Tahun '+$('.control-panel-data-tbl .select2_thn_angkatan').find(':selected').text());
        }
        else if ($('.control-panel-data-tbl .select2_data').val() == 1) {
          $('.box-alumni-do .box-title').text('Data Mahasiswa Drop Out Angkatan Tahun '+$('.control-panel-data-tbl .select2_thn_angkatan').find(':selected').text());
        }
        $('#cari_thn_angkatan').val($('#form-get .select2_thn_angkatan').val());
        $('#cari_prodi').val('');
        $('#box-siswa .box-title').text('Data Mahasiswa Angkatan Tahun '+$('.control-panel-data-tbl .select2_thn_angkatan').find(':selected').text());
        $('.control-panel-data-tbl .select2_prodi').text('');
      }
      else if ($('#form-get .select2_prodi').val() || $('.control-panel-data-tbl .select2_prodi').val() && $('.control-panel-data-tbl .select2_status_aktif_ptk').val()) {
        $('#box-guru .box-title').text('Data Tenaga Pendidik Program Studi '+$('.control-panel-data-tbl .select2_prodi').find(':selected').text()+' : '+$('.control-panel-data-tbl .select2_status_aktif_ptk').find(':selected').text());
      }
      else if ($('.control-panel-data-tbl .select2_status_aktif_ptk').val()) {
        $('#box-guru .box-title').text('Data Tenaga Pendidik : '+$('.control-panel-data-tbl .select2_status_aktif_ptk').find(':selected').text());
      }
      else if ($('#form-get .select2_prodi').val() || $('.control-panel-data-tbl .select2_prodi').val()) {
        $('#box-siswa .box-title').text('Data Mahasiswa Program Studi '+$('#form-get .select2_prodi').find(':selected').text());
        if ($('.control-panel-data-tbl .select2_data').val() == 0) {
          $('.box-alumni-do .box-title').text('Data Alumni Program Studi '+$('.control-panel-data-tbl .select2_prodi').find(':selected').text());
        }
        else if ($('.control-panel-data-tbl .select2_data').val() == 1) {
          $('.box-alumni-do .box-title').text('Data Mahasiswa Drop Out Program Studi '+$('.control-panel-data-tbl .select2_prodi').find(':selected').text());
        }
        $('#cari_prodi').val($('#form-get .select2_prodi').val());
        $('#cari_thn_angkatan').val('');
        $('#box-siswa .box-title').text('Data Mahasiswa Program Studi '+$('.control-panel-data-tbl .select2_prodi').find(':selected').text());
        $('#box-guru .box-title').text('Data Tenaga Pendidik Program Studi '+$('.control-panel-data-tbl .select2_prodi').find(':selected').text());
        $('.control-panel-data-tbl .select2_thn_angkatan').text('');
      }
      else if ($('.control-panel-data-tbl .select2_browser').val() || $('.control-panel-data-tbl .select2_platform').val()) {
      }
      else{
        $('#box-siswa .box-title').text('Data Mahasiswa');
        $('#box-guru .box-title').text('Data Tenaga Pendidik');
        if ($('.control-panel-data-tbl .select2_data').val() == 0) {
          $('.box-alumni-do .box-title').text('Data Alumni');
        }
        else if ($('.control-panel-data-tbl .select2_data').val() == 0) {
          $('.box-alumni-do .box-title').text('Data Mahasiswa Drop Out');
        }
        $('.semua-data').hide();
      }
      $('#box-siswa,#box-guru,#box-content').find('div.overlay').fadeIn();
      $('.control-panel-data-tbl .cari-data-tbl').val('');
      $('.btn-status-data').attr('data-search','');
      collapse_box('#box-siswa, #box-guru, #box-content');
      var table_rld = $(this).attr('table-refresh');
      if (table_rld == undefined) {
        $('.tbl-data-mhs, .tbl-data-ptk, .tbl-data-alumni-do, .tbl-pengunjung-mhs, .tbl-pengunjung-ptk').DataTable().ajax.reload();
      }
      else{
        $($(this).attr('table-refresh')).DataTable().ajax.reload();
      }
      $('html, body').animate({scrollTop:$('#box-siswa, #box-guru, #box-content').offset().top - 55},800);
    });

    $("#tampilkan-data").on('click',function(eve){
      eve.preventDefault();
      $('#box-content').find('div.overlay').fadeIn();
      $("#update-process").text('');      
      $("#update-process").fadeIn();
      $("#update-process").html('<i class="fa fa-refresh fa-spin"></i><i>&nbsp&nbsp</i>');      
      delay(function(){
        Pace.restart();
        $('#tbl-thn-angkatan').DataTable().ajax.reload();      
        if ($('#tbl-thn-angkatan').DataTable().search() != '') {
          $('#tbl-thn-angkatan').DataTable().search('').draw();
        }
        $("#update-process").fadeOut();        
      },500);
    });

    $(document).on('click','.remove', function(eve){
      if (path == controller_path+'/data_angkatan') {
        delay(function(){
          $('#box-mhs .box-title').text('');
          $('.tbl-data-mhs-master').DataTable().destroy();
        },1000);
      }
      else if (path == controller_path+'/data_fakultas_pstudi') {
        $('.check-all-prodi').iCheck('uncheck');
        delay(function(){
          $('.tbl-data-prodi').find('tbody').text('').append(
            '<tr>'
            +'    <td colspan="6" align="center">Memproses Data</td>'
            +'</tr>'
            );
          $('#box-detail-fk .detail-fak').text('');
          $('.close-dt-pd-bt').fadeOut();
          $('.detail-prodi').fadeOut().removeClass('active').find('a').attr('aria-expanded','false');
          $('#detail-prodi').removeClass('active');
          $('.daftar-prodi').addClass('active').find('a').attr('aria-expanded','true');
          $('#daftar-prodi').addClass('active');
        },1000);
      }
      else if (path == controller_path+'/data_mata_kuliah') {
        $('.check-all-mk').iCheck('uncheck');
        delay(function(){
          $('.box-daftar-mk .detail-prodi-mk').text('-');
          $('.tbl-data-mk1, .tbl-data-mk2').find('tbody').html('<tr><td colspan="5" align="center">Memproses Data</td></tr>');
          $('.tbl-data-mk').find('tbody').html('<tr><td colspan="7" align="center">Memproses Data</td></tr>');
        },1000);
      }
      else if (path == controller_path+'/data_jadwal_kuliah') {
        $('.check-all-jadwal').iCheck('uncheck');
        delay(function(){
          $('#box-jadwal .description-text').text('');
          $('table.tbl-data-jadwal').find('tbody').html('<tr><td colspan="9" align="center">Silahkan pilih tahun akademik</td></tr>');
        },1000);
      }
      else if (path == controller_path+'/data_mahasiswa' || path == controller_path+'/data_alumni_do') {
        id_data_akademik_u = null;
        delay(function(){
          $('#detail-mhs .close-tab, #detail-mhs .close-dt-tab').removeClass('active');
          $('#detail-mhs .close-tab').find('a').attr('aria-expanded','false');
          $('#detail-mhs .open-tab, #detail-mhs .open-dt-tab').addClass('active');
          $('#detail-mhs .open-tab').find('a').attr('aria-expanded','true');
          $('#box-detail-mhs .detail-data-mhs').text('');
          $('#box-detail-mhs').attr('data-search','');
          $('.tbl-detail-mhs').find('tbody').text('');
        },1000);
      }
      else if (path == controller_path+'/data_ptk') {
        delay(function(){
          $('#detail-ptk .close-tab, #detail-ptk .close-dt-tab').removeClass('active');
          $('#detail-ptk .close-tab').find('a').attr('aria-expanded','false');
          $('#detail-ptk .open-tab, #detail-ptk .open-dt-tab').addClass('active');
          $('#detail-ptk .open-tab').find('a').attr('aria-expanded','true');
          $('#box-ptk').attr('data-search','');
          $('#box-ptk .detail-data-ptk').text('');
          $('.tbl-detail-ptk').find('tbody').text('');
        },1000);
      }
      window.history.pushState(null,null,path);
    });
    $(document).on('click','.remove-kelas', function(){
      $('.check-all-mhs-kelas').iCheck('uncheck');
      delay(function(){
        $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="6" align="center">Silahkan pilih kelas</td></tr>');
      },1000);
    });
    $(document).on('click','.close-detail-pd', function(eve){
      $('.close-dt-pd-bt').fadeOut()
      $('.detail-prodi').fadeOut().removeClass('active').find('a').attr('aria-expanded','false');
      $('#detail-prodi').removeClass('active');
      $('.daftar-prodi').addClass('active').find('a').attr('aria-expanded','true');
      $('#daftar-prodi').addClass('active');
      window.history.pushState(null,null,path);
    });

    $('#form-identitas-pt, .form-identitas-pt').on('click', function(eve){
      eve.preventDefault();
      modal_animated('zoomIn');
      var btn_act = $(this).find('i');
      btn_act.removeClass('fa-pencil-square').addClass('fa-circle-o-notch fa-spin');
      var results = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{data:'data_identitas_pt'},1000,true);
      results.then(function(results){
        $('#myModal-pt #batal').html('<li class="fa fa-times"></li> Batal');
        if (results.status == 'empty') {
          $('#myModal-pt .modal-title').text('Input Data Identitas Perguruan Tinggi');
          $('#myModal-pt #form-input').attr('action','tambah');
          $('#myModal-pt').removeClass('modal-danger').addClass('modal-info');
          $('#myModal-pt #submit').html('<li class="fa fa-save"></li> Simpan').show();
          $('#myModal-pt .nav-tabs-custom').removeClass('nav-success nav-danger nav-warning').addClass('nav-info');
        }
        else{
          $('#myModal-pt .modal-title').text('Update Data Identitas Perguruan Tinggi');
          $('#myModal-pt #form-input').attr('action','update');
          $('#myModal-pt').removeClass('modal-danger').addClass('modal-success');
          $('#myModal-pt #submit').html('<li class="fa fa-pencil-square"></li> Update').show();
          $('#myModal-pt .nav-tabs-custom').removeClass('nav-danger nav-info nav-warning').addClass('nav-success');
          $.each(results.data, function(index, data_record){
            $.each(data_record, function(name, data_record){
              $('#form-input input[name='+name+'], #form-input select[name='+name+']').val(data_record);
              $('#form-input select[name='+name+']').trigger('change.select2');
              if (name == 'tgl_sk_pend' || name == 'tgl_sk_izin_op' || name == 'tgl_berdiri') {
                if (data_record != '0000-00-00' && data_record != '00 00 0000') {
                  $('#form-input input[name='+name+']').datepicker("update", new Date(data_record));
                }
                else{
                  $('#form-input input[name='+name+']').val('');
                }              
              }
            });          
          });
        }
        btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
        $('#myModal-pt').modal('show');
      }).catch(function(){
        btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-times');
        setTimeout(function(){
          btn_act.removeClass('fa-times fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
        },1000);
      });
    });

    $('.info').on('click', function(){
      var html;
      var data_info = $(this).attr('data-info');
      if (path == controller_path+'/data_fakultas_pstudi') {
        html = '<ol style="text-align:left">'
        +'<li>Klik tombol <a class="btn btn-info"><i class="fa fa-plus"></i> Tambah Fakultas</a> untuk menambah data fakultas</li>'
        +'<li>Klik tombol <a class="btn btn-info"><i class="fa fa-plus"></i> Tambah Program Studi</a> untuk menambah program studi</li>'
        +'<li>klik tombol <a class="btn btn-info"><i class="fa fa-plus"></i></a> pada daftar fakultas untuk menambah program studi</li>'
        +'</ol>';
      }
      else if (path == controller_path+'/data_thn_akademik') {
        html = '<ol style="text-align:left">'
          +'<li>Klik tombol <a class="btn btn-info"><i class="fa fa-plus"></i> Tambah Tahun Akademik</a> Untuk menambah tahun akademik</li>'
          +'<li>Klik tombol <a class="btn btn-danger"><i class="fa fa-ban"></i> Tutup Tahun Akademik</a> Untuk menutup/nonaktifkan tahun akademik yang sedang berjalan</li>'
          +'<li>klik <div class="toggle btn btn-success btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-success btn-sm toggle-on"><i class="fa fa-check-circle"></i> Diterapkan</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div> | <div class="toggle btn btn-danger off btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-danger btn-sm active toggle-off"><i class="fa fa-ban"></i> Tidak Diterapkan</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div>'
          +' pada daftar tahun akademik untuk menerapkan atau menutup tahun akademik</li>'
          +'<li>klik <div class="toggle btn btn-success btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-success btn-sm toggle-on"><i class="fa fa-check-circle"></i> Input Nilai</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div> | <div class="toggle btn btn-danger off btn-sm" data-toggle="toggle" style="width: 140px; height: 30px;"><div class="toggle-group"><label class="btn btn-danger btn-sm active toggle-off"><i class="fa fa-ban"></i> Input Nilai</label><span class="toggle-handle btn btn-default btn-sm"></span></div></div>'
          +' pada daftar tahun akademik agar proses input nilai bisa dilakukan maupun sebaliknya</li>'
          +'</ol>';
      }
      else if (path == controller_path+'/data_angkatan') {
        html = '<ol style="text-align:left">'
          +'<li>Klik tombol <a class="btn btn-info"><i class="fa fa-plus"></i> Tambah Tahun Angkatan</a> Untuk menambah tahun angkatan mahasiswa</li>'
          +'<li>Klik tombol <a class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a> Untuk menghapus tahun angkatan mahasiswa</li>'
          +'<li>klik tombol <a class="btn btn-warning"><i class="fa fa-list"></i></a> Untuk melihat daftar angkatan mahasiswa dan klik tombol <a class="btn btn-success"><i class="fa fa-pencil-square"></i></a> Untuk mengedit data tahun angkatan</li>'
          +'</ol>';
      }
      else if (path == controller_path+'/data_mata_kuliah') {
        html = '<ol style="text-align:left">'
          +'<li>Klik tombol <a class="btn btn-info"><i class="fa fa-plus"></i> Tambah Mata Kuliah</a> untuk menambah mata kuliah</li>'
          +'<li>Klik tombol <a class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a> pada control panel untuk menghapus multiple data</li>'
          +'<li>Klik tombol <a class="btn btn-success"><i class="fa fa-list"></i> Tampilkan Mata Kuliah</a> untuk Menampilkan mata kuliah berdasarkan prodi yang dipilih</li>'
          +'</ol>';
      }
      else if (path == controller_path+'/data_jadwal_kuliah') {
        html = '<ol style="text-align:left">'
          +'<li>Klik tombol <a class="btn btn-info"><i class="fa fa-plus"></i> Buat Jadwal Kuliah</a> untuk menambah jadwal kuliah kuliah</li>'
          +'<li>Klik tombol <a class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a> pada control panel untuk menghapus multiple data</li>'
          +'<li>Klik tombol <a class="btn btn-success"><i class="fa fa-list"></i> Tampilkan Jadwal Kuliah</a> untuk menampilkan jadwal kuliah berdasarkan tahun akademik dan prodi yang dipilih</li>'
          +'<li>Klik tombol <a class="btn btn-info"><i class="fa fa-plus"></i> Tambah Mahasiswa</a> untuk menambah mahasiswa kedalam kelas yang bersangkutan</li>'
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
            +'<li>Klik tombol <a class="btn btn-info"><i class="fa fa-download"></i></a> untuk download backup database dan klik tombol <a class="btn btn-danger"><i class="fa fa-trash"></i></a> untuk menghapus backup database</li>'
            +'<li>Klik tombol <a class="btn btn-default"><i class="fa fa-download"></i> Backup Database</a> untuk memulai proses backup database</li>'
            +'<li>Klik tombol <a class="btn btn-default"><i class="fa fa-download"></i> Backup Tabel</a> untuk memulai proses backup tabel database yang dipilih</li>'
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

    $('.tamp-mk').on('click', function(eve){
      eve.preventDefault();      
      var mk = $('.mk-prodi').val();
      if (mk != null) {
        $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
        daftar_mk(mk);
      }
      else{
        $(this).addClass('disabled');
        swal({          
          type:'info',
          title:'Info',
          html: 'Silahkan Pilih Program Studi',
          confirmButtonText:'<i class="fa fa-check"></i> Ok'
        });
      }
    });

    $(document).on('click','#update-mk', function(eve){
      eve.preventDefault();
      $('#alert-place').text('');
      var id = [],
      pd = $('#form-edit-mk select[name=id_pd_mk]').val(),
      sks = $('#form-edit-mk input[name=jml_sks].jml_sks').val(),
      mk_j = $('#form-edit-mk select[name=jenis_jdl].jenis_jdl').val(),
      btn_act = $(this).find('li');
      $(".check-mk:checked").each(function() {
        id.push($(this).val());
      });
      btn_act.removeClass('fa-pencil-square').addClass('fa-circle-o-notch fa-spin');
      var update_pd_mk = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/update_pd_mk',{id:id,id_pd_mk:pd,sks:sks,mk_j:mk_j},500,true);
      update_pd_mk.then(function(update_pd_mk){
        btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
        if (update_pd_mk.status =='success') {
          $('#myModal').modal('hide');
          $('.check-all-mk').iCheck('uncheck');
          $('.hapus,.edit-mk').addClass('disabled');
          daftar_mk($('.box-daftar-mk').attr('data-search'));
          swal({
            title:'Data Berhasil Di Update',
            type:'success',
            timer: 2000
          });
        }
        else if (update_pd_mk.status == 'zero_change' || update_pd_mk.status == 'failed_db') {
          $('#alert-place').prepend(
            '<div class="alert alert-danger alert-dismissible">'
            +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
            +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
            +'  <font>'+update_pd_mk.errors_message+'</font>'
            +'</div>'
          );
        }
        else{
          $('#alert-place').prepend(
            '<div class="alert alert-danger alert-dismissible">'
            +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
            +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
            +'  <font><ul style="padding-left:15px"></ul></font>'
            +'</div>'
          );
          $.each(update_pd_mk.errors, function(key, value){
            $('#alert-place font ul').append('<li>'+value+'</li>');
            $("#form-edit-mk #"+key).addClass('has-error');
          });
        }
      }).catch(function(error){
        btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
      });
    });

    $('.tamp-jadwal').on('click', function(eve){
      eve.preventDefault();      
      var thn_ajaran = $('.select2_jadwal').val();
      if (thn_ajaran != null) {
        $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
        daftar_jadwal(thn_ajaran);
      }
      else{
        $(this).addClass('disabled');
        swal({          
          type:'info',
          title:'Info',
          html: 'Silahkan Pilih Tahun Akademik',
          confirmButtonText:'<i class="fa fa-check"></i> Ok'
        });
      }
    });

    $(document).on('click', '.view-kelas', function(){
      var kelas_view = $(this).val();
      $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
      daftar_kelas_mhs(kelas_view);
    });

    $('.box-mk-control .mk-prodi').on('change', function(){
      if ($(this).val() != null) {
        $('.tamp-mk').removeClass('disabled');
      }
      else{
        $('.tamp-mk').addClass('disabled');      
      }
    });

    $('.box-jadwal-mk-control .select2_jadwal, .box-jadwal-mk-control .jdl-prodi').on('change', function(){
      if ($('.box-jadwal-mk-control .select2_jadwal').val() != null) {
        $('.tamp-jadwal').removeClass('disabled');
      }
      else{
        $('.tamp-jadwal').addClass('disabled');      
      }
    });

    $(document).on('click','.show-password', function(){
      $(this).siblings('.pass').removeClass('password-cry');
      $(this).siblings('.password').css('display','block');
      $(this).attr('title','Sembunyikan password');
      $(this).find('span').removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
      $(this).removeClass('show-password').addClass('hide-password');
    });
    $(document).on('click','.hide-password', function(){
      $(this).siblings('.pass').addClass('password-cry');
      $(this).siblings('.password').css('display','none');
      $(this).attr('title','Tampilkan password');
      $(this).find('span').removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
      $(this).removeClass('hide-password').addClass('show-password');
    });

    $(document).on('click','.dt-vld', function(){
      if ($(this).attr('data-status') == '1') {
        var status_msg = 'Data telah terverifikasi!';
        var status_type = 'success';
      }
      else if ($(this).attr('data-status') == '2') {
        var status_msg = 'Data ini masih memiliki informasi yang salah!';
        var status_type = 'error';
      }
      else{
        var status_msg = 'Data masih belum diverifikasi!';
        var status_type = 'info';
      }
      swal({
        title:'Status Data',
        text: status_msg,
        type:status_type,
        timer: 2000
      });
    });

    /*Boostrap Toogle Event*/
    $(document).on('change','.check-status-thn-ajar',function(){
      var status = $(this).prop('checked'),
      id = $(this).attr('value'),
      status_thn = getJSON_async(hostProtocol + '//'+host+data_master_path+'/action/update_status',{in:id,status:status,data:'thn_ajaran_status'});
      status_thn.then(function(status_thn){
        if (status_thn.status == 'success') {
          if (status_thn.status_thn == 1) {
            $('#tbl-thn-akademik').DataTable().draw(false);
            $('.tbl-daftar-thn-ajar').DataTable().draw(false);
            $('.non-aktif-thn-ajaran').removeClass('disabled');
          }
          else{
            $('.non-aktif-thn-ajaran').addClass('disabled');
            $('.check-status-thn-inp-'+id).bootstrapToggle('destroy');
            $('.check-status-thn-inp-'+id).replaceWith("<input type='checkbox' class='check-status-thn-inp check-status-thn-inp-"+id+"' value='"+id+"'/>");
            $('.check-status-thn-inp-'+id).bootstrapToggle({
              on:'<i class="fa fa-check-circle"></i> Input Nilai',
              off:'<i class="fa fa-ban"></i> Input Nilai',
              size:'small',
              onstyle:'success',
              offstyle:'danger',
              width: 140,
            });
            $('.check-status-thn-inp-'+id).parent('.toggle').attr('disabled','disabled');
            $('.check-status-thn-inp-'+id).attr('disabled','disabled');
          }
        }
      });
    });
    $(document).on('change','.check-status-thn-inp',function(){
      var status = $(this).prop('checked'),
      id = $(this).attr('value'),
      status_thn = getJSON_async(hostProtocol + '//'+host+data_master_path+'/action/update_status',{in:id,status:status,data:'thn_ajaran_status_inp'});
    });
    $(document).on('click','.non-aktif-thn-ajaran',function(eve){
      eve.preventDefault();
      swal({
        type:'info',
        title:'Peringatan',
        text:'Anda akan menutup tahun akademik yang sedang berjalan, klik tombol Tutup untuk melanjutkan!',
        showCancelButton: true,
        confirmButtonText:'<i class="fa fa-check"></i> Tutup',
        cancelButtonText:'<i class="fa fa-times"></i> Batal',
      }).then(function(){
        var status_thn = getJSON_async(hostProtocol + '//'+host+data_master_path+'/action/update_status',{data:'thn_ajaran_status_non'});
        status_thn.then(function(status_thn){
          if (status_thn.status == 'success') {
            swal({
              title:'Tahun akademik berhasil ditutup',
              type:'success',
              timer: 2000
            });
            $('#tbl-thn-akademik').DataTable().draw(false);
            $('.non-aktif-thn-ajaran').addClass('disabled');
          }
        });
      });
    });

    $(document).on('change','.check-template-status',function(){
      var status = $(this).prop('checked'),
      id = $(this).attr('value'),
      status_template = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/update',{id:id,template_status:'',status:status});
      status_template.then(function(status_u){
        if (status_u.status != 'success') {
          get_list_template();
          if (status == true) {
            swal({
              title:'Status Template',
              html:'Template gagal diaktifkan',
              type:'error',
              timer: 2000
            });
          }
          else {
            swal({
              title:'Status Template',
              html:'Template gagal dinonaktifkan',
              type:'error',
              timer: 2000
            });
          }
        }
        else if (status_u.status == 'success' && status == true) {
          get_list_template();
        }
      }).catch(function(error){
        if (status == true) {
          swal({
            title:'Status Template',
            html:'Template gagal diaktifkan',
            type:'error',
            timer: 2000
          });
        }
        else {
          swal({
            title:'Status Template',
            html:'Template gagal dinonaktifkan',
            type:'error',
            timer: 2000
          });
        }
      });
    });
    /*END -- Boostrap Toogle Event*/

    $('#box-nilai .select2_nilai_mhs').on('change', function(){
      if ($(this).val() != null) {
        $('.tamp-nilai, .tamp-all-nilai').removeClass('disabled');
      }
      else{
        $('.tamp-nilai, .tamp-all-nilai').addClass('disabled');
      }
    });

    $('.tamp-nilai').on('click', function(eve){
      eve.preventDefault(); 
      var thn_ajaran = $('.select2_nilai_mhs').val();
      $(this).find('i').removeClass('fa-file-text-o').addClass('fa-circle-o-notch fa-spin');
      detail_nilai(thn_ajaran);
    });
    $('.tamp-all-nilai').on('click', function(eve){
      eve.preventDefault(); 
      var thn_ajaran = $('.select2_nilai_mhs').val();
      $(this).find('i').removeClass('fa-files-o').addClass('fa-circle-o-notch fa-spin');
      detail_nilai(thn_ajaran);
    });

    $('a[href="#statik-thn-ak"]').on('click', function(){
      if ($('.select2_thn_akademik').val()) {
        thn_akademik_chart($('.select2_thn_akademik').val());
      }
      else{
        thn_akademik_chart();
      }
    });
    $('.static-mhs-tab').on('click', function(){
      var dt = $(this).attr('href').split('-');
      if (path == controller_path+'/data_thn_akademik') {
        data_master_chart(dt[1],'static_mhs_thn_ak');
      }
      else if (path == controller_path+'/data_angkatan') {
        data_master_chart(dt[1],'static_mhs_thn_angkatan');
      }
    });
    $('a[href="#statik-fk"]').on('click', function(){
      data_master_chart('','static_mhs_fk');
    });

    $('.backup_db').on('click', function(eve){
      modal_animated('zoomIn');
      $('#myModal').modal('show');
      $('#myModal form[form-data=backup-db]').show();
      $('#myModal .submit').attr('id','backup_db').text('Backup Database').prepend('<li class="fa fa-download"></li> ').show();
      $('#myModal .cancel').text('Batal').prepend('<li class="fa fa-times"></li> ');
      $('#myModal .modal-title').text('Backup Database');
      $('.modal .load-data').replaceWith('');
      if (path == controller_path+'/pengaturan') {
        $('#myModal').removeClass('modal-warning modal-success modal-default').addClass('modal-info');
      }
      else{
        $('#myModal').removeClass('modal-warning').addClass('modal-success');
      }
    });
    $('.backup_db_tbl').on('click', function(eve){
      modal_animated('zoomIn');
      $('#myModal').modal('show');
      $('#myModal form[form-data=backup-db]').show();
      $('#myModal .modal-title').text('Backup Table Database');
      $('#myModal .submit').attr('id','backup_db_tbl').text('Backup Tabel').prepend('<li class="fa fa-download"></li> ').show();
      $('#myModal .cancel').text('Batal').prepend('<li class="fa fa-times"></li> ');
      $('.modal .load-data').replaceWith('');
      if (path == controller_path+'/pengaturan') {
        $('#myModal').removeClass('modal-warning modal-success modal-default').addClass('modal-info');
      }
      else{
        $('#myModal').removeClass('modal-success').addClass('modal-warning');
      }
    });
    $(document).on('click','#backup_db', function(eve){
      var btn_act = $(this).find('li');
      btn_act.removeClass('fa-download').addClass('fa-circle-o-notch fa-spin');
      var user = $('#myModal form input[name=username]').val(),
      pass = $('#myModal form input[name=password]').val(),
      opsi = $('.backup_db_opsi:checked').val(),
      backup_db = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/action/backup',{data:'backup_db',db_backup:'full-backup',user:user,pass:pass,data_opsi:opsi},500);
      backup_db.then(function(backup_db){
        btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-download');
        if (backup_db.status == 'success') {
          $('#myModal').modal('hide');
          load_backup_tbl();
          window.location.href= backup_db.url_download;
        }
        else{
          $('#myModal #alert-place').show();
          if (backup_db.status == 'failed_auth') {
            $('#myModal #alert-place').html(
              '<div class="alert alert-danger alert-dismissible">'
              +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
              +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'
              +'  <font>'+backup_db.error+'</font>'
              +'</div>'
              );
          }
          else{
            $('#myModal #alert-place').html(
              '<div class="alert alert-danger alert-dismissible">'
              +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
              +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'
              +'  <font>Terjadi error dalam backup database</font>'
              +'</div>'
              );
          }
        }
      }).catch(function(error){
        btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-download');
        $('#myModal #alert-place').html(
          '<div class="alert alert-danger alert-dismissible">'
          +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
          +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'
          +'  <font>Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b></font>'
          +'</div>'
          ).show();
      });
    });
    $(document).on('click','#backup_db_tbl', function(eve){
      var btn_act = $(this).find('li');
      btn_act.removeClass('fa-download').addClass('fa-circle-o-notch fa-spin');
      var user = $('#myModal form input[name=username]').val(),
      pass = $('#myModal form input[name=password]').val(),
      table = $('.select2_tbl_db').val(),
      opsi = $('.backup_db_opsi:checked').val(),
      backup_db = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/action/backup',{data:'backup_db',db_backup:'table-backup',table:table,user:user,pass:pass,data_opsi:opsi},500);
      backup_db.then(function(backup_db){
        btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-download');
        $('#myModal #alert-place').text('');
        if (backup_db.status == 'success') {
          $('#myModal').modal('hide');
          load_backup_tbl();
          window.location.href= backup_db.url_download;
        }
        else{
          $('#myModal #alert-place').show();
          if (backup_db.status == 'failed_auth' || backup_db.status == 'failed_db_tbl') {
            $('#myModal #alert-place').html(
              '<div class="alert alert-danger alert-dismissible">'
              +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
              +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'
              +'  <font>'+backup_db.error+'</font>'
              +'</div>'
              );
          }
          else{
            $('#myModal #alert-place').html(
              '<div class="alert alert-danger alert-dismissible">'
              +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
              +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'
              +'  <font>Terjadi error dalam backup database</font>'
              +'</div>'
              );
          }
        }
      }).catch(function(error){
        btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-download');
        $('#myModal #alert-place').html(
          '<div class="alert alert-danger alert-dismissible">'
          +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
          +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'
          +'  <font>Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b></font>'
          +'</div>'
          ).show();
      });
    });

    $(document).on('click', '.download-backup', function(eve){
      eve.preventDefault();
      var check_backup = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/backup_db_file',{act:'check_backup',file:$(this).attr('href')},null,true);
      /*window.location.href= $(this).attr('href');*/
    });
    $(document).on('click', '.delete-backup', function(eve){
      eve.preventDefault();
      var delete_backup = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/configuration/action/delete',{data:'backup_file',act:'delete_backup',file:$(this).attr('href')},null,true);
      delete_backup.then(function(delete_backup){
        if (delete_backup.status == true) {
          load_backup_tbl();
        }
        else{
          swal({
            title:'Error',
            text: 'Gagal Menghapus Backup Database: '+delete_backup.status,
            type:'error',
          });
        }
      }).catch(function(error){});
    });

    $('a[href="#detail_riwayat_kuliah"], a[href="#detail_riwayat_studi"]').on('click', function(){
      if (id_data_akademik_u != null && id_data_akademik_u != '') {
        delay(function(){
            detail_akademik_mhs();
        },100);
      }
    });

    $('.data-statistik-mhs a[href="#statistik-alumni"]').on('click', function(){
      $('#myModal .content-responsive').scrollTop(0);
      var btn_act = $(this).find('span');
      btn_act.removeClass('fa-bar-chart').addClass('fa-circle-o-notch fa-spin');
      setTimeout(function(){
        $('.detail-jml-alumni .progress-bar').css('width','0%');
        var detail_mhs = getJSON_async(hostProtocol + '//'+host+controller_path+'/data_statistik/alumni',null,500);
        detail_mhs.then(function(detail_mhs){
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-bar-chart');
          $('#barchart-alumni').replaceWith('<canvas id="barchart-alumni" class="chart" style="height: 280px; width: 510px;"></canvas>');
          line_chart_alumni_do(detail_mhs.nama_prodi,detail_mhs.mhs_lk,detail_mhs.mhs_pr,detail_mhs.color,'#barchart-alumni');
          $('.detail-jml-alumni').text('');
          $('.detail-jml-alumni').prepend('<p class="text-center"><strong>Keterangan</strong></p>');
          var no = 1;
          $.each(detail_mhs.pd, function(index,data_record){
            $('.detail-jml-alumni').append(
              '<div class="progress-group">'
              +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> Prodi '+no+': '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</span>'
              +'  <span class="progress-number">'+data_record.statik_mhs+'%</span>'
              +'  <div class="progress sm">'
              +'    <div class="progress-bar p-bar-'+no+'" style="background-color:'+data_record.color_detail+';"></div>'
              +'  </div>'
              +'</div>'
            );
            no++;
          });
          no = 1;
          delay(function(){
            $.each(detail_mhs.pd, function(index,data_record){
              $('.detail-jml-alumni .p-bar-'+no).css('width',data_record.statik_mhs+'%');
              no++;
            });
          },100);
        }).catch(function(){
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-bar-chart');
        });
      },200);
    });

    $('.data-statistik-mhs a[href="#statistik-mhs-do"]').on('click', function(){
      $('#myModal .content-responsive').scrollTop(0);
      var btn_act = $(this).find('span');
      btn_act.removeClass('fa-bar-chart').addClass('fa-circle-o-notch fa-spin');
      setTimeout(function(){
        $('.detail-jml-mhs-do .progress-bar').css('width','0%');
        var detail_mhs = getJSON_async(hostProtocol + '//'+host+controller_path+'/data_statistik/mhs_do',null,500);
        detail_mhs.then(function(detail_mhs){
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-bar-chart');
          $('#barchart-mhs-do').replaceWith('<canvas id="barchart-mhs-do" class="chart" style="height: 280px; width: 510px;"></canvas>');
          line_chart_alumni_do(detail_mhs.nama_prodi,detail_mhs.mhs_lk,detail_mhs.mhs_pr,detail_mhs.color,'#barchart-mhs-do');
          $('.detail-jml-mhs-do').text('');
          $('.detail-jml-mhs-do').prepend('<p class="text-center"><strong>Keterangan</strong></p>');
          var no = 1;
          $.each(detail_mhs.pd, function(index,data_record){
            $('.detail-jml-mhs-do').append(
              '<div class="progress-group">'
              +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> Prodi '+no+': '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</span>'
              +'  <span class="progress-number">'+data_record.statik_mhs+'%</span>'
              +'  <div class="progress sm">'
              +'    <div class="progress-bar p-bar-'+no+'" style="background-color:'+data_record.color_detail+';"></div>'
              +'  </div>'
              +'</div>'
            );
            no++;
          });
          no = 1;
          delay(function(){
            $.each(detail_mhs.pd, function(index,data_record){
              $('.detail-jml-mhs-do .p-bar-'+no).css('width',data_record.statik_mhs+'%');
              no++;
            });
          },100);
        }).catch(function(){
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-bar-chart');
        });
      },200);
    });

    $(document).on('click','.change-pass-user', function(){
      var username = $(this).val().split('-'),
      btn_act = $(this).find('li'),
      user_in = $(this).val();
      if (id_data_akademik_u != null && id_data_akademik_u != '' && $(this).val() != '') {
        swal({
            type:'info',
            title:'Peringatan',
            html:'Anda melakukan reset password pada pengguna dengan username <b>'+username[2]+'</b>, klik tombol Reset untuk melanjutkan!',
            showCancelButton: true,
            confirmButtonText:'<i class="fa fa-check"></i> Reset',
            cancelButtonText:'<i class="fa fa-times"></i> Batal',
        }).then(function(){
            btn_act.removeClass('fa-key').addClass('fa-circle-o-notch fa-spin');
            var status_thn = getJSON_async(hostProtocol + '//'+host+data_pengguna_path+'/action/update_password',{user_in:user_in},500,true);
            status_thn.then(function(status_thn){
            btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-key');
            if (status_thn.status == 'success') {
                swal({
                title:'Berhasil',
                html:'Password pengguna dengan username <b>'+username[2]+'</b> berhasil direset!, password user <b>'+status_thn.u_pass+'</b>',
                type:'success',
                });
            }
            else{
                swal({
                title:'Gagal',
                text:'Gagal melakukan reset password!',
                type:'error',
                timer: 2000
                });
            }
            }).catch(function(error){
            btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-key');
            });
        });
      }
    });

    $(document).on('click', '#created-pass', function(eve){
      /*$(this).css('pointer-events','');*/
      eve.preventDefault();
      $('#form-print-u').attr('target','').attr('action','').attr('method','');
      if ($('.control-panel-data-tbl .select2_prodi').val() != null && $('.control-panel-data-tbl .select2_thn_angkatan').val() != null) {
        $(this).find('i').removeClass('fa-key').addClass('fa-refresh fa-spin');
        var thn_angkatan_p = $('.control-panel-data-tbl .select2_thn_angkatan').val();
        var prodi_p = $('.control-panel-data-tbl .select2_prodi').val();
        var check_print_data = getJSON_async(hostProtocol + '//'+host+controller_path+'/check_print_data',{thn_angkatan:thn_angkatan_p,prodi:prodi_p,act:'created_pass'},null,true);
        check_print_data.then(function(check_print_data){
          $('#created-pass').find('i').removeClass('fa-refresh fa-spin').addClass('fa-key');
          if (check_print_data.status != 'success') {
            if (check_print_data.errors['thn_angkatan'] && check_print_data.errors['prodi']) {
              var error_message = 'Maaf, tahun angkatan dan program studi yang anda pilih tidak ada dalam database';
            }
            else if (check_print_data.errors['thn_angkatan']) {
              var error_message = check_print_data.errors['thn_angkatan'];
            }
            else if (check_print_data.errors['prodi']) {
              var error_message = check_print_data.errors['prodi'];
            }
            swal({
              title:'Kesalahan',
              text: error_message,
              type:'error',
            });
          }
          else if (check_print_data.status == 'success'){
            var create_pass_url = check_print_data.form_action+'?thn_angkatan='+thn_angkatan_p+'&prodi='+prodi_p+'&token='+token;
            window.open(create_pass_url,'_blank');
            $(this).attr('type','submit');
            $('#form-print-u').attr('target','_blank').attr('action',check_print_data.form_action).attr('method','POST');
          }
        }).catch(function(error){
          $('#created-pass').find('i').removeClass('fa-refresh fa-spin').addClass('fa-key');
        });
      }
      else if (path == controller_path+'/data_pengguna_ptk' && $('.control-panel-data-tbl .select2_prodi').val() != null) {
        $(this).find('i').removeClass('fa-key').addClass('fa-refresh fa-spin');
        var prodi_p = $('.control-panel-data-tbl .select2_prodi').val();
        var check_print_data = getJSON_async(hostProtocol + '//'+host+controller_path+'/check_print_data',{prodi:prodi_p},null,true);
        check_print_data.then(function(check_print_data){
          $('#created-pass').find('i').removeClass('fa-refresh fa-spin').addClass('fa-key');
          if (check_print_data.status != 'success') {
            if (check_print_data.errors['prodi']) {
              var error_message = check_print_data.errors['prodi'];
            }
            swal({
              title:'Kesalahan',
              text: error_message,
              type:'error',
            });
          }
          else{
            var create_pass_url = check_print_data.form_action+'?prodi='+prodi_p+'&token='+token;
              window.open(create_pass_url,'_blank');
            $(this).attr('type','submit');
            $('#form-print-u').attr('target','_blank').attr('action',check_print_data.form_action).attr('method','POST');
          }
        }).catch(function(error){
          $('#created-pass').find('i').removeClass('fa-refresh fa-spin').addClass('fa-key');
        });
      }
      else{
        $('#created-pass').addClass('disabled');
        if (path == controller_path+'/data_pengguna_mahasiswa') {
          var error_message = 'Silahkan pilih tahun angkatan dan program studi terlebih dahulu!';
        }
        else if (path == controller_path+'/data_pengguna_ptk') {
          var error_message = 'Silahkan pilih program studi terlebih dahulu!';
        }
        swal({
          title:'Kesalahan',
          text: error_message,
          type:'error',
        });
      }
    });

    $('#update-pass-admin').on('click',function(eve){
      eve.preventDefault();
      var old_pass = $('.old-password').val(),
      new_pass = $('.new-password').val(),
      re_pass = $('.confirm-password').val(),
      btn_act = $(this).find('i');
      $("#old-password,#new-password,#confirm-password").removeClass('has-error');
      if (old_pass !='' && new_pass !='' && re_pass !='') {
        btn_act.removeClass('fa-save').addClass('fa-circle-o-notch fa-spin');
        var change_pass = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/change_password',{new_password:new_pass,confirm_password:re_pass,old_password:old_pass},null,true);
        change_pass.then(function(change_pass){
          if (change_pass.status == 'success') {
            swal({
              type:'success',
              title:'Status Password',
              text:'Password berhasil diganti'
            });
            $('.old-password,.new-password,.confirm-password').val('');
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
              $('.old-password,.new-password,.confirm-password').val('');
              $("#old-password").addClass('has-error');
            }
            else if (change_pass.errors['new_password']){
              swal({
                type:'error',
                title:'Kesalahan',
                text:change_pass.errors['new_password']
              });
              $("#new-password,#confirm-password").addClass('has-error');
            }
            else{
              swal({
                type:'error',
                title:'Kesalahan',
                text:change_pass.errors['confirm_password']
              });
              $("#confirm-password").addClass('has-error');
            }
          }
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-save');
        }).catch(function(error){
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-save');
          swal({
            type:'error',
            title:'Kesalahan',
            text:'Terjadi kesalahan dalam memperbahrui password'
          });
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

    $(document).on('click','.remove-photo', function(eve){
      eve.preventDefault();
      var url_vars = getUrlVars();
      if (path == controller_path+'/data_mahasiswa') {
        if (url_vars['mhs'] != null && url_vars['mhs'] != '') {
          var photo = 'mhs';
          var id_photo = url_vars['mhs'];
        }
      }
      else if (path == controller_path+'/data_ptk') {
        if (url_vars['ptk'] != null && url_vars['ptk'] != '') {
          var photo = 'ptk';
          var id_photo = url_vars['ptk'];
        }
      }
      if (photo != undefined && id_photo != undefined) {
        var trash_btn = $(this);
        trash_btn.find('span').removeClass('fa-trash').addClass('fa-circle-o-notch fa-spin');
        var delete_photo = getJSON_async(hostProtocol + '//'+host+controller_path+'/delete_file',{data:'photo',photo:photo,id_photo:id_photo},500);
        delete_photo.then(function(delete_photo){
          trash_btn.find('span').removeClass('fa-circle-o-notch fa-spin').addClass('fa-trash');
          if (delete_photo.status == 'success') {
            $('#form-input .photo-usr-edit-n').attr('src',delete_photo.default_photo);
            $('#form-input .photo-file-name').text('Nama File: -');
            trash_btn.hide();
          }
          else{
            swal({
              type:'error',
              title:'Error',
              html:'Gagal menghapus foto!',
              confirmButtonText:'<i class="fa fa-check"></i> Ok'
            });
          }
        }).catch(function(error){
          trash_btn.find('span').removeClass('fa-circle-o-notch fa-spin').addClass('fa-trash');
          $('#alert-place').html(
              '<div class="alert alert-danger alert-dismissible">'
              +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
              +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
              +'  <font>Terjadi kesalahan saat menghapus foto, <b>Error '+error.status+': '+error.statusText+'</b></font>'
              +'</div>'
            );
        });
      }
    });

    $(document).on('click','.show-about', function(eve){
      eve.preventDefault();
      $('#about').modal('show');
    });
    /*END -- Onclick Event*/

    /*Onkeyup Event*/
    $(document).on('keyup','#form-input input[name=nama]', function(){
      if (path == controller_path+'/data_mahasiswa') {
        $(this).val($(this).val().toUpperCase());
      }
    });

    $('input.link_menu').on({
      keyup: function(){
        if ($(this).val() != '') {
          if ($('.select2_lvl_access_menu').val() == 'admin') {
            $('label[for=link_menu]').text('Link Menu : '+admin_url+$(this).val());
            $(this).siblings('p.link_preview').text('Link: '+admin_url+$(this).val());
          }
          else{
            $('label[for=link_menu]').text('Link Menu : '+base_url+$(this).val());
            $(this).siblings('p.link_preview').text('Link: '+base_url+$(this).val());
          }
        }
        else{
          $('label[for=link_menu]').text('Link Menu');
          $(this).siblings('p.link_preview').text('');
        }
      },
      focus: function(){
        if ($(this).val() != '') {
          if ($('.select2_lvl_access_menu').val() == 'admin') {
            $('label[for=link_menu]').text('Link Menu : '+admin_url+$(this).val());
            $(this).siblings('p.link_preview').text('Link: '+admin_url+$(this).val());
          }
          else{
            $('label[for=link_menu]').text('Link Menu : '+base_url+$(this).val());
            $(this).siblings('p.link_preview').text('Link: '+base_url+$(this).val());
          }
        }
        else{
          $('label[for=link_menu]').text('Link Menu');
          $(this).siblings('p.link_preview').text('');
        }
      },
    });

    $('input.color-input-text').on({
      keyup: function(){
        $('.icon_menu_review').find('i').css('color',$(this).val());
      },
      focus: function(){
        $('.icon_menu_review').find('i').css('color',$(this).val());
      }
    });

    $('input.icon-input-text').on({
      keyup: function(){
        $(this).siblings('span').find('i').attr('class','');
        $(this).siblings('span').find('i').addClass($(this).val());
      },
      focus: function(){
        $(this).siblings('span').find('i').attr('class','');
        $(this).siblings('span').find('i').addClass($(this).val());
      }
    })
    /*END -- Onkeyup Event*/

    /*Submit AJAX*/
    $(document).on('click', '#submit', function(eve){
      eve.preventDefault();
      
      $('#form-input, form').find('.has-error').removeClass('has-error');
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

      $.ajax(hostProtocol + '//'+host+controller_path+'/action/'+action+'?token='+token+'&key='+rand_val(30),{
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
                collapse_box('#tab-identitas-pt .box');
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
                '<div class="alert alert-danger alert-dismissible">'
                +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
                +'  <font><ul style="padding-left:15px"></ul></font>'
                +'</div>'
              );
              $.each(data.errors, function(key, value){
                $('#alert-place font ul').append('<li>'+value+'</li>');
                if (mp != 'jadwal') {
                  $("#"+key).addClass('has-error');
                }
                else{
                  if (key != 'mata_pelajaran') {
                    $("#"+key).addClass('has-error');
                  }
                  else{
                    $("#jadwal_mata_pelajaran").addClass('has-error');
                  }
                }
              });
            }
            else{
              $('#alert-place').prepend(
                '<div class="alert alert-danger alert-dismissible">'
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
                collapse_box('#tab-identitas-pt .box');
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
                collapse_box('#box-content');
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
                '<div class="alert alert-danger alert-dismissible">'
                +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
                +'  <font><ul style="padding-left:15px"></ul></font>'
                +'</div>'
              );
              $.each(data.errors, function(key, value){                
                $('#alert-place font ul').append('<li>'+value+'</li>');                                
                $("#"+key).addClass('has-error');              
              });
            }
            else{
              $('#alert-place').prepend(
                '<div class="alert alert-danger alert-dismissible">'
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
                '<div class="alert alert-danger alert-dismissible">'
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
      eve.preventDefault();
      
      $('#form-input,form').find('.has-error').removeClass('has-error');
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

      $.ajax(hostProtocol + '//'+host+controller_path+'/action/'+action+'?token='+token+'&key='+rand_val(30),{
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
              '<div class="alert alert-info alert-dismissible">'
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
              $('.modal').find('.has-error').removeClass('has-error');                            
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
                '<div class="alert alert-danger alert-dismissible">'
                +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
                +'  <font><ul style="padding-left:15px"></ul></font>'
                +'</div>'
              );
              $.each(data.errors, function(key, value){
                $('#alert-place font ul').append('<li>'+value+'</li>');
                if (mp != 'jadwal') {
                  $("#"+key).addClass('has-error');
                }
                else{
                  if (key != 'mata_pelajaran') {
                    $("#"+key).addClass('has-error');
                  }
                  else{
                    $("#jadwal_mata_pelajaran").addClass('has-error');
                  }
                }
              });
            }
            else{
              $('#alert-place').prepend(
                '<div class="alert alert-danger alert-dismissible">'
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

    /*Select2 Plugin*/
    $.fn.select2.defaults.set("language","id");
    $(".select2_input_kelas").select2({
      placeholder: "Pilih kelas",
    });

    $(".select2_agama").select2({
      placeholder: "Pilih agama",
    });

    $(".select2_jns_tinggal").select2({
      placeholder: "Pilih jenis tinggal",      
    });

    $(".select2_alt_trans").select2({
      placeholder: "Pilih alat transportasi",      
    });

    $(".select2_jenjang_pendi").select2({
      placeholder: "Pilih jenjang pendidikan terakhir",      
    });

    $(".select2_pekerjaan").select2({
      placeholder: "Pilih pekerjaan sekarang",      
    });

    $(".select2_penghasilan").select2({
      placeholder: "Pilih jangkauan penghasilan",      
    });

    $("#select2_tampil_siswa").select2({
      placeholder: "Tampilkan data berdasarkan",      
    });

    $(".select2_status").select2({
      placeholder: "Pilih status perguruan tinggi",      
    });

    $(".select2_bentuk_pendi").select2({
      placeholder: "Pilih bentuk perguruan tinggi",      
    });

    $(".select2_status_milik").select2({
      placeholder: "Pilih status kepemilikan",      
    });

    $(".select2_status_bos").select2({
      placeholder: "Pilih status BOS",      
    });

    $(".select2_waktu_peny").select2({
      placeholder: "Pilih waktu penyelenggaraan",      
    });

    $(".select2_sertifikat_iso").select2({
      placeholder: "Pilih status sertifikasi ISO",      
    });

    $(".select2_status_ptk").select2({
      placeholder: "Pilih status tenaga pendidik",      
    });

    $(".select2_status_aktif_ptk").select2({
      placeholder: "Pilih status keaktifan tenaga pendidik",      
    });

    $(".control-panel-data-tbl .select2_status_aktif_ptk").select2({
      placeholder: "Pilih status keaktifan tenaga pendidik",
      allowClear: true
    });

    $(".select2_jenis_ptk").select2({
      placeholder: "Pilih jenis PTK",
    });

    $(".select2_kategori").select2({
      placeholder: "Pilih kategori perguruan tinggi",      
    });

    $(".select2_jenjang").select2({
      placeholder: "Pilih jenjang",      
    });

    $(".select2_kompetensi").select2({
      placeholder: "Pilih kompetensi",      
    });

    $(".select2_kode_mp").select2({
      placeholder: "Pilih kode mata pelajaran",      
    });

    $(".select2_hari").select2({
      placeholder: "Pilih hari",      
    });

    $(".select2_semester").select2({
      placeholder: "Pilih semester",      
    });

    $(".select2_akreditasi_fk").select2({
      placeholder: "Pilih akreditasi fakultas",      
    });

    $(".select2_jenjang").select2({
      placeholder: "Pilih jenjang program studi",      
    });

    $(".select2_akreditasi_prodi").select2({
      placeholder: "Pilih akreditasi program studi",      
    });

    $(".select2_status_prodi").select2({
      placeholder: "Pilih status program studi",      
    });

    $(".select2_smstr").select2({
      placeholder: "Pilih tahun semester",
    });

    $(".select2_semester").select2({
      placeholder: "Pilih semester",
    });

    $(".select2_kelas").select2({
      placeholder: "Pilih kelas",
    });

    $(".select2_jenismk").select2({
      placeholder: "Pilih mata kuliah umum/konsentrasi",
    });

    $(".select2_tamp").select2({
      placeholder: "Pilih jumlah data yang ditampilkan",
      minimumResultsForSearch:-1,
    });

    $(".select2_status_menu").select2({
      placeholder: "Pilih status menu",
      minimumResultsForSearch:-1,
    });

    $(".select2_lvl_access_menu").select2({
      placeholder: "Pilih akses menu",
      minimumResultsForSearch:-1,
    });

    $(".select2_status_access_menu").select2({
      placeholder: "Pilih status akses menu",
      minimumResultsForSearch:-1,
    });

    $(".select2_status_access_sub_menu").select2({
      placeholder: "Pilih status akses sub menu",
      minimumResultsForSearch:-1,
    });

    $(".select2_app_environment").select2({
      placeholder: "Pilih status aplikasi",
      minimumResultsForSearch:-1,
    });

    $(".select2_data").select2({
      placeholder: "Pilih data yang ditampilkan",
      minimumResultsForSearch:-1,
      templateResult: function formatselect(state){
        var icon;
        if (state.id == 0) {
          icon = 'fa-graduation-cap';
        }
        else if (state.id == 1) {
          icon = 'fa-user-times';
        }
        return $("<p style='margin-bottom:0px'><i class='fa "+icon+"'></i> "+state.text+"</p>");
      },
    });

    $(".select2_browser").select2({
      placeholder: "Pilih browser",
      minimumResultsForSearch:-1,
      allowClear: true,
      templateResult: function formatselect(state){
        var icon;
        if (state.id == 'Chrome') {
          icon = 'fa-chrome';
        }
        else if (state.id == 'Mozilla') {
          icon = 'fa-firefox';
        }
        else if (state.id == 'Edge') {
          icon = 'fa-edge';
        }
        else if (state.id == 'Internet Explorer') {
          icon = 'fa-internet-explorer';
        }
        else if (state.id == 'Safari') {
          icon = 'fa-apple';
        }
        else if (state.id == 'Opera') {
          icon = 'fa-opera';
        }
        else {
          icon = 'fa-globe';
        }
        return $("<p style='margin-bottom:0px'><i class='fa "+icon+"'></i> "+state.text+"</p>");
      },
    });

    $(".select2_platform").select2({
      placeholder: "Pilih platform",
      minimumResultsForSearch:-1,
      allowClear: true,
      templateResult: function formatselect(state){
        var icon;
        if (state.id == 'Windows') {
          icon = 'fa-windows';
        }
        else if (state.id == 'Linux') {
          icon = 'fa-linux';
        }
        else if (state.id == 'Android') {
          icon = 'fa-android';
        }
        else if (state.id == 'IOS') {
          icon = 'fa-apple';
        }
        else if (state.id == 'MAC OS X') {
          icon = 'fa-apple';
        }
        else {
          icon = 'fa-cube';
        }
        return $("<p style='margin-bottom:0px'><i class='fa "+icon+"'></i> "+state.text+"</p>");
      },
    });

    /*$("#select2_kelas").on("change",function(){
      var val = $("#select2_kelas").val();      
    });*/

    $(".select2_thn_akademik").select2({
      placeholder: "Pilih tahun akademik",      
      ajax: {
        url: hostProtocol + '//'+host+data_master_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          if (path == controller_path+'/data_jadwal_kuliah') {
            return { value: params.term,page:params.page,data:'daftar_thn_akademik',status:'active',csrf_key:token};
          }
          else{
            return { value: params.term,page:params.page,data:'daftar_thn_akademik',status:'all',csrf_key:token};
          }
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.thn_ajaran,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },            
      minimumInputLength: 1,
      allowClear: true,
      templateResult: function formatselect(state){
        if (state.loading) {
          return state.text;
        }
        var vars = state.thn_ajaran_jdl,
        smstr = vars.split('/'),
        thn = smstr[0];
        if (smstr[1] == '1') {
          var semester = 'Ganjil';
        }
        else{
          var semester = 'Genap';
        }
        var $state = $(
          "<p style='margin-bottom:0px'>"+thn+"/"+semester+"</p>"
        );
        if (state.text != undefined) {
          return $state;
        }
      },
    });

    $(".select2_thn_angkatan").select2({
      placeholder: "Pilih Tahun Angkatan",
      ajax: {
        url: hostProtocol + '//'+host+data_master_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_thn_angkatan',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.thn_angkatan,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },      
      minimumInputLength: 1,      
      allowClear: true,
    });

    $(".select2_fk").select2({
      placeholder: "Pilih Fakultas",
      ajax: {
        url: hostProtocol + '//'+host+data_master_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_fk',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.fk,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },      
      minimumInputLength: 1,
    });

    $(".select2_prodi").select2({
      placeholder: "Pilih Program Studi",
      ajax: {
        url: hostProtocol + '//'+host+data_master_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_pd',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.pd,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
        cache: false
      },      
      minimumInputLength: 1,
      allowClear: true,
    });

    $(".select2_mk").select2({
      placeholder: "Pilih mata kuliah",      
      ajax: {
        url: hostProtocol + '//'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 600,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_mk',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.mk,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },            
      minimumInputLength: 1,
      templateResult: function formatselect(state){
        if (path == controller_path+'/data_jadwal_kuliah') {
          if (state.loading) {
            return state.text;
          }
          if (state.nama_prodi == '') {
            var prodi = state.nama_prodi = '-';
          }
          else{
            var prodi = state.nama_prodi+' ('+state.jenjang_prodi+')';
          }
          var $state = $(
            "<p style='margin-bottom:0px'><i class='fa fa-book'></i> "+state.text+"</p>"
            +"<p style='margin-bottom:0px'>Program Studi: "+prodi+"</p>"
            +"<p style='margin-bottom:0px'>Jumlah SKS: "+state.jml_sks+"</p>"
          );
          if (state.text != undefined) {
            return $state;
          }
        }
        /*else{
          if (state.loading) {
            return state.text;
          }          
          var $state = $("<div><i class='fa fa-building-o'></i> "+state.text+"</div>");
          if (state.text != undefined) {
            return $state;
          }
        }*/
      },
    });

    $(".select2_konsentrasi_mk").select2({
      placeholder: "Pilih konsentrasi mata kuliah",      
      ajax: {
        url: hostProtocol + '//'+host+data_master_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          var hs = $.param.fragment();
          if (hs == 'tambah' || hs.search('edit') == 0 && getUrlVars()['mk'] != undefined) {
            var prodi_konst = $('#form-input .select2_prodi').val();
          }
          else if (hs == 'edit') {
            var prodi_konst = $('#form-edit-mk .select2_prodi').val();
          }
          return { value: params.term,page:params.page,data:'daftar_konsentrasi',prodi:prodi_konst,csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.konsentrasi,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },            
      minimumInputLength: 1,
      allowClear: true,
      templateResult: function formatselect(state){
        if (state.loading) {
          return state.text;
        }
        if (state.nama_prodi == '') {
          var prodi = state.nama_prodi = '-';
        }
        else{
          var prodi = state.nama_prodi+' ('+state.jenjang_prodi+')';
        }
        var $state = $(
          "<p style='margin-bottom:0px'><i class='fa fa-book'></i> "+state.detail+"</p>"
          +"<p style='margin-bottom:0px'>Program Studi: "+prodi+"</p>"
        );
        if (state.text != undefined) {
          return $state;
        }
      }
    });

    $(".select2_ptk").select2({
      placeholder: "Pilih dosen",      
      ajax: {
        url: hostProtocol + '//'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 600,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_ptk',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.ptk,
            pagination: {
              more: data.total_data < data.total_count
             }
            };
        },
      },            
      minimumInputLength: 1,
      templateResult: function formatselect(state){
        if (state.loading) {
          return state.text;
        }
        if (state.nama_prodi != '') {
          state.nama_prodi = state.nama_prodi+" ("+state.jenjang_prodi+")";
        }
        else{
          state.nama_prodi = '-';
        }

        if (path == controller_path+'/data_jadwal_kuliah') {
          var $state = $(
            "<div class='row' style='margin-left:0;margin-right:0;'>"
            +"  <div class='col-md-3 col-sm-3 col-xs-3 hidden-phone' style='width:100px;'>"
            +"    <img class='profile-user-img img-responsive img-circle photo-ptk-detail' src='"+state.photo+"' alt='Foto "+state.nama+"' style='width:68px;height:70px;margin-top:10px'>"
            +"  </div>"
            +"  <div class='col-md-9 col-sm-9 col-xs-12' style='padding-left:0'>"
            +"    <table style='margin:5px 0 5px 0'>"
            +"      <tr>"
            +"        <td>NIDN</td>"
            +"        <td>&nbsp:&nbsp</td>"
            +"        <td>"+state.nidn+"</td>"
            +"      </tr>"
            +"      <tr>"
            +"        <td>NAMA</td>"
            +"        <td>&nbsp:&nbsp</td>"
            +"        <td>"+state.nama+"</td>"
            +"      </tr>"
            +"      <tr>"
            +"        <td>Program Studi</td>"
            +"        <td>&nbsp:&nbsp</td>"
            +"        <td>"+state.nama_prodi+"</td>"
            +"      </tr>"
            +"      <tr>"
            +"        <td>Status Keaktifan</td>"
            +"        <td>&nbsp:&nbsp</td>"
            +"        <td>"+state.status_aktif_ptk+"</td>"
            +"      </tr>"
            +"  </table>"
            +"  </div>"
            +"</div>"
            /*"<p style='margin-bottom:0px'><i class='fa fa-user'></i> "+state.nama+"</p>"
            +"<p style='margin-bottom:0px'>NIDN: "+state.nidn+"</p>"
            +"<p style='margin-bottom:0px'>Program Studi: "+state.nama_prodi+"</p>"*/
          );
        }
        else if (path == controller_path+'/data_ptk') {
          var $state = $(
            "<div class='row' style='margin-left:0;margin-right:0;'>"
            +"  <div class='col-md-3 col-sm-3 col-xs-3 hidden-phone' style='width:100px;'>"
            +"    <img class='profile-user-img img-responsive img-circle photo-ptk-detail' src='"+state.photo+"' alt='Foto "+state.nama+"' style='width:68px;height:70px'>"
            +"  </div>"
            +"  <div class='col-md-9 col-sm-9 col-xs-12' style='padding-left:0'>"
            +"    <table style='margin:5px 0 5px 0'>"
            +"      <tr>"
            +"        <td>NIDN</td>"
            +"        <td>&nbsp:&nbsp</td>"
            +"        <td>"+state.nidn+"</td>"
            +"      </tr>"
            +"      <tr>"
            +"        <td>NAMA</td>"
            +"        <td>&nbsp:&nbsp</td>"
            +"        <td>"+state.nama+"</td>"
            +"      </tr>"
            +"      <tr>"
            +"        <td>Program Studi</td>"
            +"        <td>&nbsp:&nbsp</td>"
            +"        <td>"+state.nama_prodi+"</td>"
            +"      </tr>"
            +"  </table>"
            +"  </div>"
            +"</div>"
            /*"<p style='margin-bottom:0px'><i class='fa fa-user'></i> "+state.nama+"</p>"
            +"<p style='margin-bottom:0px'>NIDN: "+state.nidn+"</p>"
            +"<p style='margin-bottom:0px'>Program Studi: "+state.nama_prodi+"</p>"*/
          );
        }

        if (state.text != undefined) {
          return $state;
        }
      },
    });

    $(".select2_jadwal").select2({
      placeholder: "Pilih tahun akademik",      
      ajax: {
        url: hostProtocol + '//'+host+data_master_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_thn_akademik',spec:'daftar_jadwal',csrf_key:token};
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
      allowClear: true,
      templateResult: function formatselect(state){
        if (path == controller_path+'/data_jadwal_kuliah') {
          if (state.loading) {
            return state.text;
          }
          var vars = state.thn_ajaran_jdl,
          smstr = vars.split('/'),
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
      },
    });

    $(".select2_mhs").select2({
      placeholder: "Pilih mahasiswa",
      ajax: {
        url: hostProtocol + '//'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 600,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_mhs',pd:getUrlVars()['kelas_mhs'],act:getUrlVars()['data'],csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.mhs,
            pagination: {
              more: data.total_data < data.total_count
             }
            };
        },
      },            
      minimumInputLength: 1,
      allowClear: true,
      templateResult: function formatselect(state){
        if (state.loading) {
          return state.text;
        }
        var $state = $(
          "<div class='row' style='margin-left:0;margin-right:0;'>"
          +"  <div class='col-md-3 col-sm-3 col-xs-3 hidden-phone' style='width:100px;'>"
          +"    <img class='profile-user-img img-responsive img-circle photo-mhs-detail' src='"+state.photo+"' alt='Foto "+state.nama_mhs+"' style='width:68px;height:70px'>"
          +"  </div>"
          +"  <div class='col-md-9 col-sm-9 col-xs-12' style='padding-left:0'>"
          +"    <table style='margin:5px 0 5px 0'>"
          +"      <tr>"
          +"        <td>NIM</td>"
          +"        <td>&nbsp:&nbsp</td>"
          +"        <td>"+state.nim_mhs+"</td>"
          +"      </tr>"
          +"      <tr>"
          +"        <td>NAMA</td>"
          +"        <td>&nbsp:&nbsp</td>"
          +"        <td>"+state.nama_mhs+"</td>"
          +"      </tr>"
          +"      <tr>"
          +"        <td>Tahun Angkatan</td>"
          +"        <td>&nbsp:&nbsp</td>"
          +"        <td>"+state.tahun_angkatan+"</td>"
          +"      </tr>"
          +"  </table>"
          +"  </div>"
          +"</div>"
          /*"<p style='margin-bottom:0px'>"+state.nim_mhs+" | "+state.nama_mhs+"</p>"*/
        );
        if (state.text != undefined) {
          return $state;
        }
      },
    });

    $(".select2_kls_mhs").select2({
      placeholder: "Pilih kelas",
      ajax: {
        url: hostProtocol + '//'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 600,
        data: function(params){
          if (path == controller_path+'/data_jadwal_kuliah') {
            var id = [];
            if (getUrlVars()['kelas'] == null) {
              $(".check-mhs-kls:checked").each(function() {
                id.push($(this).val());
              });
            }
            return { 
              value: params.term,
              page:params.page,
              data:'daftar_kelas',
              thn:getUrlVars()['kelas'],
              m_thn: id[0],
              csrf_key:token
            };
          }
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.kls,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },            
      minimumInputLength: 1,
      allowClear: true,
      templateResult: function formatselect(state){
        if (path == controller_path+'/data_jadwal_kuliah') {
          if (state.loading) {
            return state.text;
          }
          var jns = state.jns;
          if (jns == 0) {
            jns = '';
          }
          else{
            jns = ' (Konsentrasi '+jns+')';
          }
          var $state = $(
            /*"<p style='margin-bottom:0px'>"+state.semester+"/"+state.kelas+" "+state.mk+""+jns+"</p>"*/
            "<p class=><div class='pull-left'><i class='fa fa-building-o'></i> "+state.semester+"/"+state.kelas+" </div><div class='pull-right'><i class='fa fa-group' title='Jumlah mahasiswa kelas "+state.semester+"/"+state.kelas+"'></i> "+state.jml_mhs+" <i class='fa fa-male' title='Jumlah mahasiswa laki-laki kelas "+state.semester+"/"+state.kelas+"'></i> "+state.jml_lk+" <i class='fa fa-female' title='Jumlah mahasiswa perempuan kelas "+state.semester+"/"+state.kelas+"'></i> "+state.jml_pr+"</div></p>"
            +"<p class='' style='clear:both'>Mata Kuliah: "+state.mk+""+jns+"</p>"
          );
          if (state.text != undefined) {
            return $state;
          }
        }
      },
    });

    $(".select2_nilai_mhs").select2({
      placeholder: "Masukkan NIM Mahasiswa",      
      allowClear:true,
      ajax: {
        url: hostProtocol + '//'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 600,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_nilai_mhs',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.nilai_mhs,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },            
      minimumInputLength: 1,
      templateResult: function formatselect(state){
        if (state.loading) {
          return state.text;
        }
        if (state.nama_prodi == '') {
          state.nama_prodi = '-';
        }
        var $state = $(
          "<p style='margin-bottom:0px'><i class='fa fa-user'></i> NIM: "+state.nim_mhs+"</p>"
          +"<p style='margin-bottom:0px'>Nama: "+state.nama_mhs+"</p>"
          +"<p style='margin-bottom:0px'>Tahun Akademik: "+state.thn_akademik+"</p>"
        );
        if (state.text != undefined) {
          return $state;
        }
      },
    });

    $(".select2_tbl_db").select2({
      placeholder: "Pilih tabel database",      
      allowClear:true,
      ajax: {
        url: hostProtocol + '//'+host+data_dashboard_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,csrf_key:token,data:'list_table_db'};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.list_tbl,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },
    });

    $(".select2_browser_rd").select2({
      placeholder: "Pilih browser",      
      allowClear:true,
      minimumResultsForSearch:-1,
      ajax: {
        url: hostProtocol + '//'+host+data_pengguna_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_browser',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.browser,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },
      templateResult: function formatselect(state){
        if (state.loading) {
          return state.text;
        }
        var $state = $("<p style='margin-bottom:0px'><i class='fa "+state.icon+"'></i> "+state.text+"</p>");
        if (state.text != undefined) {
          return $state;
        }
      }
    });

    $(".select2_platform_rd").select2({
      placeholder: "Pilih platform",      
      allowClear:true,
      minimumResultsForSearch:-1,
      ajax: {
        url: hostProtocol + '//'+host+data_pengguna_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_platform',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.platform,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },
      templateResult: function formatselect(state){
        if (state.loading) {
          return state.text;
        }
        var $state = $("<p style='margin-bottom:0px'><i class='fa "+state.icon+"'></i> "+state.text+"</p>");
        if (state.text != undefined) {
          return $state;
        }
      }
    });

    $(".select2_parent_menu").select2({
      placeholder: "Masukkan nama menu",      
      allowClear:true,
      ajax: {
        url: hostProtocol + '//'+host+data_dashboard_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 600,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_menu',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.menu,
            /*pagination: {
              more: (params.page*3) < data.total_count
             }*/
            };
        },
      },            
      minimumInputLength: 1,
      templateResult: function formatselect(state){
        if (state.loading) {
          return state.text;
        }
        var $state = $(
          "<p style='margin-bottom:0px'>Nama Menu: <i class='"+state.icon+"'></i> "+state.text+"</p>"
          +"<p style='margin-bottom:0px'>Level Menu: "+state.level+"</p>"
          +"<p style='margin-bottom:0px'>Status: "+state.status+"</p>"
        );
        if (state.text != undefined) {
          return $state;
        }
      },
    });

    $(".select2_thn_akademik").on('change', function(){
      if (path == controller_path+'/data_thn_akademik') {
        if ($(this).val()) {
          thn_akademik_chart($(this).val());
        }
      }
    });
    $(".select2_tbl_db").on('change', function(){
      if ($(this).val() != null) {
        $('.backup_db_tbl, #backup-tbl-db-btn').removeClass('disabled');
      }
      else{
        $('.backup_db_tbl, #backup-tbl-db-btn').addClass('disabled');
      }
    });
    $(".select2_lvl_access_menu").on('change', function(){
      if ($(this).val() == 'admin') {
        $('label[for=link_menu]').text('Link Menu : '+admin_url+$('#form-input-menu input.link_menu').val());
        $('label[for=link_menu]').siblings('p.link_preview').text('Link: '+admin_url+$('#form-input-menu input.link_menu').val());
      }
      else if ($(this).val() != '') {
        $('label[for=link_menu]').text('Link Menu : '+base_url+$('#form-input-menu input.link_menu').val());
        $('label[for=link_menu]').siblings('p.link_preview').text('Link: '+base_url+$('#form-input-menu input.link_menu').val());
      }
      else{
        $('label[for=link_menu]').text('Link Menu');
        $('label[for=link_menu]').siblings('p.link_preview').text('');
      }
    });

    $(".select2_platform, .select2_browser").on('change', function(){
      if ($(".select2_platform").val() != '' || $(".select2_browser").val() != '') {
        $('#tamp-data').removeClass('disabled');
      }
      else{
        $('#tamp-data').addClass('disabled');
      }
    });
    /*END -- Select2 Plugin*/

    /*ICheck Plugin*/
    $('.L').on('ifClicked', function(eve){
      $('.L').val(this.value);
    });
    $('.P').on('ifClicked', function(eve){
      $('.P').val(this.value);
    });
    $('.form-group .backup_db').on('ifClicked', function(eve){
      $(this).val(this.value);
    });
    $('input[type="radio"]').iCheck({
      radioClass: 'iradio_flat-blue'
    });
    $('input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue'
    });

    $(document).on('ifChecked','.check-all-data', function(){
      var class_selected = $(this).attr('data-selected'),
      class_all_selected = $(this).attr('data-all-selected');
      $('.'+class_selected).iCheck('check');
      $('.'+class_all_selected).iCheck('check');
    });
    $(document).on('ifUnchecked','.check-all-data', function(){
      var class_selected = $(this).attr('data-selected'),
      class_all_selected = $(this).attr('data-all-selected'),
      class_toggle = $(this).attr('data-toggle');
      $('.'+class_selected).iCheck('uncheck');
      $('.'+class_all_selected).iCheck('uncheck');
      $(class_toggle).addClass('disabled');
    });
    $(document).on('ifChecked','.check-data', function(){
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
    $(document).on('ifUnchecked','.check-data', function(){
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
    /*END -- ICheck Plugin*/

    $(document).on('click','#delete-selected',function(eve){
      eve.preventDefault();
      var id = [],
      data = $('#data').attr('name'),
      btn_act = $(this).find('li');
      btn_act.removeClass('fa-trash').addClass('fa-circle-o-notch fa-spin');
      if (path == controller_path+'/data_mahasiswa') {
        var id_ortu = [];
        $(".check-siswa:checked").each(function() {
          if ($(this).val() != '') {
            var vars = $(this).val(),
            id_dt = vars.split(' ');
            id.push(id_dt[0]);
            id_ortu.push(id_dt[1]);
          }
        });
        var selected_data = id.length;
        if (selected_data > 0) {
          var hapus = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/delete',{id:id,id_ortu:id_ortu,data:'data_mhs'},1000);
          hapus.then(function(hapus){
            if (hapus.status =='success') {
              if ($('#box-detail-mhs').is(':visible')) {
                $.each(hapus.delete_id, function(index,in_mhs){
                  if ($('#box-detail-mhs').is(':hidden')) {
                    return true;
                  }
                  if (in_mhs == $('#box-detail-mhs').attr('data-search')) {
                    $('#box-detail-mhs').slideUp();
                  }
                });
              }
              $('#myModal').modal('hide');
              $('.tbl-data-mhs').DataTable().ajax.reload();
            }
          });
        }
      }
      else if (path == controller_path+'/data_ptk') {
        $(".check-guru:checked").each(function() {
          if ($(this).val() != '') {
            id.push($(this).val());
          }
        });
        var selected_data = id.length;
        if (selected_data > 0) {
          var hapus = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/delete',{id:id,data:'data_ptk'},1000);
          hapus.then(function(hapus){
            if (hapus.status =='success') {
              if ($('#box-ptk').is(':visible')) {
                $.each(hapus.delete_id, function(index,in_ptk){
                  if ($('#box-ptk').is(':hidden')) {
                    return true;
                  }
                  if (in_ptk == $('#box-ptk').attr('data-search')) {
                    $('#box-ptk').slideUp();
                  }
                });
              }
              $('#myModal').modal('hide');
              $('.tbl-data-ptk').DataTable().ajax.reload();
            }
          });
        }
      }
      else if (path == controller_path+'/data_fakultas_pstudi') {
        if (getUrlVars() == 'fk') {
          $(".check-fk:checked").each(function() {
            if ($(this).val() != '') {
              id.push($(this).val());
            }
          });
          var selected_data = id.length;
          if (selected_data > 0) {
            var hapus = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/delete',{id:id,data:'data_fakultas'},1000);
            hapus.then(function(hapus){
              if (hapus.status =='success') {
                $('.tbl-data-fk').DataTable().ajax.reload();
                if ($('#box-detail-fk').is(':visible')) {
                  $('#box-detail-fk').slideUp();
                }
                $('#myModal').modal('hide');
              }
            });
          }
        }
        else if (getUrlVars() == 'pd') {
          $(".check-prodi:checked").each(function() {
            if ($(this).val() != '') {
              id.push($(this).val());
            }
          });
          var selected_data = id.length;
          if (selected_data > 0) {
            var hapus = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/delete',{id:id,data:'data_prodi'},1000);
            hapus.then(function(hapus){
              if (hapus.status =='success') {
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
                  data_detail_fk(hapus.data);
                }
                $('#myModal').modal('hide');
              }
            });
          }
        }
      }
      else if (path == controller_path+'/data_mata_kuliah') {
        $(".check-mk:checked").each(function() {
          if ($(this).val() != '') {
            id.push($(this).val());
          }
        });
        var selected_data = id.length;
        if (selected_data > 0) {
          var hapus = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/delete',{id:id,data:'data_mk'},1000);
          hapus.then(function(hapus){
            if (hapus.status =='success') {
              $('.check-all-mk').iCheck('uncheck');
              $('.hapus').addClass('disabled');
              $('.box-daftar-mk').fadeIn('slow');
              $('html, body').animate({scrollTop:$('.box-daftar-mk').offset().top},800);
              daftar_mk($('.box-daftar-mk').attr('data-search'));
              $('#myModal').modal('hide');
            }
          });
        }
      }
      else if (path == controller_path+'/data_jadwal_kuliah') {
        if (getUrlVars()['data'] == 'jadwal') {
          $(".check-jadwal:checked").each(function() {
            if ($(this).val() != '') {
              id.push($(this).val());
            }
          });
          var selected_data = id.length;
          if (selected_data > 0) {
            var hapus = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/delete',{id:id,data:'data_jadwal_kuliah'},1000);
            hapus.then(function(hapus){
              if (hapus.status=='success') {
                if (hapus.thn != '') {
                  var thn = hapus.thn+' '+hapus.pd;
                  daftar_jadwal(thn,true);
                }
                else{
                  $('.tbl-daftar-jadwal').DataTable().ajax.reload();
                  $('#box-jadwal').slideUp();
                  $('#box-content').find('div.overlay').fadeIn();
                  $(document).bind('ajaxComplete', function(){          
                    $('#box-content').find('div.overlay').fadeOut();                  
                  });
                }
                $('#myModal').modal('hide');
              }
            });
          }
        }
        else if (getUrlVars()['data'] == 'kls_mhs') {
          $(".check-mhs-kls:checked").each(function() {
            if ($(this).val() != '') {
              id.push($(this).val());
            }
          });
          var selected_data = id.length;
          if (selected_data > 0) {
            var hapus = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/delete',{id:id,kelas:getUrlVars()['kls_mhs'],data:'data_mhs_kls'},1000);
            hapus.then(function(hapus){
              if (hapus.status=='success') {
                $('#box-kelas-mhs').find('div.overlay').fadeIn();
                daftar_kelas_mhs(/*null,hapus.record_mhs,*/hapus.c_kls);
                $('#box-kelas-mhs').find('div.overlay').fadeOut();
                $('#myModal').modal('hide');
              }
            });
          }
        }
      }
      else if (path == controller_path+'/data_alumni_do') {
        $(".check-mhs-dt:checked").each(function() {
          if ($(this).val() != '') {
            id.push($(this).val());
          }
        });
        if ($('.select2_data').val() == 0) {
          var data_detail = 'alumni',
          select_data = 0;
          data = 'data_alumni';
        }
        else if ($('.select2_data').val() == 1) {
          var data_detail = 'mhs_do',
          select_data = 1;
          data = 'data_mhs_do';
        }
        var selected_data = id.length;
        if (selected_data > 0) {
          var hapus = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/delete',{id:id,data:data},1000);
          hapus.then(function(hapus){
            if (hapus.status =='success') {
              if ($('#box-detail-mhs').is(':visible')) {
                $.each(hapus.delete_id, function(index,in_mhs){
                  if ($('#box-detail-mhs').is(':hidden')) {
                    return true;
                  }
                  if (in_mhs == $('#box-detail-mhs').attr('data-search') && $('#box-detail-mhs').attr('data-detail') == data_detail) {
                    $('#box-detail-mhs').slideUp();
                  }
                });
              }
              $('#myModal').modal('hide');
              $('#box-content').find('div.overlay').fadeIn();
              if ($('.select2_data').val() == select_data) {
                $('.tbl-data-alumni-do').DataTable().ajax.reload();
              }
            }
          });
        }
      }

      if (selected_data != undefined && selected_data < 1) {
        $('#alert-place').html(
          '<div class="alert alert-danger alert-dismissible">'
          +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
          +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
          +'  <font>Silahkan pilih data yang ingin dihapus</font>'
          +'</div>'
        );
      }
      if (hapus != undefined) {
        hapus.then(function(data){
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

    $(document).on('click','#pindah-kelas',function(eve){
      eve.preventDefault();
      $('#alert-place').text('');
      var id = [];
      var btn_act = $(this).find('li');
      btn_act.removeClass('fa-pencil-square').addClass('fa-circle-o-notch fa-spin');
      if (path == controller_path+'/data_mahasiswa') {
        var pd = $('#form-pindah-kelas select[name=id_pd_mhs]').val();
        $(".check-siswa:checked").each(function() {
          if ($(this).val() != '') {
            id.push($(this).val());
          }
        });
        var selected_data = id.length;
        if (selected_data > 0) {
          var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/update_pd',{id:id,pd:pd},500);
          data.then(function(pindah_pd){
            if (pindah_pd.status =='success') {
              $('#myModal').modal('hide');
              $('.check-all-siswa').iCheck('uncheck');
              $('#box-siswa').find('div.overlay').fadeIn();
              $('.tbl-data-mhs').DataTable().ajax.reload();
              $('#box-siswa').find('div.overlay').fadeOut();
              $('.aksi').addClass('disabled');
              swal({
                title:'Data Berhasil Di Update',
                type:'success',
                timer: 2000
              });
            }
            else if (pindah_pd.status == 'failed_db'){
              $('#alert-place').prepend(
                '<div class="alert alert-danger alert-dismissible">'
                +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
                +'  <font>Maaf terjadi kesalahan dalam memindahkan program studi mahasiswa</font>'
                +'</div>'
              );
            }
            else{
              $('#alert-place').prepend(
                '<div class="alert alert-danger alert-dismissible">'
                +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
                +'  <font>'+pindah_pd.error_message+'</font>'
                +'</div>'
              );
            }
          });
        }
      }
      else if (path == controller_path+'/data_jadwal_kuliah') {
        $(".check-mhs-kls:checked").each(function() {
          if ($(this).val() != '') {
            id.push($(this).val());
          }
        });
        var selected_data = id.length;
        if (selected_data > 0) {
          var kls_mhs = $('#form-pindah-kelas .select2_kls_mhs').val(),
          data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/update',{id:id,update_kelas:'data_mhs_kls',kls_mhs:kls_mhs,c_kls:getUrlVars()['kls_mhs']},500);
          data.then(function(update_kelas){
            if (update_kelas.status=='success') {
              $('#box-kelas-mhs').find('div.overlay').fadeIn();
              daftar_kelas_mhs(update_kelas.c_kls);
              $('#box-kelas-mhs').find('div.overlay').fadeOut();
              $('#myModal').modal('hide');
              swal({
                title:'Data Berhasil Di Update',
                type:'success',
                timer: 2000
              });
            }
            else{
              $('#alert-place').prepend(
                '<div class="alert alert-danger alert-dismissible">'
                +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
                +'  <font></font>'
                +'</div>'
              );
              if (update_kelas.errors != '') {
                $.each(update_kelas.errors, function(key, value){
                  $('#alert-place font').append('<li>'+value+'</li>');
                });
              }
              else{
                $('#alert-place font').append('<li>Maaf terjadi kesalahan ketika mengupdate data!</li>');
              }
            }
          });
        }
      }

      if (selected_data != undefined && selected_data < 1) {
        $('#alert-place').html(
          '<div class="alert alert-danger alert-dismissible">'
          +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
          +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
          +'  <font>Silahkan pilih data yang ingin diupdate</font>'
          +'</div>'
        );
      }
      if (data != undefined) {
        data.then(function(){
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
        }).catch(function(){
          btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
        });
      }
    });

    /*Boostrap File-Select*/
    $('.file-select-foto').fileinput({
      'showUpload':false,
      'browseClass':'btn btn-info',
      'browseLabel':'Pilih Berkas',
      'browseIcon':'<li class="fa fa-folder-open"></li>',
      'uploadClass':'btn btn-success',
      'uploadIcon':'<li class="fa fa-upload"></li>',
      'removeLabel':'Hapus',
      'removeClass':'btn btn-danger',
      'removeIcon':'<li class="fa fa-trash"></li>',
      'cancelIcon':'<li class="fa fa-ban"></li>',
      'allowedFileExtensions': ['jpg','jpeg','png'],
      'autoReplace':true,
      'maxFileCount':1,
      'maxFileSize':1024,
      'language':'id',
      'uploadUrl': hostProtocol + "//" +host+controller_path+"/upload_file",
      'uploadAsync':true,
      'showPreview':true,
      'elErrorContainer':'.validation-ft-inp',
    });
    $('.file-select-foto, #file-select-logo-pt, #file-select-image-template').on('fileclear', function(){
      $(this).parents().find('.fileinput-remove-button').hide();
      $('#myModal .new-photo-file-name').text('Nama File: -');
      $('#myModal .new-photo-usr').attr('src',$('#myModal .new-photo-usr').attr('default-photo'));
    });
    $('.file-select-foto').on('change', function(){
      $(this).parents().find('.fileinput-remove-button').show();
    });
    $('.file-select-foto').on('fileloaded', function(eve,file,prevID,index,reader){
      $('#myModal .new-photo-usr').attr('src',reader['result']);
      if (file != '') {
        var file_type = file['type'].split('/');
        if (file['size'] <= 1024000 && file_type[1] == 'jpeg' || file['size'] <= 1024000 && file_type[1] == 'jpg' || file['size'] <= 1024000 && file_type[1] == 'png') {
          $('#myModal .new-photo-file-name').text('Nama File: '+file['name']);
          var hash = $.param.fragment();
          if (hash.search('edit') == 0) {
            if (path.search('admin/data_akademik/data_mahasiswa') > 0) {
              $(this).fileinput('refresh',{
                'showUpload':true,
                'uploadExtraData':{
                  'data':getUrlVars()['mhs'],
                  'pt':'mhs',
                  'upload_act':'singleUpload',
                  'csrf_key':token
                },
              });
            }
            else if (path.search('admin/data_akademik/data_ptk') > 0) {
              $(this).fileinput('refresh',{
                'showUpload':true,
                'uploadExtraData':{
                  'data':getUrlVars()['ptk'],
                  'pt':'ptk',
                  'upload_act':'singleUpload',
                  'csrf_key':token
                },
              });
            }
          }
          else{
            $(this).fileinput('refresh',{
              'showUpload':false,
            });
          }
        }
        else{
          $(this).parents().find('.fileinput-remove-button').hide();
          $('.file-select-foto').fileinput('clear');
        }
      }
      else{
        $(this).parents().find('.fileinput-remove-button').hide();
        $(this).fileinput('clear');
      }
    });
    $('.file-select-foto').on('fileuploaded', function(eve,data){
      if (data.extra.upload_act != null) {
        if (data.response.status == 'success') {
          if (data.response.photo_c != null && data.response.file_name != null) {
            $('#form-input .photo-usr-edit-n').attr('src',data.response.photo_c);
            $('#form-input .photo-file-name').text('Nama File: '+data.response.file_name);
            $('#form-input .remove-photo').show();
          }
          $(this).fileinput('enable').fileinput('refresh').fileinput('clear');
        }
        else{
          $('#alert-place').html(
            '<div class="alert alert-danger alert-dismissible">'
            +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
            +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
            +'  <font><ul style="padding-left:15px">'+data.response.errors+'</ul></font>'
            +'</div>'
          );
          $(this).parents().find('.fileinput-upload-button').replaceWith('');
        }
      }
      else{
        $(this).fileinput('enable').fileinput('refresh').fileinput('clear');
      }
      token = data.response.n_token;
    });
    $('.file-select-foto').on('fileuploaderror', function(eve,data,msg){
      /*console.log(data);
      console.log(msg);*/
      $('#myModal .validation-ft-inp').hide();
      if (data.jqXHR.readyState == 4) {
        $('#alert-place').html(
          '<div class="alert alert-danger alert-dismissible">'
          +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
          +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
          +'  <font><ul style="padding-left:15px"><li>Terjadi kesalahan pada server saat proses upload photo.</li></ul></font>'
          +'</div>'
        );
      }
      else{
        $(this).parents().find('.fileinput-remove-button').show();
        $(this).parents().find('.fileinput-upload-button').replaceWith('');
        $('#alert-place').html(
          '<div class="alert alert-danger alert-dismissible">'
          +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
          +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
          +'  <font><ul style="padding-left:15px"><li>'+msg+'</li></ul></font>'
          +'</div>'
        );
      }
    });

    $('#file-select-logo-pt').fileinput({
      'browseClass':'btn btn-info',
      'browseLabel':'Pilih Berkas',
      'browseIcon':'<li class="fa fa-folder-open"></li>',
      'uploadClass':'btn btn-success',
      'uploadIcon':'<li class="fa fa-upload"></li>',
      'removeLabel':'Hapus',
      'removeClass':'btn btn-danger',
      'removeIcon':'<li class="fa fa-trash"></li>',
      'cancelIcon':'<li class="fa fa-ban"></li>',
      'allowedFileExtensions': ['png'],
      'autoReplace':true,
      'maxFileCount':1,
      'maxFileSize':1024,
      'language':'id',
      'uploadUrl': hostProtocol + "//" +host+data_dashboard_path+"/upload_file",
      'uploadAsync':true
    });
    $('#file-select-logo-pt').on('fileloaded', function(eve,file,prevID,index,reader){
      var file_type = file['type'].split('/');
      if (file != '' && file['size'] <= 1024000 && file_type[1] == 'png') {
        $(this).fileinput('refresh',{
          'showUpload':true,
          'uploadExtraData':{
            'file_type': 'image',
            'data':'logo-pt',
            'upload_act':'singleUpload',
            'csrf_key':token
          },
        });
      }
      else{
        $(this).parents().find('.fileinput-upload-button').replaceWith('');
      }
    });
    $('#file-select-logo-pt').on('fileuploaded', function(eve,data){
      if (data.response.status == 'success') {
        swal({
          title:'Berhasil',
          html: 'Update Logo Perguruan Tinggi Berhasil',
          type:'success'
        });
        $('.logo-pt-element').attr('src',data.response.new_logo_pt);
      }
      else{
        swal({
          title:'Validasi Gagal!',
          html: data.response.errors,
          type:'error'
        });
      }
      token = data.response.n_token;
      $(this).fileinput('enable').fileinput('refresh').fileinput('clear');
    });
    $('#file-select-logo-pt').on('fileuploaderror', function(eve,data,msg){
      if (data.jqXHR.readyState == 4) {
      }
      else{
        $(this).parents().find('.fileinput-remove-button').show();
        $(this).parents().find('.fileinput-upload-button').replaceWith('');
        swal({
          title:'Validasi Gagal!',
          html: msg,
          type:'error'
        });
      }
    });

    $('#file-select-image-template').fileinput({
      'browseClass':'btn btn-info',
      'browseLabel':'Pilih Berkas',
      'browseIcon':'<li class="fa fa-folder-open"></li>',
      'uploadClass':'btn btn-success',
      'uploadIcon':'<li class="fa fa-upload"></li>',
      'removeLabel':'Hapus',
      'removeClass':'btn btn-danger',
      'removeIcon':'<li class="fa fa-trash"></li>',
      'cancelIcon':'<li class="fa fa-ban"></li>',
      'allowedFileExtensions': ['jpeg','jpg','png'],
      'autoReplace':true,
      'maxFileCount':1,
      'maxFileSize':2024,
      'language':'id',
      'uploadUrl': hostProtocol + "//" +host+data_dashboard_path+"/upload_file",
      'uploadAsync':true
    });
    $('#file-select-image-template').on('fileloaded', function(eve,file,prevID,index,reader){
      if (file != '') {
        var file_type = file['type'].split('/');
        if (file['size'] <= 2024000 && file_type[1] == 'jpeg' || file['size'] <= 2024000 && file_type[1] == 'jpg' || file['size'] <= 2024000 && file_type[1] == 'png') {
          var hash = $.param.fragment();
          if (hash.search('edit') == 0) {
            $(this).fileinput('refresh',{
              'showUpload':true,
              'uploadExtraData':{
                'file_type': 'image',
                'in_template': getUrlVars()['in_template'],
                'data':'template-image',
                'upload_act':'singleUpload',
                'act':'update',
                'csrf_key':token
              },
            });
          }
          else{
            $(this).fileinput('refresh',{
              'showUpload':false,
            });
          }
        }
        else{
          $(this).parents().find('.fileinput-remove-button').hide();
          $('.file-select-foto').fileinput('clear');
        }
      }
      else{
        $(this).parents().find('.fileinput-remove-button').hide();
        $(this).fileinput('clear');
      }
    });
    $('#file-select-image-template').on('fileuploaded', function(eve,data){
      if (data.extra.upload_act != null) {
        if (data.response.status == 'success') {
          $(this).fileinput('enable').fileinput('refresh').fileinput('clear');
          if (data.response.act == 'update') {
            get_list_template();
          }
        }
        else{
          $('#alert-place').html(
            '<div class="alert alert-danger alert-dismissible">'
            +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
            +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
            +'  <font><ul style="padding-left:15px">'+data.response.errors+'</ul></font>'
            +'</div>'
          );
          $(this).parents().find('.fileinput-upload-button').replaceWith('');
        }
      }
      else{
        $(this).fileinput('enable').fileinput('refresh').fileinput('clear');
      }
      token = data.response.n_token;
    });
    $('#file-select-image-template').on('fileuploaderror', function(eve,data,msg){
      if (data.jqXHR.readyState == 4) {
        $('#alert-place').html(
          '<div class="alert alert-danger alert-dismissible">'
          +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
          +'  <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>'                
          +'  <font><ul style="padding-left:15px"><li>Terjadi kesalahan pada server saat proses upload photo.</li></ul></font>'
          +'</div>'
        );
      }
      else{
        $(this).parents().find('.fileinput-remove-button').show();
        $(this).parents().find('.fileinput-upload-button').replaceWith('');
        $('#alert-place').html(
          '<div class="alert alert-danger alert-dismissible">'
          +'  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
          +'  <h4><i class="icon fa fa-ban"></i> Validasi Gagal!</h4>'                
          +'  <font><ul style="padding-left:15px"><li>'+msg+'</li></ul></font>'
          +'</div>'
        );
      }
    });

    $(document).on('click','.kv-error-close', function(eve){
      eve.preventDefault();
    });
    /*END -- Boostrap File-Select*/

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
        $('input[type="checkbox"]').iCheck({
          /*checkboxClass: 'icheckbox_square-blue',*/
          checkboxClass: 'icheckbox_flat-blue'
        });
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
      var table_box = $(this).attr('table-box');
      if (table_box != undefined) {
        /*$(table_box).find('div.overlay').fadeIn();*/
      }
      /*var loading = $('.datatable-loading-text').text('Memuat Data');
      var i = 0;
      setInterval(function(){
        $('.datatable-loading-text').append(' . ');
        i++;
        if (i == 4) {
          $('.datatable-loading-text').html(loading);
          i = 0;
        }
      },500);*/
      /*var data_checked = $(this).attr('data-checked');
      if (data_checked != undefined) {
        $('.'+data_checked).addClass('hide');
        $('.selected-data-btn[data-selected='+data_checked+']').addClass('bg-light-blue').removeClass('bg-gray').attr('state','0');
        $('.selected-data-btn[data-selected='+data_checked+']').find('li').addClass('fa-check-square').removeClass('fa-times-rectangle-o');
      }*/
    });

    var table_thn_akademik = $('#tbl-thn-akademik').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength":$('.select2_tamp').val(),
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/data_thn_akademik",
        "type" : 'POST',
        "data" : {
          'length' : function(d){
            return $('.select2_tamp').val();
          },
          'search[value]' : function(d){
            return $('.cari-data-tbl').val();
          },
        },
      },
      "order": [[0, 'desc']],
      "columns":[        
        {
          "data": "thn_ajaran_jdl",
        },
        {
          "data": "tgl_ma_ajar",  
          "sClass": "text-center", 
          "orderable": false,       
        },        
        {
          "data": {
            "thn_ajaran_jdl":"thn_ajaran_jdl",
            "jml_mhs":"jml_mhs",
            "jml_mhs_lk":"jml_mhs_lk",
            "jml_mhs_pr":"jml_mhs_pr",
          },  
          "sClass": "text-center", 
          "orderable": false,
          "mRender": function(data,type,full){
            var thn = full.thn_ajaran_jdl,
            jml = full.jml_mhs,
            lk = full.jml_mhs_lk,
            pr = full.jml_mhs_pr;
            return '<li class="fa fa-users" title="Jumlah mahasiswa tahun akademik '+thn+'"></li> '+jml+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki tahun akademik '+thn+'"></li> '+lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan tahun akademik '+thn+'"></li> '+pr+'';
          },
        },
        {
          "data": {
            "id_thn_ak": "id_thn_ak",
            "status_jdl": "status_jdl",
            "status_inp_nilai": "status_inp_nilai",
          },
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var id_thn = full.id_thn_ak,
            status = full.status_jdl,
            status_inp_nilai = full.status_inp_nilai,
            check,check_inp,disabled;
            if (status == 1) {
              check = 'checked';
              disabled = '';
            }
            else if (status != 1) {
              check = '';
              disabled = 'disabled';
            }
            if (status_inp_nilai == 1) {
              check_inp = 'checked';
            }
            else if (status_inp_nilai != 1) {
              check_inp = '';
            }
            return "<input type='checkbox' class='check-status-thn-ajar check-status-thn-ajar-"+id_thn+"' "+check+" value='"+id_thn+"'/> <input type='checkbox' class='check-status-thn-inp check-status-thn-inp-"+id_thn+"' "+check_inp+" "+disabled+" value='"+id_thn+"'/>"
          },
        },
        {
          "data": {
            "id_thn_ak": "id_thn_ak",
            "thn_ajaran_jdl": "thn_ajaran_jdl",
          },
          "sClass": "text-center",          
          "orderable": false,
          "mRender": function(data,type,full){
            var id_thn = full.id_thn_ak,
            thn = full.thn_ajaran_jdl;
            return '<div class="btn-group">'
                  +' <a href="#data?thn_akademik='+thn+'&i='+id_thn+'&token='+token+'" class="btn btn-warning btn-sm detail-data-thn-ak" data-search="'+id_thn+'" title="Lihat mahasiswa yang terdaftar pada tahun akademik '+thn+'"><i class="fa fa-list"></i></a> '
                  +' <a href="#edit?thn_akademik='+thn+'&i='+id_thn+'&token='+token+'" class="btn btn-success btn-sm" title="Edit Data Tahun Akademik '+thn+'"><i class="fa fa-pencil-square"></i></a> '
                  +'</div>'
          }
        }
      ],
      "oLanguage": {
        "sLengthMenu": 'Tampilkan '
                      +'<select class="form-control input-sm" style="width:90px">'
                      +    '<option value="4">4 Data</option>'
                      +    '<option value="10">10 Data</option>'
                      +    '<option value="15">15 Data</option>'
                      +    '<option value="20">20 Data</option>'
                      +'</select>',
      },      
      /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
      "columnDefs": [
        {responsivePriority:1,targets:0},
        {responsivePriority:2,targets:1},
      ],
      "responsive":{
        details:false,
      },
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,      
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",
      "scrollCollapse": false,*/
      "fnDrawCallback": function(){
        $('.check-status-thn-ajar').bootstrapToggle({
          on:'<i class="fa fa-check-circle"></i> Diterapkan',
          off:'<i class="fa fa-ban"></i> Tidak Diterapkan',
          size:'small',
          onstyle:'success',
          offstyle:'danger',
          width: 140,
        });
        $('.check-status-thn-inp').bootstrapToggle({
          on:'<i class="fa fa-check-circle"></i> Input Nilai',
          off:'<i class="fa fa-ban"></i> Input Nilai',
          size:'small',
          onstyle:'success',
          offstyle:'danger',
          width: 140,
        });
      },
      /*"scrollX":true,
      "scroller":true,*/
      "initComplete": function(settings, json) {
        $('body').find('.dataTables_scrollBody').addClass("style-2");
      },
    }).page.len($('.select2_tamp').val());

    var table_thn_angkatan = $('#tbl-thn-angkatan').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength":$('.select2_tamp').val(),
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/data_thn_angkatan",
        "type" : 'POST',
        "data" : {
          'length' : function(d){
            return $('.select2_tamp').val();
          },
          'search[value]' : function(d){
            return $('.cari-data-tbl').val();
          },
        },
      },
      "order": [[0, 'desc']],
      "columns":[        
        {
          "data": "tahun_angkatan",
        },
        {
          "data": "tgl_masuk_angkatan",
          "sClass":"text-center",
        },        
        {
          "data": {
            "tahun_angkatan":"tahun_angkatan",
            "laki_laki":"laki_laki",
            "perempuan":"perempuan",
            "jumlah":"jumlah",
          },
          "sClass":"text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var thn = full.tahun_angkatan,
            jml = full.jumlah,
            lk = full.laki_laki,
            pr = full.perempuan;
            return '<li class="fa fa-users" title="Jumlah mahasiswa tahun angkatan '+thn+'"></li> '+jml+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki tahun angkatan '+thn+'"></li> '+lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan tahun angkatan '+thn+'"></li> '+pr+'';
          },
        },
        {
          "data": {
            "tahun_angkatan": "tahun_angkatan",
            "id_thn_angkatan": "id_thn_angkatan",
          },
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var tahun_angkatan = full.tahun_angkatan
            id = full.id_thn_angkatan;;
            return  '<div class="btn-group">'
                    +' <a href="#data?mhs='+id+'&thn='+tahun_angkatan+'&token='+token+'" class="btn btn-warning btn-sm detail-data-thn-mhs" data-search="'+id+'" title="Lihat Data Mahasiswa Tahun Angkatan '+tahun_angkatan+'"><i class="fa fa-list"></i></a> '
                    +' <a href="#edit?thn='+id+'&token='+token+'" class="btn btn-success btn-sm" title="Edit Data Tahun Angkatan '+tahun_angkatan+'"><i class="fa fa-pencil-square"></i></a> '
                    +'</div>'
          }
        }
      ],
      "oLanguage": {
        "sLengthMenu": 'Tampilkan '
                      +'<select class="form-control input-sm" style="width:90px">'
                      +    '<option value="4">4 Data</option>'
                      +    '<option value="10">10 Data</option>'
                      +    '<option value="15">15 Data</option>'
                      +    '<option value="20">20 Data</option>'                          
                      +'</select>',
      },      
      /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
      "columnDefs": [
        {responsivePriority:1,targets:0},
        {responsivePriority:2,targets:1},
      ],
      "responsive":{
        details:false,
      },
      "pageLength" : 4,
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,      
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",
      "scrollCollapse": false,*/
      "initComplete": function(settings, json) {
        $('body').find('.dataTables_scrollBody').addClass("style-2");
      },
    }).page.len($('.select2_tamp').val());
        
    var table_user = $('#tbl-user').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength":$('.select2_tamp').val(),
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/user_list",
        "type" : 'POST',
        "data" : {
          'user_type' : function(d){
              if (path == controller_path+'/data_pengguna_mahasiswa') {      
                var data_user = 'mhs';
              }
              else if (path == controller_path+'/data_pengguna_ptk') {      
                var data_user = 'ptk';
              }
              return data_user;
            },
            'status_user' : function(d){
              return $('.btn-status-user').attr('data-search');
            },
            'length' : function(d){
              return $('.select2_tamp').val();
            },
            'search[value]' : function(d){
              return $('.cari-data-tbl').val();
            },
        },        
      },
      "order": [[3, 'desc']],
      "columns":[
        /*{
          "className": 'text-center',
          "orderable": false,
          "data": null,
          "defaultContent": '',
          "mRender": function(data,type,full){
            return "<li class='fa fa-plus-circle detail-row' style='font-size:20px' data-search='data-user'></li>"
          }
        },*/
        {
          "data": "username",
        },
        {
          "data": "nama",
          /*"data": "uncrypt_password",          
          "orderable": false,
          "mRender": function(data,type,full){            
            var password = full.uncrypt_password;            */
            /*var password_hide = "<div class='password-cry pull-left'><span class='glyphicon glyphicon-asterisk'></span><span class='glyphicon glyphicon-asterisk'></span><span class='glyphicon glyphicon-asterisk'></span><span class='glyphicon glyphicon-asterisk'></span><span class='glyphicon glyphicon-asterisk'></span><span class='glyphicon glyphicon-asterisk'></span><span class='glyphicon glyphicon-asterisk'></span></div>";*/
            /*return "<div class='pass password-cry pull-left'></div><div class='password pull-left'>"+password+"</div><div class='pull-right show-password' title='Tampilkan password'><span class='glyphicon glyphicon-eye-close'></span><div>"
          },*/
        },        
        /*{
          "data": "level_akses",       
          "orderable": false,
          "mRender": function(data,type,full){            
            var level = full.level_akses;
            if (level == 'mhs') {
              level = 'Mahasiswa';
            }
            else if (level == 'ptk') {
              level = 'Tenaga Pendidik';
            }
            return level
          },
        },*/
        {
          "data": {
            "active_status": "active_status",
            "id_user": "id_user",
          },
          "orderable": false,
          "sClass":'text-center',
          "width": "100px",
          "mRender": function(data,type,full){
            var status = full.active_status,
            id_user = full.id_user;
            if (status == '1') {
              status = 'Aktif';
              check = 'checked';
            }
            else if (status == '0') {
              status = 'Tidak Aktif';
              check = '';
            }
            return "<input type='checkbox' class='check-status-user status-user-"+id_user+"' "+check+" value='"+id_user+"'/>"
          },
        },        
        {
          "data": "last_online",
          "sClass": "text-center",
          "mRender": function(data,type,full){            
            var last_online = full.last_online;
            if (last_online == '0000-00-00 00:00:00') {
              last_online = 'Username belum pernah digunakan';
            }
            else{
              last_online = "<span class='fa fa-clock-o'></span> "+moment(last_online).fromNow();              
            }
            return last_online
          },
        },
        {
          "data": {
            "user_i":"user_i",
            "user_in":"user_in",
            "username":"username",
          },
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var id_user = full.user_i,
            username = full.username;
            return '<button type="button" class="btn btn-success btn-sm change-pass-user" title="Reset password" value="user-'+id_user+'-'+username+'-'+full.user_in+'"><li class="fa fa-key"></li></button>'
          },
        }
      ],
      "fnDrawCallback": function(){
        $('.check-status-user').bootstrapToggle({
          on:'<i class="fa fa-check-circle"></i> Aktif',
          off:'<i class="fa fa-ban"></i> Nonaktif',
          size:'small',
          onstyle:'success',
          offstyle:'danger',
          width: 100,
        });

        $(document).on('change','.check-status-user',function(){
          var status_user = $(this).prop('checked'),
          id = $(this).attr('value'),
          status_u = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/update_status',{id:id,status:status_user,data:'user_active_status'});
          status_u.then(function(status_u){
            if (status_u.status != 'success') {
              if (status_user == true) {
                swal({
                  title:'Akun gagal diaktifkan',
                  type:'error',
                  timer: 2000
                });
                delay(function(){
                  $('.status-user-'+id+'').bootstrapToggle('destroy');
                  $('.status-user-'+id+'').replaceWith("<input type='checkbox' class='check-status-user status-user-"+id+"' value='"+id+"'/>");
                  $('.status-user-'+id+'').bootstrapToggle({
                    on:'<i class="fa fa-check-circle"></i> Aktif',
                    off:'<i class="fa fa-ban"></i> Nonaktif',
                    size:'small',
                    onstyle:'success',
                    offstyle:'danger',
                  });
                },500);
              }
              else {
                swal({
                  title:'Akun gagal dinonaktifkan',
                  type:'error',
                  timer: 2000
                });
                delay(function(){
                  $('.status-user-'+id+'').bootstrapToggle('destroy');
                  $('.status-user-'+id+'').replaceWith("<input type='checkbox' class='check-status-user status-user-"+id+"' checked value='"+id+"'/>");
                  $('.status-user-'+id+'').bootstrapToggle({
                    on:'<i class="fa fa-check-circle"></i> Aktif',
                    off:'<i class="fa fa-ban"></i> Nonaktif',
                    size:'small',
                    onstyle:'success',
                    offstyle:'danger',
                  });
                },500);
              }
            }
          }).catch(function(error){
            if (status_user == true) {
              swal({
                title:'Akun gagal diaktifkan',
                type:'error',
                timer: 2000
              });
              delay(function(){
                $('.status-user-'+id+'').bootstrapToggle('destroy');
                $('.status-user-'+id+'').replaceWith("<input type='checkbox' class='check-status-user status-user-"+id+"' value='"+id+"'/>");
                $('.status-user-'+id+'').bootstrapToggle({
                  on:'<i class="fa fa-check-circle"></i> Aktif',
                  off:'<i class="fa fa-ban"></i> Nonaktif',
                  size:'small',
                  onstyle:'success',
                  offstyle:'danger',
                });
              },500);
            }
            else {
              swal({
                title:'Akun gagal dinonaktifkan',
                type:'error',
                timer: 2000
              });
              delay(function(){
                $('.status-user-'+id+'').bootstrapToggle('destroy');
                $('.status-user-'+id+'').replaceWith("<input type='checkbox' class='check-status-user status-user-"+id+"' checked value='"+id+"'/>");
                $('.status-user-'+id+'').bootstrapToggle({
                  on:'<i class="fa fa-check-circle"></i> Aktif',
                  off:'<i class="fa fa-ban"></i> Nonaktif',
                  size:'small',
                  onstyle:'success',
                  offstyle:'danger',
                });
              },500);
            }
          });
        });
      },
      "oLanguage": {
        "sLengthMenu": 'Tampilkan '
                      +'<select class="form-control input-sm" style="width:90px">'
                      +    '<option value="5">5 Data</option>'
                      +    '<option value="10">10 Data</option>'
                      +    '<option value="15">15 Data</option>'
                      +    '<option value="20">20 Data</option>'                          
                      +'</select>',
      },
      /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
      "columnDefs": [
        {responsivePriority:1,targets:0},
        {responsivePriority:2,targets:1},
      ],
      "responsive":{
        details:false,
      },
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",
      "scrollCollapse": false,*/
      "initComplete": function(settings, json) {
        $('body').find('.dataTables_scrollBody').addClass("style-2");
        /*$(".select2_datatable").select2({
          minimumResultsForSearch:-1,
        });*/
      },
    }).page.len($('.select2_tamp').val());

    var table_pengunjung_mhs = $('.tbl-pengunjung-mhs').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength":$('.select2_tamp').val(),
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/visitor_list",
        "type" : 'POST',
        "data" : {
            'visitor_browser' : function(d){
              if ($('.control-panel-data-tbl .select2_browser').val() != null) {
                return $('.control-panel-data-tbl .select2_browser').find(':selected').val();
              }
              else{
                return '';
              }
            },
            'visitor_platform' : function(d){
              if ($('.control-panel-data-tbl .select2_platform').val() != null) {
                return $('.control-panel-data-tbl .select2_platform').find(':selected').val();
              }
              else{
                return '';
              }
            },
            'visitor': function(){
              return 'mhs';
            },
            'length' : function(d){
              return $('.select2_tamp').val();
            },
            'search[value]' : function(d){
              return $('.cari-data-tbl').val();
            },
        },        
      },
      "order": [[4, 'desc']],
      "columns":[
        {
          "className": 'text-center',
          "orderable": false,
          "data": null,
          "defaultContent": '',
          "mRender": function(data,type,full){
            return "<li class='fa fa-plus-circle detail-row' style='font-size:20px' data-search='data-visitor-mhs'></li>"
          }
        },
        {
          "data": "username",
          "orderable": false,
        },
        {
          "data": "nama",
          "orderable": false,
        },
        {
          "data": {
            "visitor_browser": "visitor_browser",
            "browser_icon": "browser_icon",
          },
          "orderable": false,
          "sClass":'text-center',
          "mRender": function(data,type,full){
            var browser = full.visitor_browser,
            icon = full.browser_icon;
            return "<li class='fa "+icon+"'></li> "+browser;
          },
        },
        /*{
          "data": {
            "visitor_os": "visitor_os",
            "os_icon": "os_icon",
            "visitor_agent": "visitor_agent",
            "device_icon": "device_icon",
          },
          "orderable": false,
          "sClass":'text-center',
          "mRender": function(data,type,full){
            var os = full.visitor_os,
            icon_os = full.os_icon,
            device = full.visitor_agent,
            icon_device = full.device_icon;
            return "<li class='fa "+icon_device+"'></li> "+device+" / "+"<li class='fa "+icon_os+"'></li> "+os;
          },
        },*/
        {
          "data": "visitor_date",
          "sClass": "text-center",
          "mRender": function(data,type,full){            
            var last_online = full.visitor_date;
            if (last_online == '0000-00-00 00:00:00') {
              last_online = 'Username belum pernah digunakan';
            }
            else{
              last_online = "<span class='fa fa-clock-o'></span> "+moment(last_online).fromNow();              
            }
            return last_online
          },
        },
      ],
      "fnDrawCallback": function(){
        $('.check-status-user').bootstrapToggle({
          on:'<i class="fa fa-check-circle"></i> Aktif',
          off:'<i class="fa fa-ban"></i> Nonaktif',
          size:'small',
          onstyle:'success',
          offstyle:'danger',
        });
      },
      "oLanguage": {
        "sLengthMenu": 'Tampilkan '
                      +'<select class="form-control input-sm" style="width:90px">'
                      +    '<option value="5">5 Data</option>'
                      +    '<option value="10">10 Data</option>'
                      +    '<option value="15">15 Data</option>'
                      +    '<option value="20">20 Data</option>'                          
                      +'</select>',
      },
      /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",
      "scrollCollapse": false,*/
      "initComplete": function(settings, json) {
        $('body').find('.dataTables_scrollBody').addClass("style-2");
        /*$(".select2_datatable").select2({
          minimumResultsForSearch:-1,
        });*/
      },
    }).page.len($('.select2_tamp').val());

    var table_pengunjung_ptk = $('.tbl-pengunjung-ptk').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength":$('.select2_tamp').val(),
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/visitor_list",
        "type" : 'POST',
        "data" : {
            'visitor_browser' : function(d){
              if ($('.control-panel-data-tbl .select2_browser').val() != null) {
                return $('.control-panel-data-tbl .select2_browser').find(':selected').val();
              }
              else{
                return '';
              }
            },
            'visitor_platform' : function(d){
              if ($('.control-panel-data-tbl .select2_platform').val() != null) {
                return $('.control-panel-data-tbl .select2_platform').find(':selected').val();
              }
              else{
                return '';
              }
            },
            'visitor': function(){
              return 'ptk';
            },
            'length' : function(d){
              return $('.select2_tamp').val();
            },
            'search[value]' : function(d){
              return $('.cari-data-tbl').val();
            },
        },        
      },
      "order": [[4, 'desc']],
      "columns":[
        {
          "className": 'text-center',
          "orderable": false,
          "data": null,
          "defaultContent": '',
          "mRender": function(data,type,full){
            return "<li class='fa fa-plus-circle detail-row' style='font-size:20px' data-search='data-visitor-ptk'></li>"
          }
        },
        {
          "data": "username",
          "orderable": false,
        },
        {
          "data": "nama",
          "orderable": false,
        },
        {
          "data": {
            "visitor_browser": "visitor_browser",
            "browser_icon": "browser_icon",
          },
          "orderable": false,
          "sClass":'text-center',
          "mRender": function(data,type,full){
            var browser = full.visitor_browser,
            icon = full.browser_icon;
            return "<li class='fa "+icon+"'></li> "+browser;
          },
        },
        /*{
          "data": {
            "visitor_os": "visitor_os",
            "os_icon": "os_icon",
            "visitor_agent": "visitor_agent",
            "device_icon": "device_icon",
          },
          "orderable": false,
          "sClass":'text-center',
          "mRender": function(data,type,full){
            var os = full.visitor_os,
            icon_os = full.os_icon,
            device = full.visitor_agent,
            icon_device = full.device_icon;
            return "<li class='fa "+icon_device+"'></li> "+device+" / "+"<li class='fa "+icon_os+"'></li> "+os;
          },
        },*/
        {
          "data": "visitor_date",
          "sClass": "text-center",
          "mRender": function(data,type,full){            
            var last_online = full.visitor_date;
            if (last_online == '0000-00-00 00:00:00') {
              last_online = 'Username belum pernah digunakan';
            }
            else{
              last_online = "<span class='fa fa-clock-o'></span> "+moment(last_online).fromNow();              
            }
            return last_online
          },
        },
      ],
      "fnDrawCallback": function(){
        $('.check-status-user').bootstrapToggle({
          on:'<i class="fa fa-check-circle"></i> Aktif',
          off:'<i class="fa fa-ban"></i> Nonaktif',
          size:'small',
          onstyle:'success',
          offstyle:'danger',
        });
      },
      "oLanguage": {
        "sLengthMenu": 'Tampilkan '
                      +'<select class="form-control input-sm" style="width:90px">'
                      +    '<option value="5">5 Data</option>'
                      +    '<option value="10">10 Data</option>'
                      +    '<option value="15">15 Data</option>'
                      +    '<option value="20">20 Data</option>'                          
                      +'</select>',
      },
      /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",
      "scrollCollapse": false,*/
      "initComplete": function(settings, json) {
        $('body').find('.dataTables_scrollBody').addClass("style-2");
        /*$(".select2_datatable").select2({
          minimumResultsForSearch:-1,
        });*/
      },
    }).page.len($('.select2_tamp').val());

    var table_data_mhs = $('.tbl-data-mhs').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength":$('.select2_tamp').val(),
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/data_mahasiswa",
        "type" : 'POST',
        "data" : {
          'cari_thn_angkatan' : function(d){
              if ($('.control-panel-data-tbl .select2_thn_angkatan').val() != null) {
                return $('.control-panel-data-tbl .select2_thn_angkatan').val();
              }
              else{
                return '';
              }
              /*return $('#form-get #cari_thn_angkatan').val();*/
            },
          'cari_prodi' : function(d){
              if ($('.control-panel-data-tbl .select2_prodi').val() != null) {
                return $('.control-panel-data-tbl .select2_prodi').val();
              }
              else{
                return '';
              }
              /*return $('#form-get #cari_prodi').val();*/
            },
          'status_data' : function(d){
            return $('.btn-status-data').attr('data-search');
          },
          'length' : function(d){
            return $('.select2_tamp').val();
          },
          'search[value]' : function(d){
            return $('.cari-data-tbl').val();
          },
        },
      },
      /*"searchDelay": 2000,*/
      "order": [[2, 'asc']],
      "columns":[
        {
          "className": 'text-center',
          "orderable": false,
          "data": null,
          "width": "5px",
          "defaultContent": '',
          "mRender": function(data,type,full){
            return "<li class='fa fa-plus-circle detail-row' data-search='data-mhs'></li>"
          }
        },
        {
          "data": {
            "id": "id",
            "id_ortu": "id_ortu",
          },
          "width": "5px",
          "sClass": "text-center selected-data-mhs",
          "orderable": false,
          "mRender": function(data,type,full){
            var id = full.id,
            id_ortu = full.id_ortu;
            return '<input type="checkbox" class="check-data check-siswa" name="id" value="'+id+' '+id_ortu+'" data-selected="check-siswa" data-all-selected="check-all-siswa" data-toggle=".aksi">'
          }
        },
        {
          "data": "nisn",
          "width": "70px",
        },
        {
          "data": "nama",
          "width": "220px",
        },        
        {
          "data": "nama_prodi",
          "width": "100px",
        },
        {
          "data": "tahun_angkatan",
          "width": "20px",
        },        
        {
          "data": "status_verifikasi_mhs",
          "orderable": false,
          "width": "10px",
          "sClass": "text-center",
          "mRender": function(data,type,full){
            var status = full.status_verifikasi_mhs;
            if (status == '1') {
              var status_msg = 'Data Terverifikasi';
              var status_icon = 'fa-check-square-o';
              var status_color = 'btn-success';
            }
            else if (status == '2') {
              var status_msg = 'Data Salah';
              var status_icon = 'fa-times';
              var status_color = 'btn-danger';
            }
            else{
              var status_msg = 'Data Belum Diverifikasi';
              var status_icon = 'fa-warning';
              var status_color = 'btn-gray';
            }
            return '<button type="button" class="btn '+status_color+' dt-vld" data-status="'+status+'" title="'+status_msg+'"><li class="fa '+status_icon+'"></li></button>'
          }
        },
        /*{
          "data": "id",
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var id = full.id;
            return '<div class="btn-group">'
                    +'  <button type="button" class="btn btn-warning">Aksi</button>'
                    +'  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">'
                    +'    <span class="caret"></span>'                    
                    +'  </button>'
                    +'  <ul class="dropdown-menu" role="menu">'
                    +'    <li><a href="#detail?mhs='+id+'&token='+token+'">Detail</a></li>'
                    +'    <li class="divider"></li>'
                    +'    <li><a href="#edit?mhs='+id+'&token='+token+'">Edit</a></li>'
                    +'    <li><a href="#hapus?mhs='+id+'&token='+token+'">Hapus</a></li>'                    
                    +'  </ul>'
                    +'</div>'
          }
        }*/
      ],
      "oLanguage": {
        "sLengthMenu": 'Tampilkan '
                      +'<select class="form-control input-sm" style="width:90px">'
                      +    '<option value="10">10 Data</option>'
                      +    '<option value="20">20 Data</option>'
                      +    '<option value="25">25 Data</option>'
                      +    '<option value="50">50 Data</option>'                          
                      +'</select>',
      },
      "columnDefs": [
        {responsivePriority:1,targets:2},
        {responsivePriority:2,targets:3},
      ],
      "responsive":{
        details:false,
      },
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      /*"scrollX":"300px",*/
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",*/
      /*"scrollCollapse": true,*/
      "initComplete": function(settings, json) {
        $('body').find('.dataTables_scrollBody').addClass("style-2");
      },
    }).page.len($('.select2_tamp').val());

    var table_data_mhs_alumni_do = $('.tbl-data-alumni-do').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength":$('.select2_tamp').val(),
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/data_mahasiswa_alni_do",
        "type" : 'POST',
        "data" : {
          'cari_thn_angkatan' : function(d){
              if ($('.control-panel-data-tbl .select2_thn_angkatan').val() != null) {
                return $('.control-panel-data-tbl .select2_thn_angkatan').val();
              }
              else{
                return '';
              }
            },
          'cari_prodi' : function(d){
              if ($('.control-panel-data-tbl .select2_prodi').val() != null) {
                return $('.control-panel-data-tbl .select2_prodi').val();
              }
              else{
                return '';
              }
            },
          'data_search' : function(d){
              if ($('.control-panel-data-tbl .select2_data').val() != null) {
                if ($('.control-panel-data-tbl .select2_data').val() == 0) {
                  $('.control-panel-data-tbl .cari-data-tbl').attr('placeholder','Cari Data Alumni');
                }
                else{
                  $('.control-panel-data-tbl .cari-data-tbl').attr('placeholder','Cari Data Mahasiswa DO');
                }
                return $('.control-panel-data-tbl .select2_data').val();
              }
              else{
                return '';
              }
            },
          'length' : function(d){
            return $('.select2_tamp').val();
          },
          'search[value]' : function(d){
            return $('.cari-data-tbl').val();
          },
        },
      },
      /*"searchDelay": 2000,*/
      "order": [[2, 'asc']],
      "columns":[
        {
          "className": 'text-center',
          "orderable": false,
          "data": null,
          "width": "5px",
          "defaultContent": '',
          "mRender": function(data,type,full){
            return "<li class='fa fa-plus-circle detail-row' data-search='data-alumni-do'></li>"
          }
        },
        {
          "data": {
            "id":"id",
            "data_mhs":"data_mhs",
          },
          "width": "5px",
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var id = full.id,
            data = full.data_mhs;
            return '<input type="checkbox" class="check-data check-mhs-dt" name="id" value="'+id+'-'+data+'" data-selected="check-mhs-dt" data-all-selected="check-all-mhs-dt" data-toggle=".aksi">'
          }
        },
        {
          "data": "nisn",
          "width": "70px",
        },
        {
          "data": "nama",
          "width": "220px",
        },        
        {
          "data": "nama_prodi",
          "width": "100px",
        },
        {
          "data": "tahun_angkatan",
          "width": "20px",
        }
      ],
      "columnDefs": [
        {responsivePriority:1,targets:2},
        {responsivePriority:2,targets:3},
      ],
      "responsive":{
        details:false,
      },
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "initComplete": function(settings, json) {
        $('body').find('.dataTables_scrollBody').addClass("style-2");
      },
    }).page.len($('.select2_tamp').val());

    var table_data_ptk = $('.tbl-data-ptk').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength":$('.select2_tamp').val(),
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/data_ptk",
        "type" : 'POST',
        "data" : {
          'cari_prodi' : function(d){
              if ($('.control-panel-data-tbl .select2_prodi').val() != null) {
                return $('.control-panel-data-tbl .select2_prodi').val();
              }
              else{
                return '';
              }
            },
          'status_aktif_ptk' : function(d){
            if ($('.control-panel-data-tbl .select2_status_aktif_ptk').val() != null) {
              return $('.control-panel-data-tbl .select2_status_aktif_ptk').val();
            }
            else{
              return '';
            }
          },
          'status_data' : function(d){
            return $('.btn-status-data').attr('data-search');
          },
          'length' : function(d){
            return $('.select2_tamp').val();
          },
          'search[value]' : function(d){
            return $('.cari-data-tbl').val();
          },
        },
      },
      "order": [[2, 'asc']],
      "columns":[
        {
          "className": 'text-center',
          "orderable": false,
          "data": null,
          "width": "5px",  
          "defaultContent": '',
          "mRender": function(data,type,full){
            return "<li class='fa fa-plus-circle detail-row' data-search='data-ptk'></li>"
          }
        },
        {
          "data": "id_ptk",
          "width": "5px",          
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var id_ptk = full.id_ptk;
            return '<input type="checkbox" class="check-data check-guru" name="id_ptk" value="'+id_ptk+'" data-selected="check-guru" data-all-selected="check-all-guru" data-toggle=".aksi">'
          }
        },        
        {
          "data": "nuptk",
          "mRender": function(data,type,full){
            var nuptk = full.nuptk;
            if (nuptk =='') {
              nuptk = '-';
            }
            return nuptk
          }
        },
        {
          "data": "nama_ptk",          
        },        
        {
          "data": "status_aktif_ptk",
          "orderable": false,
          "sClass": 'text-center',
        },
        {
          "data": "status_verifikasi_ptk",
          "orderable": false,
          "width": "10px",
          "sClass": "text-center",
          "mRender": function(data,type,full){
            var status = full.status_verifikasi_ptk;
            if (status == '1') {
              var status_msg = 'Data Terverifikasi';
              var status_icon = 'fa-check-square-o';
              var status_color = 'btn-success';
            }
            else if (status == '2') {
              var status_msg = 'Data Salah';
              var status_icon = 'fa-times';
              var status_color = 'btn-danger';
            }
            else{
              var status_msg = 'Data Belum Diverifikasi';
              var status_icon = 'fa-warning';
              var status_color = 'btn-gray';
            }
            return '<button type="button" class="btn '+status_color+' dt-vld" data-status="'+status+'" title="'+status_msg+'"><li class="fa '+status_icon+'"></li></button>'
          }
        },
        /*{
          "data": "id_ptk",
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var id = full.id_ptk;
            return '<div class="btn-group">'
                    +'  <button type="button" class="btn btn-warning">Aksi</button>'
                    +'  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">'
                    +'    <span class="caret"></span>'                    
                    +'  </button>'
                    +'  <ul class="dropdown-menu" role="menu">'
                    +'    <li><a href="#detail?ptk='+id+'&token='+token+'">Detail</a></li>'
                    +'    <li class="divider"></li>'
                    +'    <li><a href="#edit?ptk='+id+'&token='+token+'">Edit</a></li>'
                    +'    <li><a href="#hapus?ptk='+id+'&token='+token+'">Hapus</a></li>'                    
                    +'  </ul>'
                    +'</div>'
          }
        }*/
      ],
      "oLanguage": {
        "sLengthMenu": 'Tampilkan '
                      +'<select class="form-control input-sm" style="width:90px">'
                      +    '<option value="10">10 Data</option>'
                      +    '<option value="20">20 Data</option>'
                      +    '<option value="25">25 Data</option>'
                      +    '<option value="50">50 Data</option>'
                      /*+    '<option value="-1">Semua Data</option>'*/
                      +'</select>',
      },
      /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
      "columnDefs": [
        {responsivePriority:1,targets:2},
        {responsivePriority:2,targets:3},
      ],
      "responsive":{
        details:false,
      },
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,      
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",
      "scrollCollapse": false,*/
      "initComplete": function(settings, json) {
        $('body').find('.dataTables_scrollBody').addClass("style-2");
      },
    }).page.len($('.select2_tamp').val());

    var table_data_fk = $('.tbl-data-fk').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/data_fakultas",
        "type" : 'POST',
      },
      "order": [[1, 'asc']],
      "columns":[
        {
          "data": "id_fk",
          "width": "5px",          
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var id = full.id_fk;
            return '<input type="checkbox" class="check-data check-fk" name="id" value="'+id+'" data-selected="check-fk" data-all-selected="check-all-fk" data-toggle=".hapus">'
          }
        },
        {
          "data": "nama_fakultas",          
        },
        {
          "data": "dekan",       
        },
        {
          "data": "tgl_berdiri",
          "sClass": "text-center",
        },
        {
          "data": "akreditasi_fk",
          "sClass": "text-center",
        },
        {
          "data": {
            "nama_fakultas": "nama_fakultas",
            "id_fk": "id_fk",
          },
          "sClass": "text-center",          
          "orderable": false,
          "mRender": function(data,type,full){
            var fk = full.nama_fakultas;
            var id_fk = full.id_fk;
            return '<a href="#tambah?fk='+fk.replace(' ','_').toLowerCase()+'&i='+id_fk+'&token='+token+'" class="btn btn-info btn-sm" title="Tambah Program Studi pada Fakultas '+fk+'" value="'+fk+'/'+id_fk+'"><i class="fa fa-plus"></i></a> | '
                  +'<div class="btn-group">'
                  +' <a href="#data?fk='+fk.replace(' ','_').toLowerCase()+'&i='+id_fk+'&token='+token+'" class="btn btn-warning btn-sm detail-data-fk" data-search="'+id_fk+'" title="Lihat Program Studi pada Fakultas '+fk+'"><i class="fa fa-list"></i></a> '
                  +' <a href="#edit?fk='+id_fk+'&token='+token+'" class="btn btn-success btn-sm" title="Edit Data Fakultas '+fk+'"><i class="fa fa-pencil-square"></i></a> '
                  +' <a href="#hapus?fk='+id_fk+'&token='+token+'" class="btn btn-danger btn-sm" title="Hapus Data Fakultas '+fk+'"><i class="fa fa-trash"></i></a>'
                  +'</div>'
                  /*'<div class="btn-group">'
                    +'  <button type="button" class="btn btn-warning">Aksi</button>'
                    +'  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">'
                    +'    <span class="caret"></span>'                    
                    +'  </button>'
                    +'  <ul class="dropdown-menu" role="menu">'
                    +'    <li><a href="#tambah?jadwal='+mp+'">Tambah Jadwal</a></li>'
                    +'    <li class="divider"></li>'
                    +'    <li><a href="#edit?mata_pelajaran='+id_mp+'">Edit</a></li>'
                    +'    <li><a href="#hapus?mata_pelajaran='+id_mp+'">Hapus</a></li>'                    
                    +'  </ul>'
                    +'</div>'*/
          }
        }
      ],
      /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
      "columnDefs": [
        {responsivePriority:1,targets:0},
        {responsivePriority:2,targets:1},
      ],
      "responsive":{
        details:false,
      },
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,      
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",
      "scrollCollapse": false,*/
      "initComplete": function(settings, json) {
        /*$('body').find('.dataTables_scrollBody').addClass("style-1");*/
      },
    });

    var table_data_pd = $('.tbl-data-pd').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url" : hostProtocol + "//" +host+controller_path+"/data_table_request/data_prodi",
        "type" : 'POST',
      },
      "order": [[2, 'asc']],
      "columns":[
        {
          "className": 'text-center',
          "orderable": false,
          "data": null,
          "width": "5px",
          "defaultContent": '',
          "mRender": function(data,type,full){
            return "<li class='fa fa-plus-circle detail-row' data-search='data-prodi'></li>"
          }
        },
        {
          "data": "id_prodi",
          "width": "5px",          
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var id = full.id_prodi;
            return '<input type="checkbox" class="check-data check-prodi" name="id" value="'+id+'" data-selected="check-prodi" data-all-selected="check-all-prodi" data-toggle=".hapus-prodi">'
          }
        },
        {
          "data": "kode_prodi",
          "sClass": "text-center",
        },
        {
          "data": "nama_prodi",       
        },
        {
          "data": "status_prodi",
          "sClass": "text-center",
          "orderable": false,
        },
        {
          "data": "jenjang_prodi",
          "sClass": "text-center",
          "orderable": false,
        },
        {
          "data": "count_mhs_prodi",
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var count = full.count_mhs_prodi;
            return '<li class="fa fa-group"></li> '+count;
          }
        },
        {
          "data": {
            "nama_prodi": "nama_prodi",
            "id_prodi": "id_prodi",
          },
          "sClass": "text-center",          
          "orderable": false,
          "mRender": function(data,type,full){
            var fk = full.nama_prodi;
            var id_fk = full.id_prodi;
            return '<a href="#tambah?data=konsentrasi_prodi&prodi_kons='+fk.replace(' ','_').toLowerCase()+'&i='+id_fk+'&token='+token+'" class="btn btn-info btn-sm" title="Tambah Konsentrasi pada Program Studi '+fk+'"><i class="fa fa-plus"></i></a> | '
                  +'<div class="btn-group">'
                  +' <a href="#edit?pd='+id_fk+'&token='+token+'" class="btn btn-success btn-sm" title="Edit Data Program Studi '+fk+'"><i class="fa fa-pencil-square"></i></a>'
                  +' <a href="#hapus?pd='+id_fk+'&token='+token+'" class="btn btn-danger btn-sm" title="Hapus Data Program Studi '+fk+'"><i class="fa fa-trash"></i></a>'
                  +'</div>'
          }
        }
      ],
      "oLanguage": {
        "sLengthMenu": 'Tampilkan '
                      +'<select class="form-control input-sm" style="width:120px">'
                      +    '<option value="-1">Semua Data</option>'
                      +    '<option value="10">10 Data</option>'
                      +    '<option value="15">15 Data</option>'
                      +    '<option value="20">20 Data</option>'
                      +'</select>',
      },
      /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
      "columnDefs": [
        {responsivePriority:1,targets:2},
        {responsivePriority:2,targets:3},
      ],
      "responsive":{
        details:false,
      },
      "pageLength" : -1,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",
      "scrollCollapse": false,*/
      "initComplete": function(settings, json) {
        /*$('body').find('.dataTables_scrollBody').addClass("style-1");*/
      },
    });

    var table_data_thn_ak = $('.tbl-daftar-thn-ajar').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url" : hostProtocol + "//" +host+data_master_path+"/data_table_request/data_thn_akademik",
        "type" : 'POST',     
      },
      "order": [[0, 'desc']],
      "columns":[        
        {
          "data": "thn_ajaran_jdl",
        },
        {
          "data": {
            "thn_ajaran_jdl":"thn_ajaran_jdl",
            "jml_mhs":"jml_mhs",
            "jml_mhs_lk":"jml_mhs_lk",
            "jml_mhs_pr":"jml_mhs_pr",
          },  
          "sClass": "text-center", 
          "orderable": false,
          "mRender": function(data,type,full){
            var thn = full.thn_ajaran_jdl,
            jml = full.jml_mhs,
            lk = full.jml_mhs_lk,
            pr = full.jml_mhs_pr;
            return '<li class="fa fa-users" title="Jumlah mahasiswa tahun akademik '+thn+'"></li> '+jml+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki tahun akademik '+thn+'"></li> '+lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan tahun akademik '+thn+'"></li> '+pr+'';
          },
        },
        {
          "data": {
            "id_thn_ak": "id_thn_ak",
            "status_jdl": "status_jdl",
            "status_inp_nilai": "status_inp_nilai",
          },
          "sClass": "text-center",
          "orderable": false,
          "mRender": function(data,type,full){
            var id_thn = full.id_thn_ak,
            status = full.status_jdl,
            status_inp_nilai = full.status_inp_nilai,
            check,check_inp,disabled;
            if (status == 1) {
              check = 'checked';
              disabled = '';
            }
            else if (status != 1) {
              check = '';
              disabled = 'disabled';
            }
            if (status_inp_nilai == 1) {
              check_inp = 'checked';
            }
            else if (status_inp_nilai != 1) {
              check_inp = '';
            }
            return "<input type='checkbox' class='check-status-thn-ajar check-status-thn-ajar-"+id_thn+"' "+check+" value='"+id_thn+"'/> <input type='checkbox' class='check-status-thn-inp check-status-thn-inp-"+id_thn+"' "+check_inp+" "+disabled+" value='"+id_thn+"'/>"
          },
        },
      ],
      "fnDrawCallback": function(){
        $('.check-status-thn-ajar').bootstrapToggle({
          on:'<i class="fa fa-check-circle"></i> Diterapkan',
          off:'<i class="fa fa-ban"></i> Tidak Diterapkan',
          size:'small',
          onstyle:'success',
          offstyle:'danger',
          width: 140,
        });
        $('.check-status-thn-inp').bootstrapToggle({
          on:'<i class="fa fa-check-circle"></i> Input Nilai',
          off:'<i class="fa fa-ban"></i> Input Nilai',
          size:'small',
          onstyle:'success',
          offstyle:'danger',
          width: 140,
        });
      },
      "oLanguage": {
        "sLengthMenu": 'Tampilkan '
                      +'<select class="form-control input-sm" style="width:90px">'
                      +    '<option value="4">4 Data</option>'
                      +    '<option value="10">10 Data</option>'
                      +    '<option value="15">15 Data</option>'
                      +    '<option value="20">20 Data</option>'                          
                      +'</select>',
      },      
      /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
      "columnDefs": [
        {responsivePriority:1,targets:0},
        {responsivePriority:2,targets:1},
      ],
      "responsive":{
        details:false,
      },
      "pageLength" : 4,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,      
      /*"visible": false,
      "searchable": false,*/
      /*"scrollY": "180px",
      "scrollCollapse": false,*/
      /*"scrollX":true,
      "scroller":true,*/
      "initComplete": function(settings, json) {
        $('body').find('.dataTables_scrollBody').addClass("style-2");
      },
    });

    $('.datatable-dt').on('error.dt', function(e,settings,m,message){
      swal({
        title:'Error',
        html: 'Terjadi error pada server!<br>'
              +'<p style="text-align:right;"><a href="" class="show-error">Show Error</a></p><div style="font-family:Segoe UI;text-align: justify;display:none" class="error-detail">'+message+'</div>',
        type:'error',        
        /*customClass: 'animated tada'*/
      });
    }).DataTable();
    $('.datatable-dt').on('xhr.dt', function(e,settings,json,xhr){
      clearInterval(intval_vars);
      if (json.login_rld != null) {
        var table_dt = $(this).attr('table-dt');
        if (table_dt != undefined) {
          $(table_dt).DataTable().ajax.reload();
        }
        /*swal({
          type:'info',
          title:'Info',
          html:'Session anda telah berakhir, silahkan klik tombol <strong>Reset</strong> untuk memuat ulang halaman!',
          showCancelButton: true,
          confirmButtonText:'<i class="fa fa-refresh"></i> Reload',
          cancelButtonText:'<i class="fa fa-times"></i> Batal',
        }).then(function(status){
          window.location.href= json.url;
        });*/
      }
      token = json.n_token;
      var selected_vars = $(this).attr('data-tbl-selected');
      if (selected_vars != undefined) {
        selected_vars = selected_vars.split(' ');
        $('.'+selected_vars[0]).iCheck('uncheck');
        $('.'+selected_vars[1]).iCheck('uncheck');
      }
      var table_box = $(this).attr('table-box');
      if (table_box != undefined) {
        $(table_box).find('div.overlay').fadeOut();
      }
      /*var data_checked = $(this).attr('data-checked');
      if (data_checked != undefined) {
        $('.'+data_checked).addClass('hide');
        $('.selected-data-btn[data-selected='+data_checked+']').addClass('bg-light-blue').removeClass('bg-gray').attr('state','0');
        $('.selected-data-btn[data-selected='+data_checked+']').find('li').addClass('fa-check-square').removeClass('fa-times-rectangle-o');
      }*/
    }).DataTable();
    $('div.dataTables_filter label').append(
      '<div class="input-group hidden-tablet hidden-phone">'
      +'      <span class="input-group-btn">'
      +'        <button type="button" class="btn btn-default btn-flat" style="cursor: default;"><span class="fa fa-search"></span></button>'
      +'      </span>'
      +'</div>'
      );
    $('div.dataTables_filter input').removeClass('input-sm').attr('placeholder','Cari Data...');
    $('div.dataTables_length select').removeClass('input-sm').addClass('select2_change');
    $('.select2_change').select2({
      minimumResultsForSearch:-1,
    });

    $('.cari-data-tbl').on({
      keyup: function(eve){
        delay(function(){
          /*$(this).siblings('.input-group-btn').find('span').removeClass('fa-search').addClass('fa-refresh fa-spin');*/
          /*$($(this).attr('data-table')).DataTable().ajax.reload();*/
          table_thn_akademik.ajax.reload();
          table_thn_angkatan.ajax.reload();
          table_data_mhs.ajax.reload();
          table_data_mhs_alumni_do.ajax.reload();
          table_data_ptk.ajax.reload();
          table_user.ajax.reload();
          if ($('#visitors-mhs').is(':visible')) {
            table_pengunjung_mhs.ajax.reload();
          }
          if ($('#visitors-ptk').is(':visible')) {
            table_pengunjung_ptk.ajax.reload();
          }
          window.history.pushState(null,null,path);
          collapse_box('#box-siswa, #box-guru, .box-thn-angkatan, #box-content');
          $('html, body').animate({scrollTop:$('#box-siswa, #box-guru, .box-thn-angkatan, #box-content').offset().top - 55},800);
        },500);
        /*if ($(this).val() != '') {
          $(this).siblings('.input-group-btn').find('span').removeClass('fa-search').addClass('fa-times-circle');
          $(this).siblings('.input-group-btn').find('button').addClass('clear-search');
        }
        else{
          $(this).siblings('.input-group-btn').find('span').removeClass('fa-times-circle').addClass('fa-search');
          $(this).siblings('.input-group-btn').find('button').removeClass('clear-search');
        }*/
      },
      /*change: function(eve){
        table_thn_akademik.ajax.reload();
        table_thn_angkatan.ajax.reload();
        table_data_mhs.ajax.reload();
        table_data_mhs_alumni_do.ajax.reload();
        table_data_ptk.ajax.reload();
        table_user.ajax.reload();
        table_pengunjung.ajax.reload();
        window.history.pushState(null,null,path);
        collapse_box('#box-siswa, #box-guru, .box-thn-angkatan, #box-content');
        $('html, body').animate({scrollTop:$('#box-siswa, #box-guru, .box-thn-angkatan, #box-content').offset().top - 55},800);
        if ($(this).val() != '') {
          $(this).siblings('.input-group-btn').find('span').removeClass('fa-search').addClass('fa-times-circle');
          $(this).siblings('.input-group-btn').find('button').addClass('clear-search');
        }
        else{
          $(this).siblings('.input-group-btn').find('span').removeClass('fa-times-circle').addClass('fa-search');
          $(this).siblings('.input-group-btn').find('button').removeClass('clear-search');
        }
      }*/
    });
    $(document).on('click','.clear-search', function(){
      $(this).parent().siblings('.cari-data-tbl').val('');
      $(this).find('span').removeClass('fa-times-circle').addClass('fa-search');
      $(this).removeClass('clear-search');
    });
    $('.select2_tamp').on('change', function(){
      table_thn_akademik.page.len($(this).val()).draw();
      table_thn_angkatan.page.len($(this).val()).draw();
      table_data_mhs.page.len($(this).val()).draw();
      table_data_mhs_alumni_do.page.len($(this).val()).draw();
      table_data_ptk.page.len($(this).val()).draw();
      table_user.page.len($(this).val()).draw();
      if ($('#visitors-mhs').is(':visible')) {
        table_pengunjung_mhs.page.len($(this).val()).draw();
      }
      if ($('#visitors-ptk').is(':visible')) {
        table_pengunjung_ptk.page.len($(this).val()).draw();
      }
      window.history.pushState(null,null,path);
      collapse_box('#box-siswa, #box-guru, .box-thn-angkatan, #box-content');
      $('html, body').animate({scrollTop:$('#box-siswa, #box-guru, .box-thn-angkatan, #box-content').offset().top - 55},800);
    });
    $('.btn-status-data').on('click', function(){
      $('.btn-status-data').attr('data-search',$(this).val());
      $('.control-panel-data-tbl .cari-data-tbl').val('');
      $('.semua-data').show();
      table_data_mhs.ajax.reload();
      table_data_ptk.ajax.reload();
      window.history.pushState(null,null,path);
      collapse_box('#box-siswa, #box-guru');
      $('html, body').animate({scrollTop:$('#box-siswa, #box-guru').offset().top - 55},800);
    });
    $(".control-panel-data-tbl .filter-dt").on('change', function(){
      if (path == controller_path+'/data_pengguna_ptk' && $(".select2_prodi").val() != null) {
        $('#created-pass').css('pointer-events','');
        $('#created-pass').removeClass('disabled');
      }
      else if ($(".select2_prodi").val() != null && $(".select2_thn_angkatan").val() != null) {
        $('#tamp-data, #created-pass').removeClass('disabled');
      }
      else if ($(".select2_prodi").val() != null && $(".select2_thn_angkatan").val() == null || $(".select2_prodi").val() != null && $(".select2_status_aktif_ptk").val() != null) {
        $('#tamp-data').removeClass('disabled');
        $('#created-pass').addClass('disabled');
      }
      else if ($(".select2_prodi").val() == null && $(".select2_thn_angkatan").val() != null || $(".select2_prodi").val() != null && $(".select2_status_aktif_ptk").val() == null) {
        $('#tamp-data').removeClass('disabled');
        $('#created-pass').addClass('disabled');
      }
      else if ($(".select2_status_aktif_ptk").val() != null && $(".select2_status_aktif_ptk").val() != '') {
        $('#tamp-data').removeClass('disabled');
      }
      else{
        $('#tamp-data, #created-pass').addClass('disabled');
        $('#created-pass').css('pointer-events','none');
      }
    });
    $('.select2_data').on('change', function(){
      if ($(this).val() == 0) {
        $('.control-panel-data-tbl .cari-data-tbl').attr('placeholder','Cari Data Alumni');
        $('#box-content .box-title').text('Data Alumni');
      }
      else if ($(this).val() == 1) {
        $('.control-panel-data-tbl .cari-data-tbl').attr('placeholder','Cari Data Mahasiswa DO');
        $('#box-content .box-title').text('Data Mahasiswa Drop Out');
      }

      if ($(this).val() == 0 || $(this).val() == 1) {
        $('.control-panel-data-tbl .select2_thn_angkatan, .control-panel-data-tbl .select2_prodi').val('').text('');
        $('.control-panel-data-tbl .cari-data-tbl').val('');
        $('#tamp-data,.aksi').addClass('disabled');
        $('.semua-data').hide();
        table_data_mhs_alumni_do.ajax.reload();
        window.history.pushState(null,null,path);
        collapse_box('#box-content');
        $('html, body').animate({scrollTop:$('#box-content').offset().top - 55},800);
      }
    });

    $('.btn-status-user').on('click', function(){
      $('.btn-status-user').attr('data-search',$(this).val());
      $('.control-panel-data-tbl .cari-data-tbl').val('');
      $('.semua-data').show();
      $('#box-content').find('div.overlay').fadeIn();
      table_user.ajax.reload();
      window.history.pushState(null,null,path);
      collapse_box('#box-content');
      $('html, body').animate({scrollTop:$('#box-content').offset().top - 55},800);
      $('#box-content').find('div.overlay').fadeOut();
    });

    $('.selected-data-btn').on('click', function(){
      var data_selected = $(this).attr('data-selected');
      if ($(this).attr('state') == 0) {
        $(this).attr('state','1');
        $(this).removeClass('bg-light-blue').addClass('bg-gray');
        $(this).find('li').removeClass('fa-check-square').addClass('fa-times-rectangle-o');
        $('.'+data_selected).removeClass('hide');
      }
      else{
        $(this).attr('state','0');
        $(this).addClass('bg-light-blue').removeClass('bg-gray');
        $(this).find('li').addClass('fa-check-square').removeClass('fa-times-rectangle-o');
        $('.'+data_selected).addClass('hide');
        $('.'+data_selected).iCheck('uncheck');
      }
    });

    $(document).on('click', '.detail-row', function () {
      var tr = $(this).closest('tr');
      if ($(this).attr('data-search') == 'data-user') {
        var row = table_user.row(tr);
      }
      else if ($(this).attr('data-search') == 'data-mhs') {
        var row = table_data_mhs.row(tr);
      }
      else if ($(this).attr('data-search') == 'data-ptk') {
        var row = table_data_ptk.row(tr);
      }
      else if ($(this).attr('data-search') == 'data-prodi') {
        var row = table_data_pd.row(tr);
      }
      else if ($(this).attr('data-search') == 'data-visitor-mhs') {
        var row = table_pengunjung_mhs.row(tr);
      }
      else if ($(this).attr('data-search') == 'data-visitor-ptk') {
        var row = table_pengunjung_ptk.row(tr);
      }
      else if ($(this).attr('data-search') == 'data-alumni-do') {
        var row = table_data_mhs_alumni_do.row(tr);
      }

      if (row != undefined) {
        if (row.child.isShown()) {
          $('div.slider-detail', row.child()).slideUp(function(){
            row.child.hide();
          });
          $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
        }
        else {
          row.child(row_detail(row.data(),$(this).attr('data-search')), 'no-padding').show();
          $('div.slider-detail', row.child()).slideDown();
          $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
        }
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
    /*END -- Datatable With AJAX*/

    /*AJAX Event*/
    $(document).ajaxSuccess(function(eve,xhr){
      if (xhr.responseJSON && xhr.responseJSON['n_token'] != null) {
        token = xhr.responseJSON['n_token'];
      }
      else{
        token = rand_val();
      }
      /*$('div.overlay').fadeOut();*/
    });
    /*END -- AJAX Event*/

});

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

  /*Function: Get HTML Respon*/
  function getHtml_page(data){
    data['csrf_key'] = token;
    return $.ajax({
      type: 'POST',
      url: hostProtocol + '//'+host+'/siakad-uncp/admin/html_request',
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

  function check_all(){
    /*document.getElementsByClassName('data_action').checked = true;*/
    $('.data_action').attr("checked",true);
  }

  function modal_animated(animated, remove_animated){
    $('.modal .modal-dialog').removeClass(remove_animated + ' animated');
    var animated = $('#myModal .modal-dialog, #myModal-pt .modal-dialog').addClass(animated + ' animated')
  }

  function collapse_toggle(string){
    var box = $(string);
      //Find the body and the footer
    var box_content = box.find("> .box-body, > .box-footer, > form  >.box-body, > form > .box-footer");
    if (!box.hasClass("collapsed-box")) {
        //Convert minus into plus
        box.find('i.fa-minus').removeClass('fa fa-minus').addClass('fa fa-plus');
        //Hide the content
        box_content.slideUp(450, function () {
          box.addClass("collapsed-box");
        });
      } else {                        
        //Convert plus into minus
        box.find('i.fa-plus').removeClass('fa fa-plus').addClass('fa fa-minus');
        //Show the content
        box_content.slideDown(450, function () {
          box.removeClass("collapsed-box");
        });
      }
  }

  /*Function: Collapse BOX*/
  function collapse_box(string,filter){
    var box = $(string);
      //Find the body and the footer
    var box_content = box.find("> .box-body, > .box-footer, > form  >.box-body, > form > .box-footer");    
    //Convert plus into minus
    if (filter == undefined) {
      box.find('.box-header .fa-plus').removeClass('fa fa-plus').addClass('fa fa-minus');
    }
    else{
      $(string+' .collapse-icon').removeClass('fa fa-plus').addClass('fa fa-minus');
    }
    //Show the content
    box_content.slideDown(450, function () {
      box.removeClass("collapsed-box");
    });      
  }
  /*END -- Function: Collapse BOX*/

  /*Function: Datatable Row Detail*/
  function row_detail(str,data) {
    if (data == 'data-user') {
      return '<div class="slider-detail" style="display:none">'
      +'<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'
      +    '<tr>'
      +        '<td>Full name:</td>'
      +        '<td>'+str.username+'</td>'
      +    '</tr>'
      +    '<tr>'
      +        '<td>Extension number:</td>'
      +        '<td>'+str.uncrypt_password+'</td>'
      +    '</tr>'
      +    '<tr>'
      +        '<td>Extra info:</td>'
      +        '<td>And any further details here (images etc)...</td>'
      +    '</tr>'
      +'</table>'
      +'</div>';
    }
    else if (data == 'data-visitor-mhs' || data == 'data-visitor-ptk') {
      return '<div class="slider-detail" style="display:none">'
      +'<div class="row">'
      +'  <div class="col-md-2" style="margin:30px -25px 10px 10px">'
      +'    <img class="profile-user-img img-responsive photo-mhs-detail" src="'+str.photo_u+'" alt="User profile picture">'
      +'  </div>'
      +'  <div class="col-md-10">'
      +'<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;margin:10px;">'
      +    '<tr>'
      +        '<td>Username</td>'
      +        '<td>&nbsp<li class="fa fa-chevron-right"></li>&nbsp</td>'
      +        '<td>'+str.username+'</td>'
      +    '</tr>'
      +    '<tr>'
      +        '<td>Nama</td>'
      +        '<td>&nbsp<li class="fa fa-chevron-right"></li>&nbsp</td>'
      +        '<td>'+str.nama+'</td>'
      +    '</tr>'
      +    '<tr>'
      +        '<td></td>'
      +        '<td></td>'
      +        '<td>'+str.user_lvl+'</td>'
      +    '</tr>'
      +    '<tr>'
      +        '<td>Browser</td>'
      +        '<td>&nbsp<li class="fa fa-chevron-right"></li>&nbsp</td>'
      +        '<td><li class="fa '+str.browser_icon+'"></li> '+str.visitor_browser+'</td>'
      +    '</tr>'
      +    '<tr>'
      +        '<td>Platform</td>'
      +        '<td>&nbsp<li class="fa fa-chevron-right"></li>&nbsp</td>'
      +        '<td><li class="fa '+str.device_icon+'"></li> '+str.visitor_agent+' | <li class="fa '+str.os_icon+'"></li> '+str.visitor_os+'</td>'
      +    '</tr>'
      +    '<tr>'
      +        '<td>Terakhir Online</td>'
      +        '<td>&nbsp<li class="fa fa-chevron-right"></li>&nbsp</td>'
      +        '<td><li class="fa fa-calendar"></li> '+str.date+' <li class="fa fa-clock-o"></li> '+str.time+'</td>'
      +    '</tr>'
      +    '<tr>'
      +        '<td>Extra info</td>'
      +        '<td>&nbsp<li class="fa fa-chevron-right"></li>&nbsp</td>'
      +        '<td>And any further details soon...</td>'
      +    '</tr>'
      +'</table>'
      +'  </div>'
      +'</div>'
      +'</div>';
    }
    else if (data == 'data-mhs') {
      return '<div class="slider-detail text-center" style="display:none;margin: 10px 0 10px 0">'
      +'  <div class="btn-group">'
      +'    <a href="#detail?mhs='+str.id+'&token='+token+'" class="btn btn-warning detail-mhs-btn" data-search="'+str.id+'" title="Detail data mahasiswa '+str.nama+' dengan NIM '+str.nisn+'" style="height:70px;padding-top:11px"><i class="fa fa-id-card" style="display:block;font-size:30px"></i> Detail Data</a>'
      +'    <a href="#edit?mhs='+str.id+'&token='+token+'" class="btn btn-success" title="Edit data mahasiswa '+str.nama+' dengan NIM '+str.nisn+'" style="height:70px;padding-top:11px"><i class="fa fa-pencil-square" style="display:block;font-size:30px"></i> Edit Data</a>'
      +'    <a href="#hapus?mhs='+str.id+'&token='+token+'" class="btn btn-danger" title="Hapus data mahasiswa '+str.nama+' dengan NIM '+str.nisn+'" style="height:70px;padding-top:11px"><i class="fa fa-trash" style="display:block;font-size:30px"></i> Hapus Data</a>'
      +'  </div>'
      +'</div>';
    }
    else if (data == 'data-ptk') {
      return '<div class="slider-detail text-center" style="display:none;margin: 10px 0 10px 0">'
      +'  <div class="btn-group">'
      +'    <div class="btn-group">'
      +'        <button type="button" class="btn btn-info" style="height:70px;padding-top:11px"><li class="fa fa-plus" style="display:block;font-size:30px"></li> Tambah</button>'
      +'        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="height:70px;padding-top:11px">'
      +'          <span class="caret"></span>'
      +'          <span class="sr-only">Toggle Dropdown</span>'
      +'        </button>'
      +'        <ul class="dropdown-menu" role="menu">'
      +'          <li><a href="#tambah?data=pend_ptk&in='+str.id_ptk+'&token='+token+'" title="Tambah data riwayat pendidik tenaga pendidik '+str.nama_ptk+' dengan NIDN '+str.nuptk+'"><span class="fa fa-book"></span> Data Riwayat Pendidikan</a></li>'
      +'          <li><a href="#tambah?data=research_ptk&in='+str.id_ptk+'&token='+token+'" title="Tambah data penelitian tenaga pendidik '+str.nama_ptk+' dengan NIDN '+str.nuptk+'"><span class="fa fa-flask"></span> Data Penelitian</a></li>'
      +'        </ul>'
      +'      </div>'
      +'    <a href="#detail?ptk='+str.id_ptk+'&token='+token+'" class="btn btn-warning detail-ptk-btn" data-search='+str.id_ptk+' title="Detail data tenaga pendidik '+str.nama_ptk+' dengan NIDN '+str.nuptk+'" style="height:70px;padding-top:11px"><i class="fa fa-id-card" style="display:block;font-size:30px"></i> Detail Data</a>'
      +'    <a href="#edit?ptk='+str.id_ptk+'&token='+token+'" class="btn btn-success" title="Edit data tenaga pendidik '+str.nama_ptk+' dengan NIDN '+str.nuptk+'" style="height:70px;padding-top:11px"><i class="fa fa-pencil-square" style="display:block;font-size:30px"></i> Edit Data</a>'
      +'    <a href="#hapus?ptk='+str.id_ptk+'&token='+token+'" class="btn btn-danger" title="Hapus data tenaga pendidik '+str.nama_ptk+' dengan NIDN '+str.nuptk+'" style="height:70px;padding-top:11px"><i class="fa fa-trash" style="display:block;font-size:30px"></i> Hapus Data</a>'
      +'  </div>'
      +'</div>';
    }
    else if (data == 'data-prodi') {
      var id_row = str.id_prodi;
      var detail_row_respon = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_pd:str.id_prodi,data:'data_prodi'},500);
      detail_row_respon.then(function(detail_prodi){
        if (detail_prodi.data !='') {
          var detail_pd = detail_prodi.data[0];
          $.each(detail_prodi.data[0], function(index, data_record){
            if (detail_pd[index] == '' || detail_pd[index] == '0000-00-00') {
              detail_pd[index] = '-';
            }

            if (index == 'status_prodi' && detail_pd[index] == 1) {
              detail_pd[index] = 'Aktif';
            }
            else if (index == 'status_prodi' && detail_pd[index] != 1) {
              detail_pd[index] = 'Tidak Aktif';
            }
          });
          $('.slider-detail[data-search='+id_row+']').html(
            '   <div class="row">'
            +'      <div class="col-md-6">'
            +'        <dl class="dl-horizontal no-margin">'
            +'          <dt>Fakultas</dt>'
            +'          <dd>'+detail_pd['nama_fakultas']+'</dd>'
            +'          <dt>Kode Program Studi</dt>'
            +'          <dd>'+detail_pd['kode_prodi']+'</dd>'
            +'          <dt>Nama Program Studi</dt>'
            +'          <dd>'+detail_pd['nama_prodi']+'</dd>'
            +'          <dt>Nama Ketua Prodi</dt>'
            +'          <dd>'+detail_pd['nama_kprodi']+'</dd>'
            +'          <dt>Jenjang</dt>'
            +'          <dd>'+detail_pd['jenjang_prodi']+'</dd>'
            +'          <dt>Akreditas</dt>'
            +'          <dd>'+detail_pd['akreditasi_prodi']+'</dd>'
            +'          <dt>Status</dt>'
            +'          <dd>'+detail_pd['status_prodi']+'</dd>'
            +'          <dt>SK Penyelenggaraan</dt>'
            +'          <dd>'+detail_pd['sk_peny_prodi']+'</dd>'
            +'          <dt>Tanggal SK</dt>'
            +'          <dd>'+detail_pd['tgl_sk_prodi']+'</dd>'
            +'          <dt>Tanggal Berdiri</dt>'
            +'          <dd>'+detail_pd['tgl_berdiri_prodi']+'</dd>'
            +'        </dl>'
            +'      </div>'
            +'      <div class="col-md-6">'
            +'        <dl class="dl-horizontal no-margin">'
            +'          <dt>Alamat</dt>'
            +'          <dd>'+detail_pd['alamat_prodi']+'</dd>'
            +'          <dt>Kode POS</dt>'
            +'          <dd>'+detail_pd['kode_pos_prodi']+'</dd>'
            +'          <dt>Telepon</dt>'
            +'          <dd>'+detail_pd['telpon_prodi']+'</dd>'
            +'          <dt>FAX</dt>'
            +'          <dd>'+detail_pd['fax_prodi']+'</dd>'
            +'          <dt>Email</dt>'
            +'          <dd>'+detail_pd['email_prodi']+'</dd>'
            +'          <dt>Website</dt>'
            +'          <dd>'+detail_pd['website_prodi']+'</dd>'
            +'          <dt>Jumlah Mahasiswa</dt>'
            +'          <dd><span class="fa fa-users"></span> '+detail_pd['jml_mhs']+'</dd>'
            +'          <dt>Mahasiswa Laki-Laki</dt>'
            +'          <dd><span class="fa fa-male"></span> '+detail_pd['jml_lk']+'</dd>'
            +'          <dt>Mahasiswa Perempuan</dt>'
            +'          <dd><span class="fa fa-female"></span> '+detail_pd['jml_pr']+'</dd>'
            +'        </dl>'
            +'      </div>'
            +'    </div>'
          ).removeClass('text-center');
        }
        else{
          $('.tbl-data-pd').DataTable().ajax.reload();
          swal({
            title:'Info',
            text: 'Program Studi yang anda pilih tidak ada didalam database!',
            type:'info',
            timer: 2000
          });
        }
      }).catch(function(error){
        $('.slider-detail[data-search='+id_row+']').html('<font>Terjadi Kesalahan, <b>Error '+error.status+': '+error.statusText+'</b></font>');
      });
    }
    else if (data == 'data-alumni-do') {
      if ($('.select2_data').val() == 0) {
        var mhs = 'alumni';
        var url_vars = 'alumni';
      }
      else if ($('.select2_data').val() == 1) {
        var mhs = 'mahasiswa drop out';
        var url_vars = 'mhs_do';
      }
      return '<div class="slider-detail text-center" style="display:none;margin: 10px 0 10px 0">'
      +'  <div class="btn-group">'
      +'    <a href="#detail?'+url_vars+'='+str.id+'&token='+token+'" class="btn btn-warning detail-mhs-btn" data-search="'+str.id+'" title="Detail '+mhs+' '+str.nama+' dengan NIM '+str.nisn+'" style="height:70px;padding-top:11px"><i class="fa fa-id-card" style="display:block;font-size:30px"></i> Detail Data</a>'
      +'    <a href="#edit?'+url_vars+'='+str.id+'&token='+token+'" class="btn btn-success" title="Edit data '+mhs+' '+str.nama+' dengan NIM '+str.nisn+'" style="height:70px;padding-top:11px"><i class="fa fa-pencil-square" style="display:block;font-size:30px"></i> Edit Data</a>'
      +'    <a href="#hapus?'+url_vars+'='+str.id+'&token='+token+'" class="btn btn-danger" title="Hapus data '+mhs+' '+str.nama+' dengan NIM '+str.nisn+'" style="height:70px;padding-top:11px"><i class="fa fa-trash" style="display:block;font-size:30px"></i> Hapus Data</a>'
      +'  </div>'
      +'</div>';
    }

    if (detail_row_respon != undefined) {
      return '<div class="slider-detail text-center" data-search="'+id_row+'" style="display:none;margin: 10px 0 10px 0"><font class="load-data">Memproses Data</font></div>';
    }
  }
  /*END -- Function: Datatable Row Detail*/

  /*Function: Datatable data master*/
  function data_mhs_master(data,value){
    $('#box-mhs').slideDown();
    $('#box-mhs').find('div.overlay').fadeIn();
    $('html, body').animate({scrollTop:$('#box-mhs').offset().top},800);
    if ($.fn.DataTable.isDataTable('.tbl-data-mhs-master')) {
      $('.tbl-data-mhs-master').DataTable().destroy();
    }
    $(document).bind('ajaxComplete', function(){
      $('#box-mhs').find('div.overlay').fadeOut();
    });
    if (data == 'thn_akademik') {
      var url_param = 'data_mahasiswa_ak';
    }
    else if (data == 'thn_angkatan') {
      var url_param = 'data_mahasiswa';
    }

    if ($('section.content').is(':visible')) {
      var delay_time = 0;
    }
    else{
      var delay_time = 1000;
    }

    setTimeout(function(){
      var data_master_mhs = $('.tbl-data-mhs-master').DataTable({
        "processing" : true,
        "serverSide" : true,
        "ajax": {
          "url" : hostProtocol + "//" +host+data_akademik_path+"/data_table_request/"+url_param,
          "type" : 'POST',
          "data" : {data:data,value:value},        
        },
        "order": [[1, 'asc']],
        "columns":[
          {
            "data": "no",
            "width": "5px",          
            "sClass": "text-center",
            "orderable": false,          
          },
          {
            "data": "nisn",
            "width": "70px",
          },
          {
            "data": "nama",
            "width": "300px",           
          },
          {
            "data": "nama_prodi",       
          },
          {
            "data": {
              "agama":"agama",
              "tahun_angkatan":"tahun_angkatan",
            },  
            "sClass": "text-center", 
            "orderable": true,
            "mRender": function(data,type,full){
              if (url_param == 'data_mahasiswa') {
                var agama = full.agama;
                return agama;
              }
              else{
                var thn = full.tahun_angkatan;
                return thn;
              }
            },
          },
          {
            "data": {
              "agama":"agama",
              "alamat":"alamat",
            },  
            "sClass": "text-center", 
            "orderable": false,
            "mRender": function(data,type,full){
              if (url_param == 'data_mahasiswa') {
                var alamat = full.alamat;
                return alamat;
              }
              else{
                var agama = full.agama;
                return agama;
              }
            },
          },
        ],
        "initComplete": function(settings, json) {
          /*data_master_mhs.on('draw.dt order.dt search.dt', function () {
            data_master_mhs.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
          } ).draw();*/
          $('body').find('.dataTables_scrollBody').addClass("style-2");
          $('div.dataTables_filter input').removeClass('input-sm').attr('placeholder','Cari Data...');
          $('div.dataTables_filter label').append(
            '<div class="input-group hidden-tablet hidden-phone">'
            +'      <span class="input-group-btn">'
            +'        <button type="button" class="btn btn-default btn-flat" style="cursor: default;"><span class="fa fa-search"></span></button>'
            +'      </span>'
            +'</div>'
            );
          $('div.dataTables_filter input').removeClass('input-sm').attr('placeholder','Cari Data...');
          $('div.dataTables_length select').removeClass('input-sm').addClass('select2_change');
          $('.select2_change').select2({
            minimumResultsForSearch:-1,
          });
        },
        "oLanguage": {
          "oPaginate": {
            "sNext": "<li class='fa fa-angle-double-right' title='Selanjutnya'></li>",
            "sPrevious": "<li class='fa fa-angle-double-left' title='Sebelumnya'></li>",
            "sFirst": "Pertama",
            "sLast": "Terakhir"
          },
          "sInfo": "Menampilkan Data (_START_ Sampai _END_) Dari _TOTAL_ Data",
          "sInfoEmpty": "Data tidak ditemukan",
          "sProcessing": "Memuat Data",
          "sLoadingRecords": "<center>Memproses Data...</center>",
          "sLengthMenu": 'Tampilkan '
                            +'<select class="form-control input-sm" style="width:90px">'
                            +    '<option value="10">10 Data</option>'
                            +    '<option value="20">20 Data</option>'
                            +    '<option value="30">30 Data</option>'
                            +    '<option value="40">40 Data</option>'
                            +    '<option value="50">50 Data</option>'                          
                            +'</select>',
          "sSearch": "",
          "sInfoFiltered": " - Hasil Pencarian Dari _MAX_ Data",
          "sZeroRecords": "<center>Data yang dicari tidak ditemukan</center>"
        },      
        /*"columnDefs": [{"className":"text-center","targets": [3,4]}],*/
        "columnDefs": [
          {responsivePriority:1,targets:0},
          {responsivePriority:2,targets:1},
        ],
        "responsive":{
          details:false,
        },
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "scrollX":true,
        "scroller":true,
      });
    },delay_time);
  } 
  /*END -- Function: Datatable data master*/ 

  /*Function: Table jadwal*/
  function daftar_jadwal(thn,$update){
    $('#box-content .hapus').addClass('disabled');
    $('.check-all-mk').iCheck('uncheck');
    $('#box-jadwal').find('div.overlay').fadeIn();
    var detail_jadwal = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{thn:thn,data:'daftar_jadwal_pd'},500);
    detail_jadwal.then(function(detail_jadwal){
      if (detail_jadwal.record_jadwal != '') {
        collapse_box('#box-jadwal');
        $('#box-kelas-mhs').slideUp();
        $('.check-all-jadwal').iCheck('uncheck');
        $('table.tbl-data-jadwal').find('tbody').text('');
        if ($('#box-jadwal').is(':visible')) {
          delay(function(){
            $('html, body').animate({scrollTop:$('#box-jadwal').offset().top - 55},800);
          },500);
        }
        else{
          delay(function(){
            $('html, body').animate({scrollTop:$('#box-jadwal').offset().top - 55},800);
          },100);
        }
        $('#box-jadwal').slideDown();
        $.each(detail_jadwal.record_u, function(index,data_u){
          var no = 1,loop = 1,loop_row=1,dt_kelas,kelas,no_kelas;
          $.each(detail_jadwal.record_kelas, function(index, data_kelas){
            if (loop_row == 1 && data_kelas.jenis_jdl == 0 || loop_row == loop && data_kelas.jenis_jdl == 0) {
              var row_color =  ' style="background-color:#f9f9f9;"';
              loop++;
              loop++;
            }
            else{
              var row_color = '';
            }
            if (data_u.jenis_jdl == data_kelas.jenis_jdl && data_u.jenis_jdl == 0) {
              dt_kelas = data_kelas.semester+'/'+data_kelas.kelas;
              no = 1;
              $.each(detail_jadwal.record_jadwal, function(index,data_record){
                var semester = data_record.thn_ajaran_jdl.substr(5,1),
                thn_ajaran = data_record.thn_ajaran_jdl.substr(0,4);
                if (semester == 1) {
                  semester = 'Ganjil';
                }
                else{
                  semester = 'Genap';
                }
                if (data_record.status_jdl == 1) {
                  var action = '<div class="btn-group">'
                              +'    <button class="btn btn-warning btn-sm view-kelas" value="'+data_record.id_jdl+'" title="Lihat daftar mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button>'
                              +'    <a href="#edit?jadwal='+data_record.id_jdl+'" class="btn btn-success btn-sm" title="Edit jadwal"><i class="fa fa-pencil-square"></i></a>'
                              +'    <a href="#hapus?jadwal='+data_record.id_jdl+'" class="btn btn-danger btn-sm" title="Hapus jadwal"><i class="fa fa-trash"></i></a>'
                              +'</div>',
                  select_btn = '  <td class="text-center"><input type="checkbox" class="check-data check-jadwal" value="'+data_record.id_jdl+'/'+data_record.id_pd_mk+'/'+data_record.id_thn_ak_jdl+'" data-selected="check-jadwal" data-all-selected="check-all-jadwal" data-toggle=".box-jadwal-mk-control .hapus"></td>';
                }
                else{
                  var action = '<div class="btn-group"><button class="btn btn-warning btn-sm view-kelas" value="'+data_record.id_jdl+'" title="Lihat daftar mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button></div>',
                  select_btn = '  <td class="text-center"></td>';
                }
                if (data_record.nama_mk == null || data_record.nama_mk == '') {
                  data_record.nama_mk = '-';
                  data_record.jml_sks = '-';
                }
                if (data_record.nama_ptk == null || data_record.nama_ptk== '') {
                  data_record.nama_ptk = '-';
                }
                $('#box-jadwal span.thn-ajaran-jad').text(thn_ajaran+'/'+semester);
                $('#box-jadwal span.prodi-jad').text(data_record.nama_prodi);
                kelas = data_record.semester+'/'+data_record.kelas;
                if (kelas == dt_kelas && data_record.jenis_jdl == data_u.jenis_jdl) {
                    if (no == 1) {
                      $('table.tbl-data-jadwal').find('tbody').append(
                        '<tr'+row_color+'>'
                        +select_btn
                        +'  <td rowspan="" class="kelas-row'+data_record.id_jdl+' text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                        +'  <td class="text-center">'+data_record.hari_jdl+'</td>'
                        +'  <td class="text-center">'+data_record.jam_mulai_jdl+' - '+data_record.jam_akhir_jdl+'</td>'
                        +'  <td>'+data_record.nama_mk+'</td>'
                        +'  <td class="text-center">'+data_record.jml_sks+'</td>'            
                        +'  <td class="text-center">'+data_record.ruang+'</td>'            
                        +'  <td>'+data_record.nama_ptk+'</td>'            
                        +'  <td class="text-center">'
                        +action
                        +'  </td>'
                        +'</tr>'                  
                      );
                      no_kelas = data_record.id_jdl;
                    }
                    else{
                      $('table.tbl-data-jadwal').find('tbody').append(
                        '<tr'+row_color+'>'
                        +select_btn
                        +'  <td class="text-center">'+data_record.hari_jdl+'</td>'
                        +'  <td class="text-center">'+data_record.jam_mulai_jdl+' - '+data_record.jam_akhir_jdl+'</td>'
                        +'  <td>'+data_record.nama_mk+'</td>'
                        +'  <td class="text-center">'+data_record.jml_sks+'</td>'            
                        +'  <td class="text-center">'+data_record.ruang+'</td>'            
                        +'  <td>'+data_record.nama_ptk+'</td>'            
                        +'  <td class="text-center">'
                        +action
                        +'  </td>'
                        +'</tr>'                  
                      );
                    }
                    no++;
                }
              });
              $('table.tbl-data-jadwal .kelas-row'+no_kelas+'').attr('rowspan',no-1);
              loop_row++;
            }
            else if (data_u.jenis_jdl != 0){
              dt_kelas = data_kelas.semester+'/'+data_kelas.kelas;
              $.each(detail_jadwal.record_jadwal, function(index,data_record){
                var semester = data_record.thn_ajaran_jdl.substr(5,1),
                thn_ajaran = data_record.thn_ajaran_jdl.substr(0,4);
                if (semester == 1) {
                  semester = 'Ganjil';
                }
                else{
                  semester = 'Genap';
                }
                $('#box-jadwal span.thn-ajaran-jad').text(thn_ajaran+'/'+semester);
                $('#box-jadwal span.prodi-jad').text(data_record.nama_prodi);
                if (data_record.status_jdl == 1) {
                  var action = '<div class="btn-group">' 
                              +'    <button class="btn btn-warning btn-sm view-kelas" value="'+data_record.id_jdl+'" title="Lihat daftar mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button>'
                              +'    <a href="#edit?jadwal='+data_record.id_jdl+'" class="btn btn-success btn-sm" title="Edit jadwal"><i class="fa fa-pencil-square"></i></a>'
                              +'    <a href="#hapus?jadwal='+data_record.id_jdl+'" class="btn btn-danger btn-sm" title="Hapus jadwal"><i class="fa fa-trash"></i></a>'
                              +'</div>',
                  select_btn = '  <td class="text-center"><input type="checkbox" class="check-data check-jadwal" value="'+data_record.id_jdl+'/'+data_record.id_pd_mk+'/'+data_record.id_pd_mk+'" data-selected="check-jadwal" data-all-selected="check-all-jadwal" data-toggle=".box-jadwal-mk-control .hapus"></td>';
                }
                else{
                  var action = '<div class="btn-group"><button class="btn btn-warning btn-sm view-kelas" value="'+data_record.id_jdl+'" title="Lihat daftar mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button></div>',
                  select_btn = '  <td class="text-center"></td>';
                }
                if (data_record.nama_mk == null || data_record.nama_mk == '') {
                  data_record.nama_mk = '-';
                  data_record.jml_sks = '-';
                }
                if (data_record.nama_ptk == null || data_record.nama_ptk== '') {
                  data_record.nama_ptk = '-';
                }
                kelas = data_record.semester+'/'+data_record.kelas;
                if (kelas == dt_kelas && data_record.jenis_jdl == data_u.jenis_jdl) {
                  if (no == 1) {
                    $('table.tbl-data-jadwal').find('tbody').append(
                      '<tr>'
                      +'  <td colspan="9" align="left"><b>Konsentrasi '+data_record.nm_konsentrasi+'</b></td>'
                      +'</tr>'                  
                      +'<tr>'
                      +select_btn
                      +'  <td class="text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                      +'  <td class="text-center">'+data_record.hari_jdl+'</td>'
                      +'  <td class="text-center">'+data_record.jam_mulai_jdl+' - '+data_record.jam_akhir_jdl+'</td>'
                      +'  <td>'+data_record.nama_mk+'</td>'
                      +'  <td class="text-center">'+data_record.jml_sks+'</td>'            
                      +'  <td class="text-center">'+data_record.ruang+'</td>'            
                      +'  <td>'+data_record.nama_ptk+'</td>'            
                      +'  <td class="text-center">'
                      +action
                      +'  </td>'
                      +'</tr>'                  
                    );
                  }
                  else{
                    $('table.tbl-data-jadwal').find('tbody').append(
                      '<tr>'
                      +select_btn
                      +'  <td class="text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                      +'  <td class="text-center">'+data_record.hari_jdl+'</td>'
                      +'  <td class="text-center">'+data_record.jam_mulai_jdl+' - '+data_record.jam_akhir_jdl+'</td>'
                      +'  <td>'+data_record.nama_mk+'</td>'
                      +'  <td class="text-center">'+data_record.jml_sks+'</td>'            
                      +'  <td class="text-center">'+data_record.ruang+'</td>'            
                      +'  <td>'+data_record.nama_ptk+'</td>'            
                      +'  <td class="text-center">'
                      +action
                      +'  </td>'
                      +'</tr>'                  
                    );
                  }
                no++;
                }
              });
            }
          });
        });
        $('input[type="checkbox"]').iCheck({      
          checkboxClass: 'icheckbox_flat-blue'
        });
      }
      else{
        if ($update == true) {
          $('#box-kelas-mhs,#box-jadwal').slideUp();
          $('table.tbl-data-jadwal').find('tbody').text('');
        }
        else{
          swal({
            title:'Info',
            text: 'Tahun akademik dan program studi yang anda pilih belum memiliki jadwal kuliah!',
            type:'info',
            timer: 2000
          });
        }
      }
      $('#box-jadwal').find('div.overlay').fadeOut();
      $('.tamp-jadwal').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
    }).catch(function(){
      $('.tamp-jadwal').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
    });
  }
  /*END -- Function: Table jadwal*/

  /*Function: Table daftar mahasiswa - kelas*/
  function daftar_kelas_mhs(kelas,update,c_kls){
    $('.check-all-mhs-kelas').iCheck('uncheck');
    $('.hapus-mhs').addClass('disabled');
    if (kelas!=null) {
      $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="7" align="center"><font class="load-data">Memproses Data</font></td></tr>');
      var data = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{kelas:kelas,data:'daftar_kelas_mhs'},500);
      data.then(function(detail_kelas){
        if (detail_kelas.record_kelas != '') {
          if ($('#box-kelas-mhs').is(':visible')) {
            $('#box-kelas-mhs').find('div.overlay').fadeIn();
            delay(function(){
              $('#box-kelas-mhs').find('div.overlay').fadeOut();
              $('html, body').animate({scrollTop:$('#box-kelas-mhs').offset().top - 55},800);
            },500);
          }
          else{
            $('#box-kelas-mhs').fadeIn();
            delay(function(){
              $('#box-kelas-mhs').find('div.overlay').fadeOut();
              $('html, body').animate({scrollTop:$('#box-kelas-mhs').offset().top - 55},800);
            },100);
          }
          var status_jdl,
          id_jdl;
          $.each(detail_kelas.record_kelas, function(index, data_record){
            $.each(data_record, function(index, data_record){
              if (data_record == null || data_record == '') {
                data_record = '-';
              }
              $('.detail-kelas .detail-kelas-'+index).text(data_record);
            });
            if (data_record.jenis_jdl != '0') {
              $('.detail-kelas .detail-kelas-nama_mk').text(data_record.nama_mk+' (Konsentrasi '+data_record.nm_konsentrasi+')');
            }
            status_jdl = data_record.status_jdl;
            if (status_jdl == 1) {
              id_jdl = data_record.id_jdl;
              $('#box-kelas-mhs .kelas-mhs-cp').show();
              $('table.tbl-daftar-kelas-mhs .check-all-mhs-kelas').parents('th').show();
              $('table.tbl-daftar-kelas-mhs th.action-kelas').show();
              $('#box-kelas-mhs .tambah-mhs-kls').attr('href','#tambah?kelas_mhs='+id_jdl+'');
              $('#box-kelas-mhs .hapus-mhs').attr('href','#delete_selected?kls_mhs='+id_jdl+'&data=kls_mhs');
              $('#box-kelas-mhs .pindah-kelas').attr('href','#edit?kls_mhs='+id_jdl+'');
              $('#myModal #kelas_mhs').val(data_record.id_jdl);
            }
            else{
              $('#box-kelas-mhs .kelas-mhs-cp').hide();
              $('table.tbl-daftar-kelas-mhs .check-all-mhs-kelas').parents('th').hide();
              $('table.tbl-daftar-kelas-mhs th.action-kelas').hide();
            }
          });
          if (detail_kelas.record_mhs != '') {
            $('.tbl-daftar-kelas-mhs').find('tbody').text('');
            $.each(detail_kelas.record_mhs, function(index, data_record){
              var action,select,check;
              if (data_record.status_mhs_kls == 1) {
                check = 'Aktif';
              }
              else{
                check = 'Tidak Aktif';
              }
              if (status_jdl == 1) {
                action = '<td class="text-center">'
                        +'  <div class="btn-group">'
                        +'    <a href="#edit?kelas='+data_record.id_kelas+'" class="btn btn-success btn-sm" title="Pindah kelas"><i class="fa fa-pencil-square"></i></a>'
                        +'    <a href="#hapus?kelas='+data_record.id_kelas+'" class="btn btn-danger btn-sm" title="Hapus dari daftar kelas"><i class="fa fa-trash"></i></a>'
                        +'  </div>'
                        +'</td>';
                select = '  <td class="text-center"><input type="checkbox" class="check-data check-mhs-kls" value="'+data_record.id_kelas+'" data-search="'+data_record.in_mhs+'" data-selected="check-mhs-kls" data-all-selected="check-all-mhs-kelas" data-toggle=".box-kelas-control .pindah-kelas,.box-kelas-control .hapus-mhs"></td>'
                $('table.tbl-daftar-kelas-mhs .check-all-mhs-kelas').parents('th').show();
                $('table.tbl-daftar-kelas-mhs th.action-kelas').show();
                /*if (data_record.status_mhs_kls == 1) {
                  check = '<input type="checkbox" class="check-status-mhs-kls" checked value="'+data_record.id_kelas+'"/>';
                }
                else{
                  check = '<input type="checkbox" class="check-status-mhs-kls" value="'+data_record.id_kelas+'"/>';
                }*/
              }
              else{
                $('table.tbl-daftar-kelas-mhs .check-all-mhs-kelas').parents('th').hide();
                $('table.tbl-daftar-kelas-mhs th.action-kelas').hide();
              }
              $('table.tbl-daftar-kelas-mhs').find('tbody').append(
                '<tr>'
                +select
                +'  <td class="text-center">'+data_record.nisn+'</td>'
                +'  <td>'+data_record.nama+'</td>'
                +'  <td class="text-center">'+data_record.tahun_angkatan+'</td>'
                +'  <td class="text-center">'+check+'</td>'
                +action
                +'</tr>'                  
              );
            });
          }
          else{
            if (status_jdl == 1) {
              $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="6" align="center">Untuk sekarang kelas ini belum memiliki mahasiswa, silahkan klik <a href="#tambah?kelas_mhs='+id_jdl+'" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Mahasiswa</a></td></tr>');
            }
            else{
              $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="4" align="center">Untuk sekarang kelas ini belum memiliki mahasiswa</td></tr>');
            }
          }
        }
        else{
          swal({
            title:'Info',
            text: 'Kelas yang anda pilih tidak terdaftar dalam database!',
            type:'info',
            timer: 2000
          });
        }
        $('.check-mhs-kls').iCheck({      
          checkboxClass: 'icheckbox_flat-blue'
        });
        $('.view-kelas').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      }).catch(function(){
        $('.view-kelas').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      });
    }
    else{
      $('.tbl-daftar-kelas-mhs').find('tbody').text('');
      $('#box-kelas-mhs .kelas-mhs-cp').show();
      $('table.tbl-daftar-kelas-mhs .check-all-mhs-kelas').parents('th').show();
      $('table.tbl-daftar-kelas-mhs th.action-kelas').show();
      if (update != '') {
        $.each(update, function(index, data_record){
          if (data_record.status_mhs_kls == 1) {
            var check = 'Aktif';
          }
          else{
            var check = 'Tidak Aktif';
          }
          $('table.tbl-daftar-kelas-mhs').find('tbody').append(
            '<tr>'
            +'  <td class="text-center"><input type="checkbox" class="check-data check-mhs-kls" value="'+data_record.id_kelas+'" data-search="'+data_record.in_mhs+'" data-selected="check-mhs-kls" data-all-selected="check-all-mhs-kelas" data-toggle=".box-kelas-control .pindah-kelas,.box-kelas-control .hapus-mhs"></td>'
            +'  <td class="text-center">'+data_record.nisn+'</td>'
            +'  <td>'+data_record.nama+'</td>'
            +'  <td class="text-center">'+data_record.tahun_angkatan+'</td>'
            +'  <td class="text-center">'+check+'</td>'
            +'  <td class="text-center">'
            +'  <div class="btn-group">'
            +'    <a href="#edit?kelas='+data_record.id_kelas+'" class="btn btn-success btn-sm" title="Pindah kelas"><i class="fa fa-pencil-square"></i></a>'
            +'    <a href="#hapus?kelas='+data_record.id_kelas+'" class="btn btn-danger btn-sm" title="Hapus dari daftar kelas"><i class="fa fa-trash"></i></a>'
            +'  </div>'
            +'  </td>'
            +'</tr>'                  
          );
        });
      }
      else{
        $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="7" align="center">Untuk sekarang kelas ini belum memiliki mahasiswa, silahkan klik <a href="#tambah?kelas_mhs='+c_kls+'" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Mahasiswa</a></td></tr>');
      }
    }
    $('.check-mhs-kls').iCheck({      
      checkboxClass: 'icheckbox_flat-blue'
    });
    $('.check-status-mhs-kls').bootstrapToggle({
      on:'<i class="fa fa-check-circle"></i> Aktif',
      off:'<i class="fa fa-ban"></i> Tidak Aktif',
      size:'small',
      onstyle:'success',
      offstyle:'danger',
      width: 100,
    });
  }
  /*END -- Function: Table daftar mahasiswa - kelas*/

  /*Function: Detail Fakultas*/
  function data_detail_fk(i){
    $('.check-all-prodi').iCheck('uncheck');
    $('.detail-data-fk[data-search='+i+']').find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
    var detail_fak = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id:i,data:'detail_fk'},500);
    detail_fak.then(function(detail_fak){
      $('.detail-data-fk').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      if (detail_fak.data != '') {
        $('#box-detail-fk .tbl-data-prodi').find('tbody').text('');
        $('#box-detail-fk').slideDown();
        $('#box-detail-fk').find('div.overlay').fadeIn();
        $('html, body').animate({scrollTop:$('#box-detail-fk').offset().top},800);
        delay(function(){
          $('#box-detail-fk').find('div.overlay').fadeOut();
        },500);
        $.each(detail_fak.count_fk_mhs, function(index, data_record){
          if (data_record =='' || data_record =='0') {
            data_record='-';
          }
          $('#box-detail-fk .detail-fak-'+index).text(data_record);
        });
        var no = 1;
        $.each(detail_fak.data, function(index, data_record){
          $.each(data_record, function(index, data_record){              
            if (data_record =='' || data_record =='0' || data_record =='0000-00-00') {
              data_record='-';
            }
            if (index=='nama_fakultas' || index=='dekan' || index=='tgl_berdiri' || index=='akreditasi_fk') {
              $('#box-detail-fk .detail-fak-'+index).text(data_record);
            }                
          });
          if (data_record.status_prodi == 1) {
            data_record.status_prodi = 'Aktif';
          }
          else{
            data_record.status_prodi = 'Tidak Aktif';
          }
          $('#box-detail-fk .tbl-data-prodi').find('tbody').append(
            '<tr>'
            /*+'  <td align="center"><input type="checkbox" class="check-prodi" name="id_prodi" value="'+data_record.id_prodi+'/'+data_record.id_fk_pd+'"></td>'*/
            +'  <td class="text-center">'+no+'</td>'
            +'  <td class="text-center">'+data_record.kode_prodi+'</td>'
            +'  <td class="daftar-nm-pd">'+data_record.nama_prodi+'</td>'
            +'  <td class="text-center">'+data_record.status_prodi+'</td>'
            +'  <td class="text-center">'+data_record.jenjang_prodi+'</td>'
            +'  <td class="text-center">'
            +'    <a href="#tambah?data=konsentrasi_prodi&prodi_kons='+data_record.nama_prodi.replace(' ','_').toLowerCase()+'&i='+data_record.id_prodi+'&token='+token+'" class="btn btn-info btn-sm" title="Tambah Konsentrasi pada Program Studi '+data_record.nama_prodi+'"><i class="fa fa-plus"></i></a> | '
            +'    <div class="btn-group">'
            +'      <a href="#data?pd='+data_record.id_prodi+'&token='+token+'" class="btn btn-warning btn-sm data-detail-prodi" data-search="'+data_record.id_prodi+'" title="Lihat Detail Program Studi '+data_record.nama_prodi+'"><i class="fa fa-list"></i></a> '
            +'      <a href="#edit?pd='+data_record.id_prodi+'&token='+token+'" class="btn btn-success btn-sm" title="Edit Data Program Studi '+data_record.nama_prodi+'"><i class="fa fa-pencil-square"></i></a> '
            +'      <a href="#hapus?pd='+data_record.id_prodi+'&token='+token+'" class="btn btn-danger btn-sm" title="Hapus Data Program Studi '+data_record.nama_prodi+'"><i class="fa fa-trash"></i></a>'
            +'    </div>'
            +'  </td>'
            +'</tr>'
            );
          no++;
        });
        $('input[type="checkbox"]').iCheck({      
          checkboxClass: 'icheckbox_flat-blue'
        });
      }
      else{
        swal({
          title:'Info',
          text: 'Fakultas yang anda pilih belum memiliki program studi!',
          type:'info',
          timer: 2000
        });
        $('#box-detail-fk').slideUp();
      }
    }).catch(function(jqXHR){
      window.history.pushState(null,null,path);
      $('.detail-data-fk').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      swal({
        title:'Error',
        html: 'Maaf, terjadi kesalahan!'
            +'<p style="text-align:right;"><a href="" class="show-error">Show Error</a></p><div style="font-family:Segoe UI;text-align: center;display:none" class="error-detail">Error '+jqXHR.status+': '+jqXHR.statusText+'</div>',
        type:'error',
      });
    });
  }
  /*END -- Function: Detail Fakultas*/

  /*Function: Daftar Konsentrasi*/
  function daftar_konsentrasi(data,index){
    if (data != null) {
      var data_konsentrasi_pd = data;
    }
    else{
      var data_konsentrasi_pd = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{id_konst:index,data:'daftar_konsentrasi_pd'},500);
    }
    $('.tbl-data-konst-pd').find('tbody').append('<tr class=".table-load"><td class="text-center load-data" colspan="3">Memproses Data</td></tr>');
    data_konsentrasi_pd.then(function(data_konsentrasi_pd){
      var no = 1;
      if (data_konsentrasi_pd.data != '') {
        $('.box-konsentrasi-pd').show();
        $('.box-konsentrasi-pd').attr('data-search',data_konsentrasi_pd.data[0]['id_pd_konst']);
        $('.tbl-data-konst-pd').find('tbody').text('');
        $.each(data_konsentrasi_pd.data, function(index, data_record){
          if (data_record.id_konst !=null) {
            $('.tbl-data-konst-pd').find('tbody').append(
              '<tr>'
              +'  <td class="text-center">'+no+'</td>'
              +'  <td>'+data_record.nm_konsentrasi+'</td>'
              +'  <td class="text-center">'
              +'    <div class="btn-group">'
              +'      <a href="#edit?data=konsentrasi_prodi&konsentrasi='+data_record.id_konst+'&token='+token+'" class="btn btn-success btn-sm" title="Edit Konsentrasi Program Studi '+data_record.nama_prodi+'"><i class="fa fa-pencil-square"></i></a> '
              +'      <a href="#hapus?data=konsentrasi_prodi&konsentrasi='+data_record.id_konst+'&token='+token+'" class="btn btn-danger btn-sm" title="Hapus Konsentrasi Program Studi '+data_record.nama_prodi+'"><i class="fa fa-trash"></i></a>'
              +'    </div>'
              +'  </td>'
              +'</tr>'   
            );
            no++;
          }
          else{
            $('.box-konsentrasi-pd').hide();
            $('.tbl-data-konst-pd').find('tbody').html('<tr class="text-center"><td colspan="3">Program studi ini tidak memiliki konsentrasi</td></tr>');
            return false;
          }
        });
      }
      else{
        $('.box-konsentrasi-pd').hide();
        $('.tbl-data-konst-pd').find('tbody').html('<tr class="text-center"><td colspan="3">Program studi ini tidak memiliki konsentrasi</td></tr>');
      }
    }).catch(function(error){
      if ($('.tbl-data-konst-pd tr.table-load').length == 1) {
        $('.tbl-data-konst-pd tr.table-load td').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
      }
      setTimeout(function(){
        $('.tbl-data-konst-pd tr.table-load').replaceWith('');
      },2000);
    });
  }
  /*END -- Function: Daftar Konsentrasi*/

  /*Function: Table daftar mata kuliah*/
  function daftar_mk(pd){
    $('.check-all-mk').iCheck('uncheck');
    $('html, body').animate({scrollTop:$('.box-daftar-mk').offset().top - 55},800);
    if ($('.box-daftar-mk').is(':visible')) {
      $('.box-daftar-mk').fadeIn('slow');
      $('.box-daftar-mk').find('div.overlay').fadeIn();
    }
    var data_mk = getJSON_async(hostProtocol + '//'+host+controller_path+'/data_table_request/data_mk',{pd:pd,act:'single-tbl'});
    data_mk.then(function(data_mk){
      if ($('.box-daftar-mk').is(':hidden')) {
        $('.box-daftar-mk').slideDown();
        $('.box-daftar-mk').find('div.overlay').fadeOut();
      }
      if (data_mk.prodi != '') {
        /*$('.box-daftar-mk .box-title').text('Daftar Mata Kuliah Program Studi '+data_mk.prodi[0]['nama_prodi']+'');*/
        $.each(data_mk.prodi[0], function(index, data_record){
          if (index == 'status_prodi' && data_record == 1) {
            data_record = 'Aktif';
          }
          else if (index == 'status_prodi' && data_record == 0) {
            data_record = 'Tidak Aktif';
          }

          $('.box-daftar-mk .detail-prodi-'+index).text(data_record);
        });
      }
      else{
        $('.box-daftar-mk .detail-prodi-mk').text('-');
        $('.box-daftar-mk .box-title').text('Daftar Mata Kuliah');
        swal({
          title:'Info',
          text: 'Program Studi yang anda pilih tidak terdaftar dalam database!',
          type:'info',
          timer: 2000
        });
      }
      if (data_mk.total_rows > 0) {
        $('.box-daftar-mk').attr('data-search',pd);
        $('.tbl-data-mk1, .tbl-data-mk2, .tbl-data-mk').find('tbody').text('');
        if (data_mk.total_rows == 1) {
          $('.tbl-data-mk2').hide();
        }
        else{
          $('.tbl-data-mk2').show();
        }

        if (data_mk.record_mk != null) {
          var count_mk_ket = {};
          $.each(data_mk.record_mk, function(index,data_record){
            if (data_record.jenis_jdl != 0) {
              var ket_mk = 'Konsentrasi';
              var kons = data_record.nm_konsentrasi;
              var mk_count = ket_mk+' '+kons;
            }
            else{
              var ket_mk = mk_count = 'Umum';
              var kons = '-';
            }

            count_mk_ket[mk_count] = (count_mk_ket[mk_count] || 0) + 1;

            $('.tbl-data-mk').find('tbody').append(
              '   <tr>'
              +'     <td class="text-center"><input type="checkbox" class="check-data check-mk" name="id" value="'+data_record.id_mk+'" data-selected="check-mk" data-all-selected="check-all-mk" data-toggle=".edit-mk,.hapus"></td>'
              +'     <td class="text-center">'+data_record.kode_mk+'</td>'
              +'     <td>'+data_record.nama_mk+'</td>'
              +'     <td class="text-center">'+ket_mk+'</td>'
              +'     <td>'+kons+'</td>'
              +'     <td class="text-center">'+data_record.jml_sks+'</td>'
              +'     <td class="text-center">'
              +'     <div class="btn-group">'
              +'        <a href="#edit?mk='+data_record.id_mk+'" class="btn btn-success btn-sm"><i class="fa fa-pencil-square"></i></a> '
              +'        <a href="#hapus?mk='+data_record.id_mk+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'
              +'     </div>'
              +'     </td>'
              +'  </tr>'
              );
          });

          $('.tbl-data-mk').find('tbody').append(
            '<tr>'
            +'  <td colspan="5" class="text-right">Jumlah Mata Kuliah</td>'
            +'  <td colspan="2" class="text-center">'+data_mk.record_mk.length+'</td>'
            +'</tr>'   
            );

          $.each(count_mk_ket, function(index,value){
            $('.tbl-data-mk').find('tbody').append(
              '<tr>'
              +'  <td colspan="5" class="text-right">'+index+'</td>'
              +'  <td colspan="2" class="text-center">'+value+'</td>'
              +'</tr>'   
              );
          });
        }
        else{
          $.each(data_mk.record_mk1, function(index,data_record){
            if (data_record.jenis_jdl != 0) {
              var kons = '(Konsentrasi '+data_record.nm_konsentrasi+')';
            }
            else{
              var kons = '';
            }
            $('#form-input .id_pd_mk').val(data_record.id_pd_mk);
            $('.tbl-data-mk1').find('tbody').append(
              '   <tr>'
              +'     <td class="text-center"><input type="checkbox" class="check-data check-mk" name="id" value="'+data_record.id_mk+'" data-selected="check-mk" data-all-selected="check-all-mk" data-toggle=".edit-mk,.hapus"></td>'
              +'     <td class="text-center">'+data_record.kode_mk+'</td>'
              +'     <td>'+data_record.nama_mk+' <b>'+kons+'</b></td>'
              +'     <td class="text-center">'+data_record.jml_sks+'</td>'
              +'     <td class="text-center">'
              +'     <div class="btn-group">'
              +'        <a href="#edit?mk='+data_record.id_mk+'" class="btn btn-success btn-sm"><i class="fa fa-pencil-square"></i></a> '
              +'        <a href="#hapus?mk='+data_record.id_mk+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'
              +'     </div>'
              +'     </td>'
              +'  </tr>'
              );
          });
          $.each(data_mk.record_mk2, function(index,data_record){
            if (data_record.jenis_jdl != 0) {
              var kons = '(Konsentrasi '+data_record.nm_konsentrasi+')';
            }
            else{
              var kons = '';
            }
            $('.tbl-data-mk2').find('tbody').append(
              '   <tr>'
              +'     <td class="text-center"><input type="checkbox" class="check-data check-mk" name="id" value="'+data_record.id_mk+'" data-selected="check-mk" data-all-selected="check-all-mk" data-toggle=".edit-mk,.hapus"></td>'
              +'     <td class="text-center">'+data_record.kode_mk+'</td>'
              +'     <td>'+data_record.nama_mk+' <b>'+kons+'</b></td>'
              +'     <td class="text-center">'+data_record.jml_sks+'</td>'
              +'     <td class="text-center">'
              +'     <div class="btn-group">'
              +'        <a href="#edit?mk='+data_record.id_mk+'" class="btn btn-success btn-sm"><i class="fa fa-pencil-square"></i></a> '
              +'        <a href="#hapus?mk='+data_record.id_mk+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'
              +'     </div>'
              +'     </td>'
              +'  </tr>'
              );
          });
        }

      }
      else{
        $('.tbl-data-mk2').show();
        $('.tbl-data-mk1, .tbl-data-mk2').find('tbody').html('<tr><td colspan="5" align="center">Belum ada mata kuliah yang di input</td></tr>');
        $('.tbl-data-mk').find('tbody').html('<tr><td colspan="7" align="center">Belum ada mata kuliah yang di input</td></tr>');
      }
      $('.hapus,.edit-mk').addClass('disabled');
      $('input[type="checkbox"]').iCheck({      
        checkboxClass: 'icheckbox_flat-blue'
      });
      $('.box-daftar-mk').find('div.overlay').fadeOut();
      $('.tamp-mk').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
    }).catch(function(){
      $('.tamp-mk').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      $('.box-daftar-mk').find('div.overlay').fadeOut();
    });
  }
  /*END -- Function: Table daftar mata kuliah*/

  /*Function: Daftar nilai mahasiswa*/
  function detail_nilai(thn){
    $('.tbl-nilai-mhs').find('tbody').html('<tr><td colspan="7" class="text-center load-data">Memproses Data</td></tr>');
    var detail_nilai = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{thn:thn,data:'data_nilai_mhs'},500,true);
    detail_nilai.then(function(detail_nilai){
      $('.tamp-nilai').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-file-text-o');
      $('.tamp-all-nilai').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-files-o');
      if (detail_nilai.total_rows > 0) {
        $('.tbl-nilai-mhs').find('tbody').text('');
        $('.photo-mhs').attr('src',hostProtocol + '//'+host+'/siakad-uncp/uploads/default-photo/user-image.png');
        if (detail_nilai.record_nilai[0]['photo_mhs'] != '') {
          $('.photo-mhs').attr('src',hostProtocol + '//'+host+'/siakad-uncp/uploads/mhs-photo/'+detail_nilai.record_nilai[0]['photo_mhs']);
        }
        $('.nama-ket').text(detail_nilai.record_nilai[0]['nama']);
        $('.nim-ket').text(detail_nilai.record_nilai[0]['nisn']);
        $('.nama-fakultas-ket').text(detail_nilai.record_nilai[0]['nama_fakultas']);
        $('.nama-prodi-ket').text(detail_nilai.record_nilai[0]['nama_prodi']);
        $('.jejang-prodi-ket').text(detail_nilai.record_nilai[0]['jenjang_prodi']);
        $('.tahun-ajaran-ket').text(detail_nilai.record_nilai[0]['thn_ajaran_jdl']);
        var no = 1;
        $.each(detail_nilai.record_nilai, function(index, data_record){
          $('.tbl-nilai-mhs').find('tbody').append(
            '<tr>'
            +'  <td class="text-center">'+no+'</td>'
            +'  <td class="text-center">'+data_record.kode_mk+'</td>'
            +'  <td>'+data_record.nama_mk+'</td>'
            +'  <td class="text-center">'+data_record.jml_sks+'</td>'
            +'  <td class="text-center">'+data_record.hm+'</td>'
            +'  <td class="text-center">'+data_record.am+'</td>'
            +'  <td class="text-center">'+data_record.mutu+'</td>'
            +'</tr>'   
            );
          no++;
        });
        $('.tbl-nilai-mhs').find('tbody').append(
          '<tr>'
          +'  <td colspan="3" class="text-right">Jumlah SKS</td>'
          +'  <td class="text-center">'+detail_nilai.sks+'</td>'
          +'  <td colspan="2"></td>'
          +'  <td class="text-center">'+detail_nilai.mutu+'</td>'
          +'</tr>'   
          );
      }
      else{
        swal({
          title:'Info',
          text: 'Tahun akademik / mahasiswa yang anda pilih tidak ada dalam database!',
          type:'info',
          timer: 2000
        });
      }
    }).catch(function(error){
      $('.tamp-nilai').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-file-text-o');
      $('.tamp-all-nilai').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-files-o');
    });
  }
  /*END -- Function: Daftar nilai mahasiswa*/

  /*Function: Chart tahun akademik*/
  function thn_akademik_chart(thn_ak){
    $('.detail-jml-mhs .progress-bar').css('width','0%');
    var data_static = getJSON_async(hostProtocol + '//'+host+controller_path+'/data_statistik',{thn_ak:thn_ak,data:'static_thn_ak'});
    data_static.then(function(data_static){
      var no = 1;
      $('.detail-jml-mhs').text('');
      $('.title-thn-ak-static').text('Data Statistik Mahasiswa Berdasarkan Tahun Akademik '+data_static.thn_ak);
      $('.detail-jml-mhs').prepend('<p class="text-center"><strong>Keterangan</strong></p>');
      $('#barchart-mhs-thn-ak').replaceWith('<canvas id="barchart-mhs-thn-ak" style="height: 315px; width: 510px;"></canvas>');
      $.each(data_static.pd, function(index,data_record){
        $('.detail-jml-mhs').append(
          '<div class="progress-group">'
          +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> '+data_record.no_prodi+': '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</span>'
          +'  <span class="progress-number">'+data_record.statik_mhs+'%</span>'
          +'  <div class="progress sm">'
          +'    <div class="progress-bar p-bar-'+no+'" style="background-color:'+data_record.color_detail+';"></div>'
          +'  </div>'
          +'</div>'
        );
        no++;
      });
      no = 1;
      setTimeout(function(){
        $.each(data_static.pd, function(index,data_record){
          $('.p-bar-'+no).css('width',data_record.statik_mhs+'%');
          no++;
        });
      },100);
      var barChartCanvas = $("#barchart-mhs-thn-ak").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas);
      var areaChartData = {
        labels: data_static.nama_prodi,
        datasets: [
          {
            label: "Laki-Laki",
            fillColor: data_static.color,
            strokeColor: data_static.color,
            pointColor: data_static.color,
            pointStrokeColor: "#c1c7d1",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: data_static.mhs_lk
          },
          {
            label: "Perempuan",
            fillColor: data_static.color,
            strokeColor: data_static.color,
            pointColor: data_static.color,
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: data_static.mhs_pr
          }
        ]
      };
      var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true,
        multiTooltipTemplate: "<%= datasetLabel %>: <%= value %> Orang",
      };
      barChartOptions.datasetFill = false;
      barChart.Bar(areaChartData, barChartOptions);
    });
  }
  /*END -- Function: Chart tahun akademik*/

  /*Function: Chart data master*/
  function data_master_chart(thn_ak,data){
    /*console.log($("#barchart-mhs-master-dt").width()+' - '+$("#barchart-mhs-master-dt").height());*/
    $('a[href="#statik-fk"], .static-mhs-tab').find('span').removeClass('fa-bar-chart').addClass('fa-circle-o-notch fa-spin');
    $('#statik-fk .load-row').remove();
    if ($("#barchart-mhs-master-dt").height() <= 315) {
      $('#statik-fk .chart-container, .static-tab .chart-container').hide();
      $('#statik-fk, .static-tab').prepend('<div class="row load-row"><div class="col-md-12 text-center"><font class="load-data">Memproses Data</font></div></div>');
    }
    $('.detail-jml-mhs-dt .progress-bar').css('width','0%');
    var data_static = getJSON_async(hostProtocol + '//'+host+controller_path+'/data_statistik',{thn_ak:thn_ak,data:data},500,true);
    data_static.then(function(data_static){
      var no = 1;
      if (data == 'static_mhs_thn_ak') {
        $('.title-master-dt').text('Data Statistik Mahasiswa Berdasarkan Tahun Akademik '+data_static.thn_ak);
      }
      else if (data == 'static_mhs_thn_angkatan') {
        $('.title-master-dt').text('Data Statistik Mahasiswa Berdasarkan Tahun Angkatan '+data_static.thn_ak);
      }
      $('a[href="#statik-fk"], .static-mhs-tab').find('span').removeClass('fa-circle-o-notch fa-spin').addClass('fa-bar-chart');
      $('#statik-fk .chart-container, .static-tab .chart-container').show();
      $('#statik-fk .load-row, .static-tab .load-row').remove();
      $('.detail-jml-mhs-dt').text('');
      $('.detail-jml-mhs-dt').prepend('<p class="text-center"><strong>Keterangan</strong></p>');
      $('#barchart-mhs-master-dt').replaceWith('<canvas id="barchart-mhs-master-dt" style="height: 335px; width: 510px;"></canvas>');
      if (data == 'static_mhs_fk') {
        var chart_label = data_static.nama_fk;
        $.each(data_static.fk, function(index,data_record){
          $('.detail-jml-mhs-dt').append(
            '<div class="progress-group">'
            +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> '+data_record.nama_fakultas+'</span>'
            +'  <span class="progress-number">'+data_record.statik_mhs+'%</span>'
            +'  <div class="progress sm">'
            +'    <div class="progress-bar p-bar-'+no+'" style="background-color:'+data_record.color_detail+';"></div>'
            +'  </div>'
            +'</div>'
          );
          no++;
        });
        no = 1;
        setTimeout(function(){
          $.each(data_static.fk, function(index,data_record){
            $('.p-bar-'+no).css('width',data_record.statik_mhs+'%');
            no++;
          });
        },100);
      }
      else{
        var chart_label = data_static.nama_prodi;
        $.each(data_static.pd, function(index,data_record){
          $('.detail-jml-mhs-dt').append(
            '<div class="progress-group">'
            +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> '+data_record.no_prodi+': '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</span>'
            +'  <span class="progress-number">'+data_record.statik_mhs+'%</span>'
            +'  <div class="progress sm">'
            +'    <div class="progress-bar p-bar-'+no+'" style="background-color:'+data_record.color_detail+';"></div>'
            +'  </div>'
            +'</div>'
          );
          no++;
        });
        no = 1;
        setTimeout(function(){
          $.each(data_static.pd, function(index,data_record){
            $('.p-bar-'+no).css('width',data_record.statik_mhs+'%');
            no++;
          });
        },100);
      }
      var barChartCanvas = $("#barchart-mhs-master-dt").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas);
      var areaChartData = {
        labels: chart_label,
        datasets: [
          {
            label: "Laki-Laki",
            fillColor: data_static.color,
            strokeColor: data_static.color,
            pointColor: data_static.color,
            pointStrokeColor: "#c1c7d1",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: data_static.mhs_lk
          },
          {
            label: "Perempuan",
            fillColor: data_static.color,
            strokeColor: data_static.color,
            pointColor: data_static.color,
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: data_static.mhs_pr
          }
        ]
      };
      var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true,
        multiTooltipTemplate: "<%= datasetLabel %>: <%= value %> Orang",
      };
      barChartOptions.datasetFill = false;
      barChart.Bar(areaChartData, barChartOptions);
    }).catch(function(){
      $('a[href="#statik-fk"], .static-mhs-tab').find('span').removeClass('fa-circle-o-notch fa-spin').addClass('fa-bar-chart');
      $('#statik-fk .load-row, .static-tab .load-row').remove();
    });
  }
  /*END -- Function: Chart data master*/

  /*Function: Table daftar backup db*/
  function load_backup_tbl(){
    $('.table-backup-db, .table-backup-tbl-db').find('tbody tr').html('<td colspan="3" class="text-center load-data">Memproses Data</td>');
    var backup_detail = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/action/ambil',{data:'backup_file',act:'get_file'},1000);
    backup_detail.then(function(backup_detail){
      if (backup_detail != '') {
        $('.table-backup-db, .table-backup-tbl-db').find('tbody tr').text('');
        $('.table-backup-db, .table-backup-tbl-db').find('tbody tr').append(
          '  <td>-</td>'
          +'  <td class="text-center">-</td>'
          +'  <td class="text-center">-</td>'
        );
        if (backup_detail.backup_db['backup_detail'] != false) {
          $('.table-backup-db').find('tbody tr').html(
            '  <td>'+backup_detail.backup_db['backup_db_name']+'</td>'
            +'  <td class="text-center">'+moment(backup_detail.backup_db['backup_detail']['date']).fromNow()+'</td>'
            +'  <td class="text-center">'
            +'    <div class="btn-group">'
            +'      <a href="'+backup_detail.backup_db['download_path']+'" class="btn btn-info btn-sm download-backup" title="Download Backup Database"><i class="fa fa-download"></i></a> '
            +'      <a href="'+backup_detail.backup_db['backup_db_name']+'" class="btn btn-danger btn-sm delete-backup" title="Hapus Backup Database"><i class="fa fa-trash"></i></a>'
            +'    </div>'
            +'  </td>'
          );
        }
        if (backup_detail.backup_db_tbl['backup_detail'] != false) {
          $('.table-backup-tbl-db').find('tbody tr').html(
            '  <td>'+backup_detail.backup_db_tbl['backup_db_name']+'</td>'
            +'  <td class="text-center">'+moment(backup_detail.backup_db_tbl['backup_detail']['date']).fromNow()+'</td>'
            +'  <td class="text-center">'
            +'    <div class="btn-group">'
            +'      <a href="'+backup_detail.backup_db_tbl['download_path']+'" class="btn btn-info btn-sm" title="Download Backup Tabel Database"><i class="fa fa-download"></i></a> '
            +'      <a href="'+backup_detail.backup_db_tbl['backup_db_name']+'" class="btn btn-danger btn-sm delete-backup" title="Hapus Backup Tabel Database"><i class="fa fa-trash"></i></a>'
            +'    </div>'
            +'  </td>'
          );
        }
      }
    }).catch(function(error){
    });
  }
  /*END -- Function: Table daftar backup db*/

  /*Function: Table detail akademik mahasiswa*/
  function detail_akademik_mhs(){
    if ($('.tbl-riwayat-studi-mhs tr.table-load').length == 0) {
      $('.tbl-riwayat-studi-mhs').find('tbody').append('<tr class="table-load"><td class="text-center load-data" colspan="5">Memproses Data</td></tr>');
    }
    if ($('.tbl-riwayat-kuliah-mhs tr.table-load').length == 0) {
      $('.tbl-riwayat-kuliah-mhs').find('tbody').append('<tr class="table-load"><td class="text-center load-data" colspan="4">Memproses Data</td></tr>');
    }
    var data_akademik = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_mhs:id_data_akademik_u,data:'riwayat_akademik_mhs'},1000);
    data_akademik.then(function(data_akademik){
      if (data_akademik.record_akademik != '') {
        $('.tbl-riwayat-studi-mhs, .tbl-riwayat-kuliah-mhs').find('tbody').text('');
        var no = 1,
        no_a = 1,
        thn_akademik;
        $.each(data_akademik.record_akademik, function(index, data_record){
          $('.tbl-riwayat-studi-mhs').find('tbody').append(
            '<tr>'
            +'  <td class="text-center">'+no+'</td>'
            +'  <td class="text-center">'+data_record.thn_ajaran_jdl+'</td>'
            +'  <td class="text-center">'+data_record.kode_mk+'</td>'
            +'  <td>'+data_record.nama_mk+'</td>'
            +'  <td class="text-center">'+data_record.jml_sks+'</td>'
            +'</tr>'   
            );
          no++;
          if (data_record.status_aktif_mhs == 'Aktif' && data_record.statik_aktif_mhs >= 50) {
            var status_aktif_mhs = '<button type="button" class="btn btn-success btn-sm" style="width:100px;pointer-events:none;cursor:default">'
              +'  <b><i class="fa fa-check-circle"></i> Aktif</b>'
              +'</button>';
          }
          else{
            var status_aktif_mhs = '<button type="button" class="btn btn-danger btn-sm" style="width:100px;pointer-events:none;cursor:default">'
              +'  <b><i class="fa fa-times"></i> Tidak Aktif</b>'
              +'</button>';
          }
          if (data_record.thn_ajaran_jdl != thn_akademik) {
            $('.tbl-riwayat-kuliah-mhs').find('tbody').append(
              '<tr>'
              +'  <td class="text-center">'+no_a+'</td>'
              +'  <td class="text-center">'+data_record.thn_ajaran_jdl+'</td>'
              +'  <td class="text-center">'+status_aktif_mhs+'</td>'
              +'  <td class="text-center">'+data_record.total_sks+'</td>'
              +'</tr>'   
              );
            no_a++;
            thn_akademik = data_record.thn_ajaran_jdl;
          }
        });
      }
      else{
        $('.tbl-riwayat-kuliah-mhs').find('tbody').html(
          '<tr>'
          +'  <td colspan="4" align="center">Untuk saat ini, mahasiswa ini belum memiliki riwayat kuliah</td>'
          +'</tr>'
          );
        $('.tbl-riwayat-studi-mhs').find('tbody').html(
          '<tr>'
          +'  <td colspan="5" align="center">Untuk saat ini, mahasiswa ini belum memiliki riwayat studi</td>'
          +'</tr>'
          );
      }
    }).catch(function(error){
      if ($('.tbl-riwayat-studi-mhs tr.table-load').length == 1) {
        $('.tbl-riwayat-studi-mhs tr.table-load td').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
      }
      if ($('.tbl-riwayat-kuliah-mhs tr.table-load').length == 1) {
        $('.tbl-riwayat-kuliah-mhs tr.table-load td').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
      }
      setTimeout(function(){
        $('.tbl-riwayat-studi-mhs tr.table-load, .tbl-riwayat-kuliah-mhs tr.table-load').replaceWith('');
      },2000);
    });
  }
  /*END -- Function: Table detail akademik mahasiswa*/

  /*Function: Table detail data PTK*/
  function detail_data_ptk(data){
    var data_studi = null,
    data_mengajar = null,
    data_penelitian = null;
    if (data == null) {
      $('.tbl-pend-ptk').find('tbody').html('<tr class="load-row"><td colspan="6" class="text-center load-data">Memproses Data</td></tr>');
      $('.tbl-riwayat-ptk').find('tbody').html('<tr class="load-row"><td colspan="6" class="text-center load-data">Memproses Data</td></tr>');
      $('.tbl-penelitian-ptk').find('tbody').html('<tr class="load-row"><td colspan="5" class="text-center load-data">Memproses Data</td></tr>');
      var data_ptk_a = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_ptk:id_data_akademik_u,data:'detail_data_ptk',get_data:'all'});
    }
    else{
      if (data == 'studi_ptk') {
        $('.tbl-pend-ptk').find('tbody').html('<tr><td colspan="6" class="text-center load-data">Memproses Data</td></tr>');
      }
      else if (data == 'penelitian_ptk') {
        $('.tbl-penelitian-ptk').find('tbody').html('<tr><td colspan="5" class="text-center load-data">Memproses Data</td></tr>');
      }
      var data_ptk_a = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{in_ptk:id_data_akademik_u,data:'detail_data_ptk',get_data:data});
    }

    data_ptk_a.then(function(data_ptk_a){
      if (data == null) {
        data_studi = data_ptk_a.studi_ptk;
        data_mengajar = data_ptk_a.riwayat_mengajar;
        data_penelitian = data_ptk_a.penelitian_ptk;
      }
      else{
        if (data == 'studi_ptk') {
          data_studi = data_ptk_a.studi_ptk;
        }
        else if (data == 'penelitian_ptk') {
          data_penelitian = data_ptk_a.penelitian_ptk;
        }
      }

      if (data_studi != null && data_studi != '') {
        var studi_ptk = data_studi;
        $('.tbl-pend-ptk').find('tbody').text('');
        var no = 1;
        $.each(studi_ptk, function(index, data_record){
          $('.tbl-pend-ptk').find('tbody').append(
            '<tr>'
            +'  <td class="text-center">'+no+'</td>'
            +'  <td>'+data_record.nama_pt_studi+'</td>'
            +'  <td class="text-center">'+data_record.gelar_ak_ptk+'</td>'
            +'  <td class="text-center">'+data_record.tgl_ijazah_ptk+'</td>'
            +'  <td class="text-center">'+data_record.jenjang_studi_ptk+'</td>'
            +'  <td class="text-center">'
            +'    <div class="btn-group">'
            +'      <a href="#edit?data=pend_ptk&studi_ptk='+data_record.in_studi+'" class="btn btn-success btn-sm" title="Edit Studi Tenaga Pendidik"><i class="fa fa-pencil-square"></i></a>'
            +'      <a href="#hapus?data=pend_ptk&studi_ptk='+data_record.in_studi+'" class="btn btn-danger btn-sm" title="Hapus Studi Tenaga Pendidik"><i class="fa fa-trash"></i></a>'
            +'    </div>'
            +'  </td>'
            +'</tr>'   
            );
          no++;
        });
      }
      else if (data_studi != null && data_studi == '') {
        $('.tbl-pend-ptk').find('tbody').html(
          '<tr>'
          +'  <td colspan="6" align="center">Untuk saat ini, tenaga pendidik ini belum memiliki riwayat pendidikan</td>'
          +'</tr>'
          );
      }

      if (data_mengajar != null && data_mengajar != '') {
        $('.tbl-riwayat-ptk').find('tbody').text('');
        var no = 1;
        $.each(data_mengajar, function(index, data_record){
          $('.tbl-riwayat-ptk').find('tbody').append(
            '<tr>'
            +'  <td class="text-center">'+no+'</td>'
            +'  <td class="text-center">'+data_record.thn_ajaran_jdl+'</td>'
            +'  <td class="text-center">'+data_record.kode_mk+'</td>'
            +'  <td>'+data_record.nama_mk+'</td>'
            +'  <td class="text-center">'+data_record.kelas+'</td>'
            +'  <td>'+data_record.nama_prodi+'</td>'
            +'</tr>'   
            );
          no++;
        });
      }
      else if (data_mengajar != null && data_mengajar == ''){
        $('.tbl-riwayat-ptk').find('tbody').html(
          '<tr>'
          +'  <td colspan="6" align="center">Untuk saat ini, tenaga pendidik ini belum memiliki riwayat mengajar</td>'
          +'</tr>'
          );
      }

      if (data_penelitian != null && data_penelitian != '') {
        var penelitian_ptk = data_penelitian;
        $('.tbl-penelitian-ptk').find('tbody').text('');
        var no = 1;
        $.each(penelitian_ptk, function(index, data_record){
          $('.tbl-penelitian-ptk').find('tbody').append(
            '<tr>'
            +'  <td class="text-center">'+no+'</td>'
            +'  <td>'+data_record.judul_penelitian+'</td>'
            +'  <td class="text-center">'+data_record.bidang_ilmu+'</td>'
            +'  <td>'+data_record.lembaga+'</td>'
            +'  <td class="text-center">'
            +'    <div class="btn-group">'
            +'      <a href="#edit?data=research_ptk&research_ptk='+data_record.in_research+'" class="btn btn-success btn-sm" title="Edit Data Penelitian Tenaga Pendidik"><i class="fa fa-pencil-square"></i></a>'
            +'      <a href="#hapus?data=research_ptk&research_ptk='+data_record.in_research+'" class="btn btn-danger btn-sm" title="Hapus Data Penelitian Tenaga Pendidik"><i class="fa fa-trash"></i></a>'
            +'    </div>'
            +'  </td>'
            +'</tr>'   
            );
          no++;
        });
      }
      else if (data_penelitian != null && data_penelitian == '') {
        $('.tbl-penelitian-ptk').find('tbody').html(
          '<tr>'
          +'  <td colspan="5" align="center">Untuk saat ini, tenaga pendidik ini belum memiliki riwayat penelitian</td>'
          +'</tr>'
          );
      }
    }).catch(function(error){
      if (data == null) {
        $('.tbl-pend-ptk').find('tbody').html('<tr><td colspan="6" class="text-center load-data">Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b></td></tr>');
        $('.tbl-riwayat-ptk').find('tbody').html('<tr><td colspan="6" class="text-center load-data">Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b></td></tr>');
        $('.tbl-penelitian-ptk').find('tbody').html('<tr><td colspan="5" class="text-center load-data">Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b></td></tr>');
      }
      else if (data == 'studi_ptk') {
        $('.tbl-pend-ptk').find('tbody').html('<tr><td colspan="6" class="text-center load-data">Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b></td></tr>');
      }
      else if (data == 'penelitian_ptk') {
        $('.tbl-penelitian-ptk').find('tbody').html('<tr><td colspan="5" class="text-center load-data">Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b></td></tr>');
      }
    });
  }
  /*END -- Function: Table detail data PTK*/

  /*Function: Chart alumni & mahasiswa DO*/
  function line_chart_alumni_do(pd,lk,pr,color,bar){
    var barChartCanvas = $(bar).get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var areaChartData = {
        labels: pd,
        datasets: [
          {
            label: "Laki-Laki",
            fillColor: color,
            strokeColor: color,
            pointColor: color,
            pointStrokeColor: "#c1c7d1",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: lk
          },
          {
            label: "Perempuan",
            fillColor: color,
            strokeColor: color,
            pointColor: color,
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: pr
          }
        ]
      };
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true,
      multiTooltipTemplate: "<%= datasetLabel %>: <%= value %> Orang",
    };
    barChartOptions.datasetFill = false;
    barChart.Bar(areaChartData, barChartOptions);
  }
  /*END -- Function: Chart alumni & mahasiswa DO*/

  /*Function: List Menu*/
  function list_menu(data,menu_lvl){
    $('#menu-set').find('div.overlay').fadeIn();
    var menu_list = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/action/ambil',{act:'get',data:'list_menu',menu:data},500);
    menu_list.then(function(menu_list){
      $('#menu-set').find('div.overlay').fadeOut();
      if (menu_list.login_rld == null || menu_list.login_rld == undefined) {
        if (menu_list.total_rows > 0) {
          var main_menu = new Promise(function(solve,reject){
            if (data == 'all') {
              $('#admin-list-menu, #user-list-menu').html('');
            }
            else if (data == 'admin-menu') {
              $('#admin-list-menu').html('');
            }
            else if (data == 'user-menu') {
              $('#user-list-menu').html('');
            }

            $.each(menu_list.parents_menu, function(index,data_record){
              if (data_record.level_access_menu == 'admin') {
                $('#admin-list-menu').append(
                  '<div class="panel box list" style="border-left: 4px solid '+data_record.color_menu+' !important;border:none;margin-bottom: 5px;margin-left: 1px;width: 99.7%" data-in-menu="'+data_record.id_menu+'" menu-type="main-menu">'
                  +'  <div class="box-header with-border">'
                  +'      <h4 class="box-title">'
                  +'        <span class="handle">'
                  +'            <i class="fa fa-sort"></i>'
                  +'          </span>'
                  +'          <a data-toggle="collapse" data-parent="#accordion" href="#box-main-menu-'+data_record.id_menu+'" aria-expanded="false" class="collapsed" style="color: '+data_record.color_menu+'">'
                  +'            <i class="'+data_record.icon_menu+'"></i> '+data_record.nm_menu
                  +'          </a>'
                  +'      </h4>'
                  +'      <div class="box-tools pull-right">'
                  +'        <div class="btn-group">'
                  +'          <a href="#tambah?data=sub-menu&in_menu='+data_record.id_menu+'&token='+token+'" class="btn btn-info btn-sm" title="Tambah sub menu pada menu '+data_record.nm_menu+'"><i class="fa fa-plus"></i></a>'
                  +'          <a href="#edit?data=menu&in_menu='+data_record.id_menu+'&token='+token+'" class="btn btn-success btn-sm" title="Edit menu '+data_record.nm_menu+'"><i class="fa fa-pencil-square"></i></a>'
                  +'          <a href="#hapus?data=menu&in_menu='+data_record.id_menu+'&token='+token+'" class="btn btn-danger btn-sm" title="Hapus Menu '+data_record.nm_menu+'"><i class="fa fa-trash"></i></a>'
                  +'          <a href="'+data_record.link_menu+'" class="btn btn-warning btn-sm" title="Buka Link Menu '+data_record.nm_menu+'" target="blank"><i class="fa fa-external-link-square"></i></a>'
                  +'        </div>'
                  +'      </div>'
                  +'  </div>'
                  +'  <div id="box-main-menu-'+data_record.id_menu+'" class="panel-collapse collapse" aria-expanded="false">'
                  +'    <div class="box-body">'
                  +'        <font>Status: '+data_record.status+'</font>'
                  +'        <h6>Sub Menu:</h6>'
                  +'        <ul class="todo-list sub-menu-list-admin subs-menu-list" style="margin-bottom: -20px;margin-top: -25px;padding:20px 0px;color: '+data_record.color_menu+'" parent-menu="'+data_record.id_menu+'" url-menu="true" lvl-menu="'+data_record.level_access_menu+'">'
                  +'        </ul>'
                  +'    </div>'
                  +'  </div>'
                  +'</div>'
                  );
              }
              else if (data_record.level_access_menu != 'admin') {
                $('#user-list-menu').append(
                  '<div class="panel box" style="border-left: 4px solid '+data_record.color_menu+' !important;border:none;margin-bottom: 5px;margin-left: 1px;width: 99.7%" data-in-menu="'+data_record.id_menu+'" menu-type="main-menu">'
                  +'  <div class="box-header with-border">'
                  +'      <h4 class="box-title">'
                  +'        <span class="handle">'
                  +'            <i class="fa fa-sort"></i>'
                  +'          </span>'
                  +'          <a data-toggle="collapse" data-parent="#accordion" href="#box-main-menu-'+data_record.id_menu+'" aria-expanded="false" class="collapsed" style="color: '+data_record.color_menu+'">'
                  +'            <i class="'+data_record.icon_menu+'"></i> '+data_record.nm_menu
                  +'          </a>'
                  +'      </h4>'
                  +'      <div class="box-tools pull-right">'
                  +'        <div class="btn-group">'
                  +'          <a href="#tambah?data=sub-menu&in_menu='+data_record.id_menu+'&token='+token+'" class="btn btn-info btn-sm" title="Tambah sub menu pada menu '+data_record.nm_menu+'"><i class="fa fa-plus"></i></a>'
                  +'          <a href="#edit?data=menu&in_menu='+data_record.id_menu+'&token='+token+'" class="btn btn-success btn-sm" title="Edit menu '+data_record.nm_menu+'"><i class="fa fa-pencil-square"></i></a>'
                  +'          <a href="#hapus?data=menu&in_menu='+data_record.id_menu+'&token='+token+'" class="btn btn-danger btn-sm" title="Hapus Menu '+data_record.nm_menu+'"><i class="fa fa-trash"></i></a>'
                  /*+'          <a href="'+data_record.link_menu+'" class="btn btn-warning btn-sm" title="Buka Link Menu '+data_record.nm_menu+'"><i class="fa fa-external-link-square"></i></a>'*/
                  +'        </div>'
                  +'      </div>'
                  +'  </div>'
                  +'  <div id="box-main-menu-'+data_record.id_menu+'" class="panel-collapse collapse" aria-expanded="false">'
                  +'    <div class="box-body">'
                  +'        <font>Status: '+data_record.status+'</font>'
                  +'        <h6>Sub Menu:</h6>'
                  +'        <ul class="todo-list sub-menu-list-user subs-menu-list" style="margin-bottom: -20px;margin-top: -25px;padding:20px 0px; color: '+data_record.color_menu+'" parent-menu="'+data_record.id_menu+'" url-menu="false" lvl-menu="'+data_record.level_access_menu+'">'
                  +'        </ul>'
                  +'    </div>'
                  +'  </div>'
                  +'</div>'
                  );
              }

              if (menu_list.total_rows == index+1) {
                solve();
              }
            });
          });

          var sub_menu = new Promise(function(solve,reject){
            var unparent_sub_menu = [];
            var total_rows_sub = menu_list.sub_menu.length;
            $.each(menu_list.sub_menu, function(in_sub, data_sub){
              $('ul.subs-menu-list[parent-menu='+data_sub.id_parent_menu+']').append(
                '<li class="list" style="border-left:2px solid '+$('ul.subs-menu-list[parent-menu='+data_sub.id_parent_menu+']').css('color')+'" data-in-menu="'+data_sub.id_sub_menu+'" menu-type="sub-menu">'
                +'  <span class="handle">'
                +'    <i class="fa fa-sort"></i>'
                +'  </span>'
                +'  <span class="fa fa-circle-o icon-list" style="color: '+$('ul.subs-menu-list[parent-menu='+data_sub.id_parent_menu+']').css('color')+'"></span>'
                +'  <span class="text name-list" style="color: '+$('ul.subs-menu-list[parent-menu='+data_sub.id_parent_menu+']').css('color')+'">'+data_sub.nm_sub_menu+'</span>'
                +'  <div class="tools">'
                +'    <label class="text-muted">Status: '+data_sub.status+' - </label>'
                +'    <a href="#edit?data=sub-menu&in_menu='+data_sub.id_sub_menu+'&token='+token+'" style="padding-right:5px"><i class="fa fa-pencil-square text-green" title="Edit menu '+data_sub.nm_sub_menu+'"></i></a>'
                +'    <a href="#hapus?data=sub-menu&in_menu='+data_sub.id_sub_menu+'&token='+token+'" style="padding-right:5px"><i class="fa fa-trash text-red" title="Hapus menu '+data_sub.nm_sub_menu+'"></i></a>'
                +'  </div>'
                +'</li>'
                );

              if ($('ul.subs-menu-list[parent-menu='+data_sub.id_parent_menu+']').attr('url-menu') == 'true') {
                $('ul.subs-menu-list[parent-menu='+data_sub.id_parent_menu+'] li.list[data-in-menu='+data_sub.id_sub_menu+'] .tools').append(
                  '<a href="'+data_sub.link_sub_menu+'" target="blank"><i class="fa fa-external-link-square text-yellow" title="Buka link menu '+data_sub.nm_sub_menu+'" style="padding-right:5px"></i></a>'
                  );
              }

              if (total_rows_sub == in_sub+1) {
                solve();
              }
            });
          });

          if (data == 'all' || data == 'admin') {
            sidebar_menu_reorder(menu_list);
          }
        }
        else{
          if (data == 'all') {

          }
        }

        var list_menu_reorder = [main_menu,sub_menu];

        Promise.all(list_menu_reorder).then(function(a){
          Sortable.create(document.getElementById('admin-list-menu'),{
            group:'#admin-list-menu',
            draggable: '.panel',
            handle: 'span.handle',
            animation: 200,
            ghostClass: 'sortable-ghost',
            dataIdAttr:'data-in-menu',
            onChoose: function(obj){
            },
            onSort: function(obj){
              $('#menu-set').find('div.overlay').fadeIn();
              var option_sort = this.options;
              option_sort.disabled = true;
              var menu_reorder = [];
              $('#admin-list-menu .panel').each(function(){
                menu_reorder.push($(this).attr('data-in-menu'));
              });
              var sort_menu = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/configuration/action/update',{data:'sorting_menu',act:'sorting_menu',list_menu:menu_reorder,menu_type:'main-menu',level:'admin',menu:obj.item.dataset.inMenu,new_in:obj.newIndex+1,old_in:obj.oldIndex+1},500);
              sort_menu.then(function(respon){
                option_sort.disabled = false;
                $('#menu-set').find('div.overlay').fadeOut();
                if (respon.status == 'failed') {
                  swal({
                    title:'Error',
                    html: respon.message,
                    type:'error'
                  });
                  list_menu('admin-menu');
                }
                else if (respon.status == 'failed_list') {
                  swal({
                    title:'Error',
                    html: respon.message,
                    type:'error'
                  });
                  list_menu('admin-menu');
                }
                else{
                  sidebar_menu_reorder();
                }
              }).catch(function(error){
                option_sort.disabled = false;
                $('#menu-set').find('div.overlay').fadeOut();
                list_menu('admin-menu');
                swal({
                  title:'Error',
                  html: 'Gagal memperbahrui urutan menu',
                  type:'error'
                });
                // $('#main-menu-set').replaceWith(obj.from);
              });
              // console.log(obj.item.dataset.inMenu);
              // console.log(obj);
              // console.log(obj.to);
              // console.log(obj.from);
              // console.log(obj.oldIndex);
              // console.log(obj.newIndex);
            },
          });
          Sortable.create(document.getElementById('user-list-menu'),{
            group:'#user-list-menu',
            draggable: '.panel',
            handle: 'span.handle',
            animation: 200,
            ghostClass: 'sortable-ghost',
            dataIdAttr:'data-in-menu',
            onChoose: function(obj){
            },
            onSort: function(obj){
              var option_sort = this.options;
               option_sort.disabled = true;
              $('#menu-set').find('div.overlay').fadeIn();
              var menu_reorder = [];
              $('#user-list-menu .panel').each(function(){
                menu_reorder.push($(this).attr('data-in-menu'));
              });
              var sort_menu = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/configuration/action/update',{data:'sorting_menu',act:'sorting_menu',list_menu:menu_reorder,menu_type:'main-menu',level:'user',menu:obj.item.dataset.inMenu,new_in:obj.newIndex+1,old_in:obj.oldIndex+1},500);
              sort_menu.then(function(respon){
                option_sort.disabled = false;
                $('#menu-set').find('div.overlay').fadeOut();
                if (respon.status == 'failed') {
                  swal({
                    title:'Error',
                    html: respon.message,
                    type:'error'
                  });
                  list_menu('user-menu');
                }
                else if (respon.status == 'failed_list') {
                  swal({
                    title:'Error',
                    html: respon.message,
                    type:'error'
                  });
                  list_menu('user-menu');
                }
              }).catch(function(error){
                option_sort.disabled = false;
                $('#menu-set').find('div.overlay').fadeOut();
                list_menu('user-menu');
                swal({
                  title:'Error',
                  html: 'Gagal memperbahrui urutan menu',
                  type:'error'
                });
                // $('#main-menu-set').replaceWith(obj.from);
              });
              // console.log(obj.item.dataset.inMenu);
              console.log(obj);
              console.log(obj.to);
              console.log(obj.from);
              // console.log(obj.oldIndex);
              // console.log(obj.newIndex);
            },
          });

          $.each(document.getElementsByClassName('sub-menu-list-admin'), function(e,elements){
            Sortable.create(elements,{
              group:'.sub-menu-list-admin',
              handle: 'span.handle',
              animation: 100,
              ghostClass: 'sortable-ghost',
              dataIdAttr:'data-in-menu',
              onUpdate: function(obj){
                $('#menu-set').find('div.overlay').fadeIn();
                var option_sort = this.options;
                option_sort.disabled = true;
                var parent_menu,
                menu_reorder = [];
                $.each(obj.srcElement.attributes, function(id,attr){
                  if (obj.srcElement.attributes[id].name == 'parent-menu') {
                    parent_menu = obj.srcElement.attributes[id].nodeValue;
                  }
                });
                $('.sub-menu-list-admin[parent-menu='+parent_menu+'] li.list').each(function(){
                  menu_reorder.push($(this).attr('data-in-menu'));
                });
                var sort_sub_menu = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/configuration/action/update',{data:'sorting_menu',act:'sorting_menu',list_menu:menu_reorder,parent_menu:parent_menu,menu_type:'sub-menu',level:'admin',menu:obj.item.dataset.inMenu,new_in:obj.newIndex+1,old_in:obj.oldIndex+1},500);
                sort_sub_menu.then(function(respon){
                  option_sort.disabled = false;
                  $('#menu-set').find('div.overlay').fadeOut();
                  if (respon.status == 'failed') {
                    swal({
                      title:'Error',
                      html: respon.message,
                      type:'error'
                    });
                    list_menu('admin-menu');
                  }
                  else if (respon.status == 'failed_list') {
                    swal({
                      title:'Error',
                      html: respon.message,
                      type:'error'
                    });
                    list_menu('admin-menu');
                  }
                  else{
                    sidebar_menu_reorder();
                  }
                }).catch(function(error){
                  option_sort.disabled = false;
                  $('#menu-set').find('div.overlay').fadeOut();
                  list_menu('admin-menu');
                  swal({
                    title:'Error',
                    html: 'Gagal memperbahrui urutan sub menu',
                    type:'error'
                  });
                });
              },
              onAdd: function(obj){
                $('#menu-set').find('div.overlay').fadeIn();
                var option_sort = this.options;
                option_sort.disabled = true;
                var parent_menu,
                menu_reorder = [];
                $.each(obj.srcElement.attributes, function(id,attr){
                  if (obj.srcElement.attributes[id].name == 'parent-menu') {
                    parent_menu = obj.srcElement.attributes[id].nodeValue;
                  }
                });
                $('.sub-menu-list-admin[parent-menu='+parent_menu+'] li.list').each(function(){
                  menu_reorder.push($(this).attr('data-in-menu'));
                });
                var sub_menu_color = $('.sub-menu-list-admin[parent-menu='+parent_menu+']').css('color');
                $('.sub-menu-list-admin[parent-menu='+parent_menu+'] .list').css('border-left','2px solid '+sub_menu_color);
                $('.sub-menu-list-admin[parent-menu='+parent_menu+'] .list .icon-list, .sub-menu-list-admin[parent-menu='+parent_menu+'] .list .name-list').css('color',sub_menu_color);

                var sort_sub_menu = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/configuration/action/update',{data:'sorting_menu',act:'sorting_menu',list_menu:menu_reorder,parent_menu:parent_menu,menu_type:'sub-menu',move_sub:true,level:'admin',menu:obj.item.dataset.inMenu,new_in:obj.newIndex+1,old_in:obj.oldIndex+1},500);
                sort_sub_menu.then(function(respon){
                  option_sort.disabled = false;
                  $('#menu-set').find('div.overlay').fadeOut();
                  if (respon.status == 'failed') {
                    swal({
                      title:'Error',
                      html: respon.message,
                      type:'error'
                    });
                    list_menu('admin-menu');
                  }
                  else if (respon.status == 'failed_list') {
                    swal({
                      title:'Error',
                      html: respon.message,
                      type:'error'
                    });
                    list_menu('admin-menu');
                  }
                  else{
                    sidebar_menu_reorder();
                  }
                }).catch(function(error){
                  option_sort.disabled = false;
                  $('#menu-set').find('div.overlay').fadeOut();
                  list_menu('admin-menu');
                  swal({
                    title:'Error',
                    html: 'Gagal memperbahrui urutan sub menu',
                    type:'error'
                  });
                });
              },
            });
          });
          $.each(document.getElementsByClassName('sub-menu-list-user'), function(e,elements){
            Sortable.create(elements,{
              group:'.sub-menu-list-user[lvl-menu='+$(this).attr('lvl-menu')+']',
              handle: 'span.handle',
              animation: 100,
              ghostClass: 'sortable-ghost',
              dataIdAttr:'data-in-menu',
              onUpdate: function(obj){
                $('#menu-set').find('div.overlay').fadeIn();
                var option_sort = this.options;
                option_sort.disabled = true;
                var parent_menu,
                menu_reorder = [];
                $.each(obj.srcElement.attributes, function(id,attr){
                  if (obj.srcElement.attributes[id].name == 'parent-menu') {
                    parent_menu = obj.srcElement.attributes[id].nodeValue;
                  }
                });
                $('.sub-menu-list-user[parent-menu='+parent_menu+'] li.list').each(function(){
                  menu_reorder.push($(this).attr('data-in-menu'));
                });
                var sort_sub_menu = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/configuration/action/update',{data:'sorting_menu',act:'sorting_menu',list_menu:menu_reorder,parent_menu:parent_menu,menu_type:'sub-menu',level:'user',menu:obj.item.dataset.inMenu,new_in:obj.newIndex+1,old_in:obj.oldIndex+1},500);
                sort_sub_menu.then(function(respon){
                  option_sort.disabled = false;
                  $('#menu-set').find('div.overlay').fadeOut();
                  if (respon.status == 'failed') {
                    swal({
                      title:'Error',
                      html: respon.message,
                      type:'error'
                    });
                    list_menu('user-menu');
                  }
                  else if (respon.status == 'failed_list') {
                    swal({
                      title:'Error',
                      html: respon.message,
                      type:'error'
                    });
                    list_menu('user-menu');
                  }
                }).catch(function(error){
                  option_sort.disabled = false;
                  $('#menu-set').find('div.overlay').fadeOut();
                  list_menu('user-menu');
                  swal({
                    title:'Error',
                    html: 'Gagal memperbahrui urutan sub menu',
                    type:'error'
                  });
                });
              },
              onAdd: function(obj){
                $('#menu-set').find('div.overlay').fadeIn();
                var option_sort = this.options;
                option_sort.disabled = true;
                var parent_menu,
                menu_reorder = [];
                $.each(obj.srcElement.attributes, function(id,attr){
                  if (obj.srcElement.attributes[id].name == 'parent-menu') {
                    parent_menu = obj.srcElement.attributes[id].nodeValue;
                  }
                });
                $('.sub-menu-list-user[parent-menu='+parent_menu+'] li.list').each(function(){
                  menu_reorder.push($(this).attr('data-in-menu'));
                });
                var sub_menu_color = $('.sub-menu-list-user[parent-menu='+parent_menu+']').css('color');
                $('.sub-menu-list-user[parent-menu='+parent_menu+'] .list').css('border-left','2px solid '+sub_menu_color);
                $('.sub-menu-list-user[parent-menu='+parent_menu+'] .list .icon-list, .sub-menu-list-user[parent-menu='+parent_menu+'] .list .name-list').css('color',sub_menu_color);

                var sort_sub_menu = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/configuration/action/update',{data:'sorting_menu',act:'sorting_menu',list_menu:menu_reorder,parent_menu:parent_menu,menu_type:'sub-menu',move_sub:true,level:'user',menu:obj.item.dataset.inMenu,new_in:obj.newIndex+1,old_in:obj.oldIndex+1},500);
                sort_sub_menu.then(function(respon){
                  option_sort.disabled = false;
                  $('#menu-set').find('div.overlay').fadeOut();
                  if (respon.status == 'failed') {
                    swal({
                      title:'Error',
                      html: respon.message,
                      type:'error'
                    });
                    list_menu('user-menu');
                  }
                  else if (respon.status == 'failed_list') {
                    swal({
                      title:'Error',
                      html: respon.message,
                      type:'error'
                    });
                    list_menu('user-menu');
                  }
                }).catch(function(error){
                  option_sort.disabled = false;
                  $('#menu-set').find('div.overlay').fadeOut();
                  list_menu('user-menu');
                  swal({
                    title:'Error',
                    html: 'Gagal memperbahrui urutan sub menu',
                    type:'error'
                  });
                });
              },
            });
          });
        }).catch(function(error){});

      }
      else if (menu_list.login_rld == true) {
        list_menu(data);
      }
    }).catch(function(error){
      $('#menu-set').find('div.overlay').fadeOut();
      if (error.login_rld != undefined && error.login_rld == true) {
        list_menu(data);
      }
      else{      
        swal({
          title:'Error',
          html: 'Terjadi error saat mengambil data menu',
          type:'error'
        });
      }
      // list_menu(data);
    });
  }
  /*END -- Function: List Menu*/

  /*Function: Sidebar Menu Reorder*/
  function sidebar_menu_reorder(list_menu){
    if (list_menu != null) {
      var menu_list = new Promise(function(done,fail){
        done(list_menu);
      });
    }
    else{
      var menu_list = getJSON_async(hostProtocol + '//'+host+data_dashboard_path+'/action/ambil',{act:'get',data:'list_menu',menu:'admin'},500);
    }

    menu_list.then(function(menu_list){
      $('#menu-container').text('');
      $.each(menu_list.parents_menu, function(index,data_record){
        if (data_record.level_access_menu == 'admin') {
          if (data_record.sub_menu.length > 0) {
            $('#menu-container').append(
              '<li class="treeview">'
              +'  <a href="#">'
              +'    <i class="'+data_record.icon_menu+'" style="color: '+data_record.color_menu+'"></i> <span style="color: '+data_record.color_menu+'">'+data_record.nm_menu+'</span>'
              +'    <span class="pull-right-container">'
              +'      <i class="fa fa-angle-left pull-right"></i>'
              +'    </span>'
              +'  </a>'
              +'    <ul class="treeview-menu parent-menu-'+data_record.id_menu+'">'
              +'    </ul>'
              +'  </a>'
              +'</li>'
              );

            $.each(data_record.sub_menu, function(in_sub,data_sub){
              if (data_sub.status_access_sub_menu == 1) {
                if (data_sub.nm_sub_menu.length > 29) {
                  data_sub.nm_sub_menu = data_sub.nm_sub_menu.substr(0,28)+'...';
                }

                $('#menu-container ul.parent-menu-'+data_sub.id_parent_menu).append(
                '      <li><a href="'+data_sub.link_sub_menu+'"><i class="fa fa-circle-o"></i> '+data_sub.nm_sub_menu+'</a></li>'
                );
              }
              else{
                if (data_sub.status_access_sub_menu == 0) {
                  var strlen = 20;
                  var end_str = 21;
                  var menu_attr = {text:'Soon',class:'bg-green'};
                }
                else if (data_sub.status_access_sub_menu == 2) {
                  var strlen = 20;
                  var end_str = 21;
                  var menu_attr = {text:'BETA',class:'bg-blue'};
                }
                else if (data_sub.status_access_sub_menu == 3) {
                  var strlen = 19;
                  var end_str = 19;
                  var menu_attr = {text:'Repair',class:'bg-red'};
                }

                if (data_sub.nm_sub_menu.length > strlen) {
                  data_sub.nm_sub_menu = data_sub.nm_sub_menu.substr(0,end_str)+'...';
                }

                $('#menu-container ul.parent-menu-'+data_sub.id_parent_menu).append(
                '      <li>'
                +'        <a href="'+data_sub.link_sub_menu+'">'
                +'           <i class="fa fa-circle-o"></i> '+data_sub.nm_sub_menu
                +'           <span class="pull-right-container">'
                +'              <small class="label pull-right '+menu_attr['class']+'">'+menu_attr['text']+'</small>'
                +'           </span>'
                +'        </a>'
                +'    </li>'
                );
              }
            });
          }
          else{
            if (data_record.status_access_menu == 1) {
              $('#menu-container').append(
                '<li>'
                +'  <a href="'+data_record.link_menu+'" style="color: '+data_record.color_menu+'">'
                +'    <i class="'+data_record.icon_menu+'"></i> <span>'+data_record.nm_menu+'</span>'
                +'  </a>'
                +'</li>'
                );  
            }
            else{
              if (data_record.status_access_menu == 0) {
                var menu_attr = {text:'Soon',class:'bg-green'};
              }
              else if (data_record.status_access_menu == 2) {
                var menu_attr = {text:'BETA',class:'bg-blue'};
              }
              else if (data_record.status_access_menu == 3) {
                var menu_attr = {text:'Repair',class:'bg-red'};
              }
              $('#menu-container').append(
                '<li>'
                +'  <a href="'+data_record.link_menu+'" style="color: '+data_record.color_menu+'">'
                +'    <i class="'+data_record.icon_menu+'"></i> <span>'+data_record.nm_menu+'</span>'
                +'    <span class="pull-right-container">'
                +'     <small class="label pull-right '+menu_attr['class']+'">'+menu_attr['text']+'</small>'
                +'    </span>'
                +'  </a>'
                +'</li>'
                );  
            }
          }
        }
      });
    }).catch(function(error){});
  }
  /*END -- Function: Sidebar Menu Reorder*/

  /*Function: Get List Tempalte*/
  function get_list_template(){
    $('#template-set').find('div.overlay').fadeIn();
    $('table#table-list-tamplate').find('tbody').html('<tr class="load-row"><td colspan="6" class="text-center load-data">Memproses Data</td></tr>');
    var list_template = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{data:'list_template'},500,true);
    list_template.then(function(results){
      $('#template-set').find('div.overlay').fadeOut();
      $('table#table-list-tamplate').find('tbody').text('');
      if (results.total_rows > 0) {
        var no = 1;
        $.each(results.data, function(index,data_record){
          var checked_status;
          if (data_record.template_status == 1) {
            checked_status = 'checked';
          }

          $('table#table-list-tamplate').find('tbody').append(
            '<tr>'
            +'   <td class="text-center">'+no+'</td>'
            +'   <td>'+data_record.template_name+'</td>'
            +'   <td class="text-center">'+data_record.template_dev+'</td>'
            +'   <td class="text-center">v'+data_record.template_version+'</td>'
            +'   <td class="text-center"><input type="checkbox" class="check-template-status" '+checked_status+' value="'+data_record.template_id+'"/></td>'
            +'   <td class="text-center">'
            +'      <div class="btn-group">'
            +'        <a href="#edit?data=template&in_template='+data_record.template_id+'&token='+token+'" class="btn btn-success btn-sm" title="Edit template '+data_record.template_name+'"><i class="fa fa-pencil-square"></i></a>'
            +'        <a href="#hapus?data=template&in_template='+data_record.template_id+'&token='+token+'" class="btn btn-danger btn-sm" title="Hapus template '+data_record.template_name+'"><i class="fa fa-trash"></i></a>'
            +'      </div>'
            +'   </td>'
            +'</tr>'
            );

          $('#list-template-container').append(
            '  <div class="col-md-6">'
            +'    <div class="box box-default">'
            +'      <div class="box-header with-border">'
            +'        <table>'
            +'          <tr>'
            +'            <td><input type="radio" '+checked_status+' class="pull-right" name="choose-template" value="'+data_record.template_id+'"></td>'
            +'          <td style="padding-left: 10px;"><strong>'+data_record.template_name+'</strong></td>'
            +'          </tr>'
            +'        </table>'
            +'      </div>'
            +'      <div class="box-body no-padding">'
            +'        <img src="'+data_record.template_image+'" alt="layout-setting" class="img-responsive" style="width: 100%;height: 115px;">'
            +'      </div>'
            +'      <div class="box-footer">'
            +'        <font>'+data_record.template_description+'</font>'
            +'      </div>'
            +'    </div>'
            +'  </div>'
          );

          no++;
        });

        $.each(results.data, function(index,data_record){
          if (data_record.template_status == 1) {
            $.each(data_record, function(in_dt,dt){
              if (in_dt == 'template_image' && dt != '') {
                $('img.detail_template_'+in_dt).attr('src',dt).css('margin-bottom','-10px').show();
              }
              else if (in_dt == 'template_image' && dt == '') {
                $('img.detail_template_'+in_dt).hide();
              }

              if (dt == '') {
                dt = '-';
              }
              $('#detail_aktif_template_container').find('dd.detail_template_'+in_dt).html(dt);
            });
            return false;
          }
          else{
            $('#detail_aktif_template_container').find('dd.detail_aktif_template').text('-');
            $('#detail_aktif_template_container').find('img').hide();
          }
        });

        $('input[type="radio"]').iCheck({      
          radioClass: 'iradio_flat-blue'
        });

        $('.check-template-status').bootstrapToggle({
          on:'<i class="fa fa-check-circle" title="Status Template Aktif"></i>',
          off:'<i class="fa fa-ban" title="Status Template Tidak Aktif"></i>',
          size:'small',
          onstyle:'success',
          offstyle:'danger',
          width: 30,
        });
      }
      else{
        $('table#table-list-tamplate').find('tbody').html('<tr><td colspan="6">Belum ada data template yang di input</td></tr>');
        $('#list-template-container').html('<div class="col-md-12"><h5 class="text-center"><i class="fa fa-exclamation-circle"></i> Belum ada data template yang di input</h5></div>');
      }
    }).catch(function(error){
      $('#template-set').find('div.overlay').fadeOut();
    });
  }
  /*END -- Function: Get List Tempalte*/

  /*Function: Get App Config*/
  function get_app_config(){
    var detail_conf = getJSON_async(hostProtocol + '//'+host+controller_path+'/action/ambil',{data:'general_conf'});
    detail_conf.then(function(results){
      $('#config-set').find('div.overlay').fadeOut();
      $.each(results.config, function(index,data_record){
        $('#config-set dd.detail'+index).text(data_record);
      });
    }).catch(function(error){
      $('#config-set .detail-config-siakad').text('-');
      $('#config-set').find('div.overlay').fadeOut();
    });
  }
  /*END -- Function: Get App Config*/

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