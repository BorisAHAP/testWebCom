@extends('layouts.app')
@section('content')
    <h1>Привет,  {{Auth::user()->name}}</h1>

    <div class="col-lg-8" id="hideForm" >
        <form class="card" method="post" action="{{route('update',$review)}}" enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{Auth::id()}}" hidden name="user_id">
            <div class="card-body">
                <h3 class="card-title">Редактировать отзыв</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <img class="card-img-top" src="{{asset($review->getImage())}}" width="180px" height="180px">

                            <label class="form-label">Изображение</label>
                            <input name="image" type="file"
                                   class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}">
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
                            <textarea rows="5" class="form-control {{ $errors->has('note') ? ' is-invalid' : '' }}"
                                      name="note" placeholder="Напишите отзыв">{{$review->getNote()}}</textarea>
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
                                           value="{{$rating->getId()}}" {{$review->getRatingId()===$rating->getId() ? 'checked' : ''}}>
                                    <span class="custom-control-label">{{$rating->getName()}}</span>
                                </label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </div>
        </form>
    </div>

@endsection