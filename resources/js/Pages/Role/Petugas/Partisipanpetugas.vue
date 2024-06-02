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
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Partisipan</h4>
                        <hr class="c-mt10" />
                        <button class="btn btn-primary btn-float-right" id="exportExcel">Export Excel</button>
                        <label class="jarak-filterstatus">Filter by Status</label>
                        <select class="form-select2" v-model="selectedStatus">
                            <option value="all">Semua</option>
                            <option value="Verified">Verified</option>
                            <option value="Unverified">Unverified</option>
                        </select>
                        <br><br>
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Instansi</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th class="crud-width100">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in filteredUsers" :key="user.id">
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.username }}</td>
                                        <td>{{ user.instansi }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.status }}</td>
                                        <td>{{ user.created_at }}</td>
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
    <!--end wrapper-->
</template>

<script setup>
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';

const selectedStatus = ref('all');

const props = defineProps({
    users: Object,
    settings: Object,
    unreadCount: Number,
});

function logout() {
    router.post('/logout');
}

const filteredUsers = computed(() => {
    if (selectedStatus.value === 'all') {
        return props.users;
    }
    return props.users.filter(user => user.status === selectedStatus.value);
});

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

// $(document).ready(function () {
//     $('#example').DataTable();
// });
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