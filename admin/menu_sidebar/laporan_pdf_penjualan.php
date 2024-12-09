<?php
// Memanggil library FPDF
require('C:/laragon/www/MPSI/Project-vinjhonterpal/library/fpdf181/fpdf.php');

// Koneksi database
require('C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php');
$db = new database();

// Ambil data tanggal dari form
$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];

// Query data log penjualan berdasarkan tanggal
$sql = "SELECT * FROM log_penjualan WHERE STR_TO_DATE(tanggal, '%Y-%m-%d') BETWEEN '$tgl_dari' AND '$tgl_sampai'";
$data = $db->fetchdata($sql);

// Membuat objek PDF dengan ukuran F4 (folio)
$pdf = new FPDF('P', 'mm', array(210, 330));  // Ukuran F4 (210mm x 330mm)
$pdf->AddPage();

// Header laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 7, 'VIN JHON TERPAL', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, 'Laporan Penjualan', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 7, 'Periode: ' . date('d-m-Y', strtotime($tgl_dari)) . ' s/d ' . date('d-m-Y', strtotime($tgl_sampai)), 0, 1, 'C');
$pdf->Ln(10);

// Header tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 8, 'No', 1, 0, 'C');
$pdf->Cell(30, 8, 'Tanggal', 1, 0, 'C');  // Kolom tanggal dipersempit
$pdf->Cell(30, 8, 'Kategori', 1, 0, 'C');
$pdf->Cell(45, 8, 'Produk', 1, 0, 'C');
$pdf->Cell(30, 8, 'Ukuran', 1, 0, 'C');
$pdf->Cell(15, 8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(35, 8, 'Sub Total', 1, 1, 'C');

// Isi tabel
$pdf->SetFont('Arial', '', 10);
$no = 1;
$total_pendapatan = 0;  // Variabel untuk menyimpan total pendapatan
foreach ($data as $row) {
    $pdf->Cell(10, 8, $no++, 1, 0, 'C');
    $pdf->Cell(30, 8, $row['tanggal'], 1, 0, 'C');  // Kolom tanggal lebih sempit
    $pdf->Cell(30, 8, $row['kategori'], 1, 0, 'C');
    $pdf->Cell(45, 8, $row['produk'], 1, 0, 'C');
    $pdf->Cell(30, 8, $row['ukuran'], 1, 0, 'C');
    $pdf->Cell(15, 8, $row['jumlah'], 1, 0, 'C');
    // Menggunakan number_format dengan nol desimal
    $pdf->Cell(35, 8, 'Rp. ' . number_format($row['total'], 0, ',', '.'), 1, 1, 'R');  // Menampilkan tanpa desimal

    // Menambahkan total pendapatan
    $total_pendapatan += $row['total'];
}

// Menambahkan baris untuk total pendapatan
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(160, 8, 'Total Pendapatan ', 1, 0, 'R');
$pdf->Cell(35, 8, 'Rp. ' . number_format($total_pendapatan, 0, ',', '.'), 1, 1, 'R');  // Total tanpa desimal

// Menentukan nama file berdasarkan tanggal
$nama_file = 'Laporan Penjualan Periode ' . date('d-m-Y', strtotime($tgl_dari)) . ' s/d ' . date('d-m-Y', strtotime($tgl_sampai)) . '.pdf';

// Output PDF untuk preview di browser
$pdf->Output('I', $nama_file);  // 'I' untuk preview inline

// Tambahkan tombol download di halaman web untuk mengunduh
echo '<br><br>';
echo '<a href="laporan_pdf_penjualan.php?tanggal_dari=' . $tgl_dari . '&tanggal_sampai=' . $tgl_sampai . '" target="_blank">Download PDF</a>';
?>
