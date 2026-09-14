<?php
include "dtbase/koneksi.php";
require('fpdf/fpdf.php');

$nopinjam = $_GET['nopinjam'];

// ======================
// DATA HEADER
// ======================
$q = mysqli_query(
    $koneksi,
    "SELECT
        p.*,
        a.nama
    FROM peminjaman p
    JOIN anggota a
        ON p.noanggota = a.noanggota
    WHERE p.nopinjam='$nopinjam'"
);

$data = mysqli_fetch_assoc($q);

// ======================
// PDF
// ======================
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetMargins(15,15,15);

// Bingkai halaman
$pdf->Rect(
    10,  // x
    10,  // y
    190, // lebar (210 - 20)
    277  // tinggi (297 - 20)
);

// ======================
// KOP
// ======================
$pdf->SetFont('Arial','B',14);

$pdf->Cell(
    0,
    6,
    'PERPUSTAKAAN',
    0,
    1,
    'C'
);

$pdf->Cell(
    0,
    6,
    'SMP ISLAM TERPADU (SMP IT) BAHRUL HUDA',
    0,
    1,
    'C'
);
$pdf->SetFont('Arial','',11);
$pdf->Cell(
    0,
    6,
    'Pondok Pesantren Desa Sarang Mandi Kecamatan Sungai Selan',
    0,
    1,
    'C'
);
$pdf->Cell(
    0,
    6,
    'Kabupaten Bangka Tengah',
    0,
    1,
    'C'
);
$pdf->Line(10,35,200,35);

$pdf->Ln(10);

// ======================
// JUDUL
// ======================
$pdf->SetFont('Times','BU',14);

$pdf->Cell(
    0,
    10,
    'Bukti Peminjaman Buku',
    0,
    1,
    'C'
);

$pdf->Ln(5);

// ======================
// DATA PINJAM
// ======================
$pdf->SetFont('Times','',12);

$pdf->Cell(45,7,'Nomor Peminjaman');
$pdf->Cell(5,7,':');
$pdf->Cell(60,7,$data['nopinjam']);
$pdf->Ln();

$pdf->Cell(45,7,'Tanggal');
$pdf->Cell(5,7,':');
$pdf->Cell(
    60,
    7,
    date('d/m/Y',strtotime($data['tglpinjam']))
);
$pdf->Ln();

$pdf->Cell(45,7,'Tanggal Harus Kembali');
$pdf->Cell(5,7,':');
$pdf->Cell(
    60,
    7,
    date('d/m/Y',strtotime($data['tglharuskembali']))
);
$pdf->Ln();

$pdf->Ln(5);

$pdf->Cell(45,7,'Nomor Anggota');
$pdf->Cell(5,7,':');
$pdf->Cell(60,7,$data['noanggota']);
$pdf->Ln();

$pdf->Cell(45,7,'Nama Anggota');
$pdf->Cell(5,7,':');
$pdf->Cell(60,7,$data['nama']);
$pdf->Ln();

$pdf->Cell(45,7,'Kelas');
$pdf->Cell(5,7,':');
$pdf->Cell(60,7,$data['kelas']);
$pdf->Ln();

$pdf->Ln(10);

$pdf->SetFont('Times','B',13);

$pdf->Cell(
    0,
    8,
    'Buku-buku yang dipinjam :',
    0,
    1
);

$pdf->Ln(3);

// ======================
// TABEL
// ======================
$pdf->SetFont('Times','B',12);

$pdf->Cell(20,10,'No',1,0,'C');
$pdf->Cell(50,10,'Kode Copy Buku',1,0,'C');
$pdf->Cell(80,10,'Judul',1,0,'C');
$pdf->Cell(30,10,'Jumlah',1,1,'C');

$pdf->SetFont('Times','',12);

$qdetail = mysqli_query(
    $koneksi,
    "SELECT
        p.nocopybuku,
        p.jlhpinjam,
        b.judul
    FROM pinjam p
    JOIN copybuku c
        ON p.nocopybuku = c.kdcopybuku
    JOIN buku b
        ON c.kdbuku = b.kdbuku
    WHERE p.nopinjam='$nopinjam'"
);

$no = 1;

while($d = mysqli_fetch_assoc($qdetail)) {

    $pdf->Cell(20,10,$no++,1,0,'C');

    $pdf->Cell(
        50,
        10,
        $d['nocopybuku'],
        1,
        0,
        'C'
    );

    $pdf->Cell(
        80,
        10,
        $d['judul'],
        1,
        0
    );

    $pdf->Cell(
        30,
        10,
        $d['jlhpinjam'],
        1,
        1,
        'C'
    );
}

// ======================
// TTD
// ======================
$pdf->Ln(20);

$pdf->Cell(120);

$pdf->Cell(
    70,
    7,
    'Sarang Mandi, '.date('d/m/Y'),
    0,
    1
);

$pdf->Cell(120);

$pdf->Cell(
    70,
    7,
    'Mengetahui',
    0,
    1
);

$pdf->Cell(120);

$pdf->Cell(
    70,
    7,
    'Kepala Perpustakaan',
    0,
    1
);

$pdf->Ln(25);

$pdf->Cell(120);

$pdf->Cell(
    70,
    7,
    'Herna Fitriana, A.Md',
    0,
    1
);

$pdf->Output(
    'I',
    'Bukti_Peminjaman_'.$nopinjam.'.pdf'
);