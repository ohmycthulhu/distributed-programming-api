<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'private'];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function scopePublic() {
      return $this->where('private', false);
    }

    public function getPublicAttribute() {
      return !$this->private;
    }
}
