@extends('base::layouts.master')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <a class="btn btn-info" href="{{route('blog.index')}}">Back</a>
            @include('base::layouts.partials.alert-messages')

            <form action="{{route('blog.update',$blog->id)}}" method="POST" enctype="multipart/form-data"
                  class="d-flex gap-4">
                @csrf
                @method('PUT')
                <div class="col-sm-12 col-xl-8">

                    <div class="bg-light rounded h-100 p-4">
                        @include("base::layouts.partials.langtab")
                        <div class="tab-content" id="pills-tabContent">
                            @foreach(config("lang.langs") as $key=> $lang)
                                @php
                                    $title="title_".$lang;
                                    $desc="description_".$lang;
                                @endphp
                                <div class="tab-pane fade  {{$key==0 ? 'show active' : ""}}" id="pills-{{$lang}}"
                                     role="tabpanel" aria-labelledby="pills-{{$lang}}-tab">
                                    <div class=" mb-3">
                                        <label for="floatingInput">Title {{$lang}}</label>
                                        <input type="text" class="form-control"
                                               value="{{old('title_'.$lang,$blog->$title)}}" name="title_{{$lang}}"
                                               id="floatingInput"
                                               placeholder="">
                                    </div>

                                    <div class=" mb-3">
                                        <label for="floatingInput">Description {{$lang}}</label>
                                        <textarea type="text" class="form-control" name="description_{{$lang}}"
                                                  id="floatingInput"
                                                  placeholder="">{{old('description_'.$lang,$blog->$desc)}}</textarea>
                                        @error('description_'.$lang)<span
                                            class="text-danger">{{$message}}</span>@enderror
                                    </div>




                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>

                <div class="col-sm-12 col-xl-4">

                    <div class="bg-light rounded h-100 p-4">


                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>




                        <div class="mb-3">
                            <input class="btn btn-success" type="submit" name="image">
                        </div>

                    </div>


                </div>
            </form>

        </div>
    </div>
@endsection
