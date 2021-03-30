function faqDisplay() {
  let element = document.getElementById("FAQ");
  element.classList.toggle("hidden");
}

function isCaptchaChecked() {
  if (grecaptcha && grecaptcha.getResponse().length !== 0) {
    var submitBtn = document.getElementById("Submit");
    submitBtn.removeAttribute("disabled");
    console.log("button enabled");
  } else {
    console.log("error");
  }
}

function igData() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var igRes = JSON.parse(this.responseText);
      for (i = 0; i < 9; i++) {
        document.getElementById("img" + i).innerHTML =
          "<a href="+ igRes.data[i].permalink +" ><img src=" + igRes.data[i].media_url + " /></a>";
      }
    }
  };
  xhttp.open(
    "GET",
    "https://graph.instagram.com/me/media?fields=id,media_type,media_url,permalink&access_token=IGQVJVaXZAnWVppQV9EaEM1NVpUSFdMZA1J1cXNDYjRTMHhISnZAoQkwyZAkYwUkx5cGJUVFNtZAjhRdUNfNUdWVS10enphSWllT0cydTBlNTNLc05HYmxNQ2VHTmROUFE4ZAmY5eWVFV0dHUDNUbDJJSzgxdwZDZD",
    true
  );
  xhttp.send();
}
