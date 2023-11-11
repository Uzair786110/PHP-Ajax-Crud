<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<body>
<div class="container">
    <h1 id="myHeading">ADD PERSON</h1>
    <form action="" method="POST" role="form" id="personForm" class="form-horizontal">
 
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
    <input type="text" hidden id="action" value="create">
    <input type="text" class="form-control" id="ID" hidden>
      <input type="text" class="form-control" id="name" name="name">
    </div>
  </div>
  <div class="form-group">
    <label for="phone" class="col-sm-2 control-label">Contact Number</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="phone" name="phone">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="submitbtn" class="btn btn-success">Submit</button>
      <button type="button" id="updatebtn" class="btn btn-warning">Update</button>
    </div>
  </div>
</form>
</div>
<div class="container">
        <h1>Person Data</h1>
        <!-- Table to display data -->
        <table class="table table-bordered" id="personTable">
            <thead>
                <tr>
                <th>S no.</th>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="bdata">
        </table>
    </div>
</body>

    <script>
        $(document).ready(function () {
            function show() {
         $.ajax({
            url: "code.php",
            type: "POST",
            data: {
               action: "show"
            },
            success: function(data) {
               //console.log(data);
               //  alert(data);
               $("#bdata").html(data);
               $("#updatebtn").hide();
               $("#submitbtn").show();
               $("#myHeading").text("Add Person");
            },
         });
      }
      show();
            
            $('#personForm').submit(function (e) {
                e.preventDefault(); // Prevent the default form submission

                // Get form data
                var formData = {
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    action:$('#action').val()
                };

                // Perform the AJAX request
                $.ajax({
                    type: 'POST',
                    url: 'code.php', // Replace with your server endpoint
                    data: formData,
                    success: function (response) {
                        // Handle the success response here
                        console.log('Data submitted successfully');
                        $('#personForm')[0].reset();
                        alert("Data Submitted successfully");
                        show();
                    },
                    error: function (xhr, status, error) {
                        // Handle errors here
                        console.error('Error: ' + error);
                    }
                    
                });
            });

      
        $('#personTable').on('click', '.delete-button', function () {
        var id = $(this).data('id'); // Get the data-id attribute

        // Confirm the deletion (you can use a more sophisticated confirmation dialog)
        if (confirm('Are you sure you want to delete this record?')) {
            // Make an AJAX request to delete the data
            $.ajax({
                type: 'POST',
                url: 'code.php', // Replace with the endpoint to delete data
                data: { id: id },
                success: function (response) {
                    // Handle the success response
                    if (response.success) {
                    
                      
                        alert('Record deleted successfully');
                    
                        // alert('Error deleting the record');
                        
                    }
                    show();
                },
                error: function (xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        }
    });

    $('#personTable').on('click', '.edit-button', function () {
       
        var uid = $(this).data('id'); // Get the data-id attribute
        $.ajax({
                type: 'POST',
                url: 'code.php', // Replace with the endpoint to delete data
                data: { uid: uid },
                dataType: "html",
            success: function(data) {
               // console.log(data);
               //alert(data);
               var userData = JSON.parse(data);
               $("#ID").val(userData.ID);
               $("#name").val(userData.Name);
               $("#phone").val(userData.Contact);
               $("#submitbtn").hide();
               $("#updatebtn").show();
               $("#myHeading").text("Update Person");
              

            },
                error: function (xhr, status, error) {
                    alert('Record send successfully');
                    console.error('Error: ' + error);
                }
            });
    });
    $("#updatebtn").click(function () {
        var formData = {
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    editid:$('#ID').val()
                };

                // Perform the AJAX request
                $.ajax({
                    type: 'POST',
                    url: 'code.php', // Replace with your server endpoint
                    data: formData,
                    success: function (response) {
                        // Handle the success response here
                        $('#personForm')[0].reset();
                        alert("Data Updated successfully");
                        show();
                    },
                    error: function (xhr, status, error) {
                        // Handle errors here
                        console.error('Error: ' + error);
                    }
                    
                });
    });
    });
    </script>
</html>