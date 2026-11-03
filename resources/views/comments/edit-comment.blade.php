@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card mb-2 col-md-8">
                <div class="card-header text-center">
                       تعديل التعليق
                </div>

                <div class="card-body">
                    <form action="{{ route('comment.update', $comment->id) }}" method="POST"
                    >
                     @csrf
                     @method('PATCH')

                    <div class="mb-3">
                        <label for="comment" class="form-label"> نص التعليق</label>
                        <textarea id="comment" name="comment" rows="4"
                         class="form-control @error('comment') is-invalid @enderror">{{$comment->body}}</textarea>

                         @error('comment')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                             
                         @enderror
                    </div>


                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-secondary"> عدل</button>
                        </div>
                    </div>


                    </form>
                </div>
            </div>    
        </div>

    </div>
@endsection

