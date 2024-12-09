<?php
// Memanggil library FPDF
require('C:/laragon/www/MPSI/Project-vinjhonterpal/library/fpdf181/fpdf.php');

// Koneksi database
require('C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php');
$db = new database();

// Ambil data tanggal dari form
$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];

// Query data log pengeluaran berdasarkan tanggal
$sql = "SELECT * FROM log_pengeluaran WHERE STR_TO_DATE(tanggal, '%Y-%m-%d') BETWEEN '$tgl_dari' AND '$tgl_sampai'";
$data = $db->fetchdata($sql);

// Membuat objek PDF dengan ukuran F4 (folio)
$pdf = new FPDF('P', 'mm', array(210, 330));  // Ukuran F4 (210mm x 330mm)
$pdf->AddPage();

// Header laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 7, 'VIN JHON TERPAL', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, 'Laporan Pengeluaran', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 7, 'Periode: ' . date('d-m-Y', strtotime($tgl_dari)) . ' s/d ' . date('d-m-Y', strtotime($tgl_sampai)), 0, 1, 'C');
$pdf->Ln(10);

// Header tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 8, 'No', 1, 0, 'C');
$pdf->Cell(40, 8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(40, 8, 'Kategori', 1, 0, 'C');
$pdf->Cell(50, 8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(50, 8, 'Total', 1, 1, 'C');

// Isi tabel
$pdf->SetFont('Arial', '', 10);
$no = 1;
$total_pengeluaran = 0;  // Variabel untuk menyimpan total pengeluaran
foreach ($data as $row) {
    $pdf->Cell(10, 8, $no++, 1, 0, 'C');
    $pdf->Cell(40, 8, $row['tanggal'], 1, 0, 'C'); 
    $pdf->Cell(40, 8, $row['kategori'], 1, 0, 'C');
    $pdf->Cell(50, 8, $row['keterangan'], 1, 0, 'C');
    // Menampilkan total pengeluaran
    $pdf->Cell(50, 8, 'Rp. ' . number_format($row['total'], 0, ',', '.'), 1, 1, 'R');  // Menampilkan tanpa desimal

    // Menambahkan total pengeluaran
    $total_pengeluaran += $row['total'];
}

// Menambahkan baris untuk total pengeluaran
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(140, 8, 'Total Pengeluaran ', 1, 0, 'R');
$pdf->Cell(50, 8, 'Rp. ' . number_format($total_pengeluaran, 0, ',', '.'), 1, 1, 'R');  // Total tanpa desimal

// Menentukan nama file berdasarkan tanggal
$nama_file = 'Laporan Pengeluaran Periode ' . date('d-m-Y', strtotime($tgl_dari)) . ' s/d ' . date('d-m-Y', strtotime($tgl_sampai)) . '.pdf';

// Output PDF untuk preview di browser
$pdf->Output('I', $nama_file);  // 'I' untuk preview inline

// Menyediakan link untuk download
echo '<br><br>';
echo '<a href="laporan_pdf_pengeluaran.php?tanggal_dari=' . $tgl_dari . '&tanggal_sampai=' . $tgl_sampai . '" target="_blank">Download PDF</a>';
?>
