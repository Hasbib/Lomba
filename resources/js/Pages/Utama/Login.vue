<template>

	<body class="body-login">
		<div class="card3 jarakm">
			<div class="card2">
				<div class="card-body">
					<div class="border p-4 rounded">
						<div class="text-center">
							<h4 class="ch4">Login</h4>
							<br><br>
						</div>
						<form class="row g-3" @submit.prevent="submit">
							<div v-if="errors.username" class="text-danger">{{ errors.username }}
							</div>
							<div v-if="$page.props.flash.message" class="alert alert-success">
								{{ $page.props.flash.message }}
							</div>
							<div class="col-12">
								<input type="emailorusername" class="form-control" id="emailorusername"
									placeholder="Masukkan Email atau Username" v-model="form.username" required>
							</div>
							<div class="col-12 c-mlk10">
								<div class="input-group" id="show_hide_password">
									<input type="password" class="form-control border-end-0" v-model="form.password"
										placeholder="Masukkan Password" required> <a href="javascript:;"
										class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
								</div>
							</div>
							<div class="col-md-6 jarak-top-lebih4">
							</div>
							<div class="d-grid jarak-top-lebih10">
								<label class="c-mr-5">Hasil Dari</label>
								<label for="captcha" class="form-label"></label>
								<div class="input-group">
									<input v-model="captchaInput" type="text" class="form-control" id="captcha"
										placeholder="Enter Captcha">
								</div>
							</div>
							<a class="ml240" href="/lupa-password">Lupa password?</a>
							<div class="col-12">
								<div class="d-grid jarak-top-kurang5">
									<button type="submit" class="btn btn-primary w-100"><i
											class='bx bx-lock-open'></i>Masuk</button>
								</div>
								<div class="login-separater text-center mb-4 jarak-top-kurang15">
									<span>ATAU MASUK DENGAN EMAIL</span>
									<hr />
								</div>
								<div class="d-grid jarak-top-kurang4">
									<a class="btn shadow-sm btn-white" href="javascript:;"> <span
											class="d-flex justify-content-center align-items-center">
											<img class="me-2" src="../../../../public/assets/images/icons/search.svg"
												width="16" alt="Image Description">
											<span>Masuk dengan Google</span>
										</span>
									</a>
								</div>
								<div class="text-center jarak-top-kurang10">
									<br>
									<p>Belum punya akun? <a href="/daftar">Daftar disini</a>
									</p>
								</div>
							</div>
						</form>
					</div>
					<!--end row-->
				</div>
			</div>
		</div>
	</body>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2';

defineProps({ errors: Object })

const form = reactive({
	username: null,
	password: null,
})

async function submit() {
	const Toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.onmouseenter = Swal.stopTimer;
			toast.onmouseleave = Swal.resumeTimer;
		}
	});

	const result = await axios.post('/login', form)

	if (result?.data?.login) {

		let nextRoute = ''
		switch (result?.data?.role) {
			case 'admin':
				nextRoute = 'dashboard-admin'
				break;
			case 'petugas':
				nextRoute = 'dashboard-petugas'
				break;
			case 'juri':
				nextRoute = 'dashboard-juri'
				break;
			case 'peserta':
				nextRoute = 'overview'
				break;
			default:
				// nextRoute = '/'
				break;
		}

		router.get(nextRoute)

		Toast.fire({
			icon: "success",
			title: "Login akun berhasil"
		});
	} else {
		Toast.fire({
			icon: "error",
			title: "Login akun gagal"
		});
	}
}


$(document).ready(function () {
	$("#show_hide_password a").on('click', function (event) {
		event.preventDefault();
		if ($('#show_hide_password input').attr("type") == "text") {
			$('#show_hide_password input').attr('type', 'password');
			$('#show_hide_password i').addClass("bx-hide");
			$('#show_hide_password i').removeClass("bx-show");
		} else if ($('#show_hide_password input').attr("type") == "password") {
			$('#show_hide_password input').attr('type', 'text');
			$('#show_hide_password i').removeClass("bx-hide");
			$('#show_hide_password i').addClass("bx-show");
		}
	});
});
</script>