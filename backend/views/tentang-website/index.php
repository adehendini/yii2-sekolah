<h2><?= $title ?></h2>
Website ini merupakan aplikasi Sistem Informasi Akademik Sederhana

<ul>
<?php
foreach ($list as $ls) {
	echo "<li>".$ls['halaman']." : ".$ls['deskripsi']."</li>";
}
?>
</ul>

