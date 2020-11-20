<template>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
		<div class="container">
			<router-link class="navbar-brand" :to="{name: 'index'}" v-once>{{ siteName }}</router-link>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<router-link :to="{name: 'index'}" tag="li" class="nav-item" activeClass="active" exact>
						<a class="nav-link">Home</a>
					</router-link>
					<router-link :to="{name: 'dashboard'}" v-show="loggedIn" tag="li" class="nav-item" activeClass="active" exact>
						<a class="nav-link">Dashboard</a>
					</router-link>
					<router-link v-show="!loggedIn" :to="{name: 'login'}" tag="li" class="nav-item" activeClass="active" exact>
						<a class="nav-link">Login</a>
					</router-link>
					<router-link v-show="!loggedIn" :to="{name: 'register'}" tag="li" class="nav-item" activeClass="active" exact>
						<a class="nav-link">Register</a>
					</router-link>
					<li class="nav-item" v-show="loggedIn">
						<a class="nav-link" href="#" @click.prevent="logout">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>

<script>
	import {mapGetters} from 'vuex';
	export default {
		data() {
			return {
				siteName: 'Blog'
			}
		},
		computed: mapGetters([
			'loggedIn'
		]),
		methods: {
			logout() {

				this.$store.dispatch("destroyToken").then(response => {
					this.$router.push({ name: "login" });
				});

			}
		}
	}
</script>