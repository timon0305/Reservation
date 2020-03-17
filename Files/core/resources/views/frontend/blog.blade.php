@extends('frontend.master')
@section('title','Blog')
@section('content')
    <!-- agent details begin-->
@php
if($cat!==null){
$title = $cat->name;
$item = ['Blog'=>route('blog'),$cat->name=>null];
}else{
$title = 'Blog All';
$item =['Blog'=>null];
}

@endphp
    @include('frontend.partials.breadcrumb',['title'=>$title,'item'=>$item])

    <!--Blog Area-->
    <section class="blog-area section-padding">
        <div class="container">

            <div class="row">
                @forelse($posts as $post)
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="single-blog wow fadeInUp" data-wow-delay="0.3s">
                        <img src="{{asset('assets/backend/image/blog/post/'.$post->thumb)}}" alt="">
                        <div class="single-blog-content">
                            <div class="single-blog-content-meta">
                                <a href=""><i class="fa fa-user"></i> Admin</a>
                                <a href="{{route('blog',$post->category->id)}}"><i class="fa fa-folder-open"></i> {{$post->category->name}}</a>
                                <a href=""><i class="fa fa-eye"></i> {{$post->hit}}</a>
                            </div>
                            <h3><a href="{{route('blog-details',[$post->id,str_slug($post->title)])}}">{{$post->title}}</a></h3>
                            <p>{{ str_limit($post->details,100) }}</p>
                            <a class="read-more" href="{{route('blog-details',[$post->id,str_slug($post->title)])}}">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                    @empty
                    <div class="col-md-12">
                        <div class="single-blog wow fadeInUp" data-wow-delay="0.3s">
                            <h1 class="text-center text-warning">No Blog</h1>
                        </div>
                    </div>
                @endforelse
                    @if ($posts->lastPage() > 1)
                        <div class="col-md-12 wow fadeInUp" data-wow-delay="1.5s">
                            <ul class="styled-pagination mt-30 centered">
                                <li class="next {{ ($posts->currentPage() == 1) ? ' disabled' : '' }}" ><a href="{{($posts->currentPage() == 1) ? '#' : $posts->url(1)   }}"><span class="fa fa-angle-left"></span></a></li>
                                @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                    <li>
                                        <a class="{{ ($posts->currentPage() == $i) ? ' active' : '' }}" href="{{ $posts->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="prev {{ ($posts->currentPage() == $posts->lastPage()) ? ' disabled' : '' }}"><a href="{{($posts->currentPage() == $posts->lastPage())? '#' : $posts->url($posts->currentPage()+1)   }}"><span class="fa fa-angle-right"></span></a></li>
                            </ul>
                        </div>
                    @endif
            </div>
        </div>
    </section><!--/Blog Area-->

@endsection