
function edit(id)
{
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/employee/" + id + "/edit",
        data: { id },
        success: function (data) {

            console.log(data.data);
            $("#name").val(data.data.name);
            $("#email").val(data.data.email);
            $("#mobile").val(data.data.mobile);
            $("input[name=dob]").val(data.data.dob);
            $("input[name=doj]").val(data.data.doj);
            $("#salary").val(data.data.salary);
            $("#designation").val(data.data.designation);

            $("#employee_form_button").html('update');
            $("#employee_header").html('Edit Employee');
        

           
            $("#employee_form").attr("action", "/employee/" + id);
            
            $("#employee_method").val("PUT");
        },
    });
}

function delete_emp(id)
{
    console.log(id);
   

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var token = $('meta[name="csrf-token"]').attr("content");
            $.ajax({
                url: "/employee/" + id,
                type: "Delete",
                data: { _token: token },
                success: function (data) {
                    Swal.fire(
                        'Deleted!',
                        data.message,
                        'success'
                    );
                    $(".btn-delete[data-employee-id="+id+"]").closest('tr').remove();

                    // window.location.reload();
                },
            });
        }
    });
        
    }



