<?php

namespace App\Policies;

use App\User;
use App\Exam;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the exam.
     *
     * @param \App\User $user
     * @param \App\Exam $exam
     * @return mixed
     */
    public function view(User $user, Exam $exam)
    {
        if (count($exam->students) > 0) {
            return ($user->groups == $exam->groups || in_array($user->id, $exam->students));
        } else {
            return ($user->groups == $exam->groups);
        }

    }

    /**
     * Determine whether the user can create exams.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the exam.
     *
     * @param \App\User $user
     * @param \App\Exam $exam
     * @return mixed
     */
    public function update(User $user, Exam $exam)
    {
        //
    }

    /**
     * Determine whether the user can delete the exam.
     *
     * @param \App\User $user
     * @param \App\Exam $exam
     * @return mixed
     */
    public function delete(User $user, Exam $exam)
    {
        //
    }
}
