<x-guest-layout>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <div class="mt-4 flex justify-center ">

        <div class="md:w-3/4 md:flex flex-row shadow-inner">

            <form  id="upload-form" class="dropzone w-full" action="{{route('pin.store')}}">
                 <h3 class="text-2xl">Pin wijzigen</h3>
                @csrf
                <div class="md:flex gap-4 justify-between">
                    <div class="uploadzone md:w-1/4">
                        <div class="p-8 dz-message border-black border-dashed border" data-dz-message><span>Upload jouw afbeeldingen</span></div>
                        <div class="dropzone-previews"></div>
                    </div>
                    <div class="fields md:w-3/4">
                         <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="title">
                              Titel
                            </label>
                            <input value="{{$pin->title}}" class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="title" name="title">
                          </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="category">
                              Categorie
                            </label>
                            <select class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="category" name="category">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <optgroup label="{{$category->name}}">
                                        @foreach($category->subcategories as $sub)
                                            <option @if($sub->id == $pin->categories[0]->id) selected @endif value="{{$sub->id}}">{{$sub->name}}</option>
                                        @endforeach
                                    </optgroup>

                                @endforeach

                            </select>
                        </div>

                        <div class="mb-4 md:w-1/2">
                               @livewire('tags.tag-input', ['old_tags' => $pin->tags])
                        </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="description">
                              Beschrijving
                            </label>
                            <textarea rows="10" class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="description" name="description">{{$pin->description}}</textarea>
                        </div>

                        <div class="mb-4 md:w-1/2">
                            {{-- loop over the images --}}
                            @foreach($pin->getMedia('images') as $image)

                                <div class="flex flex-row mb-4">
                                    <img class="w-20 h-20" src="{{$image->getUrl()}}" alt="">
                                    <div class="flex flex-col justify-center">
                                        <form action="{{route('pin.removeImage', $pin)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="media_id" value="{{$image->id}}">
                                            <input class="!cursor-pointer" type="submit" value="Verwijderen">
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="bg-indigo-500 text-white p-2 rounded-lg hover:bg-indigo-600">Opslaan</button>

                    </div>
                </div>


            </form>

            <script >
                Dropzone.options.uploadForm = { // The camelized version of the ID of the form element

                  // The configuration we've talked about above
                  autoProcessQueue: false,
                  uploadMultiple: true,
                  parallelUploads: 100,
                  maxFiles: 100,
                  addRemoveLinks: true,
                  previewsContainer: '.dropzone-previews',


                  // The setting up of the dropzone
                  init: function() {
                    var myDropzone = this;

                    // First change the button to actually tell Dropzone to process the queue.
                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                      // Make sure that the form isn't actually being sent.
                      e.preventDefault();
                      e.stopPropagation();
                      myDropzone.processQueue();
                    });

                    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                    // of the sending event because uploadMultiple is set to true.
                    this.on("sendingmultiple", function() {
                      // Gets triggered when the form is actually being sent.
                      // Hide the success button or the complete form.
                    });
                    this.on("successmultiple", function(files, response) {
                      // Gets triggered when the files have successfully been sent.
                      // Redirect user or notify of success.

                    });
                    this.on("errormultiple", function(files, response) {
                      // Gets triggered when there was an error sending the files.
                      // Maybe show form again, and notify user of error

                    });
                  }
                }

            </script>
        </div>
    </div>
</x-guest-layout>
