$(function(){

  /*Select2 Plugin*/
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
  /*END -- Select2 Plugin*/

  /*Datatables Plugin*/
  var table_data_fk = $('.tbl-data-fk').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url" : "http://"+host+controller_path+"/data_table_request/data_fakultas",
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
      "url" : "http://"+host+controller_path+"/data_table_request/data_prodi",
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
  /*END -- Datatables Plugin*/

});