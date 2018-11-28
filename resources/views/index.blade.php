@extends('layouts.app')
@section('content')
    <h1>Привет, {{Auth::check() ? Auth::user()->name : 'Гость'}}</h1>

    <div class="nav-item d-none d-md-flex">
        <a href="{{Auth::check() ? 'javascript:;' : route('login')  }}" class="btn btn-sm btn-outline-primary showForm">Добавить
            отзыв</a>
    </div>

    <div class="col-lg-8" id="hideForm" style="display: none">
        <form class="card" method="post" action="{{route('add_review')}}">
            <div class="card-body">
                <h3 class="card-title">Добавить отзыв</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label">Картинка</label>
                            <input name="image" type="file">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label">Отзыв</label>
                            <textarea rows="5" class="form-control" name="note" placeholder="Напишите отзыв"></textarea>
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
                                    <input type="radio" class="custom-control-input" name="example-inline-radios"
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
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <a href="#"><img class="card-img-top" src="./demo/photos/david-klaasen-54203-500.jpg"
                             alt="And this isn't my nose. This is a false one."></a>
            <div class="card-body d-flex flex-column">
                <h4><a href="#">And this isn't my nose. This is a false one.</a></h4>
                <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice! …Are you suggesting
                    that coconuts migr...
                </div>
                <div class="d-flex align-items-center pt-5 mt-auto">
                    <div>
                        <a href="./profile.html" class="text-default">Rose Bradley</a>
                        <small class="d-block text-muted">3 days ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection