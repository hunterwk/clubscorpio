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
    "https://graph.instagram.com/me/media?fields=id,media_type,media_url,permalink&access_token=IGQVJXbXBNbTFLQWpvdmVZAZADlibEdkWUVkcnMwUEZArYy15dm1Vc1pYWkc4T1V4S0tiUmlGV19kVDBnYUwyWkdOVV9ZAeUdxXzdFOE5IclBfWWh6OVVNZAi1uRVNsV3FQYWk3RF8yalBOUkZANWHFfQlNfWAZDZD",
    true
  );
  xhttp.send();
}
