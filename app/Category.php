<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'status',
        'reseller_id',
        'sort',
    ];
    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
