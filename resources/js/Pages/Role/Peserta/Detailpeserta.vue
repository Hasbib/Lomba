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
                                    class="logo_icon">
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
        <div class="kotak-putih">
            <div class="page-wrapper-peserta">
                <div class="page-content">
                    <div class="card container-hgnew">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7 label-left" v-for="setting in settings">
                                    <h5 class="judul-detail c-ml-25 c-mt10"><b>{{ setting.nama_event }}</b></h5>
                                    <div class="judul-lomba-index c-ml-25 warna-hitam">
                                        <b>{{ form.nama_lomba }}</b>
                                    </div>
                                </div>
                                <div>
                                    <div class="div-class">
                                        <a class="btn btn-pink c-mtkc" href="#">BUKU
                                            PANDUAN</a>
                                        <a class="btn btn-success c-mtk margin-afkar1 warna-hitam" href="#">AJUKAN
                                            PERTANYAAN</a>
                                        <a class="btn btn-primary c-mtk mg-t10 warna-hitam"
                                            @click.prevent="daftar(lomba.nama_lomba)">DAFTAR
                                            LOMBA</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="des-biru">
            <a v-html="form.deskripsi"></a>
        </div>
        <div class=" des-biru"><br>

        </div>
        <!--end page wrapper -->
    </div>

</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';


const props = defineProps({
    settings: Object,
    lomba: Object
})

function daftar(nama_lomba) {
    router.get('/' + nama_lomba + '/daftar-lomba')
}

const form = useForm({
    nama_lomba: props.lomba.nama_lomba,
    deskripsi: props.lomba.deskripsi
})

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

</script>