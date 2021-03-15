function faqDisplay () {
   let element = document.getElementById("FAQ");
   element.classList.toggle("hidden");
}

function isCaptchaChecked() {
   return grecaptcha && grecaptcha.getResponse().length !== 0;
 }

function submitDisable () {
   let submitBtn = document.getElementById("Submit");
   submitBtn.removeAttribute("disabled");
}

if (isCaptchaChecked()) {
   submitDisable();
}