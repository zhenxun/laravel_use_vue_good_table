@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col">

          <div class="col text-right">
              <a class="btn btn-info" href="{{ route('articles.create') }}" role="button"><i class="fa fa-plus"></i> &nbsp;  Add</a>
          </div>

          <div id="app" class="mt-5">
              <articles></articles>
          </div>
          
            
      </div>
  </div>
</div>


@endsection