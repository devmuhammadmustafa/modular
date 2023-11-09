@extends('base::layouts.master')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <a class="btn btn-info" href="{{route('product.index')}}">Back</a>
            @include('base::layouts.partials.alert-messages')

            <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data"
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
                                               value="{{old('title_'.$lang,$product->$title)}}" name="title_{{$lang}}"
                                               id="floatingInput"
                                               placeholder="">
                                    </div>

                                    <div class=" mb-3">
                                        <label for="floatingInput">Description {{$lang}}</label>
                                        <textarea type="text" class="form-control" name="description_{{$lang}}"
                                                  id="floatingInput"
                                                  placeholder="">{{old('description_'.$lang,$product->$desc)}}</textarea>
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
                            <label for="formFile" class="form-label">Default file input example</label>
                            <select class="form-control" type="file" name="category_id" id="formFile">
                                @foreach($categories as $category)
                                    <option
                                        @selected(old('category_id',$product->category_id)==$category->id) value="{{$category->id}}">{{$category->title_az}}</option>

                                @endforeach
                            </select>
                            @error('category_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Default file input example</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Gallery</label>
                            <input class="form-control" multiple type="file" name="images[]" id="formFile">
                            @error('images')<span class="text-danger">{{$message}}</span>@enderror
                        </div>


                        <div class="mb-3">
                            <input class="btn btn-success" type="submit" name="image">
                        </div>

                    </div>


                </div>
            </form>

        </div>
        @if(!$images->isEmpty())

            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Gallery</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">image</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                                <tr>
                                    <td >{{$image->id}}</td>

                                    <td><img style="width: 150px" src="{{asset("storage/$image->image")}}"></td>
                                    <td><a href="#"
                                           class="btn btn-primary">Edit</a>
                                        <a data-href="#" class=" delete-btn btn btn-danger">Delete</a>

                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
