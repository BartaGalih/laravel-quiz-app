<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;

class m_course extends Model
{
    static function course($course_id) {
        return [
            'id' => $course_id,
            'title' => 'Belajar Laravel untuk Pemula',
            'description' => 'Course ini akan mengajarkan dasar-dasar Laravel dengan cara yang mudah dipahami.',
            'materials_count' => 12,
            'quizzes_count' => 3,
            'progress' => 70,
        ];
    }

    static function items($course_id) {
        return [
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
        ];
    }
}
