<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public function user() {
        return $this->hasMany('App\User');
    }
    public function school_calling() {
        return $this->belongsTo('App\SchoolCalling');
    }
        public function club_calling() {
    return $this->belongsTo('App\ClubCalling');
    }
    
    
    public function club_fan(){
        return $this->hasMany('App\ClubFan');
    }
    public function club_member(){
        return $this->hasMany('App\ClubMember');
    }
    public function strategy(){
        return $this->hasMany('App\Strategy');
    }
    
    public function discussion(){
        return $this->hasMany('App\Discussion');
    }
    public function discussion_comment(){
        return $this->hasMany('App\DiscussionComment');
    }
    
    public function menu(){
        return $this->hasMany('App\Menu');
    }
    public function menu_tag(){
        return $this->hasMany('App\MenuTag');
    }
    public function menu_comment(){
        return $this->hasMany('App\MenuComment');
    }
    
    public function calendar(){
        return $this->hasMany('App\Calendar');
    }
    public function calendar_comment(){
    return $this->hasMany('App\CalendarComment');
    }
    
    public function journal(){
        return $this->hasMany('App\Journal');
    }
    public function journal_comment(){
        return $this->hasMany('App\JournalComment');
    }
}
