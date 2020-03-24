<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider  extends Model
{
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'sliders_header', 'sliders_description', 'sliders_image', 'sliders_status', 'product_status', 'product_id', 'created_at', 'updated_at'
        ];

        protected $primaryKey = 'sliders_id';

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
          // 'product_id'
        ];

        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [

        ];
}
