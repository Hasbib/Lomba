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
                                <img :src="getSettingImageUrl(setting.logo_1)" :alt="setting.nama_event"
                                    class="logo-icon">
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
                        <h4 class="mb-0">EDIT KRITERIA LOMBA</h4>
                        <hr />
                        <form @submit.prevent="submit(kriteria.id)">
                            <div class="row">
                                <div class="col-md-6 c-mb10">
                                    <label class="c-mb5-black"><b>Nama Kriteria</b></label>
                                    <input type="namalomba" class="form-control" v-model="form.name" required>
                                </div>
                                <!-- <div class="col-md-6 c-mb10">
                                    <label class="c-mb5-black"><b>Bobot</b></label>
                                    <input type="namalomba" class="form-control" v-model="form.bobot" required>
                                </div> -->
                            </div>
                            <div class="btn-posisi">
                                <button type="submit" class="btn btn-primary button-tabel-right">Simpan</button>
                                <a class="btn btn-danger button-tabel-left"
                                    onclick="window.location.href='/event/kriteria'">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2';

const props = defineProps({
    settings: Object,
    kriteria: Object,
    // bobot: Number,
})

const form = useForm({
    name: props.kriteria.name,
    // bobot: props.bobot
})

function submit(id) {
    router.put('/event/kriteria/' + id, form)

    Swal.fire({
        title: "Kerja Bagus!",
        text: "Perubahan anda berhasil disimpan!",
        icon: "success"
    });
}

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>