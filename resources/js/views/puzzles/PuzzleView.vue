<template>
  <v-container fluid>
    <v-progress-circular v-if="loading" indeterminate/>
    <table cellspacing="0" v-else>
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
    <v-btn @click="callCheckAPI">Check</v-btn>
    <v-btn @click="callSolveAPI">Solve</v-btn>
    <v-snackbar v-model="snackbar">
      Congratulations!
    </v-snackbar>
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
            if (i > 2) section += 3;
            if (i > 5) section += 3;

            if (j > 2) section++;
            if (j > 5) section++;

            board.push({error: false, readonly: col !== null, value: col, row: i + 1, col: j + 1, section: section});
          });
        });

        self.board = board;
        self.loading = false;
      });
    },
    methods: {
      resetError() {
        this.board.map((col) => {
          col.error = false;
        });
      },
      changeBoardValue(index, value) {
        console.log(index);
        this.board[index].value = value;
      },
      callCheckAPI() {
        this.resetError();
        const board = this.board.map((col) => {
          if (!col.value) {
            return null;
          } else {
            return +col.value;
          }
        });
        const rowBasedBoard = [];

        while (board.length > 0) {
          rowBasedBoard.push(board.splice(0, 9));
        }

        const form = new FormData();
        form.set('board', JSON.stringify(rowBasedBoard));

        const self = this;

        axios.post('/api/checkSolved', form).then((response) => {
          if (response.data.success === false) {
            response.data.errors.map((error) => {
              self.board[(error[0] * 9) + error[1]].error = true;
            });
          } else {
            self.snackbar = true;
          }
        }).catch((error) => {
          console.error(error);
        });
      },
      callSolveAPI() {
        this.resetError();
        const board = this.board.map((col) => {
          if (!col.value) {
            return null;
          } else {
            return +col.value;
          }
        });
        const rowBasedBoard = [];

        while (board.length > 0) {
          rowBasedBoard.push(board.splice(0, 9));
        }

        const form = new FormData();
        form.set('board', JSON.stringify(rowBasedBoard));

        const self = this;

        axios.post('/api/solvePuzzle', form).then((response) => {
          let index = 0;
          response.data.map((row) => {
            row.map((col) => {
              self.board[index++].value = col;
            });
          });
        }).catch((error) => {
          console.error(error);
        });
      }
    },
    data() {
      return {
        loading: true,
        snackbar: false,
        board: []
      };
    }
  };
</script>

<style scoped lang="scss">
  table {
    border: 2px solid black;
  }
  tr:nth-child(3), tr:nth-child(6) {
    td {
      border-bottom: 2px solid black;
    }
  }

  td {
    input {
      margin: 1px;
    }
  }

  td:nth-child(3), td:nth-child(6) {
    border-right: 2px solid black;
  }
</style>
