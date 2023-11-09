

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    @foreach(config('lang.langs') as $key=> $lang)
        <li class="nav-item " role="presentation">
            <button class="nav-link {{$key==0 ? 'active' : ""}}  @error('*'.'_'.$lang) text-danger  @enderror" id="pills-{{$lang}}-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-{{$lang}}" type="button" role="tab" aria-controls="pills-{{$lang}}"
                    aria-selected="{{$key==0 ? 'true' : "false"}}">{{$lang}}</button>
        </li>
    @endforeach
</ul>
