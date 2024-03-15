
<!-- Modal -->
<div class="modal fade" id="stagesModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form   method="POST" id="addstageForm">
        {{-- {{ url('/') }} --}}
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">add new text</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ErrorCategoryMessage  text-center p-1"> </div>

           
              <div class="form-group">
                <label for="exampleInputPassword1" class="my-1">text:</label>
                <input type="text" class="form-control" id="stage"  name="stage" placeholder="text">
              </div>
              <button type="submit" class="btn btn-primary my-3  add_stage"  data-url="{{ route('add.stages') }}">Submit</button>
           

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </form>
</div>
<!-- .............................. -->

