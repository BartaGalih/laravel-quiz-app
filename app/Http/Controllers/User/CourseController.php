<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function index($id) {
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
                    'title' => 'Routing di Laravel',
                    'completed' => false,
                    'type' => 'quiz',
                    'duration' => '15:00',
                    'questions' => 5,
                ],
            ],
        ];
        
        $data['todos'] = [
            [
                'title' => 'Complete Laravel course',
                'completed' => false,
                'due' => 'Fri, 21 Jan, 12:00 PM',
            ],
        ];

        return view('user.course.index', $data);
        
    }
}
