<template>
  <div>
      <div class = 'float-right'>
        <div class='input-group'>
          <input type='text' v-model='filterText' class='input-sm' @keyup.enter='doFilter' placeholder='Search'>
          <span class='input-group-btn'>
            <button class='btn btn-secondary' @click='doFilter'><icon name = 'search'></icon></button>
          </span>
        </div>
      </div>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        filterText: ''
      }
    },
    methods: {
      doFilter () {
        this.$emit('filter', { filterText: this.filterText });
      },
      resetFilter () {
        this.filterText = ''
        this.$emit('reset', { filterText: '' });
      }
    }
  }
</script>