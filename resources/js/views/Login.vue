<template>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<div class="page-header">
					<h1 class="display-4">Login</h1>
				</div>
				<div class="py-4">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur corporis deserunt, dolorem eligendi esse eum illo illum inventore libero minus nam numquam officiis praesentium quas quasi repudiandae sed tempore voluptatibus?</p>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
		<form @submit.prevent="login" method="post">
			<div class="form-group">
				<label for="email">Email</label>
				<input
					type="email"
					class="form-control"
					:class="{'is-invalid' : error.email}"
					id="email"
					v-model="form.email"
					autocomplete="off"
					:disabled="loading"
				/>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input
					type="password"
					class="form-control"
					:class="{'is-invalid' : error.password}"
					id="password"
					v-model="form.password"
					:disabled="loading"
				/>
        <div class="invalid-feedback" v-show="error.message">{{ error.message }}</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block" :disabled="loading">
					<span v-show="loading">Logging in</span>
					<span v-show="!loading">Login</span>
				</button>
			</div>
		</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
		data() {
			return {
				loading: false,
				form: {
					email: null,
					password: null
				},
				error: {
					email: null,
          password: null,
          message: null
				}
			};
  },
  methods: {
    login() {
      this.loading = true;
      this.$store
        .dispatch("retrieveToken", {
          username: this.form.email,
          password: this.form.password
        })
        .then(response => {
          this.loading = false;
          this.$router.push({ name: "dashboard" });
        })
        .catch(err => {
						(err.response.data)
							? this.setErrors(err.response.data)
							: this.clearErrors();
						this.loading = false;
        });
    },
    setErrors(error) {
      this.error.email = true;
      this.error.password = true;
      this.error.message = error;
    },
    clearErrors() {
      this.error.email = null;
      this.error.password = null;
    }
  }
};
</script>