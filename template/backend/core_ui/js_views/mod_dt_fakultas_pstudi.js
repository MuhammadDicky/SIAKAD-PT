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

});