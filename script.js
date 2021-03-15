function faqDisplay () {
   let element = document.getElementById("FAQ");
   element.classList.toggle("hidden");
}

function submitDisable () {
   let submitBtn = document.getElementById("Submit");
   submitBtn.removeAttribute("disabled");
}