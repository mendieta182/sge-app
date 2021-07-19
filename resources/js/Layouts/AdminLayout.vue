<template>
    <!--    <div class="dark-mode">
    </div>-->
    <div class="wrapper" style="overflow: auto;">

        <!-- Preloader -->
<!--        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" :src="'/storage/img/AdminLTELogo.png'" alt="AdminLTELogo" height="60" width="60">
        </div>-->
        <!-- /.Preloader -->

        <!-- Navbar -->
        <Navbar />
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <Sidebar />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <slot name="header"></slot>
                        </div>
<!--                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>-->
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <slot></slot>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <Footer />
    </div>
</template>

<script>
import Footer from "@/Components/Footer";
import Navbar from "@/Components/Navbar";
import Sidebar from "@/Components/Sidebar";
export default {
    components: {Sidebar, Navbar, Footer},
    mounted() {
       /* this.init()*/
    },
    methods:{
         /*init(){
             let SELECTOR_LOADER = '.preloader'
             setTimeout(()=>{
                    let $loader = $(SELECTOR_LOADER)
                     if ($loader){
                         $loader.css('height',0)
                         setTimeout(()=>{
                             $loader.children().hide()
                         }, 200)
                     }
             },200)
         }*/
    }
}
</script>
