document.body.innerHTML = document.body.innerHTML+"<div id='loading-page' class='notification-loading' align='center' style='display:none;'><div class='normal-box' style='width:25%;'><h2 id='status_text' style='color:#a4a6ad;'> Wait</h2><div id='status_noti' class='loader'></div></div></div>";
//success //warn //load

//<div class='notification-loading' align='center' style='display:block;'><div class='normal-box' style='width:50%;'></div></div>
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function getelembyid(id){
    let result = document.getElementById(id);
    return result;
}

function loader(idbtn,idloader,status,id_status_text,text,mode){
    const btn = getelembyid(idbtn).style.display;
    const loader = getelembyid(idloader).style.display;
    if(loader != "block"){
        getelembyid(id_status_text).innerText = text;
        getelembyid(status).className = mode;
        getelembyid(idbtn).style.display = "none";
        getelembyid(idloader).style.display = "block";
    }else{
        getelembyid(status).className = mode;
        getelembyid(id_status_text).innerText = text;
        sleep(1200).then(() => {
            getelembyid(idloader).style.display = "none";
            getelembyid(status).className = "loader";
            getelembyid(id_status_text).innerText = "";
            getelembyid(idbtn).style.display = "block";
        });
    }
}

    //Navbar Fuction//  loader("btn-loader", "loading-page", "status_noti", "status_text", "Wait", "load");
    function menu(elem) {
        const display = document.getElementById("nav").style.display;
        if (display == "block") {
            document.getElementById("nav").style.display = "none";
        } else {
            document.getElementById("nav").style.display = "block";
        }
    }
    window.addEventListener('resize', function(event) {
        const mq = window.matchMedia("(min-width: 801px)");
        if (mq.matches) {
            document.getElementById("nav").style.display = "block";
        } else {
            document.getElementById("nav").style.display = "none";
        }
    }, true);