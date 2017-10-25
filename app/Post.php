<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cyrildewit\PageVisitsCounter\Traits\HasPageVisitsCounter;
use Carbon\Carbon;
 

class Post extends Model
{
    use HasPageVisitsCounter;
    //
    public function user(){
      return   $this->belongsTo('App\User');
     }
    public function likes(){
      return  $this->hasMany('App\Like');
    }
    /**
     * Adding attributes for retrieving the pagevies of the model.
     *
     * @var array
     */
    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge($this->appends, [
            'total_visits_count',
            'last_24h_visits_count',
            'last_7d_visits_count',
        ]));
        return parent::getArrayableAppends();
    }

    /**
     * Get the page views associated with the given model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    // public function views()
    // {
    //     return $this->morphMany(
    //         \App\Models\PageView::class,
    //         'viewable'
    //     );
    // }

    /**
     * Count all page visits together of the model.
     *
     * @return int
     */
    public function getTotalViewsCountAttribute()
    {
        return $this->views()->count();
        
    }

    public function getLast24hViewsCountAttribute()
    {
        return $this->views()->where('created_at', Carbon::now()->subHours(24))->count();
    }

    public function getLast7dViewsCountAttribute()
    {
        return $this->views()->where('created_at', Carbon::now()->subDays(7))->count();
    }
  }
     
    
