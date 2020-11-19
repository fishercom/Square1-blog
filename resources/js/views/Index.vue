<template>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<div class="page-header">
					<h1 class="display-4">Latest Posts</h1>
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
import Post from '../partials/Post.vue'
import Sidebar from '../partials/Sidebar.vue'

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
      //this.get_posts()
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