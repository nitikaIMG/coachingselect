<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;
// use App\Http\Controllers\Website\Auth;

class StudentQuestionsAnswersController extends Controller
{

    public function student_questions()
    {

        $header = new HeaderController();
        $footer = new FooterController();

        $student_questions = DB::table('student_questions')
            ->join('students', 'students.id', 'student_questions.user_id')
            ->where('student_questions.status', 'enable')
            ->select('student_questions.*', 'students.name as student_name', 'students.image');
        $tags = $this->tags();

        $student_questions = $this->searching(request(), $student_questions);

        $student_questions = $this->latest_answer($student_questions->get());

        $student_questions = $this->has_my_answer($student_questions);
        $student_questions = $this->reported_by_me($student_questions);
        $student_questions = $this->student_profile($student_questions);
        // $student_questions = $student_questions->unique('student_name');

        $metatitle = "Q & A (Question and Answer) - Fees, Courses, Offers, Reviews, Ranking, Counselling";

        $metadescription = "Get help with your education homework! Find the answers you need for hundreds of education questions explained in a way that is easy to understand. In case you don't see the question you looking for, you can always send it to our experts!";

        $metakeywords = 'CoachingSelect, gk, general, knowledge, quiz, awareness, questions, answers, explanation, interview, entrance, exam, solutions, examples, test, quiz, pdf, download, freshers, ebooks,student community,Counselling for students,experts answer your questions,Courses, Exams, Schools, Careers Options,foreign education, college, university, institute,courses, coaching, technical education, higher education, forum, community, education career experts,ask experts, admissions, results, events,scholarships, student forum';

        return view(
            'website.student_questions',
            compact(
                'metatitle',
                'metadescription',
                'metakeywords',
                'header',
                'footer',
                'student_questions',
                'tags'
            )
        );
    }

    public function tags()
    {

        $student_questions = DB::table('student_questions')
            ->join('students', 'students.id', 'student_questions.user_id')
            ->where('student_questions.status', 'enable')
            ->orderBy('student_questions.created_at', 'desc')
            ->select('student_questions.*', 'students.name as student_name', 'students.image')
            ->get();

        $tags = array();

        if (!empty($student_questions)) {
            foreach ($student_questions as $student_question) {

                $question_tags = $student_question->tags;
                $question_tags = explode(',', $question_tags);

                if (!empty($question_tags)) {
                    foreach ($question_tags as $question_tag) {
                        $tags[$question_tag] = true;
                    }
                }
            }
        }

        $tags = array_keys($tags);
        $tags = array_slice($tags, 0, 10);

        return $tags;
    }

    public function searching($request, $student_questions)
    {

        # by tag

        if ($request->has('tag') and !empty($request->get('tag'))) {

            $tag = $request->get('tag');

            $student_questions = $student_questions->where('tags', 'LIKE', '%' . $tag . '%');
        }

        # by topic

        if ($request->has('topic') and !empty($request->get('topic'))) {

            $topic = $request->get('topic');

            $student_questions = $student_questions->where('student_questions.name', 'LIKE', '%' . $topic . '%');
        }

        # by tab

        if ($request->has('tab') and !empty($request->get('tab'))) {

            $tab = $request->get('tab');

            if ($tab == 'newest') {
                $student_questions = $student_questions
                    ->orderBy('student_questions.created_at', 'desc');
            }

            if ($tab == 'popular') {
                $student_questions = $student_questions
                    ->orderBy('student_questions.views', 'desc');
            }

            if ($tab == 'unanswered') {
                $student_questions = $student_questions
                    ->where('student_questions.total_answered', 0)
                    ->orderBy('student_questions.created_at', 'desc');
            }
        }

        if (empty($request->get('tab'))) {

            $student_questions = $student_questions
                ->orderBy('created_at', 'desc');
        }

        return $student_questions;
    }

    public function latest_answer($student_questions)
    {

        if (!empty($student_questions)) {
            foreach ($student_questions as $student_question) {

                $latest_answer = DB::table('student_answers')
                    ->join('students', 'students.id', 'student_answers.user_id')
                    ->where('student_answers.status', 'enable')
                    ->select('student_answers.*', 'students.name as student_name', 'students.image')
                    ->where('student_answers.student_question_id', $student_question->id)
                    ->orderBy('student_answers.created_at', 'desc')
                    ->first();

                if (!empty($latest_answer)) {

                    $student_profile = DB::table('students')
                        ->where('id', $latest_answer->user_id)
                        ->select('created_at', 'state', 'image')
                        ->first();

                    $latest_answer->student_image = $student_profile->image;
                    $latest_answer->student_state = $student_profile->state;
                    $latest_answer->student_member_since = date('F d, Y', strtotime($student_profile->created_at));
                    $latest_answer->education = DB::table('student_academic_details')
                        ->where('user_id', $latest_answer->user_id)
                        ->value('name');
                }

                $student_question->total_answered = DB::table('student_answers')
                    ->join('students', 'students.id', 'student_answers.user_id')
                    ->where('student_answers.status', 'enable')
                    ->select('student_answers.*', 'students.name as student_name', 'students.image')
                    ->where('student_answers.student_question_id', $student_question->id)
                    ->count();

                $student_question->latest_answer = $latest_answer;
            }
        }

        return $student_questions;
    }

    public function ask_question()
    {
        $user_id = session()->get('student')->id;
        $student_questions = DB::table('student_questions')->select('name', 'update_name_count')->where('user_id', $user_id)->get();
        $stqarray = $student_questions->toArray();
        $mainarry = [];

        foreach ($stqarray as $arr) {
            $mainarry[] = $arr->name;
        }
        $mainarry1 = array_values($mainarry);

        if (request()->isMethod('post')) {
            $name = request()->get('name');
            $tags = request()->get('tags');
            if (in_array($name, $mainarry1)) {
                if (session()->has('student')) {
                    $user_id = session()->get('student')->id;
                    $getdata = DB::table('student_questions')->where('name', $name)
                        ->first();
                        $num =  $getdata->update_name_count;

                    if ($user_id && $num <= 4) {
                        $question['name'] = $name;
                        $question['update_name_count'] = $num + 1;                        
                        DB::table('student_questions')->where('name', $name)
                            ->update($question);
                        return back()
                            ->with('success', 'Message is Duplicate');
                    }


                    $getuser = DB::table('students')->where('id', $user_id)
                    ->first();                    
                    $getuserstatus = $getuser->status;
                    // dd($getuserstatus);

                    if ($user_id && $num == 5) {
                        $question['status'] = 1;   
                        // dd($question);                   
                        DB::table('students')->where('id', $user_id)
                            ->update($question);
                            \Session::flush('success');
                            return redirect('/')->withSuccess('User Blocked due to improper activities');
                            
                        // return redirect('/')->with('success', 'User Blocked due to improper activities');
                    }
                }
                return back()
                    ->with('success', 'User is blocked you can not update question');
            } else {
                if (session()->has('student')) {
                    $user_id = session()->get('student')->id;
                    if ($user_id) {
                        $question = array();
                        $question['name'] = $name;
                        $question['tags'] = $tags;
                        $question['user_id'] = $user_id;
                        $question['update_name_count'] = 0;
                        DB::table('student_questions')
                            ->insert($question);
                        return back()
                            ->with('success', 'Question posted successfully');
                    }
                }
            }







            // foreach ($stqarray as $key => $stques) {
            //     $namevalue = $stques->name;
            //     dump($name);
            //     dd($namevalue);
            //     if (strcmp($name, $namevalue) == 0) {

            //         // for ($i = 0; $i < 5; $i++) {
            //             if (session()->has('student')) {
            //                 $user_id = session()->get('student')->id;

            //                 if($user_id){
            //                 $question['name'] = $name;
            //                 DB::table('student_questions')->where('name', $name)
            //                     ->update($question);
            //                 return back()
            //                     ->with('success', 'Question Updated successfully');
            //             }

            //         }
            //         // }
            //         // echo "hello";


            //         // else {
            //         //     echo 'ife1';
            //         //     return back()
            //         //         ->with('error', 'You must logged in');
            //         // }
            //     } 
            //     // else {
            //     //     // dd('else');
            //     //     if (session()->has('student')) {
            //     //         $user_id = session()->get('student')->id;

            //     //         if ($user_id) {

            //     //             $question = array();
            //     //             $question['name'] = $name;
            //     //             $question['tags'] = $tags;
            //     //             $question['user_id'] = $user_id;
            //     //             // dd($question);
            //     //             DB::table('student_questions')
            //     //                 ->insert($question);

            //     //             return back()
            //     //                 ->with('success', 'Question posted successfully');
            //     //         }
            //     //     }


            //     //     // else {
            //     //     //     dd('else1');
            //     //     //     return back()
            //     //     //         ->with('error', 'You must logged in');
            //     //     // }
            //     // }
            // }
            // loop end up yellow
        }



        // return back()
        //     ->with('success', 'Question posted successfully');
    }

    public function give_answer()
    {

        if (request()->isMethod('post')) {

            $name = request()->get('name');
            $student_question_id = request()->get('student_question_id');
            $tags = request()->get('tags');

            if (!empty($name) and !empty($student_question_id)) {

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    if ($user_id) {

                        $answer = array();
                        $answer['name'] = $name;
                        $answer['tags'] = $tags;
                        $answer['user_id'] = $user_id;
                        $answer['student_question_id'] = $student_question_id;

                        DB::table('student_answers')
                            ->insert($answer);

                        DB::table('student_questions')
                            ->where('id', $student_question_id)
                            ->increment('total_answered', 1);
                    }
                } else {
                    return back()
                        ->with('error', 'You must logged in');
                }
            } else {
                return back()
                    ->with('error', 'Question and answer required');
            }
        }

        return back()
            ->with('success', 'Answer given successfully');
    }

    public function report($id)
    {

        if (request()->isMethod('post')) {

            if (!empty($id)) {

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    $student_questions_report = array();
                    $student_questions_report['user_id'] = $user_id;
                    $student_questions_report['student_questions_id'] = $id;

                    if ($user_id) {

                        $is_exists = DB::table('student_questions_report')
                            ->where('student_questions_id', $id)
                            ->where('user_id', $user_id)
                            ->exists();

                        if (!$is_exists) {

                            DB::table('student_questions')
                                ->where('id', $id)
                                ->increment('report', 1);

                            DB::table('student_questions_report')
                                ->insert($student_questions_report);

                            try {

                                // send mail
                                $email = DB::table('student_questions')
                                    ->join('students', 'students.id', 'student_questions.user_id')
                                    ->where('student_questions.id', $id)
                                    ->value('students.email');

                                $subject = 'A user reported against your Question';

                                if (!empty($email)) {

                                    $datamessage['email'] = $email;
                                    $datamessage['subject'] = $subject;

                                    $question = DB::table('student_questions')
                                        ->where('id', $id)
                                        ->value('name');

                                    \Mail::send('mails.question_report', compact('question'), function ($m) use ($datamessage) {
                                        $m->from('support@coachingselect.com', 'CoachingSelect');
                                        $m->to($datamessage['email'])->subject($datamessage['subject']);
                                    });
                                }
                            } catch (\Exception $e) {
                                // ignore mail error
                            }
                        }
                    }
                } else {
                    return back()
                        ->with('error', 'You must logged in');
                }
            } else {
                return back()
                    ->with('error', 'Question is required');
            }
        }

        return back()->with('success', 'Reported successfully');
    }

    public function student_answers($id)
    {

        $id = base64_decode($id);

        $header = new HeaderController();
        $footer = new FooterController();

        $student_answers = DB::table('student_answers')
            ->join('students', 'students.id', 'student_answers.user_id')
            ->where('student_answers.status', 'enable')
            ->orderBy('student_answers.created_at', 'desc')
            ->select('student_answers.*', 'students.name as student_name', 'students.image')
            ->where('student_answers.student_question_id', $id);

        $tags = $this->tags();

        $student_answers = $this->searching(request(), $student_answers);
        $student_answers = $this->reported_by_me_answers($student_answers->get());

        $student_answers = $this->student_profile($student_answers);

        $student_question = DB::table('student_questions')
            ->join('students', 'students.id', 'student_questions.user_id')
            ->where('student_questions.status', 'enable')
            ->orderBy('student_questions.created_at', 'desc')
            ->select('student_questions.*', 'students.name as student_name', 'students.image')
            ->where('student_questions.id', $id)
            ->first();

        if (!empty($student_question)) {

            # increase views 
            DB::table('student_questions')
                ->where('id', $id)
                ->increment('views', 1);

            # has my answer on this question
            $has_my_answer = false;

            if (session()->has('student')) {

                $user_id = session()->get('student')->id;

                $has_my_answer = DB::table('student_answers')
                    ->where('user_id', $user_id)
                    ->where('student_question_id', $student_question->id)
                    ->exists();
            }

            $student_question->has_my_answer = $has_my_answer;

            $reported_by_me = false;

            if (session()->has('student')) {

                $user_id = session()->get('student')->id;

                $reported_by_me = DB::table('student_questions_report')
                    ->where('user_id', $user_id)
                    ->where('student_questions_id', $student_question->id)
                    ->exists();
            }

            $student_question->reported_by_me = $reported_by_me;

            $student_profile = DB::table('students')
                ->where('id', $student_question->user_id)
                ->select('created_at', 'state', 'image')
                ->first();

            $student_question->student_image = $student_profile->image;
            $student_question->student_state = $student_profile->state;
            $student_question->student_member_since = date('F d, Y', strtotime($student_profile->created_at));
            $student_question->education = DB::table('student_academic_details')
                ->where('user_id', $student_question->user_id)
                ->value('name');

            $student_question->total_answered = DB::table('student_answers')
                ->join('students', 'students.id', 'student_answers.user_id')
                ->where('student_answers.status', 'enable')
                ->select('student_answers.*', 'students.name as student_name', 'students.image')
                ->where('student_answers.student_question_id', $id)
                ->count();

            $metatitle = $student_question->name;

            return view('website.student_answers', compact('metatitle', 'header', 'footer', 'student_answers', 'tags', 'student_question'));
        } else {
            abort(404);
        }
    }

    public function update_question()
    {

        if (request()->isMethod('post')) {

            $name = request()->get('name');
            $tags = request()->get('tags');
            $id = request()->get('id');

            if (!empty($name) and !empty($id)) {

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    if ($user_id) {

                        $question = array();
                        $question['name'] = $name;
                        $question['user_id'] = $user_id;
                        $question['tags'] = $tags;
                        $question['id'] = $id;

                        DB::table('student_questions')
                            ->where('id', $id)
                            ->update($question);

                        return back()
                            ->with('success', 'Your question has been updated');
                    }
                } else {
                    return back()
                        ->with('error', 'You must logged in');
                }
            } else {
                return back()
                    ->with('error', 'Question required');
            }
        }

        return back()
            ->with('success', 'Your question has been updated');
    }

    public function update_answer()
    {

        if (request()->isMethod('post')) {

            $name = request()->get('name');
            $id = request()->get('id');

            if (!empty($name) and !empty($id)) {

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    if ($user_id) {

                        $answer = array();
                        $answer['name'] = $name;
                        $answer['id'] = $id;

                        DB::table('student_answers')
                            ->where('id', $id)
                            ->update($answer);

                        try {

                            // send mail
                            $email = DB::table('student_answers')
                                ->join('student_questions', 'student_questions.id', 'student_answers.student_question_id')
                                ->join('students', 'students.id', 'student_questions.user_id')
                                ->where('student_answers.id', $id)
                                ->value('students.email');

                            $subject = 'An Answer on your question is recently edited - CoachingSelect';

                            if (!empty($email)) {

                                $datamessage['email'] = $email;
                                $datamessage['subject'] = $subject;

                                $answer = DB::table('student_answers')
                                    ->where('id', $id)
                                    ->value('name');

                                $question_id = DB::table('student_answers')
                                    ->where('id', $id)
                                    ->value('student_question_id');

                                $question = DB::table('student_questions')
                                    ->where('id', $question_id)
                                    ->value('name');

                                \Mail::send('mails.answer_edit', compact('answer', 'question'), function ($m) use ($datamessage) {
                                    $m->from('support@coachingselect.com', 'CoachingSelect');
                                    $m->to($datamessage['email'])->subject($datamessage['subject']);
                                });
                            }
                        } catch (\Exception $e) {
                            // ignore mail error
                        }
                    }
                } else {
                    return back()
                        ->with('error', 'You must logged in');
                }
            } else {
                return back()
                    ->with('error', 'Answer required');
            }
        }

        return back()
            ->with('success', 'Your answer has been updated');
    }

    public function delete_question($id)
    {

        if (request()->isMethod('post')) {

            if (!empty($id)) {

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    if ($user_id) {

                        DB::table('student_questions')
                            ->where('id', $id)
                            ->where('user_id', $user_id)
                            ->delete();
                    }
                } else {
                    return back()
                        ->with('error', 'You must logged in');
                }
            } else {
                return back()
                    ->with('error', 'Question is required');
            }
        }

        return redirect()
            ->action('Website\StudentQuestionsAnswersController@student_questions')
            ->with('success', 'Your Question has been deleted');
    }

    public function delete_answer($id)
    {

        if (request()->isMethod('post')) {

            if (!empty($id)) {

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    if ($user_id) {

                        DB::table('student_answers')
                            ->where('id', $id)
                            ->where('user_id', $user_id)
                            ->delete();
                    }
                } else {
                    return back()
                        ->with('error', 'You must logged in');
                }
            } else {
                return back()
                    ->with('error', 'Answer is required');
            }
        }

        return back()
            ->with('success', 'Your answer has been deleted');
    }

    public function has_my_answer($student_questions)
    {

        if (!empty($student_questions)) {
            foreach ($student_questions as $student_question) {

                $has_my_answer = false;

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    $has_my_answer = DB::table('student_answers')
                        ->where('user_id', $user_id)
                        ->where('student_question_id', $student_question->id)
                        ->exists();
                }

                $student_question->has_my_answer = $has_my_answer;
            }
        }

        return $student_questions;
    }

    public function report_answer($id)
    {

        if (request()->isMethod('post')) {

            if (!empty($id)) {

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    $student_answers_report = array();
                    $student_answers_report['user_id'] = $user_id;
                    $student_answers_report['student_answers_id'] = $id;

                    if ($user_id) {

                        $is_exists = DB::table('student_answers_report')
                            ->where('student_answers_id', $id)
                            ->where('user_id', $user_id)
                            ->exists();

                        if (!$is_exists) {

                            DB::table('student_answers')
                                ->where('id', $id)
                                ->increment('report', 1);

                            DB::table('student_answers_report')
                                ->insert($student_answers_report);

                            try {

                                // send mail
                                $email = DB::table('student_answers')
                                    ->join('students', 'students.id', 'student_answers.user_id')
                                    ->where('student_answers.id', $id)
                                    ->value('students.email');

                                $subject = 'A user reported against your Answer';

                                if (!empty($email)) {

                                    $datamessage['email'] = $email;
                                    $datamessage['subject'] = $subject;

                                    $answer = DB::table('student_answers')
                                        ->where('id', $id)
                                        ->value('name');

                                    $question_id = DB::table('student_answers')
                                        ->where('id', $id)
                                        ->value('student_question_id');

                                    $question = DB::table('student_questions')
                                        ->where('id', $question_id)
                                        ->value('name');

                                    \Mail::send('mails.answer_report', compact('answer', 'question'), function ($m) use ($datamessage) {
                                        $m->from('support@coachingselect.com', 'CoachingSelect');
                                        $m->to($datamessage['email'])->subject($datamessage['subject']);
                                    });
                                }
                            } catch (\Exception $e) {
                                // ignore mail error
                            }
                        }
                    }
                } else {
                    return back()
                        ->with('error', 'You must logged in');
                }
            } else {
                return back()
                    ->with('error', 'Answer is required');
            }
        }

        return back()->with('success', 'Reported successfully');
    }

    public function tags_for_questions()
    {

        $student_questions = DB::table('student_questions')
            ->join('students', 'students.id', 'student_questions.user_id')
            ->where('student_questions.status', 'enable')
            ->orderBy('student_questions.created_at', 'desc')
            ->select('student_questions.*', 'students.name as student_name', 'students.image')
            ->get();

        $tags = array();

        if (!empty($student_questions)) {
            foreach ($student_questions as $student_question) {

                $question_tags = $student_question->tags;
                $question_tags = explode(',', $question_tags);

                if (!empty($question_tags)) {
                    foreach ($question_tags as $question_tag) {
                        $tags[$question_tag] = true;
                    }
                }
            }
        }

        $tags = array_keys($tags);

        $new_tags = array();
        $i = 0;

        foreach ($tags as $tag) {
            $new_tags[$i]['text'] = $tag;
            $new_tags[$i]['value'] = $tag;

            $i += 1;
        }

        return $new_tags;
    }

    public function reported_by_me($student_questions)
    {

        if (!empty($student_questions)) {
            foreach ($student_questions as $student_question) {

                $reported_by_me = false;

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    $reported_by_me = DB::table('student_questions_report')
                        ->where('user_id', $user_id)
                        ->where('student_questions_id', $student_question->id)
                        ->exists();
                }

                $student_question->reported_by_me = $reported_by_me;
            }
        }

        return $student_questions;
    }

    public function reported_by_me_answers($student_answers)
    {

        if (!empty($student_answers)) {
            foreach ($student_answers as $student_answer) {

                $reported_by_me = false;

                if (session()->has('student')) {

                    $user_id = session()->get('student')->id;

                    $reported_by_me = DB::table('student_answers_report')
                        ->where('user_id', $user_id)
                        ->where('student_answers_id', $student_answer->id)
                        ->exists();
                }

                $student_answer->reported_by_me = $reported_by_me;
            }
        }

        return $student_answers;
    }

    public function student_profile($student_questions)
    {

        if (!empty($student_questions)) {
            foreach ($student_questions as $student_question) {

                $student_profile = DB::table('students')
                    ->where('id', $student_question->user_id)
                    ->select('created_at', 'state', 'image')
                    ->first();

                $student_question->student_image = $student_profile->image;
                $student_question->student_state = $student_profile->state;
                $student_question->student_member_since = date('F d, Y', strtotime($student_profile->created_at));
                $student_question->education = DB::table('student_academic_details')
                    ->where('user_id', $student_question->user_id)
                    ->value('name');
            }
        }

        return $student_questions;
    }
}
