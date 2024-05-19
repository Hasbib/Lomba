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
                                <img :src="getImageUrl(setting.logo_1)" :alt="setting.nama_event" class="logo_icon">
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
                        <div class="row">
                            <div>
                                <label class="jarak-input"><b>Judul</b></label>
                                <input type="email" class="form-control">
                            </div>
                            <div>
                                <label class="jarak-input"><b>Deskripsi</b></label>
                                <div class="col-12">
                                    <textarea class="form-control" id="inputProductDescription" rows="4"
                                        style="margin-bottom: 10px;"></textarea>
                                </div>
                            </div>
                            <div>
                                <label class="jarak-input"><b>Link</b></label>
                                <input type="email" class="form-control" style="margin-bottom: 8px;">
                            </div>
                            <div>
                                <label for="formFile" class="form-label jarak-teks12"><b>File</b></label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>
                        <div style="display: flex;">
                            <button class="btn btn-primary button-tabel-right"
                                onclick="window.location.href='/daftar-lomba'">Simpan</button>
                            <button class="btn btn-danger button-tabel-left"
                                onclick="window.location.href='/daftar-lomba'">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>


<script setup>

defineProps({ settings: Object })

const getImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/${imageName}` : '';
};

</script>