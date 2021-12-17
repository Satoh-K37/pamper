@extends('app')

@section('title', 'レシピ詳細')

@section('content')
  @include('nav')
  <div class="container"> 
    @include('error_card_list')
    @include('flash_message')
    @include('recipes.card')
    @include('comments.comment_list')
    @include('comments.form')


    
@endsection
