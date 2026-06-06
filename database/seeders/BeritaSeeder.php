<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Berita::truncate();

        \App\Models\Berita::create([
            'judul' => 'Cara Meningkatkan Konsistensi Permainan Badminton',
            'slug' => \Illuminate\Support\Str::slug('Cara Meningkatkan Konsistensi Permainan Badminton'),
            'kategori' => 'Tips Bermain',
            'konten' => '
                <p>Bermain badminton di level kompetitif maupun rekreasi membutuhkan konsistensi yang luar biasa. Banyak pemain amatir yang bisa melakukan smash keras satu atau dua kali, namun kehilangan ritme di sisa pertandingan. Kunci dari permainan yang baik bukanlah tentang seberapa keras Anda memukul, tetapi seberapa stabil performa Anda dari set pertama hingga terakhir.</p>
                
                <h3>1. Perbaiki Footwork (Langkah Kaki)</h3>
                <p>Footwork adalah fondasi dari segala pukulan dalam badminton. Jika langkah kaki Anda efisien, Anda tidak perlu mengeluarkan tenaga ekstra untuk menjangkau shuttlecock. Latihlah <strong>shadow badminton</strong> setidaknya 15 menit setiap sesi latihan. Pastikan Anda selalu kembali ke posisi tengah (base camp) setelah melakukan pukulan.</p>
                
                <h3>2. Latih Kontrol Pukulan Dasar</h3>
                <p>Jangan terburu-buru melatih pukulan tipuan (trick shot) sebelum pukulan dasar Anda matang. Beberapa pukulan yang wajib Anda kuasai dengan konsisten antara lain:</p>
                <ul>
                    <li><strong>Clear / Lob:</strong> Pastikan kok melambung tinggi dan jatuh tegak lurus di garis belakang lawan.</li>
                    <li><strong>Drop Shot:</strong> Fokus pada presisi agar kok jatuh sedekat mungkin dengan net tanpa melayang terlalu lama.</li>
                    <li><strong>Netting:</strong> Latih sentuhan halus agar kok bergulir tipis di atas bibir net.</li>
                </ul>

                <h3>3. Jaga Stamina dan Fokus</h3>
                <p>Konsistensi berbanding lurus dengan stamina. Ketika fisik mulai lelah, teknik akan mulai berantakan. Rutin lakukan latihan kardio seperti jogging atau skipping. Selain itu, belajarlah mengatur napas dan fokus pada satu poin demi satu poin, alih-alih terlalu memikirkan skor akhir.</p>
                
                <p>Dengan menerapkan tiga pilar di atas secara disiplin, Anda akan melihat perubahan signifikan dalam kestabilan permainan Anda di lapangan. Selamat berlatih!</p>
            ',
            'gambar' => 'banner.jpeg',
            'tanggal_publikasi' => '2026-06-12',
            'baca_menit' => 5,
        ]);

        \App\Models\Berita::create([
            'judul' => 'Turnamen Badminton Lokal Segera Dimulai',
            'slug' => \Illuminate\Support\Str::slug('Turnamen Badminton Lokal Segera Dimulai'),
            'kategori' => 'Turnamen',
            'konten' => '
                <p>Kabar gembira bagi para penggemar dan atlet badminton lokal! Turnamen Badminton Tahunan akan segera diselenggarakan pada akhir bulan ini. Turnamen ini bertujuan untuk menjaring bakat-bakat baru sekaligus menjadi ajang silaturahmi antar komunitas pecinta bulu tangkis di kota kita.</p>
                
                <h3>Kategori Pertandingan</h3>
                <p>Turnamen kali ini akan mempertandingkan beberapa kategori, sehingga semua kalangan dapat berpartisipasi:</p>
                <ul>
                    <li>Ganda Putra (Kategori Pemula & Lanjutan)</li>
                    <li>Ganda Putri (Kategori Umum)</li>
                    <li>Ganda Campuran</li>
                </ul>
                
                <h3>Syarat dan Ketentuan Pendaftaran</h3>
                <p>Pendaftaran sudah dibuka mulai hari ini hingga dua minggu ke depan. Peserta diwajibkan mendaftar dalam kondisi sehat jasmani dan rohani. Biaya pendaftaran sudah termasuk fasilitas air minum, shuttlecock standar turnamen, serta P3K dasar di lapangan.</p>
                
                <p>Total hadiah puluhan juta rupiah beserta trofi dan medali telah disiapkan untuk para juara. Jangan lewatkan kesempatan emas ini untuk menguji kemampuan Anda dan meraih prestasi di tingkat lokal. Segera daftarkan tim Anda ke meja administrasi kami!</p>
            ',
            'gambar' => 'berita1.jpeg', 
            'tanggal_publikasi' => '2026-06-10',
            'baca_menit' => 3,
        ]);

        \App\Models\Berita::create([
            'judul' => 'Tips Memilih Raket Berdasarkan Gaya Bermain',
            'slug' => \Illuminate\Support\Str::slug('Tips Memilih Raket Berdasarkan Gaya Bermain'),
            'kategori' => 'Tips Bermain',
            'konten' => '
                <p>Sering kali pemain merasa permainannya tidak berkembang, padahal masalahnya mungkin ada pada peralatan yang digunakan. Raket badminton bukan sekadar alat pukul; ia adalah ekstensi dari lengan Anda. Memilih raket yang salah bisa mengakibatkan cedera bahu atau pergelangan tangan, serta mengurangi potensi pukulan Anda.</p>
                
                <h3>1. Head-Heavy (Berat di Kepala)</h3>
                <p>Raket jenis ini sangat cocok bagi Anda yang berposisi sebagai penyerang (attacker) di garis belakang. Bobot ekstra di bagian frame membantu menghasilkan momentum ayunan yang lebih besar, sehingga pukulan smash akan terasa lebih tajam dan bertenaga. Namun, kekurangannya adalah kurang lincah untuk bermain di area depan (netting).</p>
                
                <h3>2. Head-Light (Ringan di Kepala)</h3>
                <p>Berbanding terbalik dengan head-heavy, raket ini didesain untuk para pemain ganda yang mengandalkan kecepatan refleks dan permainan net. Raket ini sangat mudah diarahkan dan digerakkan dengan cepat, membuatnya ideal untuk melakukan drive cepat atau pertahanan (defense) dari gempuran smash lawan.</p>

                <h3>3. Even-Balance (Seimbang)</h3>
                <p>Jika Anda bermain tunggal atau Anda adalah pemain bertipe <em>all-around</em> yang memadukan serangan dan pertahanan secara seimbang, ini adalah pilihan paling aman. Anda mendapatkan kekuatan smash yang cukup tanpa terlalu mengorbankan kecepatan ayunan untuk bertahan.</p>
            ',
            'gambar' => 'berita2.jpeg',
            'tanggal_publikasi' => '2026-06-08',
            'baca_menit' => 4,
        ]);

        \App\Models\Berita::create([
            'judul' => 'Manfaat Bermain Badminton Bagi Kesehatan Jantung',
            'slug' => \Illuminate\Support\Str::slug('Manfaat Bermain Badminton Bagi Kesehatan Jantung'),
            'kategori' => 'Kesehatan',
            'konten' => '
                <p>Banyak orang bermain badminton sekadar untuk mencari keringat atau bersosialisasi. Namun tahukah Anda bahwa olahraga ini memiliki dampak yang luar biasa bagi kesehatan kardiovaskular Anda?</p>
                
                <h3>1. Menurunkan Risiko Penyakit Jantung</h3>
                <p>Bermain badminton secara rutin dapat meningkatkan sirkulasi darah dan menurunkan kadar kolesterol jahat (LDL). Gerakan dinamis dan konstan saat mengejar shuttlecock memaksa otot jantung untuk bekerja memompa darah lebih efisien.</p>

                <h3>2. Membakar Kalori Secara Signifikan</h3>
                <p>Dalam satu jam permainan dengan intensitas sedang, seorang dewasa dapat membakar hingga 450 kalori. Ini menjadikan badminton salah satu olahraga paling efektif untuk menjaga berat badan ideal, yang mana sangat berkaitan dengan kesehatan jantung.</p>

                <h3>3. Mengurangi Stres</h3>
                <p>Hormon endorfin yang dilepaskan saat Anda berhasil memukul bola atau memenangkan reli panjang sangat ampuh untuk mengusir stres. Ingat, tingkat stres yang rendah adalah kunci dari jantung yang sehat dan umur panjang!</p>
            ',
            'gambar' => 'berita3.jpeg',
            'tanggal_publikasi' => '2026-06-05',
            'baca_menit' => 4,
        ]);

        \App\Models\Berita::create([
            'judul' => 'Agenda Open Play Komunitas Minggu Ini',
            'slug' => \Illuminate\Support\Str::slug('Agenda Open Play Komunitas Minggu Ini'),
            'kategori' => 'Komunitas',
            'konten' => '
                <p>Halo sobat tepok bulu! Akhir pekan ini komunitas kita akan kembali mengadakan sesi <em>Open Play</em> (Mabar - Main Bareng) yang terbuka untuk semua level kemampuan, mulai dari pemula hingga <em>advance</em>.</p>
                
                <h3>Jadwal dan Lokasi</h3>
                <ul>
                    <li><strong>Hari/Tanggal:</strong> Sabtu, 13 Juni 2026</li>
                    <li><strong>Waktu:</strong> 18.00 - 22.00 WIB</li>
                    <li><strong>Lokasi:</strong> GOR Badminton Utama (Lapangan 1, 2, dan 3)</li>
                </ul>

                <h3>Sistem Permainan</h3>
                <p>Sistem akan menggunakan papan antrean bergilir. Pemain akan dipasangkan secara acak agar bisa saling mengenal. Shuttlecock sudah disediakan oleh panitia, jadi Anda hanya perlu membawa raket pribadi, sepatu *indoor*, dan baju ganti.</p>
                
                <p>Mari ramaikan GOR dan jadikan momen ini untuk memperluas jaringan pertemanan sesama pecinta badminton. Pendaftaran bisa langsung dilakukan di tempat (on the spot) sebelum jam 19.00 WIB.</p>
            ',
            'gambar' => 'berita4.jpeg',
            'tanggal_publikasi' => '2026-06-02',
            'baca_menit' => 3,
        ]);

        \App\Models\Berita::create([
            'judul' => 'Cara Merawat Sepatu Badminton Agar Awet',
            'slug' => \Illuminate\Support\Str::slug('Cara Merawat Sepatu Badminton Agar Awet'),
            'kategori' => 'Tips & Trik',
            'konten' => '
                <p>Sepatu adalah "senjata" terpenting kedua setelah raket. Sepatu yang baik dapat mencegah cedera ankle dan memberikan cengkeraman maksimal. Namun, jika tidak dirawat dengan benar, sol karet sepatu bisa cepat aus atau mengeras.</p>
                
                <h3>1. Gunakan Hanya di Lapangan Indoor</h3>
                <p>Ini adalah aturan emas! Jangan pernah menggunakan sepatu badminton Anda untuk berjalan di aspal, konblok, atau tanah. Debu, pasir, dan permukaan kasar akan langsung merusak pola karet *outsole* yang bertugas menjaga cengkeraman (grip).</p>

                <h3>2. Keringkan dengan Angin (Air Dry)</h3>
                <p>Setelah dipakai bermain, sepatu pasti basah oleh keringat. Jangan menjemurnya langsung di bawah terik matahari karena akan merusak lem dan membuat bahan kulit sintetisnya pecah-pecah. Cukup diangin-anginkan di tempat teduh atau letakkan koran bekas di dalamnya untuk menyerap kelembaban.</p>

                <h3>3. Bersihkan Sol Secara Rutin</h3>
                <p>Sesekali, seka bagian sol karet bawah dengan lap basah atau spons khusus untuk menghilangkan debu halus yang menempel. Debu adalah musuh utama sol sepatu, karena membuat sepatu menjadi sangat licin saat digunakan di lapangan karpet atau kayu.</p>
            ',
            'gambar' => 'berita1.jpeg',
            'tanggal_publikasi' => '2026-05-28',
            'baca_menit' => 5,
        ]);
    }
}
