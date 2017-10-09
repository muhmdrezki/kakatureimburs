SELECT id_anggota,(SELECT COUNT(status_id) FROM tb_detail_absen WHERE b.status_id=1) AS jumhadir,c.total_credit FROM tb_anggota a JOIN tb_detail_absen b ON a.id_anggota=b.id_anggota JOIN tb_credits_anggota c ON a.id_anggota=c.id_anggota GROUP BY b.id_anggota;
//Benar
SELECT id_anggota, COUNT(id_anggota) FROM tb_detail_absen WHERE status_id=1 OR status_id=2 GROUP BY id_anggota;
SELECT id_anggota, (SELECT COUNT(id_anggota) FROM tb_detail_absen WHERE status_id=1 OR status_id=2) AS jumhadir GROUP BY id_anggota;
SELECT id_anggota, COUNT(CASE WHEN "status_id" = 1 THEN "status_id" END) AS jumhadir FROM tb_detail_absen GROUP BY id_anggota;
SELECT id_anggota, (SELECT COUNT(status_id) FROM tb_detail_absen WHERE status_id=1) AS jumhadir FROM tb_detail_absen GROUP BY id_anggota;

//paling bener
SELECT id_anggota,COUNT(CASE WHEN status_id = 1 THEN 1 ELSE NULL END) AS jumhadir,COUNT(CASE WHEN status_id = 3 THEN 1 ELSE NULL END) AS jumsakit FROM tb_detail_absen GROUP BY id_anggota;
SELECT id_anggota,COUNT(CASE WHEN status_id = 1 OR status_id=2 THEN 1 ELSE NULL END) AS jumhadir,COUNT(CASE WHEN status_id = 3 THEN 1 ELSE NULL END) AS jumsakit,COUNT(CASE WHEN status_id = 4 THEN 1 ELSE NULL END) AS jumizin,COUNT(CASE WHEN status_id = 5 THEN 1 ELSE NULL END) AS jumcuti,COUNT(CASE WHEN status_id = 6 THEN 1 ELSE NULL END) AS jumalpha FROM tb_detail_absen GROUP BY id_anggota;

100% Benar
SELECT a.id_anggota,b.nama,COUNT(CASE WHEN a.status_id = 1 OR a.status_id=2 THEN 1 ELSE NULL END) AS jumhadir,COUNT(CASE WHEN a.status_id = 3 THEN 1 ELSE NULL END) AS jumsakit,COUNT(CASE WHEN a.status_id = 4 THEN 1 ELSE NULL END) AS jumizin,COUNT(CASE WHEN a.status_id = 5 THEN 1 ELSE NULL END) AS jumcuti,COUNT(CASE WHEN a.status_id = 6 THEN 1 ELSE NULL END) AS jumalpha,c.total_credit FROM tb_detail_absen a JOIN tb_anggota b ON a.id_anggota=b.id_anggota JOIN tb_credits_anggota c ON a.id_anggota=c.id_anggota  GROUP BY id_anggota;

SELECT COUNT(CASE WHEN a.status_id = 1 OR a.status_id=2 THEN 1 ELSE NULL END) AS jumhadir,COUNT(CASE WHEN a.status_id = 3 THEN 1 ELSE NULL END) AS jumsakit,COUNT(CASE WHEN a.status_id = 4 THEN 1 ELSE NULL END) AS jumizin,COUNT(CASE WHEN a.status_id = 5 THEN 1 ELSE NULL END) AS jumcuti,COUNT(CASE WHEN a.status_id = 6 THEN 1 ELSE NULL END) AS jumalpha, (SELECT SUM(total_credit) FROM tb_credits_anggota) AS totcret FROM tb_detail_absen a