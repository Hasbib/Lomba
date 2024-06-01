<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div v-for="setting in settings">
                    <a href="/">
                        <img id="logo-img" :src="getImageUrl(setting.logo_1)" :alt="setting.nama_event" class="lg2">
                    </a>
                </div>
                <div id="menu-toggle" class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Berita</h4>
                        <hr class="c-mt10" />
                        <button class="btn btn-success jarak-top-kurang7"
                            onclick="window.location.href='/event/berita/tambah-berita'">Tambah Berita</button>
                        <!-- <div v-if="$page.props.flash.message" class="alert alert-success">
                            {{ $page.props.flash.message }}
                        </div> -->
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <table id="example" class="table mt-3  table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width100">Judul</th>
                                        <th class="crud-width-150">Deskripsi Awal</th>
                                        <th class="crud-width-40">Penerbit</th>
                                        <th class="crud-custom">Tanggal Upload</th>
                                        <th class="crud-width130">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="berita in beritas">
                                        <td>{{ berita.id }}</td>
                                        <td>{{ berita.judul }}</td>
                                        <td>{{ berita.deskripsi_awal }}</td>
                                        <td>{{ berita.penerbit }}</td>
                                        <td>{{ berita.tanggal_upload }}</td>
                                        <td class="btn-crud">
                                            <button class="btn btn-secondary"
                                                @click.prevent="detailberita(berita.id)"><i
                                                    class="bi bi-eye"></i></button>
                                            <button class="btn btn-primary" @click.prevent="editberita(berita.id)"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger" @click.prevent="() => destroy(berita.id)"><i
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
</template>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
    beritas: Object,
    settings: Object,
    unreadCount: Number,
})

function detailberita(id) {
    router.get('/event/berita/' + id + '/detail-berita')
}

// function destroy(id) {
//     router.delete('/event/berita/' + id)
// }

function editberita(id) {
    router.get('/event/berita/' + id + '/edit-berita')
}

function logout() {
    router.post('/logout');
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
            router.delete('/event/berita/' + id)
            Swal.fire(
                "Delete!",
                "File Anda telah dihapus.",
                "success"
            );
        }
    });
}

const getImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

$(document).ready(function () {
    $('#example').DataTable();
});
</script>