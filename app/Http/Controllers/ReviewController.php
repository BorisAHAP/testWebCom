<?php

namespace App\Http\Controllers;


use App\Models\Rating;
use App\Models\Review;
use function back;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function unlink;


class ReviewController extends Controller
{
    private $data = [];

    public function add(Request $request)
    {
        Review::getReviewUserRating();
        if ($request->post()) {
            $messages = [
                'image.required' => 'Добавьте изображение',
                'image.max' => 'Размер изображения не должен превышать 2мб',
                'note.required' => 'Поле ОТЗЫВ обязательно для заполнения',
                'image.mimes' => 'Для загрузки доступны jpeg,jpg,png,gif,bmp файлы'
            ];
            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpeg, jpg, png, gif, bmp|max:2048',
                'note' => 'required',
            ], $messages);

            if ($validator->fails()) {
                session()->put('code', 301);
                return redirect()->route('home')->withErrors($validator)->withInput();
            }
            if (session()->has('code')) {
                session()->forget('code');
            }
            $review = new Review();

            $review->fill($request->except(['_token', 'image']));
            if ($request->hasFile('image')) {
                $review->upload($request->file('image'));
            }
            $review->save();
        }
        return redirect()->back()->with('success', 'Отзыв добавлен');
    }

    public function show()
    {
        $this->data['reviews'] = Review::getReviewRatingFromUser(Auth::id());
        $this->data['user'] = Auth::user();
        return view('myReview', $this->data);
    }

    public function edit(int $id)
    {
        $this->data['review']=Review::select('note','image','rating_id')->where('id',$id)->first();
        $this->data['ratings']=Rating::all();
       return view('edit',$this->data);
    }

    public function delete(Request $request)
    {
        Review::where('id', $request->id)->delete();
        unlink($request->image);
        return back();
    }
}
