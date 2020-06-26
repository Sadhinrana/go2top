<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CmsPage extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','reseller_id', 'page_name', 'content', 'url', 'public', 'page_title', 'meta_keyword', 'meta_description', 'non_editable', 'status', 'created_at', 'updated_at'
    ];

    public function menus()
    {
        return $this->hasMany(CmsMenu::class, 'menu_link_id');
    }


}
