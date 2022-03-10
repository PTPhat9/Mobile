$(function(){
    $('.modal').on('show.bs.modal', function (e) {
        e.stopPropagation();
        $(".modal.show").css("padding-right", 0);
    });

    $(".capacity-item").click(function (e) { 
        e.preventDefault();
        var capacity_price = $(this).find("p").text();
        if (!$(this).hasClass("active")) {
            $(".capacity-item").removeClass("active");
            $(this).addClass("active");
        } else {
            return
        };
        $(".color-item p, .box-price p").text(capacity_price);
    });

    $(".thumbnail, .color-item").click(function (e) { 
        e.preventDefault();
        var srcImage = $(this).find("img").attr("src");
        
        if (!$(this).hasClass("active")) {
            $(".thumbnail, .color-item").removeClass("active");
            $(this).addClass("active");
        } else {
            return
        };
        var img = '<img src="' + srcImage + '"></img>'
        $(".featured-img").html(img);
    });

   

    $("form.form-contact").submit(function (e) { 
        e.preventDefault();
        var form_data = $(this).serialize();
        $(".message").html('Hệ thống đang gởi email... Vui lòng chờ <i class="fas fa-sync fa-spin"></i>');
        $(".message").removeClass("d-none");
        $("button[type=submit]").addClass("disabled") ;
        $.ajax({
            type: "POST",
            url: "index.php?c=contact&a=send",
            data: form_data,
            success: function (data) {
                $(".message").html(data);
                $("button[type=submit]").removeClass("disabled");
            }
        });
    });

    //Ajax Search
    var timeout = null;
    $(".box-search .search-input").keyup(function (e) { 
        clearTimeout(timeout);
        $(".box-suggest").html("");
        var pattern = $(this).val();
        timeout = setTimeout(function() {
            if(pattern != "") {
                $.ajax({
                    type: "GET",
                    url: "index.php?c=product&a=ajaxSearch",
                    data: {pattern: pattern},
                    success: function (data) {
                        $(".box-suggest").html(data);
                        $(".box-suggest").show();
                    }
                });
            }
        }, 500);
    });

    // cập nhật district khi thay đổi province
    $("section .province").change(function (e) { 
        e.preventDefault();
        var province_id = $(this).val();
        $("section .district").find('option').not(':first').remove();
        $.ajax({
            url: 'index.php?c=address&a=getDistricts',
            type: 'GET',
            data: {province_id: province_id},
            success: function (data) {
                var districts = JSON.parse(data);
                for (let i = 0; i < districts.length; i++) {
                    let district = districts[i];
                    let option = '<option value="' + district.id + '"> ' + district.name + '</option>';
                    $("section .district").append(option);
                } 
            }
        })
        
        $.ajax({
            url: 'index.php?c=address&a=getShippingFee',
            type: 'GET',
            data: {province_id: province_id},
            success: function (data) {
                let shipping_fee = Number(data);
                let payment_total = Number($("section .payment-total").attr("data")) + shipping_fee;
                
                $("section .shipping-fee").html(number_format(shipping_fee) + "₫");
                $("section .payment-total").html(number_format(payment_total) + "₫");
            } 
        })
    });
    // cập nhật ward khi thay đổi district
    $("section .district").change(function (e) { 
        e.preventDefault();
        var district_id = $(this).val();
        $("section .ward").find('option').not(':first').remove();
        $.ajax({
            url: 'index.php?c=address&a=getWards',
            type: 'GET',
            data: {district_id: district_id},
            success: function (data) {
                var wards = JSON.parse(data);
                for (let i = 0; i < wards.length; i++) {
                    let ward = wards[i];
                    let option = '<option value="' + ward.id + '"> ' + ward.name + '</option>';
                    $("section .ward").append(option);
                } 
            }
        })
    });

    $.ajax({
        type: "GET",
        url: "index.php?c=cart&a=display",
        success: function (data) {
            var cart = JSON.parse(data);
            var total_product_number = cart.total_product_number;
            $(".cart-qty").html(cart.total_product_number);
    }
    });
    
    
    //Thêm sp vào giỏ hàng
    $(".box-detail-product .buy").click(function (e) { 
        e.preventDefault();
        var param = new URLSearchParams(window.location.search);
        var product_id = param.get("id");
        var price = $(".capacity-item.active").attr("data");
        var color = $(".color-item.active").attr("data");
        var img = $(".featured-img > img").attr("src");
        var code = product_id + price + color;
        $.ajax({
            type: "GET",
            url: "index.php?c=cart&a=add",
            data:   {
                        product_id: product_id, 
                        qty: 1, 
                        price: price, 
                        color: color, 
                        img: img,
                        code: code,
                    },
            success: function (data) {
                $(".cart-modal").modal("show");
                var cart = JSON.parse(data);
                var total_product_number = cart.total_product_number;
                $(".cart-qty").html(cart.total_product_number);
            }
        });
    });

    


    jQuery.validator.addMethod("regexMobile", function(value, regex) {
        return /^0([0-9]{9,9})$/.test(value);
    });
    jQuery.validator.addMethod("regexPassword", function(value) {
        return /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(value);
    });
    $(".reset-password").validate({
        rules: {
            password: {
                required: true,
                regexPassword: true,
            },
            password_confirmation: {
                required: true,
                equalTo: "[name=password]",
            },
        },
        messages: {
            password: {
                required: "Vui lòng nhập mật khẩu",
                regexPassword:"Mật khẩu ít nhất 8 ký tự, bao gồm chữ và số ",
            },
            password_confirmation: {
                required: "Vui lòng nhập lại mật khẩu",
                equalTo: "Mật khẩu không trùng khớp",
            },
        },  
    })
    $(".info-account").validate({
        rules: {
            fullname: {
                required: true,
                minlength: 6,
            },
            mobile: {
                required: true,
                regexMobile: true,
            },
            current_password: {
                required: true,
            },
            password_confirmation: {
                equalTo: "[name=password]",
            },
        },
        messages: {
            fullname: {
                required: "Vui lòng nhập họ và tên",
                minlength: "Vui lòng nhập ít nhất 6 ký tự",
            },
            mobile: {
                required: "Vui lòng nhập số điện thoại",
                regexMobile: "Vui lòng nhập 10 con số bắt đầu là 0",
            },
            current_password: {
                required: "Vui lòng nhập mật khẩu của bạn",
            },
            password_confirmation: {
                equalTo: "Mật khẩu không trùng khớp",
            },
        },
    })
    $(".form-register").validate({
        rules: {
            fullname: {
                required: true,
                minlength: 6,
            },
            mobile: {
                required: true,
                regexMobile: true,
            },
            email: {
                required: true,
                email: true,
                remote: "/site/index.php?c=register&a=existingEmail"
            },
            password: {
                required: true,
                regexPassword: true,
            },
            password_confirmation: {
                required: true,
                equalTo: "[name=password]",
            },
        },
        messages: {
            fullname: {
                required: "Vui lòng nhập họ và tên",
                minlength: "Vui lòng nhập ít nhất 6 ký tự",
            },
            mobile: {
                required: "Vui lòng nhập số điện thoại",
                regexMobile: "Vui lòng nhập 10 con số bắt đầu là 0",
            },
            email: {
                required: "Vui lòng nhập email",
                email: "Vui lòng nhập đúng định dạng email. vd: a@gmail.com",
                remote: "Email đã tồn tại"
            },
            password: {
                required: "Vui lòng nhập mật khẩu",
                regexPassword:"Mật khẩu ít nhất 8 ký tự, bao gồm chữ và số ",
            },
            password_confirmation: {
                required: "Vui lòng nhập lại mật khẩu",
                equalTo: "Mật khẩu không trùng khớp",
            },
        },
        
    });
    $(".form-login").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Vui lòng nhập email",
                email: "Vui lòng nhập đúng định dạng email. vd: a@gmail.com",
            },
            password: {
                required: "Vui lòng nhập mật khẩu",
            },
        },
    });


    $(".form-comment").submit(function (e) { 
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "index.php?c=product&a=comments",
            data: data,
            success: function (response) {
                $(".list-comment").html(response);
                $(".box-comment .list-comment .comment-item .answered-star-rating").rating({
                    stars: "5",
                    min: 0, 
                    max: 5, 
                    size: "xs",
                    step: 1,
                    theme: 'krajee-fa',
                    filledStar: '<i class="fas fa-star"></i>', 
                    emptyStar: '<i class="fas fa-star"></i>',
                    showClear: false,
                    showCaption: false,
                    hoverEnabled: false,
                });
            }
        });
    });
    
    $(".login-user").click(function (){
        $('.menu-account').toggle();
    })

    // Hiện ẩn form đăng nhập/đăng kí
    $(".user").click(function (){
        $('#modal-login').modal("show");
    })
    $(".btn-register").click(function (){
        $('#modal-login').modal("hide");
        $('#modal-register').modal("show");
    })
    $(".btn-forgot-password").click(function (){
        $('#modal-login').modal("hide");
        $('#modal-forgot-password').modal("show");
    })

    $('input[name=checkout]').click(function(event) {
        window.location.href="index.php?c=cart&a=checkout";
    });
    // Đổi giá trị thành stars
    $(".box-common .item .star-rating").rating({
        stars: "5",
        min: 0, 
        max: 5, 
        size: "xs",
        step: 1,
        theme: 'krajee-fa',
        filledStar: '<i class="fas fa-star"></i>', 
        emptyStar: '<i class="fas fa-star"></i>',
        showClear: false,
        showCaption: false,
        hoverEnabled: false,
    });
    $(".box-comment .form-group .star-rating").rating({
        stars: "5",
        min: 0, 
        max: 5, 
        size: "xs",
        step: 1,
        theme: 'krajee-fa',
        filledStar: '<i class="fas fa-star"></i>', 
        emptyStar: '<i class="fas fa-star"></i>',
        showClear: false,
        showCaption: false,
    });
    $(".box-comment .list-comment .comment-item .answered-star-rating").rating({
        stars: "5",
        min: 0, 
        max: 5, 
        size: "xs",
        step: 1,
        theme: 'krajee-fa',
        filledStar: '<i class="fas fa-star"></i>', 
        emptyStar: '<i class="fas fa-star"></i>',
        showClear: false,
        showCaption: false,
        hoverEnabled: false,
    });
    
    $(".capacity-item:first").addClass("active");
    $(".color-item:first").addClass("active");
    
    $(".color-item p").text($(".capacity-item.active p").text());
})

function goToPage(page) {
    var str_param = getUpdatedParam("page", page);
    window.location.href = "index.php?" + str_param;
}

function getUpdatedParam(k, v) {

    var param = new URLSearchParams(window.location.search);
    param.set(k, v);
    var str_param = param.toString();
    return str_param;
}

function deleteProductInCart(product_id) {
    $.ajax({
        type: "GET",
        url: "index.php?c=cart&a=delete",
        data: {product_id: product_id},
        success: function (data) {
            $(".cart-body .cart-body-product").html(data)
            $.ajax({
                type: "GET",
                url: "index.php?c=cart&a=display",
                success: function (data) {
                    var cart = JSON.parse(data);
                    var total_product_number = cart.total_product_number;
                    $(".cart-qty").html(cart.total_product_number);
            }
            });
        }
    });

}

function number_format($number) {
    return new Intl.NumberFormat('en-us').format($number);
}

// function changeImg(e) {
//     var a = $(this);
//     var srcImage = $(e.target).attr("src");
//     if (!$(e.currentTarget).hasClass("active")) {
//         $(".thumbnail").removeClass("active");
//         $(e.currentTarget).addClass("active");
//     };
//     var img = '<img src="' + srcImage + '"></img>'
//     $(".featured-img").html(img);
//     console.log(a);
// }