<template>
  <v-card :to="this.to">
    <v-card-title>
      PUZZLE {{id}}
    </v-card-title>
  </v-card>
</template>

<script>
  export default {
    name: "PuzzleCard",
    props: ['to', 'date', 'id']
  };
</script>

<style scoped>

</style>
