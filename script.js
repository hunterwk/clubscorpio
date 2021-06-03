function faqDisplay() {
  let element = document.getElementById("FAQ");
  element.classList.toggle("hidden");
}

function isCaptchaChecked() {
  if (grecaptcha && grecaptcha.getResponse().length !== 0) {
    var submitBtn = document.getElementById("Submit");
    submitBtn.removeAttribute("disabled");
    submitBtn.classList.add("hover:bg-red-500")
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
    "https://graph.instagram.com/me/media?fields=id,media_type,media_url,permalink&access_token=IGQVJVVExZANDdlVjdrWWx5OG95RVVLVnVtMU1UaS1ESk15dHM2OWh6VnVPTzBKZAFY0Ymh3anl4eUZAxcFE1UFVXWEhoaGFSa1JjWnhJdk40REJEN0NpTGl1WG42aUFUVlQ2YnM2RU9FV1Q0RU1jY3hmagZDZD",
    true
  );
  xhttp.send();
}
