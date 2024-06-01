<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div v-for="setting in settings">
                    <a href="/">
                        <img id="logo-img" :src="getSettingImageUrl(setting.logo_1)" :alt="setting.nama_event"
                            class="lg2">
                    </a>
                </div>
                <div id="menu-toggle" class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="/dashboard-petugas">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="/partisipan-petugas">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-user-circle c-font25"></i>
                        </div>
                        <div class="menu-title">Partisipan</div>
                    </a>
                </li>
                <li>
                    <a href="/tim-petugas">
                        <div class="parent-icon"><i class="fadeIn animated lni lni-users"></i>
                        </div>
                        <div class="menu-title">Tim</div>
                    </a>
                </li>
                <li>
                    <a href="/pesan-petugas">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">Pesan <span class="alert-count" v-if="unreadCount > 0">{{ unreadCount
                                }}</span></div>
                    </a>
                </li>
                <li>
                    <a href="/rangking-petugas">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-trophy"></i>
                        </div>
                        <div class="menu-title">Rangking</div>
                    </a>
                </li>
                <li>
                    <a>
                        <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i> </div>
                        <div>
                            <button @click="logout" class="menu-title">Keluar</button>
                        </div>
                    </a>
                </li>
            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ $page.props.username }}</p>
                            </div>
                            <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i>
                            </div>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-notifications-list">
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-message-list">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="tf__activities_slider_area">
                    <div class="container">
                        <!--breadcrumb-->
                        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                            <div class="col" v-for="lomba in lombas">
                                <div class="card radius-15 card-overview">
                                    <img :src="getLombaImageUrl(lomba.gambar)" :alt="lomba.nama_lomba"
                                        class="border-radius">
                                    <label class="judul-overview">{{ lomba.nama_lomba }}</label>
                                    <button @click.prevent="detail(lomba.id)"
                                        class="btn btn-primary btn-landing-page2">Lihat
                                        Rangking</button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end switcher-->
</template>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
    settings: Object,
    unreadCount: Number,
    lombas: Object
})

function logout() {
    router.post('/logout');
}

function detail(id) {
    router.get('/rangking-petugas/petugas-rangking/' + id)
}


const getLombaImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/lomba/${imageName}` : '';
};
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>