<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = [

            // ── Dasar Pemrograman ─────────────────────────────────────────────
            [
                'course'          => 'Dasar Pemrograman',
                'title'           => 'Quiz 1 - Konsep Dasar & Tipe Data',
                'description'     => 'Quiz ini mencakup materi pengantar pemrograman, variabel, tipe data, dan operator dasar.',
                'duration_minutes'=> 60,
                'passing_score'   => 70,
                'due_date'        => now()->addDays(7)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 1,
            ],
            [
                'course'          => 'Dasar Pemrograman',
                'title'           => 'Quiz 2 - Percabangan & Perulangan',
                'description'     => 'Menguji pemahaman tentang struktur kontrol percabangan dan perulangan.',
                'duration_minutes'=> 60,
                'passing_score'   => 70,
                'due_date'        => now()->addDays(14)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 2,
            ],

            // ── Algoritma & Struktur Data ─────────────────────────────────────
            [
                'course'          => 'Algoritma & Struktur Data',
                'title'           => 'Quiz 1 - Algoritma & Kompleksitas',
                'description'     => 'Menguji pemahaman tentang konsep algoritma, Big-O notation, dan analisis kompleksitas.',
                'duration_minutes'=> 60,
                'passing_score'   => 70,
                'due_date'        => now()->addDays(5)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 1,
            ],
            [
                'course'          => 'Algoritma & Struktur Data',
                'title'           => 'Quiz 2 - Struktur Data Linear',
                'description'     => 'Menguji pemahaman tentang Array, Linked List, Stack, dan Queue.',
                'duration_minutes'=> 90,
                'passing_score'   => 75,
                'due_date'        => now()->addDays(12)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 2,
            ],

            // ── OOP ───────────────────────────────────────────────────────────
            [
                'course'          => 'Pemrograman Berorientasi Objek',
                'title'           => 'Quiz 1 - Konsep Dasar OOP',
                'description'     => 'Menguji pemahaman tentang Class, Object, Constructor, dan prinsip dasar OOP.',
                'duration_minutes'=> 60,
                'passing_score'   => 70,
                'due_date'        => now()->addDays(10)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 1,
            ],
            [
                'course'          => 'Pemrograman Berorientasi Objek',
                'title'           => 'Quiz 2 - Inheritance & Polymorphism',
                'description'     => 'Menguji pemahaman tentang Inheritance, Polymorphism, Encapsulation, dan Abstraction.',
                'duration_minutes'=> 60,
                'passing_score'   => 70,
                'due_date'        => now()->addDays(21)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 2,
            ],

            // ── Basis Data ────────────────────────────────────────────────────
            [
                'course'          => 'Basis Data',
                'title'           => 'Quiz 1 - ERD & Normalisasi',
                'description'     => 'Menguji pemahaman tentang perancangan database, ERD, dan normalisasi tabel.',
                'duration_minutes'=> 60,
                'passing_score'   => 70,
                'due_date'        => now()->addDays(8)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 1,
            ],
            [
                'course'          => 'Basis Data',
                'title'           => 'Quiz 2 - SQL & Query',
                'description'     => 'Menguji kemampuan menulis query SQL: DDL, DML, SELECT, JOIN, dan subquery.',
                'duration_minutes'=> 90,
                'passing_score'   => 75,
                'due_date'        => now()->addDays(18)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 2,
            ],

            // ── Pemrograman Web ───────────────────────────────────────────────
            [
                'course'          => 'Pemrograman Web',
                'title'           => 'Quiz 1 - HTML & CSS',
                'description'     => 'Menguji pemahaman tentang struktur HTML5, elemen semantik, dan styling CSS3.',
                'duration_minutes'=> 60,
                'passing_score'   => 70,
                'due_date'        => now()->addDays(6)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 1,
            ],
            [
                'course'          => 'Pemrograman Web',
                'title'           => 'Quiz 2 - JavaScript & PHP Dasar',
                'description'     => 'Menguji pemahaman tentang DOM manipulation, event handling, dan pengenalan PHP.',
                'duration_minutes'=> 60,
                'passing_score'   => 70,
                'due_date'        => now()->addDays(20)->setTime(12, 0),
                'is_published'    => true,
                'sort_order'      => 2,
            ],
        ];

        foreach ($quizzes as $data) {
            $course = Course::where('title', $data['course'])->first();
            Quiz::create([
                'course_id'        => $course->id,
                'title'            => $data['title'],
                'description'      => $data['description'],
                'duration_minutes' => $data['duration_minutes'],
                'passing_score'    => $data['passing_score'],
                'due_date'         => $data['due_date'],
                'is_published'     => $data['is_published'],
                'sort_order'       => $data['sort_order'],
            ]);
        }
    }
}
