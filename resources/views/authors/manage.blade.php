@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Authors</div>
                  <div class="panel-body">
                      @if (session('success'))
                          <div class="alert alert-success alert-dismissible">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ session('success') }}
                          </div>
                      @endif     
                    <table id="author_table" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach($data as $data)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->author_name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->phone}}</td>
                            <td><a href="{{route('author.edit', $data->id)}}">Edit</a></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
              </div>
        </div>
    </div>
</div>
@endsection
