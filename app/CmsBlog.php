<?php

namespace App;

use App\CmsBlogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CmsBlog extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','reseller_id', 'category_id', 'title', 'content','slug', 'image', 'type', 'visibility', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo(CmsBlogCategory::class, 'category_id');
    }

}
