$(function(){

  /*HASHCHANGE*/
  start_hashchange(function(hash){
        hashchange_act(hash, function(){
            var urlvar = getUrlVars();
            if (hash == 'tambah') {
                $('#myModal #form-input').show();
                $('#myModal #form-input-pstudi').hide();
                $('#myModal .modal-title').text('Tambah Data Fakultas');
            }
            else if (hash.search('tambah') == 0) {
                if (urlvar == 'prodi') {
                    $('#myModal #form-input-pstudi, .modal .submit-btn, .modal .submit-again-btn').show();
                    $('#myModal .modal-title').text('Tambah Program Studi');
                    $('#myModal #submit').text('Simpan');
                    $('#myModal #submit').prepend('<li class="fa fa-save"></li> ');
                    $('#myModal #submit-again').prepend('<li class="fa fa-clone"></li> ');
                }
                else if (urlvar['fk'] != undefined) {
                    $('#myModal .modal-title').text('Tambah Program Studi');
                    var fk = getUrlVars()['fk'],
                    id = getUrlVars()['i'],
                    data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id_fk:id,data:'data_fakultas'},1000);
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
                else if (urlvar['prodi_kons'] != undefined) {
                    if ($('#box-prodi').is(':visible') || $('#box-detail-fk').is(':visible')) {
                        $('#myModal .modal-title').text('Tambah Konsentrasi Program Studi');
                        var pd = getUrlVars()['prodi_kons'],
                        id = getUrlVars()['i'],
                        data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil_id',{id_pd:id,data:'data_prodi'},1000);
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

                return data;
            }
            else if(hash.search('edit') == 0){
                if (urlvar[0] == 'fk') {
                    var id = getUrlVars()['fk'];
                    var data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id_fk:id,data:'data_fakultas'},500);
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
                    var data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id_pd:id,data:'data_prodi',act:'edit'},500);
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
                        var data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id:id,data:'data_konsentrasi_pd'},500);
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

                return data;
            }
            else if(hash.search('hapus') == 0){
                if (urlvar[0] == 'fk') {
                    var id = urlvar['fk'];
                    var data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil_id',{id_fk:id,data:'data_fakultas'},500);
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
                    var id = urlvar['pd'];            
                    var data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil_id',{id_pd:id,data:'data_prodi'},500);
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
                        var id = urlvar['konsentrasi'];
                        var data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id:id,data:'data_konsentrasi_pd'},500);
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

                return data;
            }
            else if(hash.search('data')==0){
                if (urlvar[0] == 'fk') {
                    var id = getUrlVars()['i'];
                    $('.close-dt-pd-bt').fadeOut();
                    $('.detail-prodi').fadeOut().removeClass('active').find('a').attr('aria-expanded','false');
                    $('#detail-prodi').removeClass('active');
                    $('.daftar-prodi').addClass('active').find('a').attr('aria-expanded','true');
                    $('#daftar-prodi').addClass('active');
                    data_detail_fk(id);
                }
                else if (urlvar[0] == 'pd' && $('#box-detail-fk').is(':visible')) {
                    var id = urlvar['pd'],
                    id_fk,
                    data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id_pd:id,data:'data_prodi'},null,true);
                    $('.data-detail-prodi[data-search='+id+']').find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
                    data.then(function(detail_prodi){
                        $('.data-detail-prodi').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
                        if (detail_prodi.data != '') {
                            $.each(detail_prodi.data, function(index, data_record){
                                id_fk = data_record.id_fk;
                                $('.detail-prodi').html('<span class="fa fa-list"></span> Detail Prodi '+data_record.nama_prodi);
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
                            window.history.pushState(null,null,global_vars.path);
                            swal({
                                title:'Info',
                                text: 'Program Studi yang anda pilih tidak ada didalam database!',
                                type:'info',
                                timer: 2000
                            });
                        }
                    }).catch(function(){
                        $('.data-detail-prodi').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-list');
                        window.history.pushState(null,null,global_vars.path);
                    });
                }
            }
            else if (hash == 'delete_selected' || hash.search('delete_selected')==0) {
                var selectedItems = [];
                if (urlvar == 'fk') {
                    var check = 'data_fk';
                    $(".check-fk:checked").each(function() {
                        selectedItems.push($(this).val());
                    });       
                }
                else if (urlvar == 'pd') {
                    var check = 'data_pd';
                    $(".check-prodi:checked").each(function() {
                        selectedItems.push($(this).val());
                    });       
                }
                $('.data-message').show();
                var count = selectedItems.length;          
                if (count > 0 ) {
                    var data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id:selectedItems,data:'check_data_master',check:check},1000);
                    data.then(function(detail_data){
                        $('.data-message .content-message').addClass('centered-text');
                        if (detail_data.total_rows > 0 ) {
                            if (urlvar == 'fk') {
                                $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+detail_data.total_rows+'&nbspdata</strong>&nbspFakultas ?');
                            }
                            else if (urlvar == 'pd') {
                                $('.data-message .content-message').html('Apakah anda yakin ingin menghapus&nbsp<strong>'+detail_data.total_rows+'&nbspdata</strong>&nbspProgram Studi ?');
                            }
                        }
                        else{
                            if (urlvar == 'fk') {
                                $('.data-message .content-message').html('Data fakultas yang anda ingin hapus tidak ditemukan dalam database!');
                            }
                            else if (urlvar == 'pd') {
                                $('.data-message .content-message').html('Data program studi yang anda ingin hapus tidak ditemukan dalam database!');
                            }
                        }
                    });
                }
                else{
                    $('.data-message .content-message').addClass('centered-content');
                    if (urlvar == 'fk') {
                        $('.data-message .content-message').html('Silahkan pilih data Fakultas yang ingin dihapus!');
                    }
                    else if (urlvar == 'pd') {
                        $('.data-message .content-message').html('Silahkan pilih data Program Studi yang ingin dihapus!');
                    }
                    $('#submit, #delete-selected').hide();
                    $('#batal').text('Tutup');
                }

                if (urlvar == 'fk') {
                    $('#myModal .modal-title').text('Hapus Data Fakultas');
                }
                else if (urlvar == 'pd') {
                    $('#myModal .modal-title').text('Hapus Data Program Studi');
                }

                return data;
            }
        });
  });
  /*END -- HASHCHANGE*/

  /*Submit AJAX*/
  submit_ajax({
        'url': function(){
            var url = {
                'host': global_vars.host,
                'controller_path': global_vars.controller_path
            };
            return url;
        },
        'datasend': function(){
            var data = getUrlVars();
            var datasend;
            if (data == 'prodi' || data == 'fk,i,token' || data == 'pd,token') {
                var datasend = $('#form-input-pstudi').serialize();
            }
            else if (data['data'] == 'konsentrasi_prodi' || data['prodi_kons'] != undefined) {
                var datasend = $('#form-input-konsentrasi-pd').serialize();
            }
            return datasend;
        },
        'callback_rn': function(act, data_respon){
            if (act == 'tambah' && data_respon.status == 'success') {
                if (data_respon.data == 'data_fakultas') {
                    $('.tbl-data-fk').DataTable().ajax.reload();
                }
                else if (data_respon.data == 'data_prodi') {
                    if ($('#box-detail-fk').is(':visible')) {
                        var id = $('#form-input-pstudi .id_fk_pd').val();
                        if ($('#box-prodi').is(':visible')) {
                            $('.tbl-data-pd').DataTable().search('').draw();
                        }
                        data_detail_fk(id);
                    }
                }
            }
            else if (act == 'update' && data_respon.status == 'success') {
                if (data_respon.data == 'data_fakultas') {
                    $('.tbl-data-fk').DataTable().ajax.reload();
                    if ($('#box-detail-fk').is(':visible')) {
                        var id = getUrlVars()['fk'];
                        data_detail_fk(id);
                    }
                }
                else if (data_respon.data == 'data_prodi') {
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
                        $('.tbl-data-pd').DataTable().search('').draw();
                    }
                }
                else if (data_respon.data == 'data_konsentrasi_pd') {
                    if ($('#tab-detail-fk a.detail-prodi').is(':visible')) {
                        delay(function(){
                            window.location.href= global_vars.path+'#data?pd='+data_respon.pd+'&token='+token+'';
                        },500);
                    }
                }
            }
            else if (act == 'delete' && data_respon.status == 'success') {
                if (data_respon.data == 'data_fakultas') {
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
                else if (data_respon.data == 'data_prodi') {
                    $('.check-all-prodi').iCheck('uncheck');
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
                        $('.tbl-data-pd').DataTable().search('').draw();
                    }
                }
                else if (data_respon.data == 'data_konsentrasi_pd') {
                    if ($('#tab-detail-fk .nav-tabs li.detail-prodi').is(':visible')) {
                        delay(function(){
                            window.location.href= global_vars.path+'#data?pd='+data.pd+'&token='+token+'';
                        },500);
                    }
                }
            }
        }
  });
  /*END -- Submit AJAX*/

  /*Delete Multiple Data*/
  delete_multiple_dt(function(){
    var id = [];
    if (getUrlVars() == 'fk') {
        $(".check-fk:checked").each(function() {
            if ($(this).val() != '') {
                id.push($(this).val());
            }
        });
        var selected_data = id.length;
        if (selected_data > 0) {
            var hapus = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/delete',{id:id,data:'data_fakultas'},1000);
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
            var hapus = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/delete',{id:id,data:'data_prodi'},1000);
            hapus.then(function(hapus){
                if (hapus.status =='success') {
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

    delete_data = {
        'dt': selected_data,
        'delete_dt': hapus
    };
    return delete_data;
  });
  /*END -- Delete Multiple Data*/

  /*Onclick Event*/
  $(document).on('click','.remove', function(eve){
    eve.stopImmediatePropagation();
    eve.preventDefault();

    if ($(this).attr('data-remove') == 'detail-fk') {
        delay(function(){
            $('.tbl-data-prodi').find('tbody').html(
                '<tr>'
                +'    <td colspan="5" align="center">Memproses Data</td>'
                +'</tr>'
            );
            $('#box-detail-fk .detail-fak').text('-');
        },1000);
    }
    if ($(this).attr('data-remove') == 'detail-prodi' || $(this).attr('data-remove') == 'detail-fk') {
        $('.close-dt-pd-bt').fadeOut();
        $('.detail-prodi').fadeOut().removeClass('active').find('a').attr('aria-expanded','false');
        $('#detail-prodi').removeClass('active').find('.detail-dt-prodi').text('-');
        $('#detail-prodi .tbl-data-konst-pd').find('tbody').html('<tr><td colspan="3" align="center">Pilih program studi terlebih dahulu</td></tr>')
        $('.daftar-prodi').addClass('active').find('a').attr('aria-expanded','true');
        $('#daftar-prodi').addClass('active');
        window.history.pushState(null,null,global_vars.path);
    }
  });

  $('a[href="#statik-fk"]').on('click', function(){
    $(this).css('pointer-events','none');
    data_master_chart('static_mhs_fk');
  });

  $('.refresh-table-pd').on('click', function(eve){
    eve.preventDefault();
    Pace.restart();
    var btn = $(this),
    btn_act = btn.find('i');
    btn.addClass('disabled');
    if ($('#box-prodi').is(':visible')) {
      btn_act.removeClass('fa-list').addClass('fa-refresh fa-spin');
      setTimeout(function(){
        btn_act.removeClass('fa-refresh fa-spin').addClass('fa-list');
      },1070);
    }
    $('#box-prodi').slideDown();
    $('.tbl-data-pd').DataTable().ajax.reload();
    $('html, body').animate({scrollTop:$('#box-prodi').offset().top - 55},800);
  });
  /*END -- Onclick Event*/

  /*Select2 Plugin*/
  $(".select2_akreditasi_fk").select2({
    placeholder: "Pilih akreditasi fakultas",      
    minimumResultsForSearch:-1,
  });

  $(".select2_jenjang").select2({
    placeholder: "Pilih jenjang program studi",      
    minimumResultsForSearch:-1,
  });

  $(".select2_akreditasi_prodi").select2({
    placeholder: "Pilih akreditasi program studi",      
  });

  $(".select2_status_prodi").select2({
    placeholder: "Pilih status program studi",      
  });

  $(".select2_fk").select2({
    placeholder: "Pilih Fakultas",
    ajax: {
      url: 'http://'+global_vars.host+data_master_path+'/action/ambil',
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
      url: 'http://'+global_vars.host+data_master_path+'/action/ambil',
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
  /*END -- Select2 Plugin*/

  /*Datatables Plugin*/
  var table_data_fk = $('.tbl-data-fk').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url" : "http://"+global_vars.host+global_vars.controller_path+"/data_table_request/data_fakultas",
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
          return '<input type="checkbox" class="check-data check-fk icheck-input-checkbox" name="id" value="'+id+'" data-selected="check-fk" data-all-selected="check-all-fk" data-toggle=".hapus">'
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
          return '<a href="#tambah?fk='+fk.replace(' ','_').toLowerCase()+'&i='+id_fk+'&token='+token+'" class="btn btn-info btn-sm text-white" title="Tambah Program Studi pada Fakultas '+fk+'" value="'+fk+'/'+id_fk+'"><i class="fa fa-plus"></i></a> | '
                +'<div class="btn-group">'
                +' <a href="#data?fk='+fk.replace(' ','_').toLowerCase()+'&i='+id_fk+'&token='+token+'" class="btn btn-warning btn-sm text-white detail-data-fk" data-search="'+id_fk+'" title="Lihat Program Studi pada Fakultas '+fk+'"><i class="fa fa-list"></i></a> '
                +' <a href="#edit?fk='+id_fk+'&token='+token+'" class="btn btn-success text-white btn-sm" title="Edit Data Fakultas '+fk+'"><i class="fa fa-pencil-square"></i></a> '
                +' <a href="#hapus?fk='+id_fk+'&token='+token+'" class="btn btn-danger text-white btn-sm" title="Hapus Data Fakultas '+fk+'"><i class="fa fa-trash"></i></a>'
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
      "url" : "http://"+global_vars.host+global_vars.controller_path+"/data_table_request/data_prodi",
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
          return '<input type="checkbox" class="check-data check-prodi icheck-input-checkbox" name="id" value="'+id+'" data-selected="check-prodi" data-all-selected="check-all-prodi" data-toggle=".hapus-prodi">'
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
          return '<a href="#tambah?data=konsentrasi_prodi&prodi_kons='+fk.replace(' ','_').toLowerCase()+'&i='+id_fk+'&token='+token+'" class="btn btn-info btn-sm text-white" title="Tambah Konsentrasi pada Program Studi '+fk+'"><i class="fa fa-plus"></i></a> | '
                +'<div class="btn-group">'
                +' <a href="#edit?pd='+id_fk+'&token='+token+'" class="btn btn-success btn-sm text-white" title="Edit Data Program Studi '+fk+'"><i class="fa fa-pencil-square"></i></a>'
                +' <a href="#hapus?pd='+id_fk+'&token='+token+'" class="btn btn-danger btn-sm text-white" title="Hapus Data Program Studi '+fk+'"><i class="fa fa-trash"></i></a>'
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
    "autoWidth": false
  });
  /*END -- Datatables Plugin*/

  /*Show Datatables Row Detail*/
  show_row_detail({
    'callback': function (data_row, tr) {
        if (data_row == 'data-prodi') {
            var row = table_data_pd.row(tr);
        }
        return row;
    },
    'detail_dt': function (str, data) {
        if (data == 'data-prodi') {
            var id_row = str.id_prodi;
            var detail_row_respon = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id_pd:str.id_prodi,data:'data_prodi'},500);
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
                        +'       <div class="col-md-6">'
                        +'          <dl class="row mb-0">'
                        +'              <dt class="col-sm-5 text-truncate">Fakultas</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['nama_fakultas']+'</dd>'
                        +'              <dt class="col-sm-5 text-truncate">Kode Program Studi</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['kode_prodi']+'</dd>'
                        +'              <dt class="col-sm-5 text-truncate">Nama Program Studi</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['nama_prodi']+'</dd>'
                        +'              <dt class="col-sm-5 text-truncate">Nama Ketua Prodi</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['nama_kprodi']+'</dd>'
                        +'              <dt class="col-sm-5 text-truncate">Jenjang</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['jenjang_prodi']+'</dd>'
                        +'              <dt class="col-sm-5 text-truncate">Akreditas</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['akreditasi_prodi']+'</dd>'
                        +'              <dt class="col-sm-5 text-truncate">Status</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['status_prodi']+'</dd>'
                        +'              <dt class="col-sm-5 text-truncate">SK Penyelenggaraan</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['sk_peny_prodi']+'</dd>'
                        +'              <dt class="col-sm-5 text-truncate">Tanggal SK</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['tgl_sk_prodi']+'</dd>'
                        +'              <dt class="col-sm-5 text-truncate">Tanggal Berdiri</dt>'
                        +'              <dd class="col-sm-7">'+detail_pd['tgl_berdiri_prodi']+'</dd>'
                        +'          </dl>'
                        +'      </div>'
                        +'      <div class="col-md-6">'
                        +'        <dl class="row mb-0">'
                        +'          <dt class="col-sm-5 text-truncate">Alamat</dt>'
                        +'          <dd class="col-sm-7">'+detail_pd['alamat_prodi']+'</dd>'
                        +'          <dt class="col-sm-5 text-truncate">Kode POS</dt>'
                        +'          <dd class="col-sm-7">'+detail_pd['kode_pos_prodi']+'</dd>'
                        +'          <dt class="col-sm-5 text-truncate">Telepon</dt>'
                        +'          <dd class="col-sm-7">'+detail_pd['telpon_prodi']+'</dd>'
                        +'          <dt class="col-sm-5 text-truncate">FAX</dt>'
                        +'          <dd class="col-sm-7">'+detail_pd['fax_prodi']+'</dd>'
                        +'          <dt class="col-sm-5 text-truncate">Email</dt>'
                        +'          <dd class="col-sm-7">'+detail_pd['email_prodi']+'</dd>'
                        +'          <dt class="col-sm-5 text-truncate">Website</dt>'
                        +'          <dd class="col-sm-7">'+detail_pd['website_prodi']+'</dd>'
                        +'          <dt class="col-sm-5 text-truncate">Jumlah Mahasiswa</dt>'
                        +'          <dd class="col-sm-7"><span class="fa fa-users"></span> '+detail_pd['jml_mhs']+'</dd>'
                        +'          <dt class="col-sm-5 text-truncate">Mahasiswa Laki-Laki</dt>'
                        +'          <dd class="col-sm-7"><span class="fa fa-male"></span> '+detail_pd['jml_lk']+'</dd>'
                        +'          <dt class="col-sm-5 text-truncate">Mahasiswa Perempuan</dt>'
                        +'          <dd class="col-sm-7"><span class="fa fa-female"></span> '+detail_pd['jml_pr']+'</dd>'
                        +'        </dl>'
                        +'      </div>'
                        +'    </div>'
                    ).removeClass('text-center').addClass('mb-0');
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
        var return_dt = {
            'id_row': id_row,
            'detail_row_respon': detail_row_respon
        };
        return return_dt;
    }
  });
  /*END -- Datatables Show Row Detail*/

  /*Function*/
  /*Function: Chart data master*/
  function data_master_chart(data){
    $('a[href="#statik-fk"], .static-mhs-tab').find('span, i').removeClass('fa-bar-chart').addClass('fa-circle-o-notch fa-spin');
    $('#statik-fk .load-row').remove();
    if ($("#barchart-mhs-master-dt").height() <= 315) {
      $('#statik-fk .chart-container, .static-tab .chart-container').hide();
      $('#statik-fk, .static-tab').prepend('<div class="row load-row"><div class="col-md-12 text-center"><font class="load-data">Memproses Data</font></div></div>');
    }
    $('.detail-jml-mhs-dt .progress-bar').css('width','0%');
    var data_static = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/data_statistik',{data:data},500,true);
    data_static.then(function(data_static){
      $('a[href="#statik-fk"]').css('pointer-events','');
      $('a[href="#statik-fk"], .static-mhs-tab').find('span, i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-bar-chart');
      $('#statik-fk .chart-container, .static-tab .chart-container').show();
      $('#statik-fk .load-row, .static-tab .load-row').remove();
      $('.detail-jml-mhs-dt').text('');
      $('.detail-jml-mhs-dt').prepend('<p class="text-center"><strong>Keterangan</strong></p>');
      $('#barchart-mhs-master-dt').replaceWith('<canvas id="barchart-mhs-master-dt" style="height: 315px; width: 510px;"></canvas>');
      var no = 1;  
      $.each(data_static.fk, function(index,data_record){
        $('.detail-jml-mhs-dt').append(
          '<div class="progress-group">'
          +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> '+data_record.nama_fakultas+'</span>'
          +'  <span class="progress-number pull-right">'+data_record.statik_mhs+'%</span>'
          +'  <div class="progress progress-sm">'
          +'    <div class="progress-bar p-bar-'+no+'" style="background-color:'+data_record.color_detail+';width:0%"></div>'
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
      
      var ctx = $("#barchart-mhs-master-dt").get(0).getContext("2d"),
      color_opc = Chart.helpers.color,
      new_color = [],
      chart_label = data_static.nama_fk;;
      $.each(data_static.color, function(index,clr){
        new_color.push(color_opc(clr).alpha(0.5).rgbString());
      });

      var data_chart = {
              labels: chart_label,
              datasets: [
              {
                  label: "Laki-Laki",
                  backgroundColor: new_color,
                  borderColor: data_static.color,
                  data: data_static.mhs_lk,
              },
              {
                  label: "Perempuan",
                  backgroundColor: new_color,
                  borderColor: data_static.color,
                  data: data_static.mhs_pr,
              }
              ]
          };

      var option_chart = {
            responsive: true,
            scales: {
              yAxes: [{
                display: true,
                ticks: {
                  suggestedMin: 0,
                }
              }]
            },
            legend: {
              display: false
            },
            tooltips: {
              enabled: false,
              position: 'average',
              mode: 'index',
              intersect: false,
              callbacks: {
                  footer: function(items, data) {
                    var sum = 0;
                    items.forEach(function(tooltipItem) {
                        sum += data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                    });
                    if (sum > 0) {
                      return 'Jumlah: ' + sum + ' Orang';
                    }
                    else{
                      return 'Jumlah: 0';
                    }
                  },
              },
              custom: function(tooltip){
                if (tooltip.body) {
                  for (var i = 0; i <= tooltip.body.length; i++) {
                    if (tooltip.dataPoints[i] && tooltip.dataPoints[i]['yLabel']) {
                      tooltip.body[i]['lines'] = [tooltip.body[i]['lines'] + ' Orang'];
                    }
                  }
                }

                // console.log(tooltip);
                if (tooltip.dataPoints) {
                  tooltip.title = [data_static.fk[tooltip.dataPoints[0]['index']]['nama_fakultas']];
                }

                // Tooltip Element
                var tooltipEl = document.getElementById('chartjs-tooltip-mhs-pd');

                if (!tooltipEl) {
                  tooltipEl = document.createElement('div');
                  tooltipEl.id = 'chartjs-tooltip-mhs-pd';
                  tooltipEl.innerHTML = "<table></table>";
                  tooltipEl.classList.add('chartjs-tooltip');
                  this._chart.canvas.parentNode.appendChild(tooltipEl);
                }

                // Hide if no tooltip
                if (tooltip.opacity === 0) {
                  tooltipEl.style.opacity = 0;
                  return;
                }

                // Set caret Position
                tooltipEl.classList.remove('above', 'below', 'no-transform');
                if (tooltip.yAlign) {
                  tooltipEl.classList.add(tooltip.yAlign);
                } else {
                  tooltipEl.classList.add('no-transform');
                }

                function getBody(bodyItem) {
                  return bodyItem.lines;
                }

                // Set Text
                if (tooltip.body) {
                  var titleLines = tooltip.title || [];
                  var bodyLines = tooltip.body.map(getBody);

                  var innerHtml = '<thead>';

                  titleLines.forEach(function(title) {
                    innerHtml += '<tr><th>' + title + '</th></tr>';
                  });
                  innerHtml += '</thead><tbody>';

                  bodyLines.forEach(function(body, i) {
                    var colors = tooltip.labelColors[i];
                    var style = 'background:' + colors.borderColor;
                    style += '; border-color:' + colors.borderColor;
                    style += '; border-width: 2px'; 
                    var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
                    innerHtml += '<tr><td>' + span + body + '</td></tr>';
                  });
                  innerHtml += '<tr><td class"text-center">'+ tooltip.footer +'</td></tr>';
                  innerHtml += '</tbody>';

                  var tableRoot = tooltipEl.querySelector('table');
                  tableRoot.innerHTML = innerHtml;
                }

                var positionY = this._chart.canvas.offsetTop;
                var positionX = this._chart.canvas.offsetLeft;

                // Display, position, and set styles for font
                tooltipEl.style.opacity = 1;
                tooltipEl.style.left = positionX + tooltip.caretX + 'px';
                tooltipEl.style.top = positionY + tooltip.caretY + 'px';
                tooltipEl.style.fontFamily = tooltip._fontFamily;
                tooltipEl.style.fontSize = tooltip.fontSize;
                tooltipEl.style.fontStyle = tooltip._fontStyle;
                tooltipEl.style.padding = tooltip.yPadding + 'px ' + tooltip.xPadding + 'px';
              }
            },
            animation: {
              onComplete: function(e){
                if (e.chart.height > 0 ) {
                  var dt_mhs = $('.detail-jml-mhs-dt');
                  dt_mhs.slimScroll({
                    position: 'right',
                    height: e.chart.height + 'px',
                    allowPageScroll:true
                  });
                }
              }
            }
          };

      var chart = new Chart(ctx, {
          type: 'bar',
          data: data_chart,
          options: option_chart
      });
    }).catch(function(){
      $('a[href="#statik-fk"]').css('pointer-events','');
      $('a[href="#statik-fk"], .static-mhs-tab').find('span, i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-bar-chart');
      $('#statik-fk .load-row, .static-tab .load-row').remove();
    });
  }
  /*END -- Function: Chart data master*/

  /*Function: Detail Fakultas*/
  function data_detail_fk(i){
    $('.check-all-prodi').iCheck('uncheck');
    $('.detail-data-fk[data-search='+i+']').find('i').removeClass('fa-list').addClass('fa-circle-o-notch fa-spin');
    var detail_fak = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id:i,data:'detail_fk'},500);
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
                    +'  <td class="text-center">'+no+'</td>'
                    +'  <td class="text-center">'+data_record.kode_prodi+'</td>'
                    +'  <td class="daftar-nm-pd">'+data_record.nama_prodi+'</td>'
                    +'  <td class="text-center">'+data_record.jenjang_prodi+'</td>'
                    +'  <td class="text-center">'
                    +'    <a href="#tambah?data=konsentrasi_prodi&prodi_kons='+data_record.nama_prodi.replace(' ','_').toLowerCase()+'&i='+data_record.id_prodi+'&token='+token+'" class="btn btn-info btn-sm text-white" title="Tambah Konsentrasi pada Program Studi '+data_record.nama_prodi+'"><i class="fa fa-plus"></i></a> | '
                    +'    <div class="btn-group">'
                    +'      <a href="#data?pd='+data_record.id_prodi+'&token='+token+'" class="btn btn-warning btn-sm text-white data-detail-prodi" data-search="'+data_record.id_prodi+'" title="Lihat Detail Program Studi '+data_record.nama_prodi+'"><i class="fa fa-list"></i></a> '
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
        window.history.pushState(null,null,global_vars.path);
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
  /*END -- Function*/

  /*Function: Daftar Konsentrasi*/
  function daftar_konsentrasi(data, index){
    if (data != null) {
        var data_konsentrasi_pd = data;
    }
    else{
        var data_konsentrasi_pd = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{id_konst:index,data:'daftar_konsentrasi_pd'},500);
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

});