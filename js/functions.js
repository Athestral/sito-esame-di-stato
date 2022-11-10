function userAdmin() {
    if(document.getElementById("user").getAttribute("name") == "email") {
        document.getElementById("user").setAttribute("type", "text");
        document.getElementById("user").setAttribute("placeholder", "username");
        document.getElementById("user").setAttribute("name", "username");
    } else {
        document.getElementById("user").setAttribute("type", "email");
        document.getElementById("user").setAttribute("placeholder", "esempio@gmail.com");
        document.getElementById("user").setAttribute("name", "email");
    }
}
function dataCorrenteInput() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 

    today = yyyy+'-'+mm+'-'+dd;
    document.getElementById("dataSegnalazione").setAttribute("max", today);
}