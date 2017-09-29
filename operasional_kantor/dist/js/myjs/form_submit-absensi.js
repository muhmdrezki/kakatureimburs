//Validasi isi keterangan jika tidak hadir dikantor
/**var x = document.getElementById("statushadir");
function checkStatusHadir() {
    if (x.value != "1") {
        document.getElementById("keterangan_absen").setAttribute("data-validation", "required");
        document.getElementById("keterangan_absen").setAttribute("data-validation-error-msg", "Keterangan wajid diisi jika tidak hadir dikantor!");
    } else {
        document.getElementById("keterangan_absen").setAttribute("data-validation", "");
        document.getElementById("keterangan_absen").setAttribute("data-validation-error-msg", "");
    }
}**/
// End Validasi isi keterangan jika tidak hadir dikantor

//Proses Ambil Latitude & Longitude
var y = document.getElementById("nonsupport");
function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getPosition);
    } else {
        y.innerHTML = "Geolocation is not supported by this browser.";
    }
}
var latitude = document.getElementById("latitude");
var longitude = document.getElementById("longitude");
function getPosition(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    var API_KEY = 'AIzaSyAn0sCC7HGqbJbWhwkgJnvyWFiTa7QGtVI';
    $.ajax({
        url: 'pages/forms/getadress.php',
        type: 'post',
        data: {
            latitude: lat,
            longitude: lng
        },
        dataType: 'json',
        success: function (response) {
            console.log(response);
            console.log('address', response.address);
            ///tes
            $('#latitude').val(response.latitude);
            $('#longitude').val(response.longitude);
            //$('#address').val(response.address);
            //tes
            $('#address_hadirdiluar').val(response.address);
            $('#address_sakit').val(response.address);
            $('#address_izin').val(response.address);
            $('#address_cuti').val(response.address);
            //gambar lokasi
            //var src = 'http://maps.googleapis.com/maps/api/staticmap?center=' + lat + ',' + lng + '&markers=size:midcolor:red|label:|' + lat + ',' + lng + '&zoom=17&size=600x400&key=' + API_KEY;
            //$('#img-location').attr("src", src);
        },
        error: function (response) {
            console.log(response);

        }
    });

}
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

