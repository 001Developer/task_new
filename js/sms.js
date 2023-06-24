function sendsmssingle(to,msg)
{
var data = JSON.stringify({
  "from": "Tswana Gas",
  "to": to,
  "text": msg
});

var xhr = new XMLHttpRequest();
xhr.withCredentials = false;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === this.DONE) {
    console.log(this.responseText);
  }
});

xhr.open("POST", "https://api.infobip.com/sms/1/text/single");
xhr.setRequestHeader("authorization", "Basic d2VibG9naWM6V2VibG9naWMxMDg= ");
xhr.setRequestHeader("content-type", "application/json");
xhr.setRequestHeader("accept", "application/json");

xhr.send(data);
}

function sendsmsmultiple(to,msg)
{
var data = JSON.stringify({
  "from": "InfoSMS",
  "to": [ to ],
  "text": msg
});

var xhr = new XMLHttpRequest();
xhr.withCredentials = false;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === this.DONE) {
    console.log(this.responseText);
  }
});

xhr.open("POST", "https://api.infobip.com/sms/1/text/single");
xhr.setRequestHeader("authorization", "Basic d2VibG9naWM6V2VibG9naWMxMDg=");
xhr.setRequestHeader("content-type", "application/json");
xhr.setRequestHeader("accept", "application/json");

xhr.send(data);
}