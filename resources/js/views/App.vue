<template>
	<div>
		<app-header></app-header>
		<transition name="fade" mode="out-in">
			<router-view></router-view>
		</transition>
		<app-footer></app-footer>
	</div>
</template>

<script>
	import Header from '../partials/Header.vue';
	import Footer from '../partials/Footer.vue';
	export default {
		components: {
			'app-header': Header,
			'app-footer': Footer
		}
	}
</script>