<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyJournal extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
      
    public function my_journal_count() {
        return $this->hasMany('App\Models\MyJournalCount');
    }
    public function my_journal_comment() {
        return $this->hasMany('App\Models\MyJournalComment');
    }
}
