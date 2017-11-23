 //rezki

  //rezki
//Tabel Libur
function fetchTabelLibur(){
  $.ajax({
    type: "POST",
    url: "pages/fetchdata/fetch_data_libur.php",
    success: function (data) {
      $('#tabel_libur').html(data);
      
      $('#data_libur').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        "order": [[ 2, "desc" ]],
        dom: 'Bfrtip',
        buttons: [
          { extend: 'Add', editor: editor },
          { extend: 'Edit', editor: editor },
          { extend: 'Delete', editor: editor }
      ]
      });   
    }
  });
}
//End Tabel Libur
  //Non-Jquery Function
  function initMap(lat1,lng1) {
    var waktu = $('#waktuDetailAbsen').text();
    var nama = $('#namaDetailAbsen').text();
    var status = $('#statusDetailAbsen').text();
    //var myLatLng = {lat: lat1,lng: lng1};
    console.log("Inisiasi Map");
    var myLatLng = new google.maps.LatLng(lat1,lng1);
    var map = new google.maps.Map(document.getElementById('peta'), {
      zoom: 18,
      center: myLatLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    console.log("Buat marker");
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'Lokasi '+nama+' pada '+waktu+' saat '+status
    });
    //Resize Function
    
    google.maps.event.addDomListener(window, "resize", function() {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });
      console.log("Responsive Center");
  }
  //Proses Pembuatan Map end
  //Ganti Warna Select Status Absen
  function gantiWarnaStatusAbsenSelect(value){
    switch (value) {
      case 1:
        $("#status_id_adminEdit").attr("class","form-control btn-info");
        $("#keterangan_absen").prop('disabled', true);
        $("#insert").attr("class","btn btn-info");
        $("#keterangan_absen").val("");
        break;
      case 2:
        $("#status_id_adminEdit").attr("class","form-control btn-primary");
        $("#insert").attr("class","btn btn-primary");
        $("#keterangan_absen").prop('disabled', false);
      break;
      case 3:
        $("#status_id_adminEdit").attr("class","form-control btn-danger");
        $("#keterangan_absen").prop('disabled', false);
        $("#insert").attr("class","btn btn-danger");
      break;
      case 4:
        $("#status_id_adminEdit").attr("class","form-control btn-warning");
        $("#keterangan_absen").prop('disabled', false);
        $("#insert").attr("class","btn btn-warning");
      break;
      case 5:
        $("#status_id_adminEdit").attr("class","form-control btn-success");
        $("#keterangan_absen").prop('disabled', false);
        $("#insert").attr("class","btn btn-success");
      break;
      case 6:
        $("#status_id_adminEdit").attr("class","form-control btn-default");
        $("#keterangan_absen").prop('disabled', false);
        $("#insert").attr("class","btn btn-default");
      break;
    }
  }
  $("#status_id_adminEdit").change(function(){
    var value = parseInt($(this).val());
    gantiWarnaStatusAbsenSelect(value);
});
//End Fungsi Data Absen Admin 

//Fungsi Form Submit Absensi
      //Proses Ambil Latitude & Longitude
var y = document.getElementById("nonsupport");
function getUserLocation() {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(getPosition,showError);
  } else {
    y.innerHTML = "Geolocation is not supported by this browser.";
        alert("Browser ini tidak mensupport Geolocation.");
    }
}
      var latitude = document.getElementById("latitude");
      var longitude = document.getElementById("longitude");
      function getPosition(position) {
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          $('#latitude').val(lat);
          $('#longitude').val(lng);
          $.ajax({
              url: 'pages/fetchdata/fetch_data-alamat.php',
              type: 'post',
              data: {
                  latitude: lat,
                  longitude: lng
              },
              success: function (data) {
                  $('#address_hadirdiluar').val(data);
                  $('#address_sakit').val(data);
                  $('#address_izin').val(data);
                  $('#address_cuti').val(data)
              },
              error: function (data) {
                  console.log(data);
              }
          });
          $('#toggleIzinkanLokasi').attr("disabled","disabled");
          $('#submit_hadir_form').removeAttr("disabled");
          $('#submit_hadirdiluar_form').removeAttr("disabled");
          $('#submit_sakit_form').removeAttr("disabled");
          $('#submit_izin_form').removeAttr("disabled");
          $('#submit_cuti_form').removeAttr("disabled");
      }
      function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                $('#toggleIzinkanLokasi').prop('checked', false);;
                alert("Anda menolak permintaan lokasi");
                break;
            case error.POSITION_UNAVAILABLE:
                $('#toggleIzinkanLokasi').prop('checked', false);;
                alert("Informasi Lokasi Tidak Tersedia");
                break;
            case error.TIMEOUT:
                $('#toggleIzinkanLokasi').prop('checked', false);;
                alert("Terjadi Request Timeout");
                break;
            case error.UNKNOWN_ERROR:
                $('#toggleIzinkanLokasi').prop('checked', false);;
                alert("An unknown error occurred.");
                break;
        }
    }

  //Fungsi loadChart Kakatu untuk Load semua chart di home.php
  function loadChartKakatu(){
    // DONUT CHART PEMBAYARAN

    function configChartJumlahOperasional(dataJumlahOperasional){
      var donut = new Morris.Donut({
        element: 'sales-chart',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a","#DAA520","#ADEAEA","#3D1D49"],
        data: dataJumlahOperasional,
        hideHover: 'auto'
      });
    }
    function ajaxConfigChartJumlahOperasional(){
      $.ajax({
        type: "post",
        url: "pages/fetchdata/fetch_chart-jumlah-operasional.php",
        dataType: "json",
        success: function (data) {
          configChartJumlahOperasional(data);
        }
      });
    }
    
    // END DONUT CHART PEMBAYARAN
    
    // PIE CHART ABSENSI HARI INI
    function chartConfigAbsen(dataAbsen,truefalse){
      var canvas = document.getElementById("chart_absensi-hari-ini");
      var ctx = canvas.getContext("2d");
      var midX = canvas.width/2;
      var midY = canvas.height/2;
      var pieChart       = new Chart(ctx)
      //console.log(dataAbsen);
      var PieData        = dataAbsen;
      var pieOptions     = {
        showTooltips: true,
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke    : true,
        //String - The colour of each segment stroke
        segmentStrokeColor   : '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth   : 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps       : 100,
        //String - Animation easing effect
        animationEasing      : 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate        : truefalse,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale         : truefalse,
        //Boolean - whether to make the chart responsive to window resizing
        responsive           : true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio  : true
        //onAnimationProgress  : drawSegmentValues
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var myPieChart=pieChart.Pie(PieData, pieOptions);
      var radius = myPieChart.outerRadius;
      function drawSegmentValues()
        {
            for(var i=0; i<myPieChart.segments.length; i++) 
            {
                ctx.fillStyle="white";
                var textSize = canvas.width/20;
                ctx.font= textSize+"px Verdana";
                // Get needed variables
                var value = myPieChart.segments[i].value;
                var startAngle = myPieChart.segments[i].startAngle;
                var endAngle = myPieChart.segments[i].endAngle;
                var middleAngle = startAngle + ((endAngle - startAngle)/2);

                // Compute text location
          //Untuk Donat
                //var posX = ((radius/2)+(radius/4)) * Math.cos(middleAngle) + midX;
                //var posY = ((radius/2)+(radius/4)) * Math.sin(middleAngle) + midY;
          var posX = (radius/2) * Math.cos(middleAngle) + midX;
                var posY = (radius/2) * Math.sin(middleAngle) + midY;
                //console.log(radius);
                // Text offside by middle
                var w_offset = ctx.measureText(value).width/2;
                var h_offset = textSize/4;

                ctx.fillText(value, posX - w_offset, posY + h_offset);
            }
        }
    }
    function ajaxchartConfigAbsen(truefalse2){
        $.ajax({  
          url:"ajax-fetchdata/chart-absensi-hari-ini",  
          method:"POST",   
          dataType:"json",  
          success:function(data){
            //Fungsi untuk buat chart Donut Chart.js
            chartConfigAbsen(data,truefalse2);
            // .hide() Semua legend pada Donut Chart.js sebelum dimunculkan lagi
            $('#listHadir').hide();
            $('#listHadirDiluar').hide();
            $('#listSakit').hide();
            $('#listIzin').hide();
            $('#listCuti').hide();
            $('#listAlpha').hide();
            var status;
            var index=0;
            //Proses penghitungan data absen di legend donut chart dan .show() legend
            while (index<=(data.length-1)) {
              if(typeof(data[index])!=="undefined"){
                status=data[index].label;
                switch (status) {
                    case "Hadir":
                      $('#listHadir').show();
                      $('#jumhadir').text(data[index].value);
                    break;
                    case "Hadir Diluar":
                      $('#listHadirDiluar').show();
                      $('#jumhadirdiluar').text(data[index].value);
                    break;
                    case "Sakit":
                      $('#listSakit').show();
                      $('#jumsakit').text(data[index].value);
                    break;
                    case "Izin":
                      $('#listIzin').show();
                      $('#jumizin').text(data[index].value);
                    break;
                    case "Cuti":
                      $('#listCuti').show();
                      $('#jumcuti').text(data[index].value);
                    break;
                    case "Alpha":
                      $('#listAlpha').show();
                      $('#jumalpha').text(data[index].value);
                    break;
                }
              }
              index++;
            }
            //setTimeout(function(){ajaxchartConfigAbsen(false);}, 10000);
          }  
        });
      }
      
    // PIE CHART ABSENSI HARI INI
    
    //Line CHART Total Absensi
    function chartConfigTotalAbsen(dataTotalAbsen){
        var bar = new Morris.Bar({
          element: 'absen-chart',
          resize: true,
          axis: false,
          parseTime: false,
          data: dataTotalAbsen,
          xkey: 'Bulan',
          ykeys: ['hadir','sakit','izin','cuti','alpha'],
          yLabelFormat: function (y) { return y.toString() + ' hari'; },
          labels: ['Hadir','Sakit','Izin','Cuti','Alpha'],
          barColors: ['#00c0ef','#f56954','#f39c12','#00a65a','#c0c0c0']   
        });
      }
      function ajaxchartConfigTotalAbsen(){
          $.ajax({  
            url:"pages/fetchdata/fetch_chart-totalabsensi.php",  
            method:"POST",   
            dataType:"json",  
            success:function(data){
              //console.log(data);
              chartConfigTotalAbsen(data);
              //setTimeout(function(){ajaxchartConfigTotalAbsen();}, 30000);
            }  
          });
        }
        
    // END Line CHART Total Absensi
    
    // CHART TOTAL CREDITS
    function configChartCredit(dataCredits){
        var line = new Morris.Line({
        element: 'credit-chart',
        resize: true,
        parseTime: false,
      
        data: dataCredits,
        xkey: 'Bulan',
        ykeys: ['Total'],
        
        yLabelFormat:function (y) {var formatter = new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0,
                                  });
                                  return formatter.format(y.toString()); },
        labels: ['Total'],
        lineColors: ['#3c8dbc'],
        hoverCallback: function (index, options, content) {
                                var formatter = new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0,
                                  });
                                  var uang= options.data[index].Total;
                                  var uang2= formatter.format(uang.toString());
                                  return '<div style="color:#3c8dbc;">' + uang2 + '</div>';
                              }
          
        });
      }
      function ajaxconfigChartCredit(){
        $.ajax({
          type: "post",
          url: "pages/fetchdata/fetch_chart-total-credit.php",
          dataType: "json",
          success: function (data) {
            configChartCredit(data)
          }
        });
      }
    // END CHART TOTAL CREDITS
    
    // CHART TOTAL OPERASIONAL
    function chartTotalOperasinal(dataTotalOperasional){
          var line = new Morris.Line({
              element: 'chart-pembayaran-operasional',
              resize: true,
              parseTime: false,
              data: dataTotalOperasional,
              lineColors: ['#00a65a'],
              xkey: 'Bulan',
              ykeys: ['Total'],
              yLabelFormat:function (y) {var formatter = new Intl.NumberFormat('id-ID', {
                                          style: 'currency',
                                          currency: 'IDR',
                                          minimumFractionDigits: 0,
                                        });
              return formatter.format(y.toString()); },
              labels: ['Total'],
              hoverCallback: function (index, options, content) {
                                      var formatter = new Intl.NumberFormat('id-ID', {
                                          style: 'currency',
                                          currency: 'IDR',
                                          minimumFractionDigits: 0,
                                        });
                                        var uang= options.data[index].Total;
                                        var uang2= formatter.format(uang.toString());
                                        return '<div style="color:#00a65a;">' + uang2 + '</div>';
                                    }
            });
        }
        function ajaxChartTotalOperasinal(){
          $.ajax({
            type: "POST",
            url: "pages/fetchdata/fetch_chart-total-operasional.php",
            dataType: "json",
            success: function (data) {
              //console.log(data);
              chartTotalOperasinal(data);
            }
          });
        }
    // END CHART TOTAL OPERASIONAL

    // Progress BAR ABSENSI HARI INI
      function ajaxProgressAbsenHariIni(){
            $.ajax({
              url:"pages/fetchdata/fetch_progress-bar-hari-ini.php",  
              method:"POST",   
              dataType:"json",  
              success:function(data){
                  var sesi = sessionKakatu();
                //alert(sesi);
                  //$('#absensi_hari_ini').show();
                  if(data.persen!=0){
                    $('#updateAbsensiHariIni').show();
                    ajaxGalleryAbsensiHariIni();
                    ajaxchartConfigAbsen(true);
                    var bulatkanPersen = Math.round(data.persen);
                    if (bulatkanPersen>100) {
                      bulatkanPersen=100;
                    }
                    $('#progres-absen-hari-ini').css({'width':+bulatkanPersen+'%'});
                    $('#progres-absen-hari-ini').attr("class","progress-bar "+data.warna);
                    $('#progres-absen-hari-ini').attr("aria-valuenow",bulatkanPersen);
                    $('#progres-absen-hari-ini').text(bulatkanPersen+"%");
                  } else {
                    $('#updateAbsensiHariIni').hide();
                  }
                //setTimeout(function(){ajaxProgressAbsenHariIni();}, 8000);
              }  
            });
          }
      // END Progress BAR ABSENSI HARI INI
      //Daftar Absensi Hari ini Gallery Absensi
      function ajaxGalleryAbsensiHariIni(){
        $.ajax({
            url:"pages/fetchdata/fetch_data_daftar-absensi.php",  
            method:"post",   
            success:function(data){
                $('#galleryFotoAbsensi').html(data);
                $('#myCarousel').carousel({
                  interval: 4000
                })
            }
        });
      }
      //End Daftar Absensi hari ini
      //Panggil Semua Fungsi
      ajaxProgressAbsenHariIni();
      ajaxchartConfigTotalAbsen();
      ajaxconfigChartCredit();
      ajaxConfigChartJumlahOperasional();
      ajaxChartTotalOperasinal();
      //Jika Terjadi Resize
      $(window).resize(function() {
        //resize just happened, pixels changed
        //ajaxchartConfigAbsen(false);
      });
      //End Jika Terjadi Resize

      //Jika Ada data permbaruan absensi, maka server push data update Dashboard ke client
      //Socket IO
      var socket = io.connect("https://localhost:3000");
          socket.on("submit_baru", function (data) {
            //console.log(data);
            //ajaxGalleryAbsensiHariIni();
            ajaxProgressAbsenHariIni();
            //ajaxchartConfigAbsen(false);
            ajaxchartConfigTotalAbsen();
            ajaxconfigChartCredit();
            ajaxConfigChartJumlahOperasional();
            ajaxChartTotalOperasinal();
          });
      //End Socket IO
  }
  //EndFungsi loadChart Kakatu untuk Load semua chart di home.php
  function zoomLoadEvent(){
    document.body.style.zoom = "90%";
  }
  function sessionKakatu(){
    var session_kakatu;
    $.ajax({
      //async:false,
      type: "post",
      url: "ajax-fetchdata/session-jabatan",
      data: "data",
      success: function (data) {
        session_kakatu = data;
      }
    });
    return session_kakatu;
  }
  //End Non-Jquery FUnction

$(function() {
  //loadChartKakatu();
  //var session_kakatu;
  //End var session_kakatu
  $.validate({
    modules : 'file'
  });
  //Ajax View Profile
  $(document).on('click', '.edit_data_profile', function(){ 
    var id_anggota = $(this).attr("id");   
               $.ajax({  
                  url:"pages/fetchdata/fetch_data_anggota-json.php",  
                  method:"POST",  
                  data:{id_anggota:id_anggota},  
                  dataType:"json",  
                  success:function(data){ 
                       $('#id_anggota').val(data.id_anggota); 
                       $('#nama').val(data.nama);  
                       $('#alamat').val(data.alamat);  
                       $('#tempat_lahir').val(data.tempat_lahir);  
                       $('#tgl_lahir').val(data.tgl_lahir);  
                       $('#email').val(data.email);  
                       $('#password').val(data.password);  
                       $('#insert').val("Update");  
                       $('#add_data_Modal').modal('show');  
                  }  
             });
  });
  $(document).on('click', '.upload_foto_profile', function(){ 
    var id_anggota = $(this).attr("id");   
               $.ajax({  
                  success:function(data){ 
                       $('#insert').val("Update");  
                       $('#data_Modal').modal('show');  
                  }  
             });
  });  
  //End AJax View Profile
  //datalist anggota JS
  $(document).on('click', '.view_data', function(){  
        var id_anggota = $(this).attr("id");
          $.ajax({  
                url:"pages/fetchdata/fetch_data_anggota.php",  
                method:"post",  
                data:{id_anggota:id_anggota},  
                success:function(data){
                $('#employee_detail').html(data);           
                $('#dataModal').modal("show");  
            }
        });
      });  

  $(document).on('click', '.delete_data_anggota', function(){  
        var id_anggota = $(this).attr("id");
          $.ajax({  
                url:"pages/fetchdata/fetch_data_anggota-fordelete.php",  
                method:"post",  
                data:{id_anggota:id_anggota},  
                success:function(data){
                $('#employee').html(data);           
                $('#dataModal_hapus').modal("show");  
            }
        });
      });  
  //End datalist anggota JS
  
  //Ajax JS Datalist Cuti
  $(document).on('click', '.edit_quota', function(){ 
    var id_anggota = $(this).attr("id"); 
    
               $.ajax({  
                  url:"pages/fetchdata/fetch_data_cuti-json.php",  
                  method:"POST",  
                  data:{id_anggota:id_anggota},  
                  dataType:"json",  
                  success:function(data){ 
                       $('#id_anggota').val(data.id_anggota); 
                       $('#cuti_quota').val(data.cuti_qty);   
                       $('#insert').val("Update");  
                       $('#cuti_Modal').modal('show');  
                  }  
             });
        });
    $(document).on('click', '.reset_quotaUsed', function(){ 
             var id_anggota = $(this).attr("id");
              $.ajax({
                    url:"pages/fetchdata/fetch_data_cuti-forreset.php",  
                    method:"post",  
                    data:{id_anggota:id_anggota},  
                    success:function(data){
                     $('#cuti_detail_reset').html(data);           
                     $('#resetModal').modal("show");  
                 }
             });
    });
    $(document).on('click', '.reset_all_cuti_used', function(){ 
          $.ajax({
                url:"pages/fetchdata/fetch_data_cuti-forresetallcuti.php",  
                method:"post",  
                data:{},  
                success:function(data){
                 $('#cuti_all_reset').html(data);           
                 $('#resetCutiModal').modal("show");  
             }
         });
      });  
  //End Ajax JS Datalist Cuti
  
  //Ajax JS Datalist Jabatan
  $(document).on('click', '.delete_data_jabatan', function(){ 
       var id_jabatan = $(this).attr("id");
        $.ajax({  
              url:"pages/fetchdata/fetch_data_jabatan.php",  
              method:"post",  
              data:{id_jabatan:id_jabatan},  
              success:function(data){
               $('#jabatan_detail').html(data);           
               $('#dataModal').modal("show");  
           }
       });
    });
    $(document).on('click', '.edit_jabatan', function(){ 
      var id_jabatan = $(this).attr("id");   
                 $.ajax({  
                    url:"pages/fetchdata/fetch_data_jabatan-json.php",  
                    method:"POST",  
                    data:{id_jabatan:id_jabatan},  
                    dataType:"json",  
                    success:function(data){ 
                         $('#id_jabatan1').val(data.id_jabatan); 
                         $('#jabatan1').val(data.jabatan);  
                         $('#gaji1').val(data.gaji);  
                         $('#insert').val("Update");  
                         $('#jabatan_Modal').modal('show');  
                    }  
               });
     });    
  //End Ajax JS Datalist Jabatan
  
  //Ajax JS Datalisst Jenis Pembayaran
  $(document).on('click', '.delete_jenis_pembayaran', function(){  
    var id_jenis = $(this).attr("id");
     $.ajax({  
           url:"pages/fetchdata/fetch_data_jenis-pembayaran.php",  
           method:"post",  
           data:{id_jenis:id_jenis},  
           success:function(data){
            $('#detail_jenis').html(data);           
            $('#dataModal').modal("show");  
        }
    });
  });
  $(document).on('click', '.edit_jenis_pembayaran', function(){ 
    var id_jenis = $(this).attr("id");   
               $.ajax({  
                  url:"pages/fetchdata/fetch_data_jenispembayaran-json.php",  
                  method:"POST",  
                  data:{id_jenis:id_jenis},  
                  dataType:"json",  
                  success:function(data){ 
                       $('#id_jenis1').val(data.id_jenis); 
                       $('#jenis1').val(data.jenis);  
                       $('#insert').val("Update");  
                       $('#jenis_Modal').modal('show');  
                  }  
             });
    });
  //End  Ajax JS Datalisst Jenis Pembayaran
   
  //Ajax JS Datalist Pembayaran Delete Data
    $(document).on('click', '.delete_data_pembayaran', function(){ 
      var id_pembayaran = $(this).attr("id");

                $.ajax({  
                url:"pages/fetchdata/fetch_data_pembayaran.php",  
                method:"post",  
                data:{id_pembayaran:id_pembayaran},  
                success:function(data){
                $('#pembayaran_detail').html(data);           
                $('#dataModal').modal("show");  
            }
          });  
      });     
  //End Ajax JS Datalist Pembayaran Delete Data

  // Fungsi Data Absen Admin
  // Fetch DAta Detail Absen Admin

    $(document).on('click', '.detail_kehadiran', function(){ 
       var id = $(this).attr("id");
        $.ajax({  
              url:"pages/fetchdata/fetch_data_absen.php",  
              method:"post",  
              data:{id:id},  
              success:function(data){
               $('#detail_kehadiran').html(data);           
               $('#dataModal').modal("show");
               $('#dataModal').on('shown.bs.modal', function() {
                   var lat = parseFloat($('#latDetailAbsen').text());
                   var lng = parseFloat($('#lngDetailAbsen').text());
                   console.log(lat);
                   console.log(lng);
                   console.log("Center");
                   google.maps.event.addDomListener(window, 'load', initMap(lat,lng));
                   google.maps.event.addDomListener(window, "resize", function() {
                    var waktu = $('#waktuDetailAbsen').text();
                        var nama = $('#namaDetailAbsen').text();
                        var status = $('#statusDetailAbsen').text();
                        //var myLatLng = {lat: lat1,lng: lng1};
                        console.log("Inisiasi Map");
                        var myLatLng = new google.maps.LatLng(lat,lng);
                        var map = new google.maps.Map(document.getElementById('peta'), {
                          zoom: 18,
                          center: myLatLng,
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                        });
                        console.log("Buat marker");
                        var marker = new google.maps.Marker({
                          position: myLatLng,
                          map: map,
                          title: 'Lokasi '+nama+' pada '+waktu+' saat '+status
                        });
                        var center = map.getCenter();
                        google.maps.event.trigger(map, "resize");
                        map.setCenter(center);
                    });
                   //google.maps.event.trigger(map, 'resize');
                   //Foto Di klik
                  $('.pop').on('click', function() {
                      $('.imagepreview').attr('src', $(this).attr('src'));
                      $('#imagemodal').modal('show');   
                  }); 
              })
           }
       });
    });
  //Edit Absen Admin
  $(document).on('click', '.edit_absen', function(){ 
            var id_absen = $(this).attr("id");   
            $.ajax({  
                url:"pages/fetchdata/fetch_data_absen-json.php",  
                method:"POST",  
                data:{id:id_absen},  
                dataType:"json",  
                success:function(data){ 
                    $('#id_absen').val(data.id);
                    $('#id_anggota_absen').val(data.id_anggota);
                    $('#status_id_adminEdit').val(data.status_id); 
                    $('#keterangan_absen').val(data.keterangan);
                    $('#tglRentangAbsenAdmin').val(data.tglawal+" - "+data.tglakhir);
                    //Ambil sisa cuti dan cuti used
                    var rangeTgl= $('#tglRentangAbsenAdmin').val();
                    var awal =  rangeTgl.substring(0, 10);
                    var akhir =  rangeTgl.substring(13, 23);
                    var sisaCuti;
                    var cutiUsed;
                    $.ajax({
                      async: false, 
                      type: "POST",
                      url: "pages/fetchdata/fetch_data-hitungcutiused.php",
                      data: {awal:awal,akhir:akhir},
                      dataType:"json", 
                      success: function (data) {
                        console.log("Sisa Cuti: "+data.sisaCuti+" Cuti Used: "+data.cutiUsed);
                        sisaCuti = data.sisaCuti;
                        cutiUsed=data.cutiUsed;
                      }
                    });
                    //Date range picker
                    $('#tglRentangAbsenAdmin').daterangepicker({
                      drops: 'up',
                      opens: 'center',
                    })
                    /*
                    $('#tglRentangAbsenAdmin').on('showCalendar.daterangepicker', function(ev, picker) {

                      //change the selected date range of that picker
                      $('#tglRentangAbsenAdmin').data('daterangepicker').setStartDate(tglAwal);
                      $('#tglRentangAbsenAdmin').data('daterangepicker').setEndDate(tglAkhir);
                    });
                    */
                    $('#tglRentangAbsenAdmin').on('apply.daterangepicker', function(ev, picker) {
                      var start= picker.startDate.format('MM/DD/YYYY');
                      var end = picker.endDate.format('MM/DD/YYYY');
                      var date1 = new Date(start);
                      var date2 = new Date(end);
                      console.log(start+"-"+end);
                      //var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                      //var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))+1; 
                      //var sisacuti= <?php echo $_SESSION["sisacuti"] ?>;

                      var status=$("#status_id_adminEdit").val();
                      var today= new Date();
                      var timeDiff2 = date1.getTime() - today.getTime();
                      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
                      //var tglskrg = (today.getMonth()+1) + '/' + today.getDate() + '/' + today.getFullYear();
                      //if (diffDays2<0) {
                       //   alert("Tidak boleh memilih tanggal yang telah lewat");
                      //    $('#tglRentangCuti').val('');
                      //} else {
                        if (cutiUsed>sisaCuti && status==5) {
                          alert("Cuti yang digunakan melebihi jatah cuti!");
                          $('#tglRentangAbsenAdmin').val(start+' - '+ start);
                        }
                    })  
                    $('#insert').val("Update");  
                    $('#editAbsen_Modal').modal('show');
                    $('#editAbsen_Modal').on('shown.bs.modal', function() {
                      //console.log("status"+data.status_id);
                      var value = parseInt(data.status_id);
                      gantiWarnaStatusAbsenSelect(value);
                    });  
                }  
          });
  })
      //End Edit Absen ADmin    
  
        var statussaya = document.getElementById("statussaya");
        var ketsaya = document.getElementById("statussaya")
        function formatPesan() {
            var waktuAbsen = document.getElementById("waktuAbsen").innerHTML;
            var idAbsen = document.getElementById("id_anggota_absen").value;
            document.getElementById("idsaya").innerHTML = idAbsen;
            var namaAbsen = document.getElementById("nama_absen").value;
            document.getElementById("namasaya").innerHTML = namaAbsen;
            var stat = x.options[x.selectedIndex].tex;
            var ket1;
            switch (stat) {
                case "Hadir":
                    ket1 = "Hadir";
                    break;
                case "Hadir (Diluar)":
                    ket1 = "Hadir diluar";
                    break;
                case "Sakit":
                    ket1 = "Sakit";
                    break;
                case "Izin":
                    ket1 = "Izin";
                    break;
            }
            statussaya.innerHTML = ket1;
            var ket2 = document.getElementById("keterangan_absen").value;
            document.getElementById("ketsaya").innerHTML = ket2;
            var lokasi = document.getElementById("adress").value;
            document.getElementById("lokasi").innerHTML = lokasi;
            var waMsg1 = "Waktu Absen: " + "\n" + waktuAbsen + "\n\n" + "ID Anggota: " + "\n" + idAbsen + "\n\n" + "Nama: " + "\n" + namaAbsen + "\n\n" + "Status: " + "\n" + ket1 + "\n\n" + "Keterangan: " + "\n" + ket2 + "\n\n" + "Lokasi: " + "\n" + lokasi;
            var waMsg1 = window.encodeURIComponent(waMsg1);
            var waMsg2 = document.getElementById("isiPesanWA").innerText;
            var isiPesanWA = "whatsapp://send?text=" + waMsg1;
            //alert(isiPesanWA);
            document.getElementById("pesanWA").setAttribute("href", isiPesanWA);
        }
        // End Proses Ambil Latitude & Longitude
        function validasiCuti(){
            var sisacuti = $("#sisacuti").val();
    
        } 
        
       //Event Click dan Show Modal Form Submit Absensi
       $('#submit_hadir_form').on('click', function() {
        var stat = 1;
        var lat = $('#latitude').val();
        var lng = $('#longitude').val();
        $.ajax({
          type: "POST",
          url: "ajax-proses/submit-absensi",
          data: {latitude:lat,longitude:lng,status:stat},
          dataType: "json",
          success: function (dt) {
              console.log(dt);
              if(dt.errmsg===null){
                pesanWA(dt.nama,dt.status,dt.keterangan,dt.tgl1,dt.tgl2,dt.sisacuti,dt.errmsg,dt.scsmsg);
              } else {
                console.log(dt.errmsg);
                alert(dt.errmsg);
              }
          },
          error: function (dt) {
              console.log("Error: \n");
              console.log(dt);
          }
        });
        });

      //Shown Modal Hadir Diluar
      function ajaxFormHadirDiluar(lat,lng,stat,ket,url,img){
        var fdata = new FormData();
        fdata.append("status",stat);
        fdata.append("latitude",lat);
        fdata.append("longitude",lng);
        fdata.append("keterangan_hadirdiluar",ket);
        fdata.append("image_hadirdiluar", img);
        console.log(fdata);
        if(!ket.length){
          //$("#keterangan_hadirdiluar").focus();
          bootbox.prompt({
            title: "Keterangan Hadir diluar wajib diisi!",
            inputType: 'textarea',
            callback: function (result) {
              $('#keterangan_hadirdiluar').val(result);
            }
        });
        } else {
            $.ajax({
              type: "POST",
              url: "ajax-proses/submit-absensi",
              cache: false,
              contentType: false,
              processData: false,
              data: fdata,
              dataType: "json",
              success: function (dt) {
                //console.log(dt.errmsg);
                ///console.log(dt);
                //alert(dt.errmsg);
                if(dt.errmsg===null){
                    console.log("Foto: "+dt.scsmsg);
                    $('#myModal_hadirdiluar').modal('toggle');
                    pesanWA(dt.nama,dt.status,dt.keterangan,dt.tgl1,dt.tgl2,dt.sisacuti,url,dt.scsmsg);
                } else {
                  console.log(dt.errmsg);
                  alert(dt.errmsg);
                }
              },
              error: function (dt) {
                console.log("Error: \n");
                console.log(dt);
              }
            });
        }
      }
      $('#submit_hadirdiluar_modal').on('click', function() {
        var stat = 2;
        var lat = $('#latitude').val();
        var lng = $('#longitude').val();
        var url = "https://maps.google.com/?q="+lat+","+lng;
        var ket = $('#keterangan_hadirdiluar').val();
        var img = $("#image_hadirdiluar").get(0).files[0];
        ajaxFormHadirDiluar(lat,lng,stat,ket,url,img);
      });
      //End Shown Modal Hadir Diluar

      //Shown Modal Sakit
      function ajaxFormSakit(lat,lng,stat,ket,url,tgl,img){
        var fdata = new FormData();
        fdata.append("status",stat);
        fdata.append("latitude",lat);
        fdata.append("longitude",lng);
        fdata.append("keterangan_sakit",ket);
        fdata.append("tglRentangSakit",tgl);
        fdata.append("image_sakit", img);
        console.log(fdata);
        if(!ket.length){
          //$("#keterangan_hadirdiluar").focus();
          bootbox.prompt({
            title: "Keterangan Sakit wajib diisi!",
            inputType: 'textarea',
            callback: function (result) {
              $('#keterangan_sakit').val(result);
            }
        });
        } else {
            $.ajax({
              type: "POST",
              url: "ajax-proses/submit-absensi",
              cache: false,
              contentType: false,
              processData: false,
              data: fdata,
              dataType: "json",
              success: function (dt) {
                //console.log(dt.errmsg);
                ///console.log(dt);
                //alert(dt.errmsg);
                if(dt.errmsg===null){
                    console.log("Foto: "+dt.scsmsg);
                    $('#myModal_sakit').modal('toggle');
                    pesanWA(dt.nama,dt.status,dt.keterangan,dt.tgl1,dt.tgl2,dt.sisacuti,url,dt.scsmsg);
                } else {
                  console.log(dt.errmsg);
                  alert(dt.errmsg);
                }
              },
              error: function (dt) {
                console.log("Error: \n");
                console.log(dt);
              }
            });
        }
      }
      $('#myModal_sakit').on('shown.bs.modal', function() {
        var tglawal= new Date();
        var awal = (tglawal.getUTCMonth()+1)+"/"+ tglawal.getUTCDate()+"/"+tglawal.getUTCFullYear();
        $('#tglRentangSakit').daterangepicker({
          drops: 'up',
          minDate: awal
        });
        $('#tglRentangSakit').on('apply.daterangepicker', function(ev, picker) {
          var start= picker.startDate.format('MM/DD/YYYY');
          var end = picker.endDate.format('MM/DD/YYYY');
          var date1 = new Date(start);
          var date2 = new Date(end);
          var today= new Date();
          var timeDiff2 = date1.getTime() - today.getTime();
          var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
          if (diffDays2>0) {
              alert("Tanggal awal harus tanggal hari ini kecuali untuk rencana absensi");
              $('#tglRentangSakit').val(awal+' - '+awal);
          }
        });
        $('#submit_sakit_modal').on('click', function() {
              var stat = 3;
              var lat = $('#latitude').val();
              var lng = $('#longitude').val();
              var url = "https://maps.google.com/?q="+lat+","+lng;
              var ket = $('#keterangan_sakit').val();
              var tgl =$('#tglRentangSakit').val();
              var img = $("#image_sakit").get(0).files[0];
              ajaxFormSakit(lat,lng,stat,ket,url,tgl,img);
              //alert(ket);
            });
        });
        //End Shown Modal Sakit

        //Shown Modal Izin
        function ajaxFormIzin(lat,lng,stat,ket,url,tgl,img){
          var fdata = new FormData();
          fdata.append("status",stat);
          fdata.append("latitude",lat);
          fdata.append("longitude",lng);
          fdata.append("keterangan_izin",ket);
          fdata.append("tglRentangIzin",tgl);
          fdata.append("image_izin", img);
          console.log(fdata);
          if(!ket.length){
            //$("#keterangan_hadirdiluar").focus();
            bootbox.prompt({
              title: "Keterangan Izin wajib diisi!",
              inputType: 'textarea',
              callback: function (result) {
                $('#keterangan_izin').val(result);
              }
          });
          } else {
              $.ajax({
                type: "POST",
                url: "ajax-proses/submit-absensi",
                cache: false,
                contentType: false,
                processData: false,
                data: fdata,
                dataType: "json",
                success: function (dt) {
                  //console.log(dt.errmsg);
                  ///console.log(dt);
                  //alert(dt.errmsg);
                  if(dt.errmsg===null){
                      console.log("Foto: "+dt.scsmsg);
                      $('#myModal_izin').modal('toggle');
                      pesanWA(dt.nama,dt.status,dt.keterangan,dt.tgl1,dt.tgl2,dt.sisacuti,url,dt.scsmsg);
                  } else {
                    console.log(dt.errmsg);
                    alert(dt.errmsg);
                  }
                },
                error: function (dt) {
                  console.log("Error: \n");
                  console.log(dt);
                }
              });
          }
        }
       $('#myModal_izin').on('shown.bs.modal', function() {
          var tglawal= new Date();
          var awal = (tglawal.getUTCMonth()+1)+"/"+ tglawal.getUTCDate()+"/"+tglawal.getUTCFullYear();
          $('#tglRentangIzin').daterangepicker({
            drops: 'up',
            minDate: awal
          });
          $('#tglRentangIzin').on('apply.daterangepicker', function(ev, picker) {
            var start= picker.startDate.format('MM/DD/YYYY');
            var end = picker.endDate.format('MM/DD/YYYY');
            var date1 = new Date(start);
            var date2 = new Date(end);
            var today= new Date();
            var timeDiff2 = date1.getTime() - today.getTime();
            var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
            if (diffDays2>0) {
                alert("Tanggal awal harus tanggal hari ini kecuali untuk rencana absensi");
                $('#tglRentangIzin').val(awal+' - '+awal);
            }
          });
          $('#submit_izin_modal').on('click', function() {
            var stat = 4;
            var lat = $('#latitude').val();
            var lng = $('#longitude').val();
            var url = "https://maps.google.com/?q="+lat+","+lng;
            var ket = $('#keterangan_izin').val();
            var tgl =$('#tglRentangIzin').val();
            var img = $("#image_izin").get(0).files[0];
            ajaxFormIzin(lat,lng,stat,ket,url,tgl,img);
          });
        });
       //End Shown Modal Izin

       //Shown Modal Modal Cuti
       function ajaxFormCuti(lat,lng,stat,ket,url,tgl,img){
        var fdata = new FormData();
        fdata.append("status",stat);
        fdata.append("latitude",lat);
        fdata.append("longitude",lng);
        fdata.append("keterangan_cuti",ket);
        fdata.append("tglRentangCuti",tgl);
        fdata.append("image_cuti", img);
        console.log(fdata);
        if(!ket.length){
          //$("#keterangan_hadirdiluar").focus();
          bootbox.prompt({
            title: "Keterangan Cuti wajib diisi!",
            inputType: 'textarea',
            callback: function (result) {
              $('#keterangan_cuti').val(result);
            }
        });
        } else {
            $.ajax({
              type: "POST",
              url: "ajax-proses/submit-absensi",
              cache: false,
              contentType: false,
              processData: false,
              data: fdata,
              dataType: "json",
              success: function (dt) {
                //console.log(dt.errmsg);
                ///console.log(dt);
                //alert(dt.errmsg);
                if(dt.errmsg===null){
                    console.log("Foto: "+dt.scsmsg);
                    $('#myModal_izin').modal('toggle');
                    pesanWA(dt.nama,dt.status,dt.keterangan,dt.tgl1,dt.tgl2,dt.sisacuti,url,dt.scsmsg);
                } else {
                  console.log(dt.errmsg);
                  alert(dt.errmsg);
                }
              },
              error: function (dt) {
                console.log("Error: \n");
                console.log(dt);
              }
            });
        }
      }
       $('#myModal_cuti').on('shown.bs.modal', function() {
            //var status=5;
            //var tglawal= new Date();
            //var awal = tglawal.getUTCFullYear()+"-"+(tglawal.getUTCMonth()+1) +"-"+ tglawal.getUTCDate();
            //console.log(tglawal);
            $.ajax({
              type: "POST",
              url: "pages/fetchdata/fetch_data_max-tanggal-from-sisa-cuti.php",
              dataType:"json",
              success: function (data) {
                //console.log(data.tglawal+" - "+data.tglakhir);
                $('#tglRentangCuti').daterangepicker({
                  //console.log(data.tglakhir);
                  minDate: data.tglawal,
                  maxDate: data.tglakhir
                }) 
                $('#tglRentangCuti').on('apply.daterangepicker', function(ev, picker) {
                  var start= picker.startDate.format('MM/DD/YYYY');
                  var end = picker.endDate.format('MM/DD/YYYY');
                  var date1 = new Date(start);
                  var date2 = new Date(end);
                  console.log("Masuk: "+start+" - "+end);
                  var today= new Date();
                  var timeDiff2 = date1.getTime() - today.getTime();
                  var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
                  var tglskrg = (today.getMonth()+1) + '/' + today.getDate() + '/' + today.getFullYear();
                  console.log(diffDays2);
                  if (diffDays2>0) {
                      alert("Tanggal awal harus tanggal hari ini kecuali untuk rencana absensi");
                      $('#tglRentangCuti').val(tglskrg+' - '+tglskrg);
                      $('#tglRentangCuti').data('daterangepicker').setStartDate(tglskrg);
                      $('#tglRentangCuti').data('daterangepicker').setEndDate(tglskrg);
                  }
                  //$('#tglRentangCuti').val(tglskrg+'-'+start);
                })
              }
            });
            $('#submit_cuti_modal').on('click', function() {
              var stat = 5;
              var lat = $('#latitude').val();
              var lng = $('#longitude').val();
              var url = "https://maps.google.com/?q="+lat+","+lng;
              var ket = $('#keterangan_cuti').val();
              var tgl =$('#tglRentangCuti').val();
              var img = $("#image_cuti").get(0).files[0];
              ajaxFormCuti(lat,lng,stat,ket,url,tgl,img);
            });        
       });
       //End Shown Modal Modal Cut
      
       //End Event Show

      //Event Click Submit Absen
      
      //END Event Click Submit Absen
      //Fungsi Pesan WA
      function pesanWA(nama,status,keterangan,tgl1,tgl2,sisacuti,url,foto){
          //console.log("Status = "+status);
          console.log("Foto1"+foto);
          var tglskrg = new Date();
          var wa_msg = null;
          switch (status) {
            case "1":
              wa_msg = "HADIR"+ "\n"+"---"+ "\n"+"Saya, "+nama+" sudah hadir dikantor pada hari ini pukul "+tglskrg.getHours()+":"+tglskrg.getMinutes();
              console.log(wa_msg+'\n');
              break;
            case "2":
              wa_msg = "HADIR DILUAR"+ "\n"+"Saya, "+nama+"  sedang bertugas diluar kantor pada hari ini mulai pukul "+tglskrg.getHours()+":"+tglskrg.getMinutes()+" untuk keperluan "+keterangan+"\n"+url;
              break;
            case "3":
              //var date1 = new Date(tgl1);
              //var date2 = new Date(tgl2);
              //var timeDiff = Math.abs(date2.getTime() - date1.getTime());
              //var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
              if (tgl1===tgl2) {
                wa_msg = "SAKIT"+ "\n"+"Saya, "+nama+" mohon izin sakit pada hari ini tidak bisa masuk kerja karena "+keterangan+". Mohon doanya ya agar saya lekas sembuh. Amin\n"+url;
              } else {
                wa_msg = "SAKIT"+ "\n"+"Saya, "+nama+" mohon izin sakit pada hari ini sampai "+tgl2+" tidak bisa masuk kerja karena "+keterangan+". Mohon doanya ya agar saya lekas sembuh. Amin\n"+url;
              }
              break;
            case "4":
              //var tglcoba="<?php echo $tgl_awal?>";
              //console.log(tglcoba);
              //var date1 = new Date(tgl1);
              //var date2 = new Date(tgl2);
              //var timeDiff = Math.abs(date2.getTime() - date1.getTime());
              //var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
              if (tgl1===tgl2) {
               wa_msg = "IZIN"+ "\n"+"Saya, "+nama+" mohon izin pada hari ini tidak bisa masuk kerja karena "+keterangan+".\n"+url;
              } else {
               wa_msg = "IZIN"+ "\n"+"Saya, "+nama+" mohon izin pada hari ini sampai "+tgl2+" tidak bisa masuk kerja karena "+keterangan+".\n"+url;
              }
              break;
            case "5":
            wa_msg = "CUTI"+ "\n"+"Saya, "+nama+" mohon izin cuti dari tanggal "+tgl1+" sampai "+tgl2+" karena "+keterangan+".Sisa cuti saya tahun "+tglskrg.getFullYear()+" ini <"+sisacuti+" hari \n"+url;
              break;
          }
          wa_msg = window.encodeURIComponent(wa_msg);
          console.log(wa_msg+"\n");
          wa_absen = "whatsapp://send?text="+wa_msg;
          //console.log( wa_absen);
          //message: '<img alt="Tidak Ada Foto" src="dist/fotolokasi/'+dt.scsmsg+'" class="compress thumbnail img-responsive pop" style="height: 100px;width:100px;object-fit:cover;">'
          var formatPesan=null;
          if(foto!==null){
            formatPesan="<h4>Absen Berhasil, "+nama+".<br><br>Yuk share ke Whatsapp untuk absensi anda hari ini! </h4><br><img src='dist/fotolokasi/"+foto+"' class='compress thumbnail img-responsive pop' style='height: 180px;width:180px;object-fit:cover;'><br><h3>Share Sekarang?</h3>";
          } else{
            formatPesan="<h4>Absen Berhasil, "+nama+".<br><br>Yuk share ke Whatsapp untuk absensi anda hari ini! </h4><br><br><h3>Share Sekarang?</h3>";
          }
          bootbox.confirm({
              message: formatPesan,
              buttons: {
                confirm: {
                  label: 'SHARE',
                  className: 'btn-success btn-sm'
    
                },
                cancel: {
                  label: 'NANTI',
                  className: 'btn-danger btn-sm'
                }
              },
          callback: function (result) {
            //console.log('This was logged in the callback: ' + result)
            if (result){
                window.location=wa_absen
                bootbox.alert({ 
                  size: "small",
                  message: "<h4>Terimakasih telah share ke WA</h4>", 
                  callback: function(){
                    window.location="tampil/data-absensi"
                  }
                })
            } else {
              window.location="tampil/data-absensi"
            }
          }
        });
      }

      //End Fungsi Form Submit Absensi
  //Datalist Credits Uang Akomodasi JS ajax function
  /*
    $(document).on('click', '.delete_data', function(){ 
       var id = $(this).attr("id");
        $.ajax({
              url:"pages/fetchdata/fetch_data_credit-fordelete.php",  
              method:"post",  
              data:{id:id},  
              success:function(data){
               $('#credit_detail_hapus').html(data);           
               $('#dataModal').modal("show");  
           }
       });
    });  
*/
$(document).on('click', '.edit_topup_credit', function(){ 
var id_anggota = $(this).attr("id");   
           $.ajax({  
              url:"pages/fetchdata/fetch_data_credit-json.php",  
              method:"POST",  
              data:{id_anggota:id_anggota},  
              dataType:"json",  
              success:function(data){ 
                   $('#id_anggota_credit').val(data.id_anggota); 
                   $('#topup_credit').val(data.topup_credit);   
                   $('#insert').val("Update");  
                   $('#editCreditModal').modal('show');  
              }  
         });
    });    



    $(document).on('click', '.paid_total_credit', function(){  
       var id = $(this).attr("id");
        $.ajax({
              url:"pages/fetchdata/fetch_data_credit-forreset.php",  
              method:"post",  
              data:{id:id},  
              success:function(data){
                console.log(data);
               $('#credit_detail_paid').html(data);           
               $('#paidCreditModal').modal("show");  
           }
       });
    });  

    $(document).on('click', '.paid_all_total_credit', function(){    
        $.ajax({
              url:"pages/fetchdata/fetch_data_credit-forresetallcredit.php",  
              method:"post",  
              data:{},  
              success:function(data){
               $('#credit_all_reset').html(data);           
               $('#resetTotalModal').modal("show");  
           } 
       });
    });  
  //End Datalist Credits Uang Akomodasi JS ajax function


 //MASK MONEY
 //$(function() {
    $("#numeric").maskMoney({prefix:'Rp ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false, precision : 0});
    $("#gaji").maskMoney({prefix:'Rp ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false, precision : 0});
    $("#gaji1").maskMoney({prefix:'Rp ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false, precision : 0});
  //})
 //END MASK MONEY

 //MODAL GAMBAR PREVIEW
  $(document).on('click', '#close-preview', function(){ 
      $('.image-preview').popover('hide');
      // Hover befor close the preview
      $('.image-preview').hover(
          function () {
            $('.image-preview').popover('show');
          }, 
          function () {
            $('.image-preview').popover('hide');
          }
      );    
  });

      // Create the close button
      var closebtn = $('<button/>', {
          type:"button",
          text: 'x',
          id: 'close-preview',
          style: 'font-size: initial;',
      });
      closebtn.attr("class","close pull-right");
      // Set the popover default content
      $('.image-preview').popover({
          trigger:'manual',
          html:true,
          title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
          content: "There's no image",
          placement:'bottom'
      });
      // Clear event
      $('.image-preview-clear').click(function(){
          $('.image-preview').attr("data-content","").popover('hide');
          $('.image-preview-filename').val("");
          $('.image-preview-clear').hide();
          $('.image-preview-input input:file').val("");
          $(".image-preview-input-title").text("Browse"); 
      }); 
      // Create the preview image
      $(".image-preview-input input:file").change(function (){     
          var img = $('<img/>', {
              id: 'dynamic',
              width:250,
              height:200
          });      
          var file = this.files[0];
          var reader = new FileReader();
          // Set preview image into the popover data-content
          reader.onload = function (e) {
              $(".image-preview-input-title").text("Change");
              $(".image-preview-clear").show();
              $(".image-preview-filename").val(file.name);            
              img.attr('src', e.target.result);
              $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
          }        
          reader.readAsDataURL(file);
      });
 //END MODAL GAMBAR PREVIEW
 
 //Konfigurasi Tabel, DateRangePicker, Calendar

 //KONFIGURASI FULLCALENDAR
 function init_events(ele) {
  ele.each(function () {

    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
    // it doesn't need to have a start or end
    var eventObject = {
      title: $.trim($(this).text()) // use the element's text as the event title
    }

    // store the Event Object in the DOM element so we can get to it later
    $(this).data('eventObject', eventObject)

    // make the event draggable using jQuery UI
    $(this).draggable({
      zIndex        : 1070,
      revert        : true, // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
    })

  })
}

init_events($('#external-events div.external-event'))
// Kalendar Absen
/* initialize the calendar
 -----------------------------------------------------------------*/
//Date for the calendar events (dummy data)
var date = new Date()
var d    = date.getDate(),
    m    = date.getMonth(),
    y    = date.getFullYear()
$('#calendar').fullCalendar({
  header    : {
    left  : 'prev,next today',
    center: 'title',
    right : 'month,agendaDay,listMonth'
  },
  buttonText: {
    today: 'Hari Ini',
    month: 'Bulan',
    day  : 'Hari',
    list : 'List'
  },
  //Random default events
  events    : "pages/fetchdata/fetch_data_calendar-absen.php",
  eventLimit: true,
  businessHours: true, // display business hours
  navLinks: true, // can click day/week names to navigate views
  editable  : true,
  droppable : true, // this allows things to be dropped onto the calendar !!!
  drop      : function (date, allDay) { // this function is called when something is dropped

    // retrieve the dropped element's stored Event Object
    var originalEventObject = $(this).data('eventObject')

    // we need to copy it, so that multiple events don't have a reference to the same object
    var copiedEventObject = $.extend({}, originalEventObject)

    // assign it the date that was reported
    copiedEventObject.start           = date
    copiedEventObject.allDay          = allDay
    copiedEventObject.backgroundColor = $(this).css('background-color')
    copiedEventObject.borderColor     = $(this).css('border-color')

    // render the event on the calendar
    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

    // is the "remove after drop" checkbox checked?
    if ($('#drop-remove').is(':checked')) {
      // if so, remove the element from the "Draggable Events" list
      $(this).remove()
    }

  },
  eventClick: function(calEvent, jsEvent, view) {

    alert('Event: ' + calEvent.title);
    // change the border color just for fun
    $(this).css('border-color', 'red');

}
})

/* ADDING EVENTS */
var currColor = '#3c8dbc' //Red by default
//Color chooser button
var colorChooser = $('#color-chooser-btn')
$('#color-chooser > li > a').click(function (e) {
  e.preventDefault()
  //Save color
  currColor = $(this).css('color')
  //Add color effect to button
  $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
})
$('#add-new-event').click(function (e) {
  e.preventDefault()
  //Get value and make sure it is not null
  var val = $('#new-event').val()
  if (val.length == 0) {
    return
  }

  //Create events
  var event = $('<div />')
  event.css({
    'background-color': currColor,
    'border-color'    : currColor,
    'color'           : '#fff'
  }).addClass('external-event')
  event.html(val)
  $('#external-events').prepend(event)

  //Add draggable funtionality
  init_events(event)

  //Remove event from text input
  $('#new-event').val('')
})
  //END KONFIGURASI FULLCALENDAR

// Kalendar Tgl Libur
/* initialize the calendar
 -----------------------------------------------------------------*/
//Date for the calendar events (dummy data)
var date = new Date()
var d    = date.getDate(),
    m    = date.getMonth(),
    y    = date.getFullYear()
$('#calendarLibur').fullCalendar({
  header    : {
    left  : 'prev,next /*today*/',
    center: 'title',
    right : 'month,agendaDay,listMonth'
  },
  buttonText: {
    //today: 'Hari Ini',
    month: 'Bulan',
    day  : 'Hari',
    list : 'List'
  },
  //Random default events
  events    : "pages/fetchdata/fetch_data_calendar-libur.php",
  eventLimit: true,
  businessHours: true, // display business hours
  navLinks: true, // can click day/week names to navigate views
  editable  : true,
  droppable : true, // this allows things to be dropped onto the calendar !!!
  drop      : function (date, allDay) { // this function is called when something is dropped

    // retrieve the dropped element's stored Event Object
    var originalEventObject = $(this).data('eventObject')

    // we need to copy it, so that multiple events don't have a reference to the same object
    var copiedEventObject = $.extend({}, originalEventObject)

    // assign it the date that was reported
    copiedEventObject.start           = date
    copiedEventObject.allDay          = allDay
    copiedEventObject.backgroundColor = $(this).css('background-color')
    copiedEventObject.borderColor     = $(this).css('border-color')

    // render the event on the calendar
    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

    // is the "remove after drop" checkbox checked?
    if ($('#drop-remove').is(':checked')) {
      // if so, remove the element from the "Draggable Events" list
      $(this).remove()
    }

  },
  customButtons: {
      tambahLibur: {
          text: 'Tambah Libur',
          click: function() {
            $('#liburTambahModal').modal('show');  
          }
      }
  },
  header: {
      left: 'prev,next /*today*/ tambahLibur',
      center: 'title',
      right: 'month,agendaDay,listMonth'
  },
  eventReceive: function(event){
    alert('masuk anyar');
    //$('#calendarLibur').fullCalendar('updateEvent',event);
  },
  eventClick: function(calEvent, jsEvent, view) {
    var title = calEvent.title.split(':');
    var id_libur = title[0];
    //alert('Event: ' +id);
    
    //$('#liburEditModal').modal('show'); 
    // change the border color just for fun
    $.ajax({  
      url:"pages/fetchdata/fetch_data_libur-json.php",  
      method:"POST",  
      data:{id_libur:id_libur},  
      dataType:"json",  
      success:function(data){
          console.log(data);
           $('#id_libur').val(data.id); 
           $('#namaLiburEdit').val(data.nama_libur);
           $('#tglRentangLiburEdit').val(data.tgl1+" - "+data.tgl2); 	
           $('#liburEditModal').modal('show');  
      }  
   });
    $(this).css('border-color', 'red');
  }
})

/* ADDING EVENTS */
var currColor = '#3c8dbc' //Red by default
//Color chooser button
var colorChooser = $('#color-chooser-btn')
$('#color-chooser > li > a').click(function (e) {
  e.preventDefault()
  //Save color
  currColor = $(this).css('color')
  //Add color effect to button
  $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
})
$('#add-new-event').click(function (e) {
  e.preventDefault()
  //Get value and make sure it is not null
  var val = $('#new-event').val()
  if (val.length == 0) {
    return
  }

  //Create events
  var event = $('<div />')
  event.css({
    'background-color': currColor,
    'border-color'    : currColor,
    'color'           : '#fff'
  }).addClass('external-event')
  event.html(val)
  $('#external-events').prepend(event)

  //Add draggable funtionality
  init_events(event)

  //Remove event from text input
  $('#new-event').val('')
})  
  //END KONFIGURASI FULLCALENDAR
  // Event Ajax JS Data Libur
  $(document).on('click', '.delete_libur', function(){
       var id_libur= $(this).attr("id");
         console.log(id_libur);
        $.ajax({
              url:"pages/fetchdata/fetch_data_libur-fordelete.php",  
              method:"POST",  
              data:{id:id_libur},  
              success:function(data){
               $('#libur_detail_hapus').html(data);           
               $('#liburModal').modal("show");  
             }	
         });  
  });  
  $(document).on('click', '#buttonTambahLibur', function(){
               var namaLibur = $('#namaLiburTambah').val();
               var tglLibur = $('#tglRentangLiburTambah').val();
               if(namaLibur!=''){
                  if(tglLibur!=''){
                    $.ajax({  
                      url:"ajax-proses/tambah-libur",  
                      method:"POST",
                      data:{nama:namaLibur,tgl:tglLibur}, 
                      success:function(data){
                          console.log(data);
                          if(data!=''){
                            alert(data);
                          } else {
                            $('#calendarLibur').fullCalendar( 'refetchEvents' );
                            alert('Tambah Data Berhasil');
                            $('#liburTambahModal').modal('toggle');
                          } 
                      },
                      error: function (data) {
                          console.log(data);
                      } 
                    });
                  } else {
                    alert("Tanggal libur tidak boleh kosong!");
                  }
               } else {
                    alert("Nama libur tidak boleh kosong!");
                    $('#nama_libur').focus();
               }
    });
  $(document).on('click', '.edit_libur', function(){ 
    var id_libur = $(this).attr("id");   
               $.ajax({  
                  url:"pages/fetchdata/fetch_data_libur-json.php",  
                  method:"POST",  
                  data:{id_libur:id_libur},  
                  dataType:"json",  
                  success:function(data){
                      console.log(data);
                       $('#id_libur').val(data.id); 
                       $('#namaLiburEdit').val(data.nama_libur);
                       $('#tglRentangLiburEdit').val(data.tgl1+" - "+data.tgl2); 	
                       $('#liburEditModal').modal('show');  
                  }  
               });
    });
  // End Event Ajax JS Data Libur
    
  //KONFIGURASI TABEL

  $('#data_credits').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    "order": [[ 3, "desc" ]],
    dom: 'Bfrtip',
    buttons: [
      { extend: 'copyHtml5', footer: true },
      { extend: 'excelHtml5', footer: true },
      { extend: 'csvHtml5', footer: true },
      { extend: 'pdfHtml5', footer: true },
      { extend: 'print', footer: true }
  ]
  })
  $('#data_absen_admin').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    "order": [[ 0, "desc" ]],
    dom: 'Bfrtip',
    buttons: [
      { extend: 'copyHtml5', footer: true },
      { extend: 'excelHtml5', footer: true },
      { extend: 'csvHtml5', footer: true },
      { extend: 'pdfHtml5', footer: true },
      { extend: 'print', footer: true }
    ]
  })
  $('#data_absen').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    "order": [[ 0, "desc" ]]
  })
  $('#data_cuti').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    dom: 'Bfrtip',
    buttons: [
      { extend: 'copyHtml5', footer: true },
      { extend: 'excelHtml5', footer: true },
      { extend: 'csvHtml5', footer: true },
      { extend: 'pdfHtml5', footer: true },
      { extend: 'print', footer: true }
  ]
  })

  $('#table_jabatan').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    dom: 'Bfrtip',
    buttons: [
      { extend: 'copyHtml5', footer: true },
      { extend: 'excelHtml5', footer: true },
      { extend: 'csvHtml5', footer: true },
      { extend: 'pdfHtml5', footer: true },
      { extend: 'print', footer: true }
  ]
  })
  $('#table_rekap').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    dom: 'Bfrtip',
    buttons: [
      { extend: 'copyHtml5', footer: true },
      { extend: 'excelHtml5', footer: true },
      { extend: 'csvHtml5', footer: true },
      { extend: 'pdfHtml5', footer: true },
      { extend: 'print', footer: true }
  ],
    "order": [[ 0, "asc" ]]
  })
  //END KONFIGURASI TABEL
  
 //DATE PICKER
    $('.select2').select2()    

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd-mm-YYYY', { 'placeholder': 'dd/mm/yyyy' })
        $('[data-mask]').inputmask()

    

    $('#tglRentangLibur').daterangepicker({drops: 'up'}) 
    $('#tglRentangLibur').on('apply.daterangepicker', function(ev, picker) {
      var start= picker.startDate.format('MM/DD/YYYY');
      var end = picker.endDate.format('MM/DD/YYYY');
      var date1 = new Date(start);
      var date2 = new Date(end);
      var today= new Date();
      var timeDiff2 = date1.getTime() - today.getTime();
      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
      if (diffDays2<0) {
          alert("Tidak boleh memilih tanggal yang telah lewat");
          $('#tglRentangLibur').val('');
      }
    })
    $('#tglRentangLiburEdit').daterangepicker() 
    $('#tglRentangLiburEdit').on('apply.daterangepicker', function(ev, picker) {
      var start= picker.startDate.format('MM/DD/YYYY');
      var end = picker.endDate.format('MM/DD/YYYY');
      var date1 = new Date(start);
      var date2 = new Date(end);
      var today= new Date();
      var timeDiff2 = date1.getTime() - today.getTime();
      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
      if (diffDays2<0) {
          alert("Tidak boleh memilih tanggal yang telah lewat");
          $('#tglRentangLiburEdit').val('');
      }
    })
    $('#tglRentangLiburTambah').daterangepicker()
    $('#tglRentangLiburTambah').on('apply.daterangepicker', function(ev, picker) {
      var start= picker.startDate.format('MM/DD/YYYY');
      var end = picker.endDate.format('MM/DD/YYYY');
      var date1 = new Date(start);
      var date2 = new Date(end);
      var today= new Date();
      var timeDiff2 = date1.getTime() - today.getTime();
      var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
      if (diffDays2<0) {
          alert("Tidak boleh memilih tanggal yang telah lewat");
          $('#tglRentangLiburTambah').val('');
      }
    })
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'Y-m-d H:i:a',drops: 'up' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('Y-m-d H:i:a ') + ' s/d ' + end.format('Y-m-d H:i:a'))
      }
    )

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })

    //Date picker
    $('#start_date').datepicker({
      autoclose: true,
    })

    //Date picker
    $('#end_date').datepicker({
      autoclose: true
    })
 //END DATE PICKER
 //End Konfigurasi Tabel, DateRangePicker, Calendar
 //Kumpulan fungsi
 

/*
function convertPDF() {
  var pdf = new jsPDF('p', 'pt', 'letter');
  // source can be HTML-formatted string, or a reference
  // to an actual DOM element from which the text will be scraped.
  source = $('#generatePDF')[0];

  // we support special element handlers. Register them with jQuery-style 
  // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
  // There is no support for any other type of selectors 
  // (class, of compound) at this time.
  specialElementHandlers = {
      // element with id of "bypass" - jQuery style selector
      '#bypassme': function (element, renderer) {
          // true = "handled elsewhere, bypass text extraction"
          return true
      }
  };
  margins = {
      top: 80,
      bottom: 60,
      left: 40,
      width: 900
  };
  // all coords and widths are in jsPDF instance's declared units
  // 'inches' in this case
  pdf.fromHTML(
  source, // HTML string or DOM elem ref.
  margins.left, // x coord
  margins.top, { // y coord
      'width': margins.width, // max width of content on PDF
      'elementHandlers': specialElementHandlers
  },

  function (dispose) {
      // dispose: object with X, Y of the last line add to the PDF 
      //          this allow the insertion of new lines after html
      pdf.save('Test.pdf');
  }, margins);
}
*/
  //Chart onClick Remove
  //Endchart onClick Remove
})