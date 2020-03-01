@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>
                  <div class="panel-body">
                      @if (session('success'))
                          <div class="alert alert-success alert-dismissible">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ session('success') }}
                          </div>
                      @endif     
                    <table id="books_table" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Sr No.</th>
                          <th>Title</th>
                          <th>Author</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach($data as $data)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->title}}</td>
                            <td>{{$data->author[0]['author_name']}}</td>
                            <td>
                                <a href="{{route('book.edit', $data->id)}}">Edit</a> |
                                <a href="{{route('book.delete', $data->id)}}">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
              </div>
        </div>
    </div>
</div>
@endsection
