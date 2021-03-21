<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Influencers extends Model
{
    use HasFactory;

    protected $table = "influencers";

    protected $fillable = [
        'user_id',
    ];

    public function findInfluencers($categories, $name) {
        $influencers = DB::table('users')
                ->join('influencers', 'influencers.user_id', '=', 'users.id')
                ->join('influencers_info', 'influencers.id', '=', 'influencers_info.influencer_id');
        
        if($name != '')
            $influencers = $influencers
                    ->where('users.name', 'LIKE', '%'.$name.'%')
                    ->orWhere('users.username', 'LIKE', '%'.$name.'%');
        
        $influencers = $influencers->select([
            'users.id',
            'users.name',
            'users.username',
            'influencers_info.influencer_id',
            'influencers_info.country',
            'influencers_info.state',
            'influencers_info.follows',
            'influencers_info.followings',
            'influencers_info.posts',
            'influencers_info.avatar',
            'influencers_info.back_img',
            'influencers_info.reviews',
            'influencers_info.rating',
        ])->get();
        
        $foundInfluencers = [];
        $count = 0;
        for ($i=0; $i < count($influencers); $i++) {
            $influencer = $influencers[$i];
            $foundCategories = DB::table('category_influencer')
            ->where('category_influencer.influencer_id', '=', $influencer->influencer_id)
            ->join('categories', 'category_influencer.category_id', '=', 'categories.id');
            if($categories[0] != 'Category') {
                $foundCategories = $foundCategories->get();
                $containCount = 0;
                foreach ($foundCategories as $foundCategory) {
                    foreach ($categories as $category) {
                        if($category == $foundCategory->category_name) $containCount ++;
                    }
                }
                if($containCount == count($categories)) {
                    $influencer->category = $foundCategories;
                    $foundInfluencers[$count] = $influencer;
                    $count ++;
                }
            } else {
                $foundCategories = $foundCategories->get();
                $influencer->category = $foundCategories;
                $foundInfluencers[$i] = $influencer;
            }
        }

        if($name == '' && $categories[0] == 'Category')
            $foundInfluencers = [];
        return $foundInfluencers;
    }
}