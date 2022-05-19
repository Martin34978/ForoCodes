<?php
require_once('./View/header.php');
?>
<form>
    <h1>Buscador de temas</h1>
    <input type="text" placeholder="Buscar usuario..." onkeyup="searchUsr(this.value)">
</form>
<div id="data">

</div>

<script>
    var i = document.getElementById("data");
    function searchUsr(name){
        var xmlhttp = new XMLHttpRequest();


        if(name.length == ""){
            i.innerHTML = "";
        }else {
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState === 4 && this.status === 200){
                    i.innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "petition.php?sName=" + name, true);
            xmlhttp.send();
        }
    }
</script>
<?php
require_once './View/footer.php';
?>