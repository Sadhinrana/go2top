<?php

namespace App;

use App\CmsBlog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmsBlogCategory extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','reseller_id', 'name', 'status', 'created_at', 'updated_at'
    ];

    public function posts()
    {
        return $this->hasMany( CmsBlog::class, 'category_id');
    }
}
