@extends('layouts.app')

@section('content')
<header class="bg-white">
  <div class="w-full md:max-w-7xl mx-auto py-1 px-3 sm:px-6 lg:px-8 bg-gray-800 h-10">
    <p class="italic text-lg md:text-xl text-white font-bold leading-8" style="font-family: 'Josefin Sans', sans-serif;">{{ __('LEAVE REVIEW') }}</p>
  </div>  
</header>
<main class="md:max-w-7xl mx-auto">
  <div class="w-full md:max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3 mb-20">
    <p class="text-sm md:text-md text-gray-700 ml-3 md:ml-10 mt-3">
      {{ __("Let everyone know how working with " . $accountInfo->name . ' was') }}
    </p>
    <div class="w-10/12 mx-auto h-14 my-3">
      <div class="w-14 float-left">
        <img class="rounded-full" src={{ asset('/img/profile-image/'.$accountInfo->avatar.'.jpg') }} alt={{ $accountInfo->avatar }}>
      </div>
      <div class="py-2 ml-16">
        <p class="text-md md:text-lg font-bold leading-5">
          {{ $accountInfo->name }}
        </p>
        <p class="text-xs md:text-sm font-semibold leading-5">
          {{ '@'.$accountInfo->username }}
        </p>
      </div>
      <div class="clearfix"></div>
    </div>
    <hr />
    <div class="w-11/12 mx-auto my-3">
      <div class="w-full grid grid-rows-2 gap-y-1">
        <div class="row-span-1">
          <div class="w-20 float-left">
            <p class="text-sm md:text-md font-bold"> Project Title</p>
          </div>
          <div class="ml-24">
            <p class="text-sm md:text-md">
              {{ $requestInfo->title }}
            </p>
          </div>
        </div>
        <div class="row-span-1">
          <div class="w-20 float-left">
            <p class="text-sm md:text-md font-bold"> Offer</p>
          </div>
          <div class="ml-24">
            <p class="text-sm md:text-md">
              {{ $requestInfo->amount . ' ' . strtoupper($requestInfo->unit) }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <hr />
    <div class="w-11/12 mx-auto my-3">
      <div class="w-full grid grid-rows-5 gap-y-1" id="star-rating">
        <div class="row-span-1 w-full justify-between">
          <div class="float-left">
            <p class="text-sm md:text-md">Quality</p>
          </div>
          <div class="stars float-right" id="Quality">
            <a class="mx-1 star-1 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-2 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-3 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-4 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-5 text-gray-400"><i class="fas fa-star"></i></a>
          </div>
        </div>
        <div class="row-span-1 w-full justify-between">
          <div class="float-left">
            <p class="text-sm md:text-md">Communication</p>
          </div>
          <div class="stars float-right" id="Communication">
            <a class="mx-1 star-1 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-2 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-3 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-4 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-5 text-gray-400"><i class="fas fa-star"></i></a>
          </div>
        </div>
        <div class="row-span-1 w-full justify-between">
          <div class="float-left">
            <p class="text-sm md:text-md">Expertise</p>
          </div>
          <div class="stars float-right" id="Expertise">
            <a class="mx-1 star-1 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-2 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-3 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-4 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-5 text-gray-400"><i class="fas fa-star"></i></a>
          </div>
        </div>
        <div class="row-span-1 w-full justify-between">
          <div class="float-left">
            <p class="text-sm md:text-md">Professionalism</p>
          </div>
          <div class="stars float-right" id="Professionalism">
            <a class="mx-1 star-1 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-2 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-3 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-4 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-5 text-gray-400"><i class="fas fa-star"></i></a>
          </div>
        </div>
        <div class="row-span-1 w-full justify-between">
          <div class="float-left">
            <p class="text-sm md:text-md">Would hire again?</p>
          </div>
          <div class="stars float-right" id="Would">
            <a class="mx-1 star-1 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-2 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-3 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-4 text-gray-400"><i class="fas fa-star"></i></a>
            <a class="mx-1 star-5 text-gray-400"><i class="fas fa-star"></i></a>
          </div>
        </div>
      </div>
    </div>
    <hr />
    <div class="w-11/12 mx-auto my-3">
      <form action={{ route('submitReview', ['request_id' => $requestInfo->id]) }} method="post">
        {{ csrf_field() }}
        <input type="text" name="rating" id="rating" hidden>
        <label for="comments" class="text-sm md:text-md">Your Comments</label>
        <textarea name="comment" id="comment" class="w-full text-sm md:text-md h-32 rounded-lg bg-gray-200 border-none" placeholder="Write your comment here" ></textarea>

        <button type="submit" class="block mx-auto px-8 py-2 rounded-lg mt-3 text-sm md:text-md text-white font-bold" style="background: #47afbe">Submit Review</button>
      </form>
    </div>
  </div>
</main>
@endsection