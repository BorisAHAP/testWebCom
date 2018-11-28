@extends('layouts.app')
@section('content')
    <h1>Привет, {{Auth::check() ? Auth::user()->name : 'Гость'}}</h1>

    <div class="nav-item d-none d-md-flex">
        <a href="{{Auth::check() ? 'javascript:;' : route('login')  }}" class="btn btn-sm btn-outline-primary showForm">Добавить
            отзыв</a>
    </div>
    <div class="col-lg-8" id="hideForm" @if(session()->has('code')) style="display: block" @else style="display: none" @endif>
        <form class="card" method="post" action="{{route('add_review')}}" enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{Auth::id()}}" hidden name="user_id">
            <div class="card-body">
                <h3 class="card-title">Добавить отзыв</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label">Изображение</label>
                            <input name="image" type="file" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label">Отзыв</label>
                            <textarea rows="5" class="form-control {{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" placeholder="Напишите отзыв"></textarea>
                            @if ($errors->has('note'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="form-label">Оценка</div>
                    <div class="custom-controls-stacked">
                        @if($ratings->count()>0)
                            @foreach($ratings as $rating)
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="rating_id"
                                           value="{{$rating->getId()}}" checked>
                                    <span class="custom-control-label">{{$rating->getName()}}</span>
                                </label>
                            @endforeach
                            @endif
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>
    </div>
    <br><br>
    <div class="row">
    @if($reviews->count()>0)
        @foreach($reviews as $review)
    <div class="col-md-4">
        <div class="card">
           <img class="card-img-top" src="{{$review->r_image}}"
                             alt="And this isn't my nose. This is a false one.">
            <div class="card-body d-flex flex-column">

                <div class="text-muted">{{$review->r_note}}
                </div>
                <div class="d-flex align-items-center pt-5 mt-auto">
                    <div>
                        <a href="./profile.html" class="text-default">{{$review->u_name}} {{$review->u_surname}}</a>
                        <small class="d-block text-muted">{{$review->r_date}}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    </div>
@endsection