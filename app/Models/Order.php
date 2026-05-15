<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    protected $casts = [
        'akad_datetime' => 'datetime',
        'resepsi_datetime' => 'datetime',
        'is_angpao_active' => 'boolean',
        'is_gallery_active' => 'boolean',
        'is_lovestory_active' => 'boolean',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function template() { return $this->belongsTo(Template::class); }
    public function guests() { return $this->hasMany(Guest::class); }
    
    // Relasi Baru
    public function galleries() { return $this->hasMany(Gallery::class); }
    public function loveStories() { return $this->hasMany(LoveStory::class); }
}