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
                        <h4 class="mb-0">DETAIL KRITERIA LOMBA</h4>
                        <hr />
                        <div class="row">
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>NAMA KRITERIA</b></label>
                                <div class="data-tim">{{ form.name }}</div>
                            </div>
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>BOBOT</b></label>
                                <div class="data-tim">{{ form.bobot }}</div>
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <button class="btn btn-danger btn-kembali"
                                onclick="window.location.href='/event/kriteria'">Kembali</button>
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
    kriteria: Object
})

const form = useForm({
    name: props.kriteria.name,
    bobot: props.kriteria.bobot
})
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>