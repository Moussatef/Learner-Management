var frm_R = document.getElementById("frm_R");
function check_R(){
    if(frm_R.checked){
        document.getElementById("inp_class").style.display="block";
        document.getElementById("selectA").style.display="none";
    }else{
        document.getElementById("inp_class").style.display="none";
        document.getElementById("selectA").style.display="block";
        
    }
}

document.getElementById("frm_R").addEventListener("click",check_R);
document.getElementById("etd_R").addEventListener("click",check_R);
