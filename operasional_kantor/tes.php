<script>
			var status = <?php echo $status?>;
			var tglskrg = new Date();
			var wa_msg;
			
			switch (status) {
				case "1":
					var wa_msg = "HADIR"+ "\n"+"---"+ "\n"+"Saya,<?php echo $nama?> sudah hadir dikantor pada hari ini pukul "+tglskrg.getHours()+":"+tglskrg.getMinutes();
					break;
				case "2":
					var wa_msg = "HADIR DILUAR"+ "\n"+"Saya,<?php echo $nama?> sedang bertugas diluar kantor pada hari ini mulai pukul "+tglskrg.getHours()+":"+tglskrg.getMinutes()+" untuk keperluan <?php echo $keterangan?>\n<?php echo $url_location?>";
					break;
				case "3":
					var wa_msg = "SAKIT"+ "\n"+"Saya, <?php echo $nama?> mohon izin pada hari ini tidak bisa masuk kerja karena <?php echo $keterangan?>. Mohon doanya ya agar saya lekas sembuh. Amin\n<?php echo $url_location?>";
					break;
				case "4":
					//var tglcoba="<?php echo $tgl_awal_izin?>";
					//console.log(tglcoba);
					var date1 = new Date("<?php echo $tgl_awal_izin?>");
					var date2 = new Date("<?php echo $tgl_akhir_izin?>");
					var timeDiff = Math.abs(date2.getTime() - date1.getTime());
					var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
					if (diffDays==0) {
						var wa_msg = "IZIN"+ "\n"+"Saya, <?php echo $nama?> mohon izin pada hari ini tidak bisa masuk kerja karena <?php echo $keterangan?>.\n<?php echo $url_location?>";
					} else {
						var wa_msg = "IZIN"+ "\n"+"Saya, <?php echo $nama?> mohon izin pada hari ini sampai <?php echo $tgl_akhir_izin?> tidak bisa masuk kerja karena <?php echo $keterangan?>.\n<?php echo $url_location?>";
					}
					break;
				case "5":
				var wa_msg = "CUTI"+ "\n"+"Saya,<?php echo $nama?> mohon izin cuti dari tanggal <?php echo $tgl_awal_cuti?> sampai <?php echo $tgl_akhir_cuti?> karena <?php echo $keterangan?>.Sisa cuti saya tahun "+tglskrg.getFullYear()+" ini <?php echo $_SESSION['sisacuti']?> hari \n<?php echo $url_location?>";
					break;
				default:
					break;
			}
			var wa_msg = window.encodeURIComponent(wa_msg);
			var wa_absen = "whatsapp://send?text="+wa_msg;
			console.log( wa_absen);
			bootbox.confirm({
					message: "<?php echo '<h4>' ?>Absen Berhasil. <?php echo '<br><br>' ?> Yuk share ke Whatsapp untuk absensi anda hari ini <?php echo '</h4><br><h3>' ?>  Share Sekarang? <?php echo '</h3>'?>",
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
				console.log('This was logged in the callback: ' + result)
				if (result){
					window.location=wa_absen
						bootbox.alert({ 
						size: "small",
						message: "<?php echo '<h4>' ?>Terimakasih telah melakukan absen<?php echo '</h4>'?>", 
						callback: function(){window.location="../../index.php?sidebar-menu=list_data_absensi&action=tampil" }
					})
				} else {
					window.location="../../index.php?sidebar-menu=list_data_absensi&action=tampil"
				}
			}
		});

    </script>