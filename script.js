function faqDisplay () {
   let element = document.getElementById("FAQ");
   element.classList.toggle("hidden");
}

function isCaptchaChecked() {
   console.log(grecaptcha.getResponse());
   return grecaptcha && grecaptcha.getResponse().length !== 0;
 }

function submitDisable () {
   var submitBtn = document.getElementById("Submit");
   submitBtn.removeAttribute("disabled");
   console.log("button enabled")
}

if (isCaptchaChecked()) {
   submitDisable();
}