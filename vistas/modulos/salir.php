
<?php
    session_start();
    session_destroy();
    echo '<script>
            window.location="' . BASE_URL . 'preguntas";
        </script>';
?>