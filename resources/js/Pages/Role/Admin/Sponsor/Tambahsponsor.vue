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
                        <h4 class="mb-0">TAMBAH SPONSOR</h4>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Nama Sponsor</b></label>
                                <input type="text" class="form-control" v-model="form.name" required>
                            </div>
                            <div>
                                <label class="c-mb5-black"><b>Link</b></label>
                                <div class="col-12">
                                    <textarea class="form-control c-mb10" id="inputProductDescription" rows="2"
                                        v-model="form.link" required></textarea>
                                </div>
                            </div>
                            <div>
                                <label for="formFile" class="form-label warna-hitam"><b>Logo</b></label>
                                <input class="form-control" type="file" id="formFile" v-on:change="onFileChange">
                                <p class="keterangan-foto">Max 2 MB (200 x 200 px)</p>
                            </div>
                            <div class="btn-posisi">
                                <button class="btn btn-primary button-tabel-right" type="submit">Tambah</button>
                                <button class="btn btn-danger button-tabel-left"
                                    onclick="window.location.href='/event/sponsor'">Batal</button>
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
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2';

defineProps({ settings: Object })

const form = reactive({
    name: null,
    link: null,
    logo: null,
})

const selectedFile = ref(null)

function submit() {
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('link', form.link);
    formData.append('logo', selectedFile.value);

    router.post('/event/sponsor', formData);

    Swal.fire({
        title: "Kerja Bagus!",
        text: "Data berhasil ditambahkan!",
        icon: "success"
    });
};

function onFileChange(event) {
    selectedFile.value = event.target.files[0];
}

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>