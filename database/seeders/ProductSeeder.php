<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->truncate();

        $faker = Faker::create('id_ID');

        $sellers = DB::table('sellers')->pluck('id')->toArray();
        $categories = DB::table('categories')->get();

        // Daftar produk per kategori
        $categoryProducts = [
            'Elektronik' => ['Smartphone', 'Laptop', 'Headphone', 'Kamera', 'Powerbank', 'Charger', 'Speaker', 'TV', 'Mouse', 'Keyboard'],
            'Fashion Pria' => ['Kaos', 'Kemeja', 'Celana Jeans', 'Jaket', 'Sepatu', 'Topi', 'Sandal', 'Sweater', 'Dasi', 'Sabuk'],
            'Fashion Wanita' => ['Blouse', 'Dress', 'Rok', 'Tas Wanita', 'Sepatu Wanita', 'Hijab', 'Cardigan', 'Aksesoris', 'Dompet', 'Outer'],
            'Kesehatan & Kecantikan' => ['Masker', 'Sabun', 'Shampoo', 'Lipstik', 'Skincare', 'Vitamin', 'Parfum', 'Suplemen', 'Hand Sanitizer', 'Pasta Gigi'],
            'Rumah Tangga' => ['Panci', 'Wajan', 'Sapu', 'Pel', 'Gelas', 'Piring', 'Sendok', 'Kompor', 'Kulkas', 'Dispenser'],
            'Olahraga' => ['Bola', 'Raket', 'Sepatu Olahraga', 'Jersey', 'Matras Yoga', 'Dumbbell', 'Skateboard', 'Helm Sepeda', 'Botol Minum', 'Tas Olahraga'],
            'Makanan & Minuman' => ['Biskuit', 'Susu', 'Kopi', 'Teh', 'Coklat', 'Keripik', 'Roti', 'Mie Instan', 'Air Mineral', 'Permen'],
            'Otomotif' => ['Ban', 'Oli', 'Lampu Mobil', 'Aki', 'Spion', 'Helm Motor', 'Jas Hujan', 'Kunci Inggris', 'Cover Jok', 'Filter Udara'],
            'Hobi & Koleksi' => ['Action Figure', 'Puzzle', 'Mainan', 'Kartu Koleksi', 'Model Kit', 'Drone', 'Rubik', 'Poster', 'Stiker', 'Komik'],
            'Buku & Alat Tulis' => ['Buku', 'Pensil', 'Pulpen', 'Penghapus', 'Spidol', 'Penggaris', 'Buku Gambar', 'Binder', 'Map', 'Stabilo'],
        ];

        $products = [];

        // Deskripsi per produk dan kategori
        $deskripsiProduk = [
            'Rok' => 'Rok wanita dengan bahan berkualitas, cocok untuk berbagai acara dan nyaman dipakai sepanjang hari.',
            'Blouse' => 'Blouse modis yang cocok untuk gaya kasual maupun formal, tersedia dalam berbagai warna.',
            'Dress' => 'Dress elegan untuk penampilan feminin, cocok untuk pesta atau acara resmi.',
            'Kaos' => 'Kaos pria berbahan katun, adem dan nyaman untuk aktivitas sehari-hari.',
            'Kemeja' => 'Kemeja pria dengan desain modern, cocok untuk kerja maupun santai.',
            'Celana Jeans' => 'Celana jeans berkualitas, awet dan nyaman digunakan.',
            'Jaket' => 'Jaket hangat dengan model kekinian, cocok untuk musim hujan.',
            'Sepatu Wanita' => 'Sepatu wanita stylish, nyaman dipakai seharian.',
            'Tas Wanita' => 'Tas wanita elegan, muat banyak barang dan cocok untuk berbagai aktivitas.',
            'Hijab' => 'Hijab lembut dan mudah dibentuk, tersedia dalam banyak pilihan warna.',
            'Smartphone' => 'Smartphone terbaru dengan fitur canggih dan performa tinggi.',
            'Laptop' => 'Laptop handal untuk kerja dan hiburan, baterai tahan lama.',
            'Headphone' => 'Headphone dengan suara jernih, cocok untuk mendengarkan musik.',
            'Kamera' => 'Kamera digital resolusi tinggi, hasil foto tajam dan detail.',
            'Powerbank' => 'Powerbank kapasitas besar, cocok untuk traveling.',
            'Panci' => 'Panci anti lengket, ideal untuk memasak berbagai hidangan.',
            'Wajan' => 'Wajan berkualitas, tahan panas dan mudah dibersihkan.',
            'Bola' => 'Bola olahraga dengan bahan kuat dan tahan lama.',
            'Raket' => 'Raket ringan dan kokoh, cocok untuk pemula maupun profesional.',
            'Biskuit' => 'Biskuit renyah dan lezat, cocok untuk camilan keluarga.',
            'Susu' => 'Susu segar kaya nutrisi untuk kesehatan keluarga.',
            'Ban' => 'Ban mobil/motor dengan daya cengkeram kuat dan awet.',
            'Oli' => 'Oli mesin berkualitas untuk performa kendaraan optimal.',
            'Action Figure' => 'Action figure koleksi, detail dan finishing rapi.',
            'Puzzle' => 'Puzzle edukatif untuk anak, melatih kreativitas dan logika.',
            'Buku' => 'Buku original, isi menarik dan bermanfaat untuk menambah wawasan.',
            'Pensil' => 'Pensil berkualitas, cocok untuk menulis dan menggambar.',
            'Pulpen' => 'Pulpen tinta lancar, nyaman digunakan sehari-hari.',
            // ...tambahkan deskripsi lain sesuai kebutuhan
        ];

        foreach ($sellers as $sellerId) {
            // Setiap seller dapat 3-6 produk acak dari kategori berbeda
            $num = $faker->numberBetween(3, 6);
            $categoryIds = $categories->pluck('id')->shuffle()->slice(0, $num)->values();
            $isFirstProduct = true;
            foreach ($categoryIds as $catId) {
                $category = $categories->where('id', $catId)->first();
                $catName = $category->name;
                $productList = $categoryProducts[$catName] ?? ['Produk Umum'];
                $prodName = $faker->randomElement($productList);
                $desc = $deskripsiProduk[$prodName] ?? ($catName . ' berkualitas, cocok untuk kebutuhan Anda.');
                $images = null;
                // Untuk seller pertama (seller1@example.com) dan produk pertama, set gambar kucing
                if ($sellerId == $sellers[0] && $isFirstProduct) {
                    $images = ['products/kucing.jpg'];
                    $isFirstProduct = false;
                }
                $products[] = [
                    'name' => $prodName,
                    'description' => $desc,
                    'price' => $faker->numberBetween(15000, 15000000),
                    'stock' => $faker->numberBetween(0, 100),
                    'weight' => $faker->numberBetween(50, 2000),
                    'category_id' => $catId,
                    'seller_id' => $sellerId,
                    'condition' => $faker->randomElement(['new','used']),
                    'min_order' => 1,
                    'is_active' => $faker->boolean(85),
                    'images' => $images,
                    'created_at' => now()->subDays($faker->numberBetween(0,120)),
                    'updated_at' => now(),
                ];
            }
        }

        // Bulk insert in chunks
        $chunks = array_chunk($products, 200);
        foreach ($chunks as $chunk) {
            DB::table('products')->insert($chunk);
        }
    }
}