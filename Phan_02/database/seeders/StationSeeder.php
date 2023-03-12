<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Station::insert([
            ['name' => 'Bến Thành'],
            ['name' => 'Nhà hát TP'],
            ['name' => 'Ba Son'],
            ['name' => 'Văn Thánh'],
            ['name' => 'Tân Cảng'],
            ['name' => 'Thảo Điền'],
            ['name' => 'An Phú'],
            ['name' => 'Rạch Chiếc'],
            ['name' => 'Phước Long'],
            ['name' => 'Bình Thái'],
            ['name' => 'Thủ Đức'],
            ['name' => 'Khu Công nghệ cao'],
            ['name' => 'Suối Tiên'],
            ['name' => 'BXMĐ mới'],
            ['name' => 'Tao Đàn'],
            ['name' => 'Dân Chủ'],
            ['name' => 'Hòa Hưng'],
            ['name' => 'Lê Thị Riêng'],
            ['name' => 'Phạm Văn Hai'],
            ['name' => 'Bảy Hiền'],
            ['name' => 'Đồng Đen'],
            ['name' => 'Nguyễn Hồng Đào'],
            ['name' => 'Bà Quẹo'],
            ['name' => 'Phạm Văn Bạch'],
            ['name' => 'Tham Lương'],
            ['name' => 'Tân Thới Nhất'],
            ['name' => 'BX An Sương'],
            ['name' => 'Chợ Tân Bình'],
            ['name' => 'Lăng Cha Cả'],
            ['name' => 'Hoàng Văn Thụ'],
            ['name' => 'Phú Nhuận'],
            ['name' => 'Nguyễn Văn Đậu'],
            ['name' => 'Bà Chiểu'],
            ['name' => 'Hàng Xanh'],
        ]);
    }
}
