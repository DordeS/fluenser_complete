<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'request_id',
        'review',
        'star',
    ];

    public function getReviewsByUserID($user_id) {
        $reviews = DB::table('reviews')
                ->join('request_info', 'reviews.request_id', '=', 'request_info.request_id')
                ->join('requests', 'request_info.request_id', '=', 'requests.id')
                ->select('reviews.review', 'reviews.star', 'reviews.created_at', 'request_info.title', 'requests.send_id', 'requests.receive_id')
                ->where('reviews.user_id', '=', $user_id)
                ->get();
        
        foreach ($reviews as $review) {
            $send_id = ($review->send_id == $user_id)?$review->receive_id : $review->send_id;

            $user = User::where('id', '=', $send_id)->get();
            $name = $user[0]->name;
            $review->name = $name;

            $created = date_create($review->created_at);
            $now = date_create(date('Y-m-d h:i:sa'));
            $interval = date_diff($created, $now);
            if($interval->format('%m') > 0) $review->interval = $interval->format('%m month');
            if($interval->format('%m') == 0 && $interval->format('%h') > 0)
            $review->interval = $interval->format("%h hour");
        }

        // echo $reviews;
        return $reviews;
    }
}
