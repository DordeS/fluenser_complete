@extends('layouts.app')
@section('content')
<header class="bg-white">
  <div class="w-full md:max-w-7xl mx-auto py-1 px-3 sm:px-6 lg:px-8 bg-gray-800 h-10">
    <p class="italic text-lg md:text-xl text-white font-bold leading-8" style="font-family: 'Josefin Sans', sans-serif;">{{ __('COLLABORATE') }}</p>
  </div>
</header>

  <main class="w-full md:max-w-7xl mx-auto">
    <div class="w-full md:max-w-7xl mx-auto sm:px-6 lg:px-8" id="collaborate" style="overflow: auto">
      <!-- Replace with your content -->
        <div class="px-4 sm:px-0 bg-white w-11/12 mx-auto my-3 md:max-w-lg pb-20">
          <img src={{ asset('img/profile-image/'.$influencerInfo->avatar.'.jpg') }} alt="$influencerInfo->avatar" class="w-4/5 mx-auto rounded-lg">
          <p class="text-center text-black text-lg md:text-xl font-bold">
            {{ $influencerInfo->name }}
          </p>
          <p class="text-center text-gray-500 text-sm md:text-md">
            {{ $influencerInfo->country." ".$influencerInfo->state }}
          </p>
          <div class="w-full mt-10">
            <form action={{ route('saveRequest') }} method="post" id="requestForm">
              {{ csrf_field() }}
              <input type="text" name="title" id="title" class="w-full rounded-lg bg-gray-200 border-none my-2 @error('title') is-invalid @enderror" placeholder="Project Title" value="{{ old('title') }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              <textarea name="detail" id="detail" class="w-full rounded-lg bg-gray-200 border-none my-2 @error('detail') is-invalid @enderror" placeholder="Describe your project" rows='5'>{{ old('detail') }}</textarea>
                @error('detail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              <div class="attach w-full rounded-lg my-2">
                {{-- file upload --}}
                <div class="w-full min-h-lg sm:py-8">
                  <main class="mx-auto max-w-screen-lg h-full">
                    <!-- file upload modal -->
                    <article aria-label="File Upload Modal" class="relative h-full flex flex-col bg-white rounded-lg">
           
                      <!-- scroll area -->
                      <section class="h-full w-full h-full flex flex-col">
                        <header class="border-dashed border-2 border-gray-200 py-12 flex flex-col justify-center items-center rounded-lg">
                          <input id="hidden-input" type="file" name="image" class="image hidden" />
                          <a id="button" class="mt-2 rounded-sm px-3 py-1 bg-gray-700 hover:bg-gray-500 focus:shadow-outline focus:outline-none rounded-xl text-white">
                            <i class="fas fa-plus-circle"></i>
                            Attach File
                          </a>
                          <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center underline text-xs md:text-sm text-gray-300">
                            Max size is 20MB.
                          </p>
                          <ul id="gallery" class="w-11/12 mx-auto">
                          </ul>
                        </header>
                      </section>
            
                      <!-- sticky footer -->
                    </article>
                  </main>
                </div>
                <div class="w-full mx-auto my-5">
                  <p class="text-center text-gray-500 text-sm md:text-md mb-5">
                    How will you compensate the influencers?
                  </p>
                  <a href="#" class="payMethod active">
                    <div class="payMethod float-left" style="width: 90px; height: 90px; border-radius:50%; background:white; border: 1px solid lightgray; padding:15px">
                      <p class="text-3xl text-gray-500 text-center" style="line-height: 35px"><i class="fas fa-dollar-sign"></i></p>
                      <p class="text-center text-sm text-gray-500" style="line-height: 25px">
                        Money
                      </p>
                    </div>
                  </a>
                  <a href="#" class="payMethod">
                    <div class="payMethod float-right mx-auto" style="width: 90px; height: 90px; border-radius:50%; background:white; border: 1px solid lightgray; padding:15px">
                      <p class="text-3xl text-gray-500 text-center text-gray-500" style="line-height: 35px"><i class="fas fa-shopping-bag"></i></p>
                      <p class="text-center text-sm  text-gray-500" style="line-height: 25px">
                        Both
                      </p>
                    </div>
                  </a>
                  <a href="#" class="payMethod">
                    <div class="payMethod mx-auto" style="width: 90px; height: 90px; border-radius:50%; background:white; border: 1px solid lightgray; padding:15px">
                      <p class="text-3xl text-gray-500 text-center text-gray-500" style="line-height: 35px"><i class="fas fa-shopping-bag"></i></p>
                      <p class="text-center text-sm  text-gray-500" style="line-height: 25px">
                        Product
                      </p>
                    </div>
                  </a>
                  <div class="clearfix"></div>
                </div>
                <div class="w-full">
                  <label for="price" class="block text-sm font-medium text-gray-700">Budget</label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-500 sm:text-sm">
                        $
                      </span>
                    </div>
                    <input type="text" name="price" id="price" class="block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md @error('price') is-invalid @enderror" placeholder="0.00" style="height: 38px" value="{{ old('price') }}">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                      <label for="currency" class="sr-only">Currency</label>
                      <select id="currency" name="currency" class="h-full py-0 pl-2 pr-7 border-transparent text-black sm:text-sm rounded-md bg-gray-300" style="height: 34px; margin-right:2px;">
                        <option value="gbp">GBP</option>
                        <option value="usd">USD</option>
                        <option value="eur">EUR</option>
                      </select>
                      <input type="text" name="files" id="files" hidden>
                    </div>
                  </div>
                </div>
              </div>
              @error('price')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <input type="text" name="brand_id" id="brand_id" value="{{ $accountInfo->id }}" hidden>
              <input type="text" name="influencer_id" id="influencer_id" value="{{ $influencerInfo->id }}" hidden>
              <textarea name="images" id="images" cols="30" rows="10" hidden></textarea>
              <button id="sendRequest" type="submit" class="w-full py-2 text-white rounded-md text-sm md:text-md font-bold" style="background: #2bc5b5">Send</button>
            </form>
          </div>
        </div>
    </div>
  </main>

  {{-- upload modal --}}
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
              <div class="row">
                  <div class="col-md-8">
                      <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                  </div>
                  <div class="col-md-4">
                      <div class="preview"></div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="crop">Crop</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    var filesValue;

    const hidden = document.getElementById("hidden-input");
        document.getElementById("button").onclick = () => hidden.click();
        hidden.onchange = (e) => {
        var files = e.target.files;
        var done = function (url) {
          console.log(url);
          image.src = url;
          $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
          file = files[0];

          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
    };

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
      cropper.destroy();
      cropper = null;
    });



    $("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
          width: 160,
          height: 160,
          });

        canvas.toBlob(function(blob) {
          url = URL.createObjectURL(blob);
          var reader = new FileReader();
          reader.readAsDataURL(blob); 
          reader.onloadend = function() {
            var base64data = reader.result;
            var element = '<li class="float-left w-1/2 md:w-1/4 px-2 py-2 relative"><img src="" class="w-full rounded-lg"></li>';
            var deleteBtn = '<a class="delete absolute bottom-5 right-5 z-10" onclick="$(this).parent().remove()"><i class=" text-gray-100 hover:text-gray-700 far fa-trash-alt"></i></a>'
            $("ul#gallery").prepend(element);
            $("ul#gallery li:first-child img").attr('src', base64data);
            $("ul#gallery li:first-child").append(deleteBtn);
            $modal.modal('hide');
            }
        });
    });

    $('button#sendRequest').click(function() {
      var imageData = $("ul#gallery img");
      var images = [];
      console.log(imageData);
      if(imageData.length > 0) {
        for (let i = 0; i < imageData.length; i++) {
          const image = imageData[i];
          images.push(image.src);
        }
      }
      $("textarea#images").val(JSON.stringify(images));
    });

  </script>

@endsection