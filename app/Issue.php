<?php

namespace Fixit;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['projectname', 'title', 'description', 'fix', 'summary', 'fixed', 'slug', 'visibility', 'user_id'];
    protected $guarded = ['id'];
}
