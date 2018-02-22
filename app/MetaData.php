<?php

namespace App;

use App\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    protected $table = 'meta_data';
    protected $fillable = ['title', 'description'];

    public function generate()
    {
        $meta = $this->getOrCreate();

        SEOMeta::setTitle($meta->title);
        SEOMeta::setDescription($meta->description);
    }

    public function getOrCreate()
    {
        $user = User::realtor();
        return $this->first() ?? $this->create([
            'title' => $user->company . ' | ' . $user->name,
            'description' => 'Combining experience, honesty, and state-of-the-art analytics, discover why '. $user->name .' is the perfect Bay County realtor to help you find your new home.'
        ]);
    }
}
