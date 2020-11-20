<template>

      <div class="sidebar bg-light">
        <div class="sidebar-item">
            <!-- Card sample -->
            <h4 class="card-title">Also, you can do</h4>
            <p class="card-text">By registering in our app, you can create new entries.</p>

            <router-link :to="{name: 'create_post'}" exact>
				      <b-button variant="success">
                <b-icon icon="pencil-square"></b-icon> Create New Post
              </b-button>
				    </router-link>

			    
        </div>
      </div>

</template>

<script>
export default {

};
</script>