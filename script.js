function faqDisplay () {
   let element = document.getElementById("FAQ");
   element.classList.toggle("hidden");
}

function isCaptchaChecked() {   
   if (grecaptcha && grecaptcha.getResponse().length !== 0) {
      var submitBtn = document.getElementById("Submit");
   submitBtn.removeAttribute("disabled");
   console.log("button enabled")
   } else {
      console.log("error")
   }
 }

// function submitDisable () {
//    var submitBtn = document.getElementById("Submit");
//    submitBtn.removeAttribute("disabled");
//    console.log("button enabled")
// }

