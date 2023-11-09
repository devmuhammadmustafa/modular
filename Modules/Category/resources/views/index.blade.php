@extends('base::layouts.master')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <a class="btn btn-primary" href="{{route('category.create')}}">Create</a>
            @include('base::layouts.partials.alert-messages')

            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Responsive Table</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">title</th>
                                <th scope="col">image</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{$category->id}}</th>
                                    <td>
                                        <ul>
                                            @foreach(config('lang.langs') as $lang)
                                                @php
                                                    $title='title_'.$lang;
                                                @endphp
                                                <li>{{$lang}} : {{$category->$title}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                    <td><img style="width: 150px" src="{{asset("storage/$category->image")}}"></td>
                                    <td><a href="{{route('category.edit',$category->id)}}"
                                           class="btn btn-primary">Edit</a></td>

                                    <td>
                                        <a data-href="{{route('category.destroy',$category->id)}}" class=" delete-btn btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
