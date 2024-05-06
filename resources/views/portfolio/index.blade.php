@extends('layouts.index')

@section('content')

    @include('includes.portfolio')

@endsection

@section('portfolio.title')
    MediaMentors - Portfolio
@endsection

@section('header_link_swiper')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endsection

@section('portfolio.link')
/#partners-form
@endsection

@section('servis_portfolio_link')
    class="link_reverse link_reverse-portfolio"
@endsection

@section('portfolio_script')
    <script src="{{asset('js/portfolio.js')}}"></script>
@endsection

@section('portfolio_case')
/#cases
@endsection