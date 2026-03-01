<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data['courses'] = [
            [
                'title' => 'Laravel for Beginners',
                'materials' => 12,
                'quizzes' => 3,
                'progress' => 70,
            ],
            [
                'title' => 'Advanced PHP Concepts',
                'materials' => 8,
                'quizzes' => 2,
                'progress' => 40,
            ],
            [
                'title' => 'Web Development with Laravel',
                'materials' => 15,
                'quizzes' => 5,
                'progress' => 20,
            ],
        ];
        $data['todos'] = [
            [
                'title' => 'Complete Laravel course',
                'completed' => false,
                'due' => 'Fri, 21 Jan, 12:00 PM',
            ],
            [
                'title' => 'Review PHP basics',
                'completed' => true,
                'due' => 'Fri, 21 Jan, 12:00 PM',
            ],
            [
                'title' => 'Take quiz on Eloquent',
                'completed' => false,
                'due' => 'Fri, 21 Jan, 12:00 PM',
            ],
        ];
        return view('user.dashboard', $data);
    }
}
