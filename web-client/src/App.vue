<template>
  <div id="app">
    <div v-if="processing">
      <BlockUI :message="txtProcessing"></BlockUI>
    </div>
    <v-dialog/>
    <center><h1>Dancing with Death</h1></center>
    <router-view/>
  </div>
</template>

<script>

import {mapGetters} from 'vuex';

export default {
  name: 'App',
  data: function(){
    return {
      txtProcessing : 'Loading...'
    }
  },
  computed: {
    ...mapGetters({
      processing: 'getProcessing'
    })
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
