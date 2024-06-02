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
                        <h4 class="mb-0">LOMBA {{ form.nama_lomba }}</h4>
                        <hr />
                        <form @submit.prevent="submit()">
                            <!-- <form @submit.prevent="submit(props.reglomba.id)"> -->
                            <div class="row">
                                <div class="col-md-6 c-mb10">
                                    <label class="jarak-input"><b>Nama Tim</b></label>
                                    <input type="text" class="form-control" v-model="form.reg_nama_tim">
                                </div>
                                <div class="col-md-6">
                                    <label class="jarak-input"><b>Instansi</b></label>
                                    <input type="text" class="form-control" v-model="form.reg_instansi">
                                </div>
                                <!-- <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Nama Lomba</b></label>
                                    <div class="col-12">
                                        <select class="form-select" id="inputProductType" v-model="form.reg_nama_lomba">
                                            <option v-for="lomba in lombas" :key="lomba.id" :value="lomba.nama_lomba">
                                                {{ lomba.nama_lomba }}
                                            </option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class=" col-md-6">
                                    <label class="jarak-input"><b>No WhatsApp</b></label>
                                    <input type="number" class="form-control c-mb8" v-model="form.reg_no_whatsapp">
                                </div>
                                <div class="col-md-6">
                                    <label class="jarak-input"><b>Email</b></label>
                                    <input type="email" class="form-control" v-model="form.reg_email">
                                </div>
                                <div class="col-md-6">
                                    <label for="formFile" class="form-label jarak-teks12"><b>Bukti
                                            Pembayaran</b></label>
                                    <input class="form-control" type="file" id="formFile" v-on:change="onFileChange">
                                    <p class="keterangan-foto f-italic">Max file size: 2MB (500 x 500 px)</p>
                                    <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <button type="submit" class="btn btn-primary button-tabel-right">Simpan</button>
                                <button class="btn btn-danger button-tabel-left"
                                    onclick="window.location.href='/daftar-lomba'">Batal</button>
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
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    settings: Object,
    // user: Object,
    reglomba: Object,
    lombas: Object,
    lomba: Object,
    email: String,
    whatsapp: String,
    instansi: String,
    userId: Number
})

const form = useForm({
    reg_nama_tim: props.reglomba?.reg_nama_tim,
    reg_instansi: props.reglomba?.reg_instansi || props.instansi,
    // reg_nama_lomba: props.reglomba?.reg_nama_lomba,
    reg_nama_lomba: props.lombas.length > 0 ? props.lombas[0].nama_lomba : null,
    reg_no_whatsapp: props.reglomba?.reg_no_whatsapp || props.whatsapp,
    reg_email: props.reglomba?.reg_email || props.email,
    reg_bukti_pembayaran: props.reglomba?.reg_bukti_pembayaran,
    reg_peserta_id: props.userId,

    nama_lomba: props.lomba.nama_lomba,
})

const selectedFile = ref(null)

function submit() {
    const formData = new FormData();
    formData.append('id', props.reglomba?.id);
    formData.append('reg_nama_tim', form.reg_nama_tim);
    formData.append('reg_instansi', form.reg_instansi);
    formData.append('reg_nama_lomba', form.reg_nama_lomba);
    formData.append('reg_no_whatsapp', form.reg_no_whatsapp);
    formData.append('reg_email', form.reg_email);
    formData.append('reg_bukti_pembayaran', selectedFile.value);
    formData.append('reg_peserta_id', form.reg_peserta_id);
    formData.append('lomba_id', props.lomba?.id);

    router.post('/daftar-lomba', formData);
    // UPDATE DATA
    //     Swal.fire({
    //         title: "Do you want to save the changes?",
    //         showDenyButton: true,
    //         confirmButtonText: "Save",
    //         denyButtonText: `Don't save`
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             Swal.fire("Saved!", "", "success");
    //         } else if (result.isDenied) {
    //             Swal.fire("Changes are not saved", "", "info");
    //         }
    //     });
}

function onFileChange(event) {
    selectedFile.value = event.target.files[0];
}

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>