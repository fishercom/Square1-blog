<template>

    <!-- Blog Post -->
    <div class="card mb-4">
      <div class="card-body">
        <h2 class="card-title">{{ post.title }}</h2>
        <p class="card-text">{{ post.description }}...</p>
  			<router-link :to="{name: 'post', params:{id: post.id}}" exact>
          <b-button variant="info">
            <b-icon icon="plus-circle"></b-icon> View More
          </b-button>
				</router-link>
      </div>
      <div class="card-footer text-muted">
        Posted on {{ post.publication_date }} by {{ post.author }}
      </div>
    </div>

</template>

<script>
export default {
    props: ['post']

};
</script>