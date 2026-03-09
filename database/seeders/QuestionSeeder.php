<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionOption;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedQuiz('Quiz 1 - Konsep Dasar & Tipe Data', $this->dasar1());
        $this->seedQuiz('Quiz 2 - Percabangan & Perulangan', $this->dasar2());
        $this->seedQuiz('Quiz 1 - Algoritma & Kompleksitas', $this->algo1());
        $this->seedQuiz('Quiz 2 - Struktur Data Linear',     $this->algo2());
        $this->seedQuiz('Quiz 1 - Konsep Dasar OOP',         $this->oop1());
        $this->seedQuiz('Quiz 2 - Inheritance & Polymorphism', $this->oop2());
        $this->seedQuiz('Quiz 1 - ERD & Normalisasi',        $this->db1());
        $this->seedQuiz('Quiz 2 - SQL & Query',              $this->db2());
        $this->seedQuiz('Quiz 1 - HTML & CSS',               $this->web1());
        $this->seedQuiz('Quiz 2 - JavaScript & PHP Dasar',   $this->web2());
    }

    // ── Helper ──────────────────────────────────────────────────────────────

    private function seedQuiz(string $quizTitle, array $questions): void
    {
        $quiz = Quiz::where('title', $quizTitle)->first();
        if (!$quiz) return;

        foreach ($questions as $i => $q) {
            $question = Question::create([
                'quiz_id'    => $quiz->id,
                'body'       => $q['question'],
                'sort_order' => $i + 1,
            ]);

            foreach ($q['options'] as $j => $opt) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'body'        => $opt['text'],
                    'is_correct'  => $opt['correct'],
                    'sort_order'  => $j + 1,
                ]);
            }
        }
    }

    private function opt(string $text, bool $correct = false): array
    {
        return ['text' => $text, 'correct' => $correct];
    }

    // ── Quiz Data ────────────────────────────────────────────────────────────

    private function dasar1(): array
    {
        return [
            [
                'question' => 'Apa yang dimaksud dengan variabel dalam pemrograman?',
                'options'  => [
                    $this->opt('Tempat penyimpanan data yang nilainya dapat berubah', true),
                    $this->opt('Nilai tetap yang tidak dapat diubah selama program berjalan'),
                    $this->opt('Instruksi yang diberikan kepada komputer'),
                    $this->opt('Struktur pengulangan dalam program'),
                ],
            ],
            [
                'question' => 'Tipe data manakah yang digunakan untuk menyimpan nilai desimal atau pecahan?',
                'options'  => [
                    $this->opt('Integer'),
                    $this->opt('Boolean'),
                    $this->opt('Float', true),
                    $this->opt('Char'),
                ],
            ],
            [
                'question' => 'Operator manakah yang digunakan untuk operasi modulo (sisa bagi)?',
                'options'  => [
                    $this->opt('/'),
                    $this->opt('%', true),
                    $this->opt('//'),
                    $this->opt('**'),
                ],
            ],
            [
                'question' => 'Nilai dari ekspresi: 10 % 3 adalah...',
                'options'  => [
                    $this->opt('3'),
                    $this->opt('0'),
                    $this->opt('1', true),
                    $this->opt('2'),
                ],
            ],
            [
                'question' => 'Tipe data Boolean hanya memiliki dua kemungkinan nilai, yaitu...',
                'options'  => [
                    $this->opt('0 dan 1'),
                    $this->opt('true dan false', true),
                    $this->opt('ya dan tidak'),
                    $this->opt('on dan off'),
                ],
            ],
            [
                'question' => 'Manakah yang merupakan contoh konstanta dalam pemrograman?',
                'options'  => [
                    $this->opt('Variabel yang nilainya selalu berubah'),
                    $this->opt('Nilai yang dideklarasikan tapi tidak pernah digunakan'),
                    $this->opt('Nilai yang ditetapkan sekali dan tidak dapat diubah', true),
                    $this->opt('Nama fungsi dalam program'),
                ],
            ],
            [
                'question' => 'Apa output dari ekspresi: 5 + 3 * 2?',
                'options'  => [
                    $this->opt('16'),
                    $this->opt('11', true),
                    $this->opt('13'),
                    $this->opt('10'),
                ],
            ],
            [
                'question' => 'Operator == dalam pemrograman digunakan untuk...',
                'options'  => [
                    $this->opt('Menetapkan nilai ke variabel'),
                    $this->opt('Membandingkan apakah dua nilai sama', true),
                    $this->opt('Menjumlahkan dua angka'),
                    $this->opt('Menghitung selisih dua nilai'),
                ],
            ],
            [
                'question' => 'Tipe data String digunakan untuk menyimpan...',
                'options'  => [
                    $this->opt('Angka bulat'),
                    $this->opt('Nilai benar atau salah'),
                    $this->opt('Urutan karakter atau teks', true),
                    $this->opt('Angka dengan titik desimal'),
                ],
            ],
            [
                'question' => 'Manakah pernyataan yang benar tentang deklarasi variabel?',
                'options'  => [
                    $this->opt('Variabel tidak perlu dideklarasikan sebelum digunakan'),
                    $this->opt('Deklarasi variabel menentukan nama dan tipe data yang akan disimpan', true),
                    $this->opt('Satu variabel bisa menyimpan banyak tipe data sekaligus'),
                    $this->opt('Nama variabel boleh dimulai dengan angka'),
                ],
            ],
        ];
    }

    private function dasar2(): array
    {
        return [
            [
                'question' => 'Struktur percabangan yang digunakan untuk memilih salah satu dari banyak kondisi adalah...',
                'options'  => [
                    $this->opt('if-else'),
                    $this->opt('for loop'),
                    $this->opt('switch-case', true),
                    $this->opt('while loop'),
                ],
            ],
            [
                'question' => 'Perulangan manakah yang pasti dieksekusi minimal satu kali meskipun kondisi bernilai false?',
                'options'  => [
                    $this->opt('for'),
                    $this->opt('while'),
                    $this->opt('do-while', true),
                    $this->opt('foreach'),
                ],
            ],
            [
                'question' => 'Statement break dalam perulangan berfungsi untuk...',
                'options'  => [
                    $this->opt('Melewati iterasi saat ini dan lanjut ke iterasi berikutnya'),
                    $this->opt('Menghentikan seluruh perulangan', true),
                    $this->opt('Mengulang dari awal perulangan'),
                    $this->opt('Mendeklarasikan kondisi perulangan'),
                ],
            ],
            [
                'question' => 'Berapa kali loop berikut dieksekusi?\nfor (int i = 0; i < 5; i++) { ... }',
                'options'  => [
                    $this->opt('4'),
                    $this->opt('5', true),
                    $this->opt('6'),
                    $this->opt('Infinite loop'),
                ],
            ],
            [
                'question' => 'Statement continue dalam perulangan berfungsi untuk...',
                'options'  => [
                    $this->opt('Menghentikan seluruh perulangan'),
                    $this->opt('Melewati sisa kode di iterasi saat ini dan lanjut ke iterasi berikutnya', true),
                    $this->opt('Mengulang seluruh loop dari awal'),
                    $this->opt('Keluar dari fungsi'),
                ],
            ],
            [
                'question' => 'Kondisi if-else if-else digunakan ketika...',
                'options'  => [
                    $this->opt('Hanya ada satu kondisi yang perlu dicek'),
                    $this->opt('Ada banyak kondisi yang saling eksklusif perlu dicek', true),
                    $this->opt('Perlu mengulang blok kode beberapa kali'),
                    $this->opt('Program tidak memerlukan kondisi apapun'),
                ],
            ],
            [
                'question' => 'Apa output dari kode berikut?\nfor (int i = 1; i <= 3; i++) { print(i); }',
                'options'  => [
                    $this->opt('0 1 2'),
                    $this->opt('1 2 3', true),
                    $this->opt('1 2 3 4'),
                    $this->opt('0 1 2 3'),
                ],
            ],
            [
                'question' => 'Nested loop adalah...',
                'options'  => [
                    $this->opt('Loop yang tidak memiliki kondisi berhenti'),
                    $this->opt('Loop di dalam loop', true),
                    $this->opt('Loop yang hanya berjalan sekali'),
                    $this->opt('Loop yang menggunakan fungsi rekursif'),
                ],
            ],
            [
                'question' => 'Operator && dalam kondisi if berarti...',
                'options'  => [
                    $this->opt('OR - salah satu kondisi harus benar'),
                    $this->opt('NOT - membalik nilai boolean'),
                    $this->opt('AND - kedua kondisi harus benar', true),
                    $this->opt('XOR - hanya satu kondisi yang boleh benar'),
                ],
            ],
            [
                'question' => 'Infinite loop terjadi ketika...',
                'options'  => [
                    $this->opt('Loop hanya berjalan satu kali'),
                    $this->opt('Kondisi berhenti loop tidak pernah tercapai', true),
                    $this->opt('Loop memiliki terlalu banyak iterasi'),
                    $this->opt('Loop menggunakan variabel yang salah'),
                ],
            ],
        ];
    }

    private function algo1(): array
    {
        return [
            [
                'question' => 'Apa yang dimaksud dengan algoritma?',
                'options'  => [
                    $this->opt('Bahasa pemrograman tingkat tinggi'),
                    $this->opt('Langkah-langkah sistematis untuk menyelesaikan suatu masalah', true),
                    $this->opt('Struktur data untuk menyimpan informasi'),
                    $this->opt('Proses kompilasi program'),
                ],
            ],
            [
                'question' => 'Notasi O(1) dalam kompleksitas waktu berarti...',
                'options'  => [
                    $this->opt('Waktu eksekusi bertambah linear seiring ukuran input'),
                    $this->opt('Waktu eksekusi konstan, tidak bergantung pada ukuran input', true),
                    $this->opt('Waktu eksekusi kuadratik terhadap ukuran input'),
                    $this->opt('Waktu eksekusi logaritmik terhadap ukuran input'),
                ],
            ],
            [
                'question' => 'Kompleksitas waktu algoritma Bubble Sort dalam kasus terburuk adalah...',
                'options'  => [
                    $this->opt('O(n)'),
                    $this->opt('O(n log n)'),
                    $this->opt('O(n²)', true),
                    $this->opt('O(log n)'),
                ],
            ],
            [
                'question' => 'Algoritma Binary Search mensyaratkan data harus dalam kondisi...',
                'options'  => [
                    $this->opt('Acak'),
                    $this->opt('Terurut', true),
                    $this->opt('Duplikat'),
                    $this->opt('Bilangan bulat saja'),
                ],
            ],
            [
                'question' => 'Kompleksitas waktu Binary Search adalah...',
                'options'  => [
                    $this->opt('O(n)'),
                    $this->opt('O(n²)'),
                    $this->opt('O(log n)', true),
                    $this->opt('O(1)'),
                ],
            ],
            [
                'question' => 'Manakah yang memiliki kompleksitas waktu terbaik (tercepat)?',
                'options'  => [
                    $this->opt('O(n²)'),
                    $this->opt('O(n log n)'),
                    $this->opt('O(n)'),
                    $this->opt('O(1)', true),
                ],
            ],
            [
                'question' => 'Rekursi adalah teknik di mana...',
                'options'  => [
                    $this->opt('Fungsi memanggil fungsi lain secara bergantian'),
                    $this->opt('Fungsi memanggil dirinya sendiri', true),
                    $this->opt('Loop berjalan secara paralel'),
                    $this->opt('Program dijalankan dari bawah ke atas'),
                ],
            ],
            [
                'question' => 'Divide and Conquer adalah strategi algoritma yang...',
                'options'  => [
                    $this->opt('Mencoba semua kemungkinan solusi'),
                    $this->opt('Membagi masalah menjadi submasalah lebih kecil, menyelesaikannya, lalu menggabungkan hasilnya', true),
                    $this->opt('Memilih solusi terbaik di setiap langkah tanpa melihat ke depan'),
                    $this->opt('Menggunakan memori untuk menyimpan solusi submasalah'),
                ],
            ],
            [
                'question' => 'Kompleksitas waktu Merge Sort adalah...',
                'options'  => [
                    $this->opt('O(n)'),
                    $this->opt('O(n log n)', true),
                    $this->opt('O(n²)'),
                    $this->opt('O(log n)'),
                ],
            ],
            [
                'question' => 'Linear Search memiliki kompleksitas waktu kasus terburuk...',
                'options'  => [
                    $this->opt('O(1)'),
                    $this->opt('O(log n)'),
                    $this->opt('O(n)', true),
                    $this->opt('O(n²)'),
                ],
            ],
        ];
    }

    private function algo2(): array
    {
        return [
            [
                'question' => 'Array berbeda dengan Linked List karena array...',
                'options'  => [
                    $this->opt('Dapat menyimpan lebih banyak elemen'),
                    $this->opt('Menggunakan alokasi memori yang bersebelahan (contiguous)', true),
                    $this->opt('Mendukung traversal dua arah'),
                    $this->opt('Tidak memiliki batasan ukuran'),
                ],
            ],
            [
                'question' => 'Stack menggunakan prinsip...',
                'options'  => [
                    $this->opt('FIFO - First In First Out'),
                    $this->opt('LIFO - Last In First Out', true),
                    $this->opt('Random Access'),
                    $this->opt('Priority Based'),
                ],
            ],
            [
                'question' => 'Queue menggunakan prinsip...',
                'options'  => [
                    $this->opt('LIFO - Last In First Out'),
                    $this->opt('FIFO - First In First Out', true),
                    $this->opt('Random Access'),
                    $this->opt('Priority Based'),
                ],
            ],
            [
                'question' => 'Operasi menambahkan elemen ke dalam Stack disebut...',
                'options'  => [
                    $this->opt('Enqueue'),
                    $this->opt('Dequeue'),
                    $this->opt('Push', true),
                    $this->opt('Peek'),
                ],
            ],
            [
                'question' => 'Operasi menghapus elemen dari Queue disebut...',
                'options'  => [
                    $this->opt('Pop'),
                    $this->opt('Push'),
                    $this->opt('Enqueue'),
                    $this->opt('Dequeue', true),
                ],
            ],
            [
                'question' => 'Doubly Linked List berbeda dengan Singly Linked List karena...',
                'options'  => [
                    $this->opt('Setiap node memiliki pointer ke node berikutnya dan node sebelumnya', true),
                    $this->opt('Hanya dapat dilalui dari depan ke belakang'),
                    $this->opt('Ukurannya selalu dua kali lebih besar'),
                    $this->opt('Hanya dapat menyimpan dua elemen'),
                ],
            ],
            [
                'question' => 'Manakah aplikasi nyata dari struktur data Stack?',
                'options'  => [
                    $this->opt('Antrian cetak dokumen'),
                    $this->opt('Fitur undo/redo dalam text editor', true),
                    $this->opt('Penjadwalan proses CPU'),
                    $this->opt('Pencarian rute terpendek'),
                ],
            ],
            [
                'question' => 'Kompleksitas akses elemen array berdasarkan index adalah...',
                'options'  => [
                    $this->opt('O(n)'),
                    $this->opt('O(log n)'),
                    $this->opt('O(1)', true),
                    $this->opt('O(n²)'),
                ],
            ],
            [
                'question' => 'Circular Queue mengatasi masalah...',
                'options'  => [
                    $this->opt('Queue yang terlalu lambat'),
                    $this->opt('Pemborosan ruang pada Queue biasa saat elemen sudah dequeue', true),
                    $this->opt('Queue yang tidak dapat menyimpan tipe data berbeda'),
                    $this->opt('Queue yang tidak bisa di-resize'),
                ],
            ],
            [
                'question' => 'Pada Linked List, pointer NULL biasanya menunjukkan...',
                'options'  => [
                    $this->opt('Node pertama dalam list'),
                    $this->opt('Node tengah dalam list'),
                    $this->opt('Akhir dari list (tidak ada node selanjutnya)', true),
                    $this->opt('Node yang memiliki nilai nol'),
                ],
            ],
        ];
    }

    private function oop1(): array
    {
        return [
            [
                'question' => 'Apa yang dimaksud dengan Class dalam OOP?',
                'options'  => [
                    $this->opt('Instance atau objek nyata dalam program'),
                    $this->opt('Blueprint atau cetak biru untuk membuat objek', true),
                    $this->opt('Fungsi yang berdiri sendiri tanpa objek'),
                    $this->opt('Tipe data primitif dalam program'),
                ],
            ],
            [
                'question' => 'Constructor dalam sebuah Class berfungsi untuk...',
                'options'  => [
                    $this->opt('Menghapus objek dari memori'),
                    $this->opt('Menginisialisasi objek saat pertama kali dibuat', true),
                    $this->opt('Menghitung jumlah objek yang dibuat'),
                    $this->opt('Mengakses atribut private dari luar class'),
                ],
            ],
            [
                'question' => 'Access modifier "private" berarti...',
                'options'  => [
                    $this->opt('Atribut/method dapat diakses dari mana saja'),
                    $this->opt('Atribut/method hanya dapat diakses dari dalam class itu sendiri', true),
                    $this->opt('Atribut/method dapat diakses oleh class turunannya'),
                    $this->opt('Atribut/method dapat diakses dari package yang sama'),
                ],
            ],
            [
                'question' => 'Method getter dan setter digunakan untuk...',
                'options'  => [
                    $this->opt('Membuat class baru dari class yang sudah ada'),
                    $this->opt('Mengakses dan memodifikasi atribut private secara terkontrol', true),
                    $this->opt('Menghapus objek dari memori'),
                    $this->opt('Mendeklarasikan atribut class'),
                ],
            ],
            [
                'question' => 'Objek dalam OOP adalah...',
                'options'  => [
                    $this->opt('Template untuk membuat instance'),
                    $this->opt('Kumpulan fungsi yang tidak berhubungan'),
                    $this->opt('Instance konkret dari sebuah class', true),
                    $this->opt('Tipe data yang hanya menyimpan angka'),
                ],
            ],
            [
                'question' => 'Keyword "this" dalam OOP merujuk ke...',
                'options'  => [
                    $this->opt('Class induk'),
                    $this->opt('Instance objek saat ini', true),
                    $this->opt('Method yang sedang dipanggil'),
                    $this->opt('Constructor class'),
                ],
            ],
            [
                'question' => 'Manakah yang bukan merupakan pilar utama OOP?',
                'options'  => [
                    $this->opt('Encapsulation'),
                    $this->opt('Inheritance'),
                    $this->opt('Polymorphism'),
                    $this->opt('Compilation', true),
                ],
            ],
            [
                'question' => 'Static method dalam sebuah class dapat dipanggil...',
                'options'  => [
                    $this->opt('Hanya melalui instance objek'),
                    $this->opt('Tanpa harus membuat instance objek terlebih dahulu', true),
                    $this->opt('Hanya dari dalam class yang sama'),
                    $this->opt('Hanya oleh class turunannya'),
                ],
            ],
            [
                'question' => 'Access modifier "protected" memungkinkan akses dari...',
                'options'  => [
                    $this->opt('Hanya dari dalam class itu sendiri'),
                    $this->opt('Dari mana saja'),
                    $this->opt('Class itu sendiri dan class turunannya', true),
                    $this->opt('Semua class dalam satu package'),
                ],
            ],
            [
                'question' => 'Destructor dalam OOP digunakan untuk...',
                'options'  => [
                    $this->opt('Membuat objek baru'),
                    $this->opt('Membersihkan sumber daya saat objek tidak lagi dibutuhkan', true),
                    $this->opt('Menginisialisasi atribut class'),
                    $this->opt('Mengakses atribut private'),
                ],
            ],
        ];
    }

    private function oop2(): array
    {
        return [
            [
                'question' => 'Inheritance memungkinkan class turunan untuk...',
                'options'  => [
                    $this->opt('Membuat instance baru dari class induk'),
                    $this->opt('Mewarisi atribut dan method dari class induk', true),
                    $this->opt('Menghapus method dari class induk'),
                    $this->opt('Mengubah tipe data atribut class induk'),
                ],
            ],
            [
                'question' => 'Method Overriding adalah ketika...',
                'options'  => [
                    $this->opt('Class turunan mendefinisikan ulang method yang sudah ada di class induk', true),
                    $this->opt('Dua method memiliki nama sama tapi parameter berbeda dalam class yang sama'),
                    $this->opt('Method dipanggil dengan nama berbeda'),
                    $this->opt('Class memiliki lebih dari satu constructor'),
                ],
            ],
            [
                'question' => 'Method Overloading adalah ketika...',
                'options'  => [
                    $this->opt('Class turunan mendefinisikan ulang method class induk'),
                    $this->opt('Dua method memiliki nama yang sama tetapi parameter berbeda dalam class yang sama', true),
                    $this->opt('Method memanggil dirinya sendiri'),
                    $this->opt('Method diakses dari luar class'),
                ],
            ],
            [
                'question' => 'Polymorphism dalam OOP berarti...',
                'options'  => [
                    $this->opt('Sebuah class hanya bisa memiliki satu bentuk'),
                    $this->opt('Objek dari class berbeda dapat diperlakukan sebagai objek dari class yang sama', true),
                    $this->opt('Class tidak bisa diwarisi'),
                    $this->opt('Method hanya bisa dipanggil sekali'),
                ],
            ],
            [
                'question' => 'Abstract class dalam OOP...',
                'options'  => [
                    $this->opt('Dapat diinstansiasi langsung'),
                    $this->opt('Tidak dapat diinstansiasi dan biasanya memiliki minimal satu abstract method', true),
                    $this->opt('Tidak dapat diwarisi oleh class lain'),
                    $this->opt('Hanya berisi atribut, tanpa method'),
                ],
            ],
            [
                'question' => 'Interface berbeda dengan Abstract Class karena...',
                'options'  => [
                    $this->opt('Interface dapat diinstansiasi'),
                    $this->opt('Interface hanya mendefinisikan kontrak method tanpa implementasi (di banyak bahasa)', true),
                    $this->opt('Interface bisa memiliki constructor'),
                    $this->opt('Interface tidak bisa diimplementasikan oleh lebih dari satu class'),
                ],
            ],
            [
                'question' => 'Keyword "super" dalam Java atau "parent::" dalam PHP digunakan untuk...',
                'options'  => [
                    $this->opt('Membuat instance baru dari class induk'),
                    $this->opt('Memanggil method atau constructor dari class induk', true),
                    $this->opt('Mendeklarasikan class sebagai abstract'),
                    $this->opt('Mengimplementasikan interface'),
                ],
            ],
            [
                'question' => 'Multiple inheritance (mewarisi dari lebih dari satu class) di Java dihindari karena...',
                'options'  => [
                    $this->opt('Java tidak mendukung class sama sekali'),
                    $this->opt('Dapat menyebabkan ambiguitas (Diamond Problem)', true),
                    $this->opt('Membutuhkan terlalu banyak memori'),
                    $this->opt('Membuat program menjadi lebih lambat'),
                ],
            ],
            [
                'question' => 'Encapsulation bertujuan untuk...',
                'options'  => [
                    $this->opt('Membuat semua atribut dapat diakses secara publik'),
                    $this->opt('Menyembunyikan detail implementasi dan melindungi data dari akses langsung', true),
                    $this->opt('Membuat class tidak bisa diwarisi'),
                    $this->opt('Memungkinkan satu method melakukan banyak hal'),
                ],
            ],
            [
                'question' => 'Apa yang dimaksud dengan "is-a relationship" dalam OOP?',
                'options'  => [
                    $this->opt('Hubungan komposisi antara dua objek'),
                    $this->opt('Hubungan pewarisan di mana class turunan adalah jenis dari class induk', true),
                    $this->opt('Hubungan di mana objek menggunakan objek lain'),
                    $this->opt('Hubungan antara method dan atribut'),
                ],
            ],
        ];
    }

    private function db1(): array
    {
        return [
            [
                'question' => 'ERD (Entity Relationship Diagram) digunakan untuk...',
                'options'  => [
                    $this->opt('Menulis query SQL'),
                    $this->opt('Menggambarkan struktur dan hubungan antar data dalam database', true),
                    $this->opt('Menampilkan data dalam bentuk tabel'),
                    $this->opt('Mengoptimalkan performa database'),
                ],
            ],
            [
                'question' => 'Primary Key dalam database adalah...',
                'options'  => [
                    $this->opt('Kolom yang nilainya boleh duplikat'),
                    $this->opt('Kolom yang nilainya unik dan tidak boleh NULL untuk mengidentifikasi setiap baris', true),
                    $this->opt('Kolom yang merujuk ke tabel lain'),
                    $this->opt('Kolom yang berisi kata sandi terenkripsi'),
                ],
            ],
            [
                'question' => 'Foreign Key digunakan untuk...',
                'options'  => [
                    $this->opt('Mengidentifikasi baris secara unik dalam tabel'),
                    $this->opt('Membuat relasi antara dua tabel', true),
                    $this->opt('Mengenkripsi data sensitif'),
                    $this->opt('Meningkatkan kecepatan pencarian'),
                ],
            ],
            [
                'question' => 'Normalisasi database bertujuan untuk...',
                'options'  => [
                    $this->opt('Memperbesar ukuran database'),
                    $this->opt('Mengurangi redundansi data dan dependency anomali', true),
                    $this->opt('Membuat query lebih panjang'),
                    $this->opt('Menambahkan lebih banyak tabel'),
                ],
            ],
            [
                'question' => 'Tabel dalam bentuk 1NF (First Normal Form) mensyaratkan...',
                'options'  => [
                    $this->opt('Tidak ada data yang berulang antar tabel'),
                    $this->opt('Setiap kolom berisi nilai atomik (tidak dapat dibagi lagi)', true),
                    $this->opt('Semua atribut bergantung pada seluruh primary key'),
                    $this->opt('Tidak ada transitive dependency'),
                ],
            ],
            [
                'question' => 'Hubungan many-to-many antar dua tabel biasanya diselesaikan dengan...',
                'options'  => [
                    $this->opt('Menambahkan foreign key di salah satu tabel'),
                    $this->opt('Membuat tabel pivot/junction sebagai perantara', true),
                    $this->opt('Menggabungkan kedua tabel menjadi satu'),
                    $this->opt('Menghapus salah satu tabel'),
                ],
            ],
            [
                'question' => 'Apa yang dimaksud dengan DBMS?',
                'options'  => [
                    $this->opt('Database Manipulation System'),
                    $this->opt('Database Management System — perangkat lunak untuk membuat dan mengelola database', true),
                    $this->opt('Data Backup Management Solution'),
                    $this->opt('Database Migration Script'),
                ],
            ],
            [
                'question' => 'Index dalam database digunakan untuk...',
                'options'  => [
                    $this->opt('Menambah keamanan data'),
                    $this->opt('Mempercepat proses pencarian dan query', true),
                    $this->opt('Menyimpan backup data'),
                    $this->opt('Menghapus data duplikat'),
                ],
            ],
            [
                'question' => '2NF (Second Normal Form) mensyaratkan tabel sudah dalam 1NF dan...',
                'options'  => [
                    $this->opt('Tidak ada transitive dependency'),
                    $this->opt('Semua atribut non-key bergantung penuh pada seluruh primary key', true),
                    $this->opt('Setiap kolom memiliki nilai yang unik'),
                    $this->opt('Tidak ada kolom yang bisa NULL'),
                ],
            ],
            [
                'question' => 'Relasi one-to-many berarti...',
                'options'  => [
                    $this->opt('Satu record di tabel A bisa berelasi dengan banyak record di tabel B', true),
                    $this->opt('Satu record hanya bisa berelasi dengan satu record lainnya'),
                    $this->opt('Banyak record di tabel A berelasi dengan banyak record di tabel B'),
                    $this->opt('Tidak ada relasi antar tabel'),
                ],
            ],
        ];
    }

    private function db2(): array
    {
        return [
            [
                'question' => 'Perintah SQL untuk membuat tabel baru adalah...',
                'options'  => [
                    $this->opt('MAKE TABLE'),
                    $this->opt('CREATE TABLE', true),
                    $this->opt('NEW TABLE'),
                    $this->opt('ADD TABLE'),
                ],
            ],
            [
                'question' => 'Perintah SQL untuk menambahkan data baru ke tabel adalah...',
                'options'  => [
                    $this->opt('ADD INTO'),
                    $this->opt('APPEND INTO'),
                    $this->opt('INSERT INTO', true),
                    $this->opt('PUT INTO'),
                ],
            ],
            [
                'question' => 'Klausul WHERE dalam SQL digunakan untuk...',
                'options'  => [
                    $this->opt('Mengurutkan hasil query'),
                    $this->opt('Memfilter baris berdasarkan kondisi tertentu', true),
                    $this->opt('Menggabungkan dua tabel'),
                    $this->opt('Mengelompokkan hasil query'),
                ],
            ],
            [
                'question' => 'INNER JOIN menghasilkan...',
                'options'  => [
                    $this->opt('Semua baris dari tabel kiri meskipun tidak ada padanan di tabel kanan'),
                    $this->opt('Semua baris dari kedua tabel'),
                    $this->opt('Hanya baris yang memiliki nilai cocok di kedua tabel', true),
                    $this->opt('Semua baris dari tabel kanan meskipun tidak ada padanan di tabel kiri'),
                ],
            ],
            [
                'question' => 'Perintah SQL untuk menghapus seluruh tabel beserta strukturnya adalah...',
                'options'  => [
                    $this->opt('DELETE TABLE'),
                    $this->opt('REMOVE TABLE'),
                    $this->opt('TRUNCATE TABLE'),
                    $this->opt('DROP TABLE', true),
                ],
            ],
            [
                'question' => 'Fungsi COUNT() dalam SQL digunakan untuk...',
                'options'  => [
                    $this->opt('Menjumlahkan nilai dalam kolom'),
                    $this->opt('Menghitung rata-rata nilai'),
                    $this->opt('Menghitung jumlah baris', true),
                    $this->opt('Mencari nilai maksimum'),
                ],
            ],
            [
                'question' => 'Klausul GROUP BY digunakan bersama dengan...',
                'options'  => [
                    $this->opt('WHERE untuk memfilter setelah pengelompokkan'),
                    $this->opt('Fungsi agregat seperti COUNT, SUM, AVG untuk meringkas data per grup', true),
                    $this->opt('ORDER BY untuk mengurutkan sebelum pengelompokkan'),
                    $this->opt('JOIN untuk menggabungkan banyak tabel'),
                ],
            ],
            [
                'question' => 'Perbedaan DELETE dan TRUNCATE adalah...',
                'options'  => [
                    $this->opt('TRUNCATE dapat menggunakan WHERE, DELETE tidak bisa'),
                    $this->opt('DELETE menghapus baris per baris (bisa dengan kondisi WHERE), TRUNCATE menghapus semua baris sekaligus', true),
                    $this->opt('DELETE menghapus struktur tabel, TRUNCATE hanya data'),
                    $this->opt('Tidak ada perbedaan, keduanya sama'),
                ],
            ],
            [
                'question' => 'LEFT JOIN menghasilkan...',
                'options'  => [
                    $this->opt('Hanya baris yang cocok di kedua tabel'),
                    $this->opt('Semua baris dari tabel kiri, ditambah baris yang cocok dari tabel kanan (NULL jika tidak ada)', true),
                    $this->opt('Semua baris dari tabel kanan saja'),
                    $this->opt('Semua baris dari kedua tabel tanpa duplikat'),
                ],
            ],
            [
                'question' => 'Subquery adalah...',
                'options'  => [
                    $this->opt('Query yang berjalan secara paralel'),
                    $this->opt('Query yang nested di dalam query lain', true),
                    $this->opt('Query tanpa klausul WHERE'),
                    $this->opt('Query yang hanya mengambil satu kolom'),
                ],
            ],
        ];
    }

    private function web1(): array
    {
        return [
            [
                'question' => 'Tag HTML yang digunakan untuk membuat hyperlink adalah...',
                'options'  => [
                    $this->opt('<link>'),
                    $this->opt('<a>', true),
                    $this->opt('<href>'),
                    $this->opt('<url>'),
                ],
            ],
            [
                'question' => 'Elemen semantik HTML5 yang digunakan untuk konten navigasi adalah...',
                'options'  => [
                    $this->opt('<div>'),
                    $this->opt('<span>'),
                    $this->opt('<nav>', true),
                    $this->opt('<section>'),
                ],
            ],
            [
                'question' => 'Property CSS "display: flex" digunakan untuk...',
                'options'  => [
                    $this->opt('Membuat elemen menghilang dari halaman'),
                    $this->opt('Membuat container menggunakan model layout Flexbox', true),
                    $this->opt('Menetapkan posisi elemen secara absolut'),
                    $this->opt('Membuat elemen menjadi inline'),
                ],
            ],
            [
                'question' => 'CSS selector ".container" merujuk ke...',
                'options'  => [
                    $this->opt('Elemen dengan id="container"'),
                    $this->opt('Elemen dengan class="container"', true),
                    $this->opt('Semua elemen <container>'),
                    $this->opt('Elemen pertama di dalam body'),
                ],
            ],
            [
                'question' => 'Atribut HTML yang digunakan untuk menentukan tujuan link adalah...',
                'options'  => [
                    $this->opt('src'),
                    $this->opt('href', true),
                    $this->opt('link'),
                    $this->opt('url'),
                ],
            ],
            [
                'question' => 'Box model dalam CSS terdiri dari (dari dalam ke luar)...',
                'options'  => [
                    $this->opt('Content → Border → Padding → Margin'),
                    $this->opt('Content → Padding → Border → Margin', true),
                    $this->opt('Margin → Border → Padding → Content'),
                    $this->opt('Content → Margin → Padding → Border'),
                ],
            ],
            [
                'question' => 'Tag HTML5 <header> digunakan untuk...',
                'options'  => [
                    $this->opt('Membuat heading level satu'),
                    $this->opt('Mendefinisikan bagian kepala dokumen atau section tertentu', true),
                    $this->opt('Menambahkan metadata ke dokumen'),
                    $this->opt('Membuat tabel di dalam halaman'),
                ],
            ],
            [
                'question' => 'CSS property "position: absolute" membuat elemen...',
                'options'  => [
                    $this->opt('Mengikuti alur normal dokumen'),
                    $this->opt('Diposisikan relatif terhadap ancestor terdekat yang memiliki position selain static', true),
                    $this->opt('Selalu berada di pojok kiri atas halaman'),
                    $this->opt('Tidak dapat dipindahkan sama sekali'),
                ],
            ],
            [
                'question' => 'Manakah cara yang benar untuk menghubungkan file CSS eksternal ke HTML?',
                'options'  => [
                    $this->opt('<style src="style.css">'),
                    $this->opt('<css href="style.css">'),
                    $this->opt('<link rel="stylesheet" href="style.css">', true),
                    $this->opt('<import href="style.css">'),
                ],
            ],
            [
                'question' => 'Media query dalam CSS digunakan untuk...',
                'options'  => [
                    $this->opt('Menambahkan audio ke halaman web'),
                    $this->opt('Menerapkan style berbeda berdasarkan karakteristik perangkat seperti lebar layar', true),
                    $this->opt('Mengambil data dari server'),
                    $this->opt('Membuat animasi pada elemen'),
                ],
            ],
        ];
    }

    private function web2(): array
    {
        return [
            [
                'question' => 'DOM dalam JavaScript singkatan dari...',
                'options'  => [
                    $this->opt('Data Object Model'),
                    $this->opt('Document Object Model', true),
                    $this->opt('Dynamic Object Manipulation'),
                    $this->opt('Document Oriented Method'),
                ],
            ],
            [
                'question' => 'Method JavaScript untuk memilih elemen berdasarkan id adalah...',
                'options'  => [
                    $this->opt('document.querySelector()'),
                    $this->opt('document.getElement()'),
                    $this->opt('document.getElementById()', true),
                    $this->opt('document.selectById()'),
                ],
            ],
            [
                'question' => 'Event listener "click" dalam JavaScript dipasang menggunakan...',
                'options'  => [
                    $this->opt('element.onClick()'),
                    $this->opt('element.addEventListener("click", handler)', true),
                    $this->opt('element.clickEvent()'),
                    $this->opt('element.on("click")'),
                ],
            ],
            [
                'question' => 'PHP adalah singkatan dari...',
                'options'  => [
                    $this->opt('Personal Home Page (secara historis), kini PHP: Hypertext Preprocessor', true),
                    $this->opt('Programmable Hypertext Protocol'),
                    $this->opt('Public HTML Processor'),
                    $this->opt('Python HTML PHP'),
                ],
            ],
            [
                'question' => 'Kode PHP dieksekusi di...',
                'options'  => [
                    $this->opt('Browser client'),
                    $this->opt('Server', true),
                    $this->opt('Database'),
                    $this->opt('CDN'),
                ],
            ],
            [
                'question' => 'Cara yang benar untuk mendeklarasikan variabel di PHP adalah...',
                'options'  => [
                    $this->opt('var nama = "value";'),
                    $this->opt('let nama = "value";'),
                    $this->opt('$nama = "value";', true),
                    $this->opt('dim nama = "value";'),
                ],
            ],
            [
                'question' => 'fetch() API dalam JavaScript digunakan untuk...',
                'options'  => [
                    $this->opt('Memanipulasi elemen DOM'),
                    $this->opt('Membuat HTTP request ke server secara asynchronous', true),
                    $this->opt('Menyimpan data ke localStorage'),
                    $this->opt('Memvalidasi form input'),
                ],
            ],
            [
                'question' => 'JSON singkatan dari...',
                'options'  => [
                    $this->opt('JavaScript Object Node'),
                    $this->opt('JavaScript Object Notation', true),
                    $this->opt('Java Standard Object Name'),
                    $this->opt('JavaScript Online Network'),
                ],
            ],
            [
                'question' => 'Superglobal $_POST di PHP digunakan untuk...',
                'options'  => [
                    $this->opt('Mengirim data ke server'),
                    $this->opt('Mengambil data yang dikirim melalui metode HTTP POST dari form', true),
                    $this->opt('Menyimpan data ke database'),
                    $this->opt('Mengambil data dari URL (query string)'),
                ],
            ],
            [
                'question' => 'Manakah yang merupakan JavaScript framework/library untuk frontend?',
                'options'  => [
                    $this->opt('Laravel'),
                    $this->opt('Django'),
                    $this->opt('React', true),
                    $this->opt('Spring Boot'),
                ],
            ],
        ];
    }
}
