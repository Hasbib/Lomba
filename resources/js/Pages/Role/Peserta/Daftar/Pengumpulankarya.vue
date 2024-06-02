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
        <div class="page-wrapper-new">
            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0">PENGUMPULAN KARYA</h4>
                        <hr />
                        <form @submit.prevent="submit()">
                            <div class="row">
                                <div>
                                    <label class="jarak-input"><b>Judul</b></label>
                                    <input type="text" class="form-control" v-model="form.sub_judul">
                                </div>
                                <div>
                                    <label class="jarak-input"><b>Deskripsi</b></label>
                                    <div class="col-12">
                                        <textarea class="form-control c-mb10" id="inputProductDescription" rows="4"
                                            v-model="form.sub_deskripsi"></textarea>
                                    </div>
                                </div>
                                <div>
                                    <label class="jarak-input"><b>Link</b></label>
                                    <input type="text" class="form-control label-8" v-model="form.sub_link">
                                </div>
                                <div>
                                    <label for="formFile" class="form-label jarak-teks12"><b>File</b></label>
                                    <input class="form-control" type="file" id="formFile"
                                        v-on:change="onFileChange($event, 'sub_file')">
                                </div>
                                <div>
                                    <label for="formFile" class="form-label jarak-teks12"><b>Surat</b></label>
                                    <input class="form-control" type="file" id="formFile"
                                        v-on:change="onFileChange($event, 'sub_surat')">
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
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    settings: Object,
    user: Object,
    submission: Object,
    lombas: Object,
    userId: Number
})

const form = useForm({
    sub_judul: props.submission?.sub_judul,
    sub_deskripsi: props.submission?.sub_deskripsi,
    sub_link: props.submission?.sub_link,
    sub_file: props.submission?.sub_file,
    sub_surat: props.submission?.sub_surat,
    sub_peserta_id: props.userId
})

const files = reactive({
    sub_file: null,
    sub_surat: null,
})

function submit() {
    const formData = new FormData();
    formData.append('id', props.submission?.id);
    formData.append('sub_judul', form.sub_judul);
    formData.append('sub_deskripsi', form.sub_deskripsi);
    formData.append('sub_link', form.sub_link);
    formData.append('sub_file', files.sub_file);
    formData.append('sub_surat', files.sub_surat);
    formData.append('sub_peserta_id', form.sub_peserta_id);

    router.post('/pengumpulan-karya', formData);
}

function onFileChange(event, attributeName) {
    files[attributeName] = event.target.files[0];
}
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>