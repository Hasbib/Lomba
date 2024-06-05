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
                        <h4 class="mb-0">TAMBAH LOMBA</h4>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="row">
                                <div class="col-md-6 c-mb10">
                                    <label class="c-mb5-black"><b>Nama Lomba</b></label>
                                    <input type="text" class="form-control" v-model="form.nama_lomba" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Nama PJ</b></label>
                                    <input type="text" class="form-control label-8" v-model="form.nama_pj" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Deskripsi</b></label>
                                    <div class="col-12">
                                        <textarea class="form-control c-mb10" id="deskripsi" rows="4"
                                            v-model="form.deskripsi" required></textarea>
                                    </div>
                                    <div>
                                        <label for="formFile" class="form-label judul-form"><b>Gambar</b></label>
                                        <input class="form-control" type="file" id="formFile"
                                            v-on:change="onFileChange($event, 'gambar')">
                                        <p class="keterangan-foto">Ukuran 500 x 500</p>
                                    </div>
                                    <div>
                                        <label for="formFile" class="form-label judul-form"><b>Sertifikat</b></label>
                                        <input class="form-control" type="file" id="formFile"
                                            v-on:change="onFileChange($event, 'sertifikat')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Kontak PJ</b></label>
                                    <input type="number" class="form-control label-8" v-model="form.kontak_pj" required>
                                    <div>
                                        <label class="c-mb5-black c-mt5"><b>Tempat</b></label>
                                        <input type="text" class="form-control" v-model="form.tempat" required>
                                    </div>
                                    <div class="c-mt10">
                                        <label class="c-mb5-black"><b>Biaya Pendaftaran</b></label>
                                        <input type="number" class="form-control label-8"
                                            v-model="form.biaya_pendaftaran" required>
                                    </div>
                                    <div>
                                        <label class="role-add"><b class="warna-hitam">Kriteria Lomba</b></label>
                                        <div v-for="kriteria in kriterias" :key="kriteria.id">
                                            <div class="form-check">
                                                <!-- Checkbox untuk setiap kriteria -->
                                                <input class="form-check-input" type="checkbox"
                                                    :id="'kriteria_' + kriteria.id" :value="kriteria.id"
                                                    v-model="form.selectedKriterias" name="selectedKriterias[]">
                                                <!-- Label kriteria -->
                                                <label class="form-check-label" :for="'kriteria_' + kriteria.id">{{
                                                    kriteria.name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-posisi">
                                    <button type="submit" class="btn btn-primary button-tabel-right">Tambah</button>
                                    <a class="btn btn-danger button-tabel-left"
                                        onclick="window.location.href='/event/lomba'">Batal</a>
                                </div>
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
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
    settings: Object,
    kriterias: Object
})

const form = reactive({
    nama_lomba: null,
    deskripsi: null,
    nama_pj: null,
    kontak_pj: null,
    tempat: null,
    biaya_pendaftaran: null,
    gambar: null,
    sertifikat: null,
    selectedKriterias: []
})

const files = reactive({
    gambar: null,
    sertifikat: null
})

function submit() {
    const formData = new FormData();
    formData.append('nama_lomba', form.nama_lomba);
    formData.append('deskripsi', form.deskripsi);
    formData.append('nama_pj', form.nama_pj);
    formData.append('kontak_pj', form.kontak_pj);
    formData.append('tempat', form.tempat);
    formData.append('biaya_pendaftaran', form.biaya_pendaftaran);
    formData.append('gambar', files.gambar);
    formData.append('sertifikat', files.sertifikat);

    form.selectedKriterias.forEach(kriteria => {
        formData.append('selectedKriterias[]', kriteria);
    });

    router.post('/event/lomba', formData);

    Swal.fire({
        title: "Kerja Bagus!",
        text: "Data berhasil ditambahkan!",
        icon: "success"
    });
}

function onFileChange(event, attributeName) {
    files[attributeName] = event.target.files[0];
}

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>