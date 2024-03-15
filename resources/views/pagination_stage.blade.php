


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


