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
                                    style="width: 100px; margin-left: -15px;">
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
                        <h4 class="mb-0">EDIT LOMBA</h4>
                        <hr />
                        <form @submit.prevent="submit(lomba.id)">
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
                                            @input="form.gambar = $event.target.files[0]">
                                        <p class="keterangan-foto">Ukuran 500 x 500</p>
                                    </div>
                                    <div>
                                        <label for="formFile" class="form-label judul-form"><b>Sertifikat</b></label>
                                        <input class="form-control" type="file" id="formFile"
                                            @input="form.sertifikat = $event.target.files[0]">
                                        <p class="keterangan-foto">Max 2 MB</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Kontak PJ</b></label>
                                    <input type="number" class="form-control label-8" v-model="form.kontak_pj" required>

                                    <div>
                                        <label class="c-mb5-black"><b>Tempat</b></label>
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
                                                <input class="form-check-input" type="checkbox"
                                                    :id="'kriteria_' + kriteria.id" :value="kriteria.id"
                                                    v-model="form.selectedKriterias">
                                                <label class="form-check-label" :for="'kriteria_' + kriteria.id">{{
                                                    kriteria.name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-posisi">
                                    <button type="submit" class="btn btn-primary button-tabel-right">Simpan</button>
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
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'
import Swal from 'sweetalert2';

const props = defineProps({
    settings: Object,
    lomba: Object,
    kriterias: Object,
    // selectedKriterias: Object
})

const selectedFile = ref(null)

const form = useForm({
    nama_lomba: props.lomba.nama_lomba,
    deskripsi: props.lomba.deskripsi,
    nama_pj: props.lomba.nama_pj,
    kontak_pj: props.lomba.kontak_pj,
    tempat: props.lomba.tempat,
    biaya_pendaftaran: props.lomba.biaya_pendaftaran,
    gambar: null,
    sertifikat: null,
    selectedKriterias: props.lomba.kriterias.map(kriteria => kriteria.id)
})

function submit(id) {
    router.post('/event/lomba/' + id, {
        _method: 'put',
        form
    })
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