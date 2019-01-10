<template>
  <v-card :to="this.to">
    <v-card-title>
      PUZZLE {{id}}
    </v-card-title>
    <v-card-actions>
      <v-list-tile class="grow">
        <v-layout align-center justify-end>
          <v-icon class="mr-1">calendar</v-icon>
          <span class="subheading mr-2">{{date}}</span>
          <span class="mr-1">·</span>
        </v-layout>
      </v-list-tile>
    </v-card-actions>
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
