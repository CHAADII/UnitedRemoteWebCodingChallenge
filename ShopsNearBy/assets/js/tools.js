function log() {
    var username = document.getElementById('Email').value;
    var password = document.getElementById('password').value;
    if (username === "" || password === "") {
        showErr("errorlog", '<p>Fill All the fields</p>');
        return false;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        showErr("errorlog", "<span class='fa fa-arrow-circle-up'></span> Sending...");
        if (this.readyState === 4 && this.status === 200) {
            var answer = this.responseText;
            //alert(answer);
            switch (answer) {
                case "true":
                    window.location.replace("index.php");
                    break;
                case "false":
                    showErr("errorlog", "<p>Invalid UserName or Password.</p>");
                    break;
                case "Exception" :
                    showErr("errorlog", "<strong>Fatal Erreur !</strong> System is down, please try again later.");
                    break;
                default :
                    showErr("errorlog", "<strong>System is down</strong><br>" + answer);
                    break;
            }
        }
    };
    var url = "Api/login.php";
    var params = "Email=" + username + "&password=" + password;
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-length", params.length);
    xhttp.setRequestHeader("Connection", "close");
    xhttp.send(params);
}

function showErr(id, msg) {
    var elm = document.getElementById(id);
    elm.innerHTML = msg;
    elm.style.display = "block";
}


function showShops(status) {

    var url = "User/shops.php";
    if (status !== "")
        url = "User/prefShops.php";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        showErr("contents", "<span class='fa fa-clock-o'></span> Loading");
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("contents").innerHTML = this.responseText;
        }
    };

    xhttp.open("POST", url, true);
    xhttp.send();
}

function showShopsWithoutAcceptedones(change) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        showErr("contents", "<span class='fa fa-clock-o'></span> Loading");
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("contents").innerHTML = this.responseText;
        }
    };
    var url = "User/shops.php?acc=1";
    if (change !== "")
        url = "User/shops.php";


    xhttp.open("GET", url, true);
    xhttp.send();
}

function like(id) {
    var token = document.getElementById('token').value;


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        if (this.readyState === 4 && this.status === 200) {
            var answer = this.responseText;
            //alert(answer);
            switch (answer) {
                case "true":
                    showErr("errorlog", "<p>Shop Liked !</p>");
                    break;
                case "false":
                    showErr("errorlog", "<p>Something Went Wrong</p>");
                    break;
                default :
                    showErr("errorlog", "<strong>System is down</strong><br>" + answer);
                    break;
            }
        }
    };
    var url = "Api/app.php?id=" + id + "&REQUEST=like" + "&token=" + token;
    xhttp.open("GET", url, true);
    xhttp.send();

}

function dislike(id) {
    var token = document.getElementById('token').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        if (this.readyState === 4 && this.status === 200) {
            var answer = this.responseText;

            switch (answer) {
                case "true":
                    showErr("errorlog", "<p>Shop Disliked !</p>");
                    break;
                case "false":
                    showErr("errorlog", "<p>Something Went Wrong</p>");
                    break;
                default :
                    showErr("errorlog", "<strong>System is down</strong><br>" + answer);
                    break;
            }
        }
    };
    var url = "Api/app.php?id=" + id + "&REQUEST=dislike" + "&token=" + token;

    xhttp.open("GET", url, true);
    xhttp.send();

}

function remove(id) {
    var token = document.getElementById('token').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        if (this.readyState === 4 && this.status === 200) {
            var answer = this.responseText;

            switch (answer) {
                case "true":
                    showErr("errorlog", "<p>Shop Disliked !</p>");
                    break;
                case "false":
                    showErr("errorlog", "<p>Something Went Wrong</p>");
                    break;
                default :
                    showErr("errorlog", "<strong>System is down</strong><br>" + answer);
                    break;
            }
        }
    };
    var url = "Api/app.php?id=" + id + "&REQUEST=remove" + "&token=" + token;

    xhttp.open("GET", url, true);
    xhttp.send();
}

var lat = null;
var lon = null;
var change = true;

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        change = false;
    }
}

function showPosition(position) {

    if ((this.lat === null || this.lon === null) || (this.lat === position.coords.latitude && this.lon === position.coords.longitude))
        this.change = false;
    else {
        updateLocation(position.coords.latitude, position.coords.longitude)
        this.lat = position.coords.latitude;
        this.lon = position.coords.longitude;
    }

}

function updateLocation(latu, long) {
    var token = document.getElementById('token').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var answer = this.responseText;
            if (answer === "true")
                showErr("errorlog", "Location Updated");
        }
    };
    var url = "Api/app.php?location=" + latu + "," + long + "&REQUEST=updatelocation" + "&token=" + token;

    xhttp.open("GET", url, true);
    xhttp.send();
}

//get location every 5sec
setInterval(function () {
    getLocation();

}, 5000);
