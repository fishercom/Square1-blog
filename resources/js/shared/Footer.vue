<template>
	<footer>
		<hr>
		<div class="container">
			&copy;<span v-once>{{ currentYear }} Blog developed by Fischer Tirado</span>
		</div>
	</footer>
</template>

<script>
	export default {
		data() {
			return {
				currentYear: (new Date).getFullYear()
			}
		}
	}
</script>