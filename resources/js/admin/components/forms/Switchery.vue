<template>
<input type="checkbox" name="switchery">
</template>
<script>
export default {
    props: {
      value: {
          type: Boolean,
          default: '#00ACC1'
      },
        color: {
            type: String,
            default: '#00ACC1'
        }
    },
    mounted: function() {
        if (typeof Switchery == 'undefined') {
            console.warn('Warning - switchery.min.js is not loaded.');
            return;
        }

        var vm = this;
        var switchery = new Switchery(vm.$el, {
            color: vm.color
        });
        vm.$el.onchange = function() {
            vm.$emit('input', vm.$el.checked)
        };
    },
};
</script>
