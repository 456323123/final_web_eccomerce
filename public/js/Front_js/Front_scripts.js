$(document).ready(function () {
    // $("#sort").on('change',function () {
    //     this.form.submit();
    //  })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#sort").on('change', function () {
        var sort = $(this).val();
        var brand = get_filter("brand");
        var fabric = get_filter("fabric");
        var Sleeve = get_filter("Sleeve");
        var Fit = get_filter("Fit");
        var Patten = get_filter("Patten");
        var Occission = get_filter("Occission");
        var url = $("#url").val();

        $.ajax({
            url:url,
            method:"post",
            data: {brand:brand, fabric: fabric, Sleeve: Sleeve, Patten: Patten, Fit: Fit, Occission: Occission,sort:sort,url:url},
            success:function (data) {
                    $('.filter_products').html(data);
            }
        })
    });

$(".fabric").on('click',function()
    {
    var brand = get_filter("brand");
    var fabric = get_filter("fabric");
    var Sleeve = get_filter("Sleeve");
    var Fit = get_filter("Fit");
    var Patten = get_filter("Patten");
    var Occission = get_filter("Occission");
    var sort = $("#sort option:selected").val();
    var url = $("#url").val();
    $.ajax({
        url: url,
        method: "post",
        data: { brand: brand,fabric: fabric, Sleeve: Sleeve, Patten: Patten, Fit: Fit, Occission: Occission, sort: sort, url: url },
        success: function (data) {
            $('.filter_products').html(data);
        }
    })
    }
);


    $(".Sleeve").on('click', function () {
        var brand = get_filter("brand");
        var fabric = get_filter("fabric");
        var Sleeve = get_filter("Sleeve");
        var Fit = get_filter("Fit");
        var Patten = get_filter("Patten");
        var Occission = get_filter("Occission");
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: { brand: brand,fabric: fabric, Sleeve: Sleeve, Patten: Patten, Fit: Fit, Occission: Occission, sort: sort, url: url },
            success: function (data) {
                $('.filter_products').html(data);
            }
        })
    }
    );


    $(".Patten").on('click', function () {
        var brand = get_filter("brand");
        var fabric = get_filter("fabric");
        var Sleeve = get_filter("Sleeve");
        var Fit = get_filter("Fit");
        var Patten = get_filter("Patten");
        var Occission = get_filter("Occission");
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: { brand: brand,fabric: fabric, Sleeve: Sleeve, Patten: Patten, Fit: Fit, Occission: Occission, sort: sort, url: url },
            success: function (data) {
                $('.filter_products').html(data);
            }
        })
    }
    );


    $(".Fit").on('click', function () {
        var brand = get_filter("brand");
        var fabric = get_filter("fabric");
        var Sleeve = get_filter("Sleeve");
        var Fit = get_filter("Fit");
        var Patten = get_filter("Patten");
        var Occission = get_filter("Occission");
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: { brand: brand,fabric: fabric, Sleeve: Sleeve, Patten: Patten, Fit: Fit, Occission: Occission, sort: sort, url: url },
            success: function (data) {
                $('.filter_products').html(data);
            }
        })
    }
    );


    $(".Occission").on('click', function () {
        var brand = get_filter("brand");
        var fabric = get_filter("fabric");
        var Sleeve = get_filter("Sleeve");
        var Fit = get_filter("Fit");
        var Patten = get_filter("Patten");
        var Occission = get_filter("Occission");
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: { brand: brand,fabric: fabric, Sleeve: Sleeve, Patten: Patten, Fit: Fit, Occission: Occission, sort: sort, url: url },
            success: function (data) {
                $('.filter_products').html(data);
            }
        })
    }
    );


    $(".brand").on('click', function () {
        var brand = get_filter("brand");
        var fabric = get_filter("fabric");
        var Sleeve = get_filter("Sleeve");
        var Fit = get_filter("Fit");
        var Patten = get_filter("Patten");
        var Occission = get_filter("Occission");
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: { brand:brand, fabric: fabric, Sleeve: Sleeve, Patten: Patten, Fit: Fit, Occission: Occission, sort: sort, url: url },
            success: function (data) {
                $('.filter_products').html(data);
            }
        })
    }
    );

function get_filter(class_name)
{
    var filter=[];
    $('.'+class_name+':checked').each(function(){
        filter.push($(this).val());
    });

    return filter;
}







//price attribute get



$('#GetPrice').change(function() {

    var size = $(this).val();
    if(size=="")
    {
        alert("Please Select Size");
        return false;
    }
    var product_id=$(this).attr('product_id');
    //alert(product_id);
    $.ajax({
url:'/get-product-price',
data:{size:size,product_id:product_id},
type:"post",
        success: function (resp) {
            // alert(resp['discounted_price']);
            if (resp['discounted_price']>0)
            {
                $(".GetProductAttr").html("<del>Rs." + resp['product_price'] + "</del>" + "Rs." + resp['discounted_price']);

            }
            else{
            $(".GetProductAttr").html("Rs."+resp);
            }
        },
        error: function (resp) {
            //alert('error');
        }

    });

});










});
