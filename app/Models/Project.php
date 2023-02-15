<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'password',
        'owner_id',
        'sex',
        'public_flag',
        'status',
        'start_date',
        'closed_date'
    ];

    // public function users() {
    //     return $this->belongsToMany(User::class,'project_users','user_id','project_id');
    // }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // public function projectUsers() {
    //     return $this->hasMany(ProjectUser::class);
    // }

    public function attachments() {
        return $this->hasMany(Attachment::class);
    }
}
