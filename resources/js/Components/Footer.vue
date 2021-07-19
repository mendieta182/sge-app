<template>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2014-{{ currentDate.getFullYear() }} <inertia-link href="#">AdminLTE.io</inertia-link>.</strong> All rights reserved.
    </footer>
</template>

<script>
    export default {
        data(){
            return {
                currentDate: new Date,
            }
        }
    }
</script>
