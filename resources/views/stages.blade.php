@extends('layout.layout')

@section('content')


<div class="container">

<h3 class="text-black text-center my-3">Laravel and ajax</h3>

<button type="button" class="btn btn-success center my-3" data-bs-toggle="modal" data-bs-target="#stagesModal">
   add
</button>
</div>

<div class="input-group mb-3 container">
  <span class="input-group-text" id="basic-addon1"><i class="fa-brands fa-searchengin"></i></span>
  <input type="text" name="search" id="search"class="form-control" placeholder="search here"  aria-describedby="basic-addon1">
</div>

<div class="table-data">
<table class="table container table-bordered">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">text</th>
      <th scope="col">update and delete</th>
    </tr>
  </thead>
  <tbody>
@foreach($stages as $key=> $stage)
    <tr>
      <td scope="row">{{$key+1}}</td>
      <td>{{$stage->stage}}</td>
      <td>
    <a href="" class="btn btn-success update_stage_form" data-bs-toggle="modal" data-bs-target="#updatemodal"
                data-id="{{$stage->id}}"
                data-stage="{{$stage->stage}}"
                ><i class="fa-regular fa-pen-to-square"></i>
    </a>
               @if(Auth::user()->role == '1')
                <a href="" class="btn btn-danger delete_stage" data-id="{{$stage->id}}">
                    <i class="fa-regular fa-circle-xmark"></i>
                </a>
                @endif

    </tr>
    </td>
@endforeach

  </tbody>
</table>


<div class=" d-flex justify-content-center">
  {!! $stages->links() !!}
</div>
    <div class="text-center text-black loadtext">
    Showing {{ $stages->firstItem() }} to {{ $stages->lastItem() }} of {{ $stages->total() }} results
</div>
</div>

</div>









<!-- Modal -->
<div class="modal fade" id="updatemodal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="POST" id="updateStageForm">
        {{-- {{ url('/') }} --}}
        <input type="hidden" id="up_id">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">update text</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainerupdate"></div>
                    <div class="form-group">

                        <label for="name">text:</label>
                        <input type="text" class="form-control" id="up_stage" name="up_stage" placeholder="Enter text" required>
                    </div>

                    <button type="submit" class="btn btn-primary my-2 centar update_stage">update</button>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </form>
</div>


@include('addstages')
<!-- @include('updatestage') -->
@include('stages_js')

@endsection
