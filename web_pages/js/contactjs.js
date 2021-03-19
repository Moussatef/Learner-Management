// window.onload = () => {
//     document.querySelector('#btn').disabled = true;
// }


var nom = document.getElementById("Nom");
function verf_Nom() {
 
    if (nom.value.length > 3) {
        return true;
    } else {
        return false;
    }
}

function verf_Tele() {
    var tele = document.getElementById("tele").value;
    var verf = new RegExp("^0[6]([-. ]?[0-9]{2}){4}$");
    return verf.test(tele);
}

function verf_Email() {
    var email = document.getElementById("email").value;
    var verif = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$");
    return verif.test(email);
}
function verf_msg(){
    var msg = document.getElementById("msg").value;
    if(msg.length > 10)
    return true;
    else 
    return false;
}

function color_br1(){
    if (verf_Nom()){
        document.getElementById("Nom").style.borderColor = "#1ad37693";
    }
    else{
        document.getElementById("Nom").style.borderColor = "#ee2c09";
    }
}
document.getElementById("Nom").addEventListener("input",color_br1);
function color_br2(){
    if (verf_Email()){
        document.getElementById("email").style.borderColor = "#1ad37693";
    }
    else{
        document.getElementById("email").style.borderColor = "#ee2c09";
    }
}
document.getElementById("email").addEventListener("input",color_br2);

function color_br3(){
    if (verf_Tele()){
        document.getElementById("tele").style.borderColor = "#1ad37693";
    }
    else{
        document.getElementById("tele").style.borderColor = "#ee2c09";
    }
}
document.getElementById("tele").addEventListener("input",color_br3);
function color_br4(){
    if (verf_msg()){
        document.getElementById("msg").style.borderColor = "#1ad37693";
    }
    else{
        document.getElementById("msg").style.borderColor = "#ee2c09";
    }
}

document.getElementById("msg").addEventListener("input",color_br4);


function chick_inp() {
    var err = "";



    if (verf_Nom()){
        document.getElementById("Nom").style.borderColor = "#1ad37693";
    }
    else{
        document.getElementById("Nom").style.borderColor = "#ee2c09";
        err += "Votre Nom insuffisant \n";
    }
    if (verf_Email())
        document.getElementById("email").style.borderColor = "#1ad37693";
    else{
        document.getElementById("email").style.borderColor = "#ee2c09";
        err += "Votre Email pas correct \n";
    }
    if (verf_Tele())
        document.getElementById("tele").style.borderColor = "#1ad37693";
    else{
        document.getElementById("tele").style.borderColor = "#ee2c09";
        err += "Votre Telephone pas correct \n";
    }
    if (verf_msg())
        document.getElementById("msg").style.borderColor = "#1ad37693";
    else{
        document.getElementById("msg").style.borderColor = "#ee2c09";
        err += "Votre Message insuffisant \n";
    }
    if(err.length>0){
        alert(err+"\n check Inputs");
        document.querySelector('#btn').disabled = true;
    }else{
        // alert("Your name : "+document.getElementById("Nom").value+"\nYour phone is : "+document.getElementById("tele").value+"\nYour Email is : "+document.getElementById("email").value+"\nYour Message is : "+document.getElementById("msg").value);
        document.getElementById("btn").removeAttribute("type");
        document.getElementById("btn").setAttribute("type","submit");
        // document.getElementById("btn").disabled = false;
    }
}

// Array.from(document.querySelectorAll('input')).forEach((input) => {
//     input.addEventListener('keyup', chick_inp)
// })

// Array.from(document.querySelectorAll('textarea')).forEach((input) => {
//     input.addEventListener('keyup', chick_inp)
// })


document.getElementById("btn").addEventListener("click",chick_inp);