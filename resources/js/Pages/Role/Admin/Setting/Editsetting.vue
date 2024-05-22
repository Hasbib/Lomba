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
                                <img :src="getImageUrl(setting.logo_1)" :alt="setting.nama_even">
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
                        <h4 class="mb-0">Edit Event</h4>
                        <hr />
                        <form @submit.prevent="submit(setting.id)">
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Nama Event</b></label>
                                <input type="text" class="form-control" v-model="form.nama_event">
                            </div>
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Judul</b></label>
                                <input type="text" class="form-control" v-model="form.judul">
                            </div>
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Sub Judul</b></label>
                                <input type="text" class="form-control" v-model="form.sub_judul">
                            </div>
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Judul Deskripsi</b></label>
                                <input type="text" class="form-control" v-model="form.judul_deskripsi">
                            </div>
                            <div>
                                <label class="c-mb5-black"><b>Deskripsi</b></label>
                                <div class="col-12">
                                    <textarea class="form-control c-mb10" id="inputProductDescription" rows="4"
                                        v-model="form.deskripsi"></textarea>
                                </div>
                            </div>
                            <div>
                                <label class="form-label warna-hitam"><b>Tanggal Mulai</b></label>
                                <input type="date" class="form-control label-8" v-model="form.tanggal_mulai">
                            </div>
                            <div>
                                <label class="form-label warna-hitam"><b>Tanggal Berakhir</b></label>
                                <input type="date" class="form-control label-8" v-model="form.tanggal_berakhir">
                            </div>
                            <div>
                                <label for="formFile" class="form-label warna-hitam"><b>Logo 1</b></label>
                                <input class="form-control" type="file" id="formFile"
                                    @input="form.logo_1 = $event.target.files[0]">
                                <p class="keterangan-foto">Max 2 MB ( 180 x 55 px )</p>
                            </div>
                            <div>
                                <label for="formFile" class="form-label warna-hitam jarak-top-lebih6"><b>Logo 2
                                        (background)</b></label>
                                <input class="form-control" type="file" id="formFile"
                                    @input="form.logo_2 = $event.target.files[0]">
                                <p class="keterangan-foto">Max 2 MB ( 1200 x 800 px )</p>
                            </div>
                            <div>
                                <label for="formFile" class="form-label warna-hitam jarak-top-lebih6"><b>Logo
                                        3</b></label>
                                <input class="form-control" type="file" id="formFile"
                                    @input="form.logo_3 = $event.target.files[0]">
                                <p class="keterangan-foto">Max 2 MB ( 450 x 450 px )</p>
                            </div>
                            <div class="btn-posisi">
                                <button type="submit" class="btn btn-primary button-tabel-right">Simpan</button>
                                <a class="btn btn-danger button-tabel-left"
                                    onclick="window.location.href='/event/setting'">Batal</a>
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
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue'
import Swal from 'sweetalert2';

const props = defineProps({
    errors: Object,
    setting: Object,
    settings: Object
})

const selectedFile = ref(null)

const form = useForm({
    nama_event: props.setting.nama_event,
    judul: props.setting.judul,
    sub_judul: props.setting.sub_judul,
    judul_deskripsi: props.setting.judul_deskripsi,
    deskripsi: props.setting.deskripsi,
    tanggal_mulai: props.setting.tanggal_mulai,
    tanggal_berakhir: props.setting.tanggal_berakhir,
    logo_1: null,
    logo_2: null,
    logo_3: null,
})

function submit(id) {
    router.post('/event/setting/' + id, {
        _method: 'put',
        form
    });
    Swal.fire({
        title: "Kerja Bagus!",
        text: "Perubahan anda berhasil disimpan!",
        icon: "success"
    });
}

const getImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>