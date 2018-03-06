<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MlsNumber extends Model
{
    protected $fillable = [
        'user_id',
        'mls_id'
    ];

    protected $table = 'mls_numbers';

    public function realtor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function toString()
    {
        $mlsNumbers = MlsNumber::all()->pluck('mls_id');

        return implode('|', $mlsNumbers->toArray());

    }
}
