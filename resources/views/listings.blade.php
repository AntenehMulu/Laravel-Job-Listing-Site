@extends('layout')
@section('content')
@include('partials.hero')
@include('partials.search')
@unless (count($listings)==0)
<div
class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
>
@foreach ($listings as $listing)
<x-list :listing="$listing" />
@endforeach
</div>
@endunless
<p>Nothing post found</p>
@endsection

