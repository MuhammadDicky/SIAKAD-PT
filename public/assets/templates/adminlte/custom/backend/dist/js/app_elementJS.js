$(function(){

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

    $(".select2_data").select2({
      placeholder: "Pilih data yang ditampilkan",
      minimumResultsForSearch:-1,
      templateResult: function formatselect(state){
        var icon;
        if (state.id == 0) {
          icon = 'fa-graduation-cap';
        }
        else if (state.id == 1) {
          icon = 'fa-times';
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

    $(".select2_thn_akademik").select2({
      placeholder: "Pilih tahun akademik",      
      ajax: {
        url: 'http://'+host+data_master_path+'/action/ambil',
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
        url: 'http://'+host+data_master_path+'/action/ambil',
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
        url: 'http://'+host+data_master_path+'/action/ambil',
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
        url: 'http://'+host+data_master_path+'/action/ambil',
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
        url: 'http://'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
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
            state.nama_prodi = '-';
          }
          var $state = $(
            "<p style='margin-bottom:0px'><i class='fa fa-book'></i> "+state.text+"</p>"
            +"<p style='margin-bottom:0px'>Program Studi: "+state.nama_prodi+" ("+state.jenjang_prodi+")</p>"
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
        url: 'http://'+host+data_master_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          if ($.param.fragment() == 'tambah') {
            var prodi_konst = $('#form-input .select2_prodi').val();
          }
          else if ($.param.fragment() == 'edit') {
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
    });

    $(".select2_ptk").select2({
      placeholder: "Pilih dosen",      
      ajax: {
        url: 'http://'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_ptk',csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.ptk,
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

        if (path == controller_path+'/data_jadwal_kuliah') {
          var $state = $(
            "<p style='margin-bottom:0px'><i class='fa fa-user'></i> "+state.nama+"</p>"
            +"<p style='margin-bottom:0px'>NIDN: "+state.nidn+"</p>"
            +"<p style='margin-bottom:0px'>Program Studi: "+state.nama_prodi+" ("+state.jenjang_prodi+")</p>"
            +"<p style='margin-bottom:0px'>Status Keaktifan: "+state.status_aktif_ptk+"</p>"
          );
        }
        else if (path == controller_path+'/data_ptk') {
          var $state = $(
            "<p style='margin-bottom:0px'><i class='fa fa-user'></i> "+state.nama+"</p>"
            +"<p style='margin-bottom:0px'>NIDN: "+state.nidn+"</p>"
            +"<p style='margin-bottom:0px'>Program Studi: "+state.nama_prodi+" ("+state.jenjang_prodi+")</p>"
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
        url: 'http://'+host+data_master_path+'/action/ambil',
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
        url: 'http://'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,data:'daftar_mhs',pd:getUrlVars()['kelas_mhs'],act:getUrlVars()['data'],csrf_key:token};
        },
        processResults: function(data,params){
          params.page = params.page || 1;
          return { results: 
            data.mhs,
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
        var $state = $(
          "<p style='margin-bottom:0px'>"+state.nim_mhs+" | "+state.nama_mhs+"</p>"
        );
        if (state.text != undefined) {
          return $state;
        }
      },
    });

    $(".select2_kls_mhs").select2({
      placeholder: "Pilih kelas",
      ajax: {
        url: 'http://'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          if (path == controller_path+'/data_jadwal_kuliah') {
            var id = new Array();
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
        url: 'http://'+host+data_akademik_path+'/action/ambil',
        type: "post",
        dataType: "json",
        delay: 450,
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
        url: 'http://'+host+data_dashboard_path+'/list_table_db',
        type: "post",
        dataType: "json",
        delay: 450,
        data: function(params){
          return { value: params.term,page:params.page,csrf_key:token};
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
        url: 'http://'+host+data_pengguna_path+'/action/ambil',
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
        url: 'http://'+host+data_pengguna_path+'/action/ambil',
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

    $(".select2_thn_akademik").on('change', function(){
      if (path == controller_path+'/data_thn_akademik') {
        if ($(this).val()) {
          thn_akademik_chart($(this).val());
        }
      }
    });

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

    /*Boostrap File-Select*/
    $('.file-select-foto').fileinput({
      'showUpload':false,
      'browseClass':'btn btn-info',
      'browseLabel':'Pilih Berkas',
      'removeLabel':'Hapus',
      'removeClass':'btn btn-danger',
      'allowedFileExtensions': ['jpg','jpeg','png'],
      'maxFileCount':1,
      'maxFileSize':1024,
      'language':'id',
      'uploadUrl': "http://"+host+controller_path+"/upload_file",
      'uploadAsync':false,
      'showPreview':false,
      'elErrorContainer':'.validation-ft-inp',
    });
    
});