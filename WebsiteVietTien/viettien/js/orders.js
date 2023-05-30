const dangChoXacNhanLabel = document.querySelector('#dangchoxacnhan')
const dangVanChuyenLabel = document.querySelector('#dangvanchuyen')
const daHoanTatLabel = document.querySelector('#dahoantat')
const khacLabel = document.querySelector('#khac')
const dangChoXacNhanTable = document.querySelector(".order-table-dangchoxacnhan")
const dangVanChuyenTable = document.querySelector(".order-table-dangvanchuyen")
const daHoanTatTable = document.querySelector(".order-table-dahoantat")
const khacTable = document.querySelector(".order-table-khac")
// const btnshowAllProductFromOrders = document.querySelectorAll(".order-action-show-product")

dangChoXacNhanLabel.addEventListener("click", function(){
    $('.type-of-order-items.order-label-active').removeClass("order-label-active");
    $('.order-table.order-table-active').removeClass("order-table-active");
    dangChoXacNhanTable.classList.add("order-table-active")
    dangChoXacNhanLabel.classList.add("order-label-active")
})

dangVanChuyenLabel.addEventListener("click", function(){
    $('.order-table.order-table-active').removeClass('order-table-active');
    $('.type-of-order-items.order-label-active').removeClass("order-label-active");
    dangVanChuyenTable.classList.add("order-table-active")
    dangVanChuyenLabel.classList.add("order-label-active")
})

daHoanTatLabel.addEventListener("click", function(){
    $('.order-table.order-table-active').removeClass('order-table-active');
    $('.type-of-order-items.order-label-active').removeClass("order-label-active");
    daHoanTatTable.classList.add("order-table-active")
    daHoanTatLabel.classList.add("order-label-active")
})

khacLabel.addEventListener("click", function(){
    $('.order-table.order-table-active').removeClass('order-table-active');
    $('.type-of-order-items.order-label-active').removeClass("order-label-active");
    khacTable.classList.add("order-table-active")
    khacLabel.classList.add("order-label-active")
})

// for(const btnshowAllProductFromOrder of btnshowAllProductFromOrders){
//     btnshowAllProductFromOrder.addEventListener("click", function(e){
//         e.preventDefault()
//         const tableProduct = (this).closest(".table-row-content")
//         const aa = tableProduct.closest(".tr-product")
//         console.log(tableProduct)
//     })
// }

function ShowAllProduct(MaDonHang){
    const tableHiding = document.querySelector(`.td-product-${MaDonHang}`)
    const tds = document.querySelectorAll(`.td-product`)
    // $('.td-product').add("td-product-hiding")
    for(const td of tds){
        td.classList.add('td-product-hiding')
    }
    
    tableHiding.classList.remove("td-product-hiding")
}

function HuyDonHang(MaDonHang){
    swal({
        text: "Bạn muốn hủy đơn hàng này chứ",
        buttons: true,
        dangerMode: false,
    })
    .then((willDel) => {
        if (willDel) {
            $.post("./pages/orders/huydonhang.php", {
                "MaDonHang": MaDonHang
            }, function(data, status){
                if(data==1){
                    $("#row-order-" + MaDonHang).slideUp();
                }
                else{
                    swal(data)
                }
            })
        } 
    });
}

