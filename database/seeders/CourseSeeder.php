<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title'        => 'Dasar Pemrograman',
                'description'  => 'Pelajari konsep dasar pemrograman komputer mulai dari logika, variabel, kondisi, perulangan, hingga fungsi. Cocok untuk pemula yang belum pernah coding sama sekali.',
                'icon_type'    => 'code',
                'is_published' => true,
                'sort_order'   => 1,
            ],
            [
                'title'        => 'Algoritma & Struktur Data',
                'description'  => 'Memahami algoritma fundamental dan struktur data seperti array, linked list, stack, queue, tree, dan graph beserta penerapannya dalam pemecahan masalah.',
                'icon_type'    => 'code',
                'is_published' => true,
                'sort_order'   => 2,
            ],
            [
                'title'        => 'Pemrograman Berorientasi Objek',
                'description'  => 'Konsep OOP meliputi class, object, inheritance, polymorphism, encapsulation, dan abstraction menggunakan bahasa pemrograman Java dan PHP.',
                'icon_type'    => 'code',
                'is_published' => true,
                'sort_order'   => 3,
            ],
            [
                'title'        => 'Basis Data',
                'description'  => 'Pengenalan sistem basis data relasional, perancangan ERD, normalisasi, dan pemrograman SQL mulai dari DDL, DML, hingga query lanjutan dengan JOIN dan subquery.',
                'icon_type'    => 'other',
                'is_published' => true,
                'sort_order'   => 4,
            ],
            [
                'title'        => 'Pemrograman Web',
                'description'  => 'Belajar membangun aplikasi web modern menggunakan HTML, CSS, JavaScript, serta framework populer. Mencakup konsep frontend dan backend development.',
                'icon_type'    => 'code',
                'is_published' => true,
                'sort_order'   => 5,
            ],
            [
                'title'        => 'Jaringan Komputer',
                'description'  => 'Memahami konsep jaringan komputer, model OSI, protokol TCP/IP, subnetting, routing, hingga keamanan jaringan dasar.',
                'icon_type'    => 'other',
                'is_published' => false, // draft — belum rilis
                'sort_order'   => 6,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
