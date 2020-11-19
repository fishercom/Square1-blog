<template>

    <!-- Blog Post -->
    <div class="card mb-4">
      <div class="card-body">
  			<router-link :to="{name: 'post', params:{id: post.id}}" exact>
					<h2 class="card-title">{{ post.title }}</h2>
				</router-link>
        <p class="card-text">{{ post.description }}</p>
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