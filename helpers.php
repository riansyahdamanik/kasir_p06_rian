<?php
declare(strict_types=1);

function e(string $teks): string
{
    return htmlspecialchars(
        $teks,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

function rupiah(int $nilai): string
{
    return 'Rp' . number_format($nilai, 0, ',', '.');
}

function rapikanKode(string $kode): string
{
    return strtoupper(trim($kode));
}

function rapikanNama(string $nama): string
{
    return ucwords(strtolower(trim($nama)));
}

function hitungSubtotal(int $harga, int $jumlah): int
{
    return $harga * $jumlah;
}

function hitungDiskon(int $subtotal): int
{
    return $subtotal >= 50000
        ? (int) round(
            $subtotal * 10 / 100,
            0,
            PHP_ROUND_HALF_UP
        )
        : 0;
}

function hitungPajak(int $dasarPajak): int
{
    return (int) round(
        $dasarPajak * 5 / 100,
        0,
        PHP_ROUND_HALF_UP
    );
}

function ringkasanTransaksi(array $keranjang, int $bayar): array
{
    $subtotal = 0;
    $jumlahUnit = 0;

    foreach ($keranjang as $item) {
        $subtotal += hitungSubtotal(
            $item['harga'],
            $item['jumlah']
        );

        $jumlahUnit += $item['jumlah'];
    }

    $diskon = hitungDiskon($subtotal);
    $dasarPajak = $subtotal - $diskon;
    $pajak = hitungPajak($dasarPajak);
    $total = $dasarPajak + $pajak;

    return [
        'subtotal' => $subtotal,
        'jumlah_unit' => $jumlahUnit,
        'diskon' => $diskon,
        'dasar_pajak' => $dasarPajak,
        'pajak' => $pajak,
        'total' => $total,
        'bayar' => $bayar,
        'kembalian' => max(0, $bayar - $total),
        'kekurangan' => max(0, $total - $bayar),
        'lunas' => $bayar >= $total,
    ];
}