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
                    <a href="/overview">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Overview</div>
                    </a>
                </li>
                <li>
                    <a href="/profil">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Profil</div>
                    </a>
                </li>
                <li>
                    <a href="/notifikasi">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Notifikasi<span class="alert-count">1</span></div>
                    </a>
                </li>
                <li>
                    <a href="/report">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">Report <span class="alert-count">1</span></div>
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
                <!--breadcrumb-->
                <!--end breadcrumb-->
                <div class="container">
                    <div class="main-body">
                        <div v-if="$page.props.flash.message"
                            :class="$page.props.flash.message.edited ? 'alert alert-success' : 'alert alert-danger'">
                            {{ $page.props.flash.message.info }}
                        </div>
                        <!-- <div v-if="$page.props.flash.message" class="alert alert-success">
                            {{ $page.props.flash.message }}
                        </div> -->
                        <form @submit.prevent="submit(props.user.id)">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <div class="ukuran-foto">
                                                    <img ref="profileImage" :src="getProfilImageUrl(form.images)"
                                                        :alt="user.name" class="rounded-circle p-1 bg-primary"
                                                        width="190" height="150">
                                                </div>
                                                <div>
                                                    <input class="form-control form-control-sm btn-profil2"
                                                        id="formFileSm" type="file" @input="handleFileChange">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card">
                                        <!-- <div class="card-body label-bawah"  v-for="user in users"> -->
                                        <div class="card-body label-bawah">
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0 profil-font15 ">Nama Lengkap</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" v-model="form.name" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Username</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" v-model="form.username"
                                                        readonly />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Email</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" v-model="form.email" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">NIK</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="number" class="form-control" v-model="form.nik"
                                                        maxlength="15" oninput="this.value = this.value.slice(0, 13)" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Prodi</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" v-model="form.prodi" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Kontak</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="number" class="form-control" v-model="form.kontak"
                                                        oninput="this.value = this.value.slice(0,13)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="pperbarui">
                                                <button type="submit"
                                                    class="btn btn-primary  crud-width-435">Perbarui</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
    <!--end switcher-->
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
    errors: Object,
    user: Object,
    settings: Object
});

const form = useForm({
    id: props.user.id,
    name: props.user.name,
    username: props.user.username,
    email: props.user.email,
    nik: props.user.nik,
    prodi: props.user.prodi,
    kontak: props.user.kontak,
    images: props.user.images,
})

const profileImage = ref(null)

function handleFileChange(event) {
    form.images = event.target.files[0]
}

function submit(id) {
    router.post('/profil/' + id, {
        _method: 'put',
        form
    }, {
        onSuccess: () => {
            if (form.images) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    profileImage.value.src = e.target.result;
                };
                reader.readAsDataURL(form.images);
            }
        }
    })
}

// function submit(id) {
//     router.put('/profil/' + id, form)
// }
function logout() {
    router.post('/logout');
}

const getProfilImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/peserta/profil/${imageName}` : '';
};
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>