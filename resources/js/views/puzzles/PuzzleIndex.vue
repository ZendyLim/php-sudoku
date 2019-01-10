<template>
  <v-container grid-list-md>
    <v-progress-circular v-if="loading" indeterminate/>
    <v-layout wrap v-else>
      <v-flex xs12 md6 lg4 xl2 v-for="puzzle in puzzles" :key="puzzle.id">
        <puzzle-card :id="puzzle.id" :date="puzzle.created_at" :to="{name: 'puzzle.view', params:{id: puzzle.id}}"/>
      </v-flex>
    </v-layout>

  </v-container>
</template>

<script>
  import PuzzleCard from '../../components/PuzzleCard';
  import axios from 'axios';

  export default {
    name: "PuzzleIndex",
    components: {
      PuzzleCard
    },
    mounted() {
      axios.get('/api/getPuzzles').then((response) => {
        this.puzzles = response.data;
        this.loading = false;
      })
    },
    data() {
      return {
        loading: true,
        puzzles: null
      };
    }
  };
</script>

<style scoped>

</style>
