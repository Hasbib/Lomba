<template>
    <!--=================================
       MAIN MENU START
    ==================================-->
    <nav class="navbar navbar-expand-lg main_menu">
        <div class="container" v-for="setting in settings">
            <a class="navbar-brand" href="#">
                <img :src="getSettingImageUrl(setting.logo_1)" :alt="setting.nama_event" class="img-fluid w-100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="far fa-bars menu_icon"></i>
                <i class="far fa-times close_icon"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang-section">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#lomba-section">Lomba</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#timeline-section">Timeline</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#berita-section">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sponsor-section">Sponsor</a>
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
    <!--=================================
       MAIN MENU END
   ==================================-->


    <!--=================================
       BANNER START
   ==================================-->
    <section class="tf__banner" v-for="setting in settings"
        :style="'background: url(' + getSettingImageUrl(setting.logo_2) + ');'">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8">
                    <div class="tf__banner_text wow fadeInUp">
                        <h1 class="cfs-26"><b>{{ setting.judul }}</b></h1>
                        <h1 class="cfs-40"><b>{{ setting.sub_judul }}</b></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
       BANNER END
   ==================================-->
    <br>
    <!--=================================
       ABOUT 2 START
   ==================================-->
    <section id="tentang-section" class="tf__home_2_about pt_100 pb_100"
        style="background: url(bootstrap/images/about_2_bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 wow fadeInLeft">
                    <div class="tf__home_2_about_img" v-for="setting in settings">
                        <img :src="getSettingImageUrl(setting.logo_3)" :alt="setting.nama_event"
                            class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 wow fadeInRight">
                    <div> <!-- <div class="tf__home_2_about_text"-->
                        <div class="tf__heading_area tf__heading_area_left mb_25" v-for="setting in settings">
                            <h5 class="jud">{{ setting.judul_deskripsi }}</h5>
                        </div>
                        <div v-for="setting in settings">
                            <p class="tentang"> {{ setting.deskripsi }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
       ABOUT 2 END
   ==================================-->

    <!--=================================
       CATEGORIES START
   ==================================-->
    <section id="lomba-section" class="tf__categories mt_95">
        <div class="tf__activities_slider_area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-8 col-lg-6 m-auto wow fadeInUp">
                        <div class="tf__heading_area mb_15">
                            <h5 class="judul-lomba-index">Lomba</h5>
                        </div>
                    </div>
                </div>
                <!--breadcrumb-->
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col" v-for="lomba in lombas">
                        <div class="card radius-15 card-overview">
                            <img :src="getLombaImageUrl(lomba.gambar)" :alt="lomba.nama_lomba" class="border-radius">
                            <button class="btn btn-danger btn-landing-page" @click.prevent="detaillomba(lomba.id)">{{
                                lomba.nama_lomba }}</button>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </section>
    <!--=================================
       CATEGORIES END
   ==================================-->
    <section id="timeline-section" class="tf__categories mt_95">
        <div class="container jarak-container">
            <div class="row">
                <div class="col-xl-6 col-md-8 col-lg-6 m-auto wow fadeInUp">
                    <div class="tf__heading_area mb_15">
                        <h5 class="c-mb-40">Timeline</h5>
                        <div class="card container-hg180-index">
                            <div class="card-body p-4 text-center" v-for="setting in settings">
                                <h6 class="h6-landing-page1"><b>{{ setting.nama_event }}</b></h6>
                                <h6 class="h6-landing-page2"><b>Tanggal Mulai : {{ setting.tanggal_mulai }}</b></h6>
                                <h6 class="h6-landing-page2"><b>Tanggal Berakhir : {{ setting.tanggal_berakhir }}</b>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>

    <!--=================================
       EVENT START
    ==================================-->
    <section id="berita-section" class="tf__event mt_95">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-8 col-lg-6 m-auto wow fadeInUp">
                    <div class="tf__heading_area mb_40">
                        <h5>Berita</h5>
                    </div>
                </div>
            </div>
            <div class="row event_slider">
                <div class="col-xl-4 wow fadeInUp" v-for="berita in beritas">
                    <div class="tf__single_event">
                        <button @click.prevent="detail(berita.id)">
                            <div class="tf__single_courses_img">
                                <img :src="getBeritaImageUrl(berita.images)" alt="event" class="img-fluid w-100">
                            </div>
                            <div class="tf__single_event_text">
                                <a class="title">{{ berita.judul }}</a>
                                <p>{{ berita.deskripsi_awal }}</p>
                                <div class="tf__single_event_footer">
                                    <span>{{ berita.tanggal_upload }}</span>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
       EVENT END
   ==================================-->

    <section id="sponsor-section" class="tf__categories mt_95">
        <div class="container">
            <div class="row">
                <div class="tf__heading_area mb_15">
                    <h5> Sponsor</h5>
                    <div class="sponsor-grid">
                        <div v-for="sponsor in sponsors">
                            <a :href="sponsor.link">
                                <img :src="getSponsorImageUrl(sponsor.logo)" :alt="sponsor.name" class="img-fluid">
                                <!-- img 250 -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--=================================
       FOOTER START
   ==================================-->
    <footer class="tf__footer mt_100">
        <div class="text-center p-4 cfooter">
            Copyright ©2024 Tim Website OLINAS
        </div>
    </footer>
    <!--=================================
       FOOTER END
   ==================================-->
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'
const props = defineProps({
    sponsors: Object,
    beritas: Object,
    settings: Object,
    lombas: Object,
    isLoggedIn: Boolean
});

function detaillomba(id) {
    router.get('/detail/' + id)
}

function detail(id) {
    router.get('/berita/' + id + '/detail')
}

// const form = useForm({
//     logo: props.sponsor.logo,
// })
// const getImageUrl = (imageName) => {
//     return imageName ? `/storage/uploads/${imageName}` : '';
// };

const getLombaImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/lomba/${imageName}` : '';
};
const getBeritaImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/berita/${imageName}` : '';
};
const getSponsorImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/sponsor/${imageName}` : '';
};
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

const isLoggedIn = ref(props.isLoggedIn);

</script>