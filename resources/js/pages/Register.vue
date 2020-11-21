<template>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<div class="page-header">
					<h1 class="display-4">Register</h1>
				</div>
				<div class="py-4">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur corporis deserunt, dolorem eligendi esse eum illo illum inventore libero minus nam numquam officiis praesentium quas quasi repudiandae sed tempore voluptatibus?</p>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
		<form @submit.prevent="register" method="post">
			<div class="form-group">
				<label for="name">Name</label>
				<input
					type="text"
					class="form-control"
					:class="{'is-invalid' : error.name}"
					id="name"
					required
					v-model="form.name"
					:disabled="loading"
				/>
				<div class="invalid-feedback" v-show="error.name">{{ error.name }}</div>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input
					type="email"
					class="form-control"
					:class="{'is-invalid' : error.email}"
					id="email"
					required
					v-model="form.email"
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
				<label for="password_confirmation">Password Confirmation</label>
				<input
					type="password"
					class="form-control"
					:class="{'is-invalid' : error.password_confirmation}"
					id="password_confirmation"
					required
					v-model="form.password_confirmation"
					:disabled="loading"
				/>
				<div class="invalid-feedback" v-show="error.password_confirmation">{{ error.password_confirmation }}</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block" :disabled="loading">
					<span v-show="loading">Register in</span>
					<span v-show="!loading">Register</span>
				</button>
			</div>
            <div>
                <b-alert show variant="danger" v-show="error.message">{{ error.message }}</b-alert>
                <b-alert show variant="success" v-show="success"> Thank you for registering, please
                    <router-link :to="{name: 'login'}">
						login to continue
					</router-link>
                </b-alert>
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
            name: null,
            email: null,
            password: null,
            password_confirmation: null
        },
        error: {
            message: null,
            name: null,
            email: null,
            password: null,
            password_confirmation: null
        },
        success: false
    };
  },
  methods: {
    register() {
      this.loading = true;
      this.$store
        .dispatch("registerUser", {
          name: this.form.name,
          email: this.form.email,
          password: this.form.password,
          password_confirmation: this.form.password_confirmation
        })
        .then(response => {
          this.loading = false;
          this.success = true;
          this.$router.push({ name: "dashboard" });
        })
        .catch(err => {
            this.loading = false;
            if(!err.response.data.errors){
                this.error.message = err.response.data;
            }
            else{
                (err.response.data.errors)
                    ? this.setErrors(err.response.data.errors)
                    : this.clearErrors();
            }
        });
    },
    setErrors(errors) {
        this.error.name = errors.name ? errors.name[0] : null;
        this.error.email = errors.email ? errors.email[0] : null;
        this.error.password = errors.password ? errors.password[0] : null;
        this.error.password_confirmation = errors.password_confirmation ? errors.password_confirmation[0] : null;
    },
    clearErrors() {
      this.error.name = null;
      this.error.email = null;
      this.error.password = null;
      this.error.password_confirmation = null;
    }
  }
};
</script>
