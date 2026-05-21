<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create categories first
        $categories = [
            ['name' => 'Pakaian Pria', 'slug' => 'pakaian-pria'],
            ['name' => 'Pakaian Wanita', 'slug' => 'pakaian-wanita'],
            ['name' => 'Sepatu', 'slug' => 'sepatu'],
            ['name' => 'Tas', 'slug' => 'tas'],
            ['name' => 'Kecantikan', 'slug' => 'kecantikan'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris'],
            ['name' => 'Pakaian', 'slug' => 'pakaian'],
        ];

        $categoryIds = [];
        foreach ($categories as $cat) {
            $category = Category::firstOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'slug' => $cat['slug'],
                    'is_active' => true,
                ]
            );
            $categoryIds[$cat['name']] = $category->_id;
        }

        // Sample products data
        $products = [
            [
                'name' => 'Kemeja Oversize Premium Cotton',
                'category' => 'Pakaian Pria',
                'brand' => 'Urban Style',
                'price' => 285000,
                'compare_price' => 399000,
                'stock' => 50,
                'rating' => 4.8,
                'is_active' => true,
                'is_featured' => true,
                'images' => ['https://images.unsplash.com/photo-1618354691373-d851c5c3a990?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['white', 'black', 'blue'],
                'sizes' => ['S', 'M', 'L', 'XL'],
                'description' => 'Kemeja oversize dengan bahan premium cotton yang nyaman untuk aktivitas sehari-hari.',
                'tags' => ['kemeja', 'oversize', 'premium', 'cotton'],
            ],
            [
                'name' => 'Sneakers Urban Runner V2',
                'category' => 'Sepatu',
                'brand' => 'SportX',
                'price' => 749000,
                'compare_price' => 999000,
                'stock' => 30,
                'rating' => 4.9,
                'is_active' => true,
                'is_featured' => true,
                'images' => ['https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['black', 'white'],
                'sizes' => ['40', '41', '42', '43', '44'],
                'description' => 'Sneakers premium dengan desain modern dan nyaman untuk olahraga dan aktivitas harian.',
                'tags' => ['sneakers', 'sport', 'running', 'premium'],
            ],
            [
                'name' => 'Dress Floral Midi Elegan',
                'category' => 'Pakaian Wanita',
                'brand' => 'Elegant Line',
                'price' => 425000,
                'compare_price' => 580000,
                'stock' => 40,
                'rating' => 4.7,
                'is_active' => true,
                'is_featured' => false,
                'images' => ['https://images.unsplash.com/photo-1623609163859-ca93c959b98a?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['pink', 'white'],
                'sizes' => ['S', 'M', 'L'],
                'description' => 'Dress floral dengan desain midi yang elegan untuk berbagai acara.',
                'tags' => ['dress', 'floral', 'elegant', 'midi'],
            ],
            [
                'name' => 'Tas Selempang Leather Canvas',
                'category' => 'Tas',
                'brand' => 'BagMaster',
                'price' => 315000,
                'compare_price' => 450000,
                'stock' => 25,
                'rating' => 4.6,
                'is_active' => true,
                'is_featured' => true,
                'images' => ['https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['black', 'brown'],
                'sizes' => ['M', 'L'],
                'description' => 'Tas selempang dengan kombinasi leather dan canvas berkualitas tinggi.',
                'tags' => ['tas', 'selempang', 'leather', 'canvas'],
            ],
            [
                'name' => 'Hoodie Streetwear Unisex',
                'category' => 'Pakaian',
                'brand' => 'StreetWear Co',
                'price' => 375000,
                'compare_price' => 525000,
                'stock' => 60,
                'rating' => 4.8,
                'is_active' => true,
                'is_featured' => true,
                'images' => ['https://images.unsplash.com/photo-1556821840-3a63f15732ce?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['black', 'gray', 'white'],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'description' => 'Hoodie streetwear dengan desain unisex yang stylish dan nyaman.',
                'tags' => ['hoodie', 'streetwear', 'unisex', 'casual'],
            ],
            [
                'name' => 'Serum Vitamin C Glow Booster',
                'category' => 'Kecantikan',
                'brand' => 'GlowSkin',
                'price' => 189000,
                'compare_price' => 250000,
                'stock' => 100,
                'rating' => 4.9,
                'is_active' => true,
                'is_featured' => true,
                'images' => ['https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=600&q=80'],
                'colors' => [],
                'sizes' => [],
                'description' => 'Serum vitamin C untuk kulit lebih cerah dan glowing.',
                'tags' => ['serum', 'vitamin c', 'skincare', 'beauty'],
            ],
            [
                'name' => 'Celana Chino Slim Fit',
                'category' => 'Pakaian Pria',
                'brand' => 'Urban Style',
                'price' => 259000,
                'compare_price' => 359000,
                'stock' => 45,
                'rating' => 4.5,
                'is_active' => true,
                'is_featured' => false,
                'images' => ['https://images.unsplash.com/photo-1473966968600-fa801b869a1a?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['black', 'brown', 'gray'],
                'sizes' => ['S', 'M', 'L', 'XL'],
                'description' => 'Celana chino slim fit dengan bahan katun berkualitas.',
                'tags' => ['celana', 'chino', 'slim fit', 'casual'],
            ],
            [
                'name' => 'Watch Minimalis Stainless',
                'category' => 'Aksesoris',
                'brand' => 'TimeLux',
                'price' => 595000,
                'compare_price' => 850000,
                'stock' => 20,
                'rating' => 4.7,
                'is_active' => true,
                'is_featured' => true,
                'images' => ['https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['black', 'silver'],
                'sizes' => [],
                'description' => 'Jam tangan minimalis dengan bahan stainless steel berkualitas.',
                'tags' => ['watch', 'jam', 'minimalis', 'stainless'],
            ],
            [
                'name' => 'Blouse Linen Soft Touch',
                'category' => 'Pakaian Wanita',
                'brand' => 'Elegant Line',
                'price' => 220000,
                'stock' => 35,
                'rating' => 4.6,
                'is_active' => true,
                'is_featured' => false,
                'images' => ['https://images.unsplash.com/photo-1598554747436-c9293d6a588f?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['white', 'pink', 'blue'],
                'sizes' => ['S', 'M', 'L'],
                'description' => 'Blouse linen dengan tekstur lembut dan nyaman.',
                'tags' => ['blouse', 'linen', 'women', 'casual'],
            ],
            [
                'name' => 'Sepatu Loafers Casual',
                'category' => 'Sepatu',
                'brand' => 'ClassicShoe',
                'price' => 465000,
                'stock' => 28,
                'rating' => 4.8,
                'is_active' => true,
                'is_featured' => false,
                'images' => ['https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['black', 'brown'],
                'sizes' => ['40', '41', '42', '43', '44'],
                'description' => 'Sepatu loafers casual untuk gaya santai sehari-hari.',
                'tags' => ['loafers', 'casual', 'shoes', 'comfort'],
            ],
            [
                'name' => 'Sunscreen SPF 50 PA++++',
                'category' => 'Kecantikan',
                'brand' => 'GlowSkin',
                'price' => 145000,
                'stock' => 150,
                'rating' => 4.9,
                'is_active' => true,
                'is_featured' => false,
                'images' => ['https://images.unsplash.com/photo-1556228852-6d35a585d566?auto=format&fit=crop&w=600&q=80'],
                'colors' => [],
                'sizes' => [],
                'description' => 'Sunscreen SPF 50 dengan perlindungan tinggi untuk kulit.',
                'tags' => ['sunscreen', 'spf50', 'skincare', 'protection'],
            ],
            [
                'name' => 'Tote Bag Canvas Ekstra Large',
                'category' => 'Tas',
                'brand' => 'BagMaster',
                'price' => 175000,
                'stock' => 40,
                'rating' => 4.7,
                'is_active' => true,
                'is_featured' => false,
                'images' => ['https://images.unsplash.com/photo-1591561954557-26941169b49e?auto=format&fit=crop&w=600&q=80'],
                'colors' => ['black', 'white', 'gray'],
                'sizes' => ['L'],
                'description' => 'Tote bag canvas ukuran besar, cocok untuk aktivitas sehari-hari.',
                'tags' => ['tote', 'canvas', 'bag', 'large'],
            ],
        ];

        // Insert products
        foreach ($products as $productData) {
            $categoryName = $productData['category'];
            $categoryId = $categoryIds[$categoryName] ?? null;

            $productAttributes = [
                'name' => $productData['name'],
                'slug' => \Illuminate\Support\Str::slug($productData['name']),
                'category_id' => $categoryId,
                'brand' => $productData['brand'],
                'price' => (float) $productData['price'],
                'stock' => (int) $productData['stock'],
                'rating' => (float) $productData['rating'],
                'is_active' => (bool) $productData['is_active'],
                'is_featured' => (bool) $productData['is_featured'],
                'is_new' => false,
                'images' => $productData['images'],
                'colors' => $productData['colors'],
                'sizes' => $productData['sizes'],
                'description' => $productData['description'],
                'tags' => $productData['tags'],
                'views_count' => 0,
                'sold_count' => 0,
                'low_stock_threshold' => 5,
            ];

            if (isset($productData['compare_price'])) {
                $productAttributes['compare_price'] = (float) $productData['compare_price'];
            }

            Product::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($productData['name'])],
                $productAttributes
            );
        }

        $this->command->info('Products seeded successfully!');
    }
}
