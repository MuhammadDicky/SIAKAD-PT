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
    if (path == controller_path+'/data_tenaga_pendidik') {
      var detail_ptk = getJSON_async(protocol + '//'+host+controller_path+'/action/ambil',{data:'data_tenaga_pendidik'},null,true);
      detail_ptk.then(function(detail_ptk){
        if (detail_ptk.record_ptk != '') {
          $.each(detail_ptk.record_ptk, function(index, data_record){
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
              $('.box-profile .profil-'+index).text(data_record);            
              $('#detail-'+index).text(data_record);
            });
          });
          detail_data_ptk();
        }
        else{
          $('#detail-ptk dl dd').text('-');
        }
      }).catch(function(error){});
    }

    if (path == controller_path+'/nilai_mhs') {
      $('#box-content div.overlay, #box-nilai div.overlay').fadeOut();
      daftar_kls_d();
    }

    if (path == controller_path+'/jadwal_mengajar') {
      $('#box-jadwal div.overlay').fadeOut();
      daftar_jadwal();
    }
    /*END -- First Load Page*/

    /*Datatable Plugin*/
    /*END -- Datatable Plugin*/

    /*Select2 Plugin*/
    /*END -- Select2 Plugin*/

    /*Onclick Event*/
    $('#box-jadwal .refresh-data-ptk').on('click', function(){
      var btn_act = $(this).find('i');
      btn_act.addClass('fa-spin');
      setTimeout(function(){
        btn_act.removeClass('fa-spin');
      },1050);
      daftar_jadwal(true);
    });
    $('.tamp-jadwal').on('click', function(eve){
      eve.preventDefault(); 
      var thn_ajaran = $('.select2_jadwal').val();
      $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
      daftar_jadwal(false,thn_ajaran);
    });
    $('.tamp-all-jadwal').on('click', function(eve){
      eve.preventDefault(); 
      var thn_ajaran = $('.select2_jadwal').val();
      $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
      daftar_jadwal(false,thn_ajaran,true);
    });
    $(document).on('click', '.view-kelas', function(){
      $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
      var kelas_view = $(this).val();
      daftar_kelas_mhs(kelas_view);
    });
    $(document).on('click','.remove-kelas', function(){
      delay(function(){
        $('.detail-kelas .detail-dt-kelas').text('-');
        $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="6" align="center">Silahkan pilih kelas</td></tr>');
      },1000);
    });

    $('.tamp-kls').on('click', function(eve){
      eve.preventDefault(); 
      $(this).find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
      var thn_ajaran = $('.select2_jadwal').val();
      daftar_kls_d(thn_ajaran);
    });
    $(document).on('click', '.view-nilai', function(){
      $(this).find('i').removeClass('fa-list fa-pencil-square').addClass('fa-circle-o-notch fa-spin');
      var nilai_v = $(this).val();
      view_nilai(nilai_v);
    });

    $('#refresh-statik-ptk').on('click', function(){
      collapse_box('.grafik-ptk');
      $(this).find('i').addClass('fa-spin');
      delay(function(){
        $('.grafik-ptk .fa-refresh').removeClass('fa-spin');
      },1000);
      var detail_ptk = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{data:'ptk'},null,true);
      detail_ptk.then(function(detail_ptk){
        $('#pieChart-data-ptk').replaceWith('<canvas id="pieChart-data-ptk" height="180"></canvas>');
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

    $(document).on('click','#update-nilai', function(){
      $('.tbl-daftar-kelas-mhs .pdk-nilai').hide();
      $('#form-input').attr('action','tambah');
      $('.btn-input-nilai').html('<button id="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button> <button id="cancel-input-nilai" class="btn btn-danger"><i class="fa fa-times"></i> Batal</button>');
      $('.tbl-daftar-kelas-mhs input[type=number]').show();
    });
    $(document).on('click','#cancel-input-nilai', function(){
      $('.tbl-daftar-kelas-mhs .pdk-nilai').show();
      if ($('.btn-input-nilai').attr('id') == 'add-nilai') {
        $('.btn-input-nilai').html('<button id="update-nilai" class="btn btn-info"><i class="fa fa-pencil-square"></i> Input Nilai</button>');
      }
      else if ($('.btn-input-nilai').attr('id') == 'up-nilai') {
        $('.btn-input-nilai').html('<button id="update-nilai" class="btn btn-success"><i class="fa fa-pencil-square"></i> Update Nilai</button>');
      }
      $('#form-input').attr('action','');
      $('.tbl-daftar-kelas-mhs input[type=number]').hide();
    });
    /*END -- Onclick Event*/

    /*OnChange Event*/
    $(document).on('change','.check-status-mhs-kls',function(){
      var status_mhs = $(this).prop('checked'),
      id = $(this).attr('value'),
      status_u = getJSON_async(protocol + '//'+host+controller_path+'/action/update_status',{id:id,status_mhs_kls:status_mhs},null,true);
      status_u.then(function(status_u){
        if (status_u.status != 'success') {
          if (status_u.status == 'failed') {
            swal({
              title:'Error',
              text:'Gagal merubah status aktif mahasiswa',
              type:'error',
              timer: 2000
            });
          }
          else if (status_u.status == 'failed_thn') {
            swal({
              title:'Error',
              text:'Gagal merubah status aktif mahasiswa karena tahun akademik kelas ini ditutup',
              type:'error',
              timer: 2000
            });
          }

          if (status_mhs == true) {
            delay(function(){
              $('.status-mhs-'+id+'').bootstrapToggle('destroy');
              $('.status-mhs-'+id+'').replaceWith("<input type='checkbox' class='check-status-mhs-kls status-mhs-"+id+"' value='"+id+"'/>");
              $('.status-mhs-'+id+'').bootstrapToggle({
                on:'<i class="fa fa-check-circle"></i> Aktif',
                off:'<i class="fa fa-ban"></i> Tidak Aktif',
                size:'small',
                onstyle:'success',
                offstyle:'danger',
              });
            },500);
          }
          else {
            delay(function(){
              $('.status-mhs-'+id+'').bootstrapToggle('destroy');
              $('.status-mhs-'+id+'').replaceWith("<input type='checkbox' class='check-status-mhs-kls status-mhs-"+id+"' checked value='"+id+"'/>");
              $('.status-mhs-'+id+'').bootstrapToggle({
                on:'<i class="fa fa-check-circle"></i> Aktif',
                off:'<i class="fa fa-ban"></i> Tidak Aktif',
                size:'small',
                onstyle:'success',
                offstyle:'danger',
              });
            },500);
          }
        }
      }).catch(function(error){
        swal({
          title:'Error',
          text:'Gagal merubah status aktif mahasiswa',
          type:'error',
          timer: 2000
        });
        if (status_mhs == true) {
          delay(function(){
            $('.status-mhs-'+id+'').bootstrapToggle('destroy');
            $('.status-mhs-'+id+'').replaceWith("<input type='checkbox' class='check-status-mhs-kls status-mhs-"+id+"' value='"+id+"'/>");
            $('.status-mhs-'+id+'').bootstrapToggle({
              on:'<i class="fa fa-check-circle"></i> Aktif',
              off:'<i class="fa fa-ban"></i> Tidak Aktif',
              size:'small',
              onstyle:'success',
              offstyle:'danger',
            });
          },500);
        }
        else {
          delay(function(){
            $('.status-mhs-'+id+'').bootstrapToggle('destroy');
            $('.status-mhs-'+id+'').replaceWith("<input type='checkbox' class='check-status-mhs-kls status-mhs-"+id+"' checked value='"+id+"'/>");
            $('.status-mhs-'+id+'').bootstrapToggle({
              on:'<i class="fa fa-check-circle"></i> Aktif',
              off:'<i class="fa fa-ban"></i> Tidak Aktif',
              size:'small',
              onstyle:'success',
              offstyle:'danger',
            });
          },500);
        }
      });
    });
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
              if (data.data =='nilai_mhs' ) {
                view_nilai(data.kls);
              }
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
  /*Function: Daftar jadwal PTK*/
  function daftar_jadwal(tdy,thn,all){
    collapse_box('#box-jadwal, #box-jadwal .box');
    $('#box-jadwal').find('div.overlay').fadeIn();
    if (tdy == true) {
      var colspan = 5;
    }
    else{
      var colspan = 9;
    }

    if ($('table.tbl-data-jadwal tbody tr').length > 0) {
      $('table.tbl-data-jadwal').find('tbody').prepend('<tr class="table-load"><td class="text-center load-data" colspan="'+colspan+'">Memproses Data</td></tr>');
    }
    else{
      $('table.tbl-data-jadwal').find('tbody').html('<tr class="table-load"><td class="text-center load-data" colspan="'+colspan+'">Memproses Data</td></tr>');
    }
    var detail_jadwal = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{data:'daftar_jadwal_ptk',d:tdy,thn:thn,all:all},500);
    detail_jadwal.then(function(detail_jadwal){
      if (tdy ==true) {
        $('#box-jadwal .box-title').html('<li class="fa fa-list"></li> Jadwal Mengajar Hari '+detail_jadwal.hari_i);
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
                kelas = data_record.semester+'/'+data_record.kelas;
                if (kelas == dt_kelas && data_record.jenis_jdl == data_u.jenis_jdl) {
                    if (tdy != true) {
                      var hari = '  <td class="text-center">'+data_record.hari_jdl+'</td>';
                      var pd = '  <td>'+data_record.nama_prodi+'</td>'
                            +'  <td class="text-center"><li class="fa fa-users" title="Jumlah mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_mhs+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_pr+'</td>'
                            +'  <td class="text-center"><button class="btn btn-warning btn-sm view-kelas" value="'+data_record.jdl_in+'" title="Lihat daftar mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button></td>';
                    }
                    if (no == 1) {
                      $('table.tbl-data-jadwal').find('tbody').append(
                        '<tr'+row_color+'>'
                        +'  <td rowspan="" class="kelas-row'+data_record.jdl_no+' text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                        +hari
                        +'  <td class="text-center">'+data_record.jam_mulai_jdl+' - '+data_record.jam_akhir_jdl+'</td>'
                        +'  <td class="text-center">'+data_record.ruang+'</td>'            
                        +'  <td>'+data_record.nama_mk+'</td>'
                        +'  <td class="text-center">'+data_record.jml_sks+'</td>'
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
                        +'  <td class="text-center">'+data_record.ruang+'</td>'            
                        +'  <td>'+data_record.nama_mk+'</td>'
                        +'  <td class="text-center">'+data_record.jml_sks+'</td>'
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
                    var pd = '  <td>'+data_record.nama_prodi+'</td>'
                            +'  <td class="text-center"><li class="fa fa-users" title="Jumlah mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_mhs+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_pr+'</td>'
                            +'  <td class="text-center"><button class="btn btn-warning btn-sm view-kelas" value="'+data_record.jdl_in+'" title="Lihat daftar mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button></td>';
                  }
                  else{
                    var colspan= '5';
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
                      +'  <td class="text-center">'+data_record.ruang+'</td>'            
                      +'  <td>'+data_record.nama_mk+'</td>'
                      +'  <td class="text-center">'+data_record.jml_sks+'</td>'
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
                      +'  <td class="text-center">'+data_record.ruang+'</td>'            
                      +'  <td>'+data_record.nama_mk+'</td>'
                      +'  <td class="text-center">'+data_record.jml_sks+'</td>'
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
            $('table.tbl-data-jadwal tbody').html('<tr><td colspan="5" align="center">Untuk hari ini anda tidak memiliki jadwal mengajar</td></tr>');
          }
          else{
            $('table.tbl-data-jadwal tbody').html('<tr><td colspan="9" align="center">Untuk tahun akademik ini anda tidak memiliki jadwal mengajar</td></tr>');
          }
        }
        else {
          if (tdy == true) {
            $('table.tbl-data-jadwal tbody').html('<tr><td colspan="5" align="center">Untuk saat ini tidak ada tahun akademik yang diterapkan</td></tr>');
          }
          else{
            $('table.tbl-data-jadwal tbody').html('<tr><td colspan="9" align="center">Untuk saat ini tidak ada tahun akademik yang diterapkan</td></tr>');
          }
        }
      }
      $('#box-jadwal').find('div.overlay').fadeOut();
      $('.tamp-jadwal, .tamp-all-jadwal').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
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
  /*END -- Function: Daftar jadwal PTK*/

  /*Function: Daftar kelas didik*/
  function daftar_kelas_mhs(kelas){
    $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="6" align="center" class="load-data">Memproses Data</td></tr>');
    $('.detail-kelas .detail-dt-kelas').text('-');
    var detail_kelas = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{kelas:kelas,data:'daftar_kelas_mhs'},500);
    detail_kelas.then(function(detail_kelas){
      if (detail_kelas.record_kelas != '') {
        if ($('#box-kelas-mhs .box-body').is(':visible')) {
          $('#box-kelas-mhs').find('div.overlay').fadeIn();
          delay(function(){
            $('#box-kelas-mhs').find('div.overlay').fadeOut();
            $('html, body').animate({scrollTop:$('#box-kelas-mhs').offset().top - 55},800);
          },500);
        }
        else{
          $('#box-kelas-mhs').fadeIn();
          collapse_box('#box-kelas-mhs');
          delay(function(){
            $('#box-kelas-mhs').find('div.overlay').fadeOut();
            $('html, body').animate({scrollTop:$('#box-kelas-mhs').offset().top - 55},800);
          },100);
        }
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
            if (data_record.status_mhs_kls == 1) {
              check = '<td class="text-center">Aktif</td>';
            }
            else{
              check = '<td class="text-center">Tidak Aktif</td>';
            }
            if (status_ak == 1 && detail_kelas.data_kelas == 'ptk') {
              if (data_record.status_mhs_kls == 1) {
                check = '<td class="text-center">'
                +'<input type="checkbox" class="check-status-mhs-kls status-mhs-'+data_record.id_kelas+'" checked value="'+data_record.id_kelas+'"/>'
                +'</td>';
              }
              else{
                check = '<td class="text-center">'
                +'<input type="checkbox" class="check-status-mhs-kls status-mhs-'+data_record.id_kelas+'" value="'+data_record.id_kelas+'"/>'
                +'</td>';
              }
            }
            $('table.tbl-daftar-kelas-mhs').find('tbody').append(
              '<tr>'
              +'  <td class="text-center">'+no+'</td>'
              +'  <td class="text-center">'+data_record.nisn+'</td>'
              +'  <td>'+data_record.nama+'</td>'            
              +'  <td class="text-center">'+jk+'</td>'
              +'  <td class="text-center">'+data_record.tahun_angkatan+'</td>'
              +'  '+check
              +'</tr>'                  
            );
            no++;
          });
        }
        else{
          $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="6" align="center">Untuk sekarang kelas ini belum memiliki mahasiswa</td></tr>');
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
      $('.check-status-mhs-kls').bootstrapToggle({
        on:'<i class="fa fa-check-circle"></i> Aktif',
        off:'<i class="fa fa-ban"></i> Tidak Aktif',
        size:'small',
        onstyle:'success',
        offstyle:'danger',
        width: 100,
      });
      $('.view-kelas').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
    }).catch(function(error){
      $('.view-kelas').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
    });
  }
  /*END -- Function: Daftar kelas didik*/

  /*Function: Daftar kelas didik*/
  function daftar_kls_d(thn){
    collapse_box('#box-content, #box-content .box');
    $('#box-content div.overlay').fadeIn();
    if ($('table.tbl-data-jadwal tbody tr').length > 0) {
      $('table.tbl-data-jadwal').find('tbody').prepend('<tr class="table-load"><td class="text-center load-data" colspan="6">Memproses Data</td></tr>');
    }
    else{
      $('table.tbl-data-jadwal').find('tbody').html('<tr class="table-load"><td class="text-center load-data" colspan="6">Memproses Data</td></tr>');
    }
    var detail_jadwal = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{data:'daftar_kls_ptk',thn:thn},500);
    detail_jadwal.then(function(detail_jadwal){
      if (detail_jadwal.record_jadwal != '') {
        $('table.tbl-data-jadwal').find('tbody').text('');
        $('#box-content .tahun-ajaran-jad').html('<li class="fa fa-book"></li> '+detail_jadwal.record_jadwal[0]['thn_ajaran']);
        $('#box-content .jumlah-jadwal-jad').html('<li class="fa fa-list"></li> '+detail_jadwal.count_jadwal_ptk['count_ptk_jdl']);
        $('#box-content .jumlah-kls-jad').html('<li class="fa fa-building-o"></li> '+detail_jadwal.count_jadwal_ptk['count_ptk_kls']);
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
                if (data_record.status_inp_nilai == 1) {
                  var ac = '  <td class="text-center"><button class="btn btn-info btn-sm view-nilai" value="'+data_record.jdl_in+'" title="Input nilai mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-pencil-square"></i></button></td>';
                }
                else{
                  var ac = '  <td class="text-center"><button class="btn btn-warning btn-sm view-nilai" value="'+data_record.jdl_in+'" title="Lihat nilai mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button></td>';
                }
                kelas = data_record.semester+'/'+data_record.kelas;
                if (kelas == dt_kelas && data_record.jenis_jdl == data_u.jenis_jdl) {
                    if (no == 1) {
                      $('table.tbl-data-jadwal').find('tbody').append(
                        '<tr'+row_color+'>'
                        +'  <td rowspan="" class="kelas-row'+data_record.jdl_no+' text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                        +'  <td>'+data_record.nama_mk+'</td>'
                        +'  <td class="text-center">'+data_record.jml_sks+'</td>'
                        +'  <td>'+data_record.nama_prodi+'</td>'
                        +'  <td class="text-center"><li class="fa fa-users" title="Jumlah mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_mhs+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_pr+'</td>'
                        +ac
                        +'</tr>'                  
                      );
                      no_kelas = data_record.jdl_no;
                    }
                    else{
                      $('table.tbl-data-jadwal').find('tbody').append(
                        '<tr'+row_color+'>'
                        +'  <td>'+data_record.nama_mk+'</td>'
                        +'  <td class="text-center">'+data_record.jml_sks+'</td>'
                        +'  <td>'+data_record.nama_prodi+'</td>'
                        +'  <td class="text-center"><li class="fa fa-users" title="Jumlah mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_mhs+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_pr+'</td>'
                        +ac
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
                if (data_record.status_inp_nilai == 1) {
                  var ac = '  <td class="text-center"><button class="btn btn-info btn-sm view-nilai" value="'+data_record.jdl_in+'" title="Input nilai mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-pencil-square"></i></button></td>';
                }
                else{
                  var ac = '  <td class="text-center"><button class="btn btn-warning btn-sm view-nilai" value="'+data_record.jdl_in+'" title="Lihat nilai mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+' mata kuliah '+data_record.nama_mk+'"><i class="fa fa-list"></i></button></td>';
                }
                kelas = data_record.semester+'/'+data_record.kelas;
                if (kelas == dt_kelas && data_record.jenis_jdl == data_u.jenis_jdl) {
                  if (no == 1) {
                    $('table.tbl-data-jadwal').find('tbody').append(
                      '<tr>'
                      +'  <td colspan="6" align="left"><b>Konsentrasi '+data_record.nm_konsentrasi+'</b></td>'
                      +'</tr>'                  
                      +'<tr>'
                      +'  <td rowspan="" class="text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                      +'  <td>'+data_record.nama_mk+'</td>'
                      +'  <td class="text-center">'+data_record.jml_sks+'</td>'
                      +'  <td>'+data_record.nama_prodi+'</td>'
                      +'  <td class="text-center"><li class="fa fa-users" title="Jumlah mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_mhs+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_pr+'</td>'
                      +ac
                      +'</tr>'                  
                    );
                  }
                  else{
                    $('table.tbl-data-jadwal').find('tbody').append(
                      '<tr>'
                      +'  <td rowspan="" class="text-center">'+data_record.semester+'/'+data_record.kelas+'</td>'
                      +'  <td>'+data_record.nama_mk+'</td>'
                      +'  <td class="text-center">'+data_record.jml_sks+'</td>'
                      +'  <td>'+data_record.nama_prodi+'</td>'
                      +'  <td class="text-center"><li class="fa fa-users" title="Jumlah mahasiswa kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_mhs+' <li class="fa fa-male" title="Jumlah mahasiswa laki-laki kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_lk+' <li class="fa fa-female" title="Jumlah mahasiswa perempuan kelas '+data_record.semester+'/'+data_record.kelas+'"></li> '+data_record.jml_pr+'</td>'
                      +ac
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
          $('table.tbl-data-jadwal tbody').html('<tr><td colspan="6" align="center">Untuk tahun akademik ini anda tidak memiliki kelas didik</td></tr>');
        }
        else{
          $('table.tbl-data-jadwal tbody').html('<tr><td colspan="6" align="center">Untuk saat ini tidak ada tahun akademik yang diterapkan</td></tr>');
        }
      }
      $('.tamp-kls').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      $('#box-kelas-mhs').slideUp();
      $('#box-content').find('div.overlay').fadeOut();
    }).catch(function(error){
      $('.tamp-kls').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
      $('#box-jadwal').find('div.overlay').fadeOut();
      if ($('table.tbl-data-jadwal tbody tr.table-load').length == 1) {
        $('table.tbl-data-jadwal tbody tr.table-load td').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
      }
      setTimeout(function(){
        $('table.tbl-data-jadwal tbody tr.table-load').remove();
      },2000);
    });
  }
  /*END -- Function: Daftar kelas didik*/

  /*Function: Table nilai mahasiswa*/
  function view_nilai(kelas){
    $('.tbl-daftar-kelas-mhs').find('tbody').html('<tr><td colspan="5" align="center" class="load-data">Memproses Data</td></tr>');
    $('.tbl-daftar-kelas-mhs .pdk-nilai').show();
    $('.btn-input-nilai').text('');
    $('.detail-kelas .detail-dt-kelas').text('-');
    $('#box-kelas-mhs input[name=c_kelas]').val('');
    var detail_kelas = getJSON_async(protocol + '//'+host+path_home+'/action/ambil',{kelas:kelas,data:'daftar_nilai_mhs'},500,true);
    detail_kelas.then(function(detail_kelas){
      if (detail_kelas.record_kelas != '') {
        if ($('#box-kelas-mhs .box-body').is(':visible')) {
          $('#box-kelas-mhs').find('div.overlay').fadeIn();
          delay(function(){
            $('#box-kelas-mhs').find('div.overlay').fadeOut();
            $('html, body').animate({scrollTop:$('#box-kelas-mhs').offset().top - 55},800);
          },500);
        }
        else{
          $('#box-kelas-mhs').fadeIn();
          collapse_box('#box-kelas-mhs');
          delay(function(){
            $('#box-kelas-mhs').find('div.overlay').fadeOut();
            $('html, body').animate({scrollTop:$('#box-kelas-mhs').offset().top - 55},800);
          },100);
        }
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
        });
        if (detail_kelas.record_mhs != '') {
          if (detail_kelas.input == true) {
            $('.view-nilai').removeClass('btn-warning btn-info').addClass('btn-info');
            $('.view-nilai').find('i').removeClass('fa-circle-o-notch fa-spin fa-list').addClass('fa-pencil-square');
            $('.btn-input-nilai').parent('.row-input').show();
            $('.btn-input-nilai').html('<button id="update-nilai" class="btn btn-info"><i class="fa fa-pencil-square"></i> Input Nilai</button>').attr('id','add-nilai');
            $.each(detail_kelas.record_mhs, function(index, data_record){
              if (data_record.nilai_akhir != '') {
                return $('.btn-input-nilai').html('<button id="update-nilai" class="btn btn-success"><i class="fa fa-pencil-square"></i> Update Nilai</button>').attr('id','up-nilai');
              }
            });
            $('#box-kelas-mhs input[name=c_kelas]').val(detail_kelas.record_kelas[0]['jdl_i']);
          }
          else{
            $('.view-nilai').removeClass('btn-warning btn-info').addClass('btn-warning');
            $('.view-nilai').find('i').removeClass('fa-circle-o-notch fa-spin fa-pencil-square').addClass('fa-list');
            $('.btn-input-nilai').text('');
            $('.btn-input-nilai').parent('.row-input').hide();
          }
          $('.tbl-daftar-kelas-mhs').find('tbody').text('');
          var no = 1,nilai,pdk;
          $.each(detail_kelas.record_mhs, function(index, data_record){
            if (data_record.nilai_akhir != '') {
              if (detail_kelas.input == true) {
                nilai = '<span class="pdk-nilai">'+data_record.nilai_akhir+'</span><input type="number" name="nilai_akhir[]" value="'+data_record.nilai_akhir+'" style="width:100%;display:none"><input type="hidden" name="id_kls_nilai[]" value="'+data_record.id_kelas+'">';
                pdk = data_record.pdk;
              }
              else{
                nilai = data_record.nilai_akhir;
                pdk = data_record.pdk;
              }
            }
            else{
              if (detail_kelas.input == true) {
                nilai = '<span class="pdk-nilai">-</span><input type="number" name="nilai_akhir[]" value="" style="width:100%;display:none"><input type="hidden" name="id_kls_nilai[]" value="'+data_record.id_kelas+'">';
                pdk = '-';
              }
              else{
                nilai = '-';
                pdk = '-';
              }
            }
            $('table.tbl-daftar-kelas-mhs').find('tbody').append(
              '<tr>'
              +'  <td class="text-center">'+no+'</td>'
              +'  <td class="text-center">'+data_record.nisn+'</td>'
              +'  <td>'+data_record.nama+'</td>'            
              +'  <td class="text-center input-nilai">'+nilai+'</td>'
              +'  <td class="text-center pdk-nilai">'+pdk+'</td>'
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
    }).catch(function(error){
      $('.view-nilai').find('i').removeClass('fa-circle-o-notch fa-spin fa-pencil-square').addClass('fa-list');
    });
  }
  /*END -- Function: Table nilai mahasiswa*/

  /*Function: Detail data PTK*/
  function detail_data_ptk(){
    if ($('.tbl-pend-ptk tr.table-load').length == 0) {
      $('.tbl-pend-ptk').find('tbody').append('<tr class="table-load"><td class="text-center load-data" colspan="5">Memproses Data</td></tr>');
    }
    if ($('.tbl-riwayat-ptk tr.table-load').length == 0) {
      $('.tbl-riwayat-ptk').find('tbody').append('<tr class="table-load"><td class="text-center load-data" colspan="6">Memproses Data</td></tr>');
    }
    if ($('.tbl-penelitian-ptk tr.table-load').length == 0) {
      $('.tbl-penelitian-ptk').find('tbody').append('<tr class="table-load"><td class="text-center load-data" colspan="4">Memproses Data</td></tr>');
    }
    var data_ptk = getJSON_async(protocol + '//'+host+controller_path+'/action/ambil',{data:'detail_data_ptk'},1000);
    data_ptk.then(function(data_ptk){
      if (data_ptk.studi_ptk != '') {
        $('.profil-rwt-pendidikan-ptk').text(data_ptk.studi_ptk.length);
        $('.tbl-pend-ptk').find('tbody').text('');
        var no = 1;
        $.each(data_ptk.studi_ptk, function(index, data_record){
          $('.tbl-pend-ptk').find('tbody').append(
            '<tr>'
            +'  <td class="text-center">'+no+'</td>'
            +'  <td>'+data_record.nama_pt_studi+'</td>'
            +'  <td class="text-center">'+data_record.gelar_ak_ptk+'</td>'
            +'  <td class="text-center">'+data_record.tgl_ijazah_ptk+'</td>'
            +'  <td class="text-center">'+data_record.jenjang_studi_ptk+'</td>'
            +'</tr>'   
            );
          no++;
        });
      }
      else{
        $('.tbl-pend-ptk').find('tbody').html(
          '<tr>'
          +'  <td colspan="5" align="center">Untuk saat ini, anda ini belum memiliki riwayat pendidikan</td>'
          +'</tr>'
          );
      }

      if (data_ptk.riwayat_mengajar != '') {
        $('.profil-rwt-mengajar-ptk').text(data_ptk.riwayat_mengajar.length);
        $('.tbl-riwayat-ptk').find('tbody').text('');
        var no = 1;
        $.each(data_ptk.riwayat_mengajar, function(index, data_record){
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
      else{
        $('.tbl-riwayat-ptk').find('tbody').html(
          '<tr>'
          +'  <td colspan="6" align="center">Untuk saat ini, anda ini belum memiliki riwayat mengajar</td>'
          +'</tr>'
          );
      }

      if (data_ptk.penelitian_ptk != '') {
        $('.profil-rwt-penelitian-ptk').text(data_ptk.penelitian_ptk.length);
        $('.tbl-penelitian-ptk').find('tbody').text('');
        var no = 1;
        $.each(data_ptk.penelitian_ptk, function(index, data_record){
          $('.tbl-penelitian-ptk').find('tbody').append(
            '<tr>'
            +'  <td class="text-center">'+no+'</td>'
            +'  <td>'+data_record.judul_penelitian+'</td>'
            +'  <td class="text-center">'+data_record.bidang_ilmu+'</td>'
            +'  <td>'+data_record.lembaga+'</td>'
            +'</tr>'   
            );
          no++;
        });
      }
      else{
        $('.tbl-penelitian-ptk').find('tbody').html(
          '<tr>'
          +'  <td colspan="4" align="center">Untuk saat ini, anda ini belum memiliki riwayat penelitian</td>'
          +'</tr>'
          );
      }
    }).catch(function(error){
      if ($('.tbl-pend-ptk tr.table-load').length == 1) {
        $('.tbl-pend-ptk tr.table-load td').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
      }
      if ($('.tbl-riwayat-ptk tr.table-load').length == 1) {
        $('.tbl-riwayat-ptk tr.table-load td').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
      }
      if ($('.tbl-penelitian-ptk tr.table-load').length == 1) {
        $('.tbl-penelitian-ptk tr.table-load td').html('Terjadi kesalahan, <b>Error '+error.status+': '+error.statusText+'</b>');
      }
      setTimeout(function(){
        $('.tbl-pend-ptk tr.table-load, .tbl-riwayat-ptk tr.table-load, .tbl-penelitian-ptk tr.table-load').remove();
      },2000);
    });
  }
  /*END -- Function: Detail data PTK*/

  /*Function: Chart PTK*/
  function chart_ptk(data){
    var pieChartCanvas = $("#pieChart-data-ptk").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      // percentageInnerCutout: 40, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: false,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
      //String - A tooltip template
      tooltipTemplate: "<%=label%> : <%=value %> Orang"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Pie(data, pieOptions);
  }
  /*END -- Function: Chart PTK*/