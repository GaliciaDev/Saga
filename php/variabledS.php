<?php
//guarda y compara variables de sesion para cada tipo de usuario
function verificarS() {   
        session_start();
           if(isset($_SESSION['alumno'])) {
                header("location: ../index_alumno.php");
                }
            }

function verificarSd() {   
        session_start();
           if(isset($_SESSION['docente'])) {
                header("location: ../index_docente.php");
                }
            }

function verificarSad() {
        session_start();
           if(isset($_SESSION['admin'])) {
                header("location: ../index_administrativo.php");
                }
            }

function validarS() {
        session_start();
            if(!isset($_SESSION['alumno'])) {
                echo '
                    <script>
                        alert("Por favor debes iniciar sesion");
                        window.location = "index.php";
                    </script>
                ';
                session_destroy();
                die();
                }    
}

function validarSd() {
        session_start();
            if(!isset($_SESSION['docente'])) {
                echo '
                    <script>
                        alert("Por favor debes iniciar sesion");
                        window.location = "index.php";
                    </script>
                ';
                session_destroy();
                die();
                }    
}

function validarSad() {
        session_start();
            if(!isset($_SESSION['admin'])) {
                echo '
                    <script>
                        alert("Por favor debes iniciar sesion");
                        window.location = "index.php";
                    </script>
                ';
                session_destroy();
                die();
                }    
}

?>
