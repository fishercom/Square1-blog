<template>
  <!-- Blog Entries Column -->
  <div class="col-md-10">

    <h1 class="title">Latest Posts</h1>

    <div class="list-group">
        <div v-for="post in posts" :key="post.id">
            <post :post="post"></post>
        </div>
    </div>

  </div>
</template>

<script>
import Post from '../partials/Post.vue'

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
    'post': Post
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