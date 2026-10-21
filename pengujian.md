# Pengujian Mini Project Struk Kasir

## Identitas
Nama: Riansyah Damanik  
NIM: 25110120
Kelas: TK-D Siang
Versi PHP: 8.2

## Hasil Pengujian

| No | Skenario | Hasil harapan | Hasil aktual | Status |
|---|---|---|---|---|
| 1 | Data awal | Total Rp55.755 dan kembali Rp44.245 | | |
| 2 | Bayar pas | Kembalian Rp0 dan status LUNAS | | |
| 3 | Bayar Rp50.000 | Kekurangan Rp5.755 | | |
| 4 | Subtotal Rp49.999 | Diskon Rp0 dan total Rp52.499 | | |
| 5 | Subtotal Rp50.000 | Diskon Rp5.000 dan total Rp47.250 | | |
| 6 | Nama produk | Pulpen Biru | | |
| 7 | Waktu transaksi | 21/10/2026 15:30 WIB | | |
| 8 | Pemulihan data awal | Tiga produk kembali tampil | | |

## Masalah dan Perbaikan
Tuliskan masalah yang dialami dan cara memperbaikinya.

## Jawaban Pemahaman
1. Mengapa harga disimpan sebagai angka?
2. Apa kegunaan fungsi hitungSubtotal()?
3. Kapan diskon diberikan?
4. Mengapa pajak dihitung setelah diskon?
5. Apa perbedaan trim() dengan e()?
6. Mengapa pembayaran kurang tidak ditampilkan sebagai kembalian negatif?
7. Apa fungsi foreach pada index.php?

## Sumber dan Bantuan
Tuliskan sumber atau bantuan yang digunakan.