<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'note', 'user_id', 'rating_id', 'image'
    ];

    protected $primaryKey = 'id';

    public function getId()
    {
        return $this->id;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getDateCreated()
    {
        return $this->created_at;
    }

    public function getDateUpdate()
    {
        return $this->update_at;
    }

    public function getRatingId()
    {
        return $this->rating_id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setNote($note)
    {
        return $this->note = $note;
    }

    public function setRatingId(int $ratingId)
    {
        return $this->rating_id = $ratingId;
    }

    public function setImage(string $image)
    {
        return $this->image = $image;
    }

    public function setUserId(int $userId)
    {
        return $this->user_id = $userId;
    }

    public function uploadImg($image)
    {
        if ($this->image) {
            unlink($this->image);
        }
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('public', $filename);
        $this->image = 'storage/' . $filename;

    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public static function getReviewUserRating()
    {
        return DB::table(self::getTableName() . ' AS r')
            ->select('r.id AS r_id','r.note As r_note', 'r.created_at AS r_date','u.id AS u_id', 'u.name AS u_name', 'u.surname AS u_surname', 'r.image AS r_image','rat.name AS rat_name')
            ->join(User::getTableName() . ' AS u', 'r.user_id', '=', 'u.id')
            ->join(Rating::getTableName() . ' AS rat', 'r.rating_id', '=', 'rat.id')
            ->orderByDesc('r.id')
            ->get();
    }
    public static function getReviewRatingFromUser($userId)
    {
        return DB::table(self::getTableName() . ' AS r')
            ->select('r.id AS r_id','r.note As r_note', 'r.created_at AS r_date', 'r.image AS r_image','rat.name AS rat_name')
            ->join(Rating::getTableName() . ' AS rat', 'r.rating_id', '=', 'rat.id')
            ->where('r.user_id',$userId)
            ->orderByDesc('r.id')
            ->get();
    }

    public static function dataToExcel()
    {
        return DB::table(self::getTableName() . ' AS r')
            ->select('r.id AS r_id', 'u.name AS u_name', 'u.surname AS u_surname','r.note As r_note', 'r.image AS r_image','rat.name AS rat_name', 'r.created_at AS r_date')
            ->join(User::getTableName() . ' AS u', 'r.user_id', '=', 'u.id')
            ->join(Rating::getTableName() . ' AS rat', 'r.rating_id', '=', 'rat.id')
            ->orderByDesc('r.id')
            ->get();
    }
}
