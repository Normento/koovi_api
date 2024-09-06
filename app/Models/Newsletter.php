<?php

namespace App\Models;

use App\Models\Email;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Newsletter extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'email',
    ];


    public function emails()
    {
        return $this->belongsToMany(Email::class, 'email_newsletter');
    }
}
