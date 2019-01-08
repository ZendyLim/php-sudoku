<template>
  <v-app>
    <Sidebar/>
    <v-content>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  import Sidebar from './components/Sidebar';

  export default {
    name: "Main",
    components: {
      Sidebar
    }
  };
</script>

<style scoped>

</style>
