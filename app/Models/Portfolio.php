<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioCategory;

class Portfolio extends Model
{
    use HasFactory;


    public function client(){
        return $this->belongsTo(Client::class,'client_id')->select(['name','surname']);
    }
    public function category(){

        return $this->belongsTo(PortfolioCategory::class,'category_id')->select('name');

    }


    public function images(){

        return $this->hasManyThrough(
            ImageFile::class, // qaysi jadvaldan olmoqchilimigiz // 1
            PortfolioJoinImageFile::class,  // qaysi jadval orqali olyapmiz  // 2
            'portfolio_id',  // 2
            'id', // 1
            null,
            'image_file_id'
            
        )->select('file_url');
    }

}
