$(document).ready(function(){

  $.onload = true;

  $(window).resize(function(){
    var dt_mhs = $('.detail-jml-mhs');
    var chart_mhs = $('#barchart-mhs-pd');
    dt_mhs.css('height', chart_mhs[0].clientHeight + 'px').parents('div.slimScrollDiv').css('height', chart_mhs[0].clientHeight+ 'px');
  });

  /*slimScroll Plugin*/
  $('#container-detail-user-mhs').slimScroll({
    position: 'right',
    height: '340px',
  });
  $('#container-detail-user-ptk').slimScroll({
    position: 'right',
    height: '290px',
  });
  /*END -- slimScroll Plugin*/

	/*ChartJS*/
  /*Data Mahasiswa*/
  var detail_mhs = getJSON_async('http://'+global_vars.host+global_vars.path+'/dashboard/data_statistik/pd',null,1);
  detail_mhs.then(function(detail_mhs){
    data_chart_mhs_pd(detail_mhs,detail_mhs.canvas);
  }).catch(function(error){
  });
  /*END -- Data Mahasiswa*/

  /*Data Pengguna*/
  var detail_pengguna = getJSON_async('http://'+global_vars.host+global_vars.path+'/dashboard/data_statistik/pengguna');
  detail_pengguna.then(function(detail_pengguna){
    data_chart_pengguna(detail_pengguna,detail_pengguna.count_user_mhs,detail_pengguna.count_user_ptk,detail_pengguna.count_user_aktif,detail_pengguna.count_user_nonaktif,false);
  }).catch(function(error){
  });
  /*END -- Data Pengguna*/

  /*Data PTK*/
  var detail_ptk = getJSON_async('http://'+global_vars.host+global_vars.path+'/dashboard/data_statistik/ptk');
  detail_ptk.then(function(detail_ptk){
    data_chart_ptk(detail_ptk,detail_ptk.canvas);
  }).catch(function(error){
  });
  /*END -- Data PTK*/

  /*HASHCHANGE*/
  start_hashchange(function(hash){
    hashchange_act(hash, function(){
        var urlvars = getUrlVars();
        if (hash.search('detail') == 0) {
            if (urlvars[0] == 'id_user') {
                $('#myModal #rincian-ptk, #myModal #rincian-mhs').hide();
                $('#myModal').modal('show').addClass('modal-warning').find('.modal-dialog').addClass('modal-lg');
                var id = urlvars['id_user'];
                var level = urlvars['level'];
                var data = getJSON_async('http://'+global_vars.host+global_vars.controller_path+'/dashboard/data_statistik/pengguna',{id:id,level:level},500);
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
    })
  });
  /*END -- HASHCHANGE*/

  $('#refresh-statik-pengguna').on('click', function(eve){
    eve.preventDefault();
    var btn = $(this),
    btn_load = btn.css('pointer-events','none'),
    btn_act = btn.find('i');
    btn_act.addClass('fa-spin');
    setTimeout(function(){
      btn_act.removeClass('fa-spin');
    },1070);
    $('.box-grafik-pengguna').find('div.overlay').fadeIn();
    var detail_pengguna = getJSON_async('http://'+global_vars.host+global_vars.path+'/dashboard/data_statistik/pengguna',null,null,true);
    detail_pengguna.then(function(detail_pengguna){
      btn.css('pointer-events','');
      $('.box-grafik-pengguna').find('div.overlay').fadeOut();
      data_chart_pengguna(detail_pengguna,detail_pengguna.count_user_mhs,detail_pengguna.count_user_ptk,detail_pengguna.count_user_aktif,detail_pengguna.count_user_nonaktif,true);
    }).catch(function(error){
      btn.css('pointer-events','');
      $('.box-grafik-pengguna').find('div.overlay').fadeOut();
    });
  });

  $('#refresh-statik-mhs').on('click', function(){
    var btn = $(this),
    btn_load = btn.css('pointer-events','none'),
    btn_act = btn.find('i');
    btn_act.addClass('fa-spin');
    setTimeout(function(){
      btn_act.removeClass('fa-spin');
    },1070);
    $('.grafik-mhs').find('div.overlay').fadeIn();
    var detail_mhs = getJSON_async('http://'+global_vars.host+global_vars.path+'/dashboard/data_statistik/pd',null,null,true);
    detail_mhs.then(function(detail_mhs){
      $('.detail-jml-mhs .progress-bar').css('width','0%');
      $('.detail-jml-mhs .progress-number').text('0%');
      $('.grafik-mhs').find('div.overlay').fadeOut();
      setTimeout(function(){
        btn.css('pointer-events','');
        data_chart_mhs_pd(detail_mhs,detail_mhs.canvas,true);
      },500);
    }).catch(function(error){
      btn.css('pointer-events','');
      $('.grafik-mhs').find('div.overlay').fadeOut();
    });
  });

  $('#refresh-statik-ptk').on('click', function(){
    var btn = $(this),
    btn_load = btn.css('pointer-events','none'),
    btn_act = btn.find('i');
    btn_act.addClass('fa-spin');
    setTimeout(function(){
      btn_act.removeClass('fa-spin');
    },1070);
    var detail_ptk = getJSON_async('http://'+global_vars.host+global_vars.path+'/dashboard/data_statistik/ptk',null,null,true);
    detail_ptk.then(function(detail_ptk){
      btn.css('pointer-events','');
      data_chart_ptk(detail_ptk,detail_ptk.canvas,true);
    }).catch(function(error){
      btn.css('pointer-events','');
    });
  });

  function data_chart_pengguna(detail_pengguna,count_pengguna_mhs,count_pengguna_ptk,count_pengguna_aktif,count_pengguna_nonaktif,update){
    if (update == true) {
      $('.grafik-data-pengguna .progress-pengguna-siswa').css('width','0%');
      $('.grafik-data-pengguna .progress-pengguna-guru').css('width','0%');
      $('.grafik-status-pengguna .progress-pengguna-aktif').css('width','0%');
      $('.grafik-status-pengguna .progress-pengguna-nonaktif').css('width','0%');
      $('#pieChart-data-pengguna').replaceWith('<canvas id="pieChart-data-pengguna"></canvas>');
      $('#pieChart-data-pengguna-status').replaceWith('<canvas id="pieChart-data-pengguna-status"></canvas>');
    }

    if (detail_pengguna.status == 'success') {
      $('.box-grafik-pengguna .data-container').show();
      $('.box-grafik-pengguna .data-empty-container').text('').hide();
      if (update == true) {
        delay(function(){
          $('.grafik-data-pengguna .progress-pengguna-siswa').css('width',detail_pengguna.statik_pengguna_mhs+'%');
          $('.grafik-data-pengguna .progress-mhs-u').find('span.value').text(detail_pengguna.statik_pengguna_mhs+'%');
          $('.grafik-data-pengguna .progress-pengguna-guru').css('width',detail_pengguna.statik_pengguna_ptk+'%');
          $('.grafik-data-pengguna .progress-ptk-u').find('span.value').text(detail_pengguna.statik_pengguna_ptk+'%');
          $('.grafik-status-pengguna .progress-pengguna-aktif').css('width',detail_pengguna.statik_pengguna_aktif+'%');
          $('.grafik-status-pengguna .progress-pengguna-nonaktif').css('width',detail_pengguna.statik_pengguna_nonaktif+'%');
        },850);
      }
      else{
        $('.grafik-data-pengguna .progress-pengguna-siswa').css('width',detail_pengguna.statik_pengguna_mhs+'%');
        $('.grafik-data-pengguna .progress-mhs-u').find('span.value').text(detail_pengguna.statik_pengguna_mhs+'%');
        $('.grafik-data-pengguna .progress-pengguna-guru').css('width',detail_pengguna.statik_pengguna_ptk+'%');
        $('.grafik-data-pengguna .progress-ptk-u').find('span.value').text(detail_pengguna.statik_pengguna_ptk+'%');
        $('.grafik-status-pengguna .progress-pengguna-aktif').css('width',detail_pengguna.statik_pengguna_aktif+'%');
        $('.grafik-status-pengguna .progress-aktif-u').find('span.value').text(detail_pengguna.statik_pengguna_aktif+'%');
        $('.grafik-status-pengguna .progress-pengguna-nonaktif').css('width',detail_pengguna.statik_pengguna_nonaktif+'%');
        $('.grafik-status-pengguna .progress-non-u').find('span.value').text(detail_pengguna.statik_pengguna_nonaktif+'%');
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
                +   '<td class="text-center"><a href="#detail?id_user='+record.id_user_detail+'-'+record.level_akses+'&level='+level_akses.replace(' ','_').toLowerCase()+'" class="btn btn-warning text-white" title="Lihat detail pengguna dengan username '+record.username+'" style="width:50px"><i class="fa fa-id-card"></i></a></td>'
                +'</tr>'
          );
      });

      /*Created Chart*/
        var chart_tooltips = {
                  enabled: false,
                  position: 'average',
                  mode: 'index',
                  intersect: false,
                  custom: function(tooltip){
                    var tooltipEl = document.getElementById('chartjs-tooltip-' + this._chart.canvas.id);
                    
                    if (!tooltipEl) {
                      tooltipEl = document.createElement('div');
                      tooltipEl.id = 'chartjs-tooltip-' + this._chart.canvas.id;
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
                        var style = 'background:' + colors.backgroundColor;
                        style += '; border-color:' + colors.borderColor;
                        style += '; border-width: 2px'; 
                        var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
                        innerHtml += '<tr><td>' + span + body + ' Orang</td></tr>';
                      });
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
                };
          /*Chart Pengguna*/
          var ctx = $("#pieChart-data-pengguna").get(0).getContext("2d");
          var chart = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: ['Mahasiswa', 'Tenaga Pendidik'],
                  datasets: [{
                      backgroundColor: ['#f39c12', '#00c0ef'],
                      data: [count_pengguna_mhs, count_pengguna_ptk]
                  }],

              },
              options: {
                responsive: true,
                legend: {
                  display: false
                },
                tooltips: chart_tooltips,
                animation: {
                  onComplete: function(e){
                    var dt_penguna = $('.chart-container-pie-pengguna');
                    dt_penguna.css('height', (e.chart.height + 18) + 'px');
                  }
                }
              }
          });
        /*END -- Chart Pengguna*/

        /*Chart Status Pengguna*/
          var ctx = $("#pieChart-data-pengguna-status").get(0).getContext("2d");
          var chart = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: ['Pengguna Aktif', 'Pengguna Nonaktif'],
                  datasets: [{
                      backgroundColor: ['#00a65a', '#dd4b39'],
                      data: [count_pengguna_aktif, count_pengguna_nonaktif]
                  }],

              },
              options: {
                responsive: true,
                legend: {
                  display: false
                },
                tooltips: chart_tooltips,
                animation: {
                  onComplete: function(e){
                    /*console.log(e);*/
                    var dt_penguna = $('.chart-container-pie-status-pengguna');
                    dt_penguna.css('height', (e.chart.height + 18) + 'px');
                  }
                }
              }
          });
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
      $('#pieChart-data-mhs').replaceWith('<canvas id="pieChart-data-mhs"></canvas>');
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
          height: '195px',
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
      line_chart_mhs_pd(detail_mhs.nama_prodi, detail_mhs.mhs_lk, detail_mhs.mhs_pr, detail_mhs.color, data);
      line_chart_mhs_thn(detail_mhs.thn_angkatan, detail_mhs.mhs_lk_thn, detail_mhs.mhs_pr_thn, detail_mhs.color_thn);
      $('.grafik-mhs ul.daftar-pd, .grafik-mhs ul.daftar-thn, .detail-jml-mhs').text('');
      $('.detail-jml-mhs').prepend('<p class="text-center"><strong>Keterangan</strong></p>');
      var no = 1;
      $.each(detail_mhs.pd, function(index,data_record){
        $('.grafik-mhs ul.daftar-pd').append(
          '<li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">'
          +'  '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')'
          +'  <span class="badge badge-pill text-white" style="background-color:'+data_record.color_detail+'">'+data_record.statik_mhs+'%</span>'
          +'</li>'
          );
        $('.detail-jml-mhs').append(
          '<div class="progress-group" style="margin-top:10px">'
          +'  <span class="progress-text"><i class="fa fa-circle" style="color: '+data_record.color_detail+';"></i> Prodi '+no+': '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')</span>'
          +'  <span class="progress-number pull-right">'+data_record.statik_mhs+'%</span>'
          +'  <div class="progress progress-sm">'
          +'    <div class="progress-bar p-bar-'+no+'" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="background-color:'+data_record.color_detail+';width: 0px"></div>'
          +'  </div>'
          +'</div>'
        );
        no++;
      });
      no = 1;
      setTimeout(function(){
        $.each(detail_mhs.pd, function(index,data_record){
          $('.p-bar-'+no).css('width',data_record.statik_mhs+'%').attr('aria-valuenow',data_record.statik_mhs);
          no++;
        });
      },delay_time);
      $.each(detail_mhs.thn, function(index,data_record){
        $('.grafik-mhs ul.daftar-thn').append(
          '<li>'
          +'  <span class="title">Tahun Angkatan '+data_record.tahun_angkatan+'</span>'
          +'  <span class="value">'+data_record.statik_mhs+'%</span>'
          +'  <div class="bars">'
          +'    <div class="progress progress-xs">'
          +'      <div class="progress-bar" role="progressbar" style="width: '+data_record.statik_mhs+'%; background-color: '+data_record.color_detail+'" aria-valuenow="'+data_record.statik_mhs+'" aria-valuemin="0" aria-valuemax="100"></div>'
          +'    </div>'
          +'  </div>'
          +'</li>'
          /*'<li><a>Tahun Angkatan '+data_record.tahun_angkatan+'<span class="pull-right badge" style="background-color:'+data_record.color_detail+'">'+data_record.statik_mhs+'%</span></a></li>'*/
          );
      });

      /*Chart Statistik Mahasiswa*/
        var ctx = document.getElementById('pieChart-data-mhs').getContext('2d'),
        color_opc = Chart.helpers.color,
        new_data = [],
        label = [];
        $.each(data, function(index,data_record){
          new_data.push(data_record.value);
          label.push(data_record.label);
        });
        var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: label,
                    datasets: [{
                        backgroundColor: detail_mhs.color,
                        data: new_data
                    }],

                },
                options: {
                  responsive: true,
                  legend: {
                    display: false
                  },
                  tooltips: {
                    enabled: false,
                    position: 'average',
                    mode: 'index',
                    intersect: false,
                    custom: function(tooltip){
                      var tooltipEl = document.getElementById('chartjs-tooltip-mhs-pie');
                      
                      if (!tooltipEl) {
                        tooltipEl = document.createElement('div');
                        tooltipEl.id = 'chartjs-tooltip-mhs-pie';
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
                          var style = 'background:' + colors.backgroundColor;
                          style += '; border-color:' + colors.borderColor;
                          style += '; border-width: 2px'; 
                          var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
                          innerHtml += '<tr><td>' + span + body + ' Orang</td></tr>';
                        });
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
                      var dt_mhs = $('.chart-container-pie-mhs');
                      dt_mhs.css('height', (e.chart.height + 33) + 'px');
                    }
                  }
                }
            });
      /*END -- Chart Statistik Mahasiswa*/
    }
    else{
      $('.grafik-mhs .data-container, .grafik-mhs .grafik-mhs-dt').hide();
      $('.grafik-mhs .data-empty-container').html('<p class="text-center">Untuk saat ini sistem belum memiliki data mahasiswa</p>').show();
    }
  }

  function line_chart_mhs_pd(pd,lk,pr,color,data_canvas){
    var ctx = document.getElementById('barchart-mhs-pd').getContext('2d'),
    color_opc = Chart.helpers.color,
    new_color = [];
    $.each(color, function(index,clr){
      new_color.push(color_opc(clr).alpha(0.5).rgbString());
    });

    var data_chart = {
            labels: pd,
            datasets: [
            {
                label: "Laki-Laki",
                backgroundColor: new_color,
                borderColor: color,
                data: lk,
            },
            {
                label: "Perempuan",
                backgroundColor: new_color,
                borderColor: color,
                data: pr,
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
                tooltip.title = [data_canvas[tooltip.dataPoints[0]['index']]['label']];
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
                var dt_mhs = $('.detail-jml-mhs');
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

    if (pd.length > 10) {
      var dt_mhs = $('.detail-jml-mhs');
      dt_mhs.slimScroll({
        position: 'right',
        height: '430px',
        allowPageScroll:true
      });
    }
  }

  function line_chart_mhs_thn(pd,lk,pr,color){
    var ctx = document.getElementById('barchart-mhs-thn').getContext('2d'),
    color_opc = Chart.helpers.color,
    new_color = [];
    $.each(color, function(index,clr){
      new_color.push(color_opc(clr).alpha(0.5).rgbString());
    });

    var data_chart = {
            labels: pd,
            datasets: [
            {
                label: "Laki-Laki",
                backgroundColor: new_color,
                borderColor: color,
                data: lk,
            },
            {
                label: "Perempuan",
                backgroundColor: new_color,
                borderColor: color,
                data: pr,
            }
            ],

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

              // Tooltip Element
              var tooltipEl = document.getElementById('chartjs-tooltip-mhs-thn');

              if (!tooltipEl) {
                tooltipEl = document.createElement('div');
                tooltipEl.id = 'chartjs-tooltip-mhs-thn';
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
          }
        };

    var chart = new Chart(ctx, {
        type: 'bar',
        data: data_chart,
        options: option_chart
    });
  }

  function data_chart_ptk(detail_ptk,data,update){
    if (detail_ptk.status == 'success') {
      $('#pieChart-data-ptk').replaceWith('<canvas id="pieChart-data-ptk" height="180"></canvas>');
      $('.grafik-ptk .data-container, .grafik-ptk .box-footer').show();
      $('.grafik-ptk .data-empty-container').text('').hide();
      if (detail_ptk.pd.length > 10) {
        $('.grafik-ptk ul.daftar-pd').slimScroll({
          position: 'right',
          height: '595px',
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
          '<li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">'
          +'  '+data_record.nama_prodi+' ('+data_record.jenjang_prodi+')'
          +'  <span class="badge badge-pill text-white" style="background-color:'+data_record.color_detail+'">'+data_record.statik_ptk+'%</span>'
          +'</li>'
          );
      });

      /*Chart PTK*/
      	var ctx = $("#pieChart-data-ptk").get(0).getContext("2d"),
        new_data = [],
        label = [],
        color = [];
        $.each(data, function(index,data_record){
          new_data.push(data_record.value);
          label.push(data_record.label);
          color.push(data_record.color);
        });
        var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: label,
                    datasets: [{
                        backgroundColor: color,
                        data: new_data
                    }],

                },
                options: {
                  responsive: true,
                  legend: {
                    display: false
                  },
                  tooltips: {
                    enabled: false,
                    position: 'average',
                    mode: 'index',
                    intersect: false,
                    custom: function(tooltip){
                      var tooltipEl = document.getElementById('chartjs-tooltip-ptk-pie');
                      
                      if (!tooltipEl) {
                        tooltipEl = document.createElement('div');
                        tooltipEl.id = 'chartjs-tooltip-ptk-pie';
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
                          var style = 'background:' + colors.backgroundColor;
                          style += '; border-color:' + colors.borderColor;
                          style += '; border-width: 2px'; 
                          var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
                          innerHtml += '<tr><td>' + span + body + ' Orang</td></tr>';
                        });
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
                      /*var dt_mhs = $('.chart-container-pie-mhs');
                      dt_mhs.css('height', (e.chart.height + 33) + 'px');*/
                    }
                  }
                }
            });
      /*END -- Chart PTK*/
    }
    else{
      $('.grafik-ptk .data-container, .grafik-ptk .box-footer').hide();
      $('.grafik-ptk .data-empty-container').html('<p class="text-center">Untuk saat ini sistem belum memiliki data tenaga pendidik</p>').show();
    }
  }

});
