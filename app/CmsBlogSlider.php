<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmsBlogSlider extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'cms_blog_sliders';
    protected $fillable = [
        'id','reseller_id', 'title', 'read_more', 'image', 'status', 'created_at', 'updated_at'
    ];
}
