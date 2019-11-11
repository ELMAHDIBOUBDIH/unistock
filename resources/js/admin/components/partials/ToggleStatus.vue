<template>
<span class="toggle-status">
	<img v-if="((status == 1 || upDeactive) && !upActive)" :src="'/img/icons/checked.svg'"   @mouseover="upActive = true" @mouseleave="upActive = false; upDeactive = false"  class="tip uni-icon"  data-placement="left" data-toggle="tooltip" title="" :data-original-title="textb" alt="pages"  @click="confirm(1)">
	<img v-if="((status == 0 || upActive)  && !upDeactive)" :src="'/img/icons/cancel.svg'"    @mouseover="upDeactive = true" @mouseleave="upDeactive = false; upActive = false" class="tip uni-icon"  data-placement="left" data-toggle="tooltip" title="" :data-original-title="texta" alt="pages"  @click="confirm(0)">
</span>
</template>
<script>
export default {
	props: ['status', 'id', 'item', 'texta', 'textb'],
	data() {
		return {
			upActive: false,
			upDeactive: false,
		};
	},
	methods: {
		confirm: function(value) {
			this.$emit('emission', this.id,  value, this.item);
		}
	},
};
</script>
