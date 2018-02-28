$(function(){

  /*Onclick Event*/
  $('a[href="#statik-fk"]').on('click', function(){
    data_master_chart('','static_mhs_fk');
  });
  /*END -- Onclick Event*/

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
    var data_static = getJSON_async('http://'+host+controller_path+'/data_statistik',{data:data},500,true);
    data_static.then(function(data_static){
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
      $('a[href="#statik-fk"], .static-mhs-tab').find('span, i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-bar-chart');
      $('#statik-fk .load-row, .static-tab .load-row').remove();
    });
  }
  /*END -- Function: Chart data master*/
  /*END -- Function*/

});