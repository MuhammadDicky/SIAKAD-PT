var path         = window.location.pathname,
host             = window.location.hostname + (window.location.port !== '' ? ':' + window.location.port : '')
protocol         = window.location.protocol;

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

    /*First Load Page*/
    if (path == controller_path+'/data_mhs') {
      $('#box-siswa div.overlay').fadeOut();      
      var detail_mhs = getJSON_async(protocol + '//'+host+controller_path+'/action/ambil',{data:'data_mhs'},500);
      detail_mhs.then(function(detail_mhs){
        if (detail_mhs.record_mhs != '') {
          detail_akademik_mhs();
          $.each(detail_mhs.record_mhs, function(index, data_record){
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
              $('.box-profile .profil-'+index).text(data_record);
              $('#detail-'+index).text(data_record);
            });
            if (data_record.tgl_lulus != null && data_record.tgl_drop_out == null) {
              $('.box-profile li.tgl-mhs').find('b').text('Tanggal Kelulusan');
              $('.box-profile li.tgl-mhs').find('p').text(data_record.tgl_lulus);
            }
            else if (data_record.tgl_lulus == null && data_record.tgl_drop_out != null) {
              $('.box-profile li.tgl-mhs').find('b').text('Tanggal Drop Out');
              $('.box-profile li.tgl-mhs').find('p').text(data_record.tgl_drop_out);
            }
            else{
              $('.box-profile li.tgl-mhs').find('b').text('Tanggal Masuk');
              $('.box-profile li.tgl-mhs').find('p').text(data_record.tgl_masuk_angkatan);
            }
          });
        }
        else{
          $('#detail-mhs dl dd').text('-');
        }
      });
    }

    if (path == controller_path+'/data_jadwal') {
      daftar_jadwal_mhs();
    }

    if (path == controller_path+'/nilai_mhs') {
      $('#box-content div.overlay, #box-nilai div.overlay').fadeOut();
      detail_nilai();
    }
    /*END -- First Load Page*/

    /*Datatable Plugin*/
    /*END -- Datatable Plugin*/

    /*Select2 Plugin*/
    /*END -- Select2 Plugin*/

    /*Onclick Event*/
    $('#box-jadwal .refresh-data-mhs').on('click', function(){
      var btn_act = $(this).find('i');
      btn_act.addClass('fa-spin');
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1050);
      daftar_jadwal_mhs(true);
    });
    $('.tamp-jadwal').on('click', function(eve){
      eve.preventDefault(); 
      $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
      var thn_ajaran = $('.select2_jadwal').val();
      daftar_jadwal_mhs(false,thn_ajaran);
    });
    $('.tamp-all-jadwal').on('click', function(eve){
      eve.preventDefault(); 
      $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
      var thn_ajaran = $('.select2_jadwal').val();
      daftar_jadwal_mhs(false,thn_ajaran,true);
    });
    $(document).on('click', '.view-kelas', function(){
      $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
      var kelas_view = $(this).val();
      daftar_kelas_mhs(kelas_view);
    });
    $(document).on('click','.remove-kelas', function(){
      delay(function(){
        $('.detail-kelas .detail-kelas-mhs').text('-');
        $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="5" align="center">Silahkan pilih kelas</td></tr>');
      },1000);
    });

    $('.tamp-nilai').on('click', function(eve){
      eve.preventDefault(); 
      var thn_ajaran = $('.select2_jadwal').val();
      $(this).find('i').removeClass('fa-file-text-o').addClass('fa-circle-o-notch fa-spin');
      detail_nilai(thn_ajaran);
    });

    $('a[href="#detail_riwayat_kuliah"], a[href="#detail_riwayat_studi"]').on('click', function(){
      delay(function(){
        detail_akademik_mhs();
      },100);
    });
    /*END -- Onclick Event*/

    /*OnChange Event*/
    /*END -- OnChange Event*/

    /*Ajax Submit*/
    $(document).on('click', '#submit', function(eve){
      eve.preventDefault();
      
      $('#form-input').find('.has-error').removeClass('has-error');
      var action = $('#form-input').attr('action');      
      var datasend = $('#form-input').serialize();      
      
      $('#alert-place').text('');
      var data_s = $('#form-input input[name=data]').val();
      var hash = getUrlVars();

      $.ajax(protocol + '//'+host+controller_path+'/action/'+action,{
        dataType: 'json',
        type: 'POST',
        data: datasend,
        success: function(data){
          if (action == 'tambah') {
            if (data.status == 'success') {
              swal({
                title:'Data Berhasil Disimpan',
                type:'success',
                timer: 1000,
              });
            }
            else if (data.status == 'failed') {
              var error_text = '',no = 1;
              $.each(data.errors, function(key, value){
                error_text += '<li class="text-center">'+value+'</li>';
              });
              swal({
                title:'Gagal!',
                type:'error',
                html: error_text,
              });
            }
            else{
              swal({
                title:'Terjadi Error',
                type:'error',
              });
            }
          }
        },
        error:function(){
          swal({
            title:'Error',
            text: 'Maaf, telah terjadi error pada server!',
            type:'error',
            timer: 2000
          });
        }
      });
    });
    /*END -- Ajax Submit*/
});

  /*Function*/
  /*Function: Daftar kelas mahasiswa*/
  function daftar_kelas_mhs(kelas){
    $('#box-kelas-mhs').fadeIn();
    collapse_box('#box-kelas-mhs');
    $('#box-kelas-mhs').find('div.overlay').fadeIn();
    $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="5" align="center" class="load-data">Memproses Data</td></tr>');
    var detail_kelas = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{kelas:kelas,data:'daftar_kelas_mhs'},500);
    detail_kelas.then(function(detail_kelas){
      if (detail_kelas.record_kelas != '') {
        $('#box-kelas-mhs').find('div.overlay').fadeOut();
        $('html, body').animate({scrollTop:$('#box-kelas-mhs').offset().top - 55},800);
        var status_ak;
        $.each(detail_kelas.record_kelas, function(index, data_record){
          $.each(data_record, function(index, data_record){
            if (data_record == null || data_record == '') {
              data_record = '-';
            }
            $('.detail-kelas .detail-kelas-'+index).text(data_record);
          });
          if (data_record.jenis_jdl != 0) {
            $('.detail-kelas .detail-kelas-nama_mk').text(data_record.nama_mk+' (Konsentrasi '+data_record.nm_konsentrasi+')');
          }
          status_ak = data_record.status_jdl;
        });
        if (detail_kelas.record_mhs != '') {
          $('.tbl-daftar-kelas-mhs').find('tbody').text('');
          var no = 1,
          check;
          $.each(detail_kelas.record_mhs, function(index, data_record){
            if (data_record.jk == 'L') {
              var jk = 'Laki-Laki';
            }
            else{
              var jk = 'Perempuan';
            }
            $('table.tbl-daftar-kelas-mhs').find('tbody').append(
              '<tr>'
              +'  <td class="text-center">'+no+'</td>'
              +'  <td class="text-center">'+data_record.nisn+'</td>'
              +'  <td>'+data_record.nama+'</td>'            
              +'  <td class="text-center">'+jk+'</td>'
              +'  <td class="text-center">'+data_record.tahun_angkatan+'</td>'
              +'</tr>'                  
            );
            no++;
          });
        }
        else{
          $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="5" align="center">Untuk sekarang kelas ini belum memiliki mahasiswa</td></tr>');
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
      $('.view-kelas').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      $('.check-status-mhs-kls').bootstrapToggle({
        on:'<i class="fa fa-check-circle"></i> Aktif',
        off:'<i class="fa fa-ban"></i> Tidak Aktif',
        size:'small',
        onstyle:'success',
        offstyle:'danger',
        width: 100,
      });
    }).catch(function(error){
      $('.view-kelas').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
    });
  }
  /*END -- Function: Daftar kelas mahasiswa*/

  /*Function: Daftar nilai mahasiswa*/
  function detail_nilai(thn){
    $('#box-nilai div.overlay').fadeIn();
    $('.tbl-nilai-mhs').find('tbody').html('<tr class="table-load"><td class="text-center load-data" colspan="7">Memproses Data</td></tr>');
    var detail_nilai = getJSON_async(protocol + '//'+host+controller_path+'/action/ambil',{thn:thn,data:'daftar_nilai_mhs'},500);
    detail_nilai.then(function(detail_nilai){
      if (detail_nilai.record_nilai != '') {
        $('.tbl-nilai-mhs').find('tbody').text('');
        $('.tahun-ajaran-ket').text(detail_nilai.thn);
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
      else if(detail_nilai.thn == '-') {
        $('.tbl-nilai-mhs').find('tbody').html('<tr><td class="text-center" colspan="7">Silahkan pilih tahun akademik</td></tr>');
      }
      else{
        swal({
          title:'Info',
          text: 'Tahun akademik yang anda pilih tidak terdaftar dalam database!',
          type:'info',
          timer: 2000
        });
      }
      $('#box-nilai').find('div.overlay').fadeOut();
      $('.tamp-nilai').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-file-text-o');
    }).catch(function(error){
      $('.tamp-nilai').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-file-text-o');
      $('#box-nilai').find('div.overlay').fadeOut();
      if ($('.tbl-nilai-mhs tr.table-load').length == 1) {
        $('.tbl-nilai-mhs tr.table-load td').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
      }
      setTimeout(function(){
        $('.tbl-nilai-mhs tr.table-load').remove();
      },2000);
    });
  }
  /*END -- Function: Daftar nilai mahasiswa*/

  /*Function: Daftar kuliah mahasiswa*/
  function daftar_jadwal_mhs(tdy,thn,all){
    $('#box-jadwal div.overlay').fadeIn();
    collapse_box('#box-jadwal, #box-jadwal .box');
    $('#box-jadwal').find('div.overlay').fadeIn();
    if (thn != null || tdy == null) {
      var colspan = 9;
      $('#box-kelas-mhs').slideUp();
    }
    else{
      var colspan = 6;
    }

    if ($('table.tbl-data-jadwal tbody tr').length > 0) {
      $('table.tbl-data-jadwal').find('tbody').prepend('<tr class="table-load"><td class="text-center load-data" colspan="'+colspan+'">Memproses Data</td></tr>');
    }
    else{
      $('table.tbl-data-jadwal').find('tbody').html('<tr class="table-load"><td class="text-center load-data" colspan="'+colspan+'">Memproses Data</td></tr>');
    }
    var detail_jadwal = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{data:'daftar_jadwal_mhs',d:tdy,thn:thn,all:all},500);
    detail_jadwal.then(function(detail_jadwal){
      if (tdy ==true) {
        $('#box-jadwal .box-title').html('<li class="fa fa-list"></li> Jadwal Kuliah Hari '+detail_jadwal.hari_i);
      }
      if (detail_jadwal.record_jadwal != '') {
        $('table.tbl-data-jadwal').find('tbody').text('');
        $('#box-jadwal .tahun-ajaran-jad').html('<li class="fa fa-book"></li> '+detail_jadwal.record_jadwal[0]['thn_ajaran']);
        $('#box-jadwal .jumlah-jadwal-jad').html('<li class="fa fa-list"></li> '+detail_jadwal.count_jadwal_ptk['count_ptk_jdl']);
        $('#box-jadwal .jumlah-kls-jad').html('<li class="fa fa-building-o"></li> '+detail_jadwal.count_jadwal_ptk['count_ptk_kls']);
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
                if (data_record.nama_mk == null || data_record.nama_mk == '') {
                  data_record.nama_mk = '-';
                  data_record.jml_sks = '-';
                }
                if (data_record.nama_ptk == null || data_record.nama_ptk == '') {
                  data_record.nama_ptk = '-';
                }
                kelas = data_record.semester+'/'+data_record.kelas;
                if (kelas == dt_kelas && data_record.jenis_jdl == data_u.jenis_jdl) {
                    if (tdy != true) {
                      var hari = '  <td class="text-center">'+data_record.hari_jdl+'</td>';
                      var pd = '  <td class="text-center"><li class="fa fa-users" title="Jumlah mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_mhs+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_pr+'</td>'
                              +'  <td class="text-center"><button class="btn btn-warning btn-sm view-kelas" value="'+data_record.jdl_in+'" title="Lihat daftar mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button></td>';
                    }
                    if (no == 1) {
                      $('table.tbl-data-jadwal').find('tbody').append(
                        '<tr'+row_color+'>'
                        +'  <td rowspan="" class="kelas-row'+data_record.jdl_no+' text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                        +hari
                        +'  <td class="text-center">'+data_record.jam_mulai_jdl+' - '+data_record.jam_akhir_jdl+'</td>'
                        +'  <td>'+data_record.nama_mk+'</td>'
                        +'  <td class="text-center">'+data_record.jml_sks+'</td>'
                        +'  <td class="text-center">'+data_record.ruang+'</td>'
                        +'  <td>'+data_record.nama_ptk+'</td>'
                        +pd
                        +'</tr>'                  
                      );
                      no_kelas = data_record.jdl_no;
                    }
                    else{
                      $('table.tbl-data-jadwal').find('tbody').append(
                        '<tr'+row_color+'>'
                        +hari
                        +'  <td class="text-center">'+data_record.jam_mulai_jdl+' - '+data_record.jam_akhir_jdl+'</td>'
                        +'  <td>'+data_record.nama_mk+'</td>'
                        +'  <td class="text-center">'+data_record.jml_sks+'</td>'
                        +'  <td class="text-center">'+data_record.ruang+'</td>'
                        +'  <td>'+data_record.nama_ptk+'</td>'
                        +pd
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
                if (data_record.nama_mk == null || data_record.nama_mk == '') {
                  data_record.nama_mk = '-';
                  data_record.jml_sks = '-';
                }
                kelas = data_record.semester+'/'+data_record.kelas;
                if (kelas == dt_kelas && data_record.jenis_jdl == data_u.jenis_jdl) {
                  if (tdy != true) {
                    var colspan= '9';
                    var hari = '  <td class="text-center">'+data_record.hari_jdl+'</td>';
                    var pd = '  <td class="text-center"><li class="fa fa-users" title="Jumlah mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_mhs+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_pr+'</td>'
                            +'  <td class="text-center"><button class="btn btn-warning btn-sm view-kelas" value="'+data_record.jdl_in+'" title="Lihat daftar mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button></td>';
                  }
                  else{
                    var colspan= '6';
                  }
                  if (no == 1) {
                    $('table.tbl-data-jadwal').find('tbody').append(
                      '<tr>'
                      +'  <td colspan="'+colspan+'" align="left"><b>Konsentrasi '+data_record.nm_konsentrasi+'</b></td>'
                      +'</tr>'                  
                      +'<tr>'
                      +'  <td rowspan="" class="text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                      +hari
                      +'  <td class="text-center">'+data_record.jam_mulai_jdl+' - '+data_record.jam_akhir_jdl+'</td>'
                      +'  <td>'+data_record.nama_mk+'</td>'
                      +'  <td class="text-center">'+data_record.jml_sks+'</td>'
                      +'  <td class="text-center">'+data_record.ruang+'</td>'
                      +'  <td>'+data_record.nama_ptk+'</td>'
                      +pd
                      +'</tr>'                  
                    );
                  }
                  else{
                    $('table.tbl-data-jadwal').find('tbody').append(
                      '<tr>'
                      +'  <td rowspan="" class="text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                      +hari
                      +'  <td class="text-center">'+data_record.jam_mulai_jdl+' - '+data_record.jam_akhir_jdl+'</td>'
                      +'  <td>'+data_record.nama_mk+'</td>'
                      +'  <td class="text-center">'+data_record.jml_sks+'</td>'
                      +'  <td class="text-center">'+data_record.ruang+'</td>'
                      +'  <td>'+data_record.nama_ptk+'</td>'
                      +pd
                      +'</tr>'                  
                    );
                  }
                no++;
                }
              });
            }
          });
        });
      }
      else{
        if (detail_jadwal.c_thn_ajaran != '-') {
          if (tdy == true) {
            $('table.tbl-data-jadwal tbody').html('<tr><td colspan="6" align="center">Untuk hari ini anda tidak memiliki jadwal kuliah</td></tr>');
          }
          else{
            $('table.tbl-data-jadwal tbody').html('<tr><td colspan="9" align="center">Untuk tahun akademik ini anda tidak memiliki jadwal kuliah</td></tr>');
          }
        }
        else {
          if (tdy == true) {
            $('table.tbl-data-jadwal tbody').html('<tr><td colspan="6" align="center">Untuk saat ini tidak ada tahun akademik yang diterapkan</td></tr>');
          }
          else{
            $('table.tbl-data-jadwal tbody').html('<tr><td colspan="9" align="center">Untuk saat ini tidak ada tahun akademik yang diterapkan</td></tr>');
          }
        }
      }
      $('.tamp-jadwal, .tamp-all-jadwal').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      $('#box-jadwal').find('div.overlay').fadeOut();
    }).catch(function(error){
      $('#box-jadwal').find('div.overlay').fadeOut();
      $('.tamp-jadwal, .tamp-all-jadwal').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      if ($('table.tbl-data-jadwal tbody tr.table-load').length == 1) {
        $('table.tbl-data-jadwal tbody tr.table-load td').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
      }
      setTimeout(function(){
        $('table.tbl-data-jadwal tbody tr.table-load').remove();
      },2000);
    });
  }
  /*END -- Function: Daftar kuliah mahasiswa*/

  /*Function: Daftar detail akademik mahasiswa*/
  function detail_akademik_mhs(){
    if ($('.tbl-riwayat-studi-mhs tr.table-load').length == 0) {
      $('.tbl-riwayat-studi-mhs').find('tbody').append('<tr class="table-load"><td class="text-center load-data" colspan="5">Memproses Data</td></tr>');
    }
    if ($('.tbl-riwayat-kuliah-mhs tr.table-load').length == 0) {
      $('.tbl-riwayat-kuliah-mhs').find('tbody').append('<tr class="table-load"><td class="text-center load-data" colspan="4">Memproses Data</td></tr>');
    }
    var data_akademik = getJSON_async(protocol + '//'+host+controller_path+'/action/ambil',{data:'riwayat_akademik_mhs'},1000);
    data_akademik.then(function(data_akademik){
      if (data_akademik.record_akademik != '') {
        $('.tbl-riwayat-studi-mhs, .tbl-riwayat-kuliah-mhs').find('tbody').text('');
        $('.box-profile .profil-rwt-studi').text(data_akademik.record_akademik.length);
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
            $('.box-profile .profil-rwt-akademik').text(no_a);
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
        $('.tbl-riwayat-studi-mhs tr.table-load, .tbl-riwayat-kuliah-mhs tr.table-load').remove();
      },2000);
    });
  }
  /*END -- Function: Daftar detail akademik mahasiswa*/