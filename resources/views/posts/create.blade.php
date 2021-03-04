@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post)? 'Edit Post' : 'Create Post' }}
        </div>

        <div class="card-body">

        @include('partial.errors')

            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if( isset($post) )
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ isset($post)? $post->title:'' }}">
                </div>

                <div class="form-group">
                    <label for="title">Price</label>
                    <input type="text" class="form-control" name="price" id="price" value="{{ isset($post)? $post->price:'' }}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="publish_at">Publish_at</label>
                    <input type="text" class="form-control" name="publish_at" id="publish_at" value="{{ isset($post) ? $post->publish_at : '' }}">
                </div>

                @if(isset($post))
                    <div class="form-group">
                        <img src="{{ asset('storage/'.$post->image) }}" alt="" style="width: 100%;">
                    </div>
                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>

                <div class="form-group">
                    <label for="catagory">Category</label>
                    <select name="catagory" id="catagory" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                @if( isset($post) )
                                    @if($category->id == $post->catagory_id)
                                        selected
                                    @endif
                                @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="album_id">Album_Code</label>
                    <select name="album_id" id="album_id" class="form-control">
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}"
                                @if( isset($post) )
                                    @if($album->id == $post->album->id)
                                        selected
                                    @endif
                                @endif 
                            >

                                {{ $album->album_code }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if($tags->count() > 0)
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"

                                @if(isset($post))
                                    @if($post->hasTag($tag->id))
                                        selected
                                    @endif
                                @endif
                                >
                               

                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if($options->count() > 0)
                <div class="form-group">
                    <label for="options">Options</label>
                    <select name="options[]" id="options" class="form-control options-selector" multiple>
                        @foreach($options as $option)
                            <option value="{{ $option->id }}"

                                @if(isset($post))
                                    @if($post->hasOption($option->id))
                                        selected
                                    @endif
                                @endif
                                >
                               

                                {{ $option->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="form-group">
                    <button  class="btn btn-success" >Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        flatpickr('#publish_at', {
            enableTime:true,
            enableSeconds:true
        })

        $(document).ready(function() {
            $('.tags-selector').select2();
        });

        $(document).ready(function() {
            $('.options-selector').select2();
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
@endsection