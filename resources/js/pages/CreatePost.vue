<template>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<div class="page-header">
					<h1 class="display-4">Create New Post</h1>
				</div>
                <div class="py-4 list-group">
                    <b-form @submit.prevent="onSubmit" @reset="onReset" v-if="show">

                        <b-form-group label="Post Title:" label-for="title">
                            <b-form-input
                            id="title"
                            v-model="form.title"
                            required
                            placeholder="Enter the post title"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group label="Description:" label-for="description">
                            <b-form-textarea
                                id="description"
                                v-model="form.description"
                                required
                                placeholder="Enter something..."
                                rows="5"
                                max-rows="8">
                            </b-form-textarea>
                        </b-form-group>

                        <b-form-group label="Publication Date" label-for="publication_date">
                            <b-form-input
                                id="publication_date"
                                type="date"
                                v-model="form.publication_date"
                                required
                                placeholder="Enter date"
                            ></b-form-input>
                        </b-form-group>

						<div class="invalid-feedback" v-show="error.message">{{ error.message }}</div>

                        <b-button type="submit" variant="primary" :disabled="loading">
                            <b-icon icon="check"></b-icon>
                            <span v-show="loading">Submit...</span>
                            <span v-show="!loading">Submit</span>
                        </b-button>

                        <b-button type="reset" variant="danger">
                            <b-icon icon="x-circle"></b-icon> Reset
                        </b-button>

                    </b-form>
                </div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
          <sidebar></sidebar>
			</div>
		</div>
	</div>
</template>

<script>
import Sidebar from '../shared/Sidebar.vue'

export default {
  components: {
    'sidebar': Sidebar,
  },
  data() {
    return {
        form:{
            title: null,
            description: null,
            publication_date: null
        },
        error:{
            message: null
        },
        show: true,
        loading: false
    };
  },
  methods:{
    onSubmit() {
        this.loading = true;

        this.$store
        .dispatch("savePost", {
            title: this.form.title,
            description: this.form.description,
            publication_date: this.form.publication_date
        })
        .then(response => {
            this.loading = false;
            this.$router.push({ name: "dashboard" });
        })
        .catch(err => {
            this.loading = false;
            if(err.response.data.message){
                console.log(err.response.data.message);
                this.error.message = err.response.data.message;
                return;
            }

            (err.response.data.errors)
                ? this.setErrors(err.response.data.errors)
                : this.clearErrors();
        });
    },
    onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.title = ''
        this.form.description = ''
        this.form.publication_date = ''
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
    },

}

};
</script>
