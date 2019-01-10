<template>
  <v-navigation-drawer permanent app>
    <v-toolbar flat>
      <v-list>
        <v-list-tile>
          <v-list-tile-title class="title">
            Sudoku
          </v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-toolbar>
    <v-list>
      <v-list-tile :to="{name: 'home'}">
        <v-list-tile-action>
          <v-icon>home</v-icon>
        </v-list-tile-action>
        <v-list-tile-title>
          Home
        </v-list-tile-title>
      </v-list-tile>
    </v-list>
    <v-list>
      <v-list-group>
        <v-list-tile slot="activator">
          <v-list-tile-action>
            <v-icon>grid_on</v-icon>
          </v-list-tile-action>
          <v-list-tile-title>
            Puzzle
          </v-list-tile-title>
        </v-list-tile>
        <v-list-tile :to="{name: 'puzzle.index'}">
          <v-list-tile-action>
            <v-icon>dehaze</v-icon>
          </v-list-tile-action>
          <v-list-tile-title>
            List
          </v-list-tile-title>
        </v-list-tile>
        <v-list-tile :to="{name: 'puzzle.create'}">
          <v-list-tile-action>
            <v-icon>edit</v-icon>
          </v-list-tile-action>
          <v-list-tile-title>
            Create
          </v-list-tile-title>
        </v-list-tile>
      </v-list-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
  export default {
    name: "Sidebar"
  };
</script>

<style scoped>

</style>
