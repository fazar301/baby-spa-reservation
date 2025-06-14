<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate the table
        DB::table('artikels')->truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Get admin user for author
        $admin = User::where('email', 'admin@latumi.com')->first();
        if (!$admin) {
            $admin = User::first();
        }

        // Get all categories
        $kategoris = KategoriArtikel::all();

        $artikels = [
            [
                'judul' => 'Tahapan Perkembangan Bayi 0-6 Bulan',
                'konten' => '<p>Perkembangan bayi pada usia 0-6 bulan merupakan periode yang sangat penting dalam kehidupan seorang anak. Pada masa ini, bayi mengalami berbagai perubahan fisik dan mental yang signifikan.</p><p>Beberapa tahapan perkembangan yang perlu diperhatikan:</p><ul><li>0-1 bulan: Mulai bisa mengangkat kepala</li><li>2-3 bulan: Mulai bisa tersenyum dan mengoceh</li><li>4-6 bulan: Mulai bisa berguling dan duduk dengan bantuan</li></ul>',
                'meta_description' => 'Panduan lengkap tentang tahapan perkembangan bayi dari usia 0-6 bulan, termasuk perkembangan fisik dan mental.',
                'meta_keywords' => 'perkembangan bayi, bayi 0-6 bulan, tahapan perkembangan',
                'status' => 'published',
                'published_at' => now(),
                'kategori_id' => $kategoris->where('slug', 'perkembangan-bayi')->first()->id,
            ],
            [
                'judul' => 'Tips Memandikan Bayi yang Benar',
                'konten' => '<p>Memandikan bayi merupakan aktivitas penting dalam perawatan bayi yang perlu dilakukan dengan hati-hati dan benar.</p><p>Berikut tips memandikan bayi:</p><ul><li>Siapkan semua perlengkapan mandi</li><li>Pastikan suhu air hangat (32-37°C)</li><li>Gunakan sabun khusus bayi</li><li>Jaga kepala bayi tetap kering</li></ul>',
                'meta_description' => 'Panduan lengkap cara memandikan bayi yang aman dan nyaman, termasuk persiapan dan langkah-langkah yang benar.',
                'meta_keywords' => 'memandikan bayi, perawatan bayi, tips bayi',
                'status' => 'published',
                'published_at' => now(),
                'kategori_id' => $kategoris->where('slug', 'perawatan-bayi')->first()->id,
            ],
            [
                'judul' => 'Manfaat Terapi Air untuk Bayi',
                'konten' => '<p>Terapi air atau water therapy memiliki banyak manfaat untuk perkembangan bayi. Aktivitas ini tidak hanya menyenangkan tapi juga bermanfaat untuk kesehatan.</p><p>Manfaat terapi air:</p><ul><li>Meningkatkan kekuatan otot</li><li>Melatih koordinasi tubuh</li><li>Meningkatkan kepercayaan diri</li><li>Membantu tidur lebih nyenyak</li></ul>',
                'meta_description' => 'Informasi lengkap tentang manfaat terapi air untuk bayi dan cara melakukannya dengan aman.',
                'meta_keywords' => 'terapi air, water therapy, bayi, manfaat terapi air',
                'status' => 'published',
                'published_at' => now(),
                'kategori_id' => $kategoris->where('slug', 'terapi-air')->first()->id,
            ],
            [
                'judul' => 'Panduan MPASI untuk Bayi 6 Bulan',
                'konten' => '<p>MPASI (Makanan Pendamping ASI) merupakan tahapan penting dalam pemenuhan nutrisi bayi. Berikut panduan lengkapnya.</p><p>Tips pemberian MPASI:</p><ul><li>Mulai dengan tekstur halus</li><li>Berikan satu jenis makanan dulu</li><li>Perhatikan reaksi alergi</li><li>Jadwalkan waktu makan yang teratur</li></ul>',
                'meta_description' => 'Panduan lengkap tentang pemberian MPASI untuk bayi usia 6 bulan, termasuk menu dan jadwal makan.',
                'meta_keywords' => 'MPASI, makanan bayi, nutrisi bayi, bayi 6 bulan',
                'status' => 'published',
                'published_at' => now(),
                'kategori_id' => $kategoris->where('slug', 'nutrisi-bayi')->first()->id,
            ],
            [
                'judul' => 'Mengenal Gejala Demam pada Bayi',
                'konten' => '<p>Demam pada bayi bisa menjadi tanda adanya masalah kesehatan. Penting untuk mengenali gejala dan cara penanganannya.</p><p>Gejala demam pada bayi:</p><ul><li>Suhu tubuh di atas 37.5°C</li><li>Rewel dan tidak nyaman</li><li>Nafsu makan menurun</li><li>Tidur tidak nyenyak</li></ul>',
                'meta_description' => 'Informasi lengkap tentang gejala demam pada bayi dan cara penanganannya yang tepat.',
                'meta_keywords' => 'demam bayi, kesehatan bayi, gejala demam',
                'status' => 'published',
                'published_at' => now(),
                'kategori_id' => $kategoris->where('slug', 'kesehatan-bayi')->first()->id,
            ],
        ];

        foreach ($artikels as $artikel) {
            Artikel::create([
                ...$artikel,
                'user_id' => $admin->id,
            ]);
        }
    }
} 