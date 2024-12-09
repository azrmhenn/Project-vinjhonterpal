<?php
require('C:/laragon/www/MPSI/Project-vinjhonterpal/library/fpdf181/fpdf.php');
require('C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php');

$db = new database();

// Ambil data tanggal dan ID pegawai dari URL
$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];
$id_pegawai = $_GET['id_pegawai'];

// Query data pengambilan gaji untuk pegawai tertentu berdasarkan id_pegawai
$sql = "SELECT tpg.id_pengambilan, tpos.nama_posisi, tp.nama_pegawai, tpg.tanggal_pengambilan, 
                 FLOOR(total_jam_kerja / 9) AS total_hari_kerja, 
                 tpg.total_jam_lembur, 
                 tpg.total_gaji
          FROM tb_pengambilan_gaji tpg
          JOIN tb_pegawai tp ON tp.id_pegawai = tpg.id_pegawai
          JOIN tb_posisi tpos ON tpos.id_posisi = tp.id_posisi
          WHERE tp.id_pegawai = '$id_pegawai'
            AND tpg.tanggal_pengambilan BETWEEN '$tgl_dari' AND '$tgl_sampai'";

$data = $db->fetchdata($sql);

// Pastikan ada data
if (empty($data)) {
    die("Data tidak ditemukan!");
}

// Mengambil data pegawai
$row = $data[0];

// Membuat objek PDF dengan ukuran struk (80 mm x panjang dinamis)
$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();

// Header laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(60, 5, 'VIN JHON TERPAL', 0, 1, 'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(60, 5, 'SLIP GAJI', 0, 1, 'C');
$pdf->Cell(60, 5, '------------------------------------------------------', 0, 1, 'C');
$pdf->Ln(5);

// Informasi Pegawai dengan perataan titik dua yang konsisten
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 5, 'Nama', 0, 0); 
$pdf->Cell(50, 5, ': ' . $row['nama_pegawai'], 0, 1);
$pdf->Cell(30, 5, 'Posisi', 0, 0);
$pdf->Cell(50, 5, ': ' . $row['nama_posisi'], 0, 1);
$pdf->Ln(5);

// Detail Gaji dengan perataan titik dua yang konsisten
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(30, 5, 'Tanggal', 0, 0);
$pdf->Cell(50, 5, ': ' . date('d/m/Y', strtotime($row['tanggal_pengambilan'])), 0, 1);
$pdf->Cell(30, 5, 'Hari Kerja', 0, 0);
$pdf->Cell(50, 5, ': ' . $row['total_hari_kerja'] . ' Hari', 0, 1);
$pdf->Cell(30, 5, 'Jam Lembur', 0, 0);
$pdf->Cell(50, 5, ': ' . $row['total_jam_lembur'] . ' Jam', 0, 1);
$pdf->Cell(30, 5, 'Total Gaji', 0, 0);
$pdf->Cell(50, 5, ': Rp ' . number_format($row['total_gaji'], 0, ',', '.'), 0, 1);
$pdf->Ln(5);

// Footer
$pdf->Cell(60, 5, '----------------------Terima Kasih----------------------', 0, 1, 'C');
$pdf->SetFont('Arial', 'I', 12);

// Nama file berdasarkan nama pegawai dan periode
$nama_file = 'Slip_Gaji_' . str_replace(' ', '_', $row['nama_pegawai']) . '_Periode_' . date('d-m-Y', strtotime($tgl_dari)) . '_s_d_' . date('d-m-Y', strtotime($tgl_sampai)) . '.pdf';

// Output PDF
$pdf->Output('I', $nama_file);
?>
