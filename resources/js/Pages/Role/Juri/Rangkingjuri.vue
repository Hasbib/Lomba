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
                    <a href="/lomba-juri">
                        <div class="parent-icon"><i class="bx bx-award"></i>
                        </div>
                        <div class="menu-title">Lomba</div>
                    </a>
                </li>
                <li>
                    <a href="/rangking-juri">
                        <div class="parent-icon"><i class="bx bx-trophy"></i>
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
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Ranking Lomba UI / UX</h4>
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width-150">Nama Tim</th>
                                        <th class="crud-width-180">Judul</th>
                                        <th class="crud-width100">File</th>
                                        <th class="crud-width100">Link</th>
                                        <th class="crud-width-150">Instansi</th>
                                        <th class="crud-width-80">Nilai</th>
                                        <th class="crud-width100">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="radius-10 border-start border-0 border-3 border-primary">1</td>
                                        <td>Tim Design</td>
                                        <td>Platform Pendidikan Interaktif</td>
                                        <td></td>
                                        <td></td>
                                        <td>Universitas</td>
                                        <td></td>
                                        <td>Lolos</td>
                                    </tr>
                                    <tr>
                                        <td class="radius-10 border-start border-0 border-3 border-primary">2</td>
                                        <td>Tim Design</td>
                                        <td>Platform Pendidikan Interaktif</td>
                                        <td></td>
                                        <td></td>
                                        <td>Universitas</td>
                                        <td></td>
                                        <td>Lolos</td>
                                    </tr>
                                    <tr>
                                        <td class="radius-10 border-start border-0 border-3 border-primary">3</td>
                                        <td>Tim Design</td>
                                        <td>Platform Pendidikan Interaktif</td>
                                        <td></td>
                                        <td></td>
                                        <td>Universitas</td>
                                        <td></td>
                                        <td>Lolos</td>
                                    </tr>
                                    <tr>
                                        <td class="radius-10 border-start border-0 border-3 border-warning">4</td>
                                        <td>Tim Design</td>
                                        <td>Platform Pendidikan Interaktif</td>
                                        <td></td>
                                        <td></td>
                                        <td>Universitas</td>
                                        <td></td>
                                        <td>Lolos</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=" card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Ranking Lomba AR / VR</h4>
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width-150">Nama Tim</th>
                                        <th class="crud-width-180">Judul</th>
                                        <th class="crud-width100">File</th>
                                        <th class="crud-width100">Link</th>
                                        <th class="crud-width-150">Instansi</th>
                                        <th class="crud-width-80">Nilai</th>
                                        <th class="crud-width100">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="radius-10 border-start border-0 border-3 border-primary">1</td>
                                        <td>Tim Design</td>
                                        <td>Platform Pendidikan Interaktif</td>
                                        <td></td>
                                        <td></td>
                                        <td>Universitas</td>
                                        <td></td>
                                        <td>Lolos</td>
                                    </tr>
                                    <tr>
                                        <td class="radius-10 border-start border-0 border-3 border-primary">2</td>
                                        <td>Tim Design</td>
                                        <td>Platform Pendidikan Interaktif</td>
                                        <td></td>
                                        <td></td>
                                        <td>Universitas</td>
                                        <td></td>
                                        <td>Lolos</td>
                                    </tr>
                                    <tr>
                                        <td class="radius-10 border-start border-0 border-3 border-primary">3</td>
                                        <td>Tim Design</td>
                                        <td>Platform Pendidikan Interaktif</td>
                                        <td></td>
                                        <td></td>
                                        <td>Universitas</td>
                                        <td></td>
                                        <td>Lolos</td>
                                    </tr>
                                    <tr>
                                        <td class="radius-10 border-start border-0 border-3 border-warning">4</td>
                                        <td>Tim Design</td>
                                        <td>Platform Pendidikan Interaktif</td>
                                        <td></td>
                                        <td></td>
                                        <td>Universitas</td>
                                        <td></td>
                                        <td>Lolos</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
    settings: Object,
    lombas: Object
})

function logout() {
    router.post('/logout');
}

const getLombaImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/lomba/${imageName}` : '';
};
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>