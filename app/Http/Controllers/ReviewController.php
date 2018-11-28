<?php

namespace App\Http\Controllers;


use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
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
}
