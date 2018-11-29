<?php

namespace App\Http\Controllers;


use App\Http\Requests\ChangeRequest;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
    private $data = [];

//добавление отзыва
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
                $review->uploadImg($request->file('image'));
            }
            $review->save();
        }
        return redirect()->back()->with('success', 'Отзыв добавлен');
    }

//показать все личные отзывы
    public function show()
    {
        $this->data['reviews'] = Review::getReviewRatingFromUser(Auth::id());
        $this->data['user'] = Auth::user();
        return view('myReview', $this->data);
    }

//страница редактирования отзыва
    public function edit(int $id)
    {
        $this->data['review'] = Review::select('id', 'note', 'image', 'rating_id')->where('id', $id)->first();
        $this->data['ratings'] = Rating::all();
        return view('edit', $this->data);
    }

//удаление отзыва
    public function delete(Request $request)
    {
        Review::where('id', $request->id)->delete();
        unlink($request->image);
        return back();
    }

//сохранение измененного отзыва
    public function update(ChangeRequest $request, Review $review)
    {
        if ($request->post()) {
            $imageOld = $review->getImage();
            $review->fill($request->except(['_token', 'image']));
            if ($request->hasFile('image')) {
                $review->uploadImg($request->file('image'));
            } else {
                $review->setImage($imageOld);
            }
            $review->save();
        }
        return redirect()->route('home');
    }
}
