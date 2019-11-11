<template>
<input type="text"  class="form-control"   >
</template>
<script>
export default {
    props: ['value'],
    mounted: function() {
        var vm = this
        $(this.$el)
            // init select2
            .daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            }, function(start, end, label) {
                vm.$emit('input', end.format())
            });
            
    },
};
</script>
