@extends('layouts.app')
@section('content')
    <h1>Привет, {{Auth::check() ? Auth::user()->name : 'Гость'}}</h1>
    <br><br>
    <div class="row">
        @if($reviews->count()>0)
            @foreach($reviews as $review)
                <div class="col-md-4">

                    <div class="card">
                        <img class="card-img-top" src="{{$review->r_image}}" width="180px" height="180px">

                        <div class="card-body d-flex flex-column">
                            <div class="card-options">

                                    <a href="{{route('edit',$review->r_id)}}" class="card-options-collapse" data-toggle="card-collapse"><i class="far fa-edit"></i></a>
                                    <form action="{{route('delete')}}" method="post">
                                        @csrf
                                        <input type="text" value="{{$review->r_id}}" name="id" hidden>
                                        <input type="text" value="{{$review->r_image}}" name="image" hidden>
                                        <button type="submit" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;"><i class="fas fa-trash"></i></button>
                                    </form>


                            </div>
                                <div class="text-muted">{{$review->r_note}}
                                </div>
                                <div class="d-flex align-items-center pt-5 mt-auto">
                                    <div>
                                        <a href="#" class="text-default">{{$user->name}} {{$user->surname}}</a>
                                        <small class="d-block text-muted">Оценка: {{$review->rat_name}}</small>
                                        <small class="d-block text-muted">{{$review->r_date}}</small>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            @endforeach
            @else
            <h1>У вас пока нету отзывов</h1>
        @endif
    </div>
@endsection