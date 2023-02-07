<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

use Carbon\Carbon;

use App\Http\Controllers\Controller;

class FooterController extends Controller
{
    
    public function colleges() {

        $colleges = DB::table('college')
                            ->where('status', 1)
                            ->select('stream_id')
                            ->get();

        $streams_array = array();

        if( !empty($colleges) ) {
            foreach($colleges as $college) {

                $streams = $college->stream_id;
                $streams = explode(',', $streams);

                if( !empty($streams) ) {
                    foreach($streams as $stream) {

                        $streams_array[] = $stream;
                    }
                }
            }
        }

        $streams_array = array_unique($streams_array);
        $streams = array_slice($streams_array, 0, 5);

        $streams = DB::table('streams')
                    ->whereIn('id', $streams)
                    ->orderBy('streams.created_at', 'asc')
                    ->get();

        return $streams;
    }
    
    public function exams() {
        return DB::table('exams')
                ->join(
                    'streams',
                    'streams.id',
                    'exams.stream_id'
                )
                ->where('exams.status', 'enable')
                ->where('streams.status', 'enable')
                ->take(6)
                ->distinct('streams.id')
                ->select('streams.name as title')
                ->orderBy('streams.created_at', 'asc')
                ->get();
    }

    public function coachings() {

        $coachings = DB::table('coaching_courses')
                        ->join(
                            'courses',
                            'courses.name',
                            'coaching_courses.name'
                        )
                        ->join(
                            'streams',
                            'streams.id',
                            'courses.stream_id'
                        )
                        ->where('coaching_courses.status', 'enable')
                        ->where('courses.status', 'enable')
                        ->where('streams.status', 'enable')
                        ->take(6)
                        ->distinct('streams.id')
                        ->select('streams.name')
                        ->orderBy('streams.created_at', 'asc')
                        ->get();

        return $coachings;
    }

    public function question_paper_subjects() {

        $question_paper_subjects = DB::table('question_paper_subjects')
                                    ->join('streams', 'streams.id', 'question_paper_subjects.stream_id')
                                    ->join('courses', 'courses.id', 'question_paper_subjects.course_id')
                                    ->take(6)
                                    ->distinct('streams.id')
                                    ->select('streams.name')
                                    ->where('streams.status', 'enable')
                                    ->where('courses.status', 'enable')
                                    ->orderBy('streams.created_at', 'asc')
                                    ->get();

        return $question_paper_subjects;
    }
}
