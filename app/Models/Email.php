<?php

namespace App\Models;

use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['subject', 'content','status','scheduled'];

    // Relations
    public function newsletters()
    {
        return $this->belongsToMany(Newsletter::class, 'email_newsletter');
    }
}
