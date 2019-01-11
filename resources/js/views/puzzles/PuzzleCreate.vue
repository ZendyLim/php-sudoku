<template>
  <v-container fluid>
    <table cellspacing="0">
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
    <v-snackbar v-model="snackbar">
      Cannot save your puzzle. It's not solvable!
    </v-snackbar>
  </v-container>
</template>

<script>
  import axios from 'axios';
  import SudokuColumn from '../../components/SudokuColumn';

  export default {
    name: "PuzzleCreate",
    components: {
      SudokuColumn
    },
    methods: {
      callCheckAPI() {
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

        axios.post('/api/checkSolvableAndSave', form).then((response) => {
          if (response.data.success === false) {
            self.snackbar = true;
          } else {
            self.$router.push({name: 'puzzle.view', params: {id: response.data.id}});
          }
        }).catch((error) => {
          console.error(error);
        });
      },
      changeBoardValue(index, value) {
        console.log(index);
        this.board[index].value = value;
      },
      markSectionError(sectionIndex) {
        this.board.map((col) => {
          if (col.section === sectionIndex) {
            col.error = true;
          }
        });
      },
      markRowError(sectionIndex) {
        this.board.map((col) => {
          if (col.row === sectionIndex) {
            col.error = true;
          }
        });
      },
      markColumnError(sectionIndex) {
        this.board.map((col) => {
          if (col.col === sectionIndex) {
            col.error = true;
          }
        });
      },
      resetError() {
        this.board.map((col) => {
          col.error = false;
        });
      }
    },
    data() {
      return {
        snackbar: false,
        board: [
          {error: false, value: null, row: 1, col: 1, section: 1},
          {error: false, value: null, row: 1, col: 2, section: 1},
          {error: false, value: null, row: 1, col: 3, section: 1},
          {error: false, value: null, row: 1, col: 4, section: 2},
          {error: false, value: null, row: 1, col: 5, section: 2},
          {error: false, value: null, row: 1, col: 6, section: 2},
          {error: false, value: null, row: 1, col: 7, section: 3},
          {error: false, value: null, row: 1, col: 8, section: 3},
          {error: false, value: null, row: 1, col: 9, section: 3},
          {error: false, value: null, row: 2, col: 1, section: 1},
          {error: false, value: null, row: 2, col: 2, section: 1},
          {error: false, value: null, row: 2, col: 3, section: 1},
          {error: false, value: null, row: 2, col: 4, section: 2},
          {error: false, value: null, row: 2, col: 5, section: 2},
          {error: false, value: null, row: 2, col: 6, section: 2},
          {error: false, value: null, row: 2, col: 7, section: 3},
          {error: false, value: null, row: 2, col: 8, section: 3},
          {error: false, value: null, row: 2, col: 9, section: 3},
          {error: false, value: null, row: 3, col: 1, section: 1},
          {error: false, value: null, row: 3, col: 2, section: 1},
          {error: false, value: null, row: 3, col: 3, section: 1},
          {error: false, value: null, row: 3, col: 4, section: 2},
          {error: false, value: null, row: 3, col: 5, section: 2},
          {error: false, value: null, row: 3, col: 6, section: 2},
          {error: false, value: null, row: 3, col: 7, section: 3},
          {error: false, value: null, row: 3, col: 8, section: 3},
          {error: false, value: null, row: 3, col: 9, section: 3},
          {error: false, value: null, row: 4, col: 1, section: 4},
          {error: false, value: null, row: 4, col: 2, section: 4},
          {error: false, value: null, row: 4, col: 3, section: 4},
          {error: false, value: null, row: 4, col: 4, section: 5},
          {error: false, value: null, row: 4, col: 5, section: 5},
          {error: false, value: null, row: 4, col: 6, section: 5},
          {error: false, value: null, row: 4, col: 7, section: 6},
          {error: false, value: null, row: 4, col: 8, section: 6},
          {error: false, value: null, row: 4, col: 9, section: 6},
          {error: false, value: null, row: 5, col: 1, section: 4},
          {error: false, value: null, row: 5, col: 2, section: 4},
          {error: false, value: null, row: 5, col: 3, section: 4},
          {error: false, value: null, row: 5, col: 4, section: 5},
          {error: false, value: null, row: 5, col: 5, section: 5},
          {error: false, value: null, row: 5, col: 6, section: 5},
          {error: false, value: null, row: 5, col: 7, section: 6},
          {error: false, value: null, row: 5, col: 8, section: 6},
          {error: false, value: null, row: 5, col: 9, section: 6},
          {error: false, value: null, row: 6, col: 1, section: 4},
          {error: false, value: null, row: 6, col: 2, section: 4},
          {error: false, value: null, row: 6, col: 3, section: 4},
          {error: false, value: null, row: 6, col: 4, section: 5},
          {error: false, value: null, row: 6, col: 5, section: 5},
          {error: false, value: null, row: 6, col: 6, section: 5},
          {error: false, value: null, row: 6, col: 7, section: 6},
          {error: false, value: null, row: 6, col: 8, section: 6},
          {error: false, value: null, row: 6, col: 9, section: 6},
          {error: false, value: null, row: 7, col: 1, section: 7},
          {error: false, value: null, row: 7, col: 2, section: 7},
          {error: false, value: null, row: 7, col: 3, section: 7},
          {error: false, value: null, row: 7, col: 4, section: 8},
          {error: false, value: null, row: 7, col: 5, section: 8},
          {error: false, value: null, row: 7, col: 6, section: 8},
          {error: false, value: null, row: 7, col: 7, section: 9},
          {error: false, value: null, row: 7, col: 8, section: 9},
          {error: false, value: null, row: 7, col: 9, section: 9},
          {error: false, value: null, row: 8, col: 1, section: 7},
          {error: false, value: null, row: 8, col: 2, section: 7},
          {error: false, value: null, row: 8, col: 3, section: 7},
          {error: false, value: null, row: 8, col: 4, section: 8},
          {error: false, value: null, row: 8, col: 5, section: 8},
          {error: false, value: null, row: 8, col: 6, section: 8},
          {error: false, value: null, row: 8, col: 7, section: 9},
          {error: false, value: null, row: 8, col: 8, section: 9},
          {error: false, value: null, row: 8, col: 9, section: 9},
          {error: false, value: null, row: 9, col: 1, section: 7},
          {error: false, value: null, row: 9, col: 2, section: 7},
          {error: false, value: null, row: 9, col: 3, section: 7},
          {error: false, value: null, row: 9, col: 4, section: 8},
          {error: false, value: null, row: 9, col: 5, section: 8},
          {error: false, value: null, row: 9, col: 6, section: 8},
          {error: false, value: null, row: 9, col: 7, section: 9},
          {error: false, value: null, row: 9, col: 8, section: 9},
          {error: false, value: null, row: 9, col: 9, section: 9}
        ]
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

  td:nth-child(3), td:nth-child(6) {
    border-right: 2px solid black;
  }
</style>
