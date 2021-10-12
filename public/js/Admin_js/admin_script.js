$(document).ready(function () {
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
       // alert(current_pwd);
        $.ajax({
           type:'post',
           url:'/admin/check-current-pwd',
           data:{current_pwd:current_pwd},
           success:function(resp) {
               if(resp=='false')
               {
                   $('#checkpwd').html('<font color=red>Current Password is incorrect</font>')
               }
               else if (resp == 'true'){
                   $('#checkpwd').html('<font color=green>Current Password is correct</font>')

               }
           },error:function () {
                  alert('error');
           }
        });
    });

    $(".update-section-status").click(function () {
        var status = $(this).text();
        var section_id=$(this).attr("section_id");
       // alert(status);
        //alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/update-section-status',
            data: { status:status,section_id:section_id },
                    success: function (resp) {
                    //alert(resp['status']);
                    //alert(resp['section_id']);
                        if (resp['status']==0) {
            $('#section-' + section_id).html("<a  class='update-section-status' href='javascript: void (0)' id='section-{{ $section-> id }}'>Inctive</a>")

                    }
                       else if (resp['status'] == 1)
                       {
                            $('#section-' + section_id).html("<a  class='update-section-status' href='javascript: void (0)' id='section-{{ $section-> id }}'>Active</a>")

                       }

            }, error: function () {
                alert('Error');
            }

            });
    });


    $(".update-category-status").click(function () {
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        // alert(status);
        //alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/update-category-status',
            data: { status: status, category_id: category_id },
            success: function (resp) {
                //alert(resp['status']);
                //alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $('#category-' + category_id).html("<a  class='update-category-status' href='javascript: void (0)' id='category-{{ $category-> id }}'>Inctive</a>")

                }
                else if (resp['status'] == 1) {
                    $('#category-' + category_id).html("<a  class='update-category-status' href='javascript: void (0)' id='category-{{ $category-> id }}'>Active</a>")

                }

            }, error: function () {
                alert('Error');
            }

        });
    });


    $(".update-brand-status").click(function () {
        var status = $(this).text();
        var brand_id = $(this).attr("brand_id");
        // alert(status);
        //alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/update-brand-status',
            data: { status: status, brand_id: brand_id },
            success: function (resp) {
                //alert(resp['status']);
                //alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $('#brand-' + brand_id).html("<a  class='update-brand-status' href='javascript: void (0)' id='brand-{{ $brand-> id }}'>Inctive</a>")

                }
                else if (resp['status'] == 1) {
                    $('#brand-' + brand_id).html("<a  class='update-brand-status' href='javascript: void (0)' id='brand-{{ $brand-> id }}'>Active</a>")

                }

            }, error: function () {
                alert('Error');
            }

        });
    });



    $(".update-attribute-status").click(function () {
        var status = $(this).text();
        var attribute_id = $(this).attr("attribute_id");
        // alert(status);
        //alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/update-attribute-status',
            data: { products_attributes_status: status, attribute_id: attribute_id },
            success: function (resp) {
                //alert(resp['status']);
                //alert(resp['section_id']);
                if (resp['products_attributes_status'] == 0) {
                    $('#product-' + attribute_id).html("Inctive")

                }
                else if (resp['products_attributes_status'] == 1) {
                    $('#product-' + attribute_id).html("Active")

                }

            }, error: function () {
                alert('Error');
            }

        });
    });
  $(".update-image-status").click(function () {
        var status = $(this).text();
        var image_id = $(this).attr("image_id");
        // alert(status);
        //alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/update-image-status',
            data: { status:status, image_id:image_id },
            success: function (resp) {
                //alert(resp['status']);
                //alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $('#image-' + image_id).html("Inctive")

                }
                else if (resp['status'] == 1) {
                    $('#image-' + image_id).html("Active")

                }

            }, error: function () {
                alert('Error');
            }

        });
    });

    $("#section_id").change(function(){
var section_id=$(this).val();
//alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/append-category-level',
            data:{section_id:section_id},
            success: function (resp) {
                $('#appendCategoryLevel').html(resp);
            },error:function(resp) {
              alert('Error');
            }

        });
    });




   /* $(".confirmDelete").click(function () {
        var name = $(this).attr("name");

        if (confirm("Are You sure to Delete this "+name+"?")) {
            return true;
        }

        return true;
    });
*/
        $(document).on("click",".confirmDelete",function(){
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        var recordname = $(this).attr("recordname");
        Swal.fire({
            text: "Are You sure to Delete " + recordname+" category ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location.href = "/admin/delete-" + record + "/" + recordid;
            }

        });

    });


    $(".confirmImageDelete").click(function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        var recordname = $(this).attr("recordname");
        Swal.fire({

            text: "Are You sure to Delete " + recordname + " category Image?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location.href = "/admin/delete-" + record + "/" + recordid;
            }

        });

    });


    $(".imagecategory").click(function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        var recordname = $(this).attr("recordname");
        Swal.fire({
            text: "Are You sure to Delete " + recordname + " Product ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location.href = "/admin/delete-" + record + "/" + recordid;
            }

        });

    });

//product status
    $(".update-product-status").click(function () {
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        // alert(status);
        //alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/update-product-status',
            data: { status: status, product_id: product_id },
            success: function (resp) {
                //alert(resp['status']);
                //alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $('#product-' + product_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>")

                }
                else if (resp['status'] == 1) {
                    $('#product-' + product_id).html("<i class= 'fas fa-toggle-on' aria-hidden='true' status='Active'></i>")

                }

            }, error: function () {
                alert('Error');
            }

        });
    });

    $(".confirmproductDelete").click(function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        var recordname = $(this).attr("recordname");
        Swal.fire({
            text: "Are You sure to Delete " + recordname + " Product ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location.href = "/admin/delete-" + record + "/" + recordid;
            }

        });

    });

    $(".brandDelete").click(function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        var recordname = $(this).attr("recordname");
        Swal.fire({
            text: "Are You sure to Delete " + recordname + " Brand ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location.href = "/admin/" + record + "/" + recordid;
            }

        });

    });

    $(".section").click(function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        var recordname = $(this).attr("recordname");
        Swal.fire({
            text: "Are You sure to Delete " + recordname + " Section ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your Section has been deleted.',
                    'success'
                )
                window.location.href = "/admin/" + record + "/" + recordid;
            }

        });

    });

    $(".attributedelete").click(function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        var recordname = $(this).attr("recordname");
        Swal.fire({
            text: "Are You sure to Delete " + recordname + " Attribute ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your Attribute has been deleted.',
                    'success'
                )
                window.location.href = "/admin/" + record + "/" + recordid;
            }

        });

    });
       $(".productsimage").click(function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        var recordname = $(this).attr("recordname");
        Swal.fire({
            text: "Are You sure to Delete " + recordname + " Image ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your Image has been deleted.',
                    'success'
                )
                window.location.href = "/admin/" + record + "/" + recordid;
            }

        });

    });





//dynamic attribute add remove
    var maxField = 100; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div> <input type="text" style="width:120px" name="products_attributes_size[]" placeholder="Product size"/> <input style="width:120px" type="text" name="products_attributes_price[]" placeholder="Product Price" value=""/> <input type="text" style="width:120px" name="products_attributes_stock[]" placeholder="Product Stock" value=""/> <input style="width:120px" type="text" placeholder="Product SKU"name="products_attributes_sku[]" value=""/> <a href="javascript:void(0);" class="remove_button"> Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });


    // <a href="{{url('/subject-delete',$subject['id'])}}" ><i class="fas fa-trash"></i></a>

});
