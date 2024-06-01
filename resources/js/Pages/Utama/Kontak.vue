<template>
    <div class="bg-index">
        <nav class="navbar navbar-expand-lg main_menu">
            <div class="container" v-for="setting in settings">
                <a class="navbar-brand" href="/">
                    <img :src="getSettingImageUrl(setting.logo_1)" :alt="setting.nama_event" class="lg-index">
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
                            <a class="nav-link" href="/#berita-section">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#sponsor-section">Sponsor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Kontak</a>
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

        <section class="tf__breadcrumb" v-for="setting in settings"
            :style="'background: url(' + getSettingImageUrl(setting.logo_2) + ');'">
        </section>

        <section class="tf__contact_page mt_190 xs_mt_95">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 col-xl-7  wow fadeInLeft">
                        <div class="tf__contact_form">
                            <div class="tf__heading_area tf__heading_area_left mb_25">
                                <h5 class="c-mb-13">HUBUNGI KAMI</h5>
                            </div>
                            <div v-if="$page.props.flash.message" class="alert alert-success">
                                {{ $page.props.flash.message }}
                            </div>
                            <form @submit.prevent="submit">
                                <input class="form-control ckontak" type="text" id="nama" v-model="form.nama"
                                    placeholder="Nama" required />
                                <input class="form-control ckontak c-mtkc" type="email" id="email" v-model="form.email"
                                    placeholder="Email" required />
                                <input class="form-control ckontak c-mtkc" type="number" id="nomor" v-model="form.nomor"
                                    placeholder="No. WhatsApp" />
                                <textarea class="c-mtkc" rows="4" v-model="form.pesan" type="textarea"
                                    placeholder="Pesan" required />
                                <button type="submit" class="common_btn_2">Kirim</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-5 col-lg-6 wow fadeInRight">
                        <div class="col-xl-12 wow fadeInUp">
                            <div class="tf__contact_map cmt_30">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3012.4794374146772!2d110.98160354801688!3d-7.591865364294748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a19d07a714fd3%3A0xaea18d5d16dea09d!2sWaduk%20Delingan!5e1!3m2!1sen!2sid!4v1711694566155!5m2!1sen!2sid"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
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
import { ref } from 'vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
    nama: null,
    email: null,
    nomor: null,
    pesan: null,
    status: 'Belum Dibaca'
})

function submit() {
    router.post('/kontak', form)
}

const props = defineProps({
    settings: Object,
    isLoggedIn: Boolean
});

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

const isLoggedIn = ref(props.isLoggedIn);

</script>