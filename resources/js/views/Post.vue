<template>

  <!-- Blog Entries Column -->
  <div class="col-md-10">

    <h1 class="title">{{ post.title }}</h1>

    <p>{{ post.description }}</p>

    Posted on {{ post.publication_date }} by {{ post.author }}

  </div>
</template>

<script>
export default {
    props: ['post']

};
</script>