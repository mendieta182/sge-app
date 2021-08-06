<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <!--                <li class="nav-item d-none d-sm-inline-block">
                                <a href="../../index3.html" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item d-none d-sm-inline-block">
                                <a href="#" class="nav-link">Contact</a>
                            </li>-->
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img :src="'/storage/img/user2-160x160.jpg'" class="img-size-50 img-circle mr-3" alt="User Image">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img :src="'/storage/img/user2-160x160.jpg'" class="img-size-50 img-circle mr-3" alt="User Image">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <!--                                <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">-->
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <language-selector />
            </div>
<!--            <li class="nav-item dropdown">-->
<!--                <a class="nav-link" data-toggle="dropdown" href="#">-->
<!--                    <img v-if="$page.props.jetstream.managesProfilePhotos" class="rounded-circle img-sm" width="32" height="32" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />-->
<!--                </a>-->
<!--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
<!--                    <span class="dropdown-item dropdown-header">Manage Account</span>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <jet-dropdown-link :href="route('profile.show')">-->
<!--                        <i class="fas fa-user mr-1"></i> Profile-->
<!--                    </jet-dropdown-link>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <form @submit.prevent="logout">-->
<!--                        <jet-dropdown-link as="button">-->
<!--                            <i class="nav-icon fas fa-sign-out-alt text-danger"></i> Logout-->
<!--                        </jet-dropdown-link>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </li>-->

           <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img v-if="$page.props.jetstream.managesProfilePhotos" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" class="user-image img-circle elevation-2">
                    <span class="d-none d-md-inline">{{$page.props.user.role}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <li class="user-header bg-primary">
                        <img v-if="$page.props.jetstream.managesProfilePhotos" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" class="user-image img-circle elevation-2">
                        <p>
                            {{$page.props.user.name}}
                            <small>Member since {{$page.props.user.email}}</small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <jet-dropdown-link :href="route('profile.show')">
                            <i class="fas fa-user mr-1"></i> {{ $page.props.language['Profile']}}
                        </jet-dropdown-link>
                        <form @submit.prevent="logout">
                            <jet-dropdown-link as="button">
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i> {{ $page.props.language['Logout']}}
                            </jet-dropdown-link>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script>
import JetDropdownLink from '@/Jetstream/DropdownLink'
import LanguageSelector from "@/Shared/LanguageSelector";
    export default{
        components:{
            JetDropdownLink,
            LanguageSelector
        },
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
