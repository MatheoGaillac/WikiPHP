function showPaysForm(){
    document.getElementById("paysForm").style.display = "block";
    document.getElementById("lieuForm").style.display = "none";
    document.getElementById("gastronomieForm").style.display = "none";
    document.getElementById("transportForm").style.display = "none";
    document.getElementById("allergeneForm").style.display = "none";
}

function showLieuForm(){
    document.getElementById("paysForm").style.display = "none";
    document.getElementById("lieuForm").style.display = "block";
    document.getElementById("gastronomieForm").style.display = "none";
    document.getElementById("transportForm").style.display = "none";
    document.getElementById("allergeneForm").style.display = "none";
}
function showGastronomieForm(){
    document.getElementById("paysForm").style.display = "none";
    document.getElementById("lieuForm").style.display = "none";
    document.getElementById("gastronomieForm").style.display = "block";
    document.getElementById("transportForm").style.display = "none";
    document.getElementById("allergeneForm").style.display = "none";
}
function showTransportsForm(){
    document.getElementById("paysForm").style.display = "none";
    document.getElementById("lieuForm").style.display = "none";
    document.getElementById("gastronomieForm").style.display = "none";
    document.getElementById("transportForm").style.display = "block";
    document.getElementById("allergeneForm").style.display = "none";
}
function showAllergeneForm(){
    document.getElementById("paysForm").style.display = "none";
    document.getElementById("lieuForm").style.display = "none";
    document.getElementById("gastronomieForm").style.display = "none";
    document.getElementById("transportForm").style.display = "none";
    document.getElementById("allergeneForm").style.display = "block";
}