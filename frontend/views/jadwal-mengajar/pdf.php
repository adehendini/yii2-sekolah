<h1>Jadwal Mengajar</h1>

<table class="table table-bordered">
	<tr>
		<th>No</th>
		<th>Hari</th>
		<th>Mata Pelajaran</th>
		<th>Kelas</th>
		<th>Waktu</th>
	</tr>
<?php $no=1; ?>	
<?php foreach ($model as $jadwal) : ?>
	<tr>
		<td><?= $no ?></td>
		<td><?= $jadwal->hari ?></td>
		<td><?= $jadwal->mata_pelajaran ?></td>
		<td><?= $jadwal->kelas ?></td>
		<td><?= substr($jadwal->jam_mulai,0,5).' - '.substr($jadwal->jam_selesai,0,5) ?></td>
	</tr>
	<?php $no++; ?>	
<?php endforeach; ?>
</table>

