<span id="totalSecond">5</span>
 
<script language="javascript" type="text/javascript"> 
var second = document.getElementById('totalSecond').textContent; 
 
if (navigator.appName.indexOf("Explorer") > -1)  { 
    second = document.getElementById('totalSecond').innerText; 
} else { 
    second = document.getElementById('totalSecond').textContent; 
} 
 
setInterval("redirect()", 1000); 
function redirect() { 
if (second < 0) { 
    location.href = 'hello.html'; 
} else { 
    if (navigator.appName.indexOf("Explorer") > -1) { 
        document.getElementById('totalSecond').innerText = second--; 
    } else { 
        document.getElementById('totalSecond').textContent = second--; 
    } 
} 
} 
</script>