<template>
<div class="dropdown no-caret d-inline-block">
    <button class="btn bg-indigo-800 btn-icon btn-sm dropdown-toggle " type="button" id="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-sort"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownSort">
        <h6 class="dropdown-header">{{ trans('text.sort-by')}}</h6>
        <a v-for="sort in sorts" class="dropdown-item" href="#" @click.prevent="$emit('sort', string(sort))" >{{ trans('text.sort-by-' + sort)}}</a>
    </div>
</div>
</template>
<script>
export default {
    props: {
        sorts: '',
        url: ''
    },
    data() {
        return {
            sort: '',
            direction: '',
        };
    },
    methods: {
        string(val) {
					 var str = this.url;
            if (this.sort == val && this.direction == 'asc') {
                var direction = 'desc';
            } else {
                var direction = 'asc';
            }
            this.sort = val;
            this.direction = direction;

            var n = str.search("sort=");
            if (n < 0) {
                str += 'sort=' + val + '&';
            } else {
                str = str.replace(/(sort=).*?(&)/, '$1' + val + '$2');
            }
            var m = str.search("direction=");
            if (m < 0) {
                str += 'direction=' + direction + '&';
            } else {
                str = str.replace(/(direction=).*?(&)/, '$1' + direction + '$2');
            }


            return str;
        },
    },
    mounted() {

    }
};
</script>
