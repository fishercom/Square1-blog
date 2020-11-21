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
					required
					v-model="form.email"
					autocomplete="off"
					:disabled="loading"
				/>
				<div class="invalid-feedback" v-show="error.email">{{ error.email }}</div>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input
					type="password"
					class="form-control"
					:class="{'is-invalid' : error.password}"
					id="password"
					required
					v-model="form.password"
					:disabled="loading"
				/>
				<div class="invalid-feedback" v-show="error.password">{{ error.password }}</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block" :disabled="loading">
					<span v-show="loading">Logging in</span>
					<span v-show="!loading">Login</span>
				</button>
			</div>
            <div>
                <b-alert show variant="danger" v-show="error.message">{{ error.message }}</b-alert>
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
          email: this.form.email,
          password: this.form.password
        })
        .then(response => {
          this.loading = false;
          this.$router.push({ name: "dashboard" });
        })
        .catch(err => {
            this.loading = false;
            if(err.response.data.message){
                this.error.message = err.response.data.message;
            }
            else{
                (err.response.data.errors)
                    ? this.setErrors(err.response.data.errors)
                    : this.clearErrors();
            }
        });
    },
    setErrors(errors) {
        this.error.email = errors.email ? errors.email[0] : null;
        this.error.password = errors.password ? errors.password[0] : null;
    },
    clearErrors() {
      this.error.email = null;
      this.error.password = null;
    }
  }
};
</script>
