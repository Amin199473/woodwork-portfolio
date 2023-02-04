<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        "telegram",
        "instagram",
        "facebook",
        "whatsapp",
        "linkedin",
        "address",
        "phone_number_1",
        "phone_number_2",
        "email",
        "title",
        "logo",
    ];
}
