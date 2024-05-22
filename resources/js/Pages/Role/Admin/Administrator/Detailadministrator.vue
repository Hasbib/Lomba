<template>
    <div class="wrapper">
        <!--start header -->
        <header>
            <div class="c-topbar">
                <nav class="navbar navbar-expand">
                    <!-- Navbar tambah untuk logo di kiri -->
                    <div class="navbar-tambah">
                        <div class="navbar-left" v-for="setting in settings">
                            <a href="/">
                                <img :src="getSettingImageUrl(setting.logo_1)" :alt="setting.nama_event">
                            </a>
                        </div>
                    </div>
                    <!-- Mobile toggle menu -->
                    <!-- Search bar -->
                    <div class="search-bar flex-grow-1">
                    </div>
                    <!-- Top menu -->
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ $page.props.name }}</p>
                                <p class="user-role">{{ $page.props.username }}</p>
                            </div>
                            <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i>
                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper-new">
            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0">DETAIL ADMINISTRATOR</h4>
                        <hr />
                        <div class="row">
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>Nama Lengkap</b></label>
                                <div class="data-tim">{{ user.name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Username</b></label>
                                <div class="data-tim">{{ user.username }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Password</b></label>
                                <div class="data-tim">**********</div>
                                <!-- {{ '•'.repeat(user.password.length) }} -->
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Email</b></label>
                                <div class="data-tim">{{ user.email }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Role</b></label>
                                <div class="data-tim">{{ user.role }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Lomba</b></label>
                                <div class="data-tim">{{ user.lomba }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Tanggal</b></label>
                                <div class="data-tim">{{ user.created_at }}</div>
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <button class="btn btn-danger btn-kembali"
                                onclick="window.location.href='/event/administrator'">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    user: Object,
    settings: Object,
});


const form = useForm({
    name: props.user.name,
    username: props.user.username,
    // password: props.user.password,
    email: props.user.email,
    role: props.user.role,
    lomba: props.user.lomba,
    created_at: props.user.created_at,
})

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

</script>