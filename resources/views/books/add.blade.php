@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Book</div>

                <div class="panel-body">
                    @if (Session::has('insert_error'))
                    <div class="alert alert-danger">
                      <strong>Error!</strong> {{ session('insert_error') }} 
                    </div>
                    @endif
                    @if (Session::has('insert_success'))
                    <div class="alert alert-success">
                      <strong>Success!</strong> {{ session('insert_success') }} 
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('book.insert') }}">
                        {{ csrf_field() }}
                        

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Book Name</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('author_id') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Select Author</label>

                            <div class="col-md-6">
                                <select id="author_id" class="form-control" name="author_id">
                                    @foreach($author as $author)
                                        <option value="{{$author->id}}">{{$author->author_name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('author_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('author_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
