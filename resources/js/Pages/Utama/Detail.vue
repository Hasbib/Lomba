<template>
    <div class="bg-index">
        <nav class="navbar navbar-expand-lg main_menu">
            <div class="container">
                <a class="navbar-brand" href="/" v-for="setting in settings">
                    <img :src="getSettingImageUrl(setting.logo_1)" :alt="setting.nama_event" alt="Olinas"
                        class="img-fluid w-100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="far fa-bars menu_icon"></i>
                    <i class="far fa-times close_icon"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#tentang-section">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#lomba-section">Lomba</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#timeline-section">Timeline</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#berita-section">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#sponsor-section">Sponsor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/kontak">Kontak</a>
                        </li>
                        <template v-if="!isLoggedIn">
                            <div class="nav-item">
                                <a href="/login" class="nav-link common_btn">Login</a>
                            </div>
                        </template>
                        <template v-else>
                            <div class="nav-item">
                                <a href="/overview" class="nav-link common_btn">Dashboard</a>
                            </div>
                        </template>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br>
        <section class="tf__event_details mt_195 xs_mt_100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="c-mb50 btn-crud c-mt50"><b>{{ form.judul }}</b></h2>
                        <div class="paragraf-container">
                            <p class="warna-p">Oleh : {{ form.penerbit }}</p>
                            <p class="warna-p p-right c-mb50">Tanggal :{{ form.tanggal_upload }}</p>
                        </div>
                        <div class="tf__event_details_img ">
                            <img :src="getBeritaImageUrl(berita.images)" alt="event details" class="w-100">
                        </div>
                        <div class="tf__event_details_text mt_35 wow fadeInUp">
                            <!-- <ul class="location d-flex flex-wrap c-mt50">
                            <li><i class="fas fa-user"></i> Admin</li>
                            <li><i class="far fa-clock"></i> 12-12-2023</li>
                        </ul> -->
                            <p class="isi-p" v-html="form.deskripsi"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="tf__footer mt_100">
            <div class="text-center p-4 cfooter">
                Copyright ©2024 Tim Website OLINAS
            </div>
        </footer>
    </div>
</template>


<script setup>
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { ref } from 'vue';

const props = defineProps({
    errors: Object,
    berita: Object,
    settings: Object,
    isLoggedIn: Boolean,
});

const isLoggedIn = ref(props.isLoggedIn);

const form = useForm({
    judul: props.berita.judul,
    deskripsi: props.berita.deskripsi,
    penerbit: props.berita.penerbit,
    tanggal_upload: props.berita.tanggal_upload,
    images: props.berita.images,
})

const getBeritaImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/berita/${imageName}` : '';
};
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

</script>