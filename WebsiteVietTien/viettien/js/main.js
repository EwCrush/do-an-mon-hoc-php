// Header

const container = document.querySelector(".bs-auth-form-container")
const pwShowHide = document.querySelectorAll(".showHidePw")
const pwFields = document.querySelectorAll(".bs-auth-form-password")
const signUp = document.querySelector(".signup-link")
const login = document.querySelector(".login-link")
const modal = document.querySelector(".modal")
const signUpLabel = document.querySelector(".signinlabel")
const loginLabel = document.querySelector(".loginlabel")
const modalbody = document.querySelector(".modal__body")
const forgetPasswordLabel = document.querySelector(".bs-auth-form-forgetpassword")
const forgetPasswordContainer = document.querySelector(".forget-password-form-container")
const findAccountSubmit = document.querySelector(".find-account-submit")
const resetPasswordSubmit = document.querySelector(".reset-password-submit")
const backToLoginLabel = document.querySelector(".forgetpassword-login-link")
const changeAddress = document.querySelector(".cart-page-address-shipping-info-shipping-heading-change-info")
const moreDetailAboutAddress = document.querySelector(".more-detail-about-address")
// changeAddressSubmit = document.querySelector(".change-address-form-submit")
// shippingAddress = document.querySelector(".cart-page-address-shipping-info-shipping-address")
const changeAddressContainer = document.querySelector(".change-address-form-container")
const goToUseOldAddress = document.querySelector("#go-to-use-old-address")
const goToUseNewAddress = document.querySelector("#go-to-use-new-address")
const useOldAddressSubmit = document.querySelector(".use-old-address-submit")
const useNewAddressSubmit = document.querySelector(".use-new-address-submit")
const changeAddressNameValue = document.querySelector(".change-address-name-value")
const changeAddressSDTValue = document.querySelector(".change-address-sdt-value")
const ChangePasswordContainer = document.querySelector(".change-password-form-container")
const cpForgetPasswordLink = document.querySelector(".cp-forgetpassword-link")
const cpChangePasswordSubmit = document.querySelector(".cp-change-password-submit")
const cartDatHang = document.querySelector(".cart-page-pay")


signUpLabel.addEventListener("click", function(){
  modal.classList.add("modal-active")
  container.classList.add("active", "bs-auth-form-container-active")
})

loginLabel.addEventListener("click", function(){
  modal.classList.add("modal-active")
  container.classList.add("bs-auth-form-container-active")
})

modal.addEventListener("click", function(){
  modal.classList.remove("modal-active");
  container.classList.remove("active", "bs-auth-form-container-active");
  forgetPasswordContainer.classList.remove("active", "forget-password-form-container-active")
  changeAddressContainer.classList.remove("active", "change-address-form-container-active")
  EditCommentContainer.classList.remove("edit-comment-container-active")
  ChangePasswordContainer.classList.remove("change-password-form-container-active")
})

modalbody.addEventListener("click", function(event){
  event.stopPropagation();
})

//   js code to show/hide password and change icon
pwShowHide.forEach(eyeIcon =>{
  eyeIcon.addEventListener("click", ()=>{
      pwFields.forEach(pwField =>{
          if(pwField.type ==="password"){
              pwField.type = "text";

              pwShowHide.forEach(icon =>{
                  icon.classList.replace("uil-eye-slash", "uil-eye");
              })
          }else{
              pwField.type = "password";

              pwShowHide.forEach(icon =>{
                  icon.classList.replace("uil-eye", "uil-eye-slash");
              })
          }
      }) 
  })
})

// js code to appear signup and login form
signUp.addEventListener("click", ( )=>{
  container.classList.add("active");
});
login.addEventListener("click", ( )=>{
  container.classList.remove("active");
});

//submit event
const loginSubmit = document.querySelector(".loginSubmit")
    signupSubmit = document.querySelector(".signupSubmit")
    remember = document.querySelector("#logCheck")
    signupUsernameValue = document.querySelector(".signup-username-value")
    signupPasswordValue = document.querySelector(".signup-password-value")
    signupFullnameValue = document.querySelector(".signup-name-value")
    signupConfirmValue = document.querySelector(".signup-confirm-value")
    forgetpasswordPasswordValue = document.querySelector(".forgetpassword-password-value")
    forgetpasswordConfirmValue = document.querySelector(".forgetpassword-confirm-value")
    forgetpasswordUsernameValue = document.querySelector(".forgetpassword-username-value")
    forgetpasswordEmailValue = document.querySelector(".forgetpassword-email-value")


loginSubmit.addEventListener("click", function(e){
  e.preventDefault();
  const loginUsername = document.querySelector(".login-username-value").value
        loginPassword = document.querySelector(".login-password-value").value
        isCheck = document.querySelector("#logCheck").checked
  if(loginUsername.trim()=="" || loginPassword.trim()==""){
      swal("Vui lòng nhập đầy đủ thông tin");
  }
  else{
      $.post("./pages/security/login.php", {
          "check": isCheck,
          "username": loginUsername,
          "password": loginPassword
      },
      function(data, status){
            if(data==0){
              swal("Thông tin đăng nhập không tồn tại, vui lòng kiểm tra lại!");
            }
            else if(data==1){
                location.reload();  
            }
            else{
                data = data.replace(/"/g, "");
                swal(`Tài khoản của bạn hiện tại đang bị tạm khóa, bạn không thể đăng nhập cho đến ${data}`);
            }
          }
      );
  }
});

function removeVietnameseTones(str) {
  str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
  str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
  str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
  str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
  str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
  str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
  str = str.replace(/đ/g,"d");
  str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
  str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
  str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
  str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
  str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
  str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
  str = str.replace(/Đ/g, "D");
//   str = str.replace(/[0-9]/g, '');
  // Some system encode vietnamese combining accent as individual utf-8 characters
  // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
  str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
  str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
  // Remove extra spaces
  // Bỏ các khoảng trắng liền nhau
  str = str.replace(/ + /g," ");
  str = str.trim();
  // Remove punctuations
  // Bỏ dấu câu, kí tự đặc biệt
  str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
  str = str.replaceAll(" ", "")
  return str;
}

function removeFullName(str) { 
    str = str.replace(/[0-9]/g, '');
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    return str;
  }



function removeVietnameseTonesForPassword(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g," ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    //str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    str = str.replaceAll(" ", "")
    return str;
  }

signupUsernameValue.addEventListener("change", function(){
  signupUsernameValue.value = removeVietnameseTones(signupUsernameValue.value)
})

signupFullnameValue.addEventListener("change", function(){
    signupFullnameValue.value = removeFullName(signupFullnameValue.value)
  })

signupPasswordValue.addEventListener("change", function(){
  signupPasswordValue.value = removeVietnameseTonesForPassword(signupPasswordValue.value)
})

signupConfirmValue.addEventListener("change", function(){
  signupConfirmValue.value = removeVietnameseTonesForPassword(signupConfirmValue.value)
})

forgetpasswordUsernameValue.addEventListener("change", function(){
    forgetpasswordUsernameValue.value = removeVietnameseTones(forgetpasswordUsernameValue.value)
})

forgetpasswordPasswordValue.addEventListener("change", function(){
    forgetpasswordPasswordValue.value = removeVietnameseTonesForPassword(forgetpasswordPasswordValue.value)
  })
  
forgetpasswordConfirmValue.addEventListener("change", function(){
    forgetpasswordConfirmValue.value = removeVietnameseTonesForPassword(forgetpasswordConfirmValue.value)
  })



signupSubmit.addEventListener("click", function(e){
  e.preventDefault();
  const signupname = document.querySelector(".signup-name-value").value
        signupusername = document.querySelector(".signup-username-value").value
        signupemail = document.querySelector(".signup-email-value").value
        signuppassword = document.querySelector(".signup-password-value").value
        signupconfirm = document.querySelector(".signup-confirm-value").value
        terms = document.querySelector("#termCon")
  // console.log(signupusername, signupemail, signuppassword, signupconfirm)
  if(signupname.trim() == "" || signupusername.trim() == "" || signupemail.trim() == "" || signuppassword.trim() == "" || signupconfirm.trim() == ""){
      swal("Vui lòng nhập đầy đủ thông tin");
  }
  else{
      if(!terms.checked){
          swal("Để trở thành thành viên, trước hết vui lòng hãy chấp nhận mọi điều khoản dịch vụ của chúng tôi!");
      }
      else{
          if (!signupemail.match(/(?:[a-z0-9+!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/gi)) {
              swal("Email không hợp lệ!");
          }
          else{
              if(!signuppassword.match(/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8,})$/)){
                  swal("Mật khẩu phải có độ dài tối thiểu là 8 ký tự, chứa ít nhất 1 số, 1 chữ cái hoa, 1 chữ cái thường và không chứa ký tự đặc biệt!");
              }
              else{
                  if(signuppassword!=signupconfirm){
                      swal("Mật khẩu xác nhận không trùng khớp!");
                  }
                  else{
                      $.post("./pages/security/signup.php", {
                          "fullname": signupname,
                          "username": signupusername,
                          "email": signupemail,
                          "password": signuppassword
                      },
                      function(data, status){
                          if(data==0){
                              swal("Tên tài khoản này đã tồn tại, vui lòng chọn một tên tài khoản khác!");
                          }
                          else{
                              swal({
                                  title: "Success!",
                                  text: "Đăng ký thành công, bạn muốn đăng nhập ngay chứ?",
                                  icon: "success",
                                  buttons: true,
                                  dangerMode: false,
                              })
                              .then((willLogin) => {
                                  if (willLogin) {
                                      container.classList.remove("active");
                                      document.querySelector(".login-username-value").value = ""
                                      document.querySelector(".login-password-value").value = ""
                                      document.querySelector("#logCheck").checked = false
                                  } 
                                  else {
                                      modal.classList.remove("modal-active");
                                      container.classList.remove("active");
                                      document.querySelector(".login-username-value").value = ""
                                      document.querySelector(".login-password-value").value = ""
                                      document.querySelector("#logCheck").checked = false
                                  }
                              });   
                          } 
                      });     
                  }
              }
          }
      }
  }
})

function randomIntFromInterval(min, max) { // min and max included 
    return Math.floor(Math.random() * (max - min + 1) + min)
  }

findAccountSubmit.addEventListener("click", function(e){
    const fpkey = randomIntFromInterval(1000, 9999)
    sessionStorage.setItem('emailKey', fpkey);
    e.preventDefault()
    const forgetPasswordUsername = forgetpasswordUsernameValue.value
          forgetPasswordEmail = forgetpasswordEmailValue.value

        if(forgetPasswordUsername.trim()=="" || forgetPasswordEmail.trim()==""){
        swal("Vui lòng nhập đầy đủ thông tin!")
        }
        else{
        if (!forgetPasswordEmail.match(/(?:[a-z0-9+!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/gi)) {
            swal("Email không hợp lệ!");
        }
        else{
            $.post("./pages/security/findaccount.php", {
                "username": forgetPasswordUsername,
                "email": forgetPasswordEmail,
                "key": fpkey
            },
            function(data, status){
                if(data==0){
                    swal("Thông tin tài khoản không tồn tại, vui lòng kiểm tra lại!");
                }
                else{
                    swal("Enter OTP", {
                        content: "input",
                      })
                      .then((value) => {
                        if(value == fpkey){
                            sessionStorage.setItem('confirmKey', fpkey);
                            forgetPasswordContainer.classList.add("active")
                        }
                        else{
                            swal("Mã xác nhận sai")
                        }
                      });
                    
                }
                // swal(data)
            });
            
            }
        }
})

resetPasswordSubmit.addEventListener("click", function(e){
    e.preventDefault()
    const forgetPasswordUsername = forgetpasswordUsernameValue.value
    const forgetPasswordEmail = forgetpasswordEmailValue.value
    const forgetpasswordPassword = forgetpasswordPasswordValue.value
    const forgetpasswordConfirm = forgetpasswordConfirmValue.value
    const ssConfirmKey =  sessionStorage.getItem("confirmKey");
    const ssEmailKey =  sessionStorage.getItem("emailKey");

    if(forgetPasswordUsername.trim() == "" || forgetPasswordEmail.trim() == "" || ssConfirmKey == "" || ssConfirmKey != ssEmailKey){
        forgetPasswordContainer.classList.remove("active")
    }
    else{
        if(forgetpasswordPassword.trim() == "" || forgetpasswordConfirm.trim() == ""){
            swal ("Vui lòng nhập đầy đủ thông tin!")
        }
        else{
            if(!forgetpasswordPassword.match(/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8,})$/)){
                swal("Mật khẩu phải có độ dài tối thiểu là 8 ký tự, chứa ít nhất 1 số, 1 chữ cái hoa, 1 chữ cái thường và không chứa ký tự đặc biệt!");
            }
            else{
                if(forgetpasswordPassword != forgetpasswordConfirm){
                    swal ("Mật khẩu xác nhận không trùng khớp!")
                }
                else{
                    $.post("./pages/security/resetpassword.php", {
                        "username": forgetPasswordUsername,
                        "email": forgetPasswordEmail,
                        "password": forgetpasswordPassword
                    },
                    function(data, status){
                        if(data==0){
                            forgetPasswordContainer.classList.remove("active")
                        }
                        else{
                            swal({
                                title: "Success!",
                                text: "Đổi mật khẩu thành công, bạn muốn đăng nhập ngay chứ?",
                                icon: "success",
                                buttons: true,
                                dangerMode: false,
                            })
                            .then((willLogin) => {
                                if (willLogin) {
                                    forgetPasswordContainer.classList.remove("forget-password-form-container-active")
                                    container.classList.add("bs-auth-form-container-active")
                                    document.querySelector(".login-username-value").value = ""
                                    document.querySelector(".login-password-value").value = ""
                                    document.querySelector("#logCheck").checked = false
                                } 
                                else {
                                    modal.classList.remove("modal-active");
                                    forgetPasswordContainer.classList.remove("forget-password-form-container-active")
                                    document.querySelector(".login-username-value").value = ""
                                    document.querySelector(".login-password-value").value = ""
                                    document.querySelector("#logCheck").checked = false
                                }
                            }); 
                        }
                    });
                }
            }
        }
    }

    // console.log(ssConfirmKey, ssEmailKey)
})

forgetPasswordLabel.addEventListener("click", function(e){
    e.preventDefault()
    container.classList.remove("bs-auth-form-container-active")
    forgetPasswordContainer.classList.add("forget-password-form-container-active")
})

backToLoginLabel.addEventListener("click", function(e){
    e.preventDefault()
    forgetPasswordContainer.classList.remove("forget-password-form-container-active")
    container.classList.add("bs-auth-form-container-active")
})

// api address

const host = "https://provinces.open-api.vn/api/";
var callAPI = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data, "province");
        });
}
callAPI('https://provinces.open-api.vn/api/?depth=1');
var callApiDistrict = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.districts, "district");
        });
}
var callApiWard = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.wards, "ward");
        });
}

var renderData = (array, select) => {
    let row = ' <option disable value="">Vui lòng chọn</option>';
    array.forEach(element => {
        row += `<option value="${element.code}">${element.name}</option>`
    });
    document.querySelector("#" + select).innerHTML = row
}

$("#province").change(() => {
    callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
    printResult();
});
$("#district").change(() => {
    callApiWard(host + "d/" + $("#district").val() + "?depth=2");
    printResult();
});
$("#ward").change(() => {
    printResult();
})







var printResult = () => {
    if ($("#district").val() != "" && $("#province").val() != "" &&
        $("#ward").val() != "") {
        let result = $("#ward option:selected").text() +
            ", " + $("#district option:selected").text() + ", " +
            $("#province option:selected").text();
    }
}


// }


$(document).ready(function() {
    $('.cart-soluong-tru').click(function () {
        var $input = $(this).parent().find('.cart-soluong-value');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        const curTable = this.closest(".table-content").getAttribute('value')
        const curRow = this.closest(".table-row-content").getAttribute('value')
        const inputValue = $(this).parent().find('.cart-soluong-value').val()
        //console.log(curTable, curRow, inputValue)
        const getTable = this.closest('.table-row-content')
        const getThanhTien = getTable.querySelector('.row-20 .table-info-total-fee-row')
        const getSize = getTable.querySelector('.table-info-product-row-item-size').innerText
        const size = getSize.replace(/Kích cỡ: /g, "")
        $.post("../pages/cart/soluong.php", {
            "madonhang": curTable,
            "masanpham": curRow,
            "soluong": inputValue,
            "size": size,
            "thaotac": "tru"
        }, function(data, status){
            // var this.closest(".table-info-total-fee-row")
            if(data){
                data = data.replace(/"/g, "");
                getThanhTien.innerText = `${data}₫`
            }
        });
        
        //return false;
    });
    $('.cart-soluong-cong').click(function () {
        var $input = $(this).parent().find('.cart-soluong-value');
        var count = parseInt($input.val()) + 1;
        var $soluong = parseInt(this.closest('.cart-soluong-input').getAttribute("value"));
        // var $soluong = 3;
        $input.val(parseInt($input.val()) + 1);
        $count = count > $soluong ? $soluong : count;
        $input.val($count);
        $input.change();
        const curTable = this.closest(".table-content").getAttribute('value')
        const curRow = this.closest(".table-row-content").getAttribute('value')
        var inputValue = $(this).parent().find('.cart-soluong-value').val()
        const getTable = this.closest('.table-row-content')
        const getThanhTien = getTable.querySelector('.row-20 .table-info-total-fee-row')
        const getSize = getTable.querySelector('.table-info-product-row-item-size').innerText
        const size = getSize.replace(/Kích cỡ: /g, "")
        $.post("../pages/cart/soluong.php", {
            "madonhang": curTable,
            "masanpham": curRow,
            "soluong": inputValue,
            "size": size,
            "thaotac": "cong"
        }, function(data, status){
            // var this.closest(".table-info-total-fee-row")
            if(data){
                data = data.replace(/"/g, "");
                getThanhTien.innerText = `${data}₫`
            }
        });
        
        //return false;
    });
});

// table 

changeAddress.addEventListener("click", function(){
    modal.classList.add("modal-active")
    changeAddressContainer.classList.add("change-address-form-container-active")
})

goToUseOldAddress.addEventListener("click", function(e){
    e.preventDefault();
    changeAddressContainer.classList.add("active")
})

goToUseNewAddress.addEventListener("click", function(e){
    e.preventDefault();
    changeAddressContainer.classList.remove("active")
})

function changeAddressSubmit(fullName, numberPhone, address, billID){
    $.post("./pages/cart/changeaddress.php", {
        "fullname": fullName,
        "numberphone": numberPhone,
        "address": address,
        "id": billID
    })
    modal.classList.remove("modal-active")
    changeAddressContainer.classList.remove("active", "change-address-form-container-active")

}

useNewAddressSubmit.addEventListener("click", function(e){
    e.preventDefault();
    var diachicuthe = moreDetailAboutAddress.value;
    var changeAddressName = changeAddressNameValue.value;
    var changeAddressSDT = changeAddressSDTValue.value;
    const billID = changeAddressContainer.getAttribute("value")
    if(changeAddressSDT.length!=10 || (!changeAddressSDT.startsWith("0"))){
        swal("Số điện thoại phải gồm 10 ký tự và bắt đầu là số 0")
    }
    else{
        if ($("#district").val() == "" || $("#province").val() == "" || $("#ward").val() == "" || diachicuthe.trim() == "" || changeAddressSDT.trim()=="" || changeAddressName.trim()==""){
            swal("Vui lòng nhập đầy đủ thông tin")
        }
        else{
            var xaphuong = $("#ward option:selected").text()
            var quanhuyen = $("#district option:selected").text()
            var tinhthanhpho =  $("#province option:selected").text()
            var address = `${diachicuthe}, ${xaphuong}, ${quanhuyen}, ${tinhthanhpho}`
    
            changeAddressSubmit(changeAddressName, changeAddressSDT, address, billID)
        }
    }
    
})

useOldAddressSubmit.addEventListener("click", function(e){
    e.preventDefault();
    const billID = changeAddressContainer.getAttribute("value")
    if($("#old-info-name").val()=="" || $("#old-info-number").val()=="" || $("#old-info-address").val()==""){
        swal("Vui lòng nhập đầy đủ thông tin")
    }
    else{
        const oldNameCA = $("#old-info-name").val()
              oldNumberCA = $("#old-info-number").val()
              oldAddressCA = $("#old-info-address").val()

        changeAddressSubmit(oldNameCA, oldNumberCA, oldAddressCA, billID)
    }
})



function OpenChangePassword(){
    const getOldpassword = document.querySelector(".cp-old-password-value")
    const getNewpassword = document.querySelector(".cp-new-password-value")
    const getConfirmPassword = document.querySelector(".cp-confirm-password-value")

    getOldpassword.addEventListener("change", function(){
        getOldpassword.value = removeVietnameseTonesForPassword(getOldpassword.value)
    })
    getNewpassword.addEventListener("change", function(){
        getNewpassword.value = removeVietnameseTonesForPassword(getNewpassword.value)
    })
    getConfirmPassword.addEventListener("change", function(){
        getConfirmPassword.value = removeVietnameseTonesForPassword(getConfirmPassword.value)
    })

    modal.classList.add("modal-active")
    ChangePasswordContainer.classList.add("change-password-form-container-active")

    cpForgetPasswordLink.addEventListener("click", function(e){
        e.preventDefault()
        ChangePasswordContainer.classList.remove("change-password-form-container-active")
        forgetPasswordContainer.classList.add("forget-password-form-container-active")
    })

    cpChangePasswordSubmit.addEventListener("click", function(e){
        e.preventDefault()
        if(getOldpassword.value=="" || getNewpassword.value=="" || getConfirmPassword.value==""){
            swal("Vui lòng nhập đầy đủ thông tin")
        }
        else{
            if(getNewpassword.value!=getConfirmPassword.value){
                swal("Mật khẩu mới và mật khẩu nhập lại không trùng khớp")
            }
            else{
                if(!getNewpassword.value.match(/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8,})$/)){
                    swal("Mật khẩu phải có độ dài tối thiểu là 8 ký tự, chứa ít nhất 1 số, 1 chữ cái hoa, 1 chữ cái thường và không chứa ký tự đặc biệt!");
                }
                else{
                    $.post("./pages/security/changepassword.php", {
                        "oldPW": getOldpassword.value,
                        "newPW": getNewpassword.value
                    }, function(data, status){
                        if(data==0){
                            swal("Sai mật khẩu")
                        }
                        else{
                            ChangePasswordContainer.classList.remove("change-password-form-container-active")
                            modal.classList.remove("modal-active");
                            swal({
                                title: "Success!",
                                text: "Đổi mật khẩu thành công",
                                icon: "success",
                            })
                        }
                    })
                }
            }
        }
    })
}

function DatHang(){
    const cartDiaChi = document.querySelector(".cart-page-address-shipping-info-shipping-address").innerText
    const cartSDT = document.querySelector(".cart-page-address-shipping-info-shipping-contact").innerText

    if(cartDiaChi.trim()=="" || cartSDT.trim()==""){
        swal("Vui lòng cung cấp số điện thoại và địa chỉ giao hàng")
    }
    else{
        $.post("./pages/cart/dathang.php", function(data, status){
            if(data == 0){
                swal("Giỏ hàng rỗng")
            }
            else{
                location.reload()
            }
        })
    }
}










