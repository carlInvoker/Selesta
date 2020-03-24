<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product  extends Model
{
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'product_name', 'product_description', 'product_price', 'product_image', 'product_status', 'product_category', 'created_at', 'updated_at'
        ];

        protected $primaryKey = 'product_id';

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
