function funclick1() {
    var pass = document.getElementById('pass');
    var open = document.getElementById('hide1');
    var close = document.getElementById('hide2');
// console.log('pass');
// console.log(pass);
    if (pass.type ==='password') {
        pass.type = "text";
        open.style.display = "block";
        close.style.display = "none";
    } else {
        pass.type = "password";
        open.style.display = "none";
        close.style.display = "block";
    }
}
function funclick2() {
    var pass = document.getElementById('pass1');
    var open = document.getElementById('hide11');
    var close = document.getElementById('hide22');
console.log('pass');
console.log(pass);
    if (pass.type ==='password') {
        pass.type = "text";
        open.style.display = "block";
        close.style.display = "none";
    } else {
        pass.type = "password";
        open.style.display = "none";
        close.style.display = "block";
    }
}