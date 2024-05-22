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
                    <a href="/dashboard-admin">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-plus-circle"></i>
                        </div>
                        <div class="menu-title">Event</div>
                    </a>
                    <ul>
                        <li class="jarak-dropdown"> <a href="/event/lomba">Lomba</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="/event/administrator">Administrator</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="/event/sponsor">Sponsor</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="/event/berita">Berita</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="/event/setting">Setting</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/tim">
                        <div class="parent-icon"><i class="fadeIn animated lni lni-users"></i>
                        </div>
                        <div class="menu-title">Tim</div>
                    </a>
                </li>
                <li>
                    <a href="/partisipan">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-user-circle c-font25"></i>
                        </div>
                        <div class="menu-title">Partisipan</div>
                    </a>
                </li>
                <li>
                    <a href="/pesan">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">Pesan <span class="alert-count" v-if="unreadCount > 0">{{ unreadCount
                                }}</span></div>
                    </a>
                </li>
                <li>
                    <a href="/rangking">
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
                                <p class="user-name mb-0">{{ $page.props.name }}</p>
                                <p class="user-role">{{ $page.props.username }}</p>
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
                <div v-if="$page.props.flash.message" class="alert alert-success">
                    {{ $page.props.flash.message }}
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Lomba</h4>
                        <hr class="c-mt10" />
                        <a class="btn btn-success jarak-top-kurang7" href="/event/lomba/tambah-lomba">Tambah Lomba</a>
                        <a class="btn btn-info jarak-top-kurang7" href="/event/kriteria">Kriteria</a>
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <table id="example" class="table mt-3  table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th>Nama Lomba</th>
                                        <th>Biaya Pendaftaran</th>
                                        <th>Nama PJ</th>
                                        <th>Kontak PJ</th>
                                        <th class="crud-width-180">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="lomba in lombas">
                                        <td>{{ lomba.id }}</td>
                                        <td>{{ lomba.nama_lomba }}</td>
                                        <td>{{ lomba.biaya_pendaftaran }}</td>
                                        <td>{{ lomba.nama_pj }}</td>
                                        <td>{{ lomba.kontak_pj }}</td>
                                        <td class="btn-crud">
                                            <button class="btn btn-secondary" @click.prevent="detaillomba(lomba.id)"><i
                                                    class="bi bi-eye"></i></button>
                                            <button class="btn btn-primary" @click.prevent="editlomba(lomba.id)"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger" @click.prevent="() => destroy(lomba.id)"><i
                                                    class="bi bi-trash"></i></button>
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
    <!--end wrapper-->
</template>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
    settings: Object,
    lombas: Object,
    errors: Object,
    unreadCount: Number,
})

function detaillomba(id) {
    router.get('/event/lomba/' + id + '/detail-lomba')
}

function editlomba(id) {
    router.get('/event/lomba/' + id + '/edit-lomba')
}

function destroy(id) {
    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!"
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete('/event/lomba/' + id)
            Swal.fire(
                "Delete!",
                "File Anda telah dihapus.",
                "success"
            );
        }
    });
}

function logout() {
    router.post('/logout');
}

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

$(document).ready(function () {
    $('#example').DataTable();
});
</script>