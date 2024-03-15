

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $(document).on('click', '.add_stage', function (e) {
            e.preventDefault();
            let stage = $('#stage').val(); // Use .val() to get the value of the input field
            $('.errMsgContainer').empty();
            // Use data-url attribute to pass the route URL to JavaScript
            let url = $(this).data('url');
          console.log(stage);
            $.ajax({
                url: url,
                method: 'POST',
                data: { "stage": stage }, // Add a comma here
                success: function (res) {
                    $('#stagesModal').modal('toggle');
                    $("#addstageForm")[0].reset();
                    $(".table").load(location.href + ' .table');
                    $(".loadtext").load(location.href + ' .loadtext');

                    if (res.status == "success") {
                      showToast('Success!', 'سەرکەوتوبوو');
                    }
                },
                error: function (err) {
                    let error = err.responseJSON;
                    if (error && error.errors) {
                        $.each(error.errors, function (index, value) {
                            $(".errMsgContainer").append('<span class="text-danger">' + value + '</span>' + '<br>');
                        });
                    }
                }
            });
        });

// .........................................update...............................


$(document).on('click',".update_stage_form",function () {
    let id=$(this).data('id');
    let stage=$(this).data('stage');
    $('#up_id').val(id);
    $('#up_stage').val(stage);
});

// .............

 $(document).on('click', '.update_stage', function(e) {
        e.preventDefault();
        let up_id = $('#up_id').val();
        let up_stage= $('#up_stage').val();
        $('.errMsgContainerupdate').empty();

        $.ajax({
            url: '{{ route("update.stage") }}', // Fixed the URL format
            method: 'POST', // Use uppercase POST
            data: {"up_id":up_id, "up_stage": up_stage },
            success: function(res) {
                // Handle success response here
                if (res.status == "success") {
                    $("#updatemodal").modal('hide'); 
                    $("#updateStageForm")[0].reset();
                    $(".table").load(location.href + ' .table');
                    $(".loadtext").load(location.href + ' .loadtext');  
                 
                      showToast('update', 'داتاکان نوێکرانەوە');
                }
            },
            error: function(err) {
                let error = err.responseJSON;
                if (error && error.errors) {
                    $.each(error.errors, function(index, value) {
                        // Append error messages to the errMsgContainer
                        $(".errMsgContainerupdate").append('<span class="text-danger">' + value + '</span>'+'<br>');
                    });
                }
            }
        });
    });
// .................................delete................................

$(document).on('click', '.delete_stage', function(e) {
    e.preventDefault();
    let stage_id = $(this).data('id'); // Corrected this line
    if (confirm("دڵنیایت لە سڕینەوە")) {
        $.ajax({
            url: '{{ route("delete.stage") }}', // Fixed the URL format
            method: 'POST', // Use uppercase POST
            data: { "stage_id": stage_id },
            success: function(res) {
                // Handle success response here
                if (res.status == "success") {
                    $(".table").load(location.href + ' .table');
                    $(".loadtext").load(location.href + ' .loadtext');
                    showToast('delete!','داتاکە سڕدرایەوە');
                }
            }
        });
    }
});

// ........................paginate..................

$(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    let page = $(this).attr('href').split('page=')[1];
    let url = "{{ route('pagination.data') }}"; 
    product(page, url);
});

function product(page, url) {
    $.ajax({
        url: url + "?page=" + page, // Use the generated URL
        success: function(res) {
            $('.table-data').html(res);
        }
    });
}






// ..................search.....................
$(document).on('keyup','#search',function (e) {
    e.preventDefault();
    let search_stages=$('#search').val();
    let url = "{{ route('aa.stage') }}"; 
    searches(url,search_stages);

});

function searches(url,search_stages) {
           console.log(url);

    $.ajax({
            url:url, // Fixed the URL format
            method: 'GET', // Use uppercase POST
            data: { search_stages: search_stages},
            success: function(res) {
            $('.table-data').html(res);
            if (res.status== "not have any data") {
             $('.table-data').html(`
                <div class="text-center text-danger">
                    <i class="fas fa-exclamation-triangle fa-3x"></i>
                    <p>هەچ داتایەک بوونی نییە</p>
                </div>
             `);
            }
        }
    })
}

    });
</script>
<!-- ..............................toast..................................... -->
<script>
    function showToast(title, message) {
    // Create a new toast element
    var toast = $('<div class="toast position-absolute top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">\
                      <div class="toast-header">\
                        <strong class="me-auto">' + title + '</strong>\
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>\
                      </div>\
                      <div class="toast-body">' + message + '</div>\
                    </div>');

    // Append the toast element to the body
    $('body').append(toast);

    // Initialize the Bootstrap toast
    var bootstrapToast = new bootstrap.Toast(toast[0]);

    // Show the toast
    bootstrapToast.show();

    // Automatically hide the toast after a certain time (e.g., 3000 milliseconds)
    setTimeout(function () {
        bootstrapToast.hide();
    }, 3000);

    // Remove the toast element after it is hidden
    toast.on('hidden.bs.toast', function () {
        toast.remove();
    });
}


</script>