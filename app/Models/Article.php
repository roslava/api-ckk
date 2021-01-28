<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable=[
        'smi_name',
        'smi_author',
        'smi_original',
        'smi_date',
        'article_title',
        'article_lead',
        'article_text',
        'article_cover',
        'article_slug'
    ];
}

