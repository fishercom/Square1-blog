<template>
	<div>
		<app-header></app-header>
		<transition name="fade" mode="out-in">
			<div class="container min-height">
				<div class="row justify-content-center">
					<router-view></router-view>
				</div>
			</div>
		</transition>
		<app-footer></app-footer>
	</div>
</template>

<script>
	import Header from '../shared/Header.vue';
	import Footer from '../shared/Footer.vue';
	export default {
		components: {
			'app-header': Header,
			'app-footer': Footer
		}
	}
</script>