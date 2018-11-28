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

    public function upload($image)
    {
        if (!$image) return;
        if ($this->image) {
            Storage::delete('uploads/' . $this->image);
        }
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = "uploads/" . $filename;
    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public static function getReviewUserRating()
    {
        return DB::table(self::getTableName() . ' AS r')
            ->select('r.note As r_note', 'r.created_at AS r_date', 'u.name AS u_name', 'u.surname AS u_surname', 'r.image AS r_image')
            ->join(User::getTableName() . ' AS u', 'r.user_id', '=', 'u.id')
            ->join(Rating::getTableName() . ' AS rat', 'r.rating_id', '=', 'rat.id')
            ->get();
    }
}
