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
                        <li class="jarak-dropdown"> <a href="event/lomba">Lomba</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="event/administrator">Administrator</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="event/sponsor">Sponsor</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="event/berita">Berita</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="event/setting">Setting</a>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Pesan</h4>
                        <hr class="c-mt10" />
                        <label class="jarak-filterstatus">Filter by Status</label>
                        <select class="form-select2" v-model="selectedStatus">
                            <option value="all">Semua</option>
                            <option value="Sudah Dibaca">Sudah Dibaca</option>
                            <option value="Belum Dibaca">Belum Dibaca</option>
                        </select>
                        <br><br>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width-250">Nama</th>
                                        <th class="crud-width-50">Email</th>
                                        <th class="crud-width-150">No WhatsApp</th>
                                        <th class="crud-width-350">Pesan</th>
                                        <th class="crud-width-80">Status</th>
                                        <th class="width-id"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pesan in filteredPesan" :key="pesan.id">
                                        <td>{{ pesan.id }}</td>
                                        <td>{{ pesan.nama }}</td>
                                        <td>{{ pesan.email }}</td>
                                        <td>{{ pesan.nomor }}</td>
                                        <td>{{ pesan.pesan }}</td>
                                        <td><label>{{ pesan.status }}</label></td>
                                        <td>
                                            <input type="checkbox" :checked="pesan.status === 'Sudah Dibaca'"
                                                @change="updateStatus(pesan)">
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
    <!--end wrapper-->
</template>

<script setup>
import { ref, computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import axios from 'axios';

const selectedStatus = ref('all');

defineProps({
    pesans: Object,
    settings: Object,
    unreadCount: Number,
})

const { props } = usePage();
const pesans = ref(props.pesans);

const updateStatus = (pesan) => {
    const newStatus = pesan.status === 'Sudah Dibaca' ? 'Belum Dibaca' : 'Sudah Dibaca';
    axios.post(`/pesan/update-status/${pesan.id}`, { status: newStatus })
        .then(response => {
            if (response.data.success) {
                pesan.status = newStatus;
                // Update unread count if needed
                if (newStatus === 'Sudah Dibaca') {
                    props.unreadCount -= 1;
                } else {
                    props.unreadCount += 1;
                }
            }
        });
};

const filteredPesan = computed(() => {
    if (selectedStatus.value === 'all') {
        return pesans.value;
    }
    return pesans.value.filter(pesan => pesan.status === selectedStatus.value);
});

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