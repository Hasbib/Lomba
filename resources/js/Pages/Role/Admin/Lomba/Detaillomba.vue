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
                        <h4 class="mb-0">Detail Lomba</h4>
                        <hr />
                        <div class="row">
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>Nama Lomba</b></label>
                                <div class="data-tim">{{ form.nama_lomba }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Nama PJ</b></label>
                                <div class="data-tim">{{ form.nama_pj }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Deskripsi</b></label>
                                <div class="col-12">
                                    <div class="data-tim">{{ form.deskripsi }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Gambar</b></label>
                                    <div class="col-12">
                                        <img :src="getLombaImageUrl(form.gambar)" width="150" />
                                    </div>
                                </div>
                                <div class="col-md-6 jarak-sertifikat">
                                    <label class="c-mb5-black"><b>Sertifikat</b></label>
                                    <div class="col-12">
                                        <img :src="getLombaImageUrl(form.sertifikat)" width="150" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Kontak PJ</b></label>
                                <div class="data-tim">{{ form.kontak_pj }}</div>

                                <label class="c-mb5-black"><b>Tempat</b></label>
                                <div class="data-tim">{{ form.tempat }}</div>

                                <div class="margin-top5-crud">
                                    <label class="c-mb5-black"><b>Biaya Pendaftaran</b></label>
                                    <div class="data-tim">{{ form.biaya_pendaftaran }}</div>
                                </div>
                                <div class="margin-top5-crud">
                                    <label class="c-mb5-black"><b>KRITERIA PENILAIAN</b></label>
                                    <div class="data-tim">
                                        <ul>
                                            <li v-for="kriteria in form.kriterias" :key="kriteria.id">{{ kriteria.name
                                                }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <button class="btn btn-danger btn-kembali"
                                onclick="window.location.href='/event/lomba'">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    settings: Object,
    lomba: Object,
    kriterias: Object
});

const form = useForm({
    nama_lomba: props.lomba.nama_lomba,
    deskripsi: props.lomba.deskripsi,
    nama_pj: props.lomba.nama_pj,
    kontak_pj: props.lomba.kontak_pj,
    tempat: props.lomba.tempat,
    biaya_pendaftaran: props.lomba.biaya_pendaftaran,
    gambar: props.lomba.gambar,
    sertifikat: props.lomba.sertifikat,
    kriterias: props.lomba.kriterias
})

const getLombaImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/lomba/${imageName}` : '';
};
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>