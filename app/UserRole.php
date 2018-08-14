<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    const CANDIDATE = 1;
    const RECRUITER = 2;
    const ADMIN = 3;
}
