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
    "https://graph.instagram.com/me/media?fields=id,media_type,media_url,permalink&access_token=IGQVJVc0hqd0FvRjZAMVnpmSUhCb3FPX1c1VnBBT1FwSlJ1X3l4TDRQQlRTbkpGTjJDUDZACSUZACLXlhTzF4bW02Q2x4Y1psVjFneTg0djV0NmN4RmVIZA2VHaWFWajBkSG16WFd4YTZAxd1pZAbXMtUHEwdAZDZD",
    true
  );
  xhttp.send();
}
