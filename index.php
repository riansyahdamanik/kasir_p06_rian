<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

$data = require __DIR__ . '/data.php';

$keranjang = $data['keranjang'];

$ringkasan = ringkasanTransaksi(
    $keranjang,
    $data['bayar']
);

$waktu = new DateTimeImmutable(
    $data['waktu'],
    new DateTimeZone('Asia/Jakarta')
);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Struk Kasir - Praktikum 6</title>

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<main class="halaman">

    <header class="judul">
        <p>PEMROGRAMAN WEB II / PERTEMUAN 6</p>
        <h1>Struk Kasir</h1>
        <p>Mini project pengolahan data transaksi dengan PHP.</p>
    </header>

    <article class="struk">

        <header class="toko">
            <span class="label">SIMULASI PRAKTIKUM</span>

            <h2><?= e($data['toko']) ?></h2>

            <p><?= e($data['alamat']) ?></p>
        </header>

        <section class="informasi">
            <p>
                <span>No. transaksi</span>
                <strong><?= e($data['nomor']) ?></strong>
            </p>

            <p>
                <span>Waktu</span>
                <strong>
                    <?= e($waktu->format('d/m/Y H:i')) ?> WIB
                </strong>
            </p>

            <p>
                <span>Kasir</span>
                <strong><?= e($data['kasir']) ?></strong>
            </p>

            <p>
                <span>Pelanggan</span>
                <strong><?= e($data['pelanggan']) ?></strong>
            </p>
        </section>

        <div class="tabel-bungkus">
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($keranjang as $item): ?>
                        <tr>
                            <td>
                                <strong>
                                    <?= e(rapikanNama($item['nama'])) ?>
                                </strong>

                                <small>
                                    <?= e(rapikanKode($item['kode'])) ?>
                                </small>
                            </td>

                            <td>
                                <?= e(rupiah($item['harga'])) ?>
                            </td>

                            <td>
                                <?= e((string) $item['jumlah']) ?>
                            </td>

                            <td>
                                <?= e(rupiah(
                                    hitungSubtotal(
                                        $item['harga'],
                                        $item['jumlah']
                                    )
                                )) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <section class="ringkasan">
            <p>
                <span>Jumlah unit</span>
                <strong>
                    <?= e((string) $ringkasan['jumlah_unit']) ?>
                </strong>
            </p>

            <p>
                <span>Subtotal belanja</span>
                <strong>
                    <?= e(rupiah($ringkasan['subtotal'])) ?>
                </strong>
            </p>

            <p>
                <span>Diskon</span>
                <strong>
                    -<?= e(rupiah($ringkasan['diskon'])) ?>
                </strong>
            </p>

            <p>
                <span>Setelah diskon</span>
                <strong>
                    <?= e(rupiah($ringkasan['dasar_pajak'])) ?>
                </strong>
            </p>

            <p>
                <span>Pajak simulasi 5%</span>
                <strong>
                    <?= e(rupiah($ringkasan['pajak'])) ?>
                </strong>
            </p>

            <p class="total">
                <span>Total bayar</span>
                <strong>
                    <?= e(rupiah($ringkasan['total'])) ?>
                </strong>
            </p>

            <p>
                <span>Uang diterima</span>
                <strong>
                    <?= e(rupiah($ringkasan['bayar'])) ?>
                </strong>
            </p>

            <?php if ($ringkasan['lunas']): ?>
                <p>
                    <span>Kembalian</span>
                    <strong>
                        <?= e(rupiah($ringkasan['kembalian'])) ?>
                    </strong>
                </p>

                <div class="status lunas">
                    LUNAS
                </div>
            <?php else: ?>
                <p>
                    <span>Kekurangan</span>
                    <strong>
                        <?= e(rupiah($ringkasan['kekurangan'])) ?>
                    </strong>
                </p>

                <div class="status kurang">
                    PEMBAYARAN KURANG
                </div>
            <?php endif; ?>
        </section>

        <footer class="catatan">
            <p>Diskon 10% untuk subtotal minimal Rp50.000.</p>
            <p>Pajak simulasi dihitung setelah diskon.</p>
            <p>Terima kasih. Simpan struk sebagai bukti praktikum.</p>
        </footer>

    </article>

    <div class="aksi">
        <button type="button" onclick="window.print()">
            Cetak / Simpan PDF
        </button>
    </div>

</main>

</body>
</html>