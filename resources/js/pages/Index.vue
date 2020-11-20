<template>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<div class="page-header">
					<h1 class="display-4">Latest Posts</h1>
				</div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search this blog">
          <div class="input-group-append">
          <button class="btn btn-secondary" type="button">
            <b-icon icon="search"></b-icon>
          </button>
          </div>
        </div>

        <div class="py-4 list-group">
            <div v-for="post in posts" :key="post.id">
                <post :post="post"></post>
            </div>
        </div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
          <sidebar></sidebar>
			</div>
		</div>
	</div>
</template>

<script>
import Post from '../shared/Post.vue'
import Sidebar from '../shared/Sidebar.vue'

export default {
data() {
    return {
        loading: false,
        posts: [
            { id: 1, title: 'New Post', description: 'Post Description' }
        ],
        error: null,
    };
  },
  components: {
    'post': Post,
    'sidebar': Sidebar,
  },
  mounted () {
    this.get_posts()
  },
  methods: {
    get_posts() {
      this.loading = true;
      this.$store
        .dispatch("latestPosts", {})
        .then(response => {
            this.loading = false;
            this.posts = response.data;
        })
        .catch(err => {
            this.loading = false;
            if(err.response.data.message){
                console.log(err.response.data.message);
                this.error = err.response.data.message;
                return;
            }
        });
    },
  }
};
</script>