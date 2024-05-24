<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div v-for="setting in settings">
                    <a href="/">
                        <img :src="getSettingImageUrl(setting.logo_1)" :alt="setting.nama_event" class="logo-icon">
                    </a>
                </div>
                <div class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i>
                </div>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Tim</h4>
                        <hr class="c-mt10" />
                        <button class="btn btn-primary btn-export" id="exportExcel">Export Excel</button>
                        <label class="dropdown-crud">Filter by Status</label>
                        <select class="form-select2">
                            <option selected>Semua</option>
                            <option>Verified</option>
                            <option>Unverified</option>
                        </select>
                        <br><br>
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width-90">Nama Tim</th>
                                        <th class="crud-width-90">Lomba</th>
                                        <th class="crud-width-100">No WhatsApp</th>
                                        <th class="crud-width-120">Email</th>
                                        <th class="crud-width-90">Instansi</th>
                                        <th class="crud-width-60">Status</th>
                                        <th class="crud-width-60">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="reglomba in reglombas">
                                        <td>{{ reglomba.id }}</td>
                                        <td>{{ reglomba.reg_nama_tim }}</td>
                                        <td>{{ reglomba.reg_nama_lomba }}</td>
                                        <td>{{ reglomba.reg_no_whatsapp }}</td>
                                        <td>{{ reglomba.reg_email }}</td>
                                        <td>{{ reglomba.reg_instansi }}</td>
                                        <td>Verified</td>
                                        <td class="btn-crud">
                                            <button class="btn btn-secondary" @click.prevent="detailtim(reglomba.id)"><i
                                                    class="bi bi-eye"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
    settings: Object,
    unreadCount: Number,
    reglombas: Object
})

function detailtim(id) {
    router.get('/tim-petugas/' + id + '/tim-detail')
}


function logout() {
    router.post('/logout');
}

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

$(document).ready(function () {
    var table = $('#example2').DataTable({
        lengthChange: false,
        buttons: ['excel']
    });

    table.buttons().container().appendTo('.export-buttons');

    // Export Excel
    $('#exportExcel').on('click', function () {
        table.buttons('.buttons-excel').trigger();
    });

    // Export PDF
    $('#exportPdf').on('click', function () {
        table.buttons('.buttons-pdf').trigger();
    });
});
</script>