<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guared = [];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function replies()
    {
        return $this->hasMany(Ticket::class, "parent_id", "id")->with(['replies','user','admin']);
    }
    public function admin(){
        return $this->belongsTo(Admin::class, "admin_id");

    }
}
