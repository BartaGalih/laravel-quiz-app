<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\CourseEnrollment;
use App\Models\MaterialProgress;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;

class EnrollmentAndProgressSeeder extends Seeder
{
    public function run(): void
    {
        $students  = User::where('is_admin', false)->get();
        $courses   = Course::where('is_published', true)->with(['materials', 'quizzes.questions.options'])->get();

        foreach ($students as $student) {
            // Each student enrolls in 2–4 random courses
            $enrolled = $courses->random(rand(2, 4));

            foreach ($enrolled as $course) {
                // Enroll
                CourseEnrollment::create([
                    'user_id'     => $student->id,
                    'course_id'   => $course->id,
                    'enrolled_at' => now()->subDays(rand(5, 60)),
                ]);

                // Material progress — mark some as completed
                foreach ($course->materials as $material) {
                    $completed = (bool) rand(0, 1);
                    MaterialProgress::create([
                        'user_id'            => $student->id,
                        'course_material_id' => $material->id,
                        'is_completed'       => $completed,
                        'completed_at'       => $completed ? now()->subDays(rand(1, 30)) : null,
                    ]);
                }

                // Quiz attempts — attempt published quizzes with realistic scores
                foreach ($course->quizzes as $quiz) {
                    // ~80% chance student has attempted this quiz
                    if (rand(1, 10) > 2) {
                        $this->createAttempt($student->id, $quiz);
                    }
                }
            }
        }
    }

    private function createAttempt(int $userId, Quiz $quiz): void
    {
        $questions = $quiz->questions;
        if ($questions->isEmpty()) return;

        $total        = $questions->count();
        $startedAt    = now()->subDays(rand(1, 30))->subHours(rand(0, 5));
        $isSubmitted  = (bool) rand(0, 4); // ~80% submitted
        $submittedAt  = $isSubmitted ? $startedAt->copy()->addMinutes(rand(20, $quiz->duration_minutes)) : null;

        // Simulate score — realistic distribution: mostly 60-95
        $correctCount = $isSubmitted ? rand((int)($total * 0.4), $total) : null;
        $score        = $isSubmitted ? (int) round(($correctCount / $total) * 100) : null;
        $isPassed     = $isSubmitted ? ($score >= $quiz->passing_score) : null;

        $attempt = QuizAttempt::create([
            'user_id'          => $userId,
            'quiz_id'          => $quiz->id,
            'score'            => $score,
            'correct_answers'  => $correctCount,
            'total_questions'  => $isSubmitted ? $total : null,
            'is_passed'        => $isPassed,
            'started_at'       => $startedAt,
            'submitted_at'     => $submittedAt,
        ]);

        // Seed per-question answers
        $correctAnswered = 0;
        foreach ($questions as $i => $question) {
            $options = $question->options;
            if ($options->isEmpty()) continue;

            $correctOption = $options->firstWhere('is_correct', true);
            $wrongOptions  = $options->where('is_correct', false)->values();

            // Decide if this question is answered correctly
            $answerCorrect = $isSubmitted && $i < $correctCount;
            $chosen        = null;

            if ($isSubmitted) {
                if ($answerCorrect && $correctOption) {
                    $chosen = $correctOption->id;
                } elseif ($wrongOptions->isNotEmpty()) {
                    $chosen = $wrongOptions->random()->id;
                }
            }

            QuizAttemptAnswer::create([
                'quiz_attempt_id'    => $attempt->id,
                'question_id'        => $question->id,
                'question_option_id' => $chosen,
                'is_flagged'         => rand(0, 8) === 0, // ~12% flagged
            ]);
        }
    }
}
