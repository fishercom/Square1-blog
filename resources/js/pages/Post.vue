<template>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<div class="page-header">
					<h1 class="display-4">{{ post.title }}</h1>
				</div>
        <div class="py-4 list-group">
          <p>{{ post.description }}</p>
          <p>
          Posted on {{ post.publication_date }} by {{ post.author }}
          </p>
          <p>
            <router-link :to="{name: 'index'}" exact>
				      <b-button variant="info"><b-icon icon="chevron-left"></b-icon> Back </b-button>
				    </router-link>
          </p>
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
  mounted(){
    this.id = this.$route.params.id;
    this.get_post();
  },
  data() {
    return {
        post:
            {
              id: null,
              title: null,
              description: null,
              publication_date: null
            }
        ,
        id: null,
    };
  },
  methods:{
    get_post() {
      this.loading = true;
      this.$store
        .dispatch("getPost", {
          id: this.id
        })
        .then(response => {
            this.loading = false;
            this.post = response.data;
        })
    },
  }

};
</script>