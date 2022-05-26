<?php 
    namespace foodFinder;

    function getScripts($page) {

        return '
            <script type="module" src="../src/'.$page.'.js"></script>
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
            <script
                id=\'google\'
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxcVTM6J2AoRuhC6guYnS_B4_jAO78ctI&libraries=places"
                defer
                >
            </script>
            <script src="../src/navMenu.js"></script>
        ';
    }

?>