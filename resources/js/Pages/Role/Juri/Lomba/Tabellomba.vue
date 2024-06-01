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
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Karya</h4>
                        <hr class="c-mt10" />
                        <label class="jarak-filterstatus">Filter by Status</label>
                        <select class="form-select2">
                            <option selected>Semua</option>
                            <option>Belum Dinilai</option>
                            <option>Sudah Dinilai</option>
                        </select>
                        <br><br>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width120">Nama Tim</th>
                                        <th class="crud-width-150">Judul</th>
                                        <th class="crud-width120">Instansi</th>
                                        <th class="crud-width-50">Status</th>
                                        <th class="crud-width-90">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in data">
                                        <td>{{ item.id }}</td>
                                        <td>{{ item.reg_nama_tim }}</td>
                                        <td>{{ item.sub_judul }}</td>
                                        <td>UNS</td>
                                        <td>Belum Nilai</td>
                                        <td class="btn-crud">
                                            <button class="btn btn-secondary" @click.prevent="detail(item.id)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-primary"
                                                onclick="window.location.href='/lomba-juri/tabel-lomba/edit-nilai'"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <!-- <button class="btn btn-primary"
                                                onclick="window.location.href='/lomba-juri/tabel-lomba/nilai'">Beri
                                                Nilai</button> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
    settings: Object,
    data: Object,
})

function logout() {
    router.post('/logout');
}

function detail(id) {
    router.get('/lomba-juri/tabel-lomba/' + id + '/tim-detail')
}

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
$(document).ready(function () {
    $('#example').DataTable();
});
</script>