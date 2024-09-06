<!DOCTYPE html>
<html>
<head>
    <title>Ajax CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>

<div class="container">
<br>
    <a class="btn btn-success mb-2" href="javascript:void(0)" id="createNewProduct"> Create New Product</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create" >Save Changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>



<script type="text/javascript">
  $(function () {

/*------------------------------------------
     --------------------------------------------
     Pass Header Token
     --------------------------------------------
     --------------------------------------------*/
    $.ajaxSetup({       //set default header for all ajax request
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });


    /*------------------------------------------
    --------------------------------------------
    Render DataTable
    --------------------------------------------
    --------------------------------------------*/
    var table = $('.data-table').DataTable({            //initialize in datatbale plugin
        processing: true,       // processing loader
        serverSide: true,       // server side proccessing enable , data fetch and procced on server
        ajax: "{{ route('products-ajax-crud.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            {data: 'name', name: 'name'},
            {data: 'detail', name: 'detail'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });



    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewProduct').click(function () {      //This function triggers when the "Create New Product" button is clicked.
        $('#saveBtn').val("create-product");        // Sets the value of the saveBtn button to "create-product"
        $('#product_id').val('');                   //Clears the product_id hidden input field.
        $('#productForm').trigger("reset");         // Resets the form inputs.
        $('#modelHeading').html("Create New Product");  //Sets the modal heading text to "Create New Product"
        $('#ajaxModel').modal('show');              // Displays the modal for creating a new product.
    });


    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editProduct', function () {     //This function is triggered when an edit button (with class editProduct) is clicked.
      var product_id = $(this).data('id');                  //Retrieves the id of the product to be edited from the data-id attribute.
      $.get("{{ route('products-ajax-crud.index') }}" +'/' + product_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");      //Changes the modal heading to "Edit Product".
          $('#saveBtn').val("edit-product");  // Sets the value of the saveBtn button to "edit-user".
          $('#product_id').val(data.id);                // Populates the product_id hidden input field with the product ID.
          $('#name').val(data.name);                    // Fills in the product name.
          $('#detail').val(data.detail);                //Fills in the product details.
          $('#ajaxModel').modal('show');                  // Displays the modal for editing the product.
      })
    });



    /*------------------------------------------
    --------------------------------------------
    Create Product Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {          // This function triggers when the "Save changes" button is clicked in the modal.
        e.preventDefault();                     // prevents the default form submission

        $.ajax({                                // Makes an AJAX POST request to either create a new product or update an existing one.
          data: $('#productForm').serialize(),      // Serializes the form data for submission.
          url: $('#saveBtn').val() == "create-product" ? "{{ route('products-ajax-crud.store') }}" : "{{ url('products-ajax-crud') }}" + '/' + $('#product_id').val(),
          type: $('#saveBtn').val() == "create-product" ? "POST" : "PUT",                 // method type post or put depending on action
          dataType: 'json',             // response in json format
          success: function (data) {      //if success then it ex.

              $('#productForm').trigger("reset");       //reset the inputs
              $('#ajaxModel').modal('hide');            //hide model

              table.draw();                             // refresh table to show updated data

          },
          error: function (data) {      // if error then ex.
              console.log('Error:', data);          //log error to console
              $('#saveBtn').html('Save Changes');   //Reenable button
          }
      });
    });

    /*------------------------------------------
    --------------------------------------------
    Delete Product Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteProduct', function () {   //when delete button clicked

        var product_id = $(this).data("id");            // retrive id from data-id


        $.ajax({                                      //make req to delete
            type: "DELETE",                             // req type
            url: "{{ url('products-ajax-crud') }}"+'/'+product_id,  //build url for delete useing ID
            success: function (data) {                      // iff success then ex.
                table.draw();                           //  refresh datatale to remove deleted data
            },
            error: function (data) {                    //if error ocur then ex.
                console.log('Error:', data);            //log error on console
            }
        });
    });

  });
</script>
</html>
