<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    protected $guarded = [];

    /**
     * Gets the route key name.
     * 
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


    /**
     * Uses "booting" method of the model.
     * Saves the blog title as the page's slug.
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::saving(function ($instance) {
            $instance->slug = str_slug($instance->title);
        });
    }

    /**
     * Delete a featured photo if it exists when removing a blog.
     *
     * @return void
     */
    public function deletePhoto()
    {
        if (Storage::disk('public')->exists($this->featured_photo_path)) {
            Storage::disk('public')->delete($this->featured_photo_path);
        }
    }

    /**
     * Creates a meta description by truncating the blog content.
     *
     * @return string
     */
    public function metaDescription()
    {
        $string = trim($this->body);

        if (strlen($string) > 300) {
            $string = wordwrap($string, 300, '!!@#$%^&*(()');
            $string = explode('!!@#$%^&*(()', $string, 2);
            $string = $string[0] . '...';
        }

        return strip_tags($string);
    }
}
