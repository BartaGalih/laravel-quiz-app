<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan penting — ikuti dependency antar tabel
        $this->call([
            AdminSeeder::class,                 // 0. administrators table
            UserSeeder::class,                  // 1. users (students)
            CourseSeeder::class,                // 2. courses
            CourseMaterialSeeder::class,        // 3. course_materials
            QuizSeeder::class,                  // 4. quizzes
            QuestionSeeder::class,              // 5. questions + question_options
            EnrollmentAndProgressSeeder::class, // 6. enrollments, material_progress, quiz_attempts, answers
        ]);
    }
}
