var formdata = new FormData();
var url = '';
// var ApiPath = "https://mwila-university.000webhostapp.com/API/API.php?apicall=";
var ApiPath = "http://localhost:3080/web_clientProjects/EWEB-Project/API/API.php?apicall=";


(function ($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

// fetch function
function sendRequest(formdata, url) {
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    var requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };

    return fetch(`${ApiPath + url}`, requestOptions)
        .then(response => response.json())
        .then(result => {
            return result;
        })
        .catch(error => console.log('error', error));
}

//post function
function postRequest(url, form_data, reloadPage) {
    var result;
    $.ajax({
        type: "post",
        url: `${ApiPath + url}`,
        data: form_data,
        contentType: false,
        processData: false,
        cache: false,
        success: function (html) {
            var jsonResult = JSON.parse(html);
            if (!jsonResult.error) {
                //console.log(jsonResult);
                result = jsonResult;
                //  window.location = reloadPage;
            } else {
                alertify.error('Error while making request');
            };
        },
        error: function (x, e) {
            alertify.error('Unknown Error.\n' + x.responseText);
        }
    });
    return result;
}

//get cookie
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "1";
}


function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};




