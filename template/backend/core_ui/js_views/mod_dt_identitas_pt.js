$(function(){

  /*First Load Page*/
  $('#tab-identitas-pt .detail-data-pt').text('-');
  var data_id_pt = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{data:'data_identitas_pt'});
  data_id_pt.then(function(results){
    if (results.status == 'empty') {
      $('#tab-identitas-pt .detail-data-pt').text('-');
      $('#tab-identitas-pt #profil').append(
        '<p class="text-center empty-pt-dt">Belum ada data untuk identitas perguruan tinggi. Klik <a class="btn btn-info btn-sm form-identitas-pt"><span class="fa fa-pencil-square"></span></a> untuk input data identitas perguruan tinggi pertama kalinya.</p>'
        );
    }
    else{
      $('.card').show();
      $.each(results.data, function(index, data_record){
        $.each(data_record, function(name, data_record){
          if (data_record =='') {
            data_record ='-';
          }
          if (name == 'website') {
            $('#tab-identitas-pt .'+name).parents().attr('href','http://'+data_record);
          }
          if (name == 'rt' || name == 'rw') {
            $('#tab-identitas-pt .'+name).text(data_record);
          }
          $('#tab-identitas-pt .detail-data-pt.'+name).text(data_record);
        });          
      });
    }
  });
  /*END -- First Load Page*/

  /*slimScroll Plugin*/
  $('#tab-identitas-pt #container-form-profil, #tab-identitas-pt #container-form-kontak').slimScroll({
    position: 'right',
    height: '340',
  });
  /*END -- slimScroll Plugin*/

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
        return undefined;
    },
    'callback_rn': function(act, data_respon){
        if (act == 'tambah' && data_respon.status == 'success' || act == 'update' && data_respon.status == 'success') {
            if (data_respon.data == 'data_identitas_pt') {
                if (data_respon.record_pt == '') {
                    $('#tab-identitas-pt .dl-horizontal .detail-data-pt').text('-');
                    $('.box').hide();
                    $('#tab-identitas-pt #profil, #tab-identitas-pt #kontak').append(
                        '<p class="text-center empty-pt-dt">Belum ada data untuk identitas perguruan tinggi. Klik <a class="btn btn-info btn-sm form-identitas-pt"><span class="fa fa-pencil-square"></span></a> untuk input data identitas perguruan tinggi pertama kalinya.</p>'
                    );
                }
                else{
                    $('.box').show();
                    $('.empty-pt-dt').remove();
                    $.each(data_respon.record_pt[0], function(index, data_record){
                        if (data_record =='') {
                            data_record ='-';
                        }
                        if (index == 'rt' || index == 'rw') {
                            $('#tab-identitas-pt .'+index).text(data_record);
                        }
                        $('#tab-identitas-pt .detail-data-pt.'+index).text(data_record);
                    });
                }
                $('#myModal-pt').modal('hide');
            }
        }
    }
  });
  /*END -- Submit AJAX*/

  /*Bootstrap Input File*/
  $('#file-select-logo-pt').fileinput({
    'browseClass':'btn btn-info btn-lg btn-secondary text-white',
    'browseLabel':'Pilih Berkas',
    'browseIcon':'<li class="fa fa-folder-open"></li>',
    'uploadClass':'btn btn-success btn-lg btn-secondary text-white',
    'uploadIcon':'<li class="fa fa-upload"></li>',
    'removeLabel':'Hapus',
    'removeClass':'btn btn-danger btn-lg btn-secondary text-white',
    'removeIcon':'<li class="fa fa-trash"></li>',
    'cancelIcon':'<li class="fa fa-ban"></li>',
    'cancelClass':'btn btn-default btn-lg btn-secondary text-white',
    'allowedFileExtensions': ['png'],
    'autoReplace':true,
    'maxFileCount':1,
    'maxFileSize':1024,
    'language':'id',
    'uploadUrl': "http://"+global_vars.host+data_dashboard_path+"/upload_file",
    'uploadAsync':true,
    'showPreview':false
  });

  $('#file-select-logo-pt').on('fileclear', function(){
    $(this).parents().find('.fileinput-remove-button').hide();
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
  /*END -- Bootstrap Input File*/

  /*Select2 Plugin*/
  $(".select2_status").select2({
    placeholder: "Pilih status perguruan tinggi",
    minimumResultsForSearch:-1,
    allowClear: true
  });
  $(".select2_bentuk_pendi").select2({
    placeholder: "Pilih bentuk perguruan tinggi",
    minimumResultsForSearch:-1,
    allowClear: true
  });
  $(".select2_status_milik").select2({
    placeholder: "Pilih status kepemilikan",
    minimumResultsForSearch:-1,
    allowClear: true
  });
  $(".select2_sertifikat_iso").select2({
    placeholder: "Pilih status sertifikasi ISO",
    minimumResultsForSearch:-1,
    allowClear: true
  });
  $(".select2_kategori").select2({
    placeholder: "Pilih kategori perguruan tinggi",
    minimumResultsForSearch:-1,
    allowClear: true
  });
  /*END -- Select2 Plugin*/

  /*OnClick Event*/
  $('#form-identitas-pt, .form-identitas-pt').on('click', function(eve){
    eve.preventDefault();
    modal_animated('zoomIn');
    var btn_this = $(this);
    btn_this.css('pointer-events','none');
    var btn_act = btn_this.find('i');
    btn_act.removeClass('fa-pencil-square').addClass('fa-circle-o-notch fa-spin');
    var results = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/action/ambil',{data:'data_identitas_pt'},1000,true);
    results.then(function(results){
      $('#myModal #batal').html('<li class="fa fa-times"></li> Batal');
      $('#myModal #form-input').show();
      if (results.status == 'empty') {
        $('#myModal .modal-title').text('Input Data Identitas Perguruan Tinggi');
        $('#myModal #form-input').attr('action','tambah');
        $('#myModal').removeClass('modal-danger modal-success').addClass('modal-info');
        $('#myModal #submit').html('<li class="fa fa-save"></li> Simpan').show();
        $('#myModal .nav-tabs-custom').removeClass('nav-success nav-danger nav-warning').addClass('nav-info');
      }
      else{
        $('#myModal .modal-title').text('Update Data Identitas Perguruan Tinggi');
        $('#myModal #form-input').attr('action','update');
        $('#myModal').removeClass('modal-danger modal-info').addClass('modal-success');
        $('#myModal #submit').html('<li class="fa fa-pencil-square"></li> Update').show();
        $('#myModal .nav-tabs-custom').removeClass('nav-danger nav-info nav-warning').addClass('nav-success');
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
      btn_this.css('pointer-events','');
      btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
      $('#myModal').modal('show').find('.modal-dialog').addClass('modal-lg');
    }).catch(function(error){
      btn_act.removeClass('fa-circle-o-notch fa-spin').addClass('fa-times');
      setTimeout(function(){
        btn_this.css('pointer-events','');
        btn_act.removeClass('fa-times fa-circle-o-notch fa-spin').addClass('fa-pencil-square');
      },1000);
    });
  });
  /*END -- OnClick Event*/

});