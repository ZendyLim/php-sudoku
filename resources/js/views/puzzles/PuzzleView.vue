<template>
  <v-container fluid>
    <table>
      <tbody>
      <tr v-for="i in 9">
        <td v-for="(column, j) in board.slice((i - 1) * 9, i * 9)">
          <sudoku-column
            :val="column.value"
            :error="column.error"
            :readonly="column.readonly"
            @input="changeBoardValue(j + ((i - 1) * 9), ...arguments)"
          />
        </td>
      </tr>
      </tbody>
    </table>
    <v-btn @click="">Check</v-btn>
  </v-container>
</template>

<script>
  import SudokuColumn from '../../components/SudokuColumn';
  import axios from 'axios';

  export default {
    name: "PuzzleView",
    components: {
      SudokuColumn
    },
    mounted() {
      const self = this;
      axios.get(`/api/getPuzzle/${this.$route.params.id}`).then((response) => {
        const data = JSON.parse(response.data.puzzle);

        const board = [];

        data.map((row, i) => {
          row.map((col, j) => {
            let section = 1;
            for (let x = 0; x < Math.ceil(i / 3); x++) {
              section += 3;
            }

            for (let x = 0; x < Math.ceil(j / 3); x++) {
              section++;
            }

            board.push({error: false, readonly: col !== null, value: col, row: i, col: j, section: section});
          });
        });

        self.board = board;
      });
    },
    data() {
      return {
        board: null
      };
    }
  };
</script>

<style scoped>

</style>
