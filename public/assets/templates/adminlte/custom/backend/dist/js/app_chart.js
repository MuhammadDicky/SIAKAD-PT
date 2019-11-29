var path = window.location.pathname;
var host = window.location.hostname + (window.location.port !== '' ? ':' + window.location.port : '');
var protocol = window.location.protocol;

$(document).ready(function(){

  $('.detail-jml-mhs').slimScroll({
    position: 'right',
    height: '385px',
    allowPageScroll:true
  });

	moment.locale('id');

	/*ChartJS*/
  Pace.once('done', function(){
    setTimeout(function(){
      /*Data Mahasiswa*/
      $('.grafik-mhs').find('div.overlay').fadeIn();
      var detail_mhs = getJSON_async(protocol + '//'+host+path+'/dashboard/data_statistik/pd',null,1);
      detail_mhs.then(function(detail_mhs){
        $('.grafik-mhs').find('div.overlay').fadeOut();
        data_chart_mhs_pd(detail_mhs,detail_mhs.canvas);
      }).catch(function(error){
        collapse_toggle('.grafik-mhs');
        $('.grafik-mhs').find('div.overlay').fadeOut();
      });
      /*END -- Data Mahasiswa*/

      /*Data Pengguna*/
      $('.box-grafik-pengguna').find('div.overlay').fadeIn();
      var detail_pengguna = getJSON_async(protocol + '//'+host+path+'/dashboard/data_statistik/pengguna');
      detail_pengguna.then(function(detail_pengguna){
        $('.box-grafik-pengguna').find('div.overlay').fadeOut();
        data_chart_pengguna(detail_pengguna,detail_pengguna.count_user_mhs,detail_pengguna.count_user_ptk,detail_pengguna.count_user_aktif,detail_pengguna.count_user_nonaktif,false);
      }).catch(function(error){
        collapse_toggle('.box-grafik-pengguna');
        $('.box-grafik-pengguna').find('div.overlay').fadeOut();
      });
      /*END -- Data Pengguna*/

      /*Data PTK*/
      var detail_ptk = getJSON_async(protocol + '//'+host+path+'/dashboard/data_statistik/ptk');
      detail_ptk.then(function(detail_ptk){
        data_chart_ptk(detail_ptk,detail_ptk.canvas);
      }).catch(function(error){
        collapse_toggle('.grafik-ptk');
      });
      /*END -- Data PTK*/
    },200);
  });

  $('#refresh-statik-pengguna').on('click', function(eve){
    eve.preventDefault();
    var btn_act = $(this).find('i');
    btn_act.addClass('fa-spin');
    setTimeout(function(){
      btn_act.removeClass('fa-spin');
    },1070);
    $('.box-grafik-pengguna').find('div.overlay').fadeIn();
    collapse_box('.box-grafik-pengguna, .grafik-data-pengguna, .grafik-status-pengguna');
    var detail_pengguna = getJSON_async(protocol + '//'+host+path+'/dashboard/data_statistik/pengguna',null,null,true);
    detail_pengguna.then(function(detail_pengguna){
      $('.box-grafik-pengguna').find('div.overlay').fadeOut();
      data_chart_pengguna(detail_pengguna,detail_pengguna.count_user_mhs,detail_pengguna.count_user_ptk,detail_pengguna.count_user_aktif,detail_pengguna.count_user_nonaktif,true);
    }).catch(function(error){
      $('.box-grafik-pengguna').find('div.overlay').fadeOut();
    });
  });

  $('#refresh-statik-mhs').on('click', function(){
    var btn_act = $(this).find('i');
    btn_act.addClass('fa-spin');
    setTimeout(function(){
      btn_act.removeClass('fa-spin');
    },1070);
    $('.grafik-mhs').find('div.overlay').fadeIn();
    collapse_box('.grafik-mhs, .grafik-mhs .box');
    var detail_mhs = getJSON_async(protocol + '//'+host+path+'/dashboard/data_statistik/pd',null,null,true);
    detail_mhs.then(function(detail_mhs){
      $('.detail-jml-mhs .progress-bar').css('width','0%');
      $('.detail-jml-mhs .progress-number').text('0%');
      $('.grafik-mhs').find('div.overlay').fadeOut();
      setTimeout(function(){
        data_chart_mhs_pd(detail_mhs,detail_mhs.canvas,true);
      },500);
    }).catch(function(error){
      $('.grafik-mhs').find('div.overlay').fadeOut();
    });
  });

  $('#refresh-statik-ptk').on('click', function(){
    var btn_act = $(this).find('i');
    btn_act.addClass('fa-spin');
    setTimeout(function(){
      btn_act.removeClass('fa-spin');
    },1070);
    collapse_box('.grafik-ptk');
    var detail_ptk = getJSON_async(protocol + '//'+host+path+'/dashboard/data_statistik/ptk',null,null,true);
    detail_ptk.then(function(detail_ptk){
      data_chart_ptk(detail_ptk,detail_ptk.canvas,true);
    }).catch(function(error){});
  });

});

function data_chart_pengguna(detail_pengguna,count_pengguna_mhs,count_pengguna_ptk,count_pengguna_aktif,count_pengguna_nonaktif,update){
  if (update == true) {
    $('.grafik-data-pengguna .progress-pengguna-siswa').css('width','0%');
    $('.grafik-data-pengguna .progress-pengguna-guru').css('width','0%');
    $('.grafik-status-pengguna .progress-pengguna-aktif').css('width','0%');
    $('.grafik-status-pengguna .progress-pengguna-nonaktif').css('width','0%');
    $('#pieChart-data-pengguna').replaceWith('<canvas id="pieChart-data-pengguna" height="140"></canvas>');
    $('#pieChart-data-pengguna-status').replaceWith('<canvas id="pieChart-data-pengguna-status" height="140"></canvas>');
  }

  if (detail_pengguna.status == 'success') {
    $('.box-grafik-pengguna .data-container').show();
    $('.box-grafik-pengguna .data-empty-container').text('').hide();
    if (update == true) {
      delay(function(){
        $('.grafik-data-pengguna .progress-pengguna-siswa').css('width',detail_pengguna.statik_pengguna_mhs+'%');
        $('.grafik-data-pengguna .progress-pengguna-guru').css('width',detail_pengguna.statik_pengguna_ptk+'%');
        $('.grafik-status-pengguna .progress-pengguna-aktif').css('width',detail_pengguna.statik_pengguna_aktif+'%');
        $('.grafik-status-pengguna .progress-pengguna-nonaktif').css('width',detail_pengguna.statik_pengguna_nonaktif+'%');
      },850);
    }
    else{
      $('.grafik-data-pengguna .progress-pengguna-siswa').css('width',detail_pengguna.statik_pengguna_mhs+'%');
      $('.grafik-data-pengguna .progress-pengguna-guru').css('width',detail_pengguna.statik_pengguna_ptk+'%');
      $('.grafik-status-pengguna .progress-pengguna-aktif').css('width',detail_pengguna.statik_pengguna_aktif+'%');
      $('.grafik-status-pengguna .progress-pengguna-nonaktif').css('width',detail_pengguna.statik_pengguna_nonaktif+'%');
    }
    $('table.tbl-user-last-online').find('tbody').text('');
    $.each(detail_pengguna.record_last_online, function(index,record){
      if (record.level_akses == 'mhs') {
        var level_akses = 'Mahasiswa';
      }
      else{
        var level_akses = 'Tenaga Pendidik';
      }
      $('table.tbl-user-last-online').find('tbody').append(
              '<tr>'
              +   '<td>'+record.username+'</td>'
              +   '<td class="text-center">'+level_akses+'</td>'
              +   '<td class="text-center"><i class="fa fa-clock-o"></i> '+moment(record.last_online).fromNow()+'</td>'
              +   '<td class="text-center"><a href="#detail?id_user='+record.id_user_detail+'-'+record.level_akses+'&level='+level_akses.replace(' ','_').toLowerCase()+'" class="btn btn-warning btn-sm" style="width:80%"><i class="fa fa-id-card"></i> Detail Pengguna</a></td>'
              +'</tr>'              
        );
    });

    /*Created Chart*/
      /*Chart Pengguna*/
        var pieChartCanvas = $("#pieChart-data-pengguna").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [      
          {
            value: count_pengguna_mhs,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "Pengguna Mahasiswa"
          },
          {
            value: count_pengguna_ptk,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Pengguna Tenaga Pendidik"
          }      
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 40, // This is 0 for Pie charts
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
        pieChart.Doughnut(PieData, pieOptions);
      /*END -- Chart Pengguna*/

      /*Chart Status Pengguna*/
        var pieChartCanvas = $("#pieChart-data-pengguna-status").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [      
          {
            value: count_pengguna_aktif,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "Pengguna Aktif"
          },
          {
            value: count_pengguna_nonaktif,
            color: "#dd4b39",
            highlight: "#dd4b39",
            label: "Pengguna Nonaktif"
          }      
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 40, // This is 0 for Pie charts
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
        pieChart.Doughnut(PieData, pieOptions);
      /*END -- Chart Status Pengguna*/
    /*END -- Created Chart*/
  }
  else{
    /*if (update == true) {
      delay(function(){
        $('.box-grafik-pengguna .fa-refresh').removeClass('fa-spin');
      },850);
    }*/
    $('.box-grafik-pengguna .data-container').hide();
    $('.box-grafik-pengguna .data-empty-container').html('<p class="text-center">Untuk saat ini sistem belum memiliki data pengguna</p>').show();
  }
}

function data_chart_mhs_pd(detail_mhs,data,update){
  var delay_time = 100;
  if (update == true) {
    $('#pieChart-data-mhs').replaceWith('<canvas id="pieChart-data-mhs" height="250"></canvas>');
    $('#barchart-mhs-pd').replaceWith('<canvas id="barchart-mhs-pd" style="height: 330px; width: 510px;"></canvas>');
    $('#barchart-mhs-thn').replaceWith('<canvas id="barchart-mhs-thn" height="137"></canvas>');
    delay_time = 850;
  }

  if (detail_mhs.status == 'success') {
    $('.grafik-mhs .data-container, .grafik-mhs .box-footer').show();
    $('.grafik-mhs .data-empty-container').text('').hide();
    if (detail_mhs.pd.length > 4) {
      $('.grafik-mhs .daftar-pd').slimScroll({
        position: 'right',
        height: '163px',
        allowPageScroll:true
      });
    }
    else{
      $('.grafik-mhs .daftar-pd').slimScroll({
        position: 'right',
        height: '',
        allowPageScroll:true
      });
    }
    $('.grafik-mhs ul.daftar-pd, .grafik-mhs ul.daftar-thn, .detail-jml-mhs').text('');
    $('.detail-jml-mhs').prepend('<p class="text-center"><strong>Keterangan</strong></p>');
    line_chart_mhs_pd(detail_mhs.nama_prodi,detail_mhs.mhs_lk,detail_mhs.mhs_pr,detail_mhs.color);
    line_chart_mhs_thn(detail_mhs.thn_angkatan,detail_mhs.mhs_lk_thn,detail_mhs.mhs_pr_thn,detail_mhs.color_thn);
    var no = 1;
    $.each(detail_mhs.pd, function(index,data_record){
      $('.grafik-mhs ul.daftar-pd').append(
        '<li><a>'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')<span class="pull-right badge" style="background-color:'+data_record.color_detail+'">'+data_record.statik_mhs+'%</span></a></li>'
        );
      $('.detail-jml-mhs').append(
        '<div class="progress-group">'
        +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> Prodi '+no+': '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</span>'
        +'  <span class="progress-number">'+data_record.statik_mhs+'%</span>'
        +'  <div class="progress sm">'
        +'    <div class="progress-bar p-bar-'+no+'" style="background-color:'+data_record.color_detail+';"></div>'
        +'  </div>'
        +'</div>'
      );
      no++;
      /*$('.detail-jml-mhs').append(
        '<div class="description-block margin-bottom">'
        +'  <h5 class="description-header">'+data_record.no_prodi+'</h5>'
        +'  <h5 class="description-header">'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</h5>'
        +'  <span class="description-text"> <li class="fa fa-users"></li> '+data_record.count_mhs+' / '+data_record.statik_mhs+'%</span>'
        +'</div>'
        );*/
    });
    no = 1;
    delay(function(){
      $.each(detail_mhs.pd, function(index,data_record){
        $('.p-bar-'+no).css('width',data_record.statik_mhs+'%');
        no++;
      });
    },delay_time);
    $.each(detail_mhs.thn, function(index,data_record){
      $('.grafik-mhs ul.daftar-thn').append(
        '<li><a>Tahun Angkatan '+data_record.tahun_angkatan+'<span class="pull-right badge" style="background-color:'+data_record.color_detail+'">'+data_record.statik_mhs+'%</span></a></li>'
        );
    });

    /*Chart Statistik Mahasiswa*/
      var pieChartCanvas = $("#pieChart-data-mhs").get(0).getContext("2d");
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
    /*END -- Chart Statistik Mahasiswa*/
  }
  else{
    /*if (update == true) {
      delay(function(){
        $('.grafik-mhs .fa-refresh').removeClass('fa-spin');
      },delay_time);
    }*/
    $('.grafik-mhs .data-container, .grafik-mhs .box-footer').hide();
    $('.grafik-mhs .data-empty-container').html('<p class="text-center">Untuk saat ini sistem belum memiliki data mahasiswa</p>').show();
  }
}

function line_chart_mhs_pd(pd,lk,pr,color){
  var barChartCanvas = $("#barchart-mhs-pd").get(0).getContext("2d");
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
    /*multiTooltipTemplate: function(lb){
      if (lb.datasetLabel == 'Laki-Laki') {
        return lb.datasetLabel+": "+lb.value+" Orang";
      }
      if (lb.datasetLabel == 'Perempuan') {
        return lb.datasetLabel+": "+lb.value+" Orang";
      }
    },*/
    multiTooltipTemplate: "<%= datasetLabel %>: <%= value %> Orang",
  };
  barChartOptions.datasetFill = false;
  barChart.Bar(areaChartData, barChartOptions);
}

function line_chart_mhs_thn(pd,lk,pr,color){
  var barChartCanvas = $("#barchart-mhs-thn").get(0).getContext("2d");
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

function data_chart_ptk(detail_ptk,data,update){
  if (detail_ptk.status == 'success') {
    $('#pieChart-data-ptk').replaceWith('<canvas id="pieChart-data-ptk" height="180"></canvas>');
    $('.grafik-ptk .data-container, .grafik-ptk .box-footer').show();
    $('.grafik-ptk .data-empty-container').text('').hide();
    if (detail_ptk.pd.length > 10) {
      $('.grafik-ptk ul.daftar-pd').slimScroll({
        position: 'right',
        height: '423px',
        allowPageScroll:true
      });
      /*$('.grafik-ptk ul.daftar-pd').css('height','408px');*/
    }
    else{
      $('.grafik-ptk ul.daftar-pd').slimScroll({
        position: 'right',
        height: '',
        allowPageScroll:true
      });
      /*$('.grafik-ptk ul.daftar-pd').css('height','');*/
    }
    $('.grafik-ptk ul.daftar-pd').text('');
    $.each(detail_ptk.pd, function(index,data_record){
      $('.grafik-ptk ul.daftar-pd').append(
        '<li><a>'+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')<span class="pull-right badge" style="background-color:'+data_record.color_detail+'">'+data_record.statik_ptk+'%</span></a></li>'
        );
    });

    /*Chart PTK*/
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
    /*END -- Chart PTK*/
  }
  else{
    $('.grafik-ptk .data-container, .grafik-ptk .box-footer').hide();
    $('.grafik-ptk .data-empty-container').html('<p class="text-center">Untuk saat ini sistem belum memiliki data tenaga pendidik</p>').show();
  }
}