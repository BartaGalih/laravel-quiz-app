<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\CourseMaterial;

class CourseMaterialSeeder extends Seeder
{
    public function run(): void
    {
        // ── Kursus 1: Dasar Pemrograman ─────────────────────────────────────
        $c1 = Course::where('title', 'Dasar Pemrograman')->first();
        $this->createMaterials($c1->id, [
            ['title' => 'Pengantar Dunia Pemrograman',        'type' => 'document', 'page_count' => 12],
            ['title' => 'Pengantar Pemrograman - Video',      'type' => 'video',    'duration_seconds' => 582],   // 9:42
            ['title' => 'Variabel, Tipe Data & Operator',     'type' => 'document', 'page_count' => 18],
            ['title' => 'Tipe Data & Operator - Video',       'type' => 'video',    'duration_seconds' => 724],   // 12:04
            ['title' => 'Percabangan (If, Else, Switch)',     'type' => 'document', 'page_count' => 15],
            ['title' => 'Percabangan - Video',                'type' => 'video',    'duration_seconds' => 651],   // 10:51
            ['title' => 'Perulangan (For, While, Do-While)',  'type' => 'document', 'page_count' => 14],
            ['title' => 'Perulangan - Video',                 'type' => 'video',    'duration_seconds' => 810],   // 13:30
            ['title' => 'Fungsi dan Prosedur',                'type' => 'document', 'page_count' => 9],
        ]);

        // ── Kursus 2: Algoritma & Struktur Data ─────────────────────────────
        $c2 = Course::where('title', 'Algoritma & Struktur Data')->first();
        $this->createMaterials($c2->id, [
            ['title' => 'Pengantar Algoritma & Kompleksitas',  'type' => 'document', 'page_count' => 16],
            ['title' => 'Big-O Notation - Video',              'type' => 'video',    'duration_seconds' => 867],   // 14:27
            ['title' => 'Array & Linked List',                 'type' => 'document', 'page_count' => 20],
            ['title' => 'Stack & Queue',                       'type' => 'document', 'page_count' => 14],
            ['title' => 'Stack & Queue - Video',               'type' => 'video',    'duration_seconds' => 945],   // 15:45
            ['title' => 'Tree & Binary Search Tree',           'type' => 'document', 'page_count' => 22],
            ['title' => 'Binary Search Tree - Video',          'type' => 'video',    'duration_seconds' => 1124],  // 18:44
            ['title' => 'Sorting Algorithms',                  'type' => 'document', 'page_count' => 18],
            ['title' => 'Sorting - Bubble, Merge, Quick Sort', 'type' => 'video',    'duration_seconds' => 1380],  // 23:00
        ]);

        // ── Kursus 3: OOP ───────────────────────────────────────────────────
        $c3 = Course::where('title', 'Pemrograman Berorientasi Objek')->first();
        $this->createMaterials($c3->id, [
            ['title' => 'Konsep Dasar OOP',                   'type' => 'document', 'page_count' => 10],
            ['title' => 'Pengenalan OOP - Video',              'type' => 'video',    'duration_seconds' => 720],
            ['title' => 'Class, Object & Constructor',        'type' => 'document', 'page_count' => 16],
            ['title' => 'Class & Object - Video',              'type' => 'video',    'duration_seconds' => 891],
            ['title' => 'Inheritance & Polymorphism',          'type' => 'document', 'page_count' => 19],
            ['title' => 'Inheritance - Video',                 'type' => 'video',    'duration_seconds' => 1050],
            ['title' => 'Encapsulation & Abstraction',         'type' => 'document', 'page_count' => 13],
            ['title' => 'Interface & Abstract Class',          'type' => 'document', 'page_count' => 11],
        ]);

        // ── Kursus 4: Basis Data ─────────────────────────────────────────────
        $c4 = Course::where('title', 'Basis Data')->first();
        $this->createMaterials($c4->id, [
            ['title' => 'Pengantar Sistem Basis Data',         'type' => 'document', 'page_count' => 14],
            ['title' => 'Pengantar Basis Data - Video',        'type' => 'video',    'duration_seconds' => 636],
            ['title' => 'Entity Relationship Diagram (ERD)',   'type' => 'document', 'page_count' => 20],
            ['title' => 'ERD & Normalisasi - Video',           'type' => 'video',    'duration_seconds' => 1020],
            ['title' => 'DDL: CREATE, ALTER, DROP',            'type' => 'document', 'page_count' => 12],
            ['title' => 'DML: INSERT, UPDATE, DELETE',         'type' => 'document', 'page_count' => 10],
            ['title' => 'Query SELECT & Filtering',            'type' => 'document', 'page_count' => 15],
            ['title' => 'JOIN & Subquery - Video',             'type' => 'video',    'duration_seconds' => 1260],
        ]);

        // ── Kursus 5: Pemrograman Web ────────────────────────────────────────
        $c5 = Course::where('title', 'Pemrograman Web')->first();
        $this->createMaterials($c5->id, [
            ['title' => 'Pengenalan HTML5 & Struktur Dokumen', 'type' => 'document', 'page_count' => 13],
            ['title' => 'HTML5 - Video',                       'type' => 'video',    'duration_seconds' => 756],
            ['title' => 'CSS3: Layout & Flexbox',              'type' => 'document', 'page_count' => 18],
            ['title' => 'CSS Flexbox & Grid - Video',          'type' => 'video',    'duration_seconds' => 1110],
            ['title' => 'JavaScript Dasar: DOM & Event',       'type' => 'document', 'page_count' => 22],
            ['title' => 'JavaScript DOM - Video',              'type' => 'video',    'duration_seconds' => 1350],
            ['title' => 'Pengenalan PHP & Laravel',            'type' => 'document', 'page_count' => 17],
            ['title' => 'Laravel Quickstart - Video',          'type' => 'video',    'duration_seconds' => 1680],
        ]);

        // ── Kursus 6: Jaringan (Draft) ───────────────────────────────────────
        $c6 = Course::where('title', 'Jaringan Komputer')->first();
        $this->createMaterials($c6->id, [
            ['title' => 'Pengantar Jaringan Komputer',         'type' => 'document', 'page_count' => 16],
            ['title' => 'Model OSI & TCP/IP',                  'type' => 'document', 'page_count' => 20],
            ['title' => 'Model OSI - Video',                   'type' => 'video',    'duration_seconds' => 930],
        ]);
    }

    private function createMaterials(int $courseId, array $items): void
    {
        foreach ($items as $i => $item) {
            CourseMaterial::create([
                'course_id'        => $courseId,
                'title'            => $item['title'],
                'type'             => $item['type'],
                'file_path'        => $item['type'] === 'document' ? 'materials/sample.pdf' : null,
                'video_url'        => $item['type'] === 'video'    ? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ' : null,
                'page_count'       => $item['page_count']       ?? null,
                'duration_seconds' => $item['duration_seconds'] ?? null,
                'sort_order'       => $i + 1,
            ]);
        }
    }
}
