<?php
$bold = ['font' => ['bold'=>true]];
$border = ['borders' => [
            	'allborders'=>[
            		'style' => \PHPExcel_Style_Border::BORDER_THIN,
            ]]];
$phpexcel->getActiveSheet()->getStyle('A2:A3')->applyFromArray($bold);
$phpexcel->setActiveSheetIndex(0)->setCellValue('A2', 'DATA KELAS '.$kelas->kelas);
$phpexcel->setActiveSheetIndex(0)->setCellValue('A3', 'WALI KELAS : '.$kelas->guru->nama);

$phpexcel->getActiveSheet()->getStyle('A5:C5')->applyFromArray($bold);
$phpexcel->setActiveSheetIndex(0)->setCellValue('A5', 'No');
$phpexcel->setActiveSheetIndex(0)->setCellValue('B5', 'NISN');
$phpexcel->setActiveSheetIndex(0)->setCellValue('C5', 'Nama');

$no=1;
$baris = 6;
foreach ($siswa as $data) 
{
	$phpexcel->setActiveSheetIndex(0)->setCellValue('A'.$baris, $no);
	$phpexcel->setActiveSheetIndex(0)->setCellValue('B'.$baris, $data->siswa->nisn);
	$phpexcel->setActiveSheetIndex(0)->setCellValue('C'.$baris, $data->siswa->nama);
	$no++;
	$baris++;
}
$jml_baris=$baris-1;
$phpexcel->getActiveSheet()->getStyle('A5:C'.$jml_baris)->applyFromArray($border);

