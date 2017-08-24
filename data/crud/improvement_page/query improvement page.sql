select h.judul_konten_artikel,b.judul_artikel,c.subkategori_nama,d.nama_kategori,a.tanggal_sunting,f.username,g.approvestatus_name
from app_updateartikel_konten a
left join app_artikelkonten h on a.artikel_konten_id=h.artikel_konten_id
left join app_artikel b on h.artikel_id=b.artikel_id
left join app_subkategori c on b.subkategori_id=c.subkategori_id
left join app_kategori d on b.kategori_id=d.kategori_id
left join sys_users f on a.user_id=f.userid
left join app_approve_status g on  g.approvestatus_id=a.approvestatus_id