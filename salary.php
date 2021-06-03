<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ethereumjs/browser-builds/dist/ethereumjs-tx/ethereumjs-tx-1.3.3.min.js"></script>
<script>
CountDownTimer('11/25/2019', 'countdown'); // 2017년 1월 1일까지

function CountDownTimer(dt, id)
{
var end = new Date(dt);

var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour * 24;
var timer;

function showRemaining() {
var now = new Date();
var distance = end - now;
if (distance < 0) {

clearInterval(timer);
document.getElementById(id).innerHTML = 'EXPIRED!';

return;
}
var days = Math.floor(distance / _day);
var hours = Math.floor((distance % _day) / _hour);
var minutes = Math.floor((distance % _hour) / _minute);
var seconds = Math.floor((distance % _minute) / _second);

document.getElementById(id).innerHTML = days + '일 ';
document.getElementById(id).innerHTML += hours + '시간 ';
document.getElementById(id).innerHTML += minutes + '분 ';
document.getElementById(id).innerHTML += seconds + '초';
}

timer = setInterval(showRemaining, 1000);
}
</script>

<div id="countdown"></div>
