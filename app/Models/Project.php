<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'private'];

    protected $with = ['tags'];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function tags() {
      return $this->belongsToMany(
        Tag::class,
        'projects_tags'
      );
    }

    public function scopePublic($query) {
      return $query->where('private', false);
    }

    public function getPublicAttribute() {
      return !$this->private;
    }
}
