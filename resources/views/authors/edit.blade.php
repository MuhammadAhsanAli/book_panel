@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Author</div>

                <div class="panel-body">
                    @if (Session::has('update_error'))
                    <div class="alert alert-danger">
                      <strong>Error!</strong> {{ session('update_error') }} 
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('author.update') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('author_name') ? ' has-error' : '' }}">
                            <label for="author_name" class="col-md-4 control-label">Author Name</label>

                            <div class="col-md-6">
                                <input id="author_name" type="text" class="form-control" name="author_name" value="{{ $data->author_name }}"  required autofocus>

                                @if ($errors->has('author_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('author_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $data->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $data->phone }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Data ID -->
                            <input type="hidden" name="id" value="{{$data->id}}"/>
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
