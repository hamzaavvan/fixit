<?php

namespace Fixit;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['projectname', 'title', 'description', 'fix', 'fixed', 'slug'];
    protected $guarded = ['id'];
}
