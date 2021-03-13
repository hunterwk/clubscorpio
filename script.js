function faqDisplay () {
   let element = document.getElementById("FAQ");
   element.classList.toggle("hidden");
}

let response = grecaptcha.getResponse(
   opt_widget_id
   )
console.log(response)