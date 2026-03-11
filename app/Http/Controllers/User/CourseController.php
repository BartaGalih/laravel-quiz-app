<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\m_course;
class CourseController extends Controller
{
    function index($id) {
        $course = m_course::course($id);
        $data['course'] = $course;

        $data['items'] = m_course::items($id);

        $data['todos'] = [
            [
                'title' => 'Complete Laravel course',
                'completed' => false,
                'due' => 'Fri, 21 Jan, 12:00 PM',
            ],
        ];

        $data['breadcrumbs'] = [
            [
                'url' => 'dashboard',
                'label' => 'Course',
            ],
            [
                'url' => 'course/' . $id,
                'label' => $course['title'],
            ]
        ];

        return view('user.course.index', $data);
        
    }

    function quizPreview($id) {
        $data['course'] = [
            'id' => $id,
            'title' => 'Belajar Laravel untuk Pemula',
            'description' => 'Course ini akan mengajarkan dasar-dasar Laravel dengan cara yang mudah dipahami.',
            'materials_count' => 12,
            'quizzes_count' => 3,
            'progress' => 70,
            'items' => [
                [
                    'title' => 'Pengenalan Laravel',
                    'completed' => true,
                    'type' => 'video',
                    'duration' => '10:00',
                ],
                [
                    'title' => 'Instalasi dan Setup',
                    'completed' => true,
                    'type' => 'material',
                    'pages' => '5',
                ],
                [
                    'title' => 'Routing di Laravel',
                    'completed' => false,
                    'type' => 'video',
                    'duration' => '15:00',
                ],
                [
                    'id' => 1,
                    'title' => 'Routing di Laravel',
                    'completed' => false,
                    'type' => 'quiz',
                    'duration' => '15:00',
                    'questions' => 5,
                ],
            ],
        ];

        
        $data['quiz'] = [
            'id'              => 1,
            'title'           => 'Quiz 1',
            'time_limit'      => 60,
            'questions_count' => 50,
            'max_attempts'    => 3,
            'user_attempts'   => 1,
        ];

        $data['attempts'] = collect([
            (object) [
                'created_at' => now()->subDays(3),
                'score'      => 38,
                'passed'     => true,
            ],
        ]);

        $data['todos'] = [
            [
                'title' => 'Complete Laravel course',
                'completed' => false,
                'due' => 'Fri, 21 Jan, 12:00 PM',
            ],
        ];
        return view('user.course.quiz-preview', $data);
    }
}
