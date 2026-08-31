<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Location;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user (idempotent so re-seeding is safe)
        User::updateOrCreate(
            ['email' => 'admin@baharitz.com'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@baharitz.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Seed Categories
        $electronics = Category::updateOrCreate(['name' => 'Electronics'], ['description' => 'All electronic devices and accessories']);
        Category::updateOrCreate(['name' => 'Food & Beverages'], ['description' => 'All food and drink items']);
        Category::updateOrCreate(['name' => 'Clothing'], ['description' => 'All clothing and apparel']);

        // Seed Units
        $piece = Unit::updateOrCreate(['name' => 'Piece'], ['short_name' => 'pc', 'description' => 'Single item']);
        Unit::updateOrCreate(['name' => 'Kilogram'], ['short_name' => 'kg', 'description' => 'Weight in kilograms']);
        Unit::updateOrCreate(['name' => 'Gram'], ['short_name' => 'g', 'description' => 'Weight in grams']);
        Unit::updateOrCreate(['name' => 'Liter'], ['short_name' => 'L', 'description' => 'Volume in liters']);
        Unit::updateOrCreate(['name' => 'Milliliter'], ['short_name' => 'mL', 'description' => 'Volume in milliliters']);
        Unit::updateOrCreate(['name' => 'Meter'], ['short_name' => 'm', 'description' => 'Length in meters']);
        Unit::updateOrCreate(['name' => 'Centimeter'], ['short_name' => 'cm', 'description' => 'Length in centimeters']);
        Unit::updateOrCreate(['name' => 'Box'], ['short_name' => 'box', 'description' => 'Packaged in a box']);
        Unit::updateOrCreate(['name' => 'Carton'], ['short_name' => 'ctn', 'description' => 'Packaged in a carton']);
        Unit::updateOrCreate(['name' => 'Pack'], ['short_name' => 'pk', 'description' => 'Packaged in a pack']);
        Unit::updateOrCreate(['name' => 'Dozen'], ['short_name' => 'doz', 'description' => 'Twelve items']);
        Unit::updateOrCreate(['name' => 'Pair'], ['short_name' => 'pr', 'description' => 'Two items as a pair']);
        Unit::updateOrCreate(['name' => 'Set'], ['short_name' => 'set', 'description' => 'Multiple items as a set']);

        // Seed Brand Names used in the inventory
        $brandNames = [
            'Samsung', 'Apple', 'Xiaomi', 'Redmi', 'Tecno', 'Infinix', 'Nokia',
            'HP', 'Dell', 'Lenovo', 'PlayStation', 'Anker',
        ];
        $brands = [];
        foreach ($brandNames as $brandName) {
            $brands[$brandName] = Brand::updateOrCreate(['name' => $brandName], ['description' => $brandName . ' products']);
        }

        // Seed Locations
        Location::updateOrCreate(['name' => 'Main Warehouse'], ['type' => 'warehouse', 'address' => '123 Main St, City']);
        Location::updateOrCreate(['name' => 'Retail Store 1'], ['type' => 'store', 'address' => '456 Market St, City']);

        // Seed Suppliers
        Supplier::updateOrCreate(['name' => 'Tech Supplies Inc.'], ['email' => 'contact@techsupplies.com', 'phone' => '1234567890', 'contact_person' => 'John Doe']);
        Supplier::updateOrCreate(['name' => 'Food Distributors Ltd.'], ['email' => 'info@fooddist.com', 'phone' => '0987654321', 'contact_person' => 'Jane Smith']);

        // Seed Products (from real inventory)
        $products = [
            ['Samsung Galaxy A15', 450000, 'Samsung'],
            ['Samsung Galaxy A25', 650000, 'Samsung'],
            ['Samsung Galaxy S23', 1850000, 'Samsung'],
            ['iPhone 11', 950000, 'Apple'],
            ['iPhone 13', 1450000, 'Apple'],
            ['iPhone 15', 2200000, 'Apple'],
            ['Redmi Note 13', 550000, 'Redmi'],
            ['Tecno Camon 30', 650000, 'Tecno'],
            ['Tecno Spark 20', 350000, 'Tecno'],
            ['Infinix Hot 40', 400000, 'Infinix'],
            ['Nokia 105', 75000, 'Nokia'],
            ['HP Core i5 Laptop', 1200000, 'HP'],
            ['Dell Latitude Core i5', 1350000, 'Dell'],
            ['Lenovo ThinkPad Core i5', 1400000, 'Lenovo'],
            ['HP Core i7 Laptop', 1850000, 'HP'],
            ['MacBook Air', 2800000, 'Apple'],
            ['Desktop Computer Core i5', 1100000, null],
            ['Computer Monitor 22"', 350000, null],
            ['Computer Monitor 24"', 450000, null],
            ['Keyboard', 35000, null],
            ['Wireless Keyboard', 65000, null],
            ['Computer Mouse', 25000, null],
            ['Wireless Mouse', 45000, null],
            ['128GB USB Flash Disk', 35000, null],
            ['256GB USB Flash Disk', 60000, null],
            ['500GB SSD', 120000, null],
            ['1TB SSD', 220000, null],
            ['1TB External HDD', 180000, null],
            ['2TB External HDD', 280000, null],
            ['32GB Memory Card', 25000, null],
            ['64GB Memory Card', 35000, null],
            ['128GB Memory Card', 55000, null],
            ['10,000mAh Power Bank', 45000, null],
            ['20,000mAh Power Bank', 75000, null],
            ['Fast Phone Charger', 25000, null],
            ['65W Laptop Charger', 85000, null],
            ['USB Type-C Cable', 15000, null],
            ['Lightning Cable', 20000, null],
            ['HDMI Cable', 20000, null],
            ['Bluetooth Earbuds', 55000, null],
            ['Bluetooth Headphones', 85000, null],
            ['Bluetooth Speaker', 75000, null],
            ['Wireless Microphone', 120000, null],
            ['Smart Watch', 85000, null],
            ['Smart Band', 45000, null],
            ['32" Smart TV', 550000, null],
            ['43" Smart TV', 850000, null],
            ['50" Smart TV', 1150000, null],
            ['55" Smart TV', 1450000, null],
            ['Android TV Box', 120000, null],
            ['Wi-Fi Router', 90000, null],
            ['4G Router', 180000, null],
            ['5G Router', 450000, null],
            ['Wi-Fi Extender', 75000, null],
            ['8-Port Network Switch', 85000, null],
            ['16-Port Network Switch', 180000, null],
            ['CCTV Camera 2MP', 120000, null],
            ['CCTV Camera 5MP', 180000, null],
            ['4-Channel DVR', 250000, null],
            ['8-Channel DVR', 380000, null],
            ['8-Channel NVR', 350000, null],
            ['CCTV 1TB HDD', 220000, null],
            ['CCTV Power Supply', 45000, null],
            ['CCTV Cable 100m', 120000, null],
            ['Barcode Scanner', 180000, null],
            ['Receipt Printer', 250000, null],
            ['Thermal Printer', 280000, null],
            ['Cash Drawer', 180000, null],
            ['POS Machine', 450000, null],
            ['UPS 650VA', 180000, null],
            ['UPS 1200VA', 350000, null],
            ['Voltage Stabilizer', 120000, null],
            ['Extension Socket', 35000, null],
            ['Rechargeable Battery', 25000, null],
            ['Electric Kettle', 65000, null],
            ['Blender', 120000, null],
            ['Electric Iron', 55000, null],
            ['Microwave Oven', 350000, null],
            ['Air Fryer', 180000, null],
            ['Standing Fan', 150000, null],
            ['Table Fan', 85000, null],
            ['Ring Light', 75000, null],
            ['Tripod Stand', 65000, null],
            ['Webcam', 120000, null],
            ['Wireless Game Controller', 100000, null],
            ['PlayStation 5', 1800000, 'PlayStation'],
            ['PlayStation 4', 850000, 'PlayStation'],
            ['Gaming Headset', 120000, null],
            ['Gaming Keyboard', 100000, null],
            ['Gaming Mouse', 75000, null],
            ['Digital Camera', 850000, null],
            ['Action Camera', 350000, null],
            ['Car Charger', 25000, null],
            ['Car Bluetooth FM Transmitter', 35000, null],
            ['Car Dash Camera', 180000, null],
            ['GPS Tracker', 150000, null],
            ['Portable Power Station', 1200000, null],
        ];

        foreach ($products as [$name, $sellingPrice, $brandName]) {
            $sku = $this->makeSku($name);
            Product::updateOrCreate(
                ['sku' => $sku],
                [
                    'name' => $name,
                    'sku' => $sku,
                    'barcode' => null,
                    'category_id' => $electronics->id,
                    'brand_id' => isset($brands[$brandName]) ? $brands[$brandName]->id : null,
                    'unit_id' => $piece->id,
                    'description' => $name,
                    'cost_price' => round($sellingPrice * 0.75),
                    'selling_price' => $sellingPrice,
                    'quantity' => 50,
                    'reorder_level' => 5,
                    'is_active' => true,
                ]
            );
        }
    }

    private function makeSku(string $name): string
    {
        $slug = strtoupper(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $name), '-'));
        return $slug;
    }
}
