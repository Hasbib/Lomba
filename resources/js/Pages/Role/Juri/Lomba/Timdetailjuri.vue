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
                                <p class="user-name mb-0">{{ $page.props.username }}</p>
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
                        <h4 class="mb-0">DETAIL TIM {{ form.reg_nama_tim }}</h4>
                        <button class="btn btn-primary crud-width-150 btn-petugas btn-verifikasi posisi-ver">Beri
                            Nilai</button>
                        <hr />
                        <hr />
                        <div class="row">
                            <div class="col-md-3 c-mb10">
                                <label class="c-mb5-black"><b>INSTASNSI</b></label>
                                <div class="c-mb20">{{ form.reg_instansi }}</div>
                            </div>
                            <div class="col-md-3">
                                <label class="c-mb5-black"><b>KETUA</b></label>
                                <div class="c-mb20">--------</div>
                            </div>
                            <div class="col-md-3">
                                <label class="c-mb5-black"><b>EMAIL</b></label>
                                <div class="c-mb20">{{ form.reg_email }}</div>
                            </div>
                            <div class="col-md-3">
                                <label class="c-mb5-black"><b>NO WHATSAPP</b></label>
                                <div class="c-mb20">{{ form.reg_no_whatsapp }}</div>
                            </div>
                        </div>
                        <br><br><br>

                        <div class="card card-height400">
                            <div class="card-body p-4 text-center">
                                <h6 class="sub-judul-tim">KARYA TIM</h6>
                                <hr />
                                <div class="row">
                                    <div class="col-md-4 label-left">
                                        <label class="jarak-teks05"><b>JUDUL</b></label>
                                        <div class="c-mb20">{{ form.sub_judul }}</div>
                                    </div>
                                    <div class="col-md-3 label-left">
                                        <label class="jarak-teks05"><b>DOKUMEN</b></label>
                                        <div class="data-tim"><a>Lihat Dokumen</a></div>
                                    </div>
                                    <div class="col-md-3 label-left">
                                        <label class="jarak-teks05"><b>File</b></label>
                                        <div class="c-mb20"><a :href="getRegistrasiImageUrl(form.sub_file)">Lihat
                                                File</a></div>
                                    </div>
                                    <div class="col-md-2 label-left">
                                        <label class="jarak-teks05"><b>LINK</b></label>
                                        <div class="data-tim"><a :href="form.sub_link">Buka Link</a></div>
                                    </div>
                                    <div class="label-left">
                                        <label class="jarak-teks05"><b>DESKRIPSI</b></label>
                                        <div class="c-mb20">{{ form.sub_deskripsi }}</div>
                                    </div>
                                </div>
                            </div>
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
import { router } from '@inertiajs/vue3'

const props = defineProps({
    settings: Object,
    reglomba: Object,
    submission: Object,
    teammembers: Object
})

const form = useForm({
    reg_nama_tim: props.reglomba.reg_nama_tim,
    reg_instansi: props.reglomba.reg_instansi,
    reg_nama_lomba: props.reglomba.reg_nama_lomba,
    reg_email: props.reglomba.reg_email,
    reg_no_whatsapp: props.reglomba.reg_no_whatsapp,
    reg_bukti_pembayaaran: props.reglomba.reg_bukti_pembayaaran,


    sub_judul: props.submission.sub_judul,
    sub_deskripsi: props.submission.sub_deskripsi,
    sub_link: props.submission.sub_link,
    sub_file: props.submission.sub_file,
})

const getRegistrasiImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/peserta/registrasi/${imageName}` : '';
};
const getProfilImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/peserta/profil/${imageName}` : '';
};
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};

</script>
<style scoped>
/* DAFTAR LOMBA EDIT */
.crud-max-width260 {
    /* flex: 1 1 calc(25% - 1rem); */
    display: flex;
    flex-direction: column;
}

.card {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
</style>