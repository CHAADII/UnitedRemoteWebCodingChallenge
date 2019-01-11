function showErr(id,msg)
{
    var elm=document.getElementById(id);
    elm.innerHTML="<p class='text-white text-center'>"+msg+"</p>";
    elm.style.display="block";
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateForm()
{
    var elms=document.forms["regform"].getElementsByTagName("input");
    for ( var i=0;i<elms.length;i++)
    {
        elms[i].classList.remove("bg-danger");
        if( i === 2 && elms[i].value==="")
        {
            showErr('errors',"Please Let us Track your Location so we can show you Shops Nearby, You can't Sing up without it");
            return false;
        }
        if ( elms[i].value==="")
        {
            elms[i].classList.add("bg-danger");
            showErr('errors',elms[i].id+" is Empty");
            return false;
        }

        if ( elms[i].value.length < 3)
        {
            showErr('errors',elms[i].id+" must be greater than 3 chars");
            return false;
        }
        if( i===0 && !validateEmail(elms[i].value))
        {

            showErr('errors',"Invalid Email");
            return false;
        }
    }

    return true;
}


function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        document.getElementById("location").value= "";
    }
}

function showPosition(position) {
    document.getElementById("location").value= position.coords.latitude +","+position.coords.longitude;
}