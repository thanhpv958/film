<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    protected $table='image_uploads';
    protected $fillable = ['image'];

    public function imgupload()
    {
        return $this->morphTo();
    }
}
