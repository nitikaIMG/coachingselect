<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreToExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->string('registration_begins')->nullable();
            $table->string('registration_end')->nullable();
            $table->string('admit_card_release')->nullable();
            $table->string('exam_date')->nullable();
            $table->string('results_date')->nullable();
            $table->string('mode_of_exam')->nullable();
            $table->string('exam_fee')->nullable();
            $table->string('reservation_available')->nullable();
            $table->string('exam_frequency')->nullable();
            $table->string('exam_duration')->nullable();
            $table->string('conducted_by')->nullable();
            $table->string('programs')->nullable();
            $table->string('exam_language')->nullable();
            $table->string('no_of_colleges_under_exam')->nullable();
            $table->string('min_age')->nullable();
            $table->string('max_age')->nullable();
            $table->string('no_of_attempts')->nullable();
            $table->string('qualifying_exam_and_marks_required')->nullable();
            $table->string('last_qualifying_exam_subjects')->nullable();
            $table->string('exam_type')->nullable();
            $table->string('stages')->nullable();
            $table->string('negative_marking')->nullable();
            $table->string('no_of_questions')->nullable();
            $table->string('correct_answer')->nullable();
            $table->string('maximum_marks')->nullable();
            $table->string('cutoff')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            //
        });
    }
}
