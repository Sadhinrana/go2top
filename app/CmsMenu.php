<?php

namespace App;
use App\CmsPage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CmsMenu extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','reseller_id', 'menu_name', 'external_link','menu_link_id', 'menu_link_type', 'sort', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function pages(){
        return $this->belongsTo(CmsPage::class, 'menu_link_id');
    }

}
