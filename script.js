var stylesheet = localStorage.getItem("stylesheet");

function swapStyleSheet(sheet){
    document.getElementById('pagestyle').setAttribute('href', sheet);
    localStorage.setItem('stylesheet', sheet);
}

if(stylesheet) {
    swapStyleSheet(stylesheet)
}
