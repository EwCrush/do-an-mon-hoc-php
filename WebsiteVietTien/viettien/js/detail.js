const replyLabels = document.querySelectorAll(".detail-comments-about-product-reply")
const CommentInput = document.querySelector(".detail-comments-typing-input")
const detailLoginLabel = document.querySelector(".detail-comment-go-to-login")
const EditCommentContainer = document.querySelector(".edit-comment-container")
const detailSoLuong = document.querySelector(".detail-soluong-value")
const detailPrice = document.querySelector('.detail-new-price')
const allCartSoLuong = document.querySelectorAll(".cart-soluong-value")

for(const replyLabel of replyLabels){
    replyLabel.addEventListener('click', function(){
        const replyLabelParent = (this).closest(".detail-comments-about-product-content")
        const replyInput = replyLabelParent.querySelector('.detail-reply-typing-input')
        $('.detail-replies-typing').removeClass('detail-replies-typing-focus');
        const replyInputContainer = replyLabelParent.querySelector('.detail-replies-typing')
        replyInputContainer.classList.add("detail-replies-typing-focus")
        replyInput.focus()
        
    })
}

function ThemBinhLuan(){
    const params = new URLSearchParams(window.location.search)
    const MaSanPham = params.get('detail')
    var CommentInputValue = CommentInput.value
    if(CommentInputValue.trim()==""){
        swal("Vui lòng viết gì đó để bình luận")
    }
    else{
        $.post("./pages/detail/comment.php", {
            "MaSanPham": MaSanPham,
            "NoiDung": CommentInputValue
        }, function(data, status){
            if(data==0){
                swal({
                    text: "Đăng nhập để có thể bình luận, bạn muốn đăng nhập chứ?",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willLogin) => {
                    if (willLogin) {
                        modal.classList.add("modal-active")
                        container.classList.add("bs-auth-form-container-active")
                    } 
                });    
            }
            else{
                location.reload();
            }
        })
    }
    
}

function XoaTraLoi(MaTraLoi){
    swal({
        text: "Bạn muốn xóa phản hồi này chứ",
        buttons: true,
        dangerMode: false,
    })
    .then((willDel) => {
        if (willDel) {
            $.post("./pages/detail/delReply.php", {
                "MaTraLoi": MaTraLoi
            }, function(data, status){
                if(data==1){
                    $("#reply-" + MaTraLoi).slideUp();
                }
            })
        } 
    });
}

function ThemTraLoi(MaBinhLuan){
    var commentInputParent = document.querySelector(`#comment-${MaBinhLuan}`)
        replyInput = commentInputParent.querySelector(".detail-reply-typing-input").value
         
    if(replyInput.trim()==""){
        swal("Vui lòng viết gì đó để phản hồi")
    }
    else{
        $.post("./pages/detail/reply.php", {
            "MaBinhLuan": MaBinhLuan,
            "NoiDung": replyInput,
        }, function(data, status){
            if(data==1){
                location.reload();
            }
            else{
                swal({
                    text: "Đăng nhập để có thể phản hồi, bạn muốn đăng nhập chứ?",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willLogin) => {
                    if (willLogin) {
                        modal.classList.add("modal-active")
                        container.classList.add("bs-auth-form-container-active")
                    } 
                });
            }
        })
        
    }
}

detailLoginLabel.addEventListener("click", function(){
    modal.classList.add("modal-active")
    container.classList.add("bs-auth-form-container-active")
})

function XoaBinhLuan(MaBinhLuan){
    swal({
        text: "Bạn muốn xóa bình luận này chứ",
        buttons: true,
        dangerMode: false,
    })
    .then((willDel) => {
        if (willDel) {
            $.post("./pages/detail/delComment.php", {
                "MaBinhLuan": MaBinhLuan
            },function(data, status){
                if(data==1){
                    $("#comment-" + MaBinhLuan).slideUp();
                }
            })
        } 
    });
}

function ThichBinhLuan(MaBinhLuan){
    const LikeButton = document.querySelector(`#comment-${MaBinhLuan} .detail-comments-about-product-like .detail-comments-about-product-like-icon`)
    $.post("./pages/detail/likeComment.php", {
        "MaBinhLuan": MaBinhLuan,
    }, function(data, status){
        if(data==0){
            swal({
                text: "Đăng nhập để có thể thích, bạn muốn đăng nhập chứ?",
                buttons: true,
                dangerMode: false,
            })
            .then((willLogin) => {
                if (willLogin) {
                    modal.classList.add("modal-active")
                    container.classList.add("bs-auth-form-container-active")
                } 
            });
        }
        else{
            LikeButton.classList.toggle("comment-liked") 
        }
    })
}

function ThichTraLoi(MaTraLoi){
    const LikeButton = document.querySelector(`#reply-${MaTraLoi} .detail-reply-comments-about-product-like .detail-comments-about-product-like-icon`)
    $.post("./pages/detail/likeReply.php", {
        "MaTraLoi": MaTraLoi
    }, function(data, status){
        if(data==0){
            swal({
                text: "Đăng nhập để có thể thích, bạn muốn đăng nhập chứ?",
                buttons: true,
                dangerMode: false,
            })
            .then((willLogin) => {
                if (willLogin) {
                    modal.classList.add("modal-active")
                    container.classList.add("bs-auth-form-container-active")
                } 
            });
        }
        else{
            LikeButton.classList.toggle("comment-liked") 
        }
    })
}

function SuaBinhLuan(MaBinhLuan){
    const CommentNeedToEdit = document.querySelector(`#comment-${MaBinhLuan} .detail-comments-about-product-text`)
          EditCommentInput = document.querySelector(".edit-comment-input")
          EditCommentButton = document.querySelector(".edit-comment-button-edit")
    
    EditCommentButton.href = `Javascript:ThayDoiBinhLuan(${MaBinhLuan})`
    EditCommentInput.value = CommentNeedToEdit.innerText
    modal.classList.add("modal-active")
    EditCommentContainer.classList.add("edit-comment-container-active")
}

function ThayDoiBinhLuan(MaBinhLuan){
    const EditCommentInput = document.querySelector(".edit-comment-input").value
    if(EditCommentInput.trim()== ""){
        swal("Vui lòng viết gì đó!")
    }
    else{
        $.post("./pages/detail/editComment.php", {
            "MaBinhLuan": MaBinhLuan,
            "NoiDung": EditCommentInput
        })
        modal.classList.remove("modal-active");
        EditCommentContainer.classList.remove("edit-comment-container-active")
    }
}

function SuaTraLoi(MaTraLoi){
    const CommentNeedToEdit = document.querySelector(`#reply-${MaTraLoi} .detail-comments-about-product-text`)
          EditCommentInput = document.querySelector(".edit-comment-input")
          EditCommentButton = document.querySelector(".edit-comment-button-edit")
    
    EditCommentButton.href = `Javascript:ThayDoiTraLoi(${MaTraLoi})`
    EditCommentInput.value = CommentNeedToEdit.innerText
    modal.classList.add("modal-active")
    EditCommentContainer.classList.add("edit-comment-container-active")
}

function ThayDoiTraLoi(MaTraLoi){
    const EditCommentInput = document.querySelector(".edit-comment-input").value
    if(EditCommentInput.trim()== ""){
        swal("Vui lòng viết gì đó!")
    }
    else{
        $.post("./pages/detail/editReply.php", {
            "MaTraLoi": MaTraLoi,
            "NoiDung": EditCommentInput
        })
        modal.classList.remove("modal-active");
        EditCommentContainer.classList.remove("edit-comment-container-active")
    }
}


function XoaSanPhamKhoiGioHang(MaSanPham, Size){
    const cartItemContainer = document.querySelector(`#cart-item-${MaSanPham}-${Size}`)
    const SoLuong = cartItemContainer.querySelector(".cart-soluong-value").value
    $(`#cart-item-${MaSanPham}-${Size}`).slideUp();
    $.post("./pages/cart/xoa.php", {
        "MaSanPham": MaSanPham,
        "SoLuong": SoLuong,
        "Size": Size,
    })
}

detailSoLuong.addEventListener("change", function(){
    if(parseInt(detailSoLuong.value)<1){
        detailSoLuong.value = 1;
    }
})

function ThemVaoGioHang(){
    const params = new URLSearchParams(window.location.search)
    const MaSanPham = params.get('detail')
    
    const sizeSelected = document.querySelector('.detail-size-list .detail-size-item.detail-size-item-selected')
    if(sizeSelected==null){
        swal("Sản phẩm này đã hết hàng, vui lòng chọn mua sản phẩm khác!")
    }
    else{
        const Size = sizeSelected.innerText
        const SoLuong = detailSoLuong.value
        const GetPrice = detailPrice.innerText
        $.post("./pages/cart/themvaogiohang.php", {
            "MaSanPham": MaSanPham,
            "SoLuong": SoLuong,
            "Size": Size,
        }, function(data, status){
            if(data==1){
                swal({
                    title: "Success!",
                    text: "Thêm vào giỏ hàng thành công, bạn muốn xem giỏ hàng chứ?",
                    buttons: true,
                    dangerMode: false,
                    icon: "success",
                })
                .then((willLogin) => {
                    if (willLogin) {
                        window.location = "index.php?cart"
                    }
                    else{
                        location.reload();
                    } 
                });
            }
            else if(data==3){
                swal("Sản phẩm này không có size như thế")
            }
            else if(data==4){
                swal("Size này đã hết, vui lòng chọn size khác")
            }
            else{
                modal.classList.add("modal-active")
                container.classList.add("bs-auth-form-container-active")
                //swal(data)
            }
        })
        //console.log(MaNguoiDung, MaSanPham, Price, SoLuong, Size)
    }
}






