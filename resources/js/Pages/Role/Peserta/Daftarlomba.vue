<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div v-for="setting in settings">
                    <a href="/">
                        <img :src="getSettingImageUrl(setting.logo_1)" :alt="setting.nama_event" class="logo-icon">
                    </a>
                </div>
                <div class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="/overview">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Overview</div>
                    </a>
                </li>
                <li>
                    <a href="/daftar-lomba">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-street-view"></i>
                        </div>
                        <div class="menu-title">Daftar Lomba</div>
                    </a>
                </li>
                <li>
                    <a href="/profil">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Profil</div>
                    </a>
                </li>
                <li>
                    <a href="/notifikasi">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Notifikasi<span class="alert-count">1</span></div>
                    </a>
                </li>
                <li>
                    <a href="/report">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">Report <span class="alert-count">1</span></div>
                    </a>
                </li>
                <li>
                    <a>
                        <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i> </div>
                        <div>
                            <button @click="logout" class="menu-title">Keluar</button>
                        </div>
                    </a>
                </li>
            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ $page.props.name }}</p>
                                <p class="user-role">{{ $page.props.username }}</p>
                            </div>
                            <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i>
                            </div>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-notifications-list">
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-message-list">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div v-if="$page.props.flash.message" class="alert alert-success">
                    {{ $page.props.flash.message }}
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-teks1">Daftar lomba</h4>
                        <div class="card">
                            <h5 class="p-3">Info Tim Lomba</h5>
                            <hr class="garis">
                            <div class="row">
                                <div class="col-md-2 jarak-daftar-lomba">
                                    <label class="c-mb5-black"><b>NAMA TIM</b></label>
                                    <div class="data-tim">{{ form.reg_nama_tim }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba">
                                    <label class="c-mb5-black"><b>INSTANSI</b></label>
                                    <div class="data-tim">{{ form.reg_instansi }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba">
                                    <label class="c-mb5-black"><b>LOMBA</b></label>
                                    <div class="data-tim">{{ form.reg_nama_lomba }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba">
                                    <label class="c-mb5-black"><b>EMAIL</b></label>
                                    <div class="data-tim">{{ form.reg_email }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba">
                                    <label class="c-mb5-black "><b>NO WHATSAPP</b></label>
                                    <div class="data-tim">{{ form.reg_no_whatsapp }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba">
                                    <label class="c-mb5-black"><b>STATUS</b></label>
                                    <div class="data-tim">Verified</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba">
                                    <label class="c-mb5-black"><b>PEMBAYARAN</b></label>
                                    <div class="data-tim c-mb-70"> <a
                                            :href="getRegistrasiImageUrl(form.reg_bukti_pembayaran)">Bukti
                                            Pembayaran</a></div>
                                </div>

                                <div>
                                    <button onclick="window.location.href='/data-tim'"
                                        class="btn btn-primary radius-5 isi-data">Isi Data</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h5 class="p-3">Input Anggota Tim</h5>
                            <div class="row row-cards jarak-data-peserta">
                                <div class="col-md-6 col-lg-3 crud-max-width260">
                                    <div class="card">
                                        <div class="card-header btn-crud">
                                            <h6><b>Ketua</b></h6>
                                        </div>
                                        <div class="card-body p-4 text-center posisi-mb23">
                                            <div class="btn-crud">
                                                <img :src="getProfilImageUrl(form.images)" :alt="user.name"
                                                    class="img-fluidc rounded">
                                            </div>
                                            <br>
                                            <h6><b>{{ form.name }}</b></h6>
                                            <br>
                                            <div class="posisi-mb7">{{ form.nik }}</div>
                                            <div class="text-muted">{{ form.prodi }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 crud-max-width260" v-for="(member, index) in members"
                                    :key="index">
                                    <div class="card position-relative">
                                        <div class="card-header btn-crud">
                                            <h6><b>Anggota {{ index + 1 }}</b></h6>
                                            <button class="btn-close posisi-close" @click="removeMember(index)"
                                                aria-label="Close">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="card-body p-4 text-center posisi-mb23">
                                            <div class="btn-crud">
                                                <img :src="getProfilImageUrl(member.images)" height="120"
                                                    :alt="member.name" class="img-fluidc rounded">
                                            </div>
                                            <br>
                                            <h6><b>{{ member.name }}</b></h6>
                                            <br>
                                            <div class="posisi-mb7">{{ member.nik }}</div>
                                            <div class="text-muted">{{ member.prodi }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 crud-max-width260">
                                    <div class="card">
                                        <div class="card-header btn-crud">
                                            <h6><b>Anggota {{ members.length + 1 }}</b></h6>
                                        </div>
                                        <div class="card-body p-4 text-center posisi-mb23">
                                            <div class="btn-crud">
                                                <button class="btn btn-white btn-putih" @click="showPopup"> +
                                                </button>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <br><br>
                                <button type="submit" @click="saveTeamMembers"
                                    class="btn btn-primary radius-5 isi-data2">Kirim</button>
                            </div>
                        </div>
                        <div v-if="isPopupVisible" class="popup">
                            <div class="popup-content">
                                <span class="close" @click="hidePopup">&times;</span>
                                <h5>Input Anggota Tim</h5>
                                <hr />
                                <div class="position-relative">
                                    <input type="text" class="form-control ps-5" placeholder="Search by name"
                                        v-model="searchQuery">
                                    <span class="position-absolute top-50 product-show-edit translate-middle-y">
                                        <i class="bx bx-search"></i>
                                    </span>
                                </div>
                                <div class="overflow-auto">
                                    <ul v-if="searchResults.length" class="search-results">
                                        <li v-for="user in searchResults" :key="user.id" @click="selectUser(user)"
                                            :class="{ 'selected': user.id === selectedUser?.id }">
                                            <div class="user-item">
                                                <div class="user-info csearch">
                                                    {{ user.name }}<br> {{ user.email }}
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="border-top btn-crud pt-3">
                                    <button type="submit" class="btn-success btn btn-block" @click="addMember">
                                        Tambah anggota
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h5 class="p-3">PENGUMPULAN KARYA</h5>
                            <div class="card-body p-4 text-center">
                                <div class="row">
                                    <div class="col-md-3 text-left">
                                        <label class="jarak-teks05"><b>JUDUL</b></label>
                                        <div class="data-tim">{{ form.sub_judul }}</div>
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <label class="jarak-teks05"><b>DESKRIPSI</b></label>
                                        <div class="data-tim">{{ form.sub_deskripsi }}</div>
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <label class="jarak-teks05"><b>File</b></label>
                                        <div class="data-tim"> <a :href="getRegistrasiImageUrl(form.sub_file)">Lihat
                                                File</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <label class="jarak-teks05"><b>LINK VIDEO</b></label>
                                        <div class="data-tim c-mb-70"><a :href="form.sub_link">Link Video</a></div>
                                    </div>
                                    <div>
                                        <button onclick="window.location.href='/pengumpulan-karya'"
                                            class="btn btn-primary radius-5 isi-data jarak-isi-data">Isi Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-dl">
                            <button @click.prevent="() => save()"
                                class="btn btn-primary radius-5 lebar-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/inertia-vue3';
import { ref, watch, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    settings: Object,
    user: Object,
    members: Object,
    reglomba: Object,
    submission: Object,
    Teammember: Object
})

const form = useForm({
    name: props.user.name,
    nik: props.user.nik,
    prodi: props.user.prodi,
    images: props.user.images,

    reg_nama_tim: props.reglomba ? props.reglomba.reg_nama_tim : null,
    reg_instansi: props.reglomba ? props.reglomba.reg_instansi : null,
    reg_nama_lomba: props.reglomba ? props.reglomba.reg_nama_lomba : null,
    reg_no_whatsapp: props.reglomba ? props.reglomba.reg_no_whatsapp : null,
    reg_email: props.reglomba ? props.reglomba.reg_email : null,
    reg_bukti_pembayaran: props.reglomba ? props.reglomba.reg_bukti_pembayaran : null,
    // reg_peserta_id: props.userId

    sub_judul: props.submission ? props.submission.sub_judul : null,
    sub_deskripsi: props.submission ? props.submission.sub_deskripsi : null,
    sub_link: props.submission ? props.submission.sub_link : null,
    sub_file: props.submission ? props.submission.sub_file : null,
})

function logout() {
    router.post('/logout');
}

const isPopupVisible = ref(false);
const searchQuery = ref('');
const searchResults = ref([]);
const selectedUser = ref(null);
const members = ref(props.members || []);

function showPopup() {
    isPopupVisible.value = true;
}

function hidePopup() {
    isPopupVisible.value = false;
}

watch(searchQuery, (newQuery) => {
    if (newQuery.length > 2) {
        axios.get('/search', { params: { query: newQuery } })
            .then(response => {
                searchResults.value = response.data.map(user => ({
                    ...user,
                    selected: false
                }));
            })
            .catch(error => {
                console.error(error);
            });
    } else {
        searchResults.value = [];
    }
});

function selectUser(user) {
    searchResults.value.forEach(u => u.selected = false);
    user.selected = true;
    selectedUser.value = user;
}

function addMember() {
    if (selectedUser.value) {
        if (members.value.find(member => member.id === selectedUser.value.id)) {
            alert('Member is already in the team.');
            return;
        }

        if (members.value.length >= 4) {
            alert('Maximum number of team members reached.');
            return;
        }

        members.value.push({ ...selectedUser.value });
        selectedUser.value = null;
        hidePopup();
        searchQuery.value = ''; // Clear the search query
        searchResults.value = []; // Clear the search results
        localStorage.setItem('teamMembers', JSON.stringify(members.value));
    }
}
onMounted(() => {
    const storedMembers = localStorage.getItem('teamMembers');
    if (storedMembers) {
        members.value = JSON.parse(storedMembers);
    }
});

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

function saveTeamMembers() {
    const teamData = {
        ketua: {
            name: form.name,
            nik: form.nik,
            prodi: form.prodi,
            images: form.images,
            role: 'Ketua'
        },
        members: members.value.map((member, index) => ({
            name: member.name,
            nik: member.nik,
            prodi: member.prodi,
            images: member.images,
            role: `Anggota ${index + 1}`
        }))
    };

    axios.post('/tambah-member', teamData)
        .then(response => {
            Toast.fire({
                icon: "success",
                title: response.data.message
            });
            // Handle success response
        })
        .catch(error => {
            console.error(error);
            // Handle error response
        });
}


function removeMember(index) {
    members.value.splice(index, 1);
}

function save() {
    Swal.fire({
        title: "Apakah anda yakin untuk mengirim?",
        showDenyButton: true,
        confirmButtonText: "Ya",
        denyButtonText: `Tidak`
    }).then((result) => {
        if (result.isConfirmed) {
            // Lakukan sesuatu jika pengguna ingin menyimpan perubahan
            Swal.fire("Karya anda berhasil dikirim!", "", "success");
        } else if (result.isDenied) {
            // Lakukan sesuatu jika pengguna memilih untuk tidak menyimpan perubahan
            Swal.fire("Karya anda gagal dikirim", "", "info");
        }
    });
}


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

<!-- <script>
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
}</script> -->