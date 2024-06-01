<template>
    <div class="wrapper">
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
                        <h4 class="mb-0">EDIT SPONSOR</h4>
                        <hr />
                        <form @submit.prevent="submit(sponsor.id)">
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Nama Sponsor</b></label>
                                <input type="text" class="form-control" v-model="form.name" required>
                            </div>
                            <div>
                                <label class="c-mb5-black"><b>Link</b></label>
                                <div class="col-12">
                                    <textarea class="form-control c-mb10" id="inputProductDescription" rows="2"
                                        v-model="form.link"></textarea>
                                </div>
                            </div>
                            <div>
                                <label for="formFile" class="form-label warna-hitam"><b>Logo</b></label>
                                <input class="form-control" type="file" id="formFile"
                                    @input="form.logo = $event.target.files[0]">
                                <p class="keterangan-foto">Max 2 MB (200 x 200 px)</p>
                            </div>
                            <div class="btn-posisi">
                                <button type="submit" class="btn btn-primary button-tabel-right">Simpan</button>
                                <a class="btn btn-danger button-tabel-left"
                                    onclick="window.location.href='/event/sponsor'">Batal</a>
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
import { useForm, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import Swal from 'sweetalert2';

const props = defineProps({
    errors: Object,
    sponsor: Object,
    settings: Object,
});
const selectedFile = ref(null);
const form = useForm({
    name: props.sponsor.name,
    link: props.sponsor.link,
    logo: null,
})

// function submit(id) {
//     router.post('/event/sponsor/' + id, {
//         _method: 'put',
//         form
//     })
// }

function submit(id) {
    router.post('/event/sponsor/' + id, {
        _method: 'put',
        form
    });
    Swal.fire({
        title: "Kerja Bagus!",
        text: "Perubahan anda berhasil disimpan!",
        icon: "success"
    });
}

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>