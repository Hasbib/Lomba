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
                        <button class="btn btn-danger crud-width-150 btn-petugas btn-gagal posisi-gag"
                            @click="showPopup">Gagal</button>
                        <div v-if="isPopupVisible" class="popup">
                            <div class="popup-content">
                                <span class="close" @click="hidePopup">&times;</span>
                                <h5>Input Notifikasi</h5>
                                <hr />
                                <div>
                                    <label class="c-mb5-black c-ml20"><b>Deskripsi</b></label>
                                    <div class="col-11">
                                        <textarea v-model="notificationMessage" class="form-control c-mb10 c-ml20"
                                            id="inputProductDescription" rows="3"
                                            placeholder="Tulis Notifikasi"></textarea>
                                    </div>
                                    <button class="btn btn-primary crud-width100 btn-mid c-mt40"
                                        @click="submitFailure">Kirim</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary crud-width-150 btn-petugas btn-verifikasi posisi-ver"
                            @click="verifikasi">Verifikasi</button>
                        <hr class="posisi-hr" />
                        <div class="row">
                            <div class="col-md-3 c-mb10">
                                <label class="c-mb5-black"><b>NAMA TIM</b></label>
                                <div class="c-mb20">{{ form.reg_nama_tim }}</div>
                            </div>
                            <div class="col-md-2">
                                <label class="c-mb5-black"><b>INSTASNSI</b></label>
                                <div class="c-mb20">{{ form.reg_instansi }}</div>
                            </div>
                            <div class="col-md-2">
                                <label class="c-mb5-black"><b>LOMBA</b></label>
                                <div class="c-mb20">{{ form.reg_nama_lomba }}</div>
                            </div>
                            <div class="col-md-3">
                                <label class="c-mb5-black"><b>EMAIL</b></label>
                                <div class="c-mb20">{{ form.reg_email }}</div>
                            </div>
                            <div class="col-md-2">
                                <label class="c-mb5-black"><b>NO WHATSAPP</b></label>
                                <div class="c-mb20">{{ form.reg_no_whatsapp }}</div>
                            </div>
                            <div class="col-md-3">
                                <label class="c-mb5-black"><b>STATUS</b></label>
                                <div class="c-mb20">{{ form.status }}</div>
                            </div>
                            <div class="col-md-3">
                                <label class="c-mb5-black"><b>PEMBAYARAN</b></label>
                                <div class="c-mb20"><a :href="getRegistrasiImageUrl(form.reg_bukti_pembayaaran)">Lihat
                                        Bukti</a></div>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row row-cards justify-content-center">
                            <div v-for="member in teammembers" :key="member.id"
                                class="col-md-6 col-lg-3 crud-max-width260">
                                <div class="card">
                                    <div class="card-header btn-crud">
                                        <h6><b>{{ member.team_member_role }}</b></h6>
                                    </div>
                                    <div class="card-body p-4 text-center posisi-mb23">
                                        <div class="btn-crud">
                                            <img :src="getProfilImageUrl(member.team_member_picture)" height="120"
                                                :alt="member.team_member_name" class="img-fluidc rounded">
                                        </div>
                                        <br>
                                        <h6><b>{{ member.team_member_name }}</b></h6>
                                        <br>
                                        <div class="posisi-mb7">{{ member.team_member_nik }}</div>
                                        <div class="text-muted">{{ member.team_member_instansi }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-height400">
                            <div class="card-body p-4 text-center">
                                <h6 class="sub-judul-tim">PENGUMPULAN KARYA</h6>
                                <div class="row">
                                    <div class="col-md-3 label-left">
                                        <label class="jarak-teks05"><b>JUDUL</b></label>
                                        <div class="c-mb20">{{ form.sub_judul }}</div>
                                    </div>
                                    <div class="col-md-3 label-left">
                                        <label class="jarak-teks05"><b>DESKRIPSI</b></label>
                                        <div class="c-mb20">{{ form.sub_deskripsi }}</div>
                                    </div>
                                    <div class="col-md-3 label-left">
                                        <label class="jarak-teks05"><b>File</b></label>
                                        <div class="c-mb20"><a :href="getRegistrasiImageUrl(form.sub_file)">Lihat
                                                File</a></div>
                                    </div>
                                    <div class="col-md-3 label-left">
                                        <label class="jarak-teks05"><b>LINK VIDEO</b></label>
                                        <div class="data-tim"><a :href="form.sub_link">Link Video</a></div>
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
import { ref } from 'vue';
import axios from 'axios';


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
    status: props.reglomba.status,

    sub_judul: props.submission.sub_judul,
    sub_deskripsi: props.submission.sub_deskripsi,
    sub_link: props.submission.sub_link,
    sub_file: props.submission.sub_file,
})
let isPopupVisible = ref(false);
let notificationMessage = ref('');

const showPopup = () => {
    isPopupVisible.value = true;
};

const hidePopup = () => {
    isPopupVisible.value = false;
};

const verifikasi = () => {
    axios.post(`/tim-petugas/${props.reglomba.id}/verifikasi`, {
        regLombaId: props.reglomba.id,
        verifikasiStatus: 'verified', // or 'on_verified' based on your logic
    }).then(response => {
        if (response.data.isConfirmed) {
            alert('Verifikasi berhasil');
            // Optionally update UI or perform additional actions
        }
    }).catch(error => {
        console.error('Verifikasi failed', error);
        // Handle error scenario if needed
    });
};

const submitFailure = () => {
    axios.post(`/tim-petugas/${props.reglomba.id}/verifikasi`, {
        regLombaId: props.reglomba.id,
        verifikasiStatus: 'not_verified',
        message: notificationMessage.value,
    }).then(response => {
        if (response.data.isConfirmed) {
            alert('Status berhasil diubah menjadi not_verified');
            hidePopup();
        }
    }).catch(error => {
        console.error('Gagal mengubah status', error);
    });
};

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

<script>
export default {
    data() {
        return {
            isPopupVisible: false
        };
    },
    methods: {
        showPopup() {
            this.isPopupVisible = true;
        },
        hidePopup() {
            this.isPopupVisible = false;
        }
    }
}
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